<?php
session_start();
include 'connect.php';
echo 'whelcom';
if (!isset($_SESSION['order'])) {
    foreach ($_SESSION['order'] as $order) {
        $total = $total + $order['Total'];
        echo $total;
    }
}
