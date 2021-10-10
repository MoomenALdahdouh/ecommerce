<?php
include 'connect.php';
session_start();
include 'includes/functions/functions.php';

require __DIR__ . '/vendor/composer/autoload_real.php';
require __DIR__ . '/PayPalHttpClient.php';
$client = \Sample\PayPalClient::client();

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

if (isset($_SESSION['Username'])) {
    echo 'Username';
    if (isset($_POST['Total'])) {
        echo 'Total';
        $itemID = $_POST['ItemID'];
        $quantity = $_POST['Quantity'];
        $price = $_POST['Price'];
        $total = $_POST['Total'];
        $_SESSION['Total'] = $total;
        $now = new DateTime();
        $timestring = $now->format('Y-m-d');
        if (isset($_SESSION['order'])) {
            echo 'order';
            $count = 0;
            $isExist = false;
            foreach ($_SESSION['order'] as $order) {
                $count++;
                $itemid = $order['ItemID'];
                if ($itemid == $itemID) {
                    $isExist = true;
                    break;
                }
            }
            if ($isExist)
                echo 'exist';
            else {
                $_SESSION['order'][$count] = array('ItemID' => $itemID, 'Quantity' => $quantity, 'Price' => $price, 'Total' => $total, 'Date' => $timestring);
                echo orderNotification($itemID);
            }
        } else {
            //array_push($orderItems, $item);
            $_SESSION['order'][0] = array('ItemID' => $itemID, 'Quantity' => $quantity, 'Price' => $price, 'Total' => $total, 'Date' => $timestring);
            echo orderNotification($itemID);
        }

        //Check Method pay
        if (isset($_POST['method'])) {
            echo 'method';
            $payMethod = $_POST['method'];
            if ($payMethod == "Paypal") {
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
            } else {
                header("Location:myfatoorah.php");
            }
        }
    }
} else {
    header("refresh:0;url=login.php");
}



