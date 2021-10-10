<?php
ob_start();
session_start();
$pageTitle = 'My Orders';
include "initmain.php";
$count = 0;
$subtotal = 0;
$total = 0;
$shipping = 0;
?>
<div class="orders-header">
    <div class="container">
        <div class="row">
            <div class="col-one col-sm-12 col-md-6 col-lg-6">
                <ul>
                    <li>
                        <div class="header">
                            <h5>Shopping orders (1)</h5>
                            <input type="checkbox" id="select" name="select" value="">
                            <label for="select"> Select all</label><br>
                        </div>
                        <div class="content">
                            <?php
                            if (isset($_SESSION['Username'])) {
                                $userID = $_SESSION['ID'];
                                $items = getAllFromDB('orders', 'userID', $userID);
                            } else if (isset($_SESSION['orders'])) {
                                $items = $_SESSION['orders'];
                            } else
                                $items = array();
                            $subtotal = 0;
                            $total = 0;
                            $count = 0;
                            foreach ($items as $row) {
                                $count++;
                                $itemID = $row['ItemID'];
                                $requestQuantity = $row['Quantity'];
                                $quantity = $row['Quantity'];
                                $date = $row['Date'];
                                $price = $row['Price'];
                                $found = $quantity * $price;
                                $item = getFromDB('items', 'ItemID', $itemID);
                                $img = $item['Image'];
                                $name = $item['Name'];
                                $rating = $item['Rating'];
                                $subtotal = $subtotal + ($price * $requestQuantity);
                                $total = $subtotal + $shipping;
                                echo '<div class="item-orders"><div class="row">';
                                echo "<div class='col-left col-sm-12 col-md-6 col-lg-6'><img class='card card-img-top' src='uploads/$img' alt=''></div>";
                                echo "<div class='col-right col-sm-12 col-md-6 col-lg-6 card-body'>
                                            <p>Order ID:    $itemID <a style='color: #0a53be' href='orderTracking.php?itemid=$itemID'> View Detail</a></p>
                                            <p><strong>$name</strong></p>
                                            <h6 style='color: #be2429'>Buy Information:</h6>
                                            <p>Date of Buy: <strong id='date-of-buy'>$date</strong></p>
                                            <p>Price: US $<strong id='item-price'>$price</strong></p>
                                            <p>Quantity: <strong id='item-quantity'>$quantity</strong></p>
                                            <p>Founds: US $<strong id='item-founds'>$found</strong></p>
                                            <input type='hidden' id='item-id' value='$itemID' />
                                            <!--<button class='counter-delete-order btn btn-danger'>DELETE</button>-->
                                            </div></div></div>";
                            }
                            include 'modalMessage.php';
                            if ($count == 0) { ?>
                                <img class="empty-orders" src="uploads/empty-cart.png">
                            <?php }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="more-to-love">
                            <div class="body container">
                                <h5>More To Love</h5>
                                <div class="row">
                                    <?php
                                    foreach (getProductsLimit(4) as $row) {
                                        $img = $row['Image'];
                                        $name = $row['Name'];
                                        $price = $row['Price'];
                                        $rating = $row['Rating'];
                                        echo '<div class="item-product col-sm-6 col-md-6 col-lg-3"><a href="" class="card">';
                                        echo "<img class='card-img-top' src='uploads/$img' alt=''> <div class='card-body'>";
                                        echo "<h5>$price$</h5> </div> </a></div>";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-two col-sm-12 col-md-6 col-lg-6">
                <h5>Orders Summary</h5>
                <dl>
                    <dt> Subtotal</dt>
                    <dd>US $ <span id="subtotal"><?php echo $subtotal ?></span></dd>
                </dl>
                <dl>
                    <dt> Shipping</dt>
                    <dd>US $<span id="shipping"><?php echo $shipping ?></span></dd>
                </dl>
                <dl>
                    <dt>Total</dt>
                    <dd>US $<span id="total-summery"><?php echo $total ?></span></dd>
                </dl>
                <!--<button id="buy-all-items" style="width: 100%;" class="counter-buy-summary btn btn-danger">BUY</button>-->
            </div>
        </div>
    </div>
</div>


