<?php
/**
*   Template Name: Nos formateurs
*/
?>
<?php get_header();
if( has_post_thumbnail() ) {
	$class = '';

	$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	$bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center"';
}
?>
	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>

	<div class="container-slider main-slider slider-header slider-formateur hidden-xs" <?php echo $bg; ?>>
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider"><?php the_title(); ?></h1>
			</div>
			<?php if( get_field( 'sous_titre' ) ): ?>
				<p><?php the_field( 'sous_titre' ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<main class="content">
		<div class="container">
			<div class="wrapper">

				<?php if( get_field( 'texte_introduction' ) ): ?>
					<div class="full-width bg-gray fs20 p30 border-left-bold">
						<p><?php the_field( 'texte_introduction' ); ?></p>
					</div>
				<?php endif; ?>

				<div class="full-width bg-gray content-formateur text-center fs20">
					<div class="row clearfix  matchHeight-watch">

						<?php
						$formateurs = get_terms( 'formateur', array('hide_empty'=>false) );

						if ( $formateurs )
						{
							$i=0;
							foreach( $formateurs as $formateur )
							{
								?>
								<div class="col-sm-3 matchHeight-child">
									<div class="container-white">
										<div class="container-bg-white clearfix">
											<?php if( get_field( 'avatar', 'formateur_'. $formateur->term_id ) ): ?>
												<div class="img-center">
													<img src="<?php the_field( 'avatar', 'formateur_'. $formateur->term_id ); ?>" alt="<?php echo $formateur->name; ?>" width="100" height="100" >
												</div>
											<?php endif; ?>

											<div class="content-bg-white">
												<p><strong><?php echo $formateur->name; ?></strong></p>
												<?php if( get_field( 'specialite', 'formateur_'. $formateur->term_id ) ): ?>
													<p><?php the_field( 'specialite', 'formateur_'. $formateur->term_id ); ?></p>
												<?php endif; ?>

												<?php
												$formations = get_posts(
													array(
														'posts_per_page' => 3,
														'post_type' => 'formation',
														'tax_query' => array(
															array(
																'taxonomy' => 'formateur',
																'field' => 'term_id',
																'terms' => $formateur->term_id,
															)
														)
													)
												);

												if( $formations )
												{
													foreach( $formations as $formation )
													{
														?>
														<a class="lien-formation" href="<?php echo get_the_permalink( $formation->ID ); ?>"><?php echo $formation->post_title; ?></a>
														<?php
													}
												}
												?>
											</div>
											<div class="text-center">
												<a href="<?php echo get_term_link( $formateur, 'formateur' ); ?>" class="btn-orange">En savoir plus</a>
											</div>
										</div>
									</div>
								</div>
								<?php
								if( $i %4 == 3 ) {
									echo '</div><div class="row clearfix  matchHeight-watch">';
								}
								$i++;
							}
						}

						?>

					</div>
				</div>

				<div class="full-width bg-orange full-width-contact">
					<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
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