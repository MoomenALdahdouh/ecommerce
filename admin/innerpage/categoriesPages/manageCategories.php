<?php
/*Feach categories from db*/
$sort = 'ASC';
$activeAsc = '';
$activeDesc = '';
$sort_array = array('ASC', 'DESC');
if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
    $sort = $_GET['sort'];
}

/*if ($sort = 'ASC'){
    $activeAsc = 'active-class';
    $activeDesc = 'sort-class';
}
if ($sort = 'DESC'){
    $activeDesc = 'active-class';
    $activeAsc = 'sort-class';
}*/

$stmt = $conn->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
$stmt->execute();
$rows = $stmt->fetchAll(); ?>
    <h1>Manage Categories</h1>
    <div class="container">
        <div class="card-header sort-class">
            Ordering
            <a href="?sort=ASC" class="<?php echo $activeAsc;?>">ASC</a>
            <a href="?sort=DESC" class="<?php echo $activeDesc;?>">| DESC</a>
        </div>
        <div class="table-responsive">
            <table class="main-table table table-bordered text-center">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Ordering</td>
                    <td>Status</td>
                    <!--<td>Comments</td>
                    <td>Ads</td>-->
                    <td>Control</td>
                </tr>
                <?php
                foreach ($rows as $row) {
                    echo "<tr class='row-tr'>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Name'] . '<br>' . $row['Description'] . "</td>";
                    echo "<td>" . $row['Ordering'] . "</td>";
                    $visibility = '';
                    $comment = '';
                    $ads = '';
                    $class = 'empty-class';
                    $gonVisibility = '';
                    $gonComment = '';
                    $gonAds = '';
                    if ($row['Visibility'] == 1) {
                        $visibility = 'Hidden';
                        /*echo "<td class='visible-category'>Hidden</td>";*/
                    } else {
                        $gonVisibility = 'gone-class';
                    }
                    if ($row['Allow_Comment'] == 1) {
                        $comment = 'Comment Disabled';
                        /*echo "<td class='comment-category'>Comment Disabled</td>";*/
                    } else {
                        $gonComment = 'gone-class';
                        /*echo "<td></td>";*/
                    }
                    if ($row['Allow_Ads'] == 1) {
                        $ads = 'Ads Disabled';
                        /*echo "<td class='ads-category'>Ads Disabled</td>";*/
                    } else {
                        $gonAds = 'gone-class';
                        /*echo "<td></td>";*/
                    }
                    if (empty($visibility) && empty($comment) && empty($ads)) {
                        echo "<td class='status-active status-category'><div class='container'><div class='row'><span class='col status-active'>All Status Is Active</span></div></td>";
                    } else
                        echo "<td class='status-category'><div class='container'><div class='row'><span class='col $gonVisibility visible-category'>$visibility</span><span class='col $gonComment comment-category'>$comment</span><span class='col $gonAds ads-category'>$ads</span></div></div></td>";
                    echo "<td> <a href='categories.php?page=Edit&id="
                        . $row['ID'] . "' class='control-button btn btn-success'>Edit</a> <a href='categories.php?page=Delete&id="
                        . $row['ID'] . "' class='control-button btn btn-danger confirm'>Delete</a>";
                    /*if ($row['RegStatus'] == 0){
                        echo "<a href='categories.php?page=Activate&id="
                            . $row['ID'] . "' class='control-button btn btn-info'>Activate</a>";
                    }*/
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <a href="categories.php?page=Add" class="btn btn-primary"><i class="fa fa-pulse"></i><strong>+</strong> Add New
            Category</a>
    </div>
<?php
