<div id="modal-message" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3 class="modal-header btn-success">Add Successfully</h3>
            <div class="modal-body">
                <p>Similar</p>
                <div class="container">
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
            <div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="login-modal-message" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3 class="modal-header btn-success">Failed Add</h3>
            <div class="modal-body">
                <h6>Please Login or Register and try again!</h6>
            </div>
            <div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="exist-modal-message" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3 class="modal-header btn-success">Failed Add</h3>
            <div class="modal-body">
                <h6>This Item already add before!</h6>
            </div>
            <div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="buy-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <h3 class="modal-header btn-danger">Buy Order</h3>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div style="padding: 16px" class="cart-header">
                            <h5>Order Summary</h5>
                        </div>
                        <div style="padding: 0 16px" class="card-body">
                            <dl>
                                <dt id="Quantity"> Quantity</dt>
                                <dd id="quantity"></dd>
                            </dl>
                            <dl>
                                <dt id="Price"> Price</dt>
                                <dd id="price"></dd>
                            </dl>
                            <dl>
                                <dt id="Total">Total</dt>
                                <dd id="total"></dd>
                            </dl>
                        </div>
                        <div class="card-footer">
                            <form class="content" method="POST" action="founds.php">
                                <input id="itemID-founds" class="input" type="hidden" name="ItemID" value="">
                                <input id="quantity-founds" class="input" type="hidden" name="Quantity" value="">
                                <input id="price-founds" class="input" type="hidden" name="Price" value="">
                                <input id="total-founds" class="input" type="hidden" name="Total" value="0">
                                <input type="submit" id="buy-all-items" style="width: 100%;" class="btn btn-danger"
                                       value="CONFIRM AND BUY">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
