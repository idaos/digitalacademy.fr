<?php get_header(); ?>
<?php 
//---------------------------------------------------------------------------
// get site url
//---------------------------------------------------------------------------
$url = site_url();

//---------------------------------------------------------------------------
// pass url parameters to contact form for google analytics utm tags handling
//---------------------------------------------------------------------------
$url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
if (strpos($_SERVER["REQUEST_URI"], '?')) {

    $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
    $url_parameters = $url_parameters[1];
}else{
    $url_parameters = null;
}
//---------------------------------------------------------------------------
// detect which form tabs must be enabled
//---------------------------------------------------------------------------
$enabled_tabs = array();
if ( $types = wp_get_post_terms( get_the_ID(), 'type' ) ){
    foreach ( $types as $type ){
        if(
            ($type->slug == 'inter')||
            ($type->slug == 'intra-entreprises')||
            ($type->slug == 'sur-mesure')
        ){
            array_push ( $enabled_tabs, $type->slug );
        }
    }
}

//---------------------------------------------------------------------------
// Store title into a var
//---------------------------------------------------------------------------
$title = get_the_title();

//---------------------------------------------------------------------------
?>

<div id="breadcrumb" class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) {yoast_breadcrumb();} ?>
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</div>


<?php
if ( have_posts() ) :
// Start the Loop.
while ( have_posts() ) : the_post();

$thematic = wp_get_post_terms( get_the_ID(), 'thematique' );

$th_list = wp_get_post_terms( get_the_ID(), 'thematique' );

if(isset( $th_list[0] ) ){

    $th_set = true;
    $th_first_id = $th_list[0]->term_id;
}else{
    $th_set = false;
    $th_first_id = 23;
}
$th = new KzThema($th_first_id);
?>


<!-- Heading -->
<div id="heading" class="container-slider main-slider slider-header theme-<?php echo $th->getColor(); ?>">
    <div class="slick-slide">

        <!-- Picto -->
        <?php if ( get_field( 'picto' ) ): ?>
        <div class="w100">
            <img src="<?php the_field( 'picto' ); ?>" alt="" style="max-width: 80px;"/>
        </div>
        <?php endif; ?>

        <!-- Title -->
        <h1 class="title-slider w100">Formation - <?php the_title(); ?></h1>

        <!-- Thema name -->
        <?php if($th_set){ ?>
        <div class="text-center theme-<?php echo $th->getColor(); ?> w100" style="font-size: .6em;margin-top:1.5em;">
            <p class="big-title">Thématique : <?php echo $th->getName(); ?></p>
        </div>
        <?php } ?>

    </div>
</div>

<?php if ( get_field( 'obsolete' ) === "Oui" ): ?>
<div id="obsolete">
    <div class="container" style="padding: 0 5px;text-align:center;">
        <?php if ( get_field( 'obsolete_texte' ) ): the_field( 'obsolete_texte' ); endif; ?>
    </div>
</div>
<div></div>
<?php endif; ?>

<div id="sub-nav-placeholder"></div>
<div id="sub-nav" class="xs-container-menu-filtre">
    <div class="container-menu-filtre hidden-xs">
        <div class="container">
            <ul>
                <li><a class="btn btn-xs btn-gray" style="font-size:12px" href="#presentation">Présentation</a></li>
                <li><a class="btn btn-xs btn-gray" style="font-size:12px" href="#informations">Informations &amp; Objectifs</a></li>
                <?php if($th_set){ ?>
                <li><a class="btn btn-xs btn-gray" style="font-size:12px" href="#programme">Programme</a></li>
                <?php } ?>
                <?php if ( get_field( 'obsolete' ) === "Non" ): // check whether the course is obsolete ?>
                <li><a class="btn btn-xs btn-gray" style="font-size:12px" href="#Inscription">Dates, lieu &amp; inscription</a></li>
                <?php endif; ?>
                <?php if ( $temoignages = get_field( 'temoignages' ) ): ?>
                <li><a class="btn btn-xs btn-gray" style="font-size:12px" href="#temoignages">Témoignages</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>



<!-- Présentation -->
<div class="container container-wp" style="background:none;">
    <div class="row clearfix" id="presentation">

        <?php if ( get_field( 'titre_presentation' ) ): ?>
        <h2><?php the_field( 'titre_presentation' ); ?></h2>
        <?php else : ?>
        <h2>Présentation</h2>
        <?php endif; ?>
        <hr>

        <div class="content-wrapper">

            <div class="col-sm-6">
                <?php if ( get_field( 'visuel_presentation' ) ): ?>
                <img src="<?php echo the_field( 'visuel_presentation' ); ?>"
                     alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                <?php endif; ?>

                <!-- Nous contacter -->
                <div class="row" style="max-width:598px;margin-top: 15px;">
                    <?php if ( get_field( 'fiche_formation' ) ): ?>
                    <div class="col-xs-6">
                        <a href="<?php the_field( 'fiche_formation' ); ?>" class="btn btn-xs btn-red" style="width:100%;" target="_blank" rel="nofollow">
                            Télécharger la fiche en pdf
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col-xs-6">
                        <a href="tel:0977215321" class="btn btn-xs btn-red-alt" style="width:100%;">
                            Appelez-nous au <span class="noWrap">09 77 21 53 21</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <?php if ( get_field( 'presentation' ) ): ?>
                <?php the_field( 'presentation' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- /end - Présentation -->




<!-- Datadock banner -->
<section id="datadock">
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#236fa8" points="0,100 100,0 100,100"></polygon>
    </svg>
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#56aef2" points="0,0 0,100 100,0"></polygon>
    </svg>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h4>Organisme validé et référencé </h4>
                <img src="https://www.digitalacademy.fr/wp-content/themes/digitalacademy/images/datadock-logo.svg" alt="" data-lazy-src="https://www.digitalacademy.fr/wp-content/themes/digitalacademy/images/datadock-logo.svg" class="lazyloaded" data-was-processed="true"><noscript><img src="https://www.digitalacademy.fr/wp-content/themes/digitalacademy/images/datadock-logo.svg" alt=""></noscript>
            </div>
        </div>
    </div>
</section>


<!-- /end - Datadock banner -->




<!-- Informations -->
<div class="container-wp">
    <div class="container" id="informations">
        <div class="clearfix row">
            <h2>Informations &amp; Objectifs</h2>
            <hr>

            <div class="content-show">
                <p class="visible-xs toggleplus">+</p>
                <div class="content-wrapper">

                    <div class="col-xs-12 col-sm-4 container__orange border0">

                        <p style="margin: 2em 0;">
                            <strong>Informations pratiques</strong>
                        </p>
                        <?php if ( get_field( 'informations' ) ): ?>
                        <?php the_field( 'informations' ); ?>
                        <?php endif; ?>

                        <!-- Prerequis -->
                        <?php if ( get_field( 'prerequis_formation' ) ): ?>
                        <div class="info-item">
                            <p><strong>Prérequis de la formation</strong></p>
                            <?php the_field( 'prerequis_formation' ); ?>
                        </div>
                        <?php endif; ?>

                        <!-- Bloc formateur -->
                        <?php if ( get_field( 'formateur_descr' ) ): ?>
                        <div class="insert">
                            <img width="100" height="100" src="<?php echo get_stylesheet_directory_uri(); ?>/images/formateur-expert-avatar.svg">
                            <div class="wrapper">
                                <strong style="margin-bottom:.3em;">Formateur</strong>
                                <?php the_field( 'formateur_descr' ); ?>
                                <i style="margin-top:.3em;">L’équipe d’intervenants sera coordonnée par notre équipe pédagogique.</i>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Public en situation de handicap -->
                        <div class="insert">
                            <img width="100" height="100" src="<?php echo get_stylesheet_directory_uri(); ?>/images/handicap.svg" alt="handicap">
                            <div class="wrapper">
                                <strong style="margin-bottom:.3em;">Accessibilité</strong>
                                Public en situation de handicap, nous contacter au
                                <a href="tel:0977215321">
                                    <div class="btn btn-xs btn-gray" id="btn-phone" style="margin-top:.7em;">
                                        09 77 21 53 21
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-8 col-r">

                        <div class="info-item" id="objectifs">
                            <p><strong>Objectifs</strong></p>
                            <?php if ( get_field( 'intro_objectifs' ) ): ?>
                            <?php the_field( 'intro_objectifs' ); ?>
                            <?php endif; ?>
                            <?php if ( get_field( 'objectifs_1' ) ): ?>
                            <?php the_field( 'objectifs_1' ); ?>
                            <?php endif; ?>
                            <?php if ( get_field( 'objectifs_2' ) ): ?>
                            <?php the_field( 'objectifs_2' ); ?>
                            <?php endif; ?>
                        </div>

                        <?php if ( get_field( 'pour_qui' ) ): ?>
                        <div class="toggable info-item">
                            <p class="toggable-btn"><strong>À qui s’adresse cette formation ?</strong></p>
                            <div class="toggable-content"><?php the_field( 'pour_qui' ); ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if ( get_field( 'methodologie' ) ): ?>
                        <div class="toggable info-item">
                            <p class="toggable-btn"><strong>Quelle est la méthodologie pédagogique employée ?</strong></p>
                            <div class="toggable-content"><?php the_field( 'methodologie' ); ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if ( get_field( 'evaluation' ) ): ?>
                        <div class="toggable info-item">
                            <p class="toggable-btn"><strong>Quelles sont les modalités d'évaluation de l'apprenant ?</strong></p>
                            <div class="toggable-content"><?php the_field( 'evaluation' ); ?></div>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /end - informations -->



<?php if($th_set){ ?>
<div class="container-wp" id="programme-wrapper-<?php echo $th->getColor(); ?>">
    <div class="container alignCenter" id="programme">
        <h2>Programme</h2>
        <hr>
        <div class="content-show">
            <p class="visible-xs toggleplus">+</p>
            <div class="content-wrapper">
                <div id="programme-flex-wrap" class="row alignLeft">
                    <div style="display:none;"><div style="display:none;"><ul>
                        <?php 
                  $programme = "";
                  ob_start();
                  if ( get_field( 'programme_1' ) ){
                      the_field( 'programme_1' );
                  }
                  $programme .= ob_get_contents();
                  ob_end_clean();

                  $programme_arr = explode("\n", $programme);
                  $programme_arr_clean = array();

                  foreach( $programme_arr as $programme_item ){

                      $clr =  $th->getColor();

                      $programme_item = str_replace("<p><strong>", "</ul></div></div><div class='p-wp col-sm-6 col-md-4'><div class='card'><h4 class='".$clr."'>", $programme_item);
                      $programme_item = str_replace("</strong></p>", "</h4><ul>", $programme_item);

                      $programme_item = str_replace("<p><span style=\"font-weight: 400;\">", "<li>", $programme_item);
                      $programme_item = str_replace("</span></p>", "</li>", $programme_item);

                      $programme_item = str_replace("<p><i><span style=\"font-weight: 400;\">", "<i>", $programme_item);
                      $programme_item = str_replace("</span></i></p>", "</i>", $programme_item);

                      $programme_item = str_replace("<p><em>", "<i>", $programme_item);
                      $programme_item = str_replace("</em></p>", "</i>", $programme_item);

                      $programme_item = str_replace("<p>", "<li>", $programme_item);
                      $programme_item = str_replace("</p>", "</li>", $programme_item);

                      $programme_item = str_replace("<strong>", "", $programme_item);
                      $programme_item = str_replace("</strong>", "", $programme_item);

                      if(( $programme_item != "<li>&nbsp;</li>" ) && ( $programme_item != "" )){
                          array_push($programme_arr_clean, $programme_item);
                      }
                  }

                  echo implode($programme_arr_clean);
                        ?>
                        </ul></div></div>
                </div>
                <?php if ( get_field( 'version' ) ): ?>

                <div id="version">
                    <?php the_field( 'version' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<?php 
// count how many sessions are scheduled
$remaining_session = 0;
while ( have_rows( 'sessions' ) ){
    the_row();
    $row = get_row();
    $date_session = strtotime( get_sub_field( 'date_session' ) );

    if ( time() < $date_session ){
        $remaining_session += 1;
    }
} 
?>

<?php if ( get_field( 'obsolete' ) === "Non" ): // check whether the course is obsolete ?>
<div class="container-wp">
    <div class="container" id="Inscription">
        <h2>Inscription à la formation <?php the_title();?></h2>
        <hr>

        <div class="content-show">
            <p class="visible-xs toggleplus">+</p>
            <div class="content-wrapper">

                <?php if($remaining_session != 0): // check whether the course has sessions ?>
                <div class="row clearfix">
                    <div class="col-sm-4 alignCenter">

                        <div class="insert-alt">
                            <img width="100" height="100" src="<?php echo get_stylesheet_directory_uri(); ?>/images/calendar-icon.svg">
                            <div class="wrapper">
                                <strong style="margin-bottom:.3em;">Découvrez les prochaines dates de la formation :</strong>  
                                <br><i style="font-size:1.1em;"> « <?php the_title(); ?> » </i> 
                            </div>
                        </div>

                        <i style="margin-top:.3em;width:100%;text-align:center;display:inline-block;">Si cette formation vous intéresse mais que les dates ne vous conviennent pas, n’hésitez pas à nous contacter.</i>
                        <a href="<?php echo get_field( 'page_contact', 'option' ); ?>" onclick="return gtag_report_conversion();" class="btn btn-red btn-xs" style="margin: 1.5em 0 .4em 0;">Nous contacter</a>
                        <a href="tel:0977215321" class="btn btn-xs btn-red-alt">
                            Nous appeler au <span class="noWrap">09 77 21 53 21</span>
                        </a>
                    </div>
                    <div class="col-sm-8" style="padding-left:0">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-11" style="padding:0">
                            <table class="table-inscription" style="width:100%">
                                <tr>
                                    <th>Prochaines dates *</th>
                                    <th>Lieu</th>
                                    <th>Inscription</th>
                                </tr>

                                <?php while ( have_rows( 'sessions' ) ) : the_row(); ?>
                                <?php $date_session = strtotime( get_sub_field( 'date_session' ) ) ?>
                                <?php if ( time() < $date_session ): ?>

                                <tr>
                                    <td>
                                        <?php echo date_i18n( get_option( 'date_format' ), $date_session ); ?></td>
                                    <td><?php the_sub_field( 'lieu_session' ); ?></td>
                                    <?php if (( $date_session - time() ) < 432000 ): ?>
                                    <!-- the session occure less than 5 days from now-->
                                    <td class="indisponible">
                                        <p style="font-size:1em;">Session fermée **</p>
                                    </td>
                                    <?php elseif ( get_sub_field( 'ouvert' ) ):
                                    $corps = "Bonjour,\n\n Je souhaiterais me pré-inscrire à la formation " . $post->post_title . ' du ' . date_i18n( get_option( 'date_format' ), strtotime( get_sub_field( 'date_session' ) ) ) . ' à ' . get_sub_field( 'lieu_session' ) . '.';
                                    $url   = '?'. $url_parameters .'&objet=' . urlencode( 'Pré-inscription - ' . $post->post_title ) . '&corps=' . urlencode( $corps ) ;
                                    ?>
                                    <td>
                                        <a href="<?php echo get_field( 'page_contact', 'option' ) . $url ; ?>" 
                                           class="btn btn-xs btn-red">Pré-inscription</a></td>

                                    <?php else: ?>
                                    <td class="indisponible">
                                        <div class="btn btn-xs btn-red">Non disponible</div>
                                    </td>
                                    <?php endif; ?>
                                </tr>

                                <?php endif; ?>
                                <?php endwhile; ?>

                            </table>
                            <small>* Pour les formations sur plusieurs jours, la date correspond au premier jour de la formation</small>
                            <br>
                            <small>** Les inscriptions aux sessions de formations sont closes 5 jours avant la date indiquée.</small>

                        </div>
                    </div>
                </div>            

                <?php else: ?>

                <div class="row">
                    <div class="col-xs-12">

                        <!-- Tabs nav -->
                        <ul class="nav nav-tabs">
                            <?php if( in_array ( 'inter', $enabled_tabs ) ): ?>
                            <li class="active"><a data-toggle="tab" href="_#tab-inter" class="btn btn-gray btn-tabs">Inter</a></li>
                            <?php endif; ?>
                            <?php if( in_array ( 'intra-entreprises', $enabled_tabs ) ): ?>
                            <li><a data-toggle="tab" href="_#tab-intra" class="btn btn-gray btn-tabs">Intra</a></li>
                            <?php endif; ?>
                            <?php if( in_array ( 'sur-mesure', $enabled_tabs ) ): ?>
                            <li><a data-toggle="tab" href="_#tab-scalable" class="btn btn-gray btn-tabs">Sur Mesure</a></li>
                            <?php endif; ?>
                        </ul>

                        <!-- Tabs content -->
                        <div class="tab-content">

                            <?php if ( ( !in_array ( 'inter', $enabled_tabs ) )
                                      &&( !in_array ( 'intra-entreprises', $enabled_tabs ) )
                                      &&( !in_array ( 'sur-mesure', $enabled_tabs ) ) ): ?>
                            <div id="tab-inter" class="tab-pane active">
                                <?php echo do_shortcode('[gravityform id="12" title="false" description="false" ajax="true"]'); ?>
                            </div>
                            <?php endif; ?>

                            <?php if( in_array ( 'inter', $enabled_tabs ) ): ?>
                            <div id="tab-inter" class="tab-pane active">
                                <?php echo do_shortcode('[gravityform id="12" title="false" description="false" ajax="true"]'); ?>
                            </div>
                            <?php endif; ?>

                            <?php if( in_array ( 'intra-entreprises', $enabled_tabs ) ): ?>
                            <div id="tab-intra" class="tab-pane">
                                <span class="form-heading reverse">
                                    <h2>Intra entreprise</h2>
                                    <h3>Formez vos collaborateurs</h3>
                                </span>
                                <hr>
                                <div class="content-wp">
                                    <p>Demander votre devis en 30 secondes, réponse sous 24h</p>
                                    <a href="<?php echo $url; ?>/contact/?objet=Demande de devis pour un programme intra entreprise de la formation %22<?php the_title(); ?>%22" class="btn btn-red">Demander un devis</a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if( in_array ( 'sur-mesure', $enabled_tabs ) ): ?>
                            <div id="tab-scalable" class="tab-pane">
                                <span class="form-heading reverse">
                                    <h2>Sur mesure</h2>
                                    <h3>Votre programme de formation à la demande</h3>
                                </span>
                                <hr>
                                <div class="content-wp">
                                    <p>Nos experts conçoivent votre formation sur mesure !</p>
                                    <p>Remplissez le formulaire suivant, et un de nos conseillers vous contactera dans les meilleurs délais.</p>
                                    <a href="<?php echo $url; ?>/contact/?objet=Demande de devis pour un programme sur-mesure de la formation %22<?php the_title(); ?>%22" class="btn btn-red">Contactez-nous</a>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div></div>
<?php endif; ?>
<!-- end/ - inscription -->




<!-- Témoignages -->
<?php if ( $temoignages = get_field( 'temoignages' ) ): ?>
<section class="testimonial-wrapper container-wp">
    <div class="container" id="temoignages">

        <h2>Témoignages</h2>
        <hr>

        <div class="content-show">
            <p class="visible-xs toggleplus">+</p>
            <div class="content-wrapper">
                <div class="row" style="padding-top:0">
                    <div class="col-xs-12">
                        <br><p style="margin-top:0;">Retrouvez les points de vue des apprenants qui commentent les formats, le contenu, la dynamique et les animations des formateurs DigitalAcademy sur une grande variété de thématiques.</p>
                    </div>
                </div>
                <div class="row row-same-height">
                    <?php $i=0; ?>
                    <?php foreach ( $temoignages as $temoignage ): ?>
                    <?php
                    $i+=1;
                    $company_plus_course = get_field( 'entreprise', $temoignage->ID );
                    $company_plus_course = explode( '-', $company_plus_course ); 
                    $company = $company_plus_course[0];
                    $course = $company_plus_course[1];
                    
                    if($i<4){
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon fill="#fff" points="0,0 100,100 0,100"/>
                            </svg>
                            <div class="name"><?php echo $temoignage->post_title; ?></div>
                            <div class="company"><?php echo $company; ?></div>
                            <hr>
                            <div class="testimonial"><?php echo $temoignage->post_content; ?></div>
                            <?php
                            $img_carre = get_field( 'visuel_carre', $temoignage->ID );
                            if ( $img_carre ) {
                                echo wp_get_attachment_image( $img_carre, 'testimony' );
                            } else {
                                echo get_the_post_thumbnail( $temoignage->ID, 'testimony' );
                            }
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- end/ - temoignages -->






<?php if($th_set){ ?>
<section id="slider-formations" class="container-wp" style="background:#fff!important;">
    <div id="null" class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br>
                <span class="reverse">
                    <h2>Nos formations digitales</h2>
                    <h3>Un catalogue de plus de 30 formations digitales</h3>
                </span>
                <p>Les participants à cette formation ont également consulté les formations suivantes :</p>
                <hr>
                <?php echo do_shortcode( '[kz_courses_slider nb=-1 taxo="thematique"]' ); ?>
                <a href="/formations/"><div class="btn btn-red">Découvrir toutes nos formations</div></a>
                <br><br><br><br>
            </div>
        </div>
    </div>
</section>
<?php } ?>



<section id="references" class="container-wp">
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

<?php
endwhile;
endif;
?>

<script>
    //-------------------------------------------
    //--------- Form custom heading -------------
    //-------------------------------------------
    var form_heading = '<span id="form-heading" class="reverse"><h2>SESSION INTER ENTREPRISES</h2><p style="font-size:.94em;">Formation "<?php echo $title; ?>"</p><h3>Demander la création d\'une session à la carte</h3></span><hr><br><br>';
</script>


<?php get_footer(); ?>