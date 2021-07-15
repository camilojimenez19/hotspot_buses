<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'hotspot_buses');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '283385642897-0g0m5qav0748j7pt87altorgbqvujm7q.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'xt31B-OnDig-q_4UhebgAB6s');
define('GOOGLE_REDIRECT_URL', 'Callback_URL');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'vendor/autoload.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Service_Oauth2($gClient);