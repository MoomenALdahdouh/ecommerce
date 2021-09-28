$(function () {
    'use strict';
    $(document).ready(function () {
        // getItemCart()
        hideShowPlaceholder()
        addToCart();
        addToWishes();
        search();
        removeFromCart();
        buyFromCart();
        buyOrderSummeryCart();
        increasesItemCart();
        inputQuantityItemCart();
        decreasesItemCart();
    });

    function getItemCart() {
        let action = 'get';
        $('#content-table').DataTable({
            ajax: {
                url: 'actionItem.php',
                method: 'POST',
                data: {
                    'itemID': '',
                    'action': action,
                },
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

    // Hid text Placeholder
    function hideShowPlaceholder() {
        $('[placeholder]').focus(function () {
            $(this).attr('text', $(this).attr('placeholder'));
            $(this).attr('placeholder', '');
        }).blur(function () {
            $(this).attr('placeholder', $(this).attr('text'));
        });
    }

    /*Increases quantity item */
    function inputQuantityItemCart() {
        Array.from(document.querySelectorAll('#input-quantity')).forEach(bttn => {
            bttn.addEventListener('keyup', (e) => {
                e.preventDefault();
                let strongQuantity = e.target.parentNode.querySelector('#avilabil-quantity');
                let currentQuantity = strongQuantity.innerHTML;
                let input = e.target.parentNode.querySelector('#input-quantity');
                let quantity = input.value + '';
                /* setTimeout(function () {
                         if (quantity > currentQuantity)
                             quantity = currentQuantity;
                         else if (quantity == 0) {
                             quantity = 1;
                         }
                         input.value = quantity;
                         console.log(input.value)
                     }, 100 /// Time in milliseconds
                 );*/
                if (quantity > currentQuantity)
                    quantity = currentQuantity;
                else if (quantity == 0) {
                    quantity = 1;
                }
                input.value = quantity;
                console.log(input.value)
                let inputItemID = e.target.parentNode.querySelector('#item-id');
                let itemID = inputItemID.value;
                let action = 'update';
                $.ajax({
                    url: 'actionItem.php',
                    method: 'POST',
                    data: {
                        'itemID': itemID,
                        'action': action,
                        'quantity': quantity,
                    },
                    success: function (data) {

                    }
                });
            });
        });
    }

    /*Increases quantity item */
    function increasesItemCart() {
        Array.from(document.querySelectorAll('.counter-plus')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let strongQuantity = e.target.parentNode.querySelector('#avilabil-quantity');
                let currentQuantity = strongQuantity.innerHTML;
                let input = e.target.parentNode.querySelector('#input-quantity');
                let quantity = input.value + '';
                if (currentQuantity > quantity)
                    quantity++;
                input.value = quantity;
                let inputItemID = e.target.parentNode.querySelector('#item-id');
                let itemID = inputItemID.value;
                let action = 'update';
                $.ajax({
                    url: 'actionItem.php',
                    method: 'POST',
                    data: {
                        'itemID': itemID,
                        'action': action,
                        'quantity': quantity,
                    },
                    success: function (data) {

                    }
                });
            });
        });
    }

    /*Decreases quantity item */
    function decreasesItemCart() {
        Array.from(document.querySelectorAll('.counter-minus')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let input = e.target.parentNode.querySelector('#input-quantity');
                let quantity = input.value + '';
                if (quantity > 0) {
                    quantity--;
                    input.value = quantity;
                    let inputItemID = e.target.parentNode.querySelector('#item-id');
                    let itemID = inputItemID.value;
                    let action = 'update';
                    $.ajax({
                        url: 'actionItem.php',
                        method: 'POST',
                        data: {
                            'itemID': itemID,
                            'action': action,
                            'quantity': quantity,
                        },
                        success: function (data) {
                            // calculateSummery();
                        }
                    });
                }
            });
        });
    }

    /*Calculate order summery*/
    function calculateSummery() {
        $.ajax({
            url: 'actionItem.php',
            method: 'POST',
            data: {
                'itemID': itemID,
                'action': action,
                'quantity': quantity,
            },
            success: function (data) {

            }
        });
    }

    /*Remove from cart*/
    function removeFromCart() {
        Array.from(document.querySelectorAll('.counter-delete')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let inputitemID = e.target.parentNode.querySelector('#item-id');
                let itemID = inputitemID.value;
                let action = 'remove';
                $.ajax({
                    url: 'actionItem.php',
                    method: 'POST',
                    data: {
                        'itemID': itemID,
                        'action': action,
                    },
                    success: function (data) {
                        if (data == "remove")
                            console.log('remove');
                    }
                });
            });
        });
    }


    /*Buy from cart*/
    function buyFromCart() {
        Array.from(document.querySelectorAll('.counter-buy')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let inputitemID = e.target.parentNode.querySelector('#item-id');
                let itemID = inputitemID.value;
                let input = e.target.parentNode.querySelector('#input-quantity');
                let quantity = input.value;
                let priceElement = e.target.parentNode.querySelector('#item-price');
                let price = priceElement.innerHTML;
                let total = price * quantity;

                $('#buy-modal').modal('show');
                document.getElementById('quantity').innerHTML = quantity;
                document.getElementById('price').innerHTML = 'US $' + price;
                document.getElementById('total').innerHTML = 'US $' + total;

                document.getElementById('total-founds').value = total;
                /*$.ajax({
                    url: 'founds.php',
                    method: 'POST',
                    data: {
                        'itemID': itemID,
                        'quantity': quantity,
                        'price': price,
                        'total': total,
                        'action': action,
                    },
                    success: function (data) {
                        alert(data)
                    }
                });*/
            });
        });
    }

    /*Buy Order Summery*/
    function buyOrderSummeryCart() {
        $('.counter-buy-summary').click(function (){
            let itemID = document.getElementById('item-id').innerHTML;

            let subtotal =  document.getElementById('subtotal').innerHTML;

            let shipping = document.getElementById('shipping').innerHTML;

            let total = document.getElementById('total-summery').innerHTML;

            $('#buy-modal').modal('show');


            document.getElementById('Quantity').innerHTML = 'Subtotal';
            document.getElementById('Price').innerHTML = 'Shipping';
            document.getElementById('Total').innerHTML = 'Total';

            document.getElementById('quantity').innerHTML = 'US $' +subtotal;
            document.getElementById('price').innerHTML = 'US $' + shipping;
            document.getElementById('total').innerHTML = 'US $' + total;

            document.getElementById('total-founds').value = total;
        });
    }

    function buyAllFromCart() {
        $("#buy-all-items").click(function () {
            let inputitemID = e.target.parentNode.querySelector('#item-id');
            let itemID = inputitemID.value;
            let input = e.target.parentNode.querySelector('#input-quantity');
            let quantity = input.value + '';
            var action = 'buy';
            $.ajax({
                url: 'founds.php',
                method: 'POST',
                data: {
                    'itemID': itemID,
                    'quantity': quantity,
                    'action': action,
                },
                success: function (data) {

                }
            });
        });
    }

    function addToCart() {
        $('#cart-item').click(function () {
            var itemID = $(this).attr('itemID');
            var input = document.getElementById('input-quantity');
            var quantity = input.value + '';
            var action = 'addToCart';
            $.ajax({
                url: 'actionItem.php',
                method: 'POST',
                data: {
                    'itemID': itemID,
                    'quantity': quantity,
                    'action': action,
                },
                success: function (data) {
                    if (data > 0) {
                        $('#modal-message').modal('show');
                        document.getElementById("cart-notification").textContent = data;
                    } else if (data == "false") {
                        $('#login-modal-message').modal('show');
                    } else if (data == "exist") {
                        $('#exist-modal-message').modal('show');
                    }
                }
            });
        });
    }

    function addToWishes() {
        $('#wish-item').click(function () {
            var itemID = $(this).attr('itemID');
            var action = 'addToWishes';
            var quantity = '0';
            $.ajax({
                url: 'actionItem.php',
                method: 'POST',
                data: {
                    'itemID': itemID,
                    'quantity': quantity,
                    'action': action,
                },
                success: function (data) {
                    if (data == "add") {
                        $('#wish-item-icon').toggleClass("fas fa-heart text-danger");
                        $('#modal-message').modal('show');
                    } else if (data == "false") {
                        $('#login-modal-message').modal('show');
                    } else if (data == "remove") {
                        $('#wish-item-icon').toggleClass("far fa-heart");
                    }
                }
            });
        });
    }

    /*var search = document.getElementById("search-id");
    var valueSearch = search.value;*/
    function search() {
        var search = document.getElementById("search-id");
        if (search) {
            search.addEventListener("keyup", function () {
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
                } else {
                    $("#show-list-search").html('');
                }
            });
            $(document).on('click', 'a', function () {
                $('#search-id').val($(this).text());
                $("#show-list-search").html('');
            })
        }
    }

    function refreshCartNotification() {
        $('#cart-notification').load("refresh.php");
        setInterval(function () {
            $('#cart-notification').load("refresh.php");
            //$('#cart-notification').load("includes/templates/navbar.php");
        }, 500);
    }

    /* $('.counter-minus').click(function () {
        var input = document.getElementById('input-quantity');
        var quantity = input.value + '';
        if (quantity > 0) {
            quantity--;
            input.value = quantity;
        }
    });
    $('.counter-plus').click(function () {
        var input = document.getElementById('input-quantity');
        var quantity = input.value + '';
        console.log(quantity)
        quantity++;
        input.value = quantity;
    });*/
});

