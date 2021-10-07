<?php
require __DIR__ . '/vendor/composer/autoload_real.php';
require __DIR__ . '/PayPalHttpClient.php';
$client = \Sample\PayPalClient::client();

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

session_start();
include 'connect.php';
include 'includes/functions/functions.php';

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
// Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
// $response->result->id gives the orderId of the order created above
$request = new OrdersCaptureRequest($_SESSION['paypal_items_id']);
$request->prefer('return=representation');
try {
    // Call API with your client and get a response for your call
    $response = $client->execute($request);

    // If call returns body in response, you can get the deserialized version from the result attribute of the response
    //print_r($response);

    echo '<h4 class="btn btn-success text-center" style="margin: 0">Successfully Founds!</h4>';
    addOrders();
    $mail = new PHPMailer(true);
    $name = $_SESSION['FullName'];
    $email = $_SESSION['Email'];
    $userID = $_SESSION['ID'];
    $count = 0;
    foreach ($_SESSION['order'] as $order) {
        $itemID = $order['ItemID'];
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $cart) {
                if ($itemID == $cart['itemID']) {
                    unset($_SESSION['cart'][$count]);
                }
                $count++;
            }
            $conn->prepare("DELETE FROM cart WHERE itemID = $itemID AND UserID=$userID")->execute();
        } else {
            $conn->prepare("DELETE FROM cart WHERE itemID = $itemID AND UserID=$userID")->execute();
        }
        sendEmailBuyOrder($mail, $email, $name, $itemID);
    }
    /*echo "<a class='btn btn-danger' href='index.php'>Go Home!</a>";*/
    /*include "connect.php";
    include "initmain.php";
    include "indexhtml.php";*/
    header("location:orders.php");
} catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}
