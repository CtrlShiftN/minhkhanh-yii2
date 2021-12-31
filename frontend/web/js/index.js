let animates = [
    'animate__backInDown',
    'animate__backInLeft',
    'animate__backInRight',
    'animate__backInUp',
    'animate__bounceIn',
    'animate__bounceInDown',
    'animate__bounceInLeft',
    'animate__bounceInRight',
    'animate__bounceInUp',
    'animate__fadeIn',
    'animate__fadeInDown',
    'animate__fadeInDownBig',
    'animate__fadeInLeft',
    'animate__fadeInLeftBig',
    'animate__fadeInRight',
    'animate__fadeInRightBig',
    'animate__fadeInUp',
    'animate__fadeInUpBig',
    'animate__fadeInTopLeft',
    'animate__fadeInTopRight',
    'animate__fadeInBottomLeft',
    'animate__fadeInBottomRight',
    'animate__flipInX',
    'animate__flipInY',
    'animate__lightSpeedInRight',
    'animate__lightSpeedInLeft',
    'animate__jackInTheBox',
    'animate__rollIn',
    'animate__zoomIn',
    'animate__zoomInDown',
    'animate__zoomInLeft',
    'animate__zoomInRight',
    'animate__zoomInUp',
    'animate__slideInDown',
    'animate__slideInLeft',
    'animate__slideInRight',
    'animate__slideInUp'
]
let default_animate = 'animate__fadeInUp';
$(document).ready(function () {
    $('#banner-slide .swiper-slide-active').children('.content-wrapper').addClass(default_animate);
    swiper.on('slideChange', function () {
        $('#banner-slide .swiper-slide-active').children('.content-wrapper').removeClass(default_animate);
    });
});
swiper.on('slideChangeTransitionStart', function () {
    let rand_index = Math.floor((Math.random() * (animates.length - 1)));
    let rand_animate = animates[rand_index];
    $('#banner-slide .swiper-slide-active').children('.content-wrapper').addClass(rand_animate);
    swiper.on('slideChange', function () {
        $('#banner-slide .swiper-slide-active').children('.content-wrapper').removeClass(rand_animate);
    });
});