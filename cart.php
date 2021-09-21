<?php
ob_start();
session_start();
$pageTitle = 'Cart';
include "initmain.php";
if (isset($_SESSION['Username'])) {
    $userID = $_SESSION['ID']; ?>
    <div class="cart-header">
        <div class="container">
            <div class="row">
                <div class="col-one col-sm-12 col-md-6 col-lg-6">
                    <ul>
                        <li>
                            <div class="header">
                                <h5>Shopping Cart (1)</h5>
                                <input type="checkbox" id="select" name="select" value="">
                                <label for="select"> Select all</label><br>
                            </div>
                            <div class="content">
                                <?php
                                //print_r(getProducts()) ;
                                foreach (getAllFromDB('cart', 'userID', $userID) as $row) {
                                    $itemID = $row['itemID'];
                                    $item = getFromDB('items', 'itemID', $itemID);
                                    $img = $item['Image'];
                                    $name = $item['Name'];
                                    $price = $item['Price'];
                                    $rating = $item['Rating'];
                                    $quantity = $item['Quantity'];
                                    echo '<a href=""><div class="item-cart"><div class="row">';
                                    echo "<div class='col-left col-sm-12 col-md-6 col-lg-6'><img class='card card-img-top' src='uploads/$img' alt=''></div>";
                                    echo "<div class='col-right col-sm-12 col-md-6 col-lg-6 card-body'><p>$name</p><h6>$price$</h6>
                                        <p>Free Shippingvia Cainiao Super Economy</p>
                                        <div class='margin-top'>
                            <div class='handle-counter' id='handleCounter'>
                                <button class='counter-minus btn btn-primary'>-</button>
                                <input class='btn' id='input-quantity' type='text' value='1'>
                                <button class='counter-plus btn btn-primary'>+</button>
                                <p>Additional 3% off (5 pieces or more)<br><span><?php echo $quantity; ?> pieces available</span>
                                </p></div></div></div></div></div></a>";
                                } ?>

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
                        <dd>US $0.00</dd>
                    </dl>
                    <dl>
                        <dt> Shipping</dt>
                        <dd>US $0.00</dd>
                    </dl>
                    <dl>
                        <dt>Total</dt>
                        <dd>US $0.00</dd>
                    </dl>
                    <button class="btn btn-outline-danger">BUY</button>
                </div>
            </div>
        </div>
    </div>

    <?php
}