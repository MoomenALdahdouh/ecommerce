<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['ID']);
unset($_SESSION['Email']);
header("location:index.php");