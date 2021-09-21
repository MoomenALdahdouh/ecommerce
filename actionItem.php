<?php
//Firstly check if this user are exists
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecoca";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $itemID = $_POST['itemID'];
    $into = $_POST['into'];
    if (isset($_SESSION['Username'])) {
        $userID = $_SESSION['ID'];
        $check = isExist($into, 'itemID', $itemID);
        if (!isExist($into, 'itemID', $itemID)) {
            $stmt = $conn->prepare("INSERT INTO $into(UserID, itemID,Date) VALUES(:userID,:itemID,now())");
            $stmt->execute(array('userID' => $userID, 'itemID' => $itemID));
            echo 'true';
        } else {
            if ($into == 'wishes') {
                $stmt = $conn->prepare("DELETE FROM wishes WHERE itemID = :id");
                $stmt->bindParam(":id", $itemID);
                $stmt->execute();
            } else
                echo 'exist';
        }
    } else {
        echo 'false';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function isExist($from, $where, $value)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $from WHERE $where=?");
    $stmt->execute(array($value));
    if ($stmt->rowCount() > 0)
        return true;
    else
        return false;
}
