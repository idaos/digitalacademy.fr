<?php get_header(); ?>

<?php $thematique_ID = get_queried_object_id(); ?>

<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb();
		} ?>
	</div>
</div>

<div class="container-slider main-slider slider-header hidden-xs">
	<div class="slick-slide">
		<ul class="clearfix">
			<?php if ( get_field( 'picto', 'thematique_' . $thematique_ID ) ): ?>
			<li><img src="<?php the_field( 'picto', 'thematique_' . $thematique_ID ); ?>" alt=""/></li>
		<?php endif; ?>
	</ul>
	<div class="clearfix">
		<h1 class="title-slider"><?php echo single_cat_title( '', false ); ?></h1>
	</div>
</div>
</div>

<div class="full-width bg-orange full-width-contact">
	<p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a
		href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">Demander le
		catalogue</a></p>
	</div>

	<div class="xs-container-menu-filtre">
		<div class="container-menu-filtre hidden-xs">
			<div class="container">
				<?php echo digital_get_thematiques_menu( $thematique_ID ); ?>
			</div>
		</div>
	</div>

	<?php
	$formations = get_posts(
		array(
			'posts_per_page' => - 1,
			'post_type'      => 'formation',
			'tax_query'      => array(
				array(
					'taxonomy' => 'thematique',
					'field'    => 'term_id',
					'terms'    => $thematique_ID,
					)
				)
			)
		);

	if ( $formations ) {
		$i     = 0;
		$color = array(
			'gray'      => '#95a5a6',
			'orange'    => '#e74c3c',
			'yellow'    => '#f59d00',
			'green'     => '#2ecc71',
			'blue'      => '#3498db',
			'blue-dark' => '#34495e'
			);

		foreach ( $formations as $formation ) {
			$blocs[ $i ] = '<div class="container-theme container-formations clearfix">';
			$blocs[ $i ] .= '<div class="content-theme">';
			$blocs[ $i ] .= '<div class="vc_column-inner">';
			$blocs[ $i ] .= '<div class="wpb_wrapper">';
			$blocs[ $i ] .= '<div class="text-center">';
			$blocs[ $i ] .= '<h3>' . $formation->post_title . '</h3>';
			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '<div class="clearfix">';

			if ( get_field( 'visuel_presentation', $formation->ID ) ) {
				$blocs[ $i ] .= '<img src="' . get_field( 'visuel_presentation', $formation->ID ) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
			}

			if ( get_field( 'presentation', $formation->ID ) ) {
				$blocs[ $i ] .= get_field( 'presentation', $formation->ID );
			}

			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '<div class="text-center">';
			$blocs[ $i ] .= '<a href="' . get_the_permalink( $formation->ID ) . '" class="btn">En savoir plus</a>';
			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '</div>';
			$blocs[ $i ] .= '</div>';

			if ( $formation_dates = digital_get_formation_dates( $formation->ID ) ) {
				$thematique_infos[ $i ][ $color[ get_field( 'couleur', 'thematique_' . $thematique_ID ) ] ] = $formation_dates;
			}

			$i ++;
		}
	}
	?>

	<main class="content <?php if ( get_field( 'couleur', 'thematique_' . $thematique_ID ) ) {
		echo 'theme-' . get_field( 'couleur', 'thematique_' . $thematique_ID );
	} ?>">
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
							foreach( $formation_infos as $couleur => $dates )
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
						echo rtrim( $events, ',' );
						?>
						]
					});

				});

				}, 1000);
				
</script>
</div>

<div class="full-width bg-gray">
	<div class="clearfix">
		<div class="text-center mt30">
			<?php if ( get_field( 'picto', 'thematique_' . $thematique_ID ) ): ?>
			<img src="<?php the_field( 'picto', 'thematique_' . $thematique_ID ); ?>" alt=""
			class="theme-presentation"/>
		<?php endif; ?>
		<h2><?php echo single_cat_title( '', false ); ?></h2>
	</div>

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
</div>
</main><!-- Main end -->

<div class="wrapper text-center container-reference">
	<div class="p030">
		<h3>Nos références clients en formation</h3>
		<?php echo do_shortcode( '[references_slider]' ); ?>
	</div>
</div>

<?php get_footer(); ?>