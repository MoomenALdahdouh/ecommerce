<?php
session_start();
$pageTitle = 'EcoExpress';
include 'selectLanguage.php';
require_once 'config.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    //Getting user Profile
    $gAuth = new Google_Service_Oauth2($client);
    $google_info = $gAuth->userinfo->get();
    $email = $google_info->email;
    $name = $google_info->name;
    $image = $google_info->picture;
    $_SESSION['GroupID'] = 0;
    $_SESSION['Username'] = $email;
    $_SESSION['FullName'] = $name;
    $_SESSION['Image'] = $image;
    $_SESSION['Email'] = $email;
}

if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    if ($_SESSION['GroupID'] == 0 || $groupID == 0) {//user
        include 'initmain.php';
        checkCartSession();
        include "indexhtml.php";
        registerUser($email,$email,$name,$image,'');
    } elseif ($_SESSION['GroupID'] == 1) {//admin
        header('Location: admin/dashboard.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 2) {//seller
        header('Location: seller/dashboard.php');//Redirect To Dashboard Page
    }
} else {
    include 'initmain.php';
    include "indexhtml.php";
}
