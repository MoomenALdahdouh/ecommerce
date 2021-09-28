<?php
require __DIR__ . '/vendor/composer/autoload_real.php';
require __DIR__ . '/PayPalHttpClient.php';
$client = \Sample\PayPalClient::client();

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

session_start();
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
    /*include "connect.php";
    include "initmain.php";
    include "indexhtml.php";*/

} catch (HttpException $ex) {
    echo $ex->statusCode;
    print_r($ex->getMessage());
}
