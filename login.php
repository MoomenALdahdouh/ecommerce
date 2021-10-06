<!--Home page to start admin section in the project
or you can use the same page for user but you must change the GroupID in the query $stmt -->
<?php

use PHPMailer\PHPMailer\PHPMailer;

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

/*if (isset($_GET['code'])) {
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
    registerAndSendVerificationCode($mail, $email, $email, $name, $image, '');
//Generate Code verification
    $mail = new PHPMailer(true);
}*/

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
    //Get Group ID for the user login
    if (!empty($username) && !empty($hashedPass)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE (Username = ? OR Email=?) AND Password = ? LIMIT 1");
        $stmt->execute(array($username, $username, $hashedPass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) { //Check if the account is exists
            $error = '';
            $sol = '';
            $groupID = $row['GroupID'];
            $_SESSION['Username'] = $username; //Register session name
            $_SESSION['ID'] = $row['UserID']; //Register session ID
            $_SESSION['GroupID'] = $groupID; //Register session GroupID
            $_SESSION['FullName'] = $row['FullName'];
            $_SESSION['Email'] = $row['Email'];
            //Select main windows to show for all custom user
            if ($groupID == 0) {//user
                header('Location: index.php');//Redirect To Dashboard Page
            } elseif ($groupID == 1) {//admin
                header('Location: admin/dashboard.php');//Redirect To Dashboard Page
            } elseif ($groupID == 2) {//seller
                header('Location: seller/dashboard.php');//Redirect To Dashboard Page
            }
            exit();
        } else {
            $error = "You have not account or write correct username and password";
            $sol = 'Register Now';
        }
    }
}
?>
<!--Start login box-->
<div class="login-body">
    <div class="login-box">
        <h2>Login</h2>
        <p class="text-danger"><?php echo $error; ?> <a
                    href='register.php'><strong> <?php echo $sol; ?></strong></a></p>
        <form class="form row" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <ul>
                <li>
                    <input class="form-control" type="text" name="username" placeholder="Username or Email"
                           autocomplete="off">
                </li>
                <li>
                    <input class="form-control" type="password" name="password" placeholder="Password"
                           autocomplete="off">
                </li>
                <li>
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

                </li>
                <li>
                    <input class="btn btn-primary button-css" type="submit" name="submit" value="SIGN IN">
                </li>
                <li>
                    <a href="<?php echo $authUrl; ?>" class="btn btn-danger button-google"><i
                                class="fa fa-google"></i> Sign In By Google</a>
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
