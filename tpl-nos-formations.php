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
    } ?>


    <div ng-app="courseFilteringApp" id="nos-formations">

        <div ng-controller="courseFilteringController as courses">

            <div class="breadcrumb hidden-xs">
                <div class="container">
                    <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb();
} ?>
                </div>
            </div>
            <div id="kz_heading" class="container-slider main-slider nos-formations slider-header" <?php echo $bg; ?>>
                <div class="slick-slide">
                    <div class="clearfix">
                        <h1 class="title-slider"><?php the_title(); ?></h1>
                    </div>
                    <?php if ( get_field( 'sous_titre' ) ): ?>
                    <p><?php the_field( 'sous_titre' ); ?></p>
                    <?php endif; ?>
                    <div id="search">
                        <div class="container alignCenter">
                            <input ng-model="searchText" ng-init="searchText='<?php echo $search_query; ?>'" 
                                   ng-keypress="thema.t1 = 'false';thema.t2 = 'false';thema.t3 = 'false';thema.t4 = 'false';thema.t5 = 'false';thema.t6 = 'false';queryDatabase($event)"
                                   placeholder="Rechercher une formation..." autofocus>
                            <div class="button" ng-click="getCoursesFromQuery()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13"><g stroke-width="2" stroke="#fff" fill="none"><path d="M11.29 11.71l-4-4"/><circle cx="5" cy="5" r="4"/></g></svg>
                            </div>
                        </div>
                    </div>
                    <div id="thematiques-input" class="alignCenter">
                        <span>ou filtrer par thématique :</span>
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
<div id="thematiques-input" class="alignCenter">
<div class="row alignCenter">
<div ng-repeat="thema in courses.themas">
<input  type="checkbox" 
value="{{thema.color}}" 
ng-model="thema.slug" 
ng-click="onCheckboxEvent($event); searchText = '';" >
<label for="thematique-checkbox-1" class="button" ng-bind-html="thema.name"></label>
</div>
</div>
</div>


ng-model="thema.t1" 
id="thematique-checkbox-1" 
name="thematique-checkbox-1"
-->

                </div>
            </div>

            <!-- Lien vers le formulaire demande de catalogue -->
            <?php //echo get_field( 'page_demande_catalogue', 'option' ); ?>





            <div id="search-helper" class="alignCenter">
                <p ng-cloak ng-show="((courses.course | searchFor: searchText).length < courses.course.length) && ((courses.course | searchFor: searchText).length > 0)">
                    <span ng-show="seekingDB == false">{{filtered.length}} </span>
                    résultats de recherche pour : <b>{{searchText}}</b>
                </p>
                <p ng-cloak class="no-result" ng-show="(searchText.length != 0) && noResult">Aucun résultat pour la recherche : <b>{{searchText}}</b></p>
<!--                <p ng-cloak class="no-result" ng-show="((courses.course | searchFor: searchText).length == 0) && (searchText.length != 0) && (filtered.length == 0) && (seekingDB == false)">Aucun résultat pour la recherche : <b>{{searchText}}</b></p>-->
                <p ng-cloak animationend="scrolltoA" class="thema-t1" ng-show="thema.t1 == true">{{filtered.length}} résultats pour le filtre : <b>Réseaux sociaux &amp; e-réputation</b></p>
                <p ng-cloak animationend="scrolltoA" class="thema-t2" ng-show="thema.t2 == true">{{filtered.length}} résultats pour le filtre : <b>Stratégie de marketing digital</b></p>
                <p ng-cloak animationend="scrolltoA" class="thema-t3" ng-show="thema.t3 == true">{{filtered.length}} résultats pour le filtre : <b>Site &amp; contenus web</b></p>
                <p ng-cloak animationend="scrolltoA" class="thema-t4" ng-show="thema.t4 == true">{{filtered.length}} résultats pour le filtre : <b>Webmarketing &amp; e-publicité</b></p>
                <p ng-cloak animationend="scrolltoA" class="thema-t5" ng-show="thema.t5 == true">{{filtered.length}} résultats pour le filtre : <b>Entreprise 2.0</b></p>
                <p ng-cloak animationend="scrolltoA" class="thema-t6" ng-show="thema.t6 == true">{{filtered.length}} résultats pour le filtre : <b>Mobile &amp; e-commerce</b></p>
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
                                    <p>
                                        <span ng-bind-html="course.description | highlight:searchText"></span>
                                        <!--                                    <a class="course-link" href="{{course.link}}">En savoir plus sur cette formation.</a>-->
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
                                <!--
<form action="" ng-show="course.sessions.length > 0">
<select name="" id="">
<option ng-repeat="session in course.sessions" value="{{session.date}}" link="{{session.link}}">À {{session.place}} le {{session.date}}</option> 
</select>
</form>
-->
                                <!--                            <b class="no-session" ng-show="course.sessions.length == 0">Aucune session pour cette formation</b> -->
                                <a class="en-savoir-plus" href="{{course.link}}">
                                    <!--                                <div class="button">Inscription</div>-->
                                    <div class="button">En savoir plus</div>
                                </a>
                            </div>
                        </div>
                        <div ng-cloak ng-show="seekingDB" class="col-md-6 col-xl-4">
                            <div class="wrapper course_placeholer"></div>
                        </div>
                        <i aria-hidden="true" class="col-md-6 col-xl-4"></i> <!-- Left align flexbox trick, see : https://dev.to/stel/a-little-trick-to-left-align-items-in-last-row-with-flexbox-230l -->
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
                    <h2 class="hidden-xs">Calendrier des formations <span id="selectedThema" ng-show="enableThemaFilter"></span></h2>
                    <div id="calendar" class="hidden-xs">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

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
                                jQuery('#selectedThema').html('RÉSEAUX SOCIAUX &amp; E-RÉPUTATION');
                                return ['all', event.color].indexOf( jQuery('#thematique-checkbox-1').attr('value') ) >= 0
                            }
                            else if (jQuery('#thematique-checkbox-2').is(":checked")){
                                jQuery('#selectedThema').html('STRATÉGIE DE MARKETING DIGITAL');
                                return ['all', event.color].indexOf( jQuery('#thematique-checkbox-2').attr('value') ) >= 0
                            }
                            else if (jQuery('#thematique-checkbox-3').is(":checked")){
                                jQuery('#selectedThema').html('SITE &amp; CONTENUS WEB');
                                return ['all', event.color].indexOf( jQuery('#thematique-checkbox-3').attr('value') ) >= 0
                            }
                            else if (jQuery('#thematique-checkbox-4').is(":checked")){
                                jQuery('#selectedThema').html('WEBMARKETING &amp; E-PUBLICITÉ');
                                return ['all', event.color].indexOf( jQuery('#thematique-checkbox-4').attr('value') ) >= 0
                            }
                            else if (jQuery('#thematique-checkbox-5').is(":checked")){
                                jQuery('#selectedThema').html('ENTREPRISE 2.0');
                                return ['all', event.color].indexOf( jQuery('#thematique-checkbox-5').attr('value') ) >= 0
                            }
                            else if (jQuery('#thematique-checkbox-6').is(":checked")){
                                jQuery('#selectedThema').html('MOBILE &amp; E-COMMERCE');
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




            <!--   ----------------------------------------------   -->
            <!--   -------------- ANGULAR POPULATE --------------   -->
            <!--   ----------------------------------------------   -->
            <script>
                var response = <?php echo $result[0]; ?>;
                var response_themas = <?php echo $result[1]; ?>;
                var phpSearchTerm = <?php if($search_query){echo 'true';}else{echo 'false';}; ?>;
                var phpSearchIni = true;


                angular.module('courseFilteringApp', ['ngSanitize','ngAnimate'])
                    .controller('courseFilteringController', function($scope, $animate, $timeout, $filter) {
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
                        // clear keyword filtering
                        $scope.search = '';
                        $scope.database_course = [];
                        // prevent happening next time
                        $scope.enableThemaFilter = true;
                        // toggle checkboxes
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
                    });
                    courses.themas = response_themas;
                    // call function after animation ending
                    $scope.scrolltoA = function(event) {
                        $scope.$apply();
                    }
                    $scope.spinner = true;
                    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
                        $scope.spinner = false;

                        // if query parameter in URL, load result from DB
                        if((phpSearchTerm) && (phpSearchIni == true)) {
                            phpSearchIni = false;
                            $scope.queryDatabase();
                        }
                    });
                    // ini var noResult
                    $scope.noResult = false;
                    // ini array for database response
                    $scope.database_course = [];
                    // ini course placeholder (spinner kind of)
                    $scope.seekingDB = false;
                    // call getCoursesFromQuery fn if keypress
                    // delay it if another key is pressed within a delay
                    var delayExpire;
                    $scope.queryDatabase = function(keyEvent) {
                        keyEvent = keyEvent || 0;
                        $scope.seekingDB = true;
                        $scope.database_course = [];
                        function delayQuery() { 
                            $scope.getCoursesFromQuery();
                        }
                        clearTimeout(delayExpire);
                        delayExpire = setTimeout(delayQuery, 500);   
//                        if (keyEvent.which === 13){ clearTimeout(delayExpire);$scope.getCoursesFromQuery(); } // ENTER keypress
                    }     
                    // search courses related to keywords into database (including ACF fields)
                    // this method call "kz_search" php function into the function.php file
                    $scope.getCoursesFromQuery = function(){

                        if(jQuery("#search input").val()!=""){
                            $scope.seekingDB = true;
                            $scope.noResult = false;

                            // clear array
                            $scope.database_course = [];
                            jQuery.post(
                                ajaxurl,
                                {
                                    'action': 'kz_search',
                                    'keywords': jQuery("#search input").val()
                                },
                                function(response){

                                    var database_response = removeLast0(response);
                                    database_response = JSON.parse(database_response);
                                    if(database_response.courses.length > 0){
                                        $scope.noResult = false;
                                    }else{
                                        $scope.noResult = true;
                                    }
                                    database_response.courses.forEach(function (element, index) {
                                        $scope.database_course.push(element.course_id);
                                    });
                                }
                            ).done(function() {
                                // disable spinner
                                $scope.seekingDB = false;
                                // tell angular scope is modified
                                $scope.$apply();
                            });
                            // fn: check if last char is a 0 and if it is, remove it. (ugly stuff)
                            function removeLast0 (str){
                                if (str.substring(str.length-1) == "0")
                                {
                                    str = str.substring(0, str.length-1);
                                }
                                return str;
                            }
                        }else{
                            $scope.database_course = [];
                            $scope.$apply();
                        }
                    }
                })
                    .directive('onFinishRender', function ($timeout) {
                    return {
                        restrict: 'A',
                        link: function (scope, element, attr) {
                            if (scope.$last === true) {
                                $timeout(function () {
                                    scope.$emit(attr.onFinishRender);
                                });
                            }
                        }
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

                        // IE 11 exception
                        if(!!window.MSInputMethodContext && !!document.documentMode){
                            return input;
                        }                    
                        // Edge exveption
                        if(window.navigator.userAgent.indexOf("Edge") > -1){
                            return input;
                        }

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
                            }else if(item.description.toLowerCase().indexOf(searchString) !== -1){
                                result.push(item);
                            }
                        });
                        return result;
                    }
                })
                // inject additional search result from database query 
                    .filter('databaseQuery', function(){
                    return function(arr, scope){
                        function isInArray(value, array) {
                            return array.indexOf(value) > -1;
                        }        
                        // compare displayed list (arr) with database result  (scope.database_course)
                        // and add to arr the dif
                        temp_arr = [];
                        arr.forEach(function(element) {
                            temp_arr.push(element.id);
                        });
                        temp_arr_2 = [];
                        scope.database_course.forEach(function(element) {
                            if( isInArray(element, temp_arr) ){}else{
                                temp_arr_2.push(element);
                            }
                        });
                        // add additional result to output
                        temp_arr_2.forEach(function(element2) {
                            scope.courses.course.forEach(function(element) {
                                if(element.id == element2){ 
                                    arr.push(element);
                                }
                            });
                        });  
                        
                        
                        console.log(scope);
                        
                        if(arr.length == 0){
                            return scope.courses.course;
                        }else{
                            return arr;
                        }

                    }
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
                            else if(thema.t2 != false) {
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
                            else if(thema.t3 != false) {
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
                            else if(thema.t4 != false) {
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
                            else if(thema.t5 != false) {
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
                            else if(thema.t6 != false) {
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
                            }else{
                                scope.enableThemaFilter = false;
                            }
                        });
                        if (scope.enableThemaFilter == true){
                            return result;
                        }else{
                            return items;
                        }
                    };
                });
                // scroll on filter press
                var filterLabels = document.querySelectorAll("#thematiques-input label");
                filterLabels = Array.from(filterLabels); // IE11 compatibility
                filterLabels.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        scrollToResults();
                    })
                });
                // scroll on search button clicked
                document.querySelector("#search .button").onclick = function(event){
                    scrollToResults();
                }
                // scroll on enter key press
                var txtbox = document.querySelector("#search input");
                txtbox.onkeydown = function(e) {
                    if (e.key == "Enter") {
                        scrollToResults();
                    }
                };
                function scrollToResults(){
                    var menuHeight = document.getElementById('kz-menu-wrapper').offsetHeight;
                    var searchHelper = document.getElementById('search-helper');
                    var searchHelperPos = searchHelper.getBoundingClientRect();
                    window.scrollBy(0, searchHelperPos.top - menuHeight);
                }

            </script>
        </div>
    </div>
</main><!-- Main end -->
<section id="references">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3>
                <h2>Nos références clients en formation</h2>
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>