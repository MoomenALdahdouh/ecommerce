<?php
session_start();
$pageTitle = 'EcoExpress';
include 'selectLanguage.php';
//Sync google account
require_once 'config.php';
//include 'connect.php';
//include 'includes/functions/functions.php';
//-------------------------Verification mail -------------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
//Load Composer's autoloader
require 'vendor/autoload.php';
//-----------------------------------------------------------------------
//Check if the user make login by google
$isByGoogle = false;
if (isset($_GET['code'])) {
    $isByGoogle = true;
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    //Getting user Profile
    $gAuth = new Google_Service_Oauth2($client);
    $google_info = $gAuth->userinfo->get();
    $email = $google_info->email;
    $name = $google_info->name;
    $image = $google_info->picture;
    $_SESSION['GroupID'] = 0;
    $_SESSION['Username'] = $email;
    $_SESSION['FullName'] = $name;
    $_SESSION['Image'] = $image;
    $_SESSION['Email'] = $email;
    $mail = new PHPMailer(true);
    //Generate Code verification
    /*try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'user@example.com';                     //SMTP username
        $mail->Password = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $verification_code = substr(number_format(time() * rand(), 0, '', '', ''), 0, 6);
        $mail->Subject = 'Email verification';
        $mail->Body = 'Your verification code is <b>' . $verification_code . '</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }*/
}
/*if ($isByGoogle) {

} else {

}*/
if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    include 'connect.php';
    $username = $_SESSION['Username'];
    $email = $_SESSION['Email'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? OR Email=? LIMIT 1");
    $stmt->execute(array($username, $email));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $regStatus = $row['RegStatus'];
        if ($regStatus == 1) {
            if ($_SESSION['GroupID'] == 0) {//user
                include 'initmain.php';
                include "indexhtml.php";
                checkCartSession();
                //Here when user login by google, so we create account for him automatic
                //registerUser($email,$email,$name,$image,'',$verification_code);
            } elseif ($_SESSION['GroupID'] == 1) {//admin
                header('Location: admin/dashboard.php');//Redirect To Dashboard Page
            } elseif ($_SESSION['GroupID'] == 2) {//seller
                header('Location: seller/dashboard.php');//Redirect To Dashboard Page
            }
        } else {
            $_SESSION['Verification'] = 'Account';
            header("location:verification.php");
        }
    } else {
        include 'connect.php';
        include 'includes/functions/functions.php';
        registerAndSendVerificationCode($mail, $email, $email, $name, $image, '');
        header('Location: index.php');
    }

} else {
    include 'initmain.php';
    include "indexhtml.php";
}
