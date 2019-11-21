<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php wp_head(); ?>
        <!-- Google Tag Manager 
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5Z789B3');
</script> -->
        <!-- Check if adblocker is active -->
        <script id="fake-ads" type = "text/javascript" src="https://www.digitalacademy.fr/wp-content/themes/digitalacademy/js/ads.js"></script>
        <script>
            // register adblocker info to GA
            var script = document.querySelector('#fake-ads');
            script.addEventListener('load', function() {
                if(document.getElementById('KzwTIARDzQclBa')){
                    window.adsblocked = 'No';
                } else {
                    window.adsblocked = 'unknown';
                }
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: "Window Loaded",
                    adsblocker: adsblocked
                });
            });
        </script>
    </head>
    <body <?php body_class(); ?>>
        <!-- Google Tag Manager (noscript) -->
        <!--
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Z789B3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
-->
        <!-- End Google Tag Manager (noscript) -->

        <header class="site-header clearfix">

            <div id="kz-menu-wrapper" class="row col-xs-12">
                <div id="kz_header">
                    <div class="container relative">
                        <a href="/demande-de-catalogue/" id="dl-catalogue-btn">
                            <div class="btn btn-xs btn-gray">
                                Télécharger le catalogue
                            </div>
                        </a>
                        <a href="tel:0977215321">
                            <div class="btn btn-xs btn-gray" id="btn-phone">
                                09 77 21 53 21
                            </div>
                        </a>
                        <i>Appel non surtaxé. Nos conseillers vous répondent du lundi au vendredi de 9h30 à 18h</i>
                        <div class="to-right">
                            <a href="/contact/">
                                <div class="btn btn-xs btn-red" style="background-color:#be3929; color:#fff;">
                                    Contact
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <a href="<?php echo site_url(); ?>"><img id="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/DigitalAcademy_logo_alt.svg" alt="<?php bloginfo('name'); ?>"></a>
                    <ul class="main-menu">
                        <label for="tm" id="toggle-menu" onclick="animateBurger()">
                            <svg class="" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 18.8 15.9" style="enable-background:new 0 0 18.8 15.9;" xml:space="preserve">
                                <style type="text/css">
                                    .st0{fill:#8e8e8e;}
                                </style>
                                <rect class="r1 st0" width="18.8" height="1.5"/>
                                <rect y="13.6" class="r2 st0" width="18.8" height="1.5"/>
                                <rect y="6.8" class="r3 st0" width="18.8" height="1.5"/>
                            </svg>
                        </label>
                        <input type="checkbox" id="tm">

                        <?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_id' => 'menu','walker' => new KZ_Walker_Digital_Top_Menu() ) ); ?>
                    </ul>
                </div>
            </div>

        </header><!-- Header end -->

        <div class="site-container clearfix">  