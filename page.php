<?php get_header(); ?>

<?php
$class = 'nos-formations';
$bg = '';
if( has_post_thumbnail() ) {
	$class = '';

	$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	$bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center center"';
}
?>
	<div class="breadcrumb hidden-xs">
		<div class="container">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
		</div>
	</div>

	<div class="container-slider main-slider slider-header <?php echo $class; ?>" <?php echo $bg; ?>>
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
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>
	</main><!-- Main end -->

<?php get_footer(); ?>