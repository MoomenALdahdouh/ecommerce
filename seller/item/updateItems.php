<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $itemID = $_POST['itemID'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $country = $_POST['country'];
    $rating = $_POST['rating'];
    $catID = $_POST['catID'];
    $memberID = $_POST['memberID'];
    //Check user is exists
    $stmt = $conn->prepare("UPDATE items SET Name = ?, Description = ?,Price = ?,Country = ?,Rating = ?,CatID = ?,MemberID = ? WHERE itemID = ?");
    $stmt->execute(array($name, $description, $price, $country, $rating, $catID, $memberID, $itemID));
    /*if ($stmt->execute(array($name, $description, $price, $country, $status, $rating, $catID, $memberID, $itemID))) {
        echo "<div class='alert alert-success'>Successfully Update</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed Update</div>";
    }*/
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
