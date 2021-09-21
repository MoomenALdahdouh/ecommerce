<?php
include 'connect.php';

$lang = 'includes/languages/';
$tpl = 'includes/templates/';
$func = 'includes/functions/';
$css = 'layout/css/';
$js = 'layout/js/';
$foaw = 'ttps://kit.fontawesome.com/deeee70e6c.js';
include $func . 'functions.php';//All functions you need in the project
if (isset($_SESSION['lang'])) {
    if ($_SESSION['lang'] == "en") {
        include $lang . 'english.php';
        //echo "ENGLISH";
    } elseif ($_SESSION['lang']== "ar") {
        include $lang . 'arabic.php';
       // echo "ARABIC";
    }
}
//include $lang . 'english.php';//All Text in the project
include $tpl . 'header.php'; //Css file initialize and titles pages
//include $tpl . 'footer.php';//Script file initialize and Bottom content
if (!isset($noNavbar)) {
    include 'connect.php';
    include $tpl . 'navbar.php';//Top menu navbar
    include $tpl . 'footer.php';//Script file initialize and Bottom content
    //...add here...
    //... add any things you need in the includer page
}