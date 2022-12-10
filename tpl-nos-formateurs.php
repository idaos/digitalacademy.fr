<?php
/**
*   Template Name: Nos formateurs
*/
?>
<?php get_header();

if( has_post_thumbnail() ) {
	$class = '';
	$url = get_stylesheet_directory_uri() . '/images/nos-formateurs.jpg';
	$bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center"';
}
?>
<style>
	.full-width p{
		text-align: center;
	}
	hr{margin:2em auto}
	.content-white{
		padding:1.5em;
		padding-bottom: 3em;
	}
	.content-white ul {
		padding-bottom: 4em;
	}
	.content-white li a{
		color:#000;
	}
</style>

<div class="header" <?php echo $bg; ?>>    
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
	<div class="container">
		<div class="wrapper">
			<div  id="matchheight-container">
				<div class="row display-flex">
					<?php
					$formateurs = get_terms( 'formateur', array('hide_empty'=>false) );
					if ( $formateurs ) {
						$i=0;
						foreach( $formateurs as $formateur ) { ?>

					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="thewrapper container-border">
							<div class="content-white">
								<?php if( get_field( 'avatar', 'formateur_'. $formateur->term_id ) ): ?>
								<img class="formateur-thumb" src="<?php the_field( 'avatar', 'formateur_'. $formateur->term_id ); ?>" alt="<?php echo $formateur->name; ?>" width="100" height="100" >
								<?php endif; ?>
								<h4><?php echo $formateur->name; ?></h4>
								<p>
									<?php if( get_field( 'specialite', 'formateur_'. $formateur->term_id ) ): ?>
									<?php the_field( 'specialite', 'formateur_'. $formateur->term_id ); ?>
									<?php endif; ?>                                
								</p>
								<hr>
								<?php $formations = get_posts(array(
							'posts_per_page' => 3,
							'post_type' => 'formation',
							'tax_query' => array(
								array(
									'taxonomy' => 'formateur',
									'field' => 'term_id',
									'terms' => $formateur->term_id,
								)
							)
						) );
															  if( $formations ) {
																  echo '<ul>';
																  foreach( $formations as $formation ) { ?>
								<li><a class="lien-formation" href="<?php echo get_the_permalink( $formation->ID ); ?>"><?php echo $formation->post_title; ?></a></li>
								<?php } } ?>
							</div>
							<a href="<?php echo get_term_link( $formateur, 'formateur' ); ?>" class="btn btn-xs btn-red">En savoir plus</a>
						</div>
					</div>
					<?php }
						echo '</ul>';

					} ?>
				</div>
			</div>


			<div class="full-width bg-orange full-width-contact">
				<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
			</div>
		</div>
	</div>
</main><!-- Main end -->

<section id="references">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<br><br><br>
				<span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
				<hr>
				<?php echo do_shortcode( '[kz_ref_slider]' ); ?>
				<a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
				<br><br><br>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>