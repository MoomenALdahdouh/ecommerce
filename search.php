<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['query'])) {
        $inputText = $_POST['query'];
        search($inputText);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function search($inputText)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM items WHERE Name LIKE '%$inputText%'");
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        $itemID = $row['itemID'];
        $name = $row['Name'];
        echo '<a href="item.php?itemid=' . $itemID . '" class="list-group-item list-group-item-action border-1">' . $name . '</a>';
    }
}