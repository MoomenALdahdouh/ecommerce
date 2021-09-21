<?php
/*if (isset($_SESSION['lang'])) {
    if ($_SESSION['lang'] == "en") {
        $_SESSION['lang'] = "ar";
    } elseif ($_SESSION['lang'] == "ar") {
        $_SESSION['lang'] = "en";
    }
}*/
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "en";
} else {
    if (isset($_GET['lang']) && !empty($_GET['lang'])) {
        if ($_GET['lang'] == "en") {
            $_SESSION['lang'] = "en";
        } elseif ($_GET['lang'] == "ar") {
            $_SESSION['lang'] = "ar";
        }
    }
}

