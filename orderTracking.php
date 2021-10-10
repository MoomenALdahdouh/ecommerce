<?php
ob_start();
session_start();
$pageTitle = 'Item';
include "initmain.php";
if (isset($_GET['itemid'])) {
    $itemID = $_GET['itemid'];
    //Here Get Item stats and fill data in tracing
}
?>
<div class="order-tracking">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Order Tracking</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="item-col col">
                        <p><span class="item-col-circle col float-start">1</span> Place Order</p>
                    </div>
                    <div class="item-col col">
                        <p><span class="item-col-circle col float-start">2</span> Pay Success</p>
                    </div>
                    <div class="item-col col">
                        <p><span class="item-col-circle col float-start">3</span> Shipment</p>
                    </div>
                    <div class="item-col col">
                        <p><span class="item-col-circle col float-start">4</span> Complete</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <ul>
                    <li>
                        <p>Order Number: <strong id="order-id"><?php echo $itemID;?></strong></p>
                    </li>
                    <li>
                        <p>Status: <strong id="order-status">Finished</strong></p>
                    </li>
                    <li>
                        <p><strong>Reminder:</strong> If you have already confirmed receiving your order, but you are
                            not happy with the
                            quality of the items or you have actually not received anything at all, then you can still
                            open a dispute up to 15 days after confirming "Order Received".</p>
                    </li>
                    <li>
                        <button class="btn btn-dark">Add To Cart</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
