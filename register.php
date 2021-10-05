<!--Home page to start admin section in the project
or you can use the same page for user but you must change the GroupID in the query $stmt -->
<?php
session_start();//It's like share preference in android to save the user login or any other data
$noNavbar = '';//here this var to not allow showing navbar here
$pageTitle = 'Register'; //Name this page you need to include this line in all page in the project
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
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $hashedPass = sha1($password);
    //Get Group ID for the user login
    if (!empty($username) && !empty($hashedPass) && !empty($email)) {
        registerUser($username,$email,$fullname,'',$hashedPass);
        if (isset($_SESSION['register'])){
            if ($_SESSION['register'] == 'false'){
                $error = "This account registered before!";
            }else{
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
            }
        }
    }else{
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
                    <input class="form-control" type="text" name="username" placeholder="Username or Email"
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
