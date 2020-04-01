<?php get_header(); ?>

	<div class="container-slider main-slider slider-header hidden-xs"
	     style="background-image:url(<?php the_field( 'img_etudes_de_cas', 'option' ) ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Etudes de cas</h1>
			</div>
			<p>Consultez nos études de cas, témoins de l’éventail de nos interventions</p>
		</div>
	</div>

	<main class="content">
		<div class="container">

			<div class="wrapper">
				<div class="full-width bg-gray fs20 p30 border-left-bold">
					<p>Vous en saurez plus sur nos clients, retrouverez les objectifs du programme, la réponse
						DigitalAcademy, l’approche pédagogique et les témoignages de nos apprenants. </p>
				</div>

				<div class="p30">
					<h2 class="text-center">Nos études de cas</h2>

					<div class="row clearfix p015">
						<?php
						if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();
								?>

								<div class="border-block" id="<?php echo $post->post_name ?>">
									<div class="container-business-case bg-gray-light same-height-logo">
										<div class="clearfix row-height">
											<?php if ( has_post_thumbnail() ): ?>
												<div class="col-sm-3 text-center equal-height-column">
													<?php the_post_thumbnail(); ?>
												</div>
											<?php endif; ?>
											<div class="col-sm-9">
												<p class="sub-title"><strong><?php the_title(); ?></strong></p>
												<?php if ( get_field( 'prestation' ) ): ?>
													<p class="sub-title"><?php the_field( 'prestation' ); ?></p>
												<?php endif; ?>
												<?php if ( get_field( 'objectif' ) ): ?>
													<p>
														<?php the_field( 'objectif' ); ?>
														<?php if ( get_field( 'duree' ) ): ?>
															<br>Durée : <?php the_field( 'duree' ); ?>
														<?php endif; ?>
													</p>
												<?php endif; ?>
											</div>
										</div>

										<?php if ( get_field( 'descriptif' ) ): ?>
											<div class="content-business-case">
												<p class="sub-title"><strong>Descriptif de la mission</strong></p>
												<?php the_field( 'descriptif' ); ?>
											</div>
										<?php endif; ?>

										<?php if ( $temoignages = get_field( 'temoignage' ) ): ?>
											<div class="content-business-case">
												<p class="sub-title"><strong>Témoignages</strong></p>

												<?php foreach ( $temoignages as $temoignage ): ?>
													<strong><?php echo $temoignage->post_title; ?></strong>
													<p>« <?php echo $temoignage->post_content; ?> »</p>
												<?php endforeach; ?>

											</div>
										<?php endif; ?>

									</div>
								</div>
							<?php
							endwhile;
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
						endif;
						?>

					</div>
				</div>
			</div>

			<?php get_template_part( 'tpl/cta', 'contact' ); ?>

		</div>
	</main><!-- Main end -->


<?php get_footer(); ?>