$(function () {
    $('.slider').slick({
        Infinity: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        centerMode: true,
        centerPadding: '0',

        prevArrow: '<span class="prev-arrow"><i class="fas fa-chevron-circle-left"></i></span>',
        nextArrow: '<span class="next-arrow"><i class="fas fa-chevron-circle-right"></i></span>',

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '30',
                    slidesToShow: 3,
                    dots: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '20',
                    slidesToShow: 1,
                    dots: false,
                }
            }
        ]
    });
});