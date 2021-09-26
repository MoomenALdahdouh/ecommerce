$(function () {
    'use strict';
    // Hid text Placeholder
    $('[placeholder]').focus(function () {
        $(this).attr('text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('text'));
    });

    //Hid and show password
    var passField = $('.password');
    $('.show-pass').hover(function () {
        passField.attr('type', 'text');
    }, function () {
        passField.attr('type', 'password');
    });
    //Confirm dialog when delete user
    $('.confirm').click(function () {
        return confirm('Are you sure to delete this user?')
    })

    $(document).ready(function () {
        deleteItem();
        getItemViewInTable();
        getItem();
        updateItem();
        updateStatusItem();
        //addNewItem();
        //uploadImage();
        insertItem();
    });


    var table;

    //Function to return items data from mysql AJAX table
    function getItemViewInTable() {
        table = $('#items-table').DataTable({
            ajax: {
                url: "item/getItems.php",
                dataSrc: "items"
            },
            columns: [
                {"data": "itemID"},
                {"data": "Image"},
                {"data": "Name"},
                {"data": "Description"},
                {"data": "Price"},
                {"data": "Date"},
                {"data": "Country"},
                {"data": "Rating"},
                {"data": "CatID"},
                {"data": "MemberID"},
                {"data": "Control"}
            ]
        });
    }

    $('#cancel').click(function () {
        $('form').trigger('reset');
        $('.message-alert').html("Please Fill in the Blanks!");
    });

    //Confirm Delete Item from table ajax
    function deleteItem() {
        $('#items-table').on('click', 'tr td #delete-btn', function () {
            const itemID = $(this).attr('itemID');
            var proceed = confirm('Are you sure to delete this Item?')
            if (proceed) {
                $.ajax({
                    url: 'item/deleteItems.php',
                    method: 'POST',
                    data: {'itemID': itemID},
                    success: function () {
                        $('.message-item').html('Remove successfully');
                        table.ajax.reload(null, false);
                    }
                })
            }
        });
    }

    //active and block item
    function updateStatusItem() {
        $('#items-table').on('click', 'tr td #status-btn', function () {
            const itemID = $(this).attr('itemID');
            console.log(itemID);
            $.ajax({
                url: 'item/updateStatusItem.php',
                method: 'POST',
                data: {
                    'itemID': itemID
                },
                success: function () {
                    $('.message-item').html('Update successfully');
                    table.ajax.reload(null, false);
                }
            })
        });
    }

    function getItem() {
        $('#items-table').on('click', 'tr td #edit-btn', function () {
            const itemID = $(this).attr('itemID');
            $.ajax({
                url: 'item/getItem.php',
                method: 'POST',
                data: {'itemID': itemID},
                dataType: 'JSON',
                success: function (data) {
                    $('#itemID').val(data['itemID']);
                    $('#itemName').val(data['Name']);
                    $('#itemDescription').val(data['Description']);
                    $('#itemPrice').val(data['Price']);
                    $('#itemDate').val(data['Date']);
                    $('#itemCountry').val(data['Country']);
                    $('#itemRating').val(data['Rating']);
                    $('#itemCatID').val(data['CatID']);
                    $('#itemMemberID').val(data['MemberID']);
                }
            })
        });
    }

    function updateItem() {
        $('#update-item').click(function () {
            var itemID = $('#itemID').val();
            var itemName = $('#itemName').val();
            var itemDescription = $('#itemDescription').val();
            var itemPrice = $('#itemPrice').val();
            var itemDate = $('#itemDate').val();
            var itemCountry = $('#itemCountry').val();
            var itemRating = $('#itemRating').val();
            var itemCatID = $('#itemCatID').val();
            var itemMemberID = $('#itemMemberID').val();
            $.ajax({
                url: 'item/updateItems.php',
                method: 'POST',
                data: {
                    'itemID': itemID,
                    'name': itemName,
                    'description': itemDescription,
                    'price': itemPrice,
                    'date': itemDate,
                    'country': itemCountry,
                    'rating': itemRating,
                    'catID': itemCatID,
                    'memberID': itemMemberID,
                },
                success: function () {
                    $('.message-item').html('Update successfully');
                    table.ajax.reload(null, false);
                }
            })
        });
    }

    var imageName = "";
    function uploadImage() {
        var file_data = $('#fileToUpload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('fileToUpload', file_data);
        $.ajax({
            url: 'item/uploadImageItem.php', // <-- point to server-side PHP script
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                imageName = response;
                //imageName = file_data['name'];
            }
        });
    }

    function addNewItem() {
        $('#add-new-item').click(function () {
            uploadImage();
            insertItem();
        });
    }

    //Add Item using Ajax
    function insertItem() {
        $('#add-item').click(function () {
            uploadImage()
            var name = $('#name-item').val();
            var description = $('#description-item').val();
            var price = $('#price-item').val();
            var country = $('#country-item').val();
            if (name == "" || description == "" || price == "" || country == "" || imageName == "not found" || imageName == "") {
                $('.message-alert').html("Please Fill in the Blanks and Choose Image!");
            } else {
                console.log(imageName)
                $.ajax({
                    url: 'item/insertItems.php',
                    method: 'POST',
                    data: {
                        'name': name,
                        'description': description,
                        'price': price,
                        'country': country,
                        'image': imageName
                    },
                    success: function () {
                        $('.message-alert').html('Added successfully');
                        $('form').trigger('reset');
                        //getItemViewInTable();
                        //$('#items-table').Datatable().ajax.reload();
                        table.ajax.reload(null, false);
                        //uploadImage();
                    }
                })
            }
        })
    }

});