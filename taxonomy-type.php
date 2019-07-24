<?php get_header(); ?>

<?php $thematique_ID = get_queried_object_id(); ?>

<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb();
		} ?>
	</div>
</div>

<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field( 'img_bandeau', 'type_' . get_queried_object_id() ) ?>)">
	<div class="slick-slide">
		<div class="clearfix">
			<h1 class="title-slider">Nos références en formation</h1>
		</div>
	</div>
</div>

<div class="full-width bg-orange content-declinaison text-center">
	<div class="clearfix">
		<span>Filtrer les références en formation :</span>
		<?php echo digital_get_type_menu(); ?>
	</div>
</div>

<div class="xs-container-menu-filtre">
	<div class="container-menu-filtre">
		<div class="container">
			<?php echo digital_get_reference_menu( $thematique_ID ); ?>
		</div>
	</div>
</div>

<main class="content">
	<div class="container">

		<div class="full-width bg-gray">
			<div class="row">
				<h2>Nos références <?php echo  strtolower( esc_html(get_queried_object()->name ) ); ?></h2>

				<?php if ( have_posts() ) : ?>
				<div class="row">
					<div class="container-slider references clearfix matchHeight-watch">
								<?php // Start the Loop.
								$i = 0;
								while( have_posts() ) : the_post(); ?>
								<div class="col-sm-3 bloc-formation matchHeight-child">
									<a href="<?php echo esc_url( get_field( 'url' ) ); ?>" target="_blank">
										<div class="container-bg-white clearfix">
											<?php the_post_thumbnail(); ?>
										</div>
									</a>
								</div>
								<?php
								if ( $i % 4 == 3 ) {
									echo '</div></div><div class="row"><div class="container-slider references clearfix matchHeight-watch">';
								}
								$i ++;
								endwhile; ?>
							</div>
						</div>
					<?php else : ?>
					<h3>Aucun résultats correspondant à vos critères !</h3>
				<?php endif; ?>
			</div>
		</div>
	</main><!-- Main end -->

	<div class="full-width bg-orange full-width-contact">
		<p class="clearfix"><span class="m-100">Une question sur nos formations ?</span> <a
			href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">Demander le catalogue</a>
		</p>
	</div>

	<?php get_footer(); ?>