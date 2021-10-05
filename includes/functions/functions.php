<?php

/*Page Title*/
function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else
        echo "Page";
}

function getProducts()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM items");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductsLimit($limit)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM items LIMIT $limit");
    $stmt->execute();
    return $stmt->fetchAll();
}


function getCategories()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAds()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM ads");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getFromDB($from, $where, $value)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $from WHERE $where=?");
    $stmt->execute(array($value));
    return $stmt->fetch();
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

function isExistToValue($from, $where1, $where2, $value1, $value2)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $from WHERE $where1=? AND $where2=?");
    $stmt->execute(array($value1, $value2));
    if ($stmt->rowCount() > 0)
        return true;
    else
        return false;
}

function getAllFromDB($from, $where, $value)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $from WHERE $where=?");
    $stmt->execute(array($value));
    return $stmt->fetchAll();
}

function getSelectFromDB($select, $from, $where, $value)
{
    global $conn;
    $stmt = $conn->prepare("SELECT $select FROM $from WHERE $where=?");
    $stmt->execute(array($value));
    return $stmt->fetch();
}

/*Check if has cart items*/
function checkCartSession()
{
    global $conn;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $itemID = $item['itemID'];
            $date = $item['Date'];
            $quantity = $item['Quantity'];
            if (!isExist('cart', 'itemID', $itemID)) {
                $userID = $_SESSION['ID'];
                $stmt = $conn->prepare("INSERT INTO cart(UserID, itemID,Date,Quantity	) VALUES(:userID,:itemID,:date,:quantity)");
                $stmt->execute(array('userID' => $userID, 'itemID' => $itemID, 'date' => $date, 'quantity' => $quantity));
            }
        }
    }
}

/*add order in db */
function addOrders()
{
    global $conn;
    if (isset($_SESSION['Username'])) {
        $userID = $_SESSION['ID'];
        if (isset($_SESSION['order'])) {
            foreach ($_SESSION['order'] as $order) {
                $itemID = $order['ItemID'];
                $quantity = $order['Quantity'];
                $price = $order['Price'];
                $total = $order['Total'];
                $date = $order['Date'];
                /*if (!isExistToValue('order', 'ItemID', 'UserID', $itemID, $userID)) {*/
                /* $stmt = $conn->prepare("SELECT * FROM orders WHERE UserID=? AND ItemID =?");
                 $stmt->execute(array($userID, $itemID));
                 $count = $stmt->rowCount();
                 if ($count == 0) {*/
                $stmt = $conn->prepare("INSERT INTO orders(UserID, ItemID,Quantity,Price,Total,Date) VALUES(:userID,:itemID,:quantity, :price,:total ,:date)");
                $stmt->execute(array('userID' => $userID, 'itemID' => $itemID, 'quantity' => $quantity, 'price' => $price, 'total' => $total, 'date' => $date));
                decreasesItemQuantity($itemID, $quantity);
                //}
            }
            //unset($_SESSION['order']);
        }
    }
}

function decreasesItemQuantity($itemID, $quantity)
{
    global $conn;
    $stmt = $conn->prepare("SELECT Quantity FROM items WHERE itemID=?");
    $stmt->execute(array($itemID));
    $row = $stmt->fetch();
    $oldQuantity = $row['Quantity'];
    $newQuantity = $oldQuantity - $quantity;
    $stmt = $conn->prepare("UPDATE items SET Quantity = ? WHERE itemID = ?");
    $stmt->execute(array($newQuantity, $itemID));
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

function orderNotification($itemID)
{
    global $conn;
    if (isset($_SESSION['ID'])) {
        $userID = $_SESSION['ID'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE UserID=? AND ItemID =?");
        $stmt->execute(array($userID, $itemID));
        return $stmt->rowCount();
    } else if (isset($_SESSION['order'])) {
        $count = 0;
        foreach ($_SESSION['order'] as $order) {
            $count++;
        }
        return $count;
    }
}


function registerUser($username,$email, $name, $image, $password)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username=? OR Email=?");
    $stmt->execute(array($username, $email));
    if ($stmt->rowCount() == 0) {
        $stmt = $conn->prepare("INSERT INTO users(Username, Email,Password, FullName,RegStatus,Date,Image) VALUES(:username,:email,:password,:fullname,0,now(),:image)");
        $stmt->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'fullname' => $name,
            'image' => $image));
        $_SESSION['register'] = 'true';
    }else{
        $_SESSION['register'] = 'false';
    }
}