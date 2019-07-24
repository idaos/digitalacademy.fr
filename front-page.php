<?php get_header(); ?>

<?php 
    $name_slide = have_rows( 'slides', 'option' ) ? 'slides' : 'slider';
?>

<?php if ( have_rows( $name_slide, 'option' ) ): ?>
	<div class="container-slider main-slider slide-home hidden-xs">
		<?php $counter = 1;
		while ( have_rows( $name_slide, 'option' ) ): the_row(); ?>
			<div
				<?php if (get_sub_field( 'image' )): ?>style="background: url('<?php the_sub_field( 'image' ); ?>') center center no-repeat;background-size: cover;"<?php endif; ?>>
				
				<?php $video = get_sub_field( 'video' ); ?>
				
				<div class="container-slider-home" <?php 
				if ( ! empty( $video ) ) {
					echo "style='display:none'";
				};
				?> >
					<?php if ( get_sub_field( 'titre' ) ): ?>
						<h2 class="title-slider"><?php the_sub_field( 'titre' ); ?></h2>
					<?php endif; ?>

					<?php if ( get_sub_field( 'sous_titre' ) ): ?>
						<div class="clearfix"></div>
						<p><?php the_sub_field( 'sous_titre' ); ?></p>
					<?php endif; ?>

					<?php if ( get_sub_field( 'lien' ) ): ?>
						<div class="clearfix"></div>
						<?php $btn_class = array();
						$btn_class[] = 'btn-orange';
						$btn_color = get_sub_field( 'more_color' );
						if ( ! empty( $btn_color ) ) :
							$class = 'btn-custom-'.$counter;
							$btn_class[] = $class; ?>
							<style>
								.<?php echo $class; ?> {
									border-color: <?php echo esc_html( $btn_color ); ?> ! important;
									color: <?php echo esc_html( $btn_color ); ?> ! important;
								}
								.<?php echo $class; ?>:hover {
									background: <?php echo esc_html( $btn_color ); ?> ! important;
									color: #ffffff ! important;
								}
							</style>
						<?php endif; ?>
						<a href="<?php the_sub_field( 'lien' ); ?>" class="<?php echo implode( ' ', $btn_class ); ?>">En savoir plus</a>
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
				
				<?php if ( ! empty( $video ) ) : ?>
						<?php $siteurl = get_site_url(); ?>
						<div class="container-slider-home-video clearfix">
							<iframe id="youtube_player" width="762" height="290" src="<?php echo $video . '&enablejsapi=1&origin=' . $siteurl ;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
				<?php endif; ?>
				
			</div>
		<?php $counter += 1;
		endwhile; ?>
	</div>
<?php endif; ?>

	<main class="content">
		<div class="container">
			<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();
					the_content();
					?>

				<?php
				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );
			endif;
			?>
		</div>
		<div class="full-width bg-gray text-center">
			<h3>Nos TOP formations digitales</h3>

			<div class="p030">
				<?php echo do_shortcode( '[formations_slider]' ); ?>
			</div>
			<p class="top-title mb50 mt10">Plus de 30 formations pour s’approprier la Communication Digitale de A à Z
				!</p>
			<a href="<?php echo get_field( 'page_nos_formations', 'option' ); ?>" class="btn-orange"
			   style="position:static">Voir toutes nos formations</a>
		</div>
		<?php
		$page_newsletter = get_field( 'page_newsletter', 'option' );
		echo do_shortcode( '[cta texte="Restez informé sur nos formations digitales" url="' . $page_newsletter . '" texte_bouton="S’inscrire à la newsletter"]' );
		?>
	</main><!-- Main end -->

<?php get_footer(); ?>