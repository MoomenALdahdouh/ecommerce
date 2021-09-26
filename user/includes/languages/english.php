<?php
function lang($phrase)
{
    static $lang = array(
        /*Input all string in you site here*/
        'administrator' => 'Administrator',
        'welcome' => 'Welcome'
    );
    return $lang[$phrase];
}