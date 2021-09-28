<?php
session_start();
$pageTitle = 'EcoExpress';
include 'selectLanguage.php';
if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    if ($_SESSION['GroupID'] == 0) {//user
        include 'initmain.php';
        checkCartSession();
        include "indexhtml.php";
    } elseif ($_SESSION['GroupID'] == 1) {//admin
        header('Location: admin/dashboard.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 2) {//seller
        header('Location: seller/dashboard.php');//Redirect To Dashboard Page
    }
} else {
    include 'initmain.php';
    include "indexhtml.php";
}