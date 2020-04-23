<?php get_header(); ?>
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



$colorTxt = $th->getColor(); 
$colorHex = $th->getColorHex(); 
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

<!-- Heading -->
<section id="heading">
    <svg class="svg-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#f7f7f7" points="47,0 100,0 100,100 42,90"></polygon>
    </svg>
    <svg class="svg-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#fff" points="-20,80 100,0 100,100"></polygon>
        <polygon fill="<?php echo $colorHex; ?>" points="-20,80 100,0 100,100"></polygon>
    </svg>
    <div class="container">
        <div class="row">
            <div id="course-imgs" class="col-lg-6 row">
                <?php echo $courseImgHTML; ?>
                <div class="multiply visibleLg">
                    <h3>Notre certification :</h3>
                    <hr>
                    <div class="row">
                        <!--                        <div class="col-xs-6 alignRight">-->
                        <div class="col-xs-12">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/datadock-bw.jpg" alt="">
                        </div>
                        <!--
<div class="col-xs-6 alignLeft">
<img src="<?php //echo $styleUri; ?>/images/single-formation/qualiopi-bw.jpg" alt="">
</div>
-->
                    </div>
                    <div class="rating">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                        <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                        <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                        <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                        <img src="<?php echo $styleUri; ?>/images/single-formation/star-half.png" alt=""> 
                        <span>4.7/5</span>
                        <i>Satisfaction de nos apprenants en 2019</i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 alignCenterLg alignLeftSm">
                <a id="thematic-info" href="#">
                    <img src="<?php echo $styleUri; ?>/images/single-formation/ico-thematic-<?php echo $colorTxt; ?>.jpg" alt="" class="multiply">
                    <span class="c-<?php echo $colorTxt; ?>">Thématique : "<?php echo $thName; ?>"</span>
                </a>
                <div id="course-title">
                    <h1>
                        <b>Formation </b>
                        <?php echo $title; ?>
                    </h1>
                </div>
                <hr class="alignCenterLg">

                <div id="course-info" class="row">
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-pin.jpg" alt="" class="multiply">
                        <span>Lieu: en présentiel Paris ou France</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-clock.jpg" alt="" class="multiply">
                        <span>7 heures soit une journée</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-peoples.jpg" alt="" class="multiply">
                        <span>3 à 12 personnes</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-coins.jpg" alt="" class="multiply">
                        <span>980 € HT par personne</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-arrow.jpg" alt="" class="multiply">
                        <span>Référence 1512104</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-building.jpg" alt="" class="multiply">
                        <span>Intra ou sur-mesure possible</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-online.jpg" alt="" class="multiply">
                        <span>100% en ligne avec le formateur</span>
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <img src="<?php echo $styleUri; ?>/images/single-formation/ico-computer.png" alt="" class="multiply">
                        <span>E-learning sur demande</span>
                    </div>
                </div>
                <hr class="hiddenLg alignCenterLg">
                <div class="multiply hiddenLg alignCenterLg">
                    <div class="row" style="padding-top: 1em" class="alignCenterLg">
                        <div class="col-xs-12 col-sm-6 alignCenterLg">
                            <!--                        <div class="col-xs-6 col-sm-4 alignRight alignCenterLg alignRightXs">-->
                            <img src="<?php echo $styleUri; ?>/images/single-formation/datadock-bw.jpg" alt="">
                        </div>
                        <!--
<div class="col-xs-6 col-sm-4 alignLeft alignCenterLg alignLeftXs">
<img src="<?php //echo $styleUri; ?>/images/single-formation/qualiopi-bw.jpg" alt="">
</div>
-->
                        <div class="rating" class="col-xs-12 col-sm-4">
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-full.png" alt=""> 
                            <img src="<?php echo $styleUri; ?>/images/single-formation/star-half.png" alt=""> 
                            <span>4.7/5</span>
                            <br>
                            <i style="font-size: .9em;margin-top: .6em!important;display: inline-block">Satisfaction de nos apprenants <span class="noWrap">en 2019</span></i>
                        </div>
                    </div>
                </div>
                <div id="btn-wrapper" class="alignCenterLg">
                    <a href="<?php echo $pdfUrl; ?>"><div class="btn btn-sm btn-red-alt marginR">Télécharger la fiche en PDF</div></a>
                    <a title="Bouton de contact" href=""><div class="btn btn-sm btn-red">Parler avec un conseiller</div></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end / Heading -->
<!-- Content -->
<div class="container" style="margin-top:1em;">
    <div class="row row-same-height reverseLg">
        <div id="content" class="col-lg-8">

            <div id="goals">
                <h2 class="c-<?php echo $colorTxt; ?>">Objectifs</h2>
                <i><?php echo $title; ?></i>
                <hr>
                <ul>
                    <?php echo $goals; ?>
                </ul>
            </div>

            <div class="insert-alt-wrapper-b row sameHeight">
                <div class="col-sm-4 col-lg-6">
                    <div class="insert-alt">
                        <img width="100" height="100" src="<?php echo $styleUri; ?>/images/formateur-expert-avatar.svg">
                        <div class="wrapper">
                            <strong>Formateur</strong>  
                            <p>Notre formateur est un expert des réseaux sociaux. Il a plus de 5 ans d'expérience dans ce domaine.</p> 
                            <p><i>L'équipe d'intervenants sera coordonnée par notre équipe pédagogique.</i></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-6">
                    <div class="insert-alt">
                        <img width="100" height="100" src="<?php echo $styleUri; ?>/images/handicap.svg">
                        <div class="wrapper">
                            <strong>Accessibilité</strong>  
                            <p><i>Public en situation de handicap, <span class="noWrap">nous contacter au :</span></i></p>
                            <a title="Bouton de contact" href="tel:0977215321"><div class="btn btn-xs btn-red-alt">09 77 21 53 21</div></a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="program">
                <style>.accordeon-has-path .accordeon-item:after{background: <?php echo $colorHex; ?>;}</style>
                <h2 class="c-<?php echo $colorTxt; ?>">Programme</h2>
                <i><?php echo $title; ?></i>
                <hr>
                <?php echo $program; ?>
            </div>

            <div id="presentation">
                <h2 class="c-<?php echo $colorTxt; ?>">Présentation</h2>
                <i><?php echo $title; ?></i>
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
                        <div class="accordeon-item-title bgc-<?php echo $colorTxt; ?>">Quelles sont les modalités pédagogiques employées ?</div>
                        <div class="accordeon-item-content" style="display:none;">
                            <?php echo $evaluation; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="insert-alt-wrapper-b row sameHeight">
                <div class="insert-alt col-sm-4 col-lg-12">
                    <img width="100" height="100" src="<?php echo $styleUri; ?>/images/single-formation/ico-sm-phone.jpg">
                    <div class="wrapper">
                        <strong>Vous avez des questions sur <span class="noWrap">cette formation ?</span></strong>
                        <br>
                        <p>Nos conseillers vous répondent au :</p>
                        <a id="call-link" href="tel:0977215321">09 77 21 53 21</a>
                        <i class="lightItalic">appel non surtaxé du lundi au vendredi de 9h30 à 18h</i>
                        <i>ou par email</i>
                        <p><a id="mail-link" href="">contact@digitalacademy.fr</a></p>
                    </div>
                </div>
            </div>

            <hr style="margin-bottom: 0!important;opacity:.5">
            <div id="version"><?php echo $version; ?></div>
        </div>
        <div id="cta-col" class="col-lg-4">

            <!-- Course has sessions -->
            <?php if($hasSession): ?>

            <h2 class="c-<?php echo $colorTxt; ?>">Prochaines Dates <span class="c-color-dac">*</span></h2>
            <i><?php echo $title; ?></i>
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
                    <a title="Bouton d'inscription" href="<?php echo $session["link"]; ?>"><div class="btn btn-xs btn-red">Inscription</div></a>
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
            <!-------------- Multi-tabs Form ----------------->
            <!------------------------------------------------>
            <div id="tabled-form">

                <!-- Tabs nav -->
                <ul class="nav nav-tabs">
                    <?php if( in_array ( 'inter', $enabled_tabs ) ): ?>
                    <li class="active"><a data-toggle="tab" href="#tab-inter" class="btn btn-gray btn-tabs">Inter</a></li>
                    <?php endif; ?>
                    <?php if( in_array ( 'intra-entreprises', $enabled_tabs ) ): ?>
                    <li><a data-toggle="tab" href="#tab-intra" class="btn btn-gray btn-tabs">Intra</a></li>
                    <?php endif; ?>
                    <?php if( in_array ( 'sur-mesure', $enabled_tabs ) ): ?>
                    <li><a data-toggle="tab" href="#tab-scalable" class="btn btn-gray btn-tabs">Sur Mesure</a></li>
                    <?php endif; ?>
                </ul>
                <!-- Tabs content -->
                <div id="tab-content" class="tab-content">

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
                        <div class="content-wp">
                            <span class="form-heading ">
                                <h3 style="margin-top: 1.5em;font-weight:bold;">INTRA ENTREPRISE</h3>
                                <p style="color: #e74c3c!important;font-weight: bolder!important;font-size: .95em!important;">
                                    Formez vos collaborateurs
                                </p>                        
                            </span>
                            <hr>
                            <p style="margin-top: -1.2em;">Demander votre devis en 30 secondes, réponse sous 24h</p>
                            <a href="<?php echo $url; ?>/contact/?objet=Demande de devis pour un programme intra entreprise de la formation %22<?php the_title(); ?>%22" class="btn btn-red">Demander un devis</a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if( in_array ( 'sur-mesure', $enabled_tabs ) ): ?>
                    <div id="tab-scalable" class="tab-pane">
                        <div class="content-wp">
                            <span class="form-heading ">
                                <h3 style="margin-top: 1.5em;font-weight:bold;">SUR MESURE</h3>
                                <p style="color: #e74c3c!important;font-weight: bolder!important;font-size: .95em!important;">
                                    Votre programme de formation à la demande
                                </p>                        
                            </span>
                            <hr>
                            <p style="margin-top: -1.2em;">Nos experts conçoivent votre formation sur mesure !</p>
                            <p>Remplissez le formulaire suivant, et un de nos conseillers vous contactera dans les meilleurs délais.</p>
                            <a href="<?php echo $url; ?>/contact/?objet=Demande de devis pour un programme sur-mesure de la formation %22<?php the_title(); ?>%22" class="btn btn-red">Contactez-nous</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!------------------------------------------------>
            <!----------- end / Multi-tabs Form -------------->
            <!------------------------------------------------>
        </div>
    </div>
</div>
<?php if($th_set){ ?>
<section id="slider-formations" class="container-wp" style="background:#fff!important;">
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#eee" points="0,0 100,0 100,100"></polygon>
    </svg>
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="<?php echo $colorHex; ?>" points="0,0 100,20 0,100"></polygon>
    </svg>
    <svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#fff" points="0,0 100,0 100,100 0,100"></polygon>
    </svg>
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
                <br><br><br>
            </div>
        </div>
    </div>
</section>    
<?php } ?>
<section id="references" class="container-wp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br>
            </div>
        </div>
    </div>
</section>


<!-- Témoignages -->
<?php if ( $hasTestimonials ): ?>
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
                    <?php $testimonials = array_slice($testimonials, 0, 3);  ?>
                    <?php foreach ( $testimonials as $testimonial ): ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon fill="#fff" points="0,0 100,100 0,100"/>
                            </svg>
                            <div class="name"><?php echo $testimonial['name']; ?></div>
                            <div class="company"><?php echo $testimonial['company']; ?></div>
                            <hr>
                            <div class="testimonial"><?php echo $testimonial['content']; ?></div>
                            <?php echo $testimonial['img']; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- end/ - temoignages -->


<?php
endwhile;
endif;
?>

<script>
    //-------------------------------------------
    //--------- Form custom heading -------------
    //-------------------------------------------
    var form_heading = '<span id="form-heading"><h3 style="margin-top: 1.5em;font-weight:bold;">SESSION INTER ENTREPRISES</h3><p style="color: #e74c3c!important;font-weight: bolder!important;font-size: .95em!important;">Demander la création d\'une session à la carte</p></span><hr>';
</script>


<?php get_footer(); ?>


