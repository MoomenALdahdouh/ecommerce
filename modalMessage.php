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
