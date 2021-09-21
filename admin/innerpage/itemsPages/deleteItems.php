<?php
//Firstly check if this user are exists
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $itemID = $_POST['itemID'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE itemID = ? LIMIT 1");
    $stmt->execute(array($itemID));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $conn->prepare("DELETE FROM items WHERE itemID = :id");
        $stmt->bindParam(":id", $itemID);
        $stmt->execute();
        echo 'This Category was deleted successfully!';
    } else
        echo 'Not Exist!';
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}





