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
<div class="header <?php echo $class; ?>" <?php echo $bg; ?>>    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<span class="reverse">   
					<h1 class="title-slider"><?php the_title(); ?></h1>
					<?php if( get_field( 'sous_titre' ) ): ?>
					<h3><?php the_field( 'sous_titre' ); ?></h3>
					<?php endif; ?>
				</span>
				<?php if( get_field( 'texte_introduction' ) ): ?>
				<hr>
				<p><?php the_field( 'texte_introduction' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="svg-wrapper-bottom">
	<svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#eee" points="0,0 0,100 40,40"></polygon>
	</svg>
	<svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
	</svg>
	<svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#fff" points="0,0 100,100 0,100"></polygon>
	</svg>
</div>    
<main class="content" style="margin-top:-2vw;z-index:5">
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