<h1>Manage Items</h1>
<div class="container">
    <div class="table-responsive">
        <h5 class="alert-info alert message-item"></h5>
        <table id="items-table" class="main-table-item table table-bordered row-border text-center">
            <thead>
            <tr class="table-header">
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Adding Date</th>
                <th>Country</th>
                <th>Rating</th>
                <th>Cat ID</th>
                <th>Member ID</th>
                <th>Control</th>
            </tr>
            </thead>
        </table>
    </div>
    <!--<a href="items.php?page=Add" class="btn btn-primary"><i class="fa fa-pulse"></i><strong>+</strong> Add New
        Item</a>-->
    <button id="add-new-item" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#add-item">Add New Item
    </button>
    <?php include 'addItems.php'; include 'editItems.php'; ?>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>


