$('#btnModalError').trigger("click");
setTimeout(function () {
    $('#btnModalClose').trigger("click");
}, 1800);
let specificAddressOrder, province, district, village, productId,
    colorId, sizeId, quantity, logistic_method, notes, cartId;
cartId = $('.row-product').map(function () {
    return this.getAttribute('data-cart-id');
}).get();
productId = $('.row-product').map(function () {
    return this.getAttribute('data-id');
}).get();
colorId = $('.product-color').map(function () {
    return this.getAttribute('data-color');
}).get();
sizeId = $('.product-size').map(function () {
    return this.getAttribute('data-size');
}).get();
quantity = $('.product-quantity').map(function () {
    return this.getAttribute('data-quantity');
}).get();
$('#cart_id').children('input').val(cartId.toString());
$('#quantity').children('input').val(quantity.toString());
$('#product_id').children('input').val(productId.toString());
$('#color_id').children('input').val(colorId.toString());
$('#size_id').children('input').val(sizeId.toString());
let total_price = 0;
for (let i = 0; i < $('.price').length; i++) {
    total_price += parseInt($('#total_price_' + i).attr('data-total-price'));
}
$('#total_price_cart').html(new Intl.NumberFormat(['ban', 'id']).format(total_price) + 'đ');
$('#total_price').html(new Intl.NumberFormat(['ban', 'id']).format(total_price) + 'đ');

$("#telInput").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});