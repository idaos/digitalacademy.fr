jQuery(document).ready(function ($) {

    $('.site-header .navbar .arrow').on('click', function(){
        $(this).parent().toggleClass('active');
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