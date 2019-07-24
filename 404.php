<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>

        <div class="container-slider main-slider slider-header hidden-xs"> 
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/dgac-default.jpg" alt="" />
        </div>

	<main class="content">
		<div class="container">
			<h1>404 - Page non trouvée</h1>
                        <p>Oups, la page n'existe pas...</p>
                        <p>Retourner à la <strong><a href="<?php echo site_url() ?>">page d'accueil DigitalAcademy©</a></strong></p>
		</div>
	</main><!-- Main end -->
        <img style="width:100%" src="<?php echo get_stylesheet_directory_uri() ?>/images/404-default.jpg" alt="" />
        <div class="full-width bg-orange full-width-contact">
            <p class="clearfix"><span class="m-100">Recevez notre catalogue de formations :</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</De></a></p>
        </div>
<?php get_footer(); ?>