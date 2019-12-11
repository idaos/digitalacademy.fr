<?php
/**
 *   Template Name: Nos thématiques
 */
?>
<?php get_header(); ?>
<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb();
		} ?>
	</div>
</div>
<div class="mobile-invert">
	<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field( 'img_nos_thematiques', 'option' ) ?>)">
		<div class="slick-slide">
			<?php if ( $pictos = digital_get_thematiques_picto() ): ?>
			<ul class="clearfix hidden-xs">
				<?php foreach ( $pictos as $picto ): ?>
				<li><img src="<?php echo $picto; ?>" alt=""/></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<h1 class="title-slider"><?php the_title(); ?></h1>
</div>
</div>
<div class="full-width bg-orange full-width-contact">
	<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a
		href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">Demander le
		catalogue</a></p>
	</div>
</div>
<div class="xs-container-menu-filtre">
	<div class="sticky-wrapper-relative">
		<div class="container-menu-filtre hidden-xs">
			<div class="container">
				<?php echo digital_get_thematiques_menu( null, true ); ?>
			</div>
		</div>
	</div>
</div>
<?php
$blocs = array();
if ( $thematiques = get_terms( 'thematique' ) ) {
	$i = 0;
	$color = array(
		'gray'      => '#95a5a6',
		'orange'    => '#e74c3c',
		'yellow'    => '#f59d00',
		'green'     => '#2ecc71',
		'blue'      => '#3498db',
		'blue-dark' => '#34495e'
		);
	foreach ( $thematiques as $thematique ) {
		$couleur = get_field( 'couleur', 'thematique_' . $thematique->term_id );
		$blocs[ $i ] = '<div class="container-theme theme-' . $couleur . ' clearfix">';
		$blocs[ $i ] .= '<div class="content-theme">';
		$blocs[ $i ] .= '<div class="wpb_wrapper">';
		$blocs[ $i ] .= '<div class="col-sm-3 text-center">';
		$blocs[ $i ] .= '<h3>' . $thematique->name . '</h3>';
		if ( $picto = get_field( 'picto', 'thematique_' . $thematique->term_id ) ) {
			$blocs[ $i ] .= '<img src="' . $picto . '" alt="" />';
		}
		$blocs[ $i ] .= '</div>';
		$blocs[ $i ] .= '<div class="col-sm-9 content-show">';
		$blocs[ $i ] .= '<p class="visible-xs">+</p>';
		$formations = get_posts(
			array(
				'posts_per_page' => - 1,
				'post_type'      => 'formation',
				'tax_query'      => array(
					array(
						'taxonomy' => 'thematique',
						'field'    => 'term_id',
						'terms'    => $thematique->term_id,
						)
					)
				)
			);
		$formation_list = array();
		if ( $formations ) {
			$u = 0;
			foreach ( $formations as $formation ) {
				$formation_list[] = '<li><a href="' . get_the_permalink( $formation->ID ) . '">' . $formation->post_title . '</a></li>';
				if ( $formation_dates = digital_get_formation_dates( $formation->ID ) ) {
					$thematique_infos[ $thematique->name ][ $color[ $couleur ] ][] = $formation_dates;
				}
			}
		}
		$formation_list = array_chunk( $formation_list, ceil( count( $formation_list ) / 2 ) );
		$blocs[ $i ] .= '<ul>';
		foreach ( $formation_list as $list ) {
			$blocs[ $i ] .= implode( "\n", $list );
		}
		$blocs[ $i ] .= '</ul>';
		$blocs[ $i ] .= '</div>';
		$blocs[ $i ] .= '</div>';
		$blocs[ $i ] .= '</div>';
		$blocs[ $i ] .= '</div>';
		$i ++;
	}
}
?>
<main class="content">
	<div class="container">
		<div class="wrapper">
			<h2 class="hidden-xs">Calendrier des formations</h2>
			<div id="calendar" class="hidden-xs">
				<div id="calendar"></div>
				<script>
				setTimeout(function(){
					
				jQuery(document).ready(function ($) {
					$('#calendar').fullCalendar({
						header: {
							right: 'today prev,next',
							center: '',
							left: 'title'
						},
						defaultDate: '<?php echo date( 'Y-m-d' ); ?>',
						firstDay: 1,
						editable: false,
						eventLimit: true,
						events: [
						<?php
						$events = '';
						foreach( $thematique_infos as $formation_title => $formation_infos )
						{
							foreach( $formation_infos as $couleur => $arrayDates )
							{
								foreach( $arrayDates as $dates )
								{
									foreach( $dates as $date )
									{
										$events .= '{';
										$events .= 'title:    "'. html_entity_decode ($date['titre']) .'",';
										$events .= 'start:    "'. $date['date'] .'",';
										$events .= 'end:      "'. date( 'Y-m-d', strtotime( $date['date'] . ' + '. $date['nombre_jours'] .' days' ) ) .'",';
										$events .= 'url:      "'. $date['url'] .'",';
										$events .= 'color:    "'. $couleur .'"';
										$events .= '},';
									}
								}
							}
						}
						echo rtrim( $events, ',' );
						?>
						]
					});
				});
				}, 1000);
			</script>
</div>
<div class="full-width bg-gray p30">
	<h2>Nos <?php echo count( $thematiques ); ?> thématiques</h2>
	<?php
	if ( count( $blocs ) > 0 ) {
		foreach ( $blocs as $bloc ) {
			echo $bloc;
		}
	}
	?>
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