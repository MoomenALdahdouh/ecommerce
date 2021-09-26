<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_POST['itemID'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE itemID = ? LIMIT 1");
    $stmt->execute(array($id));
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    $data= [
        'itemID' => $row['itemID'],
        'Name' => $row['Name'],
        'Description' => $row['Description'],
        'Price' => $row['Price'],
        'Date' => $row['Date'],
        'Country' => $row['Country'],
        'Rating' => $row['Rating'],
        'CatID' => $row['CatID'],
        'MemberID' => $row['MemberID']
    ];
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}