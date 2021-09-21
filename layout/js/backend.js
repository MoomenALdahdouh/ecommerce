$(function () {
    'use strict';
    // Hid text Placeholder
    $('[placeholder]').focus(function () {
        $(this).attr('text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('text'));
    });

    var input = document.getElementById('input-quantity');
    var quantity = input.value;
    $('.counter-minus').click(function () {
        if (quantity > 0) {
            quantity--;
            input.value = quantity;
        }
    });
    $('.counter-plus').click(function () {
        quantity++;
        input.value = quantity;
    });

    $(document).ready(function () {
        addToCart()
        addToWishes()
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
                    else if(data == 'false')
                        $('#login-modal-message').modal('show');
                    else if(data == 'exist')
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
                    else if(data == 'false')
                        $('#login-modal-message').modal('show');
                    else if(data == 'exist')
                        $('#exist-modal-message').modal('show');

                }
            });
        });
    }
});

