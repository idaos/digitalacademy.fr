<?php
/**
 *   Template Name: Nos formations
 */
?>
<?php get_header();
if ( has_post_thumbnail() ) {
	$class = '';

	$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
//	$bg  = 'style="background-image:url(\'' . $url . '\');background-size: cover;background-position:center"';
    	$bg  = 'style="background-image:url(\'https://www.digitalacademy.fr/wp-content/uploads/2018/12/dac-fr_visuel-catalogue.jpg\');background-size: cover;background-position:center"';

}
?>
<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb();
		} ?>
	</div>
</div>

<div class="container-slider main-slider nos-formations slider-header hidden-xs" <?php echo $bg; ?>>
	<div class="slick-slide">
		<div class="clearfix">
			<h1 class="title-slider"><?php the_title(); ?></h1>
		</div>
		<?php if ( get_field( 'sous_titre' ) ): ?>
		<p><?php the_field( 'sous_titre' ); ?></p>
	<?php endif; ?>
</div>
</div>

<div class="full-width bg-orange full-width-contact">
	<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a
		href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">Demander le
		catalogue</a></p>
	</div>

	<div class="xs-container-menu-filtre">
		<div class="container-menu-filtre hidden-xs">
			<div class="container">
				<?php echo digital_get_thematiques_menu( false, true ); ?>
			</div>
		</div>
	</div>

	<main class="content">
		<div class="container">

			<div class="full-width bg-gray">
				<?php
				$args = array(
					'posts_per_page' => - 1,
					'post_type'      => 'formation',
					);
				if ( isset( $_GET['thematique'] ) && ! empty( $_GET['thematique'] ) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'thematique',
							'terms'    => $_GET['thematique'],
							'field'    => 'slug'
							)
						);
				}
				$formations = get_posts( $args );

				if ( $formations ) {
					$i = 0;
					?>

					<div class="row">
						<div class="container-slider clearfix matchHeight-watch">

							<?php
							foreach ( $formations as $formation ) {
								?>
								<div class="col-sm-3 bloc-formation matchHeight-child">
									<div class="container-bg-white clearfix">
										<?php if ( get_field( 'image_header_formation', $formation->ID ) ): ?>
										<img src="<?php the_field( 'image_header_formation', $formation->ID ); ?>"
										alt="">
										<?php if ( get_field( 'nouvelle_formation', $formation->ID ) ): echo "<div class='nouvelle_formation'></div>" ?><?php endif; ?>
									<?php endif; ?>
									<div class="content-bg-white">
										<h4><?php echo get_the_title( $formation->ID ); ?></h4>
										<?php if ( get_field( 'presentation', $formation->ID ) ): ?>
										<p><?php echo wp_trim_words( get_field( 'presentation', $formation->ID ), 20, '...' ); ?></p>
									<?php endif; ?>
								</div>
								<div class="text-center">
									<a href="<?php echo get_the_permalink( $formation->ID ); ?>"
										class="btn-gray">En savoir plus</a>
									</div>
								</div>
							</div>
							<?php
							if ( $i % 4 == 3 ) {
								echo '</div></div><div class="row"><div class="container-slider clearfix matchHeight-watch">';
							}
							$i ++;
						}
						?>
					</div>
				</div>
				<?php
			}

			?>

		</div>
	</div>
</main><!-- Main end -->

<div class="wrapper text-center container-reference">
	<h3>Nos références clients en formation</h3>
	<?php echo do_shortcode( '[references_slider]' ); ?>
</div>

<?php get_footer(); ?>