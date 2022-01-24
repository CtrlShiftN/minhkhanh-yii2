let id, size, color, amount, price;
//accept press number into input
$("#amountInput").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
$('#btnAddToCart').click(function () {
    if ($('#sth').attr('data-id') == 1) {
        window.location.href = "/frontend/web/site/login?ref=" + window.location.pathname + '?detail=' + $('.product-information').attr('data-id');
    } else {
        if ($('#quantity').attr('data-quantity') != 0) {
            if ($('#color').attr('data-color') == '' || $('#size').attr('data-size') == '') {
                $('#classify').addClass('bg-lighter-danger');
                $('#notify').html($('#notify').attr('data-validate'));
                setTimeout(function () {
                    $('#classify').removeClass('bg-lighter-danger');
                    $('#notify').html('');
                }, 3000);
            } else {
                requestData();
            }
        }
    }
});
$('#btnBuyNow').click(function (e) {
    if ($('#sth').attr('data-id') == 1) {
        window.location.href = "/frontend/web/site/login?ref=" + window.location.pathname + '?detail=' + $('.product-information').attr('data-id');
    } else {
        if ($('#color').attr('data-color') == '' || $('#size').attr('data-size') == '') {
            e.preventDefault();
            $('#classify').addClass('bg-lighter-danger');
            $('#notify').html($('#notify').attr('data-validate'));
            setTimeout(function () {
                $('#classify').removeClass('bg-lighter-danger');
                $('#notify').html('');
            }, 3000);
        } else {
            requestData();
        }
    }
});

function requestData() {
    id = $('.product-information').attr('data-id');
    color = $('#color').attr('data-color');
    size = $('#size').attr('data-size');
    amount = $('#amountInput').val();
    price = $('.price').attr('data-price');
    let request = $.ajax({
        url: "/frontend/web/api/ajax/update-or-create-cart",
        method: "POST",
        data: {
            id: id,
            color: color,
            size: size,
            amount: amount,
            price: price,
        },
    });
    request.done(function (response) {
        let arrRes = $.parseJSON(response);
        let toast = new bootstrap.Toast(document.getElementById('liveToast'));
        $('#toastNotify').html('<i class="fas fa-check-circle"></i> ' + arrRes.notify);
        toast.show();
        $('#toastBoard, #liveToast').addClass('bg-success text-light');
        $('#lblCartCount').html(arrRes.count);
        setTimeout(function () {
            toast.hide(200);
            $('#toastNotify').html('');
            $('#toastBoard, #liveToast').removeClass('bg-success text-light');
        }, 2000);
    });
    request.fail(function (response) {
        let arrRes = $.parseJSON(response);
        let toast = new bootstrap.Toast(document.getElementById('liveToast'));
        $('#toastNotify').html('<i class="far fa-times-circle"></i> ' + arrRes.notify);
        toast.show();
        $('#toastBoard, #liveToast').addClass('bg-danger text-light');
        setTimeout(function () {
            toast.hide(200);
            $('#toastNotify').html('');
        }, 2000);
        $('#toastBoard, #liveToast').removeClass('bg-danger text-light');
    });
}

// function responsive() {
//     $('#bestsellers .product-card').removeClass('d-none');
//     $('#onSale .product-card').removeClass('d-none');
//     if (window.matchMedia('(min-width: 1200px) and (max-width: 1400px)').matches || window.matchMedia('(min-width: 576px) and (max-width: 992px)').matches) {
//         if ($('#bestsellers .product-card').length > 4) {
//             $("#bestsellers .product-card:last").addClass('d-none');
//         }
//         if ($('#onSale .product-card').length > 4) {
//             $("#onSale .product-card:last").addClass('d-none');
//         }
//     } else if (window.matchMedia('(min-width: 992px) and (max-width: 1200px)').matches || window.matchMedia('(max-width: 576px)').matches) {
//         if ($('#bestsellers .product-card').length > 3) {
//             $("#bestsellers .product-card:first, #bestsellers .product-card:last").addClass('d-none');
//         }
//         if ($('#onSale .product-card').length > 3) {
//             $("#onSale .product-card:first, #onSale .product-card:last").addClass('d-none');
//         }
//     }
// }

// $(document).ready(function () {
//     responsive();
// });
// $(window).resize(function () {
//     responsive();
// });
//accept press number into input
$("#amountInput").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
//validate amount
$('#amountInput').change(function () {
    if ($(this).val() == 0) {
        $(this).val(1);
        $('#notify').html('');
    } else if ($(this).val() > parseInt($('#quantity').attr('data-quantity'))) {
        $(this).val(parseInt($('#quantity').attr('data-quantity')));
        $('#notify').html($('#notify').attr('data-out-of-stock'));
        setTimeout(function () {
            $('#notify').html('');
        }, 3000);
    } else {
        $(this).val(parseInt($(this).val()));
        $('#notify').html('');
    }
});

//reduce the number of
function reduceProductQuantity() {
    if ($('#amountInput').val() > 1) {
        let amount = parseInt($('#amountInput').val());
        $('#amountInput').val(amount - 1);
    }
};

//increase the number
function increaseProductQuantity() {
    if ($('#amountInput').val() < parseInt($('#quantity').attr('data-quantity'))) {
        let amount = parseInt($('#amountInput').val());
        $('#amountInput').val(amount + 1);
    }
};

var galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 5,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    breakpoints: {
        0: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
    }
});
var galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    thumbs: {
        swiper: galleryThumbs
    },
});
// change carousel item height
// gallery-top
let productCarouselTopWidth = $('.gallery-top').outerWidth();
$('.gallery-top').css('height', productCarouselTopWidth);

// gallery-thumbs
let productCarouselThumbsItemWith = $('.gallery-thumbs .swiper-slide').outerWidth();
$('.gallery-thumbs').css('height', productCarouselThumbsItemWith);

// activation zoom plugin
var $easyzoom = $('.easyzoom').easyZoom();

$('.btn-color').click(function () {
    if (!$(this).hasClass('btn-selected')) {
        $(this).addClass('btn-selected').siblings().removeClass('btn-selected');
        $('#color').attr('data-color', $(this).attr('data-color')).html("<span class='text-dark fw-bold fs-note'>" + $('#title-classify-color').attr('data-name') + ":</span> " + $(this).attr('data-name-color'));
    } else {
        $(this).removeClass('btn-selected');
        $('#color').attr('data-color', '').html('');
    }
});
$('.btn-size').click(function () {
    if (!$(this).hasClass('btn-selected')) {
        $(this).addClass('btn-selected').siblings().removeClass('btn-selected');
        $('#size').attr('data-size', $(this).attr('data-size')).html("<span class='text-dark fw-bold fs-note'>" + $('#title-classify-size').attr('data-name') + ":</span> " + $(this).attr('data-name-size'));
    } else {
        $(this).removeClass('btn-selected');
        $('#size').attr('data-size', '').html('');
    }
});

if (parseInt($('#quantity').attr('data-quantity')) == 0) {
    $('#btnAdd,#btnBuyNow').css('pointer-events', 'none');
    $('#notify').html('Sản phẩm không đủ để đáp ứng yêu cầu!');
    $('#outOfStock').addClass('d-inline-block');
} else {
    $('#outOfStock').addClass('d-none');
}

function addToFavorite(obj) {
    var productID = obj.getAttribute('data-id');
    if ($('#sth').attr('data-id') == 1) {
        window.location.href = "/frontend/web/site/login?ref=" + window.location.pathname;
    } else {
        let request = $.ajax({
            url: "/frontend/web/api/ajax/add-to-favorite", // send request to
            method: "POST", // sending method
            data: {
                id: productID,
            },
        });
        request.done(function (response) {
            let arrRes = $.parseJSON(response);
            let toast = new bootstrap.Toast(document.getElementById('liveToast'));
            if (arrRes.status === 1) {
                $('#toastNotify').html('<i class="fas fa-check-circle"></i> ' + arrRes.message);
                toast.show();
                $('#toastBoard, #liveToast').addClass('bg-success text-light');
                $('#toastBoard').css('width', '300px');
                setTimeout(function () {
                    toast.hide(200);
                    $('#toastNotify').html('');
                    $('#toastBoard').css('width', '260px');
                }, 2000);
            } else {
                $('#toastNotify').html('<i class="far fa-times-circle"></i> ' + arrRes.message);
                toast.show();
                $('#toastBoard, #liveToast').addClass('bg-danger text-light');
                $('#toastBoard').css('width', '300px');
                setTimeout(function () {
                    toast.hide(200);
                    $('#toastNotify').html('');
                    $('#toastBoard').css('width', '260px');
                }, 2000);
            }
        });
        request.fail(function (jqXHR, textStatus) {
            // alert("Request failed: " + textStatus); // check errors
            console.log('jq', jqXHR);
            console.log('sta', textStatus);
        });
    }
}