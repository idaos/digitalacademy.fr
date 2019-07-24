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

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-5Z789B3');
        </script>
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
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Z789B3"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="site-container clearfix">
            <header class="site-header clearfix"><!-- is-sticky -->
                <div class="container-sticky clearfix">
                    <div class="container-top-header hidden-xs">
                        <span class="tel"><a href="tel:0977215321" style="margin:0"><?php echo get_field('telephone', 'option'); ?></a></span>
                        <a href="<?php echo get_field('page_contact', 'option'); ?>" class="item-1" onclick="return gtag_report_conversion();">Nous contacter</a>
                        <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="item-2">Demander le catalogue</a>
                        <!--<div id="container-search">
                            <form action="<?php //echo home_url(); ?>" method="get" class="search-form" role="search">
                                <input type="search" name="s" placeholder="Rechercher&#x2026;" />
                                <input type="submit" value="Rechercher" />
                            </form>
                        </div>-->
                    </div>
                    <div id="content-logo">
                        <a href="<?php echo site_url(); ?>"><img width="241" height="103" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Digital-Academy-logo-vector-min.svg" alt="<?php bloginfo('name'); ?>"/></a>
                    </div>
                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse">
                            <?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new Walker_Digital_Top_Menu() ) ); ?>
                            <hr/>
                            <div class="menu-social">
                                <p>Nous suivre</p>
                                <div class="social-container">
                                    <a href="https://www.facebook.com/LaDigitalAcademy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-fb-orange.png" alt="" /></a>
                                    <a href="https://twitter.com/digital_ac" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-twitter-orange.png" alt="" /></a>
                                    <a href="https://www.linkedin.com/company/digital-academy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-linkedin-orange.png" alt="" /></a>
                                    <a href="https://www.youtube.com/channel/UCRRym8ZzrDiyAvVbpjaO1_A" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-digital-orange.png" alt="" /></a>
                                </div>
                            </div>
                            <hr/>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </header><!-- Header end -->

            <div class="visible-xs content-tel">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-tel.png" alt="Numéro | Digital Academy"/>
                <span><a href="tel:0977215321" style="margin:0"><?php echo get_field('telephone', 'option'); ?></a></span>
            </div>
