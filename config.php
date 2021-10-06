<?php
//session_start();
require_once 'google/vendor/autoload.php';
/*require_once 'google/Client.php';
require_once 'google/Service/Analytics.php';*/

$clientID = "832860764663-n5na5dsl67a37o33a1qg1633emfv14t5.apps.googleusercontent.com";
$clientSecret = "PKX7gGHiUhkUTw14332D3a0x";
$redirectUrl = "http://localhost/ecommerce/index.php";

$client = new Google_Client();
//$client->setApplicationName("Client_Library_Examples");
//$client->setDeveloperKey("{devkey}");
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email');
$authUrl = $client->createAuthUrl();
