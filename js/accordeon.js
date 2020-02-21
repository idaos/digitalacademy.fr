jQuery(document).ready(function ($) {

    jQuery(".toggleplus").click(function () {
        jQuery(this).parent('.content-show').toggleClass("show");
    });
});