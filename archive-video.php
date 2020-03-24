<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb();
			} ?>
		</div>
	</div>

	<div class="container-slider main-slider nos-videos slider-header hidden-xs"
	     style="background-image:url(<?php the_field( 'img_nos_videos', 'option' ) ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Nos vidéos</h1>
			</div>
			<p>Consultez nos vidéos pour vous faire une idée de la formation DigitalAcademy</p>
		</div>
	</div>
	<main class="content">
		<div class="container">

			<div class="wrapper">
				<div class="full-width bg-gray fs20 p30 border-left-bold">
					<?php echo the_field( 'intro_nos_videos', 'options' ) ?>
				</div>
        <?php 
            //echo $htmlcode = apply_filters('the_content', get_field( 'url_video' ));
            //echo wp_oembed_get(get_field( 'url_video' ));
        ?>

				<div class="p30">
					<div class="row clearfix text-center">
						<?php if ( have_posts() ) :
							$i     = 0;
							$first = true;
							// Start the Loop.
							while ( have_posts() ) : the_post();
								if ( $first ): ?>
                                                                                                        <?php //echo wp_oembed_get(get_field( 'url_video' )); ?>
										<div class="border-light fs20 display-table p30 margin-mobil">
											<div class="clearfix row">
												<div class="col-sm-5 text-center matchHeight-child equal-height-column">
													<?php 
                                                                                                            echo wp_oembed_get(
														get_field( 'url_video' ),
														array( 'width'  => 463)
                                                                                                            ); ?>
                                                                                                        <?php 
                                                                                                            //echo $htmlcode = apply_filters('the_content', get_field( 'url_video' ));
                                                                                                            //echo wp_oembed_get(get_field( 'url_video' ));
                                                                                                        ?>
													<h2><?php the_title(); ?></h2>
												</div>
												<div class="col-sm-4 text-center matchHeight-child equal-height-column">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-digital-academy-video.jpg" alt=""/>
													<p class="m2020">Retrouvez toutes nos vidéos sur note chaîne YouTube</p>
													<a target="_blank" href="<?php echo get_field( 'url_dailymotion', 'option' ); ?>" class="btn-orange">Cliquez ici</a>
												</div>
												<div class="col-sm-3 text-center video-contact matchHeight-child equal-height-column">
													<p><strong>Une question ?</strong></p>
													<p>Appelez-nous au</p>
													<p><?php echo get_field( 'telephone', 'option' ); ?></p>
													<p>OU</p>
													<a href="<?php echo get_field( 'page_contact', 'option' ); ?>" class="btn-orange">Contactez-nous</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix text-center"> <!-- close first row -->
									<?php $first = false;
								else : ?>
									<div class="col-sm-4 matchHeight-child">
										<?php 
                                                                                    echo wp_oembed_get(
											get_field( 'url_video' ),
											array( 'width'  => 400, 'height' => 224)
                                                                                    );
                                                                                    //echo $htmlcode = apply_filters('the_content', get_field( 'url_video' ));
                                                                                ?>
										<h2><?php the_title(); ?></h2>
									</div>
									<?php if ( $i % 3 == 2 ) :
										echo '</div><div class="row clearfix text-center">';
									endif;
									$i ++;
								endif;
							endwhile;
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
						endif; ?>
					</div>
				</div>
			</div>

			<div class="full-width bg-orange full-width-contact">
				<p class="clearfix"><span class="m-100">Découvrez la liste de nos formations</span>
					<a href="/nos-formations/" class="btn-white">Cliquez-ici</a>
				</p>
			</div>

		</div>
	</main><!-- Main end -->

    <section id="references">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br>
                    <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                    <hr>
                    <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                    <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                    <br><br><br><br><br>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>