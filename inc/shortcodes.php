<?php

/**
 * Shortcode Séparateur <hr>
 * [hr image=0/1]
 *
 * @return string
 */
function digitalacademy_shortcode_hr( $atts ) {
	$a = shortcode_atts( array(
		'image' => 'oui',
	), $atts );

	if ( $a['image'] == 'oui' ) {
		return '<hr>';
	} else {
		return '<hr class="none">';
	}
}

add_shortcode( 'hr', 'digitalacademy_shortcode_hr' );

/**
 * Shortcode Call to action
 * [cta texte="Découvrez la liste complète de nos formations" url="#" texte_bouton="Demander le catalogue" mobile=true]
 *
 * @param $atts
 *
 * @return string
 */
function digitalacademy_shortcode_callToAction( $atts ) {
	$a = shortcode_atts( array(
		'texte'        => 'Découvrez la liste complète de nos formations',
		'url'          => '#',
		'texte_bouton' => 'Demander le catalogue',
		'mobile'       => "0"
	), $atts );

	$class = '';
	if ( $a['mobile'] == '1' ) {
		$class = 'hidden-xs';
	}

	$cta = '<div class="full-width full-width-contact bg-orange cta"><p class="clearfix"><span class="m-100 ' . $class . '">' . $a['texte'] . '</span> <a href="' . $a['url'] . '" class="btn btn-white margin0">' . $a['texte_bouton'] . '</a></p></div>';

	return $cta;
}

add_shortcode( 'cta', 'digitalacademy_shortcode_callToAction' );

/**
 * Shortcode slider des références
 * [references_slider type="intra"]
 *
 * @param $atts
 *
 * @return string
 */
//function digitalacademy_shortcode_referencesSlider( $atts ) {
//	$a = shortcode_atts( array(
//		'type' => false
//	), $atts );
//
//	$args = array(
//		'post_type'      => 'reference',
//		'post_status'    => 'publish',
//		'posts_per_page' => - 1,
//	);
//
//	if ( $a['type'] ) {
//		$args['tax_query'] = array(
//			array(
//				'taxonomy' => 'reference',
//				'terms'    => $a['type'],
//				'field'    => 'slug'
//			)
//		);
//	}
//
//	$references = new WP_Query( $args );
//
//	if ( $references->have_posts() ) {
//		$out = '<div class="container-slider slide-logo">';
//
//		while ( $references->have_posts() ) {
//			$references->the_post();
//
//			$out .= '<a href="' . esc_url( get_field( 'url' ) ) . '" target="_blank">';
//			$out .= '<div>';
//			$out .= get_the_post_thumbnail( get_the_ID() );
//			$out .= '</div>';
//			$out .= '</a>';
//		}
//
//		//		$out .= '<button type="button" data-role="none" class="slick-prev" aria-label="previous" style="display: inline-block;">Previous</button>';
//		//		$out .= '<button type="button" data-role="none" class="slick-next" aria-label="previous" style="display: inline-block;">Next</button>';
//		//		$out .= '<ul class="slick-dots" style="display: block;"></ul>';
//		$out .= '</div>';
//
//		return $out;
//	}
//}
//
//add_shortcode( 'references_slider', 'digitalacademy_shortcode_referencesSlider' );

/**
 * Shortcode slider des top formations
 * [formations_slider nb=4]
 *
 * @param $atts
 *
 * @return string
 */
//function digitalacademy_shortcode_formationsSlider( $atts ) {
//	global $post;
//
//	$a = shortcode_atts( array(
//		'type' => false,
//		'nb'   => 10,
//		'taxo' => false
//	), $atts );
//
//	$args = array(
//		'post_type'      => 'formation',
//		'post_status'    => 'publish',
//		'posts_per_page' => $a['nb'],
//		'post__not_in'   => array( $post->ID ),
//	);
//
//	if ( $a['taxo'] == 'formateur' ) {
//		$args['tax_query']    = array(
//			array(
//				'taxonomy' => 'formateur',
//				'terms'    => get_queried_object()->term_id,
//				'field'    => 'term_id'
//			)
//		);
//		$args['post__not_in'] = array();
//	} elseif ( $a['taxo'] == 'thematique' ) {
//		$thematiques       = get_the_terms( $post->ID, 'thematique' );
//		$id_terms          = wp_list_pluck( $thematiques, 'term_id' );
//		$args['tax_query'] = array( array( 'taxonomy' => 'thematique', 'terms' => $id_terms, 'field' => 'term_id' ) );
//	} else {
//		$args['meta_query'] = array( array( 'key' => 'top_formation', 'value' => true, 'compare' => '=' ) );
//	}
//	$formations = new WP_Query( $args );
//
//	if ( $formations->have_posts() ) {
//		$out = '<div class="container-slider slide-formations clearfix matchHeight-watch">';
//
//		while ( $formations->have_posts() ) {
//			$formations->the_post();
//
//			$out .= '<div>';
//			$out .= '<div class="container-bg-white clearfix"><a style="text-decoration:none;cursor:default" href="' . get_permalink() . '">';
//
//			if ( get_field( 'image_header_formation', get_the_ID() ) ) {
//				$out .= '<img src="' . get_field( 'image_header_formation', get_the_ID() ) . '" alt="">';
//			}
//
//			$out .= '<div class="content-bg-white matchHeight-child">';
//			$out .= '<h4>' . get_the_title() . '</h4>';
//			$out .= '<p>' . wp_trim_words( get_field( 'presentation', get_the_ID() ), 20, '...' ) . '</p>';
//			$out .= '</div>';
//			$out .= '</div>';
//			$out .= '<div class="text-center">';
//			$out .= '<a href="' . get_permalink() . '" class="btn-gray">En savoir plus</a>';
//			$out .= '</a></div>';
//			$out .= '</div>';
//		}
//		$out .= '</div>';
//
//		return $out;
//	}
//}
//
//add_shortcode( 'formations_slider', 'digitalacademy_shortcode_formationsSlider' );


/**
 * Shortcode slider des top formations
 * [formations_slider nb=4]
 *
 * @param $atts
 *
 * @return string
 */
function digitalacademy_shortcode_topFormationsListe( $atts ) {
	global $post;
    
    if(isset($post->ID)){
        $post_id = $post->ID;
    }else{
        $post_id = null;
    }
    
	$a = shortcode_atts( array(
		'nb' => - 1
	), $atts );

	$args = array(
		'post_type'      => 'formation',
		'post_status'    => 'publish',
		'posts_per_page' => $a['nb'],
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'title',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => 'top_formation',
				'value'   => true,
				'compare' => '=',
			)
		)
	);

	$formations = new WP_Query( $args );

	if ( $formations->have_posts() ) {
		$out = '<ul class="menu">';

		while ( $formations->have_posts() ) {
			$formations->the_post();

			$out .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
		}
		$out .= '</ul>';

		return $out;
	}
}

add_shortcode( 'top_formations_liste', 'digitalacademy_shortcode_topFormationsListe' );


/**
 * Shortcode liste des Business Case
 * [business_case nb=4]
 *
 * @param $atts
 *
 * @return string
 */
function digitalacademy_shortcode_businessCase( $atts ) {
	global $post;

	$a = shortcode_atts( array(
		'nb' => 8
	), $atts );

	$args = array(
		'post_type'      => 'businesscase',
		'post_status'    => 'publish',
		'posts_per_page' => $a['nb']
	);

	$businessCase = new WP_Query( $args );

	if ( $businessCase->have_posts() ) {
		$out = '<div id="matchheight-container">';
		$out = '<div class="row display-flex">';

		while ( $businessCase->have_posts() ) {
			$businessCase->the_post();


                    
			$out .= '<div class="col-sm-3">';
			$out .= '<div class="container-border">';

			if ( has_post_thumbnail() ) {
				$out .= '<div class="content-img">';
				$out .= get_the_post_thumbnail();
				$out .= '</div>';
			}

			$out .= '<div class="content-gray wrapper_KJBjf">';
			$out .= '<h2>' . get_the_title() . '</h2>';
			$out .= '<p>' . str_replace( array( ' – ', ' - ' ), ' <br/> ', get_field( 'prestation' ) ) . '</p>';
			$out .= '<p>' . wp_trim_words( get_field( 'objectif' ), 10 ) . '</p>';
			$out .= '</div>';
			$out .= '<div class="text-center btn-wrapper_KHvejn">';
			$out .= '<a href="' . get_post_type_archive_link( 'businesscase' ) . '#' . $post->post_name . '" class="btn btn-gray margin0">En savoir plus</a>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
		}

		$out .= '</div>';
		$out .= '</div>';

		$out .= '<div class="text-center btn_JHVKVf"><a href="' . get_bloginfo( 'url' ) . '/etude-cas/" class="btn btn-red margin0 m2020 mt0">Voir tous les business cases</a></div>';

		return $out;
	}
}

add_shortcode( 'business_case', 'digitalacademy_shortcode_businessCase' );

/**
 * Shortcode slider des témoignages
 * [temoignages nb=2 titre="Ce que disent nos clients de la DigitalAcademy©" sous_titre="Lorem ipsum dolor sit amet,
 * consectetur adipiscing elit. Ut sed felis accumsan, egestas diam in, aliquam dolor. Aliquam venenatis nibh vitae
 * odio commodo, sit amet fermentum neque pharetra. Mauris molestie maximus mollis. Aliquam erat volutpat. Pellentesque
 * pretium mauris nec condimentum interdum."]
 *
 * @param $atts
 *
 * @return string
 */
function digitalacademy_shortcode_temoignages( $atts ) {
	$a = shortcode_atts( array(
		'nb'         => 2,
		'titre'      => 'Ce que disent nos clients de la DigitalAcademy©',
		'sous_titre' => false,
		'lien'       => false
	), $atts );

	$args        = array(
		'post_type'      => 'temoignage',
		'post_status'    => 'publish',
		'posts_per_page' => $a['nb'],
		'orderby'        => 'rand',
	);
	$temoignages = new WP_Query( $args );

	if ( $temoignages->have_posts() ) {
		$out = '<div class="full-width bg-gray fs20 p30">';
		$out .= '<div class="clearfix">';
		$out .= '<h2>' . $a['titre'] . '</h2>';

		if ( $a['sous_titre'] ) {
			$out .= '<p class="text-center">' . $a['sous_titre'] . '</p>';
		}

		$out .= '<hr>';

		while ( $temoignages->have_posts() ) {
			$temoignages->the_post();

			$out .= '<div class="container-client">';
			$img = get_field( 'visuel_carre', $temoignages->ID );
			$out .= wp_get_attachment_image( empty( $img ) ? get_post_thumbnail_id() : $img, 'testimony' );
			$out .= '<p class="first"><strong>' . get_the_title() . '</strong>, ' . get_field( 'entreprise', get_the_ID() ) . '</p>';
			$out .= '<p>«' . get_the_content() . '»</p>';
			$out .= '</div>';
		}

		$out .= '</div>';

		if ( $a['lien'] ) {
			$out .= '<div class="text-center"><a href="' . get_field( 'page_temoignages', 'option' ) . '" class="btn btn-red margin0">Voir tous les témoignages</a></div>';
		}

		$out .= '</div>';

		return $out;
	}
}

add_shortcode( 'temoignages', 'digitalacademy_shortcode_temoignages' );
