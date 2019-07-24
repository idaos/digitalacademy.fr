<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>

	<div class="container-slider main-slider slider-header slider-formateur hidden-xs" style="background-image:url(<?php the_field('img_blog', 'option') ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Blog / <?php echo single_cat_title( '', false ); ?></h1>
			</div>
			<p>Suivez l'actualité de la DigitalAcademy©</p>
		</div>
	</div>

	<main class="content">
		<div class="container">
			<div class="wrapper p5000">
				<div class="row clearfix">

					<div class="col-sm-7 container-blog">
						<div class="row clearfix matchHeight-watch">

							<?php
							if ( have_posts() ) :
								while ( have_posts() ) : the_post();
									?>
									<div class="col-sm-6 matchHeight-child">
										<div class="container-border">
											<?php if( has_post_thumbnail() ): ?>
												<?php the_post_thumbnail( 'post-thumbnails' ); ?>
											<?php endif; ?>

											<div class="content-white">
												<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<p class="header-infos"><?php echo get_the_date(); ?> | <?php the_author(); ?></p>
												<p><?php the_excerpt(); ?></p>
												<a href="<?php the_permalink(); ?>" class="btn-orange" rel="nofollow">Lire la suite</a>
											</div>
										</div>
									</div>
								<?php
								endwhile;
							endif;
							?>

						</div>
					</div>
					<aside class="sidebar col-sm-5">
						<?php get_sidebar(); ?>
					</aside>
				</div>

				<?php get_template_part( 'tpl/cta', 'contact' ); ?>
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