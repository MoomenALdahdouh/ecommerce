<?php

/*Page Title*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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


function registerUser($username, $email, $name, $image, $password, $verification_code)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username=? OR Email=?");
    $stmt->execute(array($username, $email));
    if ($stmt->rowCount() == 0) {
        $stmt = $conn->prepare("INSERT INTO users(Username, Email,Password, FullName,RegStatus,Date,Image,VerificationCode) VALUES(:username,:email,:password,:fullname,0,now(),:image,:verificationCode)");
        $stmt->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'fullname' => $name,
            'image' => $image,
            'verificationCode' => $verification_code));
        $_SESSION['register'] = 'true';
    } else {
        $_SESSION['register'] = 'false';
    }
}

function registerAndSendVerificationCode($mail, $username, $email, $name, $image, $password)
{
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'msssa875@gmail.com';                     //SMTP username
        $mail->Password = 'moomen.88';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('msssa875@gmail.com', 'EcoExpress.com');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->isHTML(true);                                  //Set email format to HTML
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Subject = 'Email verification';
        $mail->Body = 'Your verification code is <b>' . $verification_code . '</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        registerUser($username, $email, $name, $image, $password, $verification_code);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendEmail($mail, $email, $name)
{
    global $conn;
    try {
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'msssa875@gmail.com';                     //SMTP username
        $mail->Password = 'moomen.88';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('msssa875@gmail.com', 'EcoExpress.com');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->isHTML(true);                                  //Set email format to HTML
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Subject = 'Email verification';
        $mail->Body = 'Your verification code is <b>' . $verification_code . '</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        $stmt = $conn->prepare("UPDATE users SET VerificationCode = ? WHERE (Email = ? OR Username=?)");
        $stmt->execute(array($verification_code, $email, $email));
        $_SESSION['Verification'] = 'Password';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendEmailBuyOrder($mail, $email, $name, $orderId)
{
    global $conn;
    try {
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'msssa875@gmail.com';                     //SMTP username
        $mail->Password = 'moomen.88';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('msssa875@gmail.com', 'EcoExpress.com');
        $mail->addAddress($email, $name);     //Add a recipient
        $mail->isHTML(true); //Set email format to HTML
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $mail->Subject = 'Good news regarding your order';
        $mail->Body = '<a href="http://localhost/ecommerce/">
                           <h3><span style="color: #f89500">Eco</span><span style="color: #c91e1e">Express</span></h3>
                       </a>
                       <strong>Expect to see your package soon!</strong><br>
                       <p>Hi ' . $name . '</p><br>
                       <p>Order <a href="http://localhost/ecommerce/item.php?itemid=' . $orderId . '">35' . $orderId . '89</a> has been shipped! You can click below to track your package, check delivery status or see more details.</p>
                       <p>(Note: It may take up to 24 hours to see tracking information.)</p>
                       <p>If you have any questions, please <a href="http://localhost/ecommerce/support.php"><strong>let us know!</strong></a></p><br>
                       <iframe width="200" height="200" src="http://localhost/ecommerce/item.php?itemid=' . $orderId . '" title="Order"></iframe>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        $stmt = $conn->prepare("UPDATE users SET VerificationCode = ? WHERE (Email = ? OR Username=?)");
        $stmt->execute(array($verification_code, $email, $email));
        $_SESSION['Verification'] = 'Password';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}