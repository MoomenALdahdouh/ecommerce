<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
session_start();
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $memberID = $_SESSION['ID'];
    $stmt = $conn->prepare("SELECT * FROM items WHERE MemberID = ?");
    $stmt->execute(array($memberID));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = [];
    foreach ($result as $row) {
        if ($row['Status'] == 1) {
            $control = "<button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#edit-item' type='button' id='edit-btn' itemID='$row[itemID]'>EDIT</button>
<button class='btn btn-danger' id='delete-btn' itemID='$row[itemID]'>DELETE</button>
<button class='btn btn-info' id='status-btn' itemID='$row[itemID]'>BLOCK</button>";
        } else if ($row['Status'] == 0) {
            $control = "<button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#edit-item' type='button' id='edit-btn' itemID='$row[itemID]'>EDIT</button>
<button class='btn btn-danger' id='delete-btn' itemID='$row[itemID]'>DELETE</button>
<button class='btn btn-info' id='status-btn' itemID='$row[itemID]'>ACTIVE</button>";
        }
        /*$control = "<a href='items.php?page=Edit&itemID="
            . $row['itemID'] . "' id='edit-btn' class='control-button btn btn-success'>Edit</a> <a href='items.php?page=Delete&itemID="
            . $row['itemID'] . "' id='delete-btn' class='control-button btn btn-danger confirm'>Delete</a>";*/
        $img = $row['Image'];
        $image = "<img src='../uploads/$img' alt='' width='50px' height='50px' >";
        $data["items"][] = [
            'itemID' => $row['itemID'],
            'Name' => $row['Name'],
            'Description' => $row['Description'],
            'Price' => $row['Price'],
            'Date' => $row['Date'],
            'Country' => $row['Country'],
            'Image' => $image,
            'Status' => $row['Status'],
            'Rating' => $row['Rating'],
            'CatID' => $row['CatID'],
            'MemberID' => $row['MemberID'],
            'Control' => $control
        ];
    }
    echo json_encode($data);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


