//-----------------------------------------------------------//
//------------------ Slick Opcos refs --------------------//
//-----------------------------------------------------------//
jQuery( document ).ready(function() {
    jQuery('#opcos .wrapper').slick({
        dots: false,
        infinite: true,
        speed: 300,
        variableWidth: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        useTransform: true,
        cssEase: 'ease-out',
        responsive: [
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 850,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});