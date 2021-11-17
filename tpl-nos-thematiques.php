<?php
/**
 *   Template Name: Nos thématiques
 */
?>
<?php get_header(); ?>
<?php $thematique_ID = get_queried_object_id(); 
$th = new KzThema($thematique_ID);


// -----------------------------------------------------------------------
// GET ALL "FORMATIONS"
// -----------------------------------------------------------------------
// get query string
$search_query = isset($_GET['q']) ?  $_GET['q'] : null ;
$result = kz_search(" ");
$courses_count = count(json_decode($result[0])) ;
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------
?>
<script>
    // Pass var to js
    var response_themas = <?php echo $result[1]; ?>;
</script>

<!-- Heading -->
<div class="header">    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 alignCenter">
                <h1 class="title-slider" style="color: #fff!important;"><?php the_title(); ?></h1>
                <hr style="display:block">
            </div>
        </div>
    </div>
</div>

<div class="svg-wrapper-bottom">
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#fff" points="0,0 0,100 40,40"></polygon>
    </svg>
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
    </svg>
    <svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#f5f5f5" points="0,0 100,100 0,100"></polygon>
    </svg>
</div>    


<div class="content" style="background-color: #f5f5f5;">

    <div class="container content xs-container-menu-filtre" style="height:initial;background:none;">
        <div class="container-menu-filtre hidden-xs">
            <div class="container">
                <?php echo digital_get_thematiques_menu( $thematique_ID ); ?>
            </div>
        </div>
    </div>

    <div ng-app="courseFilteringApp" id="nos-formations">
        <div ng-controller="courseFilteringController as courses">

            <div id="search" class="hide"><div class="btn"><input></div></div>
            <div id="formations" style="padding: 0;">
                <div ng-cloak on-finish-render="ngRepeatFinished"
                     ng-repeat="thema in thema" 
                     class="animated-item" 
                     ng-show="thema.name.length > 1"
                     >
                    <div class="container">
                        <div class="thema-heading border_{{thema.color}}">
                            <img data-skip-lazy="" ng-src="{{thema.img}}" alt="">
                            <a ng-href="{{thema.url}}">
                                <h3 class="c_{{thema.color}}">Nos formations sur la thématique <span ng-bind-html="thema.name | unsafe"></span></h3>
                            </a>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div course-id="{{course.id}}" 
                                 ng-cloak on-finish-render="ngRepeatFinished"
                                 ng-repeat="course in courses.course | filterThema: thema.slug:this" 
                                 class="col-md-6 col-xl-4 animated-item" 
                                 >
                                <div class="wrapper">
                                    <a ng-href="{{course.link}}">   
                                        <img ng-src="{{course.image}}" alt="">
                                    </a>
                                    <div>
                                        <a ng-href="{{course.link}}">
                                            <h4 ng-bind-html="course.title | level_hl"></h4>
                                        </a>  
                                        <div class="nouvelle_formation" ng-show="course.new != false"></div>
                                        <div class="top_formation" ng-show="course.top != false"></div>

                                        <div class="goals" ng-bind-html="course.goals | highlight:searchText"></div>
                                    </div>
                                    <a class="en-savoir-plus" ng-href="{{course.link}}">
                                        <div class="btn btn-red btn-sm btn_c_{{thema.color}}" ng-class="selectBtnClass()">En savoir plus</div>
                                    </a>
                                </div>
                            </div>
                            <i aria-hidden="true" class="col-md-6 col-xl-4"></i>
                            <i aria-hidden="true" class="col-md-6 col-xl-4"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div ng-show="spinner == true" id="spinner-container"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
        </div>
    </div>
</div>
<div class="content" style="background-color: #fff;">


    <!--   ----------------------------------------------   -->
    <!--   ------------------ CALENDAR ------------------   -->
    <!--   ----------------------------------------------   -->
    <?php
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
            $i ++;
        }
    }

    // -----------------------------------------------------------------------
    // GET ALL CALENDAR EVENTS
    // -----------------------------------------------------------------------
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
    $events = rtrim( $events, ',' );
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------

    ?>
    <div class="container" style="margin-top:3em;">
        <div class="wrapper">
            <h2 class="hidden-xs">Calendrier des formations <?php echo $th->getName(); ?>
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

    <!--   ----------------------------------------------   -->
    <!--   -------------- CALENDAR POPULATE -------------   -->
    <!--   ----------------------------------------------   -->
    <!--   Var used in the calendar controller              -->
    <!--   js/fullcalendar-render.js                        -->
    <!--   ----------------------------------------------   -->
    <script>
        var eventsJson = [<?php echo $events; ?>];
        setTimeout( function(){
            calendar.addEventSource(eventsJson);
            calendar.refetchEvents();
        }, 1500);
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
</div><!-- Main end -->


<div class="full-width bg-orange full-width-contact">
    <p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> 
        <a href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">
            Demander le catalogue
        </a>
    </p>
</div>


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