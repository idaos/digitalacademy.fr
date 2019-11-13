<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>
	<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field('img_temoignages', 'option') ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Témoignages</h1>
			</div>
			<p><?php the_field( 'testimony_sub_title', 'options' ); ?></p>
		</div>
	</div>
	
	
	<main class="content">
		<div class="container">
			<div class="wrapper">
				<?php $introduction = get_field( 'intro_temoignages', 'options' );
				if( ! empty( $introduction ) ) : ?>
					<div class="full-width bg-gray fs20 p30 border-left-bold">
						<?php echo $introduction; ?>
					</div>
				<?php endif; ?>
				<div id="matchheight-container">
					<div class="row display-flex">
						<?php
						if ( have_posts() ) :
							$i=0;
							// Start the Loop.
							while ( have_posts() ) : the_post();
								?>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<div class="container-border">
										<?php if( has_post_thumbnail() ): ?>
											<div class="content-img">
												<?php the_post_thumbnail(); ?>
											</div>
										<?php endif; ?>
										<div class="content-gray">
											<h2><?php the_title(); ?></h2>
											<?php if( get_field('entreprise') ): ?>
												<strong><?php the_field('entreprise'); ?></strong>
											<?php endif; ?>
											<p><?php the_content(); ?></p>
										</div>
									</div>
								</div>
								<?php
								if( $i %4 == 3 ) {
									echo '</div><div class="row clearfix container-list-block container-list-block-client text-center matchHeight-watch">';
								}
								$i++;
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