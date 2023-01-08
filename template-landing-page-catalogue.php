<?php
/*
Template Name: Landing Page - Catalogue
*/
?>
<?php get_header('template-landing-page-catalogue'); ?>
<?php 
if (strpos($_SERVER["REQUEST_URI"], '?')) {
    
    $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
    $url_parameters = $url_parameters[1];
}else{
    $url_parameters = null;
}
?>
<nav>
    <div class="container d-flex align-items-center">
        <div class="col-5 col-sm-4 col-md-3 col-lg-2">
            <img class="logo-dac" src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/logo-digitalacademy.svg" width="120" alt="Logo DigitalAcademy">
        </div>
        <div class="col-7 col-sm-8 col-md-9 col-lg-4 col-xl-5">
            <b>Nos conseillers vous répondent au</b><br>
            <div id="phone-number"><a href="tel:0977215321">09 77 21 53 21</a></div>
            <div id="phone-info">appel non surtaxé<br>
                du lundi au vendredi de 9h30 à 18h
            </div>
        </div>
        <div id="phone-form" class="d-none d-lg-block col-lg-6 col-xl-5 alignRight">
            <?php echo do_shortcode('[gravityform id="6" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</nav>
<div id="datadock">
    <div class="container">
        <span>Notre organisme <div class="d-none d-sm-inline-block">de formation</div> est référencé Datadock.</span>
        <a href="https://www.digitalacademy.fr/digitalacademy-est-certifiee-datadock/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/info-icon.svg" width="15" alt="info"></a>
        <div><img id="datadock_logo" class="d-none d-md-block" src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/datadock.png" alt="datadock logo"></div>
    </div>
</div>
<div id="heading" class="container d-flex align-items-center">
    <div class="d-none d-md-block col-lg-3">
        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/catalogue.png" alt="">
    </div>
    <div class="col-md-12 col-lg-9">
        <h1>
            Découvrez notre catalogue de formations 
            <span class="noWrap"><?php if ( date("n") >= 9 ){
    echo date("Y") . '-' . ( date("Y") + 1 ) ; 
}else{
    echo date("Y");
}
                ?>
            </span>
        </h1>
        <h3>DigitalAcademy&copy;, l'institut de formation qui fait vivre le digital en entreprise</h3>
        <p>La DigitalAcademy est la référence des formations dédiées aux professionnels du Marketing, de la Communication et du Web : plus de 30 formations pour s’approprier le marketing digital de A à Z, avec des contenus exclusifs, mis à jour tous les mois.</p>
        <a id="openModal" href="#popup"><span class="button button-hover">Télécharger le catalogue</span></a>
    </div>
</div>
<div id="formations">
    <div class="container">
        <h2 class="alignCenter">Notre sélection de formations à venir</h2>
        <div class="row">
            <?php
            $args = array(
                'posts_per_page' => 8,
                'post_type'      => 'formation',
                'post_status'    => 'publish',
                'meta_key'       => 'position_formation',
                'orderby'        => 'meta_value_num', 
                'order'	         => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'     => 'top_formation',
                        'value'   => true,
                        'compare' => '=',
                    )
                )
            );
            $formations = get_posts( $args );
            if ( $formations ) { 
                $i=0;
                foreach ( $formations as $formation ) {
                    if ( ($i == 7)||($i == 6)||($i == 5)||($i == 4) ){
            ?><div class="d-none d-xl-block col-md-6 col-lg-6 col-xl-4"><?php
                    }else{
            ?><div class="col-md-6 col-lg-6 col-xl-4"><?php
                    }$i+=1; 
            ?>
            <div class="wrapper">
                <!-- Image -->  
                <?php if ( get_field( 'visuel_presentation', $formation->ID ) ): ?>
                <a href="<?php echo get_the_permalink( $formation->ID ); ?>">   
                    <img src="<?php the_field( 'visuel_presentation', $formation->ID ); ?>" alt="">
                </a>
                <?php if ( get_field( 'tag_nouvelle_formation', $formation->ID ) ): echo "<div class='nouvelle_formation'></div>" ?><?php endif; ?>
                <?php if ( get_field( 'tag_top_formation', $formation->ID ) ): echo "<div class='top_formation'></div>" ?><?php endif; ?>
                <?php endif; ?>
                <div>
                    <!-- Titre -->  
                    <a href="<?php echo get_the_permalink( $formation->ID ); ?>">
                        <h4><?php echo get_the_title( $formation->ID ); ?></h4>
                    </a>
                    <!-- Session -->  
                    <div class="session">      
                        <span>Prochaine session :</span><br>
                        <?php
                    if( have_rows('sessions', $formation->ID) ):    
                    $row = 0;
                    while ( have_rows('sessions', $formation->ID) ) : the_row();
                    $row +=1;
                    if ( $row == 1 ):
                    $date_session = strtotime( get_sub_field( 'date_session' ) );
                    if ( time() < $date_session ):
                    echo "<div class='where'>";
                    the_sub_field('lieu_session');
                    echo "&nbsp;-&nbsp;</div>";
                    echo "<div class='when'>";
                    echo date_i18n( get_option( 'date_format' ), $date_session );
                    echo "</div>";
                    /*
                        ?>
                        <!-- Bouton inscription (lien vers le formulaire d'inscription pre-remplit)-->  
                        <!--
<div class="preinscription">
<?php
                    //$corps = "Bonjour,\n\n Je souhaiterais me pré-inscrire à la formation " . get_the_title( $formation->ID ) . ' du ' . date_i18n( get_option( 'date_format' ), strtotime( get_sub_field( 'date_session' ) ) ) . ' à ' . get_sub_field( 'lieu_session' ) . '.';
                    //$url   = '?objet=' . urlencode( 'Pré-inscription - ' . get_the_title( $formation->ID ) ) . '&corps=' . urlencode( $corps );
?>
<a href="<?php //echo get_field( 'page_contact', 'option' ) . $url; ?>">S'inscrire</a>
</div>
-->
*/ ?>
                        <!-- Bouton inscription -->
                        <div class="preinscription">
                            <a href="<?php echo get_the_permalink( $formation->ID ); ?><?php echo '?'.$url_parameters ?>#Inscription">S'inscrire</a>
                        </div>
                        <?php
                        else:
                    $row -=1;
                    endif;
                    endif;
                    endwhile;
                    endif;
                        ?>
                    </div>
                    <?php if ( get_field( 'presentation', $formation->ID ) ): ?>
                    <!-- Presentation -->  
                    <p><?php echo wp_trim_words( get_field( 'presentation', $formation->ID ), 20, '...' ); ?></p>
                </div>
                <div class="alignCenter">
                    <!-- Formateur -->                                        
                    <?php if ( $formateurs = wp_get_post_terms( $formation->ID, 'formateur' ) ): ?>
                    <?php $j = 0; foreach ( $formateurs as $formateur ): ?>
                    <?php if($j==0){?>
                    <img
                         src="<?php the_field( 'avatar', 'formateur_' . $formateur->term_id ); ?>"
                         alt="" width="100" height="100">
                    <span>
                        <i>Animée par :</i>
                        <br><b><?php echo $formateur->name; ?></b>
                    </span>
                    <!-- Fiche Formateur -->  
                    <!--  <a href="<?php //echo get_term_link( $formateur->term_id, 'formateur' ); ?>"></a>--> 
                    <?php } $j=+1; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a class="en-savoir-plus" href="<?php echo get_the_permalink( $formation->ID ); ?><?php echo '?'.$url_parameters ?>"><div class="button">En savoir plus</div></a>
            </div>
            </div>
            <?php endif;
                }
            }
            ?>
            </div>
            <div class="container">
                <a href="https://www.digitalacademy.fr/nos-formations/">
                    <div class="row alignCenter">
                        <div id="plus-de-formation" class="button button-hover">Plus de formations</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="declinaisons">
        <div class="container">
            <h2 class="col-12 alignCenter">Nos formations se déclinent en</h2>
        </div>
        <div class="container d-flex align-items-center alignCenter">
            <div class="row">
                <a href="https://www.digitalacademy.fr/solutions/" class="col-sm-12 col-lg-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/formation-sur-mesure-icon.png" alt="Formation sur mesure ico">
                        <h3>Formation intra sur mesure</h3>
                        <div class="button">Nous contacter</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/solutions/formations-en-entreprise/#intra" class="col-sm-12 col-md- col-lg-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/formation-digital-learning-icon.png" alt="Digital learning ico">
                        <h3>Digital learning<span class="noWrap"></span></h3>
                        <div class="button">Nous contacter</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/solutions/formations-en-entreprise/#blended" class="col-sm-12 col-md- col-lg-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/formation-coaching-icon.png" alt="Coaching ico">
                        <h3>Coaching</h3>
                        <div class="button">Nous contacter</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="testimonial">
        <div class="container alignCenter">
            <h2 class="col-12">Ce que disent nos apprenants de la DigitalAcademy&#169;</h2>
            <p class="d-none d-xl-block">Retrouvez les points de vue des apprenants qui commentent les formats, le contenu, la dynamique et les animations des formateurs DigitalAcademy sur une grande variété de thématiques.</p>
        </div>
        <div class="container">
            <div class="row">
                <?php
                $args = array(
                    'posts_per_page' => 6,
                    'post_type'      => 'temoignage',
                    'post_status'    => 'publish',
                    'orderby'        => 'post__in', 
                    'post__in'       => array(710, 1356, 691, 674, 2944, 706)
                );
                $temoignages = get_posts( $args );
                ?>
                <?php if ( $temoignages ): ?>
                <?php $l=0; ?>
                <?php foreach ( $temoignages as $temoignage ): ?>
                <?php $l+=1; ?>
                <?php if ($l >= 3){ ?>
                <div class="d-none d-sm-flex align-items-start col-md-12 col-lg-6 col-xl-6">
                    <?php }else{ ?>
                    <div class="align-items-start d-flex col-md-12 col-lg-6 col-xl-6">
                        <?php } ?>
                        <?php
                        $img_carre = get_field( 'visuel_carre', $temoignage->ID );
                        if ( $img_carre ) {
                            echo wp_get_attachment_image( $img_carre, 'testimony' );
                        } else {
                            echo get_the_post_thumbnail( $temoignage->ID, 'testimony' );
                        }
                        ?>
                        <div>
                            <p><?php echo $temoignage->post_content; ?></p>
                            <div class="author"><?php echo $temoignage->post_title; ?></div>
                            <div class="fonction"><?php echo get_field( 'entreprise', $temoignage->ID ); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="satisfaction" class="">
        <div class="container alignCenter">
            <div class="row">
                <div class="col-12">
                    <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/like-icon.svg" width="50" alt="">
                    <span>98% de nos apprenants <div class="noWrap">sont satisfaits !</div></span>
                </div>
            </div>
        </div>
    </div>
    <div id="thematiques" class="d-none d-lg-block">
        <div class="container">
            <h2 class="col-12 alignCenter">Nos thématiques de formation</h2>
        </div>
        <div class="container d-flex align-items-center alignCenter">
            <div class="row">
                <a href="https://www.digitalacademy.fr/thematique-formation/site-contenus-web/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-web.png" alt="Site et contenus web">
                        <h3>Site &amp; contenus web</h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/thematique-formation/reseaux-sociaux-e-reputation/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-reseaux-sociaux.png" alt="Réseaux sociaux et e-réputation">
                        <h3>Réseaux sociaux &amp; <span class="noWrap">e-réputation</span></h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/thematique-formation/strategie-de-marketing-digital/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-strategie.png" alt="Entreprise 2.0">
                        <h3>Stratégie de marketing digital</h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/thematique-formation/webmarketing-e-publicite/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-webmarketing.png" alt="Découvrir les formations">
                        <h3>Webmarketing &amp; <span class="noWrap">e-publicité</span></h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/thematique-formation/mobile-e-commerce/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-mobile.png" alt="Mobile et e-commerce">
                        <h3>Mobile &amp; <span class="noWrap">e-commerce</span></h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
                <a href="https://www.digitalacademy.fr/thematique-formation/entreprise-2-0/" class="col-lg-6 col-xl-4">
                    <div class="wrapper">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-thematique-entreprise2.png" alt="Découvrir les formations">
                        <h3>Entreprise 2.0</h3>
                        <div class="button">Découvrir les formations</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="contact" >
        <div class="container">
            <div class="row">
                <div class="col-12 alignCenter">
                    <h2>Vous souhaitez en savoir plus sur nos offres de formation ?</h2>  
                </div>
                <div class=" col-md-5 col-lg-7 valign">
                    <div class="container">
                        <div class="row alignCenter">
                            <span><img id="logo_dac" src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/logo-digitalacademy.svg" width="150" alt="Logo Digital Academy"></span>
                            <b>Nos conseillers vous répondent au :</b>
                            <span id="phone"><a href="tel:0977215321">09 77 21 53 21</a></span>
                            <i>appel non surtaxé</i>
                            <i>du lundi au vendredi de 9h30 à 19h</i>
                            <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true"]'); ?>
                            <i>ou par e-mail</i>
                            <br><a id="adresse-email" href="mailto:contact@digitalacademy.fr">contact@digitalacademy.fr</a> 
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-5 valign" id="form-bottom" action="#">
                    <div class="col-12 form-header"><br><h3 class="col-12">Contactez-nous !</h3><br></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12"></div>
                            <div class="container form-container">
                                <div class="row">
                                    <?php echo do_shortcode('[gravityform id="5" title="false" description="false" ajax="true"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer" class="">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <a href="https://www.digitalacademy.fr/mentions-legales/" target="_blank">Mentions Légales &amp; Politique de traitement des données pesonnelles</a>
                </div>
                <div class="col-12 col-sm-4 alignCenter"><?php echo date("Y"); ?>&nbsp;Digital Academy &#9400;</div>
                <div class="col-12 col-sm-4 alignRight">
                    <div id="social-icons">
                        <a href="https://www.facebook.com/LaDigitalAcademy" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/social-icon-facebook.svg" width="26" alt="Social icon Facebook">
                        </a>
                        <a href="https://twitter.com/digital_ac" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/social-icon-twitter.svg" width="26" alt="Social icon Twitter">
                        </a>
                        <a href="https://www.linkedin.com/company/digital-academy" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/social-icon-linkedin.svg" width="26" alt="Social icon LinkedIn">
                        </a>
                        <a href="https://www.youtube.com/channel/UCRRym8ZzrDiyAvVbpjaO1_A" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/social-icon-youtube.svg" width="26" alt="Social icon YouTube">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-foot"></div>
    <div id="modal">
        <div class="popup" id="popup">
            <a href="#"></a>
            <div class="popup-inner">
                <div class="popup-header">
                    <span>Contactez-nous !</span>
                    <a class="popup__close" href="#">
                        <img src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/ico-cross.svg" width="12" alt="">
                    </a>
                </div>
                <div class="popup__form">
                    <?php echo do_shortcode('[gravityform id="7" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer('template-landing-page-catalogue'); ?>