<?php
session_start();
$pageTitle = 'Home';
if (isset($_SESSION['GroupID'])) {
    $groupID = $_SESSION['GroupID'];
    if ($groupID == 0) {
        echo 'Welcome User';
        echo '<a class="dropdown-item" href="../logout.php">Logout</a>';
    }
} else
    header('Location: login.php');