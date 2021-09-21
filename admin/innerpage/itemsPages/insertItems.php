<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $country = $_POST['country'];
    $image = $_POST['image'];
    $stmt = $conn->prepare("INSERT INTO items(Name, Description,Price, Date,Country,Image,Status,Rating,CatID,MemberID) VALUES(:name,:description,:price,now(),:country,:image,0,0,1,27)");
    $stmt->execute(array(
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'country' => $country,
        'image' => $image));
    //include "uploadImageItem.php";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}