<?php
require __DIR__ . '/vendor/composer/autoload_real.php';
require __DIR__ . '/PayPalHttpClient.php';
$client = \Sample\PayPalClient::client();

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

session_start();
include 'connect.php';
include 'includes/functions/functions.php';
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
            $stmt = $conn->prepare("DELETE FROM cart WHERE itemID = :itemID");
            $stmt->bindParam(":itemID", $itemID);
            $stmt->execute();
        } else {
            $stmt = $conn->prepare("DELETE FROM cart WHERE itemID = :itemID");
            $stmt->bindParam(":itemID", $itemID);
            $stmt->execute();
        }
    }
    echo "<a class='btn btn-danger' href='index.php'>Go Home!</a>";
    /*include "connect.php";
    include "initmain.php";
    include "indexhtml.php";*/
    header("refresh:3;url=orders.php");
} catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}
