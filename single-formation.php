<?php 
wp_enqueue_style( 'gutenberg-style', get_template_directory_uri() . '/css/gutenberg-style.css?v=2', array( 'main' ), null );
wp_enqueue_style( 'contact-form', get_template_directory_uri() . '/blocks/contact-form/contact-form.css', array( 'main' ), null );
wp_enqueue_style( 'callback-form', get_template_directory_uri() . '/blocks/callback-form/callback-form.css', array( 'main' ), null );
get_header(); ?>
<?php
//---------------------------------------------------------------------------
// get site url
//---------------------------------------------------------------------------
$url = site_url();

//---------------------------------------------------------------------------
// pass url parameters to contact form for google analytics utm tags handling
//---------------------------------------------------------------------------
function getUrlParameters(){
    $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
    if (strpos($_SERVER["REQUEST_URI"], '?')) {

        $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
        $url_parameters = $url_parameters[1];
    }else{
        $url_parameters = null;
    }
    return $url_parameters;
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
// Store stylesheet uri into a var
//---------------------------------------------------------------------------
$styleUri= get_stylesheet_directory_uri();


if ( have_posts() ) :

//---------------------------------------------------------------------------
// Start the Loop.
//---------------------------------------------------------------------------

while ( have_posts() ) : the_post();


//---------------------------------------------------------------------------
// Get thematic data
//---------------------------------------------------------------------------

$th_list = wp_get_post_terms( get_the_ID(), 'thematique' );

if(isset( $th_list[0] ) ){
    $th_set = true;
    $th_first_id = $th_list[0]->term_id;
}else{
    $th_set = false;
    $th_first_id = 23;
}
$th = new KzThema($th_first_id);


//---------------------------------------------------------------------------
// Store data into vars
//---------------------------------------------------------------------------


function getObsoleteHTML(){
    if ( get_field( 'obsolete_texte' ) ){
        $obsoleteTxt = get_field( 'obsolete_texte' );
    }else{
        $obsoleteTxt = "";
    }
    if ( get_field( 'obsolete' ) === "Oui" ){
        $out = <<<EOF
            <div id="obsolete">
                <div class="container" style="padding: 0 5px;text-align:center;">
                    $obsoleteTxt
                </div>
            </div>
            EOF;
    }else{
        $out = "";
    }
    return $out;
}
function getPresentationTitle(){
    if ( get_field( 'titre_presentation' ) ){
        $out = get_field( 'titre_presentation' );
    }else{
        $out = "Présentation";
    }
    return $out;
}
function getPresentation(){
    if ( get_field( 'presentation' ) ){
        $out = get_field( 'presentation' );
    }else{
        $out = "";
    }
    return $out;
}
function getPresentationThema(){
    if ( get_field( 'intro_thematique' ) ){
        $out = get_field( 'intro_thematique' );
    }else{
        $out = "";
    }
    return $out;
}
function getInformations(){
    if ( get_field( 'informations' ) ){
        $out = get_field( 'informations' );
    }else{
        $out = "";
    }
    return $out;
}
function getPrerequisites(){
    if ( get_field( 'prerequis_formation' ) ){
        $out = get_field( 'prerequis_formation' );
    }else{
        $out = "";
    }
    return $out;
}
function getCourseImg(){
    if ( get_field( 'visuel_presentation' ) ){
        $img = get_field( 'visuel_presentation' );
        $out = '<img src="'. $img .'" alt="'. get_the_title() .'" title="'. get_the_title() .'"/>';
    }else{
        $out = '<img src="'. $styleUri .'/images/single-formation/course-img-placeholder.jpg">';
    }
    return $out;
}
function getPdfUrl(){
    if ( get_field( 'fiche_formation' ) ){
        $out = get_field( 'fiche_formation' );
    }else{
        $out = "";
    }
    return $out;
}
function getTrainer(){
    if ( get_field( 'formateur_descr' ) ){
        $out = get_field( 'formateur_descr' );
    }else{
        $out = "";
    }
    return $out;
}
function getForWho(){
    if ( get_field( 'pour_qui' ) ){
        $out = get_field( 'pour_qui' );
    }else{
        $out = "";
    }
    return $out;
}
function getMethodology(){
    if ( get_field( 'methodologie' ) ){
        $out = get_field( 'methodologie' );
    }else{
        $out = "";
    }
    return $out;
}
function getGoals(){
    $out = "";
    if ( get_field( 'intro_objectifs' ) ){
        $out .= get_field( 'intro_objectifs' );
    }
    if ( get_field( 'objectifs_1' ) ){
        $out .= get_field( 'objectifs_1' );
    }
    if ( get_field( 'objectifs_2' ) ){
        $out .= get_field( 'objectifs_2' );
    }

    $goals_arr = explode("\n", $out);
    $goals_arr_clean = array();

    foreach( $goals_arr as $goals_item ){

        $goals_item = str_replace("<strong>", "", $goals_item);
        $goals_item = str_replace("</strong>", "", $goals_item);
        $goals_item = str_replace("<p>", "<li>", $goals_item);
        $goals_item = str_replace("</p>", "</li>", $goals_item);

        if(( $goals_item != "<li>&nbsp;</li>" ) && ( $goals_item != "" )){
            array_push($goals_arr_clean, $goals_item);
        }
    }
    return implode($goals_arr_clean);
}
function getProgram(){
    $program = "";
    if ( get_field( 'programme_1' ) ){
        $program .= get_field( 'programme_1' );
    }
    if ( get_field( 'programme_2' ) ){
        $program .= get_field( 'programme_2' );
    }
    if ( get_field( 'programme_3' ) ){
        $program .= get_field( 'programme_3' );
    }
    $program_arr = explode("\n", $program);
    //    $program_arr_clean = array("<div class='accordeon-wrapper accordeon-has-path'>");
    $program_arr_clean = array();
    $program_arr_bloc = array();

    foreach( $program_arr as $program_item ){

        $th_list = wp_get_post_terms( get_the_ID(), 'thematique' );

        if(isset( $th_list[0] ) ){
            $th_set = true;
            $th_first_id = $th_list[0]->term_id;
        }else{
            $th_set = false;
            $th_first_id = 23;
        }
        $th = new KzThema($th_first_id);
        $clr =  $th->getColor();

        $program_item = str_replace("<p><strong>", "<div class='accordeon-item-title bgc-" . $clr . "'>", $program_item);
        $program_item = str_replace("</strong></p>", "</div>", $program_item);

        $program_item = str_replace("<p><span style=\"font-weight: 400;\">", "<li>", $program_item);
        $program_item = str_replace("</span></p>", "</li>", $program_item);

        $program_item = str_replace("<p><i><span style=\"font-weight: 400;\">", "<i>", $program_item);
        $program_item = str_replace("</span></i></p>", "</i>", $program_item);

        $program_item = str_replace("<p><em>", "<i>", $program_item);
        $program_item = str_replace("</em></p>", "</i>", $program_item);

        $program_item = str_replace("<p>", "<li>", $program_item);
        $program_item = str_replace("</p>", "</li>", $program_item);

        $program_item = str_replace("<strong>", "", $program_item);
        $program_item = str_replace("</strong>", "", $program_item);


        if(( $program_item != "<li>&nbsp;</li>" ) && ( $program_item != "" )){

            $pos = strpos($program_item, "accordeon-item-title");

            if ($pos !== false) {

                array_push($program_arr_clean,"<ul class='accordeon-item-content' style='display:none;'>");
                foreach ($program_arr_bloc as $item) {
                    array_push($program_arr_clean, $item);
                }
                array_push($program_arr_clean,"</ul>");
                array_push($program_arr_clean,"</div><div class='accordeon-item'>");
                array_push($program_arr_clean, $program_item);
                $program_arr_bloc = array();
            }else{
                array_push($program_arr_bloc, $program_item);
            }

        }
    }
    array_push($program_arr_clean,"<ul class='accordeon-item-content' style='display:none;'>");
    foreach ($program_arr_bloc as $item) {
        array_push($program_arr_clean, $item);
    }
    array_push($program_arr_clean,"</ul>");
    array_unshift($program_arr_clean, '<div class="accordeon-wrapper accordeon-has-path"><div>');
    array_push($program_arr_clean, '</div></div>');

    return implode($program_arr_clean);
}
function getVersion(){
    if ( get_field( 'version' ) ){
        $out = get_field( 'version' );
    }else{
        $out = "";
    }
    return $out;
}
function getEvaluation(){
    if ( get_field( 'evaluation' ) ){
        $out = get_field( 'evaluation' );
    }else{
        $out = "";
    }
    return $out;
}
function isObsolete(){
    if ( get_field( 'obsolete' ) === "Non" ){
        return false;
    }else{
        return true;
    }
}
function getSessions(){

    $sessions = array();
    while ( have_rows( 'sessions' ) ){
        $session = array();
        the_row();
        $date_session = strtotime( get_sub_field( 'date_session' ) );
        $url_parameters = getUrlParameters();

        // BO available checkbox checked
        if ( get_sub_field( 'ouvert' ) ){

            // The session is in the future
            if ( time() < $date_session ){
                $session["date"] = date_i18n( get_option( 'date_format' ), $date_session );
                $session["place"] = get_sub_field( 'lieu_session' );
                // Registration is closed
                if (( $date_session - time() ) < 432000 ){
                    $session["open"] = false;
                    // Registration is available
                }else{
                    $session["open"] = true;
                    $formMessage = "Bonjour,\n\n Je souhaiterais me pré-inscrire à la formation " . get_the_title() . ' du ' . date_i18n( get_option( 'date_format' ), strtotime( get_sub_field( 'date_session' ) ) ) . ' à ' . get_sub_field( 'lieu_session' ) . '.';
                    $parameters   = '?'. $url_parameters .'&objet=' . urlencode( 'Pré-inscription - ' . get_the_title() ) . '&corps=' . urlencode( $formMessage ) ;
                    $session["formLink"] = get_field( 'page_contact', 'option' ) . $parameters;
                }
            }
        } 
        if( count($session) > 0 ){
            array_push($sessions, $session);
        }
    }
    return($sessions);
}
function hasSessions(){
    if( count(getSessions()) == 0 ){
        return false;
    }else{
        return true;
    }
}
function getTestimonials(){

    $testimonials = array();
    if ( get_field( 'temoignages' ) ){
        $testimonialsList = get_field( 'temoignages' );
    }else{
        return false;
    }
    foreach ( $testimonialsList as $item ){
        $testimonial = array();
        $company_plus_course = get_field( 'entreprise', $item->ID );
        $company_plus_course = explode( '-', $company_plus_course ); 
        $testimonial['company'] = $company_plus_course[0];
        $testimonial['course'] = $company_plus_course[1];
        $testimonial['name'] = $item->post_title;
        $testimonial['content'] = $item->post_content;
        $testimonial['img'] = get_field( 'visuel_carre', $item->ID );
        if ( $testimonial['img'] ) {
            $testimonial['img'] = wp_get_attachment_image( $testimonial['img'], 'testimony' );
        } else {
            $testimonial['img'] = get_the_post_thumbnail( $temoignage->ID, 'testimony' );
        }
        if( count($testimonial) > 0 ){
            array_push($testimonials, $testimonial);
        }
    }
    return $testimonials;
}
function hasTestimonials(){
    if( getTestimonials() != false ){
        return true;
    }else{
        return false;
    }
}
function hasInfoDuration(){
    if ( get_field( 'info_duree' ) ){
        return true;
    }else{
        return false;
    }
}
function getInfoDuration(){
    if ( get_field( 'texte_duree' ) ){
        $out = get_field( 'texte_duree' );
    }else{
        $out = "";
    }
    return $out;
}
function hasInfoParticipants(){
    if ( get_field( 'info_participants' ) ){
        return true;
    }else{
        return false;
    }
}
function getInfoParticipants(){
    if ( get_field( 'texte_participants' ) ){
        $out = get_field( 'texte_participants' );
    }else{
        $out = "";
    }
    return $out;
}
function hasInfoPrice(){
    if ( get_field( 'info_tarif' ) ){
        return true;
    }else{
        return false;
    }
}
function getInfoPrice(){
    if ( get_field( 'texte_tarif' ) ){
        $out = get_field( 'texte_tarif' );
    }else{
        $out = "";
    }
    return $out;
}
function hasInfoRef(){
    if ( get_field( 'info_reference' ) ){
        return true;
    }else{
        return false;
    }
}
function hasInfoIntra(){
    if ( get_field( 'info_intra' ) ){
        return true;
    }else{
        return false;
    }
}
function getInfoIntra(){
    if ( get_field( 'texte_intra' ) ){
        $out = get_field( 'texte_intra' );
    }else{
        $out = "";
    }
    return $out;
}
function hasInfoElearning(){
    if ( get_field( 'info_e_learning' ) ){
        return true;
    }else{
        return false;
    }
}


$colorTxt = 'bf3b2b' ;
$colorHex = '#bf3b2b' ;
$thName = $th->getName(); 
$thImg = $th->getImage();
$thName = $th->getName();
$obsoleteHTML = getObsoleteHTML();
$presentationTitle = getPresentationTitle();
$presentation = getPresentation();
$presentationThema = getPresentationThema();
$courseImgHTML = getCourseImg();
$pdfUrl = getPdfUrl();
$informations = getInformations();
$prerequisites = getPrerequisites();
$trainer = getTrainer();
$goals = getGoals();
$forWho = getForWho();
$methodology = getMethodology();
$evaluation = getEvaluation();
$program = getProgram();
$version = getVersion();
$sessions = getSessions();
$hasSession = hasSessions();
$testimonials = getTestimonials();
$hasTestimonials = hasTestimonials();

?>

    <?php echo $obsoleteHTML; ?>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="thematic-name">
                <?php echo $thName; ?>
            </div>
            <h1>
                <?php echo $title; ?>
            </h1>
            <div id="heading-grid">
                <div>
                    <div><!-- col 1 -->
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-pin.jpg" alt="" class="multiply">
                            <span>Présentiel ou distanciel</span>
                        </div>
                        <?php if( hasInfoDuration() ): ?>
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-clock.jpg" alt="" class="multiply">
                            <span><?php echo getInfoDuration() ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if( hasInfoParticipants() ): ?>
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-peoples.jpg" alt="" class="multiply">
                            <span><?php echo getInfoParticipants() ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div><!-- col 2 -->
                        <?php if( hasInfoIntra() ): ?>
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-building.jpg" alt="" class="multiply">
                            <span><?php echo getInfoIntra() ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if( hasInfoPrice() ): ?>
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-coins.jpg" alt="" class="multiply">
                            <span><?php echo getInfoPrice() ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if( hasInfoRef() ): ?>
                        <div class="accordeon-xs">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-arrow.jpg" alt="" class="multiply">
                            <span><?php
                            global $post;
                            $number = str_pad($post->ID, 4, '0', STR_PAD_LEFT);
                            echo 'Référence 2020' . $number; ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="accordeon-xs" style="margin-top: .5rem;">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/ico-handicap.jpg" alt="" class="multiply">
                            <span>Public en situation de handicap, nous contacter au <a href="tel:0977215321">09 77 21 53 21</a></span>
                        </div>
                    </div>
                    <div class="btn btn-xs accordeon-xs-toggler more">Voir plus</div>
                    <div class="btn btn-xs accordeon-xs-toggler less" style="display: none!important">Voir moins</div>
                </div>

                <div><!-- col 3 -->
                    <div>
                        <img src="<?php echo $styleUri; ?>/images/single-formation/datadock-bw.jpg" alt="">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/qualiopi2022.png" style="max-width:75%; alt="">
                    </div>
                    <div class="rating">
                        <i>Satisfaction de nos apprenants en 2021</i>
                        <div>
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt="">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt="">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt="">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt="">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-half.png" alt="">
                            <span>4.75/5</span>
                        </div>
                    </div>
                </div>
                <div><!-- col 4 -->
                    <div>
                        <div class="h3">Notre expertise</div>
                        <p><?php echo $trainer; ?></p>
                    </div>
                </div>
                <div><!-- col 5 -->
                    <div class="wp-block-button aligncenter is-style-outline btn-phone">
                        <a class="wp-block-button__link wp-element-button" href="tel:0977235321">
                            Parler à un conseiller
                        </a>
                    </div>
                    <a href="<?php echo $pdfUrl; ?>" id="dl-catalogue-btn">
                        <div class="btn-dl btn btn-red">
                            Télécharger la fiche
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Content -->
    <div class="container">
        <div class="row row-same-height reverseLg">
            <div id="content" class="col-lg-8">

                <div id="goals">
                    <h2 class="c-<?php echo $colorTxt; ?>">Objectifs</h2>
                    <hr>
                    <ul>
                        <?php echo $goals; ?>
                    </ul>
                </div>

                <div id="program">
                    <style>
                        .accordeon-has-path .accordeon-item:after {
                            background: <?php echo $colorHex;
                            ?>;
                        }

                    </style>
                    <h2 class="c-<?php echo $colorTxt; ?>">Programme</h2>
                    <hr>
                    <?php if(( in_array ( 'sur-mesure', $enabled_tabs ) )&&( count($enabled_tabs) == 1 )): ?>
                    <p style="margin-bottom: 1.5em;">Veuillez trouver un exemple de programme qui a déjà été réalisé par le passé. Nous adaptons votre programme selon votre besoin.</p>
                    <?php endif; ?>
                    <?php echo $program; ?>
                </div>

                <div id="presentation">
                    <h2 class="c-<?php echo $colorTxt; ?>">Présentation</h2>
                    <hr>
                    <?php echo $presentationThema; ?>
                    <?php echo $presentation; ?>
                </div>

                <div id="prerequisites">
                    <div class="accordeon-wrapper">
                        <div class="accordeon-item">
                            <div class="accordeon-item-title bgc-<?php echo $colorTxt; ?>">Prérequis de la formation</div>
                            <div class="accordeon-item-content" style="display:none;">
                                <?php echo $prerequisites; ?>
                            </div>
                        </div>
                        <div class="accordeon-item">
                            <div class="accordeon-item-title bgc-<?php echo $colorTxt; ?>">À qui s'adresse cette formation ?</div>
                            <div class="accordeon-item-content" style="display:none;">
                                <?php echo $forWho; ?>
                            </div>
                        </div>
                        <div class="accordeon-item">
                            <div class="accordeon-item-title bgc-<?php echo $colorTxt; ?>">Quelle est la méthodologie pédagogique employée ?</div>
                            <div class="accordeon-item-content" style="display:none;">
                                <?php echo $methodology; ?>
                            </div>
                        </div>
                        <div class="accordeon-item">
                            <div class="accordeon-item-title bgc-<?php echo $colorTxt; ?>">Quelles sont les modalités d'évaluation ?</div>
                            <div class="accordeon-item-content" style="display:none;">
                                <?php echo $evaluation; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="margin-bottom: 0!important;opacity:.5">
                <div id="version">
                    <?php echo $version; ?>
                </div>
            </div>
            <div id="cta-col" class="col-lg-4">

                <!-- Course has sessions -->    
                <?php if($hasSession): ?>

                <h2 class="c-<?php echo $colorTxt; ?>">Prochaines Dates <span class="c-color-dac">*</span></h2>
                <hr>
                <i>Si cette formation vous intéresse mais que les dates ne vous conviennent pas, n’hésitez pas à nous contacter.</i>

                <?php foreach($sessions as $session): ?>

                <div class="insert <?php if(!$session["open"]): ?>session-closed<?php endif; ?>">
                    <img src="<?php echo $styleUri; ?>/images/calendar-icon.svg" height=12 alt="">
                    <div class="wrapper">
                        <strong style="margin-bottom:.3em;"><?php echo $session["date"]; ?></strong>
                        <br><i><?php echo $session["place"]; ?></i>
                        <?php if(!$session["open"]): ?>
                        <div class="closed">session fermée **</div>
                        <?php endif; ?>
                        <?php if( $session["open"]): ?>
                        <a title="Bouton d'inscription" href="<?php echo $session["formLink"]; ?>">
                            <div class="btn btn-xs btn-red">Inscription</div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php endforeach; ?>

                <i><span class="c-color-dac">*</span> Pour les formations sur plusieurs jours, la date correspond au premier jour de la formation</i>
                <i><span class="c-color-dac">**</span> Les inscriptions aux sessions de formations sont closes 5 jours avant la date indiquée</i>
                <i>Les sessions de formation sont maintenus à partir de 3 personnes inscrites</i>


                <!-- Course has not sessions -->
                <?php else: ?>

                <!-- Course Registering -->
                <?php endif; ?>


                <!------------------------------------------------>
                <!-------------- Inter/intra/sur-mesure ----------------->
                <!------------------------------------------------>

                <?php if( 
                    (in_array ( 'inter', $enabled_tabs ))
                    ||(in_array ( 'intra-entreprises', $enabled_tabs ))
                 ): ?>
                    <div id="col-inter-intra" class="col-item">
                        <div class="col-header">Vous souhaitez former vos collaborateurs ?</div>

                        <?php if( in_array ( 'intra-entreprises', $enabled_tabs ) ): ?>
                        <div id="col-intra">
                            <div class="h3">En Intra-entreprise :</div>
                            <p>Demander votre devis en 30 secondes, réponse sous 24h</p>
                            <a href="#contact-anchor" class="btn btn-red btn-document">Demander un devis</a>
                        </div>
                        <?php endif; ?>
                        <?php if( in_array ( 'inter', $enabled_tabs ) ): ?>
                        <hr>
                        <div id="col-inter">
                            <div class="h3">En Inter-entreprise :</div>
                            <p>Contactez-nous pour mieux répondre à votre demande</p>
                            <a href="#contact-anchor" class="btn btn-red btn-contact">Contactez-nous</a>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if( in_array ( 'sur-mesure', $enabled_tabs ) ): ?>
                <div id="col-sur-mesure" class="col-item">
                    <div class="col-header">Sur mesure</div>
                    <div>
                        <div class="h3">Votre programme de formation à la demande</div>
                        <p>Nos experts conçoivent votre formation sur mesure !</p>
                        <p>Remplissez le formulaire suivant, et un de nos conseillers vous contactera dans les meilleurs délais.</p>
                        <a href="#contact-anchor" class="btn btn-red btn-contact">Contactez-nous</a>
                    </div>
                </div>
                <?php endif; ?>

                <!------------------------------------------------>
                <!----------- end / Inter/intra/sur-mesure -------------->
                <!------------------------------------------------>
            </div>
        </div>
    </div>

    <?php // Contact section ?> 
<div class="is-layout-constrained wp-block-group alignwide br-3 has-background" style="background-color:#f7f7f7"><div class="wp-block-group__inner-container">
<div class="is-layout-flex wp-container-41 wp-block-columns">
<div class="is-layout-flow wp-block-column">
<div style="height:35px" aria-hidden="true" class="wp-block-spacer"></div>
<p class="has-text-align-center has-text-color has-medium-font-size" style="color:#bf3b2b"><strong>Contactez-nous pour la formation</strong></p>
<section id="contact"><span id="contact-anchor" style="margin-top: -258px!important;position: absolute;display: block;"></span>
        <div d="form-bottom">
            <div class="container form-container">
                <div id="contact-form" class="row">
                    <?php echo do_shortcode('[gravityform id="11" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </section>
<p class="has-text-color has-small-font-size" style="color:#454040">Conformément à la loi « Informatique et Libertés » N° 78-17 du 6 Janvier 1978, vous bénéficiez d’un droit d’accès, de rectification et de suppression des données transmises par le biais de ce formulaire</p>
<p class="has-text-color has-small-font-size" style="color:#454040">*Champs obligatoires</p>
<div style="height:41px" aria-hidden="true" class="wp-block-spacer hidden-xs"></div>
</div>
<div class="is-layout-flow wp-block-column">
<div style="height:38px" aria-hidden="true" class="wp-block-spacer hidden-xs"></div>
<p class="has-text-align-center has-text-color has-medium-font-size" style="color:#bf3b2b"><strong>Vous souhaitez être rappelé(e) ?</strong></p>
<div id="callback-form">
        <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true"]'); ?>
    </div>
<div style="height:38px" aria-hidden="true" class="wp-block-spacer"></div>
<p class="has-text-align-center has-text-color has-medium-font-size" style="color:#bf3b2b"><strong>Vous souhaitez nous contacter directement ?</strong></p>
<div class="is-layout-flex wp-block-buttons">
<div class="wp-block-button aligncenter is-style-outline btn-phone"><a class="wp-block-button__link wp-element-button" href="tel:0977235321">09 77 23 53 21</a></div>
</div>
<p class="has-text-align-center">Appel non surtaxé.<br>Du lundi au vendredi de 9h30 à 18h</p>
<div style="height:13px" aria-hidden="true" class="wp-block-spacer"></div>
<div class="is-layout-flex wp-block-buttons">
<div class="wp-block-button aligncenter is-style-outline btn-mail"><a class="wp-block-button__link wp-element-button" href="mailto:contact@digitalacademy.fr">contact@digitalacademy.fr</a></div>
</div>
</div>
</div>
</div></div>
<?php 





?>



<?php
/*
 * Témoignages
 *
 */
?>


<?php if ( $hasTestimonials ): ?>
    <?php $testimonials = array_slice($testimonials, 0, 3);  ?>

    <div class="is-layout-constrained wp-block-group alignwide br-3" style="margin-bottom: 3rem;">
    <div class="wp-block-group__inner-container">
        <div class="is-layout-flex wp-container-49 wp-block-columns" style="display: block; margin:auto">
            <div class="h3" style="margin-bottom: 3rem;">Témoignages</div>
            <p style="text-align:center;margin: 0 auto 3rem auto; max-width:750px;font-weight:bold">Retrouvez les points de vue des apprenants qui commentent les formats, le contenu, la dynamique et les animations des formateurs DigitalAcademy sur une grande variété de thématiques.</p>

<div class="is-layout-flex wp-container-32 wp-block-columns lh-15">
<?php foreach ( $testimonials as $testimonial ): ?>

    <div class="is-layout-flow wp-block-column bs p-1 br-3 pr pb-7">
    <div class="is-layout-flex wp-container-19 wp-block-columns mb-0">
    <div class="is-layout-flow wp-block-column" style="flex-basis:90px">
    <?php echo $testimonial['img']; ?>
    </div>
    <div class="is-layout-flow wp-block-column" style="flex-basis:66.66%">
    <p class="mb-0 has-text-color has-medium-font-size" style="color:#bf3b2b; margin-top:1rem"><strong><?php echo $testimonial['name']; ?></strong></p>
    <p class="mt-0 mb-0 has-text-color has-medium-font-size" style="color:#777777"><?php echo $testimonial['company']; ?></p>
    </div>
    </div>
    <p class="mt-0"><?php echo $testimonial['content']; ?></p>
    <div class="is-layout-flex wp-block-buttons">
    </div>
    </div>

<?php endforeach; ?>
</div>
</div>
    </div>
</div>
<?php endif; ?>
<!-- end/ - temoignages -->



<?php
/*
 * Slider opco
 *
 */
?>
<div class="is-layout-constrained wp-block-group alignwide br-3">
    <div class="wp-block-group__inner-container">
        <div class="is-layout-flex wp-container-49 wp-block-columns" style="display: block; margin:auto">
            <div class="h3">Les OPérateurs de COmpétences partenaires</div>
            <?php
                echo do_shortcode( '[opco-slider]' );
            ?>
        </div>
    </div>
</div>
<?php
?>




    
    <?php
endwhile;
endif;







// function getThematicCourses($thematic_id){

//     $args = array(
//         'posts_per_page' => -1,
//         'post_type'      => 'formation',
//         'post_status'    => 'publish',
//         'tax_query'      => array(
//             array(
//             'taxonomy' => 'thematique',
//             'field'    => 'term_id',
//             'terms'    => $thematic_id,
//             )
//             )
//         );
//     $ACF_query = new WP_Query( $args );
//     $formations = $ACF_query->posts;

//     return array_column($formations, 'post_title');;
// }

// global $post;
// $terms = get_terms( 'thematique' );
// $data = [];
// foreach ( $terms as $term ) {

//     $_term = [];
//     $_term['label'] = $term->name;
//     $_term['id'] = $term->term_id;
//     $_term['courses'] = getThematicCourses($term->term_id);

//     array_push($data , $_term);
// }

    // echo 'var coursesData = ' . json_encode($data) . ';';
    // echo 'console.log(coursesData);';

    // echo 'var currentCourse = ' . json_encode($th_list[0]->name) . ';';
    // echo 'console.log(currentCourse);';

    // echo 'var currentThematic = ' . json_encode($post->post_title) . ';';
    // echo 'console.log(currentThematic);';

    ?>

    <script>
        //-------------------------------------------
        //--------- Form custom heading -------------
        //-------------------------------------------
        var form_heading = '<span id="form-heading"><h3 style="margin-top: 1.5em;font-weight:bold!important;">SESSION INTER ENTREPRISES</h3><p style="color: #e74c3c!important;font-weight: bolder!important;font-size: .95em!important;">Demander la création d\'une session à la carte</p></span><hr>';

    </script>


    <?php get_footer(); ?>
