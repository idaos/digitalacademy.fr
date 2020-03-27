<?php
/**
 *   Template Name: Nos formations
 */

// -----------------------------------------------------------------------
// GET ALL "FORMATIONS"
// -----------------------------------------------------------------------
// get query string
$search_query = isset($_GET['q']) ?  $_GET['q'] : null ;
$result = kz_search(" ");
$courses_count = count(json_decode($result[0])) ;
$th = new KzThema();
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------
get_header();
?>
<main class="content">


    <?php // get background img
    if( has_post_thumbnail() ) {
        $class = '';
        $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        $bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center"';
    }else{
        $bg = '';
    } ?>


    <div ng-app="courseFilteringApp" id="nos-formations">
        <div ng-controller="courseFilteringController as courses">
            <div class="breadcrumb hidden-xs">
                <div class="container">
                    <?php if ( function_exists( 'yoast_breadcrumb' ) ) {yoast_breadcrumb();}?>
                    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                </div>
            </div>
            
            <div id="kz_heading" class="container-slider main-slider nos-formations slider-header" <?php //echo $bg; ?>>
                <div class="slick-slide">
                    <div class="clearfix">
                        <h1 class="title-slider">Consultez notre catalogue de <?php echo $courses_count; ?> formations au digital</h1>
                    </div>
                    <hr>
                    <div id="search">
                        <div class="container alignCenter">
                            <input ng-model="searchText" ng-init="searchText='<?php echo $search_query; ?>'" 
                                   ng-keypress="thema.t1.enabled = 'false';thema.t2.enabled = 'false';thema.t3.enabled = 'false';thema.t4.enabled = 'false';thema.t5.enabled = 'false';thema.t6.enabled = 'false';queryDatabase($event)"
                                   placeholder="Rechercher une formation..." autofocus class="search-txt">
                            <div class="btn btn-red search-btn" ng-click="getCoursesFromQuery()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13"><g stroke-width="2" stroke="#fff" fill="none"><path d="M11.29 11.71l-4-4"/><circle cx="5" cy="5" r="4"/></g></svg>
                            </div>
                        </div>
                    </div>
                    <div id="thematiques-input" class="alignCenter">
                        <span>ou filtrer par thématique :</span>
                        <div class="row alignCenter">
                            <div ng-repeat="(key, thema) in thema track by $index">
                                <input ng-show="thema.name.length > 1" type="checkbox" value="{{thema.colorhex}}" ng-model="thema.enabled" ng-click="onCheckboxEvent($event, $index); searchText = '';" id="thematique-checkbox-{{thema.color}}" name="thematique-checkbox-{{thema.color}}">
                                <label ng-show="thema.name.length > 1" for="thematique-checkbox-{{thema.color}}" class="button btn btn-md" ng-bind-html="thema.name | unsafe"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="search-helper" class="alignCenter">
                <p ng-cloak ng-show="((courses.course | searchFor: searchText).length < courses.course.length) && ((courses.course | searchFor: searchText).length > 0)">
                    <span ng-show="seekingDB == false">{{filtered.length}} </span>
                    résultats de recherche pour : <b>{{searchText}}</b>
                </p>
                <p ng-cloak class="no-result" ng-show="(searchText.length != 0) && noResult">Aucun résultat pour la recherche : <b>{{searchText}}</b></p>
                <p ng-cloak ng-repeat="(key, thema) in thema track by $index" animationend="scrolltoA" class="thema-{{thema.color}}" ng-show="thema.enabled == true">{{filtered.length}} résultats pour le filtre : <b ng-bind-html="thema.name | unsafe"></b></p>
            </div>
            <div id="formations">
                <div class="container">
                    <div class="row">
                        <div course-id="{{course.id}}" 
                             ng-cloak on-finish-render="ngRepeatFinished"
                             ng-repeat="course in courses.course | searchFor: searchText | searchThema: thema:this | databaseQuery: this as filtered" 
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

                                    <div class="goals" ng-bind-html="course.goals | highlight:searchText"></div>
                                </div>
                                <a class="en-savoir-plus" href="{{course.link}}">
                                    <div class="btn btn-sm" ng-class="selectBtnClass()">En savoir plus</div>
                                </a>
                            </div>
                        </div>
                        <div ng-cloak ng-show="seekingDB" class="col-md-6 col-xl-4">
                            <div class="wrapper course_placeholer"></div>
                        </div>
                        <i aria-hidden="true" class="col-md-6 col-xl-4"></i>
                        <i aria-hidden="true" class="col-md-6 col-xl-4"></i> <!-- Left align flexbox trick, see : https://dev.to/stel/a-little-trick-to-left-align-items-in-last-row-with-flexbox-230l -->
                    </div>
                </div>
            </div>
            <div ng-show="spinner == true" id="spinner-container"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>


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
            <div class="container" style="margin-top:3em;">
                <div class="wrapper">
                    <h2 class="hidden-xs">Calendrier des formations 
                        <span 
                              id="selectedThema" 
                              ng-show="enableThemaFilter"
                              ng-class="{'t1-c': thema.t1.enabled == true , 't2-c': thema.t2.enabled == true , 't3-c': thema.t3.enabled == true , 't4-c': thema.t4.enabled == true , 't5-c': thema.t5.enabled == true , 't6-c': thema.t6.enabled == true } "
                              ></span>
                    </h2>
                    <div id="calendar" class="hidden-xs">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!--  load calendar-->
            <script defer>
                window.onload = function() {
                    checkIfCalendarDependanciesHaveBeenLoad();
                }
                function checkIfCalendarDependanciesHaveBeenLoad(){
                    setTimeout(function(){
                        if (window.jQuery) {  
                            loadCalendar();
                        }else{
                            checkIfCalendarDependanciesHaveBeenLoad();
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
//                            jQuery('[id^=thematique-checkbox-]').each(function( index ) {
//                                if ( jQuery(this).is(":checked") ){
//                                    jQuery('#selectedThema').html(jQuery( this ).next().text());
//                                    return ['all', event.color].indexOf( jQuery(this).attr('value') ) >= 0
//                                }
                                
                                if (jQuery('#thematique-checkbox-orange').is(":checked")){
                                    jQuery('#selectedThema').html('Réseaux Sociaux');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-orange').attr('value') ) >= 0
                                }
                                else if (jQuery('#thematique-checkbox-gray').is(":checked")){
                                    jQuery('#selectedThema').html('Webmarketing');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-gray').attr('value') ) >= 0
                                }
                                else if (jQuery('#thematique-checkbox-blue-dark').is(":checked")){
                                    jQuery('#selectedThema').html('Contenus &amp; Site Web');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-blue-dark').attr('value') ) >= 0
                                }
                                else if (jQuery('#thematique-checkbox-yellow').is(":checked")){
                                    jQuery('#selectedThema').html('E-publicité &amp; Acquisition');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-yellow').attr('value') ) >= 0
                                }
                                else if (jQuery('#thematique-checkbox-green').is(":checked")){
                                    jQuery('#selectedThema').html('Ressources Humaines Web 2.0');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-green').attr('value') ) >= 0
                                }
                                else if (jQuery('#thematique-checkbox-blue').is(":checked")){
                                    jQuery('#selectedThema').html('E-réputation &amp; Relation Client Web');
                                    return ['all', event.color].indexOf( jQuery('#thematique-checkbox-blue').attr('value') ) >= 0
                                }
//                            });
                        }
                    });
                }
            </script>   
            <!--   ----------------------------------------------   -->
            <!--   ---------------- END CALENDAR ----------------   -->
            <!--   ----------------------------------------------   -->


            <!--   ----------------------------------------------   -->
            <!--   -------------- ANGULAR POPULATE --------------   -->
            <!--   ----------------------------------------------   -->
            <!--   Var used in the angular controller               -->
            <!--   js/tpl-nos-formations.js                         -->
            <!--   ----------------------------------------------   -->
            <script>
                var response = <?php echo $result[0]; ?>;
                var response_themas = <?php echo json_encode($th->getData()); ?>;
                var phpSearchTerm = <?php if($search_query){echo 'true';}else{echo 'false';}; ?>;
                var phpSearchIni = true;
            </script>
            <!--   ----------------------------------------------   -->
        </div>
    </div>
</main><!-- Main end -->
<section id="references">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>