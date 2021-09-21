<!--This file for all path folders in my project-->
<?php

$lang = '../includes/languages/';
$tpl = 'includes/templates/';
$func = 'includes/functions/';
$lib = 'includes/libraries/';
$img = 'layout/images/';
$css = 'layout/css/';
$cssbot = '../layout/css/';
$js = 'layout/js/';
$jsbot = '../layout/js/';
$foaw = 'ttps://kit.fontawesome.com/deeee70e6c.js';
//$hefo = '../includes/templates/';
//Inner pages path
$inmempg = 'innerpage/membersPages/';
$incatpg = 'innerpage/categoriesPages/';
$initempg = 'innerpage/itemsPages/';

include '../connect.php';
include $func . 'functions.php';//All functions you need in the project
include $lang . 'english.php';//All Text in the project
include $tpl . 'header.php'; //Css file initialize and titles pages
include $tpl . 'navbar.php';//Top menu navbar
include $tpl . 'footer.php';//Script file initialize and Bottom content
//Check if the page was included this file does need show top nave bar and footer,
// so check if it's had a $noNavbar variable
/*if (!isset($noNavbar)) {
    include '../connect.php';
    include $tpl . 'navbar.php';//Top menu navbar
    include $tpl . 'footer.php';//Script file initialize and Bottom content
    //...add here...
    //... add any things you need in the includer page
}*/

?>
