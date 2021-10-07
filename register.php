<!--Home page to start admin section in the project
or you can use the same page for user but you must change the GroupID in the query $stmt -->
<?php
session_start();//It's like share preference in android to save the user login or any other data
$noNavbar = '';//here this var to not allow showing navbar here
$pageTitle = 'Register'; //Name this page you need to include this line in all page in the project
include('initmain.php');//Include init page to include all path and another required includes must include this file in all page in the project
require_once "connect.php";
//----------------------------By Google-----------------------------
require_once "config.php";

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

$error = '';
$sol = '';
//----------------Check if login before-----------
if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    if ($_SESSION['GroupID'] == 0) {//user
        header('Location: index.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 1) {//admin
        header('Location: admin/dashboard.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 2) {//seller
        header('Location: seller/dashboard.php');//Redirect To Dashboard Page
    }
}
//----------------Register if click on register button--------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $hashedPass = sha1($password);
    //Get Group ID for the user login
    if (!empty($username) && !empty($hashedPass) && !empty($email)) {
        $mail = new PHPMailer(true);
        //Create an instance; passing `true` enables exceptions
        //generateVerificationCode($mail);
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
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }*/
        registerAndSendVerificationCode($mail, $username, $email, $fullname, '', $hashedPass);
        /*registerUser($username, $email, $fullname, '', $hashedPass,$verification_code);*/
        if (isset($_SESSION['register'])) {
            if ($_SESSION['register'] == 'false') {
                $error = "This account registered before!";
                $sol = 'Confirm Account';
            } else {
                $_SESSION['Username'] = $username;
                $_SESSION['FullName'] = $fullname;
                $_SESSION['Image'] = $image;
                $_SESSION['Email'] = $email;
                $_SESSION['GroupID'] = 0;
                $username = "";
                $password = "";
                $email = "";
                $fullname = "";
                $hashedPass = "";
                header("location:index.php");
                //Check status
                /* $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? OR Email=? AND RegStatus = ? LIMIT 1");
                 $stmt->execute(array($username,$email, '1'));
                 $row = $stmt->fetch();
                 $count = $stmt->rowCount();
                 if ($count > 0) {
                     header("location:index.php");
                 } else {
                $_SESSION['Verification'] = 'Account';
                     header("location:verification.php");
                 }*/

            }
        }
    } else {
        $error = "You have not account";
        $sol = 'Register Now';
    }
}
?>
<!--Start login box-->
<div class="login-body">
    <div class="login-box">
        <h2>Register</h2>
        <p class="text-danger"><?php echo $error; ?> <a
                    href='register.php'><strong> <?php echo $sol; ?></strong></a></p>
        <form class="form row" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <ul>
                <li>
                    <input class="form-control" type="text" name="username" placeholder="Username"
                           autocomplete="off">
                </li>
                <li>
                    <input class="form-control" type="text" name="fullname" placeholder="Full Name"
                           autocomplete="off">
                </li>
                <li>
                    <input class="form-control" type="email" name="email" placeholder="Email"
                           autocomplete="off">
                </li>
                <li>
                    <input class="form-control" type="password" name="password" placeholder="Password"
                           autocomplete="off">
                </li>
                <li>
                    <input class="btn btn-primary button-css" type="submit" name="submit" value="REGISTER">
                </li>
                <li>
                    <a href="<?php echo $authUrl; ?>" class="btn btn-danger button-google"><i
                                class="fa fa-google"></i> Register By Google</a>
                </li>
                <li>
                    <p style="margin-top: 20px">Has account? <a href="login.php">Login</a></p>
                </li>
            </ul>
        </form>
    </div>
</div>

<!--End login box-->

<!--to close the body html you must include the footer-->
<?php
include $tpl . 'footer.php';
?>
