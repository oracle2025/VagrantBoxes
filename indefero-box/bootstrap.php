<?php
require '/home/www/indefero/src/IDF/conf/path.php';
require 'Pluf.php';
Pluf::start('/home/www/indefero/src/IDF/conf/idf.php');
Pluf_Dispatcher::loadControllers(Pluf::f('idf_views'));

$user = new Pluf_User();
$user->first_name = 'John';
$user->last_name = 'Doe'; // Required!
$user->login = 'admin'; // must be lowercase!
$user->email = 'admin@example.com';
$user->password = 'yourpassword'; // the password is salted/hashed 
                                  // in the database, so do not worry :)
$user->administrator = true;
$user->active = true;
$user->create();
print "Bootstrap ok\n";
?>