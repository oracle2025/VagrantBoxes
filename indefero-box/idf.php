<?php
/* -*- tab-width: 4; indent-tabs-mode: nil; c-basic-offset: 4 -*- */
/*
# ***** BEGIN LICENSE BLOCK *****
# This file is part of InDefero, an open source project management application.
# Copyright (C) 2008 - 2011 Céondo Ltd and contributors.
#
# InDefero is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# InDefero is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
#
# ***** END LICENSE BLOCK ***** */

$cfg = array();
$cfg['allowed_scm'] = array('git');

# Enter a long random string here that is unique for this installation.
# It is critical to put in a long string with at least 40 characters.
# You can use dd like this to gain some randomness:
#   $ dd if=/dev/urandom bs=1 count=64 2>/dev/null | base64 -w 0
$cfg['secret_key'] = 'CfSHscJ4xzGB+kt0zpb1DyYCcGIaetoPAcUmrlnT/spVyabNa952byWb6ph9xiI/qt+thO/udX52dECHaU1Jtw==';

# ---------------------------------------------------------------------------- #
#                              Debug section                                   #
# ---------------------------------------------------------------------------- #

# In debug mode Indefero renders stack traces in case of an error that include
# more information about a specific problem. Since these stack traces often
# contain sensible data, this option MUST BE DEACTIVATED in production mode.
# (see $cfg['admins'] below to learn how you can still be notified about
# problems without 'debug' being enabled).
$cfg['debug'] = true;


# ---------------------------------------------------------------------------- #
#                               Path section                                   #
# ---------------------------------------------------------------------------- #

# Temporary folder where the application is writing compiled templates,
# cached data and other temporary resources to.
# It must be writeable by your webserver instance.
$cfg['tmp_folder'] = '/tmp';

# Path to the PEAR folder
$cfg['pear_path'] = '/usr/share/php';

# Path to the upload folder
$cfg['upload_path'] = '/home/www/indefero/www/media/upload';

# The following path MUST NOT be accessible through a web browser,
# as user will otherwise be able to upload executable files (*.php) and
# this can create TERRIBLE security issues. In this folder, the attachments
# to the issues will be uploaded and we do not restrict the content type.
$cfg['upload_issue_path'] = '/home/www/indefero/attachments';

# If your SCM binary is not accessible for the web user (for example, because
# it is not in the system PATH), you can enter the full path to it here.
$cfg['svn_path'] = 'svn';
$cfg['svnlook_path'] = 'svnlook';
$cfg['svnadmin_path'] = 'svnadmin';
$cfg['hg_path'] = 'hg';
$cfg['git_path'] = 'git';
$cfg['mtn_path'] = 'mtn';

# The monotone backend allow you to add extra options for the started monotone
# process; please keep the default if unsure.
$cfg['mtn_opts'] = array('--no-workspace', '--no-standard-rcfiles');


# ---------------------------------------------------------------------------- #
#                                URL section                                   #
# ---------------------------------------------------------------------------- #

# Examples:
# You have:
#   http://www.mydomain.com/myfolder/index.php
# Put:
#   $cfg['idf_base'] = '/myfolder/index.php';
#   $cfg['url_base'] = 'http://www.mydomain.com';
#
# You have mod_rewrite:
#   http://www.mydomain.com/
# Put:
#   $cfg['idf_base'] = '';
#   $cfg['url_base'] = 'http://www.mydomain.com';
#
$cfg['idf_base'] = '/index.php';
$cfg['url_base'] = 'http://localhost:4567';

# URL to access the media folder which is in the www folder
# of the distribution archive
$cfg['url_media'] = 'http://localhost:4567/media';

# URL to access a folder in which the files you upload through
# the downloads tab will be stored.
$cfg['url_upload'] = 'http://localhost:4567/media/upload';


# ---------------------------------------------------------------------------- #
#                        Internationalization section                          #
# ---------------------------------------------------------------------------- #

# Enter a valid time zone here to ensure that external timestamps, coming from
# the SCM for example, are translated into this time zone.
# A list of available time zones can be found at
# <http://www.php.net/manual/en/timezones.php>
$cfg['time_zone'] = 'Europe/Berlin';

# Configure which languages should be available in your forge.
# If you want to enable an additional language, ensure that the
# language file in question resides in 'src/IDF/locale'.
$cfg['languages'] = array('en', 'fr', 'de', 'es_ES', 'ru');


# ---------------------------------------------------------------------------- #
#                               Email section                                  #
# ---------------------------------------------------------------------------- #
#
# Indefero uses the PEAR Mail class to send mails. Available mail backend are:
#
# - The PHP Mail built-in function (mail)
# - Sendmail (sendmail)
# - Simple Mail Transfer Protocol (smtp)
#
# Sendmail and SMTP need extra configuration, see the examples below.
#

# This is a general lock to enable or disable the mail sending process.
# True enables mail sending, false disables it.
$cfg['send_emails'] = false;

# The mail backend to use: mail, sendmail, or smtp
$cfg['mail_backend'] = 'mail';

# Mails sent by indefero will have thoses headers:
$cfg['from_email'] = 'sender@example.com';
$cfg['bounce_email'] = 'no-reply@example.com';

# The following persons will get an email in case of errors, i.e. when the
# system is in not in debug mode (see $cfg['debug'] above).
$cfg['admins'] = array(
    array('You', 'you@example.com'),
    array('Bob', 'bob@example.com'),
);

##
## Example SMTP configuration
##
## The server to connect. Default is localhost
#$cfg['mail_host'] = 'localhost';
## The port to connect. Default is 25
#$cfg['mail_port'] = 25;
## The username to use for SMTP authentication.
#$cfg['mail_username'] = '';
## The password to use for SMTP authentication.
#$cfg['mail_password'] = '';
## The value to give when sending EHLO or HELO. Default is localhost
#$cfg['mail_localhost'] = 'localhost';
## The SMTP connection timeout. Default is NULL (no timeout)
#$cfg['mail_timeout'] = NULL;
## Whether to use VERP or not. Default is FALSE
#$cfg['mail_verp'] = FALSE;

##
## Example sendmail configuration
##
## The location of the sendmail program on the filesystem.
## Default is /usr/bin/sendmail
#$cfg['mail_sendmail_path'] = '/usr/bin/sendmail';
## Additional parameters to pass to the sendmail. Default is -i
#$cfg['sendmail_args'] = '-i';


# ---------------------------------------------------------------------------- #
#                             Database section                                 #
# ---------------------------------------------------------------------------- #
#
# WARNING: DO NOT USE SQLITE IN PRODUCTION
#
# This is not because of problems with the quality of the SQLite
# driver or with SQLite itself, but due to the lack of migration
# support in Pluf for SQLite. This means we cannot modify the DB
# easily once it is loaded with data.
#

# Enter one of the supported database engines: SQLite, MySQL, or PostgreSQL
$cfg['db_engine'] = 'MySQL';

# The database name for MySQL and PostgreSQL,  and the absolute path
# to the database file if you are using SQLite.
$cfg['db_database'] = 'indefero';

# The database server to connect.
$cfg['db_server'] = 'localhost';

# Information about the database user.
$cfg['db_login'] = 'indefero';
$cfg['db_password'] = 'AN4GWJTU';

# The version of your database server, only needed for MySQL
$cfg['db_version'] = '5.5';

# A prefix for your table name; this can be useful if you plan to run
# multiple indefero installations on the same database instance.
$cfg['db_table_prefix'] = 'indefero_';


# ---------------------------------------------------------------------------- #
#                               Cache section                                  #
# ---------------------------------------------------------------------------- #

# The cache is used to speed up the operations of most of the SCM commands.
#
# Indefero supports three methods to handle the cache, and you need to
# configure it with one of them:
#
# - Files (Pluf_Cache_File)
# - Alternative PHP Cache (Pluf_Cache_Apc)
# - Memcached (Pluf_Cache_Memcached)
#
# Both, APC and Memcached, need additional extensions to be compiled into
# your PHP installation, so the easiest is to use the file-based cache
# for an initial setup.
#
# For more information on APC, see <http://www.php.net/manual/en/book.apc.php>.
# Memcached is documented at <http://www.php.net/manual/en/book.memcached.php>.
#
$cfg['cache_engine'] = 'Pluf_Cache_File';
$cfg['cache_timeout'] = 300;
$cfg['cache_file_folder'] = $cfg['tmp_folder'].'/cache';

#$cfg['cache_engine'] = 'Pluf_Cache_Apc';
#$cfg['cache_timeout'] = 300;
#$cfg['cache_apc_keyprefix'] = 'uniqueforapp';
#$cfg['cache_apc_compress'] = true;

#$cfg['cache_engine'] = 'Pluf_Cache_Memcached';
#$cfg['cache_timeout'] = 300;
#$cfg['cache_memcached_keyprefix'] = 'uniqueforapp';
#$cfg['cache_memcached_server'] = 'localhost';
#$cfg['cache_memcached_port'] = 11211;
#$cfg['cache_memcached_compress'] = MEMCACHE_COMPRESSED;


# ---------------------------------------------------------------------------- #
#                             Git SCM section                                  #
# ---------------------------------------------------------------------------- #
#
# Read the file 'doc/syncgit.mdtext' for more information
#

# Uncomment this line to enable git support.
# $cfg['allowed_scm']['git'] = 'IDF_Scm_Git';

# The path to the git repositories. '%s' is replaced with the project name.
# Do not forget to give read access to these folders to your www user,
# for example by adding the www user to the git group.
$cfg['git_repositories'] = '/home/git/repositories/%s.git/';

# Git URL for public access to a repository. '%s' is again replaced with
# the project name. See 'doc/syncgit.mdtext' for the git-daemon configuration.
$cfg['git_remote_url'] = 'git://localhost:4568/%s.git';

# Git URL for private / write access to a repository. Again, '%s' is replaced
# with the name of the project. See 'doc/syncgit.mdtext' for more information
# about SSH authentification
$cfg['git_write_remote_url'] = 'git@127.0.0.1:2222:%s.git';

# The 'core.quotepath' option is configured on all new repositories created by
# indefero. This option disable characters to be escaped, when git commands run
# on an UTF-8 shell.
#
# - true:  All characters above 0x80 will be escaped (default)
# - false: Characters are printed directly, which for example enables
#          accented characters in an UTF-8 shell
#
# If you see malformed filenames in the source view, try to set this to false.
# $cfg['git_core_quotepath'] = false;

# Path to the gitserve.py script
$cfg['idf_plugin_syncgit_path_gitserve'] = '/home/www/indefero/scripts/gitserve.py';

# Path to the 'authorized_keys' file of your git user
$cfg['idf_plugin_syncgit_path_authorized_keys'] = '/home/git/.ssh/authorized_keys';

# Path to the temporary file for key synchronization
$cfg['idf_plugin_syncgit_sync_file'] = '/tmp/SYNC-GIT';

# Path to the git home
$cfg['idf_plugin_syncgit_git_home_dir'] = '/home/git';

# Path to the folder which contains all git repositories
$cfg['idf_plugin_syncgit_base_repositories'] = '/home/git/repositories';

# Set a custom git-post-update script. Use this only, if you know you are doing!
# $cfg['idf_plugin_syncgit_post_update'] = '/my/script';

# Automatically delete git repositories of deleted projects
# $cfg['idf_plugin_syncgit_remove_orphans'] = true;


# ---------------------------------------------------------------------------- #
#                             SVN SCM section                                  #
# ---------------------------------------------------------------------------- #
#
# Read the file doc/syncsvn.mdtext for more information
#

# Uncomment this line to enable the SVN support.
# $cfg['allowed_scm']['svn'] = 'IDF_Scm_Svn';

# In case of subversion, you can either use a local or a remote repository.
# The forge admin can configure a remote repository directly from the
# web interface. Local repositories cannot be configured from there,
# for security reasons, but have to be defined here.
# '%s' is replaced with the project name.
$cfg['svn_repositories'] = 'file:///home/svn/repositories/%s';

# The HTTP URL to the local SVN repository.
# We add 'trunk' to invite people to checkout the trunk of the project.
# Again, '%s' is replaced with the project name.
$cfg['svn_remote_url'] = 'http://localhost/svn/%s/trunk';

# Path to the authentification files for dav_svn
$cfg['idf_plugin_syncsvn_authz_file'] = '/home/svn/dav_svn.authz';
$cfg['idf_plugin_syncsvn_passwd_file'] = '/home/svn/dav_svn.passwd';

# Path to the folder which contains all SVN repositories
$cfg['idf_plugin_syncsvn_svn_path'] = '/home/svn/repositories';

# You can customize permissions for each user group.
# $cfg['idf_plugin_syncsvn_access_owners'] = 'rw';
# $cfg['idf_plugin_syncsvn_access_members'] = 'rw';
# $cfg['idf_plugin_syncsvn_access_extra'] = 'r';
# $cfg['idf_plugin_syncsvn_access_public'] = 'r';
# $cfg['idf_plugin_syncsvn_access_private'] = '';

# Automatically delete local SVN repositories of deleted projects
# $cfg['idf_plugin_syncsvn_remove_orphans'] = true;


# ---------------------------------------------------------------------------- #
#                           Mercurial SCM section                              #
# ---------------------------------------------------------------------------- #
#
# Read the file doc/syncmercurial.mdtext for more information
#

# Uncomment this line to enable the Mercurial support.
$cfg['allowed_scm']['mercurial'] = 'IDF_Scm_Mercurial';

# The path to mercurial repositories. '%s' is replaced with the project name.
$cfg['mercurial_repositories'] = '/home/mercurial/repositories/%s';

$cfg['mercurial_remote_url'] = 'http://example.com/hg/%s';

$cfg['idf_plugin_syncmercurial_hgrc'] = array(
    'web' => array('push_ssl' => 'false',
                 'allow_push' => '',
                 'description' => '',
                 'allow_archive' => 'bz2, zip, gz',
                 'style' => 'gitweb',
                 'contact' => ''),
    'hooks' => array(),
    'extensions' => array(),
);

# Based on the paths provided in the Apache configuration,
# you need to setup the following lines.
$cfg['idf_plugin_syncmercurial_passwd_file'] = '/home/mercurial/auth/.htpasswd';
$cfg['idf_plugin_syncmercurial_path'] = '/home/mercurial/repositories';
$cfg['idf_plugin_syncmercurial_private_notify'] = '/home/mercurial/tmp/notify.tmp';
$cfg['idf_plugin_syncmercurial_private_url'] = '/hg/%s';

# Authentification file for private repositories
$cfg['idf_plugin_syncmercurial_private_include'] = '/home/mercurial/scripts/private_indefero.conf';

# Password storage type (see 'doc/syncmercurial.mdtext')
# $cfg['idf_plugin_syncmercurial_passwd_mode'] = 'sha';


# ---------------------------------------------------------------------------- #
#                            Monotone SCM section                              #
# ---------------------------------------------------------------------------- #
#
# Read the file doc/syncmonotone.mdtext for more information
#

# Uncomment this line to enable the monotone support.
# $cfg['allowed_scm']['mtn'] = 'IDF_Scm_Monotone';

# The path to a specific database (local use) or a writable project
# directory (remote / usher use). '%s' is replaced with the project name.
$cfg['mtn_repositories'] = '/home/mtn/repositories/%s.mtn';

# The URL which is displayed as sync URL to the user and which is also
# used to connect to a remote usher.
$cfg['mtn_remote_url'] = 'mtn://example.com/%s';

# Whether the particular database(s) are accessed locally (via automate stdio)
# or remotely (via automate remote_stdio). 'remote' is the default for
# use with usher and the SyncMonotone plugin, while 'local' access should be
# choosed for manual setups and / or ssh access.
$cfg['mtn_db_access'] = 'local';

# Needs to be configured for remote / usher usage.
# This allows basic control of a running usher process via the forge
# administration. The variable must point to the full (writable)
# path of the usher configuration file which gets updated when new projects
# are added.
# $cfg['mtn_usher_conf'] = '/var/lib/usher/usher.conf';

# Full path to the directory tree which contains default configuration files
# that are automatically created for new projects. This is only needed
# if $cfg['mtn_db_access'] is set to remote, i.e. in case the SyncMonotone
# plugin should be used. If unset, it defaults to the tree underknees
# src/IDF/Plugin/SyncMonotone/. Don't forget the trailing slash!
# $cfg['mtn_confdir'] = '/path/to/dir/tree/';

# Additional configuration files you want to create / copy for new setups.
# All these file paths have to be relative to $cfg['mtn_confdir'].
# $cfg['mtn_confdir_extra'] = array('hooks.d/something.lua')


# ---------------------------------------------------------------------------- #
#                  Hacker section (for advanced users)                         #
# ---------------------------------------------------------------------------- #

$cfg['installed_apps'] = array('Pluf', 'IDF');

$cfg['pluf_use_rowpermission'] = true;

$cfg['middleware_classes'] = array(
         'Pluf_Middleware_Csrf',
         'Pluf_Middleware_Session',
         'IDF_Middleware',
         'Pluf_Middleware_Translation',
         );

$cfg['template_context_processors'] = array('IDF_Middleware_ContextPreProcessor');

$cfg['idf_views'] = dirname(__FILE__).'/urls.php';

# If you want to customize some of the template files, you must tell the
# template system where it can find your updated files by adding the particular
# folder to the following array.
$cfg['template_folders'] = array(
   dirname(__FILE__).'/../templates',
);

# You can customize the URL redirection after a login or logout action.
$cfg['login_success_url'] = $cfg['url_base'].$cfg['idf_base'];
$cfg['after_logout_page'] = $cfg['url_base'].$cfg['idf_base'];

# Set to true if uploaded public keys should not only be validated
# syntactically, but also by a specific backend. For SSH public
# keys, ssh-keygen(3) must be available and usable in the system PATH,
# for monotone public keys, the monotone binary (as configured above)
# is used.
$cfg['idf_strong_key_check'] = false;

# If you want to use another mime types database, enter its path here.
# $cfg['idf_mimetypes_db'] = '/etc/mime.types';

# Extentions of additional text files that should be displayed inline.
# $cfg['idf_extra_text_ext'] = 'ext1 ext2 ext3';

# If you can execute the needed shell commands to query information from your
# SCM, but the same shell commands do not work from within the indefero
# instance, this can be due to the environment variables not being set
# correctly. ATTENTION: Do not forget the trailing space!
# $cfg['idf_exec_cmd_prefix'] = '/usr/bin/env -i ';

# If you do not want to let indefero calculate the sizes of repositories,
# attachments, or downloads, set this to true. (You can temporarily set this
# to false in case you want to quickly check some size, of course.)
# $cfg['idf_no_size_check'] = false;

# The file extensions for file uploads (issues and downloads view) are limited.
# You can allow additional extensions here.
# $cfg['idf_extra_upload_ext'] = 'ext1 ext2';

# By default, the size of a single file upload is limited to 2MB.
# The php.ini upload_max_filesize and post_max_size configuration setting will
# always have precedence.
# $cfg['max_upload_size'] = 2097152; // Size in bytes

# If a download archive is uploaded, the size of the archive is limited to 20MB.
# The php.ini upload_max_filesize and post_max_size configuration setting will
# always have precedence.
# $cfg['max_upload_archive_size'] = 20971520; // Size in bytes

# Older versions of Indefero submitted a POST request to a configured
# post-commit web hook when new revisions arrived, whereas a PUT request
# would have been more appropriate.  Also, the payload's HMAC digest was
# submitted as value of the HTTP header 'Post-Commit-Hook-Hmac' during
# such a request.  Since newer versions of Indefero use the same authentication
# mechanism (based on the same secret key) for other web hooks of the same
# project as well, the name of this HTTP header was no longer appropriate 
# and as such changed to simply 'Web-Hook-Hmac'.
#
# Setting the following configuration option to 'compat' now restores the
# old behaviour in both cases. Please notice however that this compatibility
# option is likely to go away in the next major version of Indefero, so you
# should really change the other end of your web hooks!
$cfg['webhook_processing'] = 'compat';

# If IDF recalculates the activity index of the forge's projects, it does so
# by looking at the created and updated items in a particular tab / section
# for each project.
#
# You can now edit the weights that are applied to the calculation for each
# section in order to give other things more precendence. For example, if you
# do not use the documentation part to a great extent in most of your projects,
# you can weight this section lower and get an overall better activity value.
#
# If a section is removed, then activity in this section is neglected during
# the calculation. The same is true in case a section is disabled in the
# project administration.
$cfg['activity_section_weights'] = array(
    'source'    => 4,
    'issues'    => 2,
    'wiki'      => 2,
    'downloads' => 1,
    'review'    => 1,
);  

# Here you can define the timespan in days how long the activity calculation
# process should look into the history to get meaningful activity values for
# each project.
#
# If you have many low-profile projects in your forge, i.e. projects that only
# record very little activity, then it might be a good idea to bump this value
# high enough to show a proper activity index for those projects as well.
$cfg['activity_lookback'] = 7;

return $cfg;

