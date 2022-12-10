<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <!-- MailChimp Integration -->
    <script id="mcjs">
        ! function(c, h, i, m, p) {
            m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
        }(document, "script", "https://chimpstatic.com/mcjs-connected/js/users/c104d075d46cdfdefd57dc032/421906e8677db194e1145a6a0.js");
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1043125059570375');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1043125059570375&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
    <meta name="facebook-domain-verification" content="xglfmk289uxvq4zgin3q6glz0b6uq7" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<?php if(is_user_logged_in()) : ?>
    <style>
        #kz-menu-wrapper {
            top: 32px;
        }

        @media(max-width:782px) {
            #kz-menu-wrapper {
                top: 0px;
            }
            #wpadminbar {
                display: none;
            }
        }
    </style>
<?php endif ; ?>

</head>

<body <?php body_class(); ?>>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5Z789B3');
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Z789B3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header class="site-header clearfix">
        <div id="kz-menu-wrapper" class="row col-xs-12">
            <div id="kz_header">

                <!-- Blue banner -->
                <?php if (!isset($_COOKIE['bannerClosed'])) : ?>
                    <?php if (get_field('blue_banner_text', 'options')) : ?>
                        <div id="datadock_subheader">
                            <div class="container">
                                <div id="txt">
                                    <?php echo get_field('blue_banner_text', 'options') ?>
                                    <a title="Plus d'info" href="<?php echo the_field('blue_banner_link', 'options') ?>" target="_blank">
                                        <?php if (get_field('blue_banner_link', 'options')) : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/info-icon.svg" width="18" alt="info">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <?php if (get_field('blue_banner_closable', 'options') == 'Oui') : ?>
                                    <div id="cross_sub_header">&#x292B;</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="container relative">

                    <!-- Télécharger le catalogue -->
                    <div>
                        <a href="/demande-de-catalogue/" id="dl-catalogue-btn">
                            <div class="btn-dl btn btn-red">
                                Télécharger le catalogue
                            </div>
                        </a>
                    </div>

                    <!-- Qualiopi / Datadock -->
                    <div>
                        <img id="qualiopi-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/qualiopi-x-datadock.png" alt="Logos qualiopi et datadock">
                    </div>


                    <!-- Tel btn -->
                    <div>
                        <div class="wp-block-button aligncenter is-style-outline btn-phone">
                            <a class="wp-block-button__link wp-element-button" href="tel:0977235321">
                                09 77 23 53 21
                            </a>
                        </div>
                    </div>
                    <div>
                        <i>Appel non surtaxé.</i><br><i>Du lundi au vendredi de 9h30 à 18h</i>
                    </div>

                    <!-- Contact btn -->
                    <div>
                        <div class="wp-block-button aligncenter is-style-outline btn-mail">
                            <a class="wp-block-button__link wp-element-button" href="/contact">
                                Contactez-nous
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <a href="<?php echo site_url(); ?>"><img id="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/DigitalAcademy_logo_alt.svg" alt="<?php bloginfo('name'); ?>"></a>
                <ul class="main-menu">

                    <div class="menu-grid">


                        <!-- Burger icon -->
                        <label for="tm" id="toggle-menu" onclick="animateBurger()">
                            <svg class="" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 18.8 15.9" style="enable-background:new 0 0 18.8 15.9;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #bd3c30;
                                    }
                                </style>
                                <rect class="r1 st0" width="18.8" height="1.5" />
                                <rect y="13.6" class="r2 st0" width="18.8" height="1.5" />
                                <rect y="6.8" class="r3 st0" width="18.8" height="1.5" />
                            </svg>
                        </label>

                        <!-- Logo mobile -->
                        <a href="<?php echo site_url(); ?>"><img id="logo-mobile" src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital-academy-logo.jpg" alt="<?php bloginfo('name'); ?>"></a>

                        <!-- Tel btn mobile -->
                        <div id="btn-tel-mobile">
                            <div class="wp-block-button aligncenter is-style-outline btn-phone">
                                <a class="wp-block-button__link wp-element-button" href="tel:0977235321" style="white-space: nowrap;">
                                    09 77 23 53 21
                                </a>
                            </div>
                        </div>

                    </div>


                    <input type="checkbox" id="tm">
                    <?php wp_nav_menu(array('theme_location' => 'top', 'container' => false, 'menu_id' => 'menu', 'walker' => new KZ_Walker_Digital_Top_Menu())); ?>
                </ul>
            </div>
        </div>
    </header><!-- Header end -->
    <div class="site-container clearfix">
        <!-- BreadCrumbs -->
        <?php if (!is_front_page()) : ?>
            <?php
            global $wp_query;
            $template_name = get_post_meta($wp_query->post->ID, '_wp_page_template', true);
            if (($template_name != 'template-nos-solutions-de-formation.php')&&($template_name != 'template-pages-solutions.php')) :; ?>
                    <div class="breadcrumb">
                        <div class="container">
                            <?php if (function_exists('yoast_breadcrumb')) {  yoast_breadcrumb(); } ?>
                            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>