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
        include 'item/manageItems.php';
    } elseif ($page == 'Edit') {
        include 'item/editItems.php';
    } elseif ($page == 'Delete') {
        include 'item/deleteItems.php';
    } elseif ($page == 'Update') {
        include 'item/updateItems.php';
    } elseif ($page == 'Add') {
        include 'item/addItems.php';
    } elseif ($page == 'Insert') {
        include 'item/insertItems.php';
    } else {
        echo 'error not found this page';
    }
} else {
    header('Location:login.php');
    exit();
}
ob_end_flush();//Release the Output