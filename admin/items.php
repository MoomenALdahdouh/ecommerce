<?php
/*
 * You can Delete | Add | Edit categories from here
 */
ob_start();
session_start();
$pageTitle = 'Items';
if (isset($_SESSION['Username'])) {
    include 'init.php';
    //If the get page is exist get the page else get main page "Manage"
    $page = isset($_GET['page']) ? $_GET['page'] : 'Manage';
    if ($page == 'Manage') {
        include $initempg . 'manageItems.php';
    } elseif ($page == 'Edit') {
        include $initempg . 'editItems.php';
    } elseif ($page == 'Delete') {
        include $initempg . 'deleteItems.php';
    }  elseif ($page == 'Update') {
        include $initempg . 'updateItems.php';
    } elseif ($page == 'Add') {
        include $initempg . 'addItems.php';
    } elseif ($page == 'Insert') {
        include $initempg . 'insertItems.php';
    } else {
        echo 'error not found this page';
    }
} else {
    header('Location:login.php');
    exit();
}
ob_end_flush();//Release the Output