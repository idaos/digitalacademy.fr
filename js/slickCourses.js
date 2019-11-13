//-----------------------------------------------------------//
//------------------ Slick Slide courses --------------------//
//-----------------------------------------------------------//
jQuery( document ).ready(function() {
    jQuery('#formations').slick({
        dots: false,
        infinite: true,
        speed: 300,
        variableWidth: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        useTransform: true,
        cssEase: 'ease-out',
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});