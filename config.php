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
//$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));

/*if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    //Getting user Profile
    $gAuth = new Google_Service_Oauth2($client);
    $google_info = $gAuth->userinfo->get();
    $email = $google_info->email;
    $name = $google_info->name;
    $image = $google_info->picture;
    $_SESSION['Username'] = $name;
    $_SESSION['Image'] = $image;
    $_SESSION['Email'] = $email;
}else{
    $authUrl = $client->createAuthUrl();
    //echo "<a href='".$client->createAuthUrl()."'>Login with Google</a>";
}*/


//-------------------------------------------
/*
//For loging out.
if (isset($_GET['logout'])){
    if ($_GET['logout'] == "1") {
        unset($_SESSION['token']);
    }
}

// Step 2: The user accepted your access now you need to exchange it.
if (isset($_GET['code'])) {

    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

// Step 1:  The user has not authenticated we give them a link to login
if (!$client->getAccessToken() && !isset($_SESSION['token'])) {
    $authUrl = $client->createAuthUrl();
    //print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

// Step 3: We have access we can now create our service
if (isset($_SESSION['token'])) {
    print "<a class='logout' href='".$_SERVER['PHP_SELF']."?logout=1'>LogOut</a><br>";
    $client->setAccessToken($_SESSION['token']);
    $service = new Google_Service_Analytics($client);

    // request user accounts
    $accounts = $service->management_accountSummaries->listManagementAccountSummaries();

    foreach ($accounts->getItems() as $item) {
        echo "Account: ",$item['name'], "  " , $item['id'], "<br /> \n";
        foreach($item->getWebProperties() as $wp) {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WebProperty: ' ,$wp['name'], "  " , $wp['id'], "<br /> \n";

            $views = $wp->getProfiles();
            if (!is_null($views)) {
                foreach($wp->getProfiles() as $view) {
                    //  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View: ' ,$view['name'], "  " , $view['id'], "<br /> \n";
                }
            }
        }
    } // closes account summaries

}
print "Access from google: " . $_SESSION['token'];*/
