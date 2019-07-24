<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb();
			}
			?>
		</div>
	</div>

<?php
// Start the Loop.
$formateur_ID = get_queried_object_id();
?>
	<div class="container-slider main-slider slider-header slider-formateur">

		<?php if ( get_field( 'avatar', 'formateur_' . $formateur_ID ) ): ?>
			<img src="<?php the_field( 'avatar', 'formateur_' . $formateur_ID ); ?>"
			     alt="<?php echo single_cat_title(); ?>" width="100" height="100">
		<?php endif; ?>

		<h1><?php echo single_cat_title(); ?></h1>

		<?php if ( get_field( 'specialite', 'formateur_' . $formateur_ID ) ): ?>
			<p><?php the_field( 'specialite', 'formateur_' . $formateur_ID ); ?></p>
		<?php endif; ?>

		<?php if ( have_rows( 'reseaux', 'formateur_' . $formateur_ID ) ): ?>

			<ul class="picto clearfix">

				<?php while ( have_rows( 'reseaux', 'formateur_' . $formateur_ID ) ) : the_row(); ?>

					<?php if ( get_sub_field( 'url' ) ): ?>
						<li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank"><img
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-<?php echo the_sub_field( 'reseau' ); ?>-rounded.png"
									alt=""/></a></li>
					<?php endif; ?>

				<?php endwhile; ?>

			</ul>

		<?php endif; ?>

	</div>


	<main class="content">
		<div class="wrapper">
			<div class="container">

				<?php if ( get_field( 'biographie', 'formateur_' . $formateur_ID ) ): ?>
					<div class="full-width bg-gray fs20 p30 border-left-bold">
						<?php the_field( 'biographie', 'formateur_' . $formateur_ID ); ?>
					</div>
				<?php endif; ?>

				<?php if ( get_field( 'video_url', 'formateur_' . $formateur_ID ) ): ?>

					<div class="border-light fs20 display-table p30 margin-mobil">
						<h2>Vidéo</h2>

						<div class="clearfix row">
							<div class="col-sm-4">
								<a href="<?php the_field( 'video_url', 'formateur_' . $formateur_ID ); ?>"
								   target="_blank">
									<img src="<?php the_field( 'video_image', 'formateur_' . $formateur_ID ); ?>"
									     alt=""/>
								</a>
							</div>
							<div class="col-sm-4 text-center">
								<img
									src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-digital-academy-video.jpg"
									alt=""/>

								<p class="m2020">Retrouvez toutes nos vidéos sur note châine Dailymotion</p>
								<a href="<?php echo get_field( 'url_dailymotion', 'option' ); ?>" class="btn-orange">Cliquez
									ici</a>
							</div>
							<div class="col-sm-4 text-center">
								<p><strong>Une question ?</strong></p>

								<p>Appelez-nous au</p>

								<p><?php echo get_field( 'telephone', 'option' ); ?></p>

								<p>OU</p>
								<a href="<?php echo get_field( 'page_contact', 'option' ); ?>" class="btn-orange">Contactez-nous</a>
							</div>
						</div>
					</div>

				<?php endif; ?>
			</div>

			<?php $formations = do_shortcode('[formations_slider nb=20 taxo="formateur"]');
			if ( ! empty( $formations ) ) : ?>
				<div class="full-width bg-gray p30 content-actu-formation">
					<div class="p030 clearfix">
						<h3>Ses formations DigitalAcademy©</h3>

						<div class="row">
							<?php echo $formations; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</main><!-- Main end -->

	<div class="wrapper text-center container-reference">
		<div class="p030">
			<h3>Nos références clients en formation</h3>
			<?php echo do_shortcode( '[references_slider]' ); ?>
		</div>
	</div>

<?php get_footer(); ?>