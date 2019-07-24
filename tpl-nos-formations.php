<?php
/**
 *   Template Name: Nos formations
 */
?>
<?php get_header();
if ( has_post_thumbnail() ) {
    $class = '';
    $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $bg  = 'style="background-image:url(\'' . $url . '\');background-size: cover;background-position:center"';
}
?>
<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb();
} ?>
    </div>
</div>
<div class="container-slider main-slider nos-formations slider-header hidden-xs" <?php echo $bg; ?>>
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider"><?php the_title(); ?></h1>
        </div>
        <?php if ( get_field( 'sous_titre' ) ): ?>
        <p><?php the_field( 'sous_titre' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="full-width bg-orange full-width-contact">
    <p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> 
        <a href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">
            Demander le catalogue
        </a>
    </p>
</div>
<?php 
// pass paramaters
$url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
if(isset($url_parameters[1])){
    $url_parameters = $url_parameters[1];
}else{
    $url_parameters = '';
}
// get query string
$search_query = isset($_GET['q']) ?  $_GET['q'] : null ;
$scroll_to_result = ($search_query != null) ? true : false;
$arr = array();
$thema_arr = array();
$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'formation',
    'post_status'    => 'publish',
    //'meta_key'       => 'position_formation',
    //'orderby'        => 'meta_value_num', 
    //'order'	         => 'ASC',
    //    'meta_query'     => array(
    //        array(
    //            'key'     => 'top_formation',
    //            'value'   => true,
    //            'compare' => '=',
    //        )
    //    )
);
$formations = get_posts( $args );
if ( $formations ) { 
    foreach ( $formations as $formation ) {
        // thematique(s)
        $terms = get_the_terms($formation->ID, 'thematique');        
        unset($course_thematique);
        $course_thematique[] = array();
        if( ( isset($terms) )&&( is_array($terms) ) ){
            foreach($terms as $i => $term) {
                if( ( isset($terms[$i]->name) )&&( isset($terms[$i]->slug) ) ){
                    $course_thematique[] = array('name' => $terms[$i]->name, 'slug' => $terms[$i]->slug);
                    // global thema array push if not dupply
                    $thema_arr[] = [ 
                        'slug' => $terms[$i]->slug,
                        'name' => $terms[$i]->name
                    ];
                    $thema_arr = array_unique($thema_arr, SORT_REGULAR); // remove dupply
                    $thema_arr = array_values($thema_arr); // reindex
                }
            }
        }
        array_shift($course_thematique);
        if ( get_field( 'image_header_formation', $formation->ID ) ){
            // Course Link
            $course_link = get_the_permalink( $formation->ID );
            // Course Image
            $course_image = get_field( 'image_header_formation', $formation->ID ); 
        }
        if ( get_field( 'nouvelle_formation', $formation->ID ) ){
            // New Course ?
            $course_new = true;
        }else{
            $course_new = false;
        }
        if ( get_field( 'top_formation', $formation->ID ) ){
            // Top Course ?
            $course_top = true;
        }else{
            $course_top = false;
        }
        // Course Title
        $course_title = get_the_title( $formation->ID );
        // Course Session
        if( have_rows('sessions', $formation->ID) ){    
            $row = 0;
            $session_arr = array();
            while ( have_rows('sessions', $formation->ID) ) { 
                the_row();
                $row +=1;
                $date_session = strtotime( get_sub_field( 'date_session' ) );
                if ( time() < $date_session ){
                    // Session Place
                    $session_place = get_sub_field('lieu_session');
                    // Session Date
                    $session_date = date_i18n( get_option( 'date_format' ), $date_session );
                    // Session Link
                    $session_link = get_the_permalink( $formation->ID ) . '?' . $url_parameters . "#Inscription" ;
                    $session_arr[] = [ 
                        'place' => $session_place,
                        'date' => $session_date,
                        'link' => $session_link
                    ];
                }
            };
        }; 
        if ( get_field( 'presentation', $formation->ID ) ){
            // Course Description text
            $course_description = wp_trim_words( get_field( 'presentation', $formation->ID ), 20, '...' );
        }else{
            $course_description = false;
        }
        // Trainer                                     
        if ( $formateurs = wp_get_post_terms( $formation->ID, 'formateur' ) ){
            $j = 0; 
            foreach ( $formateurs as $formateur ){
                if($j==0){
                    // Trainer picture
                    $trainer_image = get_field( 'avatar', 'formateur_' . $formateur->term_id );
                    // Trainer name
                    $trainer_name = $formateur->name; 
                }
            }
            $j=+1;    
        }
        $arr[] = [ 
            'course_id' => $formation->ID, 
            'course_link' => $course_link, 
            'course_image' => $course_image, 
            'course_new' => $course_new, 
            'course_top' => $course_top, 
            'course_title' => $course_title, 
            'course_description' => $course_description, 
            'course_sessions' => $session_arr,
            'trainer_name' => $trainer_name, 
            'trainer_image' => $trainer_image,
            'course_thema' => $course_thematique
        ];
        //clear vars
        $course_link = $course_image = $course_new = $course_top = $course_title = $course_description = $next_session_place = $next_session_date = $next_session_link = $trainer_name = $trainer_image = $course_thematique = null;
    }
}
?>
<div ng-app="courseFilteringApp" id="nos-formations">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/vendor/bootsrap4/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nos-formations.css">
    <style>
        input[type='checkbox']{
            -webkit-appearance: checkbox!important;
            display: initial;
        }
        #formations [class*='col-'] {
            display: flex;
            margin: 1em 0;
        }
        .wrapper{
            height: initial!important;
        }
        .nouvelle_formation, .top_formation{
            font-weight: bold;    
        }        
        #formations{
            padding: 2em 0;
        }
        #search {
            padding : 2em 0;
            background-color: #a6a6a6;
            background-image: url('https://recette.digitalacademy.fr/wp-content/themes/digitalacademy/images/board.gif');
        }
        #search .container:first-child{
            max-width: 600px;
        }
        #search input{
            outline: solid 8px rgba(0,0,0,.2);
            border: solid 1px #eee;
            height:3em;
            padding-left: .8em;
            width: calc(100% - 4em);
            max-width: 100%;
        }
        #search .button{
            outline: solid 8px rgba(0,0,0,.2);
            height: 3em;
            width:initial!important;
            margin-left: 5px;
        }
        #thematiques-input{
            padding: 1em;
            max-width: 700px;
        }
        #thematiques-input span{
            margin-bottom: .8em;
            display: block;
        }
        #thematiques-input input{
            display: none;
            -webkit-appearance: checkbox!important;
        }
        #thematiques-input label{
            margin: .5em !important;
            height:2em !important;
            line-height:2em !important;
            padding:  0 .5em !important;
        }
        /*        .thema-t0{background:#b9b9b9;}*/
        #thematique-checkbox-1 + .button:hover, #thematique-checkbox-1:checked + .button{
            background: none;
            outline: solid 2px #e74c3c;
            color: #e74c3c;
        }
        #thematique-checkbox-1 + .button{
            background:#e74c3c;
            color:#fff;
            outline: solid 2px #e74c3c;
        }
        .thema-t1{background:#e74c3c;}
        #thematique-checkbox-2 + .button:hover, #thematique-checkbox-2:checked + .button{
            background: none;
            outline: solid 2px #95a5a6;
            color: #95a5a6;
        }
        #thematique-checkbox-2 + .button{
            background:#95a5a6;
            color:#fff;
            outline: solid 2px #95a5a6;
        }
        .thema-t2{background:#95a5a6;}
        #thematique-checkbox-3 + .button:hover, #thematique-checkbox-3:checked + .button{
            background: none;
            outline: solid 2px #3498db;
            color: #3498db;
        }
        #thematique-checkbox-3 + .button{
            background:#3498db;
            color:#fff;
            outline: solid 2px #3498db;
        }
        .thema-t3{background:#3498db;}
        #thematique-checkbox-4 + .button:hover, #thematique-checkbox-4:checked + .button{
            background: none;
            outline: solid 2px #f59d00;
            color: #f59d00;
        }
        #thematique-checkbox-4 + .button{
            background:#f59d00;
            color:#fff;
            outline: solid 2px #f59d00;
        }
        .thema-t4{background:#f59d00;}
        #thematique-checkbox-5 + .button:hover, #thematique-checkbox-5:checked + .button{
            background: none;
            outline: solid 2px #2ecc71;
            color: #2ecc71;
        }
        #thematique-checkbox-5 + .button{
            background:#2ecc71;
            color:#fff;
            outline: solid 2px #2ecc71;
        }
        .thema-t5{background:#2ecc71;}
        #thematique-checkbox-6 + .button:hover, #thematique-checkbox-6:checked + .button{
            background: none;
            outline: solid 2px #34495e;
            color: #6f88a1;
        }
        #thematique-checkbox-6 + .button{
            background:#34495e;
            color:#fff;
            outline: solid 2px #34495e;
        }
        .thema-t6{background:#34495e;}
        .highlighted{
            color: red;
            background-color: yellow;
            padding:0!important;
            vertical-align: initial!important;
            text-align: inherit!important;
            display: inline!important;
        }
        .level_hl{
            padding: .3em .0em!important;
            font-size: .7em;
            color: #8d8b8b;
            font-weight: bold;
            font-style: italic;
            border-radius: .2em;
        }
        .animated-item {
            -webkit-transition:all ease 0.3s;
            transition:all ease 0.3s;
        }
        .animated-item.ng-leave.ng-leave-active,
        .animated-item.ng-move,
        .animated-item.ng-enter {
            opacity:0;
        }
        .animated-item.ng-leave,
        .animated-item.ng-move.ng-move-active,
        .animated-item.ng-enter.ng-enter-active {
            opacity:1;
        }
        #search-helper{
            height: auto;
            background: #8f8f8f;
            color: #fff;
        }
        #search-helper p{
            line-height: 3em;
            height: 3em;
            margin:0;
        }
        #search-helper p:first-child{
            background: #bb0303;
        }
        @media (max-width: 634px) {
            #thematiques-input > .row > div{
                width: 100% !important;
                display: block !important;
                margin: 0 2em;
            }
            #thematiques-input label {
                margin: .5em 0 !important;
            }
        }
        #thematiques-input > .row > div{
            display: inline-block;
            font-size: .79em;
            width: auto;
        }
        #formations [class*='col-'] .wrapper div p {
            margin-bottom: 1.5em;
            padding-bottom: 8.9em !important;
        }
        [class*='arrow-']{
            font-family: monospace;
            color: #bf3b2b;
            cursor: pointer;
        }
        /* Calendar */
        main{
            padding-top: 3em;
            padding-bottom: 4em;
        }
        main button{
            height: auto!important;
        }
        h2{ 
            font-variant: initial!important;
        }
        /* Anim */
        @keyframes fadeIn {
            from {opacity: 0;}
        }
        @keyframes fadeOut {
            to {opacity: 0;}
        }
        .ng-animate {
            animation-duration: .2s;
            animation-fill-mode: both;
        }
        .ng-hide-remove {
            animation-name: fadeIn;
        }
        .ng-hide-add {
            animation-name: fadeOut;
        }
        #formations [class*='col-'] .wrapper div a > h4 {
            color: #bf3b2b;
            text-transform: initial;
            font-weight: bold;
            font-size: 1.5em;
        }
        .where, .when, .arrow-right, .arrow-left{
            color: #000 !important;
        }
        #formations .wrapper > a:first-child{
            position: relative;
            display: block;
        }
        .nouvelle_formation, .top_formation{
            padding: 0 !important;
            font-size: .7em;
        }
        .nouvelle_formation:before, .top_formation:before{
            background-color: #b1b1b1 !important;
            border-radius: 4px;
        }
        .course-link{
            text-decoration: underline;
        }
        form{
            background: none;
            padding: 1em;
            position: absolute;
            bottom: 3em;
            width: 100%;
        }
        select{
            height: 2.2em;
        }
        #formations [class*='col-'] .wrapper div span {padding: 0 0 .5em 0;}
        #formations [class*='col-'] .wrapper div p {padding-bottom:9em;}
        #formations [class*='col-'] .wrapper .alignCenter {bottom: 6em; padding:0 1em 1.5em 5em; padding-bottom: 6em !important;}
        .no-session{
            position: absolute;
            bottom: 4.7em;
            width: 100%;
            text-align: center;
        }
        #nos-formations input[type='checkbox'] {
            display: none;
        }
    </style>


    <!--
<div class="container">
<div class="row">
<div class="col-12">
-->

    <?php
    //                $args = array(
    //                    'posts_per_page' => 10000,
    //                    'post_type'      => 'formation',
    //                    'post_status'    => 'publish'
    //                );
    //                $formations2 = new WP_Query( $args );
    //                $expandedResults = advanced_custom_search('Facebook', $formations2); // check SQL injection
    //                echo '<pre>'. print_r($expandedResults) . '</pre>';



    ?>

    <!--
</div>
</div>
</div>
-->




    <div ng-controller="courseFilteringController as courses">
        <div id="search">
            <div class="container alignCenter">
                <input ng-model="searchText" ng-init="searchText='<?php echo $search_query; ?>'" 
                       ng-keypress="thema.t1 = 'false';thema.t2 = 'false';thema.t3 = 'false';thema.t4 = 'false';thema.t5 = 'false';thema.t6 = 'false'"
                       placeholder="Rechercher une formation..." autofocus>
                <div class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13"><g stroke-width="2" stroke="#fff" fill="none"><path d="M11.29 11.71l-4-4"/><circle cx="5" cy="5" r="4"/></g></svg>
                </div>
            </div>
        </div>
        <div id="thematiques-input" class="container alignCenter">
            <span>Filtrer par thématique :</span>
            <div class="row alignCenter">
                <div>
                    <input type="checkbox" value="#e74c3c" ng-model="thema.t1" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-1" name="thematique-checkbox-1">
                    <label for="thematique-checkbox-1" class="button">RÉSEAUX SOCIAUX &amp; E-RÉPUTATION</label>
                </div>
                <div>
                    <input type="checkbox" value="#95a5a6" ng-model="thema.t2" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-2" name="thematique-checkbox-2">
                    <label for="thematique-checkbox-2" class="button">STRATÉGIE DE MARKETING DIGITAL</label>
                </div>
                <div>
                    <input type="checkbox" value="#3498db" ng-model="thema.t3" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-3" name="thematique-checkbox-3">
                    <label for="thematique-checkbox-3" class="button">SITE &amp; CONTENUS WEB</label>
                </div>
                <div>
                    <input type="checkbox" value="#f59d00" ng-model="thema.t4" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-4" name="thematique-checkbox-4">
                    <label for="thematique-checkbox-4" class="button">WEBMARKETING &amp; E-PUBLICITÉ</label>
                </div>
                <div>
                    <input type="checkbox" value="#2ecc71" ng-model="thema.t5" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-5" name="thematique-checkbox-5">
                    <label for="thematique-checkbox-5" class="button">ENTREPRISE 2.0</label>
                </div>
                <div>
                    <input type="checkbox" value="#34495e" ng-model="thema.t6" ng-click="onCheckboxEvent($event); searchText = '';" id="thematique-checkbox-6" name="thematique-checkbox-6">
                    <label for="thematique-checkbox-6" class="button">MOBILE &amp; E-COMMERCE</label>
                </div>
            </div>
        </div>
        <!--
<div id="thematiques-input" class="container alignCenter">
<div class="row alignCenter">
<div ng-repeat="thema in courses.themas">
<input type="checkbox" 
ng-model="thema.slug" 
ng-click="SLEEP__onCheckboxEvent($event); searchText = '';">
<label ng-bind-html="thema.name" class="button">{{thema.name}}</label>
</div>
</div>
</div>
-->
        <div id="search-helper" class="alignCenter">
            <p ng-show="(courses.course | searchFor: searchText | searchThema: thema:this).length == 0">Aucun résultat !</p>
            <p ng-show="((courses.course | searchFor: searchText).length < courses.course.length) && ((courses.course | searchFor: searchText).length > 0)">Résultats de recherche : <b>{{searchText}}</b></p>
            <!--            <p animationend="scrolltoA" class="thema-t0" ng-show="thema.t1 == false && thema.t2 == false && thema.t3 == false && thema.t4 == false && thema.t5 == false && thema.t6 == false">Toutes nos formations :</b></p>-->
            <p animationend="scrolltoA" class="thema-t1" ng-show="thema.t1 == true">Résultats de filtre : <b>Réseaux sociaux &amp; e-réputation</b></p>
            <p animationend="scrolltoA" class="thema-t2" ng-show="thema.t2 == true">Résultats de filtre : <b>Stratégie de marketing digital</b></p>
            <p animationend="scrolltoA" class="thema-t3" ng-show="thema.t3 == true">Résultats de filtre : <b>Site &amp; contenus web</b></p>
            <p animationend="scrolltoA" class="thema-t4" ng-show="thema.t4 == true">Résultats de filtre : <b>Webmarketing &amp; e-publicité</b></p>
            <p animationend="scrolltoA" class="thema-t5" ng-show="thema.t5 == true">Résultats de filtre : <b>Entreprise 2.0</b></p>
            <p animationend="scrolltoA" class="thema-t6" ng-show="thema.t6 == true">Résultats de filtre : <b>Mobile &amp; e-commerce</b></p>
        </div>
        <div id="formations">
            <div class="container">
                <div class="row">
                    <div 
                         ng-repeat="course in courses.course | searchFor: searchText | searchThema: thema:this" 
                         class="col-md-6 col-xl-4 animated-item" 
                         >
                        <div class="wrapper">
                            <!-- Image -->  
                            <a href="{{course.link}}">   
                                <img ng-src="{{course.image}}" alt="">
                            </a>
                            <div>
                                <a href="{{course.link}}">
                                    <h4 ng-bind-html="course.title | level_hl | highlight: searchText"></h4>
                                </a>  
                                <div class="nouvelle_formation" ng-show="course.new != false"></div>
                                <div class="top_formation" ng-show="course.top != false"></div>
                                <p>
                                    <span ng-bind-html="course.description | highlight:searchText"></span>
                                    <a class="course-link" href="{{course.link}}">En savoir plus sur cette formation.</a>
                                </p>
                            </div>
                            <div class="alignCenter">
                                <!-- Formateur -->                                        
                                <img ng-src="{{course.trainer_image}}" alt="" width="100" height="100">
                                <span>
                                    <i>Animée par :</i><br>
                                    <b ng-bind-html="course.trainer_name | highlight:searchText"></b>
                                </span>
                            </div>
                            <form action="" ng-show="course.sessions.length > 0">
                                <select name="" id="">
                                    <option ng-repeat="session in course.sessions" value="{{session.date}}" link="{{session.link}}">À {{session.place}} le {{session.date}}</option> 
                                </select>
                            </form>
                            <b class="no-session" ng-show="course.sessions.length == 0">Aucune session pour cette formation</b> 
                            <a class="en-savoir-plus" href="{{course.link}}">
                                <div class="button">Inscription</div>
                            </a>
                        </div>
                    </div>
                    <!-- display all courses if filters return null -->
                    <div ng-show="(courses.course | searchFor: searchText | searchThema: thema:this).length == 0"
                         ng-repeat="course in courses.course" 
                         class="col-md-6 col-xl-4 animated-item" 
                         >
                        <div class="wrapper">
                            <!-- Image -->  
                            <a href="{{course.link}}">   
                                <img ng-src="{{course.image}}" alt="">
                            </a>
                            <div>
                                <a href="{{course.link}}">
                                    <h4 ng-bind-html="course.title | level_hl | highlight: searchText"></h4>
                                </a>  
                                <div class="nouvelle_formation" ng-show="course.new != false"></div>
                                <div class="top_formation" ng-show="course.top != false"></div>
                                <p>
                                    <span ng-bind-html="course.description | highlight:searchText"></span>
                                    <a class="course-link" href="{{course.link}}">En savoir plus sur cette formation.</a>
                                </p>
                            </div>
                            <div class="alignCenter">
                                <!-- Formateur -->                                        
                                <img ng-src="{{course.trainer_image}}" alt="" width="100" height="100">
                                <span>
                                    <i>Animée par :</i><br>
                                    <b ng-bind-html="course.trainer_name | highlight:searchText"></b>
                                </span>
                            </div>
                            <form action="" ng-show="course.sessions.length > 0">
                                <select name="" id="">
                                    <option ng-repeat="session in course.sessions" value="{{session.date}}" link="{{session.link}}">À {{session.place}} le {{session.date}}</option> 
                                </select>
                            </form>
                            <b class="no-session" ng-show="course.sessions.length == 0">Aucune session pour cette formation</b> 
                            <a class="en-savoir-plus" href="{{course.link}}">
                                <div class="button">Inscription</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--   ----------------------------------------------   -->
        <!--   ------------------ CALENDAR ------------------   -->
        <!--   ----------------------------------------------   -->
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
                    </div>
                </div>
            </div>
        </main><!-- Main end -->
        <!--  load calendar-->
        <script defer>
            checkIfCalendarDependanciesHaveBeenLoad();
            function checkIfCalendarDependanciesHaveBeenLoad(){
                setTimeout(function(){
                    if (typeof fullcalendarFullyLoaded !== 'undefined') {
                        // if yes, render calendar..
                        loadCalendar();
                    }else{
                        checkIfCalendarDependanciesHaveBeenLoad();
                        loadCalendar();
                    }
                }, 300);
            }
            function loadCalendar(){
                jQuery('#calendar').fullCalendar({
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
                    ], // filter by thematique
                    eventRender: function eventRender( event, element, view ) {
                        if (jQuery('#thematique-checkbox-1').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-1').attr('value') ) >= 0
                        }
                        else if (jQuery('#thematique-checkbox-2').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-2').attr('value') ) >= 0
                        }
                        else if (jQuery('#thematique-checkbox-3').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-3').attr('value') ) >= 0
                        }
                        else if (jQuery('#thematique-checkbox-4').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-4').attr('value') ) >= 0
                        }
                        else if (jQuery('#thematique-checkbox-5').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-5').attr('value') ) >= 0
                        }
                        else if (jQuery('#thematique-checkbox-6').is(":checked")){
                            return ['all', event.color].indexOf( jQuery('#thematique-checkbox-6').attr('value') ) >= 0
                        }
                    }
                });
            }
        </script>
        <script>
            // rerender calendar on thematique selection
            jQuery('[id^=thematique-checkbox-]').on('change',function(){
                jQuery('#calendar').fullCalendar('rerenderEvents');
            })
        </script>     
        <!--   ----------------------------------------------   -->
        <!--   ---------------- END CALENDAR ----------------   -->
        <!--   ----------------------------------------------   -->
        <!--
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-animate.min.js"></script>
-->

        <script>
            var response = <?php echo json_encode($arr); ?>;
            console.log(response)
            var response_themas = <?php echo json_encode($thema_arr); ?>;
            angular.module('courseFilteringApp', ['ngSanitize','ngAnimate'])
                .controller('courseFilteringController', function($scope, $animate, $timeout) {
                var courses = this;
                $scope.search = '';     // set the default search/filter term
                $scope.thema = {
                    t1:false,
                    t2:false,
                    t3:false,
                    t4:false,
                    t5:false,
                    t6:false
                }
                // disable all thema checkboxes on first click on a checkbox
                $scope.enableThemaFilter = false;
                $scope.onCheckboxEvent = function(event) {
                    // prevent happening next time
                    $scope.enableThemaFilter = true;
                    // toggle cheboxes
                    if(event.target.id.slice(-1) != '1'){$scope.thema.t1 = false;}else{$scope.thema.t1 = true;}
                    if(event.target.id.slice(-1) != '2'){$scope.thema.t2 = false;}else{$scope.thema.t2 = true;}
                    if(event.target.id.slice(-1) != '3'){$scope.thema.t3 = false;}else{$scope.thema.t3 = true;}
                    if(event.target.id.slice(-1) != '4'){$scope.thema.t4 = false;}else{$scope.thema.t4 = true;}
                    if(event.target.id.slice(-1) != '5'){$scope.thema.t5 = false;}else{$scope.thema.t5 = true;}
                    if(event.target.id.slice(-1) != '6'){$scope.thema.t6 = false;}else{$scope.thema.t6 = true;}
                }
                courses.course = [];
                response.forEach(function (element, index) {
                    var thisElt = {
                        id:                   element.course_id, 
                        link:                 element.course_link, 
                        image:                element.course_image, 
                        new:                  element.course_new, 
                        top:                  element.course_top, 
                        title:                element.course_title, 
                        description:          element.course_description, 
                        sessions:             element.course_sessions,
                        trainer_name:         element.trainer_name,
                        trainer_image:        element.trainer_image,
                        thema:                element.course_thema
                    };  
                    courses.course.push(thisElt);
                    // session loop
                    //                    if(thisElt.sessions.length > 0){ 
                    //
                    //                        thisElt.session_date = thisElt.sessions[0].date;
                    //                        thisElt.session_link = thisElt.sessions[0].link;
                    //                        thisElt.session_place = thisElt.sessions[0].place;                    
                    //                        thisElt.session_selected = 0;                    
                    //                        thisElt.session_length = thisElt.sessions.length;                    
                    //                    }else{
                    //                        thisElt.session_date = false;
                    //                        thisElt.session_link = false;
                    //                        thisElt.session_place = false;
                    //                    };
                    //                    if(thisElt.sessions.length > 1){
                    //                        thisElt.session_show_arrows = true;   
                    //                    }else{
                    //                        thisElt.session_show_arrows = false;   
                    //                    }
                });
                //                $scope.getSession = function($event, course) {
                //                    var el = (function(){
                //                        if ($event.target.className === 'arrow-right') {
                //
                //                            course.session_selected += 1;
                //                            if( course.session_selected < course.session_length ){
                //                                course.session_date = course.sessions[course.session_selected]['date'];
                //                                course.session_link = course.sessions[course.session_selected]['link'];
                //                                course.session_place = course.sessions[course.session_selected]['place'];  
                //                            }else{
                //                                course.session_selected = 0;
                //                                course.session_date = course.sessions[course.session_selected]['date'];
                //                                course.session_link = course.sessions[course.session_selected]['link'];
                //                                course.session_place = course.sessions[course.session_selected]['place'];  
                //                            }
                //                        } else if($event.target.className === 'arrow-left') {
                //
                //                            course.session_selected -= 1;
                //                            if( course.session_selected < 0 ){
                //                                course.session_selected = course.session_length -1;
                //                                course.session_date = course.sessions[course.session_selected]['date'];
                //                                course.session_link = course.sessions[course.session_selected]['link'];
                //                                course.session_place = course.sessions[course.session_selected]['place'];  
                //                            }else{
                //                                course.session_selected -= 1;
                //                                course.session_date = course.sessions[course.session_selected]['date'];
                //                                course.session_link = course.sessions[course.session_selected]['link'];
                //                                course.session_place = course.sessions[course.session_selected]['place'];  
                //                            }
                //                        }
                //                    })();
                //                };
                //                $scope.getSessionAlt = function($event, course) {
                //                    var el = (function(){
                //                        angular.forEach(course.sessions, function(value, key){
                //                             console.log(key + ': ' + value);
                //                        });
                //                    })();
                //                };
                courses.themas = response_themas;
                // call function after animation ending
                $scope.scrolltoA = function(event) {
                    $scope.$apply();
                }
            })
                .directive('animationend', function() {
                return {
                    restrict: 'A',
                    scope: {
                        animationend: '&'
                    },
                    link: function(scope, element) {
                        var callback = scope.animationend(),
                            events = 'animationend webkitAnimationEnd MSAnimationEnd' + 'transitionend webkitTransitionEnd';
                        element.on(events, function(event) {
                            callback.call(element[0], event);
                        });
                    }
                };
            })
                .filter('highlight', function($sce) {
                return function(input, phrase) {
                    // regex : not in an html <tag>
                    if (phrase && input) input = input.replace(new RegExp('(?<!<[^>]*)('+phrase+')', 'gi'),
                                                               '<span class="highlighted">$1</span>')
                    return $sce.trustAsHtml(input)
                }
            })
                .filter('level_hl', function($sce) {
                return function(input) {
                    if(input != null){
                        input = input.replace('&#8211; ', '');
                        input = input.replace(new RegExp('('+'Niveau perfectionnement'+')', 'gi'),
                                              '<span class="level_hl">$1</span>')
                        input = input.replace(new RegExp('('+'Niveau initiation'+')', 'gi'),
                                              '<span class="level_hl">$1</span>')
                        return input
                    }
                }
            })
                .filter('searchFor', function(){
                return function(arr, searchString){
                    if(!searchString){
                        return arr;
                    }
                    var result = [];
                    searchString = searchString.toLowerCase();
                    angular.forEach(arr, function(item){
                        if(item.title.toLowerCase().indexOf(searchString) !== -1){
                            result.push(item);
                        }
                    });
                    return result;
                };
            })
                .filter('searchThema', function(){
                return function(items, thema, scope) {
                    var result = [];
                    var th1 = 'reseaux-sociaux-e-reputation';
                    var th2 = 'strategie-de-marketing-digital';
                    var th3 = 'site-contenus-web';
                    var th4 = 'webmarketing-e-publicite';
                    var th5 = 'entreprise-2-0';
                    var th6 = 'mobile-e-commerce';
                    angular.forEach(items, function(item) {
                        // if checkbox is checked for this thematique..
                        if(thema.t1 != false) {
                            // loop through item themas
                            for (var i = 0; i < item.thema.length; i++) {
                                // check if item thema is set
                                if(typeof item.thema[i] != 'undefined') {
                                    // check if item thema has a slug
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        // if checked thematique = item thematique, keep it
                                        if ( item.thema[i].slug == th1 ){
                                            // check duplicated objects
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(thema.t2 != false) {
                            for (var i = 0; i < item.thema.length; i++) {
                                if(typeof item.thema[i] != 'undefined') {
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        if ( item.thema[i].slug == th2 ){
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(thema.t3 != false) {
                            for (var i = 0; i < item.thema.length; i++) {
                                if(typeof item.thema[i] != 'undefined') {
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        if ( item.thema[i].slug == th3 ){
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(thema.t4 != false) {
                            for (var i = 0; i < item.thema.length; i++) {
                                if(typeof item.thema[i] != 'undefined') {
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        if ( item.thema[i].slug == th4 ){   
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(thema.t5 != false) {
                            for (var i = 0; i < item.thema.length; i++) {
                                if(typeof item.thema[i] != 'undefined') {
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        if ( item.thema[i].slug == th5 ){
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if(thema.t6 != false) {
                            for (var i = 0; i < item.thema.length; i++) {
                                if(typeof item.thema[i] != 'undefined') {
                                    if (item.thema[i].hasOwnProperty('slug')){
                                        if ( item.thema[i].slug == th6 ){
                                            if ( result.indexOf(item) > -1 ) {
                                            }else{
                                                result.push(item);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    });
                    if (scope.enableThemaFilter == true){
                        return result;
                    }else{
                        return items;
                    }
                };
            });
            // auto scroll to result if page is loaded after search form submit
            <?php 
            if($scroll_to_result == true){
                echo "scrollIt(getPosition(document.getElementById('search')).y);";
            } 
            ?>
            // scroll on key press
            document.querySelector("#search input").onkeypress = function(event){
                var s_offset = document.querySelector("#undefined-sticky-wrapper").offsetHeight;
                document.querySelector("#search").scrollIntoView();
                window.scrollBy(0, -s_offset/2 -13);
            }
            // scroll on filter press
            document.querySelector("#thematiques-input div").onclick = function(event){
                var s_offset = document.querySelector("#undefined-sticky-wrapper").offsetHeight;
                document.querySelector("#search-helper").scrollIntoView();
                window.scrollBy(0, -s_offset/2 -13);
            }
            // scroll on search button clicked
            document.querySelector("#search .button").onclick = function(event){
                var s_offset = document.querySelector("#undefined-sticky-wrapper").offsetHeight;
                document.querySelector("#search-helper").scrollIntoView();
                window.scrollBy(0, -s_offset/2 -13);
            }
            // scroll on enter key press
            var txtbox = document.querySelector("#search input");
            txtbox.onkeydown = function(e) {
                if (e.key == "Enter") {
                    var s_offset = document.querySelector("#undefined-sticky-wrapper").offsetHeight;
                    document.querySelector("#search-helper").scrollIntoView();
                    window.scrollBy(0, -s_offset/2 -13);
                }
            };


            // scroll fn
            //            function scrollIt(offset) {
            //                window.scrollTo({
            //                    'behavior': 'smooth',
            //                    'left': 0,
            //                    'top': offset 
            //                });
            //            }
            /**
               * returns the absolute position of an element regardless of position/float issues
               * @param {HTMLElement} el - element to return position for 
               * @returns {object} { x: num, y: num }
               */
            //            function getPosition(el) {
            //                var x = 0,
            //                    y = 0;
            //                while (el != null && (el.tagName || '').toLowerCase() != 'html') {
            //                    x += el.offsetLeft || 0; 
            //                    y += el.offsetTop || 0;
            //                    el = el.parentElement;
            //                }
            //                return { x: parseInt(x, 10), y: parseInt(y, 10) };
            //            }
        </script>
    </div>
</div>
<div class="wrapper text-center container-reference">
    <h3>Nos références clients en formation</h3>
    <?php echo do_shortcode( '[references_slider]' ); ?>
</div>
<?php get_footer(); ?>