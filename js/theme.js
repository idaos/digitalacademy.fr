jQuery(document).ready(function ($) {

    $(".navbar-toggle").click(function () {
        if ($(this).hasClass("active")) {
            $('.navbar-toggle').removeClass("active");
        } else {
            $(this).addClass("active");
        }
    });

    $('.site-header .navbar .arrow').on('click', function(){
        $(this).parent().toggleClass('active');
    });
    $(".content-show").click(function () {
        $(this).toggleClass("show");
    });

    $(document).on('click', 'a', function () {
        var the_hash = $(this).attr("href");
        if (typeof (the_hash) != 'undefined')
        {
            if (the_hash.match("\#(.+)")) {
                $('html,body').animate({scrollTop: $(the_hash).offset().top - 150}, 'slow');
                return false;
            }
        }
    });

    $('.page-template-tpl-nos-thematiques .content-theme ul').easyListSplitter({ colNumber:2 });

    $('.slide-logo').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        appendArrows: $('.slide-logo'),
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="previous" style="display: inline-block;">Previous</button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="next" style="display: inline-block;">Next</button>',
        responsive:[
            {
                breakpoint:1700,
                settings:{
                    slidesToShow:7
                }
            },
            {
                breakpoint:1500,
                settings:{
                    slidesToShow:6
                }
            },
            {
                breakpoint:1100,
                settings:{
                    slidesToShow:5
                }
            },
            {
                breakpoint:770,
                settings:{
                    slidesToShow:1
                }
            }
        ]
    });

    $('.slide-formations').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        appendArrows: $('.slide-formations'),
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="previous" style="display: inline-block;">Previous</button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="next" style="display: inline-block;">Next</button>',
        responsive:[
            {
                breakpoint:1550,
                settings:{
                    slidesToShow:4
                }
            },
            {
                breakpoint:770,
                settings:{
                    slidesToShow:1
                }
            }
        ]
    });

    $('.slide-home').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 7000,
        appendArrows: $('.slide-home'),
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="previous" style="display: inline-block;">Previous</button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="next" style="display: inline-block;">Next</button>'
    });


    /* Equal Height row by row */
    $('.matchHeight-watch').each(function() {
        $(this).find('.matchHeight-child').matchHeight();
    });

    $( 'body' ).append('<a href="#" class="back-top">↑</a>');
    // Back to top
    var offset = 220;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-top').fadeIn(duration);
        } else {
            $('.back-top').fadeOut(duration);
        }
    });

    $('.back-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });


});

