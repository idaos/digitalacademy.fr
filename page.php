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
<main class="content">
	<div class="container" style="z-index:5">

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