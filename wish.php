<?php
ob_start();
session_start();
$pageTitle = 'Cart';
include "initmain.php";
$count = 0;
$subtotal = 0;
$total = 0;
$shipping = 0;
?>
<div class="cart-header">
    <div class="container">
        <div class="row">
            <div class="col-one col-sm-12 col-md-6 col-lg-6">
                <ul>
                    <li>
                        <div class="header">
                            <h5>Wish List</h5>
                          <!--  <input type="checkbox" id="select" name="select" value="">
                            <label for="select"> Select all</label><br>-->
                        </div>
                        <div class="content">
                            <?php
                            if (isset($_SESSION['Username'])) {
                                $userID = $_SESSION['ID'];
                                $items = getAllFromDB('wishes', 'userID', $userID);
                            } else if (isset($_SESSION['wishes'])) {
                                $items = $_SESSION['wishes'];
                            }else
                                $items = array();
                            $subtotal = 0;
                            $total = 0;
                            $count = 0;
                            foreach ($items as $row) {
                                $count++;
                                $itemID = $row['itemID'];
                                $requestQuantity = 1;
                                $item = getFromDB('items', 'itemID', $itemID);
                                $img = $item['Image'];
                                $name = $item['Name'];
                                $price = $item['Price'];
                                $rating = $item['Rating'];
                                $quantity = $item['Quantity'];
                                $subtotal = $subtotal + ($price * $requestQuantity);
                                $total = $subtotal + $shipping;
                                echo '<div class="item-cart"><div class="row">';
                                echo "<div class='col-left col-sm-12 col-md-6 col-lg-6'><img class='card card-img-top' src='uploads/$img' alt=''></div>";
                                echo "<div class='col-right col-sm-12 col-md-6 col-lg-6 card-body'>
                                            <p>$name</p>
                                            <p>US $<strong id='item-price'>$price</strong></p>
                                            <p>Free Shippingvia Cainiao Super Economy</p>
                                            <input type='hidden' id='item-id' value='$itemID' />
                                            <button class='counter-minus btn btn-primary'>-</button>
                                            <input class='btn' name='input-quantity' id='input-quantity' type='text' value='$requestQuantity'>
                                            <button class='counter-plus btn btn-primary'>+</button>
                                            <button class='counter-delete btn btn-outline-danger'>DELETE</button>
                                            <!--<button class='btn btn-danger'><i class='fa fa-trash'></i></button>-->
                                            <p style='margin: 8px 0 0 0'>Additional 3% off (5 pieces or more)<br><span><strong id='avilabil-quantity'>$quantity</strong> pieces available</span></p>
                                            <p class='free-shipping'>Free Shipping</p>
                                            <button class='counter-buy btn btn-danger'>Buy from this seller</button>
                                            </div></div></div>";
                            }
                            include 'modalMessage.php';
                            if ($count == 0) { ?>
                                <img class="empty-cart" src="uploads/empty-cart.png">
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
                <h5>Order Summary</h5>
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
                <button id="buy-all-items" style="width: 100%;" class="counter-buy-summary btn btn-danger">BUY</button>
            </div>
        </div>
    </div>
</div>


