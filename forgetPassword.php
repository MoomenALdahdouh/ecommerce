<!--Home page to start admin section in the project
or you can use the same page for user but you must change the GroupID in the query $stmt -->
<?php
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


session_start();//It's like share preference in android to save the user login or any other data
$noNavbar = '';//here this var to not allow showing navbar here
$pageTitle = 'Login'; //Name this page you need to include this line in all page in the project
include('initmain.php');//Include init page to include all path and another required includes must include this file in all page in the project
require_once "connect.php";
require_once "config.php";

//-----------------------------------------------------------------------

$error = '';
$sol = '';
//include 'connect.php';

if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    if ($_SESSION['GroupID'] == 0) {//user
        header('Location: index.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 1) {//admin
        header('Location: admin/dashboard.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 2) {//seller
        header('Location: seller/dashboard.php');//Redirect To Dashboard Page
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);
    $_SESSION['Email'] = $username;
    $_SESSION['Username'] = $username;
    $_SESSION['HashPassword'] = $hashedPass;
    //Get Group ID for the user login
    if (!empty($username) && !empty($hashedPass)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? OR Email=? LIMIT 1");
        $stmt->execute(array($username,$username));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) { //Check if the account is exists
            $userID = $row['UserID'];
            $email = $row['Email'];
            $name = $row['FullName'];
            $mail = new PHPMailer(true);
            sendEmail($mail,$email,$name);
            header('Location: verification.php');
            /*$stmt = $conn->prepare("UPDATE users SET Password = ? WHERE UserID = ?");
            $stmt->execute(array($hashedPass, $userID));
            header('Location: login.php');*/
        } else {
            $error = "You have not account";
            $sol = 'Register Now';
        }
    }
}
?>
<!--Start login box-->
<div class="login-body">
    <div class="login-box">
        <h2>Change Password</h2>
        <p class="text-danger"><?php echo $error; ?> <a
                    href='register.php'><strong> <?php echo $sol; ?></strong></a></p>
        <form class="form row" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <ul>
                <li>
                    <input class="form-control" type="text" name="username" placeholder="Username or Email"
                           autocomplete="off">
                </li>
                <li>
                    <input class="form-control" type="password" name="password" placeholder="New Password"
                           autocomplete="off">
                </li>
                <!--<li>
                    <div class="container">
                        <div class="row">
                            <div class="for-reg col text-start">
                                <a class="register" href="register.php">Register Now!</a>
                            </div>
                            <div class="for-reg col text-end">
                                <a class="forget-password" href="forgetPassword.php">Forget Password</a>
                            </div>
                        </div>
                    </div>

                </li>-->
                <li>
                    <input class="btn btn-primary button-css" type="submit" name="submit" value="CONFIRM">
                </li>
                <!--<li>
                    <a href="<?php /*echo $authUrl; */?>" class="btn btn-danger button-google"><i
                                class="fa fa-google"></i> Sign In By Google</a>
                </li>-->
            </ul>
        </form>
    </div>
</div>

<!--End login box-->

<!--to close the body html you must include the footer-->
<?php
include $tpl . 'footer.php';
?>
