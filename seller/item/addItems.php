<div id="add-item" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add New Item</h4>
            </div>
            <div class="modal-body">
                <div class="add-item text-center">
                    <p class="message-alert alert alert-info"></p>
                    <form class="content" method="POST">
                        <ul>
                            <li>
                                <input id="name-item" class="input" type="text" name="name"
                                       placeholder="Name Of The Item" autocomplete="off"
                                       required="required">
                            </li>
                            <li>
                                <input id="description-item" class="input" type="text" name="description"
                                       placeholder="description"
                                       autocomplete="off"
                                       required="required">
                            </li>
                            <li>
                                <input id="price-item" class="input" type="number" name="price"
                                       placeholder="Price"
                                       autocomplete="off"
                                       required="required">
                            </li>
                            <li>
                                <input id="country-item" class="input" type="text" name="country"
                                       placeholder="Country"
                                       autocomplete="off"
                                       required="required">
                            </li>
                            <!--<li class="image-upload">

                            </li>-->
                        </ul>
                    </form>

                    <div class="image-upload container">
                        <div class="row text-start">
                            <div class="col-sm-6">
                                <h6>Select image to upload:</h6>
                                <input class="choose-image" type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="preview col-sm-6 text-end">
                                <img alt="image" src="../uploads/upload-image.png" id="img" width="100"
                                     height="100">
                            </div>
                        </div>
                    </div>

                    <!--<div class="image-upload">

                    </div>-->
                </div>
            </div>
            <div class="modal-footer">
                <button id="add-item" class="btn btn-primary" type="button">Add</button>
                <button id="cancel" class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<?php /*include 'insertItems.php';*/ ?>


