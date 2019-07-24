<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>

	<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field('img_dans_les_medias', 'option') ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Dans les médias</h1>
			</div>
			<p>Découvrez comment la presse nous relaie régulièrement dans les médias offline</p>
		</div>
	</div>

	<main class="content">
		<div class="container">

			<div class="wrapper">
				<div class="full-width bg-gray fs20 p30 border-left-bold">
					<?php echo the_field('intro_dans_les_medias', 'options') ?>
				</div>

				<div class="p30">
					<div class="row clearfix p015">
						<?php
						if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();
								the_content();
								?>

								<div class="border-block">
									<div class="container-business-case bg-gray-light">
										<div class="clearfix row-height">
											<?php if( has_post_thumbnail() ): ?>
												<div class="col-sm-2 text-center col-height col-middle">
													<?php the_post_thumbnail('press'); ?>
												</div>
											<?php endif; ?>
											<div class="col-sm-10 col-height col-middle">
												<h3 class="sub-title">
													<?php if( get_field( 'url_media' ) ): ?>
														<a href="<?php the_field('url_media'); ?>" target="_blank">
													<?php endif; ?>
                                                                                                            <?php if( get_field( 'source_media' ) ): ?>
														<strong><?php the_field('source_media'); ?></strong> -
                                                                                                            <?php endif; ?>            
                                                                                                            <?php the_title(); ?>
                                                                                                            <?php if( get_field( 'date_media' ) ): ?>
														- <?php the_field('date_media'); ?>
                                                                                                            <?php endif; ?>
													<?php if( get_field( 'url_media' ) ): ?>
														</a>
													<?php endif; ?>
												</h3>
											</div>
										</div>
									</div>
								</div>
								<?php
							endwhile;
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
						endif;
						?>
						<div class="col-sm-12">
							<?php wpbeginner_numeric_posts_nav(); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="full-width bg-orange full-width-contact">
				<p class="clearfix"><span class="m-100">Découvrez la liste complète  de nos formations ?</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</De></a></p>
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