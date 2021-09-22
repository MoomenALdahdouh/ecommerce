$(function () {
    'use strict';
    // Hid text Placeholder
    $('[placeholder]').focus(function () {
        $(this).attr('text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('text'));
    });

    $('.counter-minus').click(function () {
        var input = document.getElementById('input-quantity');
        var quantity = input.value+'';
        if (quantity > 0) {
            quantity--;
            input.value = quantity;
        }
    });
    $('.counter-plus').click(function () {
        var input = document.getElementById('input-quantity');
        var quantity = input.value+'';
        quantity++;
        input.value = quantity;
    });

    $(document).ready(function () {
        addToCart();
        addToWishes();
        search();
    });

    function addToCart() {
        $('#cart-item').click(function () {
            var itemID = $(this).attr('itemID');
            var into = 'cart';
            $.ajax({
                url: 'actionItem.php',
                method: 'POST',
                data: {'itemID': itemID, 'into': into},
                success: function (data) {
                    if (data == 'true')
                        $('#modal-message').modal('show');
                    else if (data == 'false')
                        $('#login-modal-message').modal('show');
                    else if (data == 'exist')
                        $('#exist-modal-message').modal('show');
                }
            });
        });
    }

    function addToWishes() {
        $('#wish-item').click(function () {
            var itemID = $(this).attr('itemID');
            var into = 'wishes';
            $.ajax({
                url: 'actionItem.php',
                method: 'POST',
                data: {'itemID': itemID, 'into': into},
                success: function (data) {
                    if (data == 'true')
                        $('#modal-message').modal('show');
                    else if (data == 'false')
                        $('#login-modal-message').modal('show');
                    else if (data == 'exist')
                        $('#exist-modal-message').modal('show');

                }
            });
        });
    }
    /*var search = document.getElementById("search-id");
    var valueSearch = search.value;*/
    function search() {
        var search = document.getElementById("search-id");
        search.addEventListener("keyup", function() {
            var searchText = $(this).val();
            if (search.value != "") {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {'query': searchText},
                    success: function (response) {
                        $("#show-list-search").html(response);
                    }
                });
            }else {
                $("#show-list-search").html('');
            }
        });
        $(document).on('click','a',function (){
            $('#search-id').val($(this).text());
            $("#show-list-search").html('');
        })
    }
});

