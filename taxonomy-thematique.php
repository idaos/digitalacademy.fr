<?php get_header(); ?>
<?php $thematique_ID = get_queried_object_id(); 
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
</script>

<style>
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

<!-- Heading -->
<div class="header">    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 alignCenter">
                <img src="<?php echo $th->getImage(); ?>" alt="">
                <h3 class style="margin-top:2em;color:<?php echo $th->getColorHex(); ?>!important">Nos formations sur la thématique :</h3>
                <h1 class="title-slider" style="color:<?php echo $th->getColorHex(); ?>!important"><?php echo $th->getName(); ?></h1>
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
        <polygon fill="<?php echo $th->getColorHex(); ?>" points="0,0 100,20 100,100"></polygon>
    </svg>
    <svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#f5f5f5" points="0,0 100,100 0,100"></polygon>
    </svg>
</div>    




<div class="content" style="background-color: #f5f5f5;">
    <!-- Nav -->
    <div class="container content xs-container-menu-filtre" style="height:initial;background:none;">
        <div class="container-menu-filtre hidden-xs">
            <div class="container">
                <?php echo digital_get_thematiques_menu( $thematique_ID ); ?>
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
                                   placeholder="Rechercher une formation..." autofocus class="search-txt">
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
                        <div course-id="{{course.id}}" 
                             ng-cloak on-finish-render="ngRepeatFinished"
                             ng-repeat="course in courses.course | searchFor: searchText | searchThema: thema:this | databaseQuery: this as filtered" 
                             class="col-md-6 col-xl-4 animated-item" 
                             >
                            <div class="wrapper">
                                <!-- Image -->  
                                <a ng-href="{{course.link}}">   
                                    <img ng-src="{{course.image}}" alt="">
                                </a>
                                <div>
                                    <a ng-href="{{course.link}}">
                                        <h4 ng-bind-html="course.title | level_hl | highlight: searchText"></h4>
                                    </a>  
                                    <div class="nouvelle_formation" ng-show="course.new != false"></div>
                                    <div class="top_formation" ng-show="course.top != false"></div>

                                    <div class="goals" ng-bind-html="course.goals | highlight:searchText"></div>
                                </div>
                                <a class="en-savoir-plus" ng-href="{{course.link}}">
                                    <div class="btn btn-red btn-sm btn_c_<?php echo $th->getColor(); ?>" ng-class="selectBtnClass()">En savoir plus</div>
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
        </div>
    </div>
</div>
<div class="content" style="background-color: #fff;">


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
            <h2 class="hidden-xs">Calendrier des formations <?php echo $th->getName(); ?>
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
                    if ("<?php echo $th->getColor(); ?>" == "orange"){
                        return ['all', event.color].indexOf( '#e74c3c' ) >= 0
                    }
                    else if ("<?php echo $th->getColor(); ?>" == "gray"){
                        return ['all', event.color].indexOf( '#95a5a6' ) >= 0
                    }
                    else if ("<?php echo $th->getColor(); ?>" == "blue"){
                        return ['all', event.color].indexOf( '#3498db' ) >= 0
                    }
                    else if ("<?php echo $th->getColor(); ?>" == "yellow"){
                        return ['all', event.color].indexOf( '#f59d00' ) >= 0
                    }
                    else if ("<?php echo $th->getColor(); ?>" == "green"){
                        return ['all', event.color].indexOf( '#2ecc71' ) >= 0
                    }
                    else if ("<?php echo $th->getColor(); ?>" == "blue-dark"){
                        return ['all', event.color].indexOf( '#34495e' ) >= 0
                    }
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

<?php 
// get the current category
$slug = $th->slug;
query_posts( array(
    'category_name'  => $slug,
    'posts_per_page' => -1
) );
?>

<?php
if ( have_posts() ) :
?>
<section class="articles">
    <div class="container">
        <div class="wrapper">
            <div class="row clearfix p5000">
                <div class="col-xs-12 container-blog">
                    <h2>Derniers articles au sujet des formations <?php echo strtolower($th->name); ?></h2>
                    <hr style="margin-bottom: 2em;">
                    <div class="row display-flex clearfix">

                        <?php
                        $i = 0;
                        while ( have_posts() && $i < 9) : the_post(); $i++;
                        ?>
                        <div class="col-sm-6 col-md-4" style="margin-bottom:2em;">
                            <div class="thewrapper container-border">
                                <a href="<?php the_permalink(); ?>" rel="nofollow">											
                                    <?php if ( has_post_thumbnail() ): ?>												
                                    <?php $post_thumbnail_id = get_post_thumbnail_id( $post ); ?>	
                                    <?php $post_thumbnail_url = wp_get_attachment_image_url( $post_thumbnail_id, 'post-thumbnails' ); ?>	
                                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo $post_thumbnail_url ?>) ;"></div>	
                                    <?php else : ?>												
                                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/blog-thumb-placeholder.jpg) ;"></div>	
                                    <?php endif; ?>   
                                </a>
                                <div class="content-white">
                                    <h4 class="title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p class="header-infos">Publié le <?php echo get_the_date(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-xs btn-red absolute100" rel="nofollow">
                                        Lire l'article
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>

                    </div>
                </div>
            </div>      
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>