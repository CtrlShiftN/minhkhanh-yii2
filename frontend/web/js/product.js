let category, type, typeName, cursor, sort, show_per_page, cdnUrl, imgUrl, buyNow;
let myUrl = location;
let toastLive = document.getElementById('liveToast');
//get param
const parseUrlQuery = (value) => {
    let urlParams = new URL(value).searchParams
    return Array.from(urlParams.keys()).reduce((acc, key) => {
        acc[key] = urlParams.getAll(key)
        return acc
    }, {})
}
if (parseUrlQuery(myUrl)['type'] !== undefined) {
    type = parseUrlQuery(myUrl)['type'][0];
}

//send request to get link & title
jQuery(document).ready(function () {
    $('#current_page').val(0);
    requestParam()
});

function requestParam() {
    let request = $.ajax({
        url: "/api/ajax/get-link-and-title", // send request to
        method: "POST", // sending method
    });
    request.done(function (response) {
        let arrRes = $.parseJSON(response);
        cdnUrl = arrRes.cdnUrl;
        imgUrl = arrRes.imgUrl;
        show_per_page = arrRes.showPerPage;
        buyNow = arrRes.buyNow;
        requestData();
    });
    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus); // check errors
    });
}

let checkboxes = $('input[type=checkbox]');
$('.accordion-button').click(function () {
    checkboxes.prop("checked", false);
    $('#current_page').val(0);
    cursor = category = sort = null;
    if (!$(this).hasClass('collapsed')) {
        type = $(this).attr('data-type');
        typeName = $(this).attr('data-type-name');
    } else {
        type = typeName = null;
    }
    requestData();
});

let categoryCb = $('.category-checkbox input[type=checkbox]');
categoryCb.change(function () {
    category = getCheckedBoxes(categoryCb);
    $('#current_page').val(0);
    cursor = sort = null;
    requestData();
});

// sort
$(".lowToHigh").click(function () {
    sort = 1;
    $('#current_page').val(0);
    cursor = null;
    requestData();
});
$(".highToLow").click(function () {
    sort = 2;
    $('#current_page').val(0);
    cursor = null;
    requestData();
});
$(".sortByDate").click(function () {
    sort = 3;
    $('#current_page').val(0);
    cursor = null;
    requestData();
});

//get value from checkboxes
function getCheckedBoxes(checkbox) {
    return checkbox.filter(":checked")
        .map(function () {
            return this.value;
        })
        .get();
}

function requestData() {
    let request = $.ajax({
        url: "/api/ajax/product-filter-ajax", // send request to
        method: "POST", // sending method
        data: {
            cate: category,
            cursor: cursor,
            type: type,
            sort: sort,
        }, // sending data
    });

    request.done(function (response) {
        let arrRes = $.parseJSON(response);
        if (typeName !== null) {
            $('#category-name').html(typeName);
            $('#offcanvas-category-name').html(typeName);
        } else {
            $('#category-name').html($('#category-name').attr('data-value'));
            $('#offcanvas-category-name').html($('#offcanvas-category-name').attr('data-value'));
        }
        if (arrRes.status === 1) {
            $('#pagination').show();
            let result = "";
            for (let i = 0; i < arrRes.product.length; i++) {
                //format price
                let selling_price = new Intl.NumberFormat(['ban', 'id']).format(arrRes.product[i].selling_price);
                let regular_price = new Intl.NumberFormat(['ban', 'id']).format(arrRes.product[i].regular_price);
                result += '<div class="col-12 col-sm-6 col-lg-4 mx-0 py-3 position-relative product-card overflow-hidden"><div class="position-relative overflow-hidden w-100 img-shadow"><a href="' + cdnUrl + '/shop/detail?detail=' + arrRes.product[i].id + '" class="text-decoration-none text-dark px-0 w-100 position-relative"><div class="position-relative product-img w-100"><img class="img-product" src="' + imgUrl + '/' + arrRes.product[i].image + '"></div> <div class="pr-inf px-2 px-lg-1 px-xl-2 py-2 w-100 border-top">';
                if (!isNaN(parseInt(arrRes.product[i].discount)) && parseInt(arrRes.product[i].discount) !== 0) {
                    let sale_price = new Intl.NumberFormat(['ban', 'id']).format(arrRes.product[i].sale_price);
                    result += '<span class="px-0 fw-bold mt-2 p-price"><span class="text-decoration-line-through text-dark fw-light fs-regular-price">' + regular_price + 'đ</span> ' + sale_price + 'đ</span>';
                } else {
                    result += '<span class="px-0 fw-bold mt-2 p-price">' + selling_price + 'đ</span>';
                }
                result += '<p class="m-0 product-name">' + arrRes.product[i].name + '</p></div></a>';
                if (!isNaN(parseInt(arrRes.product[i].discount)) && parseInt(arrRes.product[i].discount) !== 0) {
                    result += '<div class="sale-tag"><span>-' + arrRes.product[i].discount + '%</span></div>';
                }
                result += '</div><div class="product-button row m-0">' +
                    '<a href="' + cdnUrl + '/shop/detail?detail=' + arrRes.product[i].id + '" class="btn rounded-0 btnBuyNow col-6 col-md-8"><i class="fas fa-dollar-sign d-md-none"></i><span class="d-none d-md-inline-block"><i class="fas fa-dollar-sign"></i> ' + buyNow + '</span></a>' +
                    '<button data-id="' + arrRes.product[i].id + '" class="btn rounded-0 btnAdd col-6 col-md-4" onclick="addToFavorite(this)"><i class="far fa-heart"></i></button></div></div>';
            }
            $("#result").html(result);
            //show pagination
            let number_of_items = arrRes.count;
            let number_of_pages = Math.ceil(number_of_items / show_per_page);
            jQuery(document).ready(function () {
                let navigation_html = '<a class="first_link" href="javascript:first();">&#10094;&#10094;</a> <a class="previous_link" href="javascript:previous();">&#10094;</a>';
                let current_link = 0;
                while (number_of_pages > current_link) {
                    navigation_html += ' <a class="page_link" href="javascript:go_to_page(' + current_link + ')" id="page' + (current_link + 1) + '">' + (current_link + 1) + '</a>';
                    current_link++;
                }
                navigation_html += ' <a class="next_link" href="javascript:next();">&#10095;</a> <a class="last_link" href="javascript:last(' + number_of_pages + ');">&#10095;&#10095;</a>';
                $('#page_navigation').html(navigation_html);
                let active = parseInt($('#current_page').val()) + 1;
                $('#page' + active + '').addClass('p-active bg-dark text-light');
                //hide button when first or last page is active
                if (active == 1) {
                    $('.first_link, .previous_link').css({
                        'display': 'none',
                    });
                } else if (active == current_link) {
                    $('.next_link, .last_link').css({
                        'display': 'none',
                    });
                }
                if (number_of_pages == 1) {
                    $('#page_navigation').hide();
                } else {
                    $('#page_navigation').show();
                }
                if (number_of_pages > 3) {
                    if (active < 2) {
                        $('.page_link').addClass('d-none');
                        let i = 1;
                        while (i < 4) {
                            $('#page' + i + '').removeClass('d-none');
                            i++;
                        }
                    } else if (active > current_link - 1) {
                        $('.page_link').addClass('d-none');
                        let i = current_link;
                        while (i > current_link - 3) {
                            $('#page' + i + '').removeClass('d-none');
                            i--;
                        }
                    } else {
                        $('.page_link').addClass('d-none');
                        $('#page' + (active - 1) + ',#page' + active + ',#page' + (active + 1) + '').removeClass('d-none');
                    }
                }
            });
            $('html').scrollTop(0);
        } else {
            let result = '<div class="text-center col-12 p-0"><h1 class="mainColor"><i class="fab fa-sistrix"></i></h1><h5 class="mainColor"><i>Không có sản phẩm để hiển thị</i></h5><h5 class="mainColor"><i>Bạn hãy thử tìm kiếm lại!</i></h5></div>';
            $('#pagination').hide();
            $("#result").html(result);
            $('html').scrollTop(0);
        }
    });
    request.fail(function (jqXHR, textStatus) {
        console.log(jqXHR);
        alert("Request failed: " + textStatus); // check errors
    });
}

function addToFavorite(obj) {
    var productID = obj.getAttribute('data-id');
    if ($('#sth').attr('data-id') == 1) {
        window.location.href = "/site/login?ref=" + window.location.pathname;
    } else {
        let request = $.ajax({
            url: "/api/ajax/add-to-favorite", // send request to
            method: "POST", // sending method
            data: {
                id: productID,
            },
        });
        request.done(function (response) {
            let arrRes = $.parseJSON(response);
            if (arrRes.status === 1) {
                let toast = new bootstrap.Toast(toastLive);
                $('#toastNotify').html('<i class="fas fa-check-circle"></i> ' + arrRes.message);
                toast.show();
                $('#toastBoard, #liveToast').removeClass('bg-danger text-light').addClass('bg-success text-light');
                setTimeout(function () {
                    toast.hide(200);
                    $('#toastNotify').html('');
                }, 2000);
            } else {
                let toast = new bootstrap.Toast(toastLive);
                $('#toastNotify').html('<i class="far fa-frown-open"></i> ' + arrRes.message);
                toast.show();
                $('#toastBoard, #liveToast').removeClass('bg-success text-light').addClass('bg-danger text-light');
                setTimeout(function () {
                    toast.hide(200);
                    $('#toastNotify').html('');
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

function first() {
    if ($('#current_page').val() != 0) {
        go_to_page(0);
    }
}

function previous() {
    let new_page = parseInt($('#current_page').val()) - 1;
    if ($('#current_page').val() != 0) {
        go_to_page(new_page);
    }
}

function next() {
    let new_page = parseInt($('#current_page').val()) + 1;
    if ($('#current_page').val() != ($("#page_navigation").children(".page_link").length - 1)) {
        go_to_page(new_page);
    }
}

function last() {
    let number_of_pages = $("#page_navigation").children(".page_link").length;
    if ($('#current_page').val() != number_of_pages - 1) {
        go_to_page(number_of_pages - 1);
    }
}

function go_to_page(page_num) {
    cursor = page_num;
    $('#current_page').val(page_num);
    requestData();
}