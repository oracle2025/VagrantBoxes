#!/usr/bin/env bash


apt-get update

if [ ! -f /var/log/indeferosetup ];
then
    touch /var/log/indeferosetup
else
	exit
fi

#apt-get -y upgrade

WWWPORT=4567 # use awk to extract from Vagrantfile

apt-get install -y makepasswd

DBROOTPASS=`makepasswd`
echo $DBROOTPASS >> mysqlrootpwd.txt
chmod go-r mysqlrootpwd.txt

sudo debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password password $DBROOTPASS"
sudo debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password_again password $DBROOTPASS"

apt-get install -y mysql-server-5.5
#mysql -u root -p
apt-get install -y tasksel
tasksel install lamp-server
apt-get install -y git git-daemon-run
apt-get install -y php-pear vim php5-mysql
/etc/init.d/apache2 restart

pear upgrade-all
pear install --alldeps Mail
pear install --alldeps Mail_mime

rm /var/www/index.html
mkdir /home/www
chown www-data:www-data /home/www
cd /home/www
git clone git://projects.ceondo.com/pluf.git
wget http://projects.ceondo.com/p/indefero/downloads/get/indefero-1.3.3.tar.bz2
tar xjf indefero-1.3.3.tar.bz2
rm indefero-1.3.3.tar.bz2
cd /var/www
ln -s /home/www/indefero/www/index.php
ln -s /home/www/indefero/www/media
cd /home/www/indefero
cp /vagrant/idf.php src/IDF/conf/idf.php
cp src/IDF/conf/path.php-dist src/IDF/conf/path.php

# $cfg['allowed_scm'] = array();
# $cfg['allowed_scm'] = array('git'); # Use only git!, 'mtn', 'svn');
# $cfg['secret_key'] = ''; # dd if=/dev/urandom bs=1 count=64 2>/dev/null | base64 -w 0

# $cfg['db_engine'] = 'PostgreSQL';
# $cfg['db_engine'] = 'MySQL';
# $cfg['db_database'] = 'indefero';
# $cfg['db_server'] = 'localhost';
# $cfg['db_login'] = 'indefero';
# $cfg['db_password'] = 'bar';
# $cfg['db_version'] = '5.1'; # <- uncomment!

DBPASS=`makepasswd`

function edit_idf_config { # key, value
	sed -r "s/\\['$1'\\] = '([^']*)'/\\['$1'\\] = '$2'/g" src/IDF/conf/idf.php > src/IDF/conf/idf.php.postreplace	
	if [ -e src/IDF/conf/idf.php ]; then
	    rm -f src/IDF/conf/idf.php
	fi
	mv -f src/IDF/conf/idf.php.postreplace src/IDF/conf/idf.php	
}
function edit_idf_config_array { # key, value
	sed -r "s/\\['$1'\\] = array\\(([^']*)\\)/\\['$1'\\] = array($2)/g" src/IDF/conf/idf.php > src/IDF/conf/idf.php.postreplace	
	if [ -e src/IDF/conf/idf.php ]; then
	    rm -f src/IDF/conf/idf.php
	fi
	mv -f src/IDF/conf/idf.php.postreplace src/IDF/conf/idf.php	
}

#edit_idf_config db_engine MySQL
#edit_idf_config db_database indefero
#edit_idf_config db_login indefero
edit_idf_config db_password $DBPASS
#edit_idf_config secret_key `dd if=/dev/urandom bs=1 count=64 2>/dev/null | base64 -w 0 `
#edit_idf_config_array allowed_scm "'git'"
#WWWPORT=4567
#edit_idf_config url_base "http://localhost:$WWWPORT"
#edit_idf_config url_media "http://localhost:$WWWPORT/media"
#edit_idf_config url_upload "http://localhost:$WWWPORT/media/upload"

if [ ! -f /var/log/databasesetup ];
then
    echo "CREATE USER 'indefero'@'localhost' IDENTIFIED BY '$DBPASS'" | mysql -uroot -p$DBROOTPASS
    echo "CREATE DATABASE indefero" | mysql -uroot -p$DBROOTPASS
    echo "GRANT ALL ON indefero.* TO 'indefero'@'localhost'" | mysql -uroot -p$DBROOTPASS
    echo "flush privileges" | mysql -uroot -p$DBROOTPASS

    touch /var/log/databasesetup
fi

mkdir -p /home/www/indefero/www/media/upload
mkdir -p /home/www/indefero/attachments
chown www-data:www-data /home/www/indefero/www/media/upload
chown www-data:www-data /home/www/indefero/attachments

cd /home/www/indefero/src
php /home/www/pluf/src/migrate.php --conf=IDF/conf/idf.php -a -i -d

php /vagrant/bootstrap.php


adduser \
          --system \
          --shell /bin/sh \
          --gecos 'git version control' \
          --group \
          --disabled-password \
          --home /home/git \
          git

sudo -u git /vagrant/git-user-init.sh
#mkdir /home/git/.ssh
#touch /home/git/.ssh/authorized_keys
#chmod 0700 /home/git/.ssh
#chmod 0600 /home/git/.ssh/authorized_keys
#exit
usermod -a -G git www-data
sudo -H -u git mkdir /home/git/repositories


#put in cron for user git:
echo "*/5 * * * *  /usr/bin/php /home/www/indefero/scripts/gitcron.php" >> tmpcrontab
crontab -u git tmpcrontab
rm tmpcrontab

cat /vagrant/etc_sv_git_daemon_run.txt > /etc/sv/git-daemon/run
sv restart git-daemon
