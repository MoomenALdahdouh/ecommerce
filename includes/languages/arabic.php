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
        'administrator' => 'المسؤول',
        'welcome' => 'مرحبا',
        'home' => 'الصفحة الرئيسية',
        'categories' => 'الأقسام',
        'items' => 'المنتجات',
        'members' => 'الأعضاء',
        'statistics' => 'الإحصائيات',
        'logs' => 'السجلات',
        'blog' => 'المدونة',
        'language' => 'اللغة',
        'en' => 'EN',
        'ar' => 'AR',
    );
    return $lang[$phrase];
}