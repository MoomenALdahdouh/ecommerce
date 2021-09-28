<?php
include 'connect.php';
session_start();
//$total = '5';
/*if (isset($_SESSION['Username'])) {

}*/


require __DIR__ . '/vendor/composer/autoload_real.php';
require __DIR__ . '/PayPalHttpClient.php';

$client = \Sample\PayPalClient::client();
// Construct a request object and set desired parameters
// Here, OrdersCreateRequest() creates a POST request to /v2/checkout/orders
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

if (isset($_POST['Total'])) {
    $total = $_POST['Total'];
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $items = [
        [
            "reference_id" => "test_ref_id1",
            "amount" => [
                "value" => $total,
                "currency_code" => "USD"
            ]
        ]
    ];
    $request->body = [
        "intent" => "CAPTURE",
        "purchase_units" => $items,
        "application_context" => [
            "cancel_url" => "http://localhost/ecommerce/cancel.php",
            "return_url" => "http://localhost/ecommerce/return.php"
        ]
    ];

    try {
        // Call API with your client and get a response for your call
        $response = $client->execute($request);

        // If call returns body in response, you can get the deserialized version from the result attribute of the response
        print_r($response);
        session_start();
        $_SESSION['paypal_items_id'] = strval($response->result->id);
        foreach ($response->result->links as $link) {
            if ($link->rel == "approve")
                header('location:' . $link->href);

        }
    } catch (HttpException $ex) {
        echo $ex->statusCode;
        print_r($ex->getMessage());
    }
}


