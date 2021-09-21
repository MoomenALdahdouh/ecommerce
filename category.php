<?php
ob_start();
session_start();
$pageTitle = 'Category';
include "initmain.php";
if (isset($_GET['category'])) {
    $categoriesID = $_GET['category'];
    $category = getFromDB('categories', 'ID', $categoriesID);
    $catName = $category['Name'];
    ?>
    <div class="latest-post">
        <div class="body container">
            <h4><?php echo $catName?></h4>
            <br>
            <div class="row">
                <?php
                //print_r(getProducts()) ;
                foreach (getAllFromDB('items', 'CatID', $categoriesID) as $row) {
                    $img = $row['Image'];
                    $name = $row['Name'];
                    $price = $row['Price'];
                    $rating = $row['Rating'];
                    $itemid = $row['itemID'];
                    echo "<div class='col-sm-4 col-md-3 col-lg-2'> <a href='item.php?itemid=$itemid' class='card' >";
                    /*echo '<div class="col-sm-4 col-md-3 col-lg-2">
                    <a href="item.php?item="  target="_blank" class="card">';*/
                    echo "<img class='card-img-top' src='uploads/$img' alt=''> <div class='card-body'>";
                    echo "<p>$name</p>  <h5>$price$</h5>  </div> </a></div>";
                } ?>
            </div>
        </div>
    </div>
<?php
}
