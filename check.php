<?php
session_start();
include 'connect.php';
echo 'whelcom';
$conn->prepare("DELETE FROM cart WHERE itemID = '9' AND UserID='29'")->execute();

/*
if (isset($_SESSION['order'])) {
    echo 'exist';
    $count = 0;
    $itemID = 9;
    foreach ($_SESSION['order'] as $order) {
        $itemID = $order['ItemID'];
        $quantity = $order['Quantity'];
        $price = $order['Price'];
        $total = $order['Total'];
        $date = $order['Date'];
    }
} else {
    echo 'not exist';
}*/

