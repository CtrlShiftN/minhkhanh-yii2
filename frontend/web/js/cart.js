$('#btnModalSuccess').trigger("click");
setTimeout(function () {
    $('#btnModalClose').trigger("click");
}, 1800);
let product, amount, id;
let total_price = 0;
product = $('.row-product');
totalPrice()
$(".amountInput").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

function totalPrice() {
    total_price = 0;
    for (let i = 0; i < product.length; i++) {
        total_price += parseInt($('.total-price_' + i).attr('data-total-price'));
    }
    let total_price_format = new Intl.NumberFormat(['ban', 'id']).format(total_price);
    $("#totalPrice").html(total_price_format + 'đ');
}

document.querySelectorAll('.btnDESC').forEach(item => {
    item.addEventListener('click', event => {
        let id = item.getAttribute("data-id");
        let idAmount = $('#amount' + id);
        let idPrice = $('.price_' + id);
        let idTotalPriceProduct = $('#total_price_product' + id);
        if (idAmount.val() > 1) {
            idAmount.val(parseInt(idAmount.val()) - 1);
            updateAmount(id, idAmount.val(), idPrice.attr('data-price'));
            let total_price = parseInt(idPrice.attr('data-price')) * idAmount.val();
            let total_price_format = new Intl.NumberFormat(['ban', 'id']).format(total_price);
            idTotalPriceProduct.html(total_price_format + 'đ');
            idTotalPriceProduct.attr('data-total-price', total_price);
        }
        totalPrice();
    });
});

document.querySelectorAll('.btnASC').forEach(item => {
    item.addEventListener('click', event => {
        let id = item.getAttribute("data-id");
        let idAmount = $('#amount' + id);
        let idPrice = $('.price_' + id);
        let existingProduct = $('.existing-product' + id);
        let idTotalPriceProduct = $('#total_price_product' + id);
        if (idAmount.val() < parseInt(existingProduct.attr('data-existing-product'))) {
            $('#notify_' + id).addClass('d-none');
            idAmount.val(parseInt(idAmount.val()) + 1);
        } else {
            idAmount.val(parseInt(existingProduct.attr('data-existing-product')));
            $('#notify_' + id).removeClass('d-none');
            setTimeout(function () {
                $('#notify_' + id).addClass('d-none');
            }, 2000)
        }
        updateAmount(id, idAmount.val(), idPrice.attr('data-price'));
        let total_price = parseInt(idPrice.attr('data-price')) * idAmount.val();
        let total_price_format = new Intl.NumberFormat(['ban', 'id']).format(total_price);
        idTotalPriceProduct.html(total_price_format + 'đ');
        idTotalPriceProduct.attr('data-total-price', total_price);
        totalPrice();
    });
});

document.querySelectorAll('.amountInput').forEach(item => {
    item.addEventListener('change', event => {
        let id = item.getAttribute("data-id");
        let idAmount = $('#amount' + id);
        let idPrice = $('.price_' + id);
        let existingProduct = $('.existing-product' + id);
        let idTotalPriceProduct = $('#total_price_product' + id);
        if (idAmount.val() == 0) {
            idAmount.val(1);
            $('#notify_' + id).addClass('d-none');
        } else if (idAmount.val() > parseInt(existingProduct.attr('data-existing-product'))) {
            idAmount.val(parseInt(existingProduct.attr('data-existing-product')));
            $('#notify_' + id).removeClass('d-none');
            setTimeout(function () {
                $('#notify_' + id).addClass('d-none');
            }, 2000)
        } else {
            $('#notify_' + id).addClass('d-none');
            let amount = parseInt($('#amount' + id).val());
            idAmount.val(amount);
        }
        updateAmount(id, idAmount.val(), idPrice.attr('data-price'));
        let total_price = parseInt(idPrice.attr('data-price')) * idAmount.val();
        let total_price_format = new Intl.NumberFormat(['ban', 'id']).format(total_price);
        idTotalPriceProduct.html(total_price_format + 'đ');
        idTotalPriceProduct.attr('data-total-price', total_price);
        totalPrice();
    });
});

function updateAmount(id, amount, price) {
    let request = $.ajax({
        url: "/api/ajax/update-amount-product-in-cart",
        method: "POST",
        data: {
            id: id,
            amount: amount,
            price: price,
        },
    });
    request.fail(function (response) {
        let arrRes = $.parseJSON(response);
        alert(arrRes.notify);
    });
}