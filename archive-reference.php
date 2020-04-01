<?php
/**
 * While reference archive page doesn't exists, redirect to type directly
 */
$terms = get_terms( 'type-reference', array( 'number' => 1, 'fields' => 'ids' ) );
wp_safe_redirect( get_term_link( (int) reset( $terms ), 'type-reference' ) );
exit;
get_header(); ?>

<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field('img_references', 'option') ?>)">
	<div class="slick-slide">
		<div class="clearfix">
			<h1 class="title-slider">Nos références en formation</h1>
		</div>
	</div>
</div>
<div class="full-width bg-orange content-declinaison text-center">
	<div class="clearfix">
		<span>Filtrer les références en formation :</span>
		<?php echo digital_get_type_menu(); ?>
	</div>
</div>
<div class="xs-container-menu-filtre">
	<div class="container-menu-filtre">
		<div class="container">
			<?php echo digital_get_reference_menu( null, true ); ?>
		</div>
	</div>
</div>
<main class="content">
	<div class="container">
		<div class="full-width bg-gray">
			<div class="row">
				<h2>Nos références <?php echo  strtolower( esc_html(get_queried_object()->name ) ); ?></h2>
				<div class="row"><div class="container-slider references clearfix matchHeight-watch">
					<?php if ( have_posts() ) :
							// Start the Loop.
					$i=0;
					while ( have_posts() ) : the_post(); ?>
					<div class="col-sm-3 bloc-formation matchHeight-child">
						<div class="container-bg-white clearfix">
							<a href="<?php echo esc_url( get_field( 'url' ) ); ?>" target="_blank">
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
					</div>
					<?php if( $i %4 == 3 ) :
					echo '</div></div><div class="row"><div class="container-slider references clearfix matchHeight-watch">';
					endif;
					$i++;
					endwhile;
					else : ?>
					<h3>Aucun résultats correspondant à vos critères !</h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</main><!-- Main end -->
<div class="full-width bg-orange full-width-contact">
	<p class="clearfix"><span class="m-100">Une question sur nos formations ?</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
</div>
<?php get_footer(); ?>