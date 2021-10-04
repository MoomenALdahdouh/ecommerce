<?php
ob_start();
session_start();
$pageTitle = 'Item';
include "initmain.php";
if (isset($_GET['itemid'])) {
    $itemID = $_GET['itemid'];
    $item = getFromDB('items', 'itemID', $itemID);
    $name = $item['Name'];
    $description = $item['Description'];
    $price = $item['Price'];
    $image = $item['Image'];
    $rating = $item['Rating'];
    $quantity = $item['Quantity'];
}

$isExistWishes = isExist('wishes', 'itemID', $itemID);

?>
<div class="item">
    <div class="container-fluid">
        <div class="row">
            <div class="col-one col-sm-12 col-md-12 col-lg-4">
                <img src='uploads/<?php echo $image; ?>'>
            </div>
            <div class="col-two col-sm-12 col-md-12 col-lg-4">
                <div class="item-details text-start">
                    <div>
                        <h6><?php echo $name; ?></h6>
                    </div>
                    <div class="rating-body">
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5"/>
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4"/>
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3"/>
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2"/>
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1"/>
                            <label for="star1" title="text">1 star</label>
                        </div>
                        <span class="rating-value"><?php echo $rating; ?></span>
                    </div>
                    <div class="rating-detail-card container">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4 border-right">
                                    <div class="ratings text-center p-4 py-5"><span class="badge bg-success">4.1 <i
                                                    class="fa fa-star-o"></i></span> <span
                                                class="d-block about-rating">VERY GOOD</span>
                                        <span class="d-block total-ratings">183 ratings</span></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="rating-progress-bars p-3 mt-2">
                                        <div class="d-flex align-items-center"><span class="stars"> <span>5 <i
                                                            class="fa fa-star text-success"></i></span> </span>
                                            <div class="col px-2">
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 80%;" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span class="percent"> <span>80%</span> </span>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="stars"> <span>4 <i
                                                            class="fa fa-star text-custom"></i></span> </span>
                                            <div class="col px-2">
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar bg-custom" role="progressbar"
                                                         style="width: 65%;" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span class="percent"> <span>65%</span> </span>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="stars"> <span>3 <i
                                                            class="fa fa-star text-primary"></i></span> </span>
                                            <div class="col px-2">
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                         style="width: 55%;" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span class="percent"> <span>55%</span> </span>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="stars"> <span>2 <i
                                                            class="fa fa-star text-warning"></i></span> </span>
                                            <div class="col px-2">
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         style="width: 35%;" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span class="percent"> <span>35%</span> </span>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="stars"> <span>1 <i
                                                            class="fa fa-star text-danger"></i></span> </span>
                                            <div class="col px-2">
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: 65%;" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span class="percent"> <span>65%</span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="container margin-top">
                            <div class="handle-counter" id="handleCounter">
                                <input type='hidden' id='item-id' value='<?php echo $itemID; ?>'/>
                                <h3>USD $<span id="item-price"><?php echo $price; ?></span></h3>
                                <p>Quantity:</p>
                                <button class="counter-minus btn btn-primary">-</button>
                                <input class="btn" id="input-quantity" type="text" value="1">
                                <button class="counter-plus btn btn-primary">+</button>
                                <p>Additional 3% off (5 pieces or more)<br><span><strong
                                                id='avilabil-quantity'><?php echo $quantity; ?></strong> pieces available</span>
                                </p>
                                <strong>Shipping: US $131.33</strong>
                                <p>to Palestine via Fedex IP<br>Estimated Delivery: 7-15 days</p>

                                <?php include 'modalMessage.php'; ?>
                                <button itemID="<?php echo $itemID; ?>" id="buy-item" class="counter-buy btn btn-danger">Buy
                                    Now
                                </button>
                                <button itemID="<?php echo $itemID; ?>" id="cart-item" class="cart-button btn">Add
                                    to Cart
                                </button>
                                <button itemID="<?php echo $itemID; ?>" id="wish-item" class="wish-button btn">
                                    <i id="wish-item-icon" class="<?php
                                    if ($isExistWishes)
                                        echo "fas fa-heart text-danger";
                                    else
                                        echo "far fa-heart";
                                    ?>"></i>
                                    3555
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-three col-sm-12 col-md-12 col-lg-4">
                <p>Recommend for you</p>
                <div>
                    <?php
                    //print_r(getProducts()) ;
                    foreach (getProductsLimit(3) as $row) {
                        $img = $row['Image'];
                        $name = $row['Name'];
                        $price = $row['Price'];
                        $rating = $row['Rating'];
                        echo '<div class="text-center"><a class="href-item" href="">';
                        echo "<img class='card card-img-top' src='uploads/$img' alt=''> <div class='card-body'>";
                        echo "<h6>$price$</h6>  </div> </a></div>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Start Latest post-->
<div class="latest-item">
    <div class="container">
        <div class="row">
            <?php
            //print_r(getProducts()) ;
            foreach (getProducts() as $row) {
                $img = $row['Image'];
                $name = $row['Name'];
                $price = $row['Price'];
                $rating = $row['Rating'];
                $itemid = $row['itemID'];
                echo "<div class='item-cart col-sm-4 col-md-3 col-lg-2'> <a href='item.php?itemid=$itemid' class='card' >";
                /*echo '<div class="col-sm-4 col-md-3 col-lg-2">
                <a href="item.php?item="  target="_blank" class="card">';*/
                echo "<img class='card-img-top' src='uploads/$img' alt=''> <div class='card-body'>";
                echo "<p>$name</p>  <h5>$price$</h5>  </div> </a></div>";
            } ?>
        </div>
    </div>
</div>
<div style="background-color: #FFF">

</div>
<!--End Latest post-->