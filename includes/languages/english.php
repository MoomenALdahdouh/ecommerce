<?php
/*if (!isset($_SESSION['lang']))
    $_SESSION['lang'] = 'en';
elseif(isset($_GET['lang'])&& $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
    if ($_GET['lang'] == "en")
        $_SESSION['lang'] = "en";
    elseif($_GET['lang'] == "ar"){
        $_SESSION['lang'] = "ar";
    }
    echo $_SESSION['lang'];
}*/
function lang($phrase)
{
    static $lang = array(
        /*Input all string in you site here*/
        'administrator' => 'Administrator',
        'welcome' => 'Welcome',
        'home' => 'Home',
        'categories' => 'Categories',
        'items' => 'Items',
        'members' => 'Members',
        'statistics' => 'Statistics',
        'logs' => 'Logs',
        'blog' => 'Blog',
        'language' => 'Language',
        'en' => 'EN',
        'ar' => 'AR',
    );
    return $lang[$phrase];
}