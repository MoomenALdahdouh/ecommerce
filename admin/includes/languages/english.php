<?php
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
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    );
    return $lang[$phrase];
}