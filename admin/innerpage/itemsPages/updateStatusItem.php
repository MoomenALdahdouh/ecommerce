<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $itemID = $_POST['itemID'];
    //$itemStatus = $_POST['itemStatus'];
    $stmt = $conn->prepare("SELECT Status FROM items WHERE itemID = ?");
    $stmt->execute(array($itemID));
    $row = $stmt->fetch();
    $itemStatus = $row['Status'];
    if ($itemStatus == 0)
        $itemStatus = 1;
    else
        $itemStatus = 0;
    //Check user is exists
    $stmt = $conn->prepare("UPDATE items SET Status = ? WHERE itemID = ?");
    $stmt->execute(array( $itemStatus,$itemID));
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
