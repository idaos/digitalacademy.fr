<?php get_header(); ?>

	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb();
			} ?>
		</div>
	</div>

	<div class="container-slider main-slider slider-header slider-formateur hidden-xs"
	     style="background-image:url(<?php the_field( 'img_blog', 'option' ) ?>)">
		<div class="slick-slide">
			<div class="clearfix">
				<h1 class="title-slider">Blog</h1>
			</div>
			<p><?php the_field( 'sous_titre', get_queried_object_id() ); ?></p>
		</div>
	</div>
	<main class="content">
		<div class="container">
			<div class="wrapper">
				<?php $introduction = get_field( 'texte_introduction', get_queried_object_id() );
				if( ! empty( $introduction ) ) : ?>
					<div class="full-width bg-gray fs20 p30 border-left-bold">
						<p><?php echo $introduction; ?></p>
					</div>
				<?php endif; ?>
				<div class="row clearfix p5000">
					<div class="col-sm-8 container-blog">
						<div class="row display-flex clearfix">
							<?php
							if ( have_posts() ) :
								while ( have_posts() ) : the_post();
									?>
									<div class="col-sm-6 ">
										<div class="thewrapper container-border">
										    <a href="<?php the_permalink(); ?>" rel="nofollow">											<?php if ( has_post_thumbnail() ): ?>												<?php $post_thumbnail_id = get_post_thumbnail_id( $post ); ?>												<?php $post_thumbnail_url = wp_get_attachment_image_url( $post_thumbnail_id, 'post-thumbnails' ); ?>																								<div class="blog-thumb-wrapper" style="background-image:url(<?php echo $post_thumbnail_url ?>) ;"></div>												<?php else : ?>												<div class="blog-thumb-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/blog-thumb-placeholder.jpg) ;"></div>											<?php endif; ?>                                            </a>
											<div class="content-white">
												<h2><a href="<?php the_permalink(); ?>"
												       rel="bookmark"><?php the_title(); ?></a></h2>

												<p class="header-infos"><?php echo get_the_date(); ?>
													| <?php the_author(); ?></p>

												<p><?php the_excerpt(); ?></p>
												<a href="<?php the_permalink(); ?>" class="btn-orange" rel="nofollow">Lire
													la suite</a>
											</div>
										</div>
									</div>
								<?php
								endwhile;
							endif;
							?>
						</div>
						<div class="row clearfix">
							<div class="col-sm-12">
								<?php wpbeginner_numeric_posts_nav(); ?>
							</div>
						</div>
					</div>
					<aside class="sidebar col-sm-4">
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
<?php get_footer();
