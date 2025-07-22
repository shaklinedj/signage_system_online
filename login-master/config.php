<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'carousel');

// Google App credentials
define('GOOGLE_CLIENT_ID', 'TU_CLIENT_ID');
define('GOOGLE_CLIENT_SECRET', 'TU_CLIENT_SECRET');
define('GOOGLE_REDIRECT_URL', 'http://localhost/login-master/google-callback.php');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
