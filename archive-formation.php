<?php get_header(); ?>

<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
	</div>
</div>

<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field('img_nos_formations', 'option') ?>)">
	<div class="slick-slide">
		<div class="clearfix">
			<h1 class="title-slider">Catalogue de formations</h1>
		</div>
	</div>
</div>

<div class="full-width bg-orange full-width-contact">
	<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
</div>

<div class="content">
	<div class="container p50">
		<div class="row clearfix border-light fs20 matchHeight-watch">
			<div class="col-sm-3 text-center matchHeight-child">
				<p class="big-title"><strong>Formations</strong></p>
				<img class="mt30" src="<?php echo get_stylesheet_directory_uri(); ?>/images/picto-formation.jpg" alt=""/>
			</div>
			<div class="col-sm-9 text-center matchHeight-child">
				<p class="big-title">Notre catalogue de plus de 30 formations au digital</p>
				<p class="mt30" style="padding: 0 10%;margin:35px 0 25px 0;">Retrouvez en ligne notre catalogue de plus de 30 formations sur le digital, réparties dans les 6 thématiques suivantes : Réseaux Sociaux & E-réputation,  Stratégie de Marketing digital, Contenus Web, Webmarketing et E-publicité, Entreprise 2.0, Mobile & E-commerce</p>
				<a class="btn-gray" href="<?php echo get_field('page_nos_formations', 'option'); ?>">Voir toutes nos formations</a>
			</div>
		</div>
	</div>
</div>


<main class="content">
	<div class="p030">

		<div class="full-width bg-gray" style="padding-top:30px">
			<div class="row">
				<h2>Nos TOP formations digitales</h2>
				<?php echo do_shortcode('[formations_slider]'); ?>

				<div class="text-center clearfix container-btn">
					<p class="top-title mb50 mt10">Plus de 30 formations pour s'approprier la Communication Digitale de A à Z !</p>
					<ul class="list-inline">
						<li><a class="btn-orange btn-gray-hover" href="<?php echo get_field('page_nos_formations', 'option'); ?>">Toutes nos formations</a></li>
						<li><a class="btn-orange btn-gray-hover" href="<?php echo get_field('page_thematiques', 'option'); ?>">Calendrier & Thématiques</a></li>
						<li><a class="btn-orange btn-gray-hover" href="<?php echo get_field('page_contact', 'option'); ?>">Nous contacter</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</main><!-- Main end -->

<div class="wrapper text-center container-reference">
	<div class="p030">
		<h3>Nos références clients en formation</h3>
		<?php echo do_shortcode( '[references_slider]' ); ?>
	</div>
</div>

<?php get_footer(); ?>