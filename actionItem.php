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
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $itemID = $_POST['itemID'];
        $quantity = $_POST['quantity'];
        switch ($action) {
            case 'addToCart':
                addToCart($conn, $itemID, $quantity);
                break;
            case 'addToWishes':
                addToWishes($conn, $itemID);
                break;
            case 'remove':
                removeFromCart($conn, $itemID);
                break;
            case 'buy':
                buyFromCart($conn, $itemID, $quantity);
                break;
        }

    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function buyFromCart()
{

}

function removeFromCart()
{

}

function addToCart($conn, $itemID, $quantity)
{
    if (isset($_SESSION['Username'])) {
        $userID = $_SESSION['ID'];
        if (!isExist('cart', 'itemID', $itemID)) {
            $stmt = $conn->prepare("INSERT INTO cart(UserID, itemID,Date) VALUES(:userID,:itemID,now())");
            $stmt->execute(array('userID' => $userID, 'quantity' => $quantity, 'itemID' => $itemID));
            echo cartNotification();
        }else
            echo 'exist';
    } else {
        $now = new DateTime();
        $timestring = $now->format('Y-m-d');
        if (isset($_SESSION['cart'])) {
            $count = 0;
            $isExist = false;
            foreach ($_SESSION['cart'] as $cart) {
                $count++;
                $itemid = $cart['itemID'];
                if ($itemid == $itemID) {
                    $isExist = true;
                    break;
                }
            }
            if ($isExist)
                echo 'exist';
            else {
                $_SESSION['cart'][$count] = array('itemID' => $itemID, 'quantity' => $quantity, 'Date' => $timestring);
                echo cartNotification();
            }
        } else {
            //array_push($cartItems, $item);
            $_SESSION['cart'][0] = array('itemID' => $itemID, 'quantity' => $quantity, 'Date' => $timestring);
            echo cartNotification();
        }
    }
}

function addToWishes($conn, $itemID)
{
    if (isset($_SESSION['Username'])) {
        $userID = $_SESSION['ID'];
        if (!isExist('wishes', 'itemID', $itemID)) {
            $stmt = $conn->prepare("INSERT INTO wishes(UserID, itemID,Date) VALUES(:userID,:itemID,now())");
            $stmt->execute(array('userID' => $userID, 'itemID' => $itemID));
            echo 'add';
        } else {
            $stmt = $conn->prepare("DELETE FROM wishes WHERE itemID = :id");
            $stmt->bindParam(":id", $itemID);
            $stmt->execute();
            echo 'remove';
        }
    }else{
        echo 'false';
    }
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

function cartNotification()
{
    global $conn;
    if (isset($_SESSION['ID'])) {
        $userID = $_SESSION['ID'];
        $stmt = $conn->prepare("SELECT * FROM cart WHERE userID=?");
        $stmt->execute(array($userID));
        return $stmt->rowCount();
    } else if (isset($_SESSION['cart'])) {
        $count = 0;
        foreach ($_SESSION['cart'] as $cart) {
            $count++;
        }
        return $count;
    }
}
