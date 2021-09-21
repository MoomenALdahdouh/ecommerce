<?php
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM categories WHERE ID = ? LIMIT 1");
$stmt->execute(array($id));
$count = $stmt->rowCount();
$row = $stmt->fetch();
if ($count > 0) { ?>
    <div class="add-member text-center">
        <div class="container">
            <h1 class="content ">
                Edit <?php echo $row['Name'] . ' Category'; ?>
            </h1>
            <form class="content" method="POST" action="?page=Update">
                <ul>
                    <li>
                        <input class="input" type="hidden" name="id" value="<?php echo $id ?>">
                    </li>
                    <li>
                        <input class="input"
                               type="text"
                               name="name"
                               value="<?php echo $row['Name']; ?>"
                               placeholder="Name Of The Category"
                               autocomplete="off"
                               required="required">
                    </li>
                    <li>
                        <input class="input"
                               type="text"
                               name="description"
                               value="<?php echo $row['Description']; ?>"
                               placeholder="Description"
                               autocomplete="off"
                               required="required">
                    </li>
                    <li>
                        <input class="input"
                               type="text"
                               name="ordering"
                               value="<?php echo $row['Ordering']; ?>"
                               placeholder="Number Of The Arrange The Categories"
                               autocomplete="off"
                               required="required">
                    </li>
                    <li>
                        <div class="row-div input row">
                            <p class="col">Visible</p>
                            <?php if ($row['Visibility'] == 0) { ?>
                                <div class="col">
                                    <input id="vis-yes"
                                           type="radio"
                                           name="visibility"
                                           value="0"
                                           checked>
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div class="col">
                                    <input id="vis-no"
                                           type="radio"
                                           name="visibility"
                                           value="1">
                                    <label for="vis-no">No</label>
                                </div>
                            <?php } else { ?>
                                <div class="col">
                                    <input id="vis-yes"
                                           type="radio"
                                           name="visibility"
                                           value="0">
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div class="col">
                                    <input id="vis-no"
                                           type="radio"
                                           name="visibility"
                                           value="1"
                                           checked>
                                    <label for="vis-no">No</label>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        <div class="row-div input row">
                            <p class="col">Allow Commenting</p>
                            <?php if ($row['Allow_Comment'] == 0) { ?>
                                <div class="col">
                                    <input id="com-yes" type="radio" name="commenting" value="0" checked>
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div class="col">
                                    <input id="com-no" type="radio" name="commenting" value="1">
                                    <label for="com-no">No</label>
                                </div>
                            <?php } else { ?>
                                <div class="col">
                                    <input id="com-yes" type="radio" name="commenting" value="0">
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div class="col">
                                    <input id="com-no" type="radio" name="commenting" value="1" checked>
                                    <label for="com-no">No</label>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        <div class="row-div input row">
                            <p class="col">Allow Ads</p>
                            <?php if ($row['Allow_Comment'] == 0) { ?>
                            <div class="col">
                                <input id="ads-yes" type="radio" name="ads" value="0" checked>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div class="col">
                                <input id="ads-no" type="radio" name="ads" value="1">
                                <label for="ads-no">No</label>
                            </div>
                             <?php } else { ?>
                                <div class="col">
                                    <input id="ads-yes" type="radio" name="ads" value="0">
                                    <label for="ads-yes">Yes</label>
                                </div>
                                <div class="col">
                                    <input id="ads-no" type="radio" name="ads" value="1" checked>
                                    <label for="ads-no">No</label>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        <input class="button" type="submit" name="save" value="Save">
                    </li>
                </ul>
            </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <?php
} else {
    $error = 'Not Exist!';
    redirect2Page('Home', 'login.php', $error, 4);
}
?>





