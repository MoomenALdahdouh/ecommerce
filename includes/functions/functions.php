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

function cartNotification()
{
    global $conn;
    if (isset($_SESSION['ID'])) {
        $userID = $_SESSION['ID'];
        $stmt = $conn->prepare("SELECT * FROM cart WHERE userID=?");
        $stmt->execute(array($userID));
        return $stmt->rowCount();
    }
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


