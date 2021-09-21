<?php
//Firstly check if this user are exists
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM categories WHERE ID = ? LIMIT 1");
$stmt->execute(array($id));
$count = $stmt->rowCount();
if ($count > 0) {
//If exist delete this user
    $stmt = $conn->prepare("DELETE FROM categories WHERE ID = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    echo 'This Category was deleted successfully!';
} else
    echo 'Not Exist!';






