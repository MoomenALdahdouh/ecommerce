<!--Home page to start admin section in the project
or you can use the same page for user but you must change the GroupID in the query $stmt -->
<?php
session_start();//It's like share preference in android to save the user login or any other data
$noNavbar = '';//here this var to not allow showing navbar here
$pageTitle = 'Verification'; //Name this page you need to include this line in all page in the project
include('initmain.php');//Include init page to include all path and another required includes must include this file in all page in the project


//-----------------------------------------------------------------------

$error = '';
$sol = '';
//include 'connect.php';

/*if (isset($_SESSION['Username'])) { //Check If the admin login or not if is login so continue to next page 'dashboard page'
    if ($_SESSION['GroupID'] == 0) {//user
        header('Location: index.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 1) {//admin
        header('Location: admin/dashboard.php');//Redirect To Dashboard Page
    } elseif ($_SESSION['GroupID'] == 2) {//seller
        header('Location: seller/dashboard.php');//Redirect To Dashboard Page
    }
}*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verification_code = $_POST['verification_code'];
    //Get Group ID for the user login
    if (!empty($verification_code)) {
        $username = $_SESSION['Username'];
        $email = $_SESSION['Email'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? OR Email=? AND VerificationCode=? LIMIT 1");
        $stmt->execute(array($username, $email, $verification_code));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) { //Check if the account is exists
            if (isset($_SESSION['Verification'])) {
                if ($_SESSION['Verification'] == 'Password') {
                    $hashedPass = $_SESSION['HashPassword'];
                    $stmt = $conn->prepare("UPDATE users SET Password = ? WHERE (Email = ? OR Username=?)");
                    $stmt->execute(array($hashedPass, $email, $email));
                    unset($_SESSION['Username']);
                    unset($_SESSION['ID']);
                    unset($_SESSION['Email']);
                    unset($_SESSION['HashPassword']);
                    header('Location: login.php');
                } else if ($_SESSION['Verification'] == 'Account') {
                    $userID = $row['UserID'];
                    $stmt = $conn->prepare("UPDATE users SET RegStatus = ?,EmailVerfiedAt = now() WHERE UserID = ?");
                    $stmt->execute(array('1', $userID));
                    header("location:index.php");
                }
            }
        } else {
            $error = "You have not account or write correct username and password";
            $sol = 'Register Now';
        }
    } else
        $error = "Please Enter your code";
}
?>
<!--Start login box-->
<div class="login-body">
    <div class="login-box">
        <h2>Verification</h2>
        <p class="text-danger"><?php echo $error; ?> <a
                    href='register.php'><strong> <?php echo $sol; ?></strong></a></p>
        <form class="form row" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <ul>
                <li>
                    <input class="form-control" type="text" name="verification_code"
                           placeholder="Enter verification code"
                           autocomplete="off">
                </li>
                <li>
                    <input class="btn btn-primary button-css" type="submit" name="submit" value="CONFIRM">
                </li>
                <li>
                    <a href="redirect.php" style="width: 100%;" class="btn btn-outline-primary button-css">Back to
                        Home</a>
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
