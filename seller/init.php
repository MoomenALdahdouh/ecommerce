<?php
$lang = '../includes/languages/';
$tpl = 'includes/templates/';
$func = 'includes/functions/';
$lib = 'includes/libraries/';
$img = 'layout/images/';
$css = 'layout/css/';
$jss = 'layout/js/';

$cssboot = '../layout/css/';
$jsboot = '../layout/js/';

//Check if the page was included this file does need show top nave bar and footer,
// so check if it's had a $noNavbar variable
include '../connect.php';
include $func . 'functions.php';//All functions you need in the project
include $lang . 'english.php';//All Text in the project
include $tpl . 'header.php'; //Css file initialize and titles pages
include $tpl . 'navbar.php';//Top menu navbar
include $tpl . 'footer.php';//Script file initialize and Bottom content
//...add here...
//... add any things you need in the includer page


?>
