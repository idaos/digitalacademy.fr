<?php get_header(); ?>
<?php 
wp_enqueue_style( 'courses-slider', get_template_directory_uri() . '/blocks/courses-slider/courses-slider.css', array( 'main' ), null );
$thematique_ID = get_queried_object_id(); 
$th = new KzThema($thematique_ID);
// -----------------------------------------------------------------------
// GET ALL "FORMATIONS"
// -----------------------------------------------------------------------
// get query string
$search_query = isset($_GET['q']) ?  $_GET['q'] : null ;
$result = kz_search(" ", $thematique_ID);
$courses_count = count(json_decode($result[0])) ;
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------

?>

<script>
    // Pass var to js
    var response_themas = <?php echo $result[1]; ?>;
    var page_color = "<?php $th->getColorHex() ?>";

    // Pass var to js
    var response_themas = <?php echo $result[1]; ?>;

    window.addEventListener('DOMContentLoaded', () => {

        var filterNav = document.querySelector('.xs-container-menu-filtre, .courses-category-wrapper')
        if (filterNav)
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                filterNav.classList.add('fix')
            } else {
                filterNav.classList.remove('fix')
            }
        })
    })
</script>

<style>
    .breadcrumb{
        position: relative;
    }
    .header:after {
        background-color: <?php echo $th->getColorHex(); ?>;
    }
    .header hr{
        border-top-color: <?php echo $th->getColorHex(); ?>!important;
    }
    .breadcrumb{
        text-shadow: inherit;
    }
    .breadcrumb nav p, .breadcrumb nav a, .breadcrumb nav span{
        color: #000!important;
    }
</style>







<div class="content ">
    <!-- Nav -->
    <div class="container content xs-container-menu-filtre" style="height:initial;background:none;margin-bottom:1.5rem">
        <div class="container-menu-filtre">
            <div class="container" style="padding: 0;">
                <?php echo digital_get_thematiques_menu( $thematique_ID ); ?>
            </div>
        </div>
    </div>

    <!-- Heading -->
    <div class="header">    
        <div class="container">
            <div class="row">
                <div class="col-xs-12 alignCenter">
                    <div>
                        <img src="<?php echo $th->getImage(); ?>" alt="">
                        <h1 class="title-slider" style="color:<?php echo $th->getColorHex(); ?>!important"><?php echo $th->getName(); ?></h1>
                    </div>
                    <p><?php echo $th->getDescription(); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div ng-app="courseFilteringApp" id="nos-formations">
        <div ng-controller="courseFilteringController as courses">

            <div id="kz_heading" class="container-slider main-slider nos-formations slider-header hide" <?php //echo $bg; ?>>
                <div class="slick-slide">
                    <div id="search">
                        <div class="container alignCenter">
                            <input ng-model="searchText" ng-init="searchText='<?php echo $search_query; ?>'" 
                                   placeholder="Rechercher une formation..."  class="search-txt">
                            <div class="btn btn-red search-btn" ng-click="getCoursesFromQuery()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13"><g stroke-width="2" stroke="#fff" fill="none"><path d="M11.29 11.71l-4-4"/><circle cx="5" cy="5" r="4"/></g></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="formations">
                <div class="container">
                    <div class="row">


                    <a  class="swiper-slide col-md-6 col-xl-4 animated-item mb-4" 
                        ng-href="{{course.link}}"
                        course-id="{{course.id}}" 
                        ng-cloak on-finish-render="ngRepeatFinished"
                        ng-repeat="course in courses.course | searchFor: searchText | searchThema: thema:this | databaseQuery: this as filtered" 
                                >
                        <div class="card">
                            <img ng-src="{{course.image}}" alt="">
                            <div>
                                <h4 class="px-2" ng-bind-html="course.title | level_hl | highlight: searchText"></h4>

                                <div class="tags px-2">
                                    <div>
                                        <div ng-show="course.new != false" class='nouvelle_formation btn btn-red btn-xs'>Nouvelle formation</div>
                                        <div ng-show="course.top != false" class='top_formation btn btn-red btn-xs'>Top formation</div>
                                        <div ng-bind-html="course.next_session"></div>
                                    </div>
                                </div>
                                <div class="px-2 bb-r">
                                    <div class="fs-xs">
                                        <div class="ico"></div>
                                        <span ng-bind-html="course.duree">  </span>
                                    </div>
                                    <div class="fs-xs">
                                        <div class="ico"></div>
                                        <span ng-bind-html="course.tarif">  </span>
                                    </div>
                                    <div class="fs-xs">
                                        <div class="ico"></div>
                                        <span>présentiel ou distanciel</span>
                                    </div>
                                </div>
                                <div class="goals px-2" ng-bind-html="course.goals | highlight:searchText"></div>
                            </div>
                        </div>
                    </a>

                        <div ng-cloak ng-show="seekingDB" class="col-md-6 col-xl-4">
                            <div class="wrapper course_placeholer"></div>
                        </div>
                        <i aria-hidden="true" class="col-md-6 col-xl-4"></i>
                        <i aria-hidden="true" class="col-md-6 col-xl-4"></i> <!-- Left align flexbox trick, see : https://dev.to/stel/a-little-trick-to-left-align-items-in-last-row-with-flexbox-230l -->
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
            if($couleur == $th->getColorHex())
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
    }
    $events = rtrim( $events, ',' );
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    ?>

    <div class="container" style="margin-top:3em;">
        <div class="wrapper">
            <h2 class="calendar-title hidden-xs">Calendrier des formations <?php echo $th->getName(); ?>
                <span 
                      id="selectedThema" 
                      ng-show="enableThemaFilter"
                      ng-class="{'t1-c': thema.t1 == true , 't2-c': thema.t2 == true , 't3-c': thema.t3 == true , 't4-c': thema.t4 == true , 't5-c': thema.t5 == true , 't6-c': thema.t6 == true } "
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

<?php get_footer(); ?>