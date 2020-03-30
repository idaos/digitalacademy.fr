<?php
/**
 * Chargement de shortcodes
 */

include( 'inc/shortcodes.php' );

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

//------------------------ SCRIPT & STYLES ENQUEUING ------------------------------

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

function tp_enqueue_scripts() {
    global $wp_query;
    if( isset($wp_query->post->ID) ){
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
    }else{
        $template_name = 'unknown';
    }

    wp_enqueue_script( 'jquery' );
    wp_enqueue_style( 'heading-triangles', get_template_directory_uri() . '/css/heading-triangles.css', array( 'main' ), null );
    wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&display=swap', array(), false, true );
    wp_enqueue_style( 'menu', get_stylesheet_directory_uri() . '/css/menu.css', null, null );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), null, false );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css', null );
    wp_enqueue_script( 'formsubmission', get_stylesheet_directory_uri() . '/landing-page-catalogue/res/formSubmission.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'trackingAnalytics', get_stylesheet_directory_uri() . '/js/trackingAnalytics.js', array( 'jquery' ), null, false );
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css?ver=2', array( 'bootstrap-theme' ), null );
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?ver=2', null );
    wp_enqueue_style( 'bootstrap-theme', get_stylesheet_directory_uri() . '/css/bootstrap-theme.min.css', array( 'bootstrap' ), null );
    wp_enqueue_style( 'tp', get_stylesheet_directory_uri() . '/css/tp.css', array( 'main', 'js_composer_front' ), null );
    //wp_enqueue_script( 'gmaps', 'https://maps.google.com/maps/api/js?sensor=true', null, null, false );
    wp_enqueue_script( 'contact-btn', get_template_directory_uri() . '/js/contact-btn.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'menu', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), null, false );
    wp_enqueue_style( 'button-style', get_template_directory_uri() . '/css/button.css', array( 'main', 'bootstrap' ), null );

    wp_register_script( 'slick-courses', get_stylesheet_directory_uri() . '/js/slickCourses.js', array( 'slick' ), null, false );
    wp_register_script( 'slick-refs', get_stylesheet_directory_uri() . '/js/slickRefs.js', array( 'slick' ), null, false );
    wp_register_style( 'course-card', get_template_directory_uri() . '/css/course-card.css', null );
    wp_register_style( 'references-style', get_template_directory_uri() . '/css/references.css', array( 'main' ), null );


    if ( is_tax( 'thematique' ) || is_page_template( 'tpl-nos-thematiques.php' ) ) {
        wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.css', null, null, null );
        wp_enqueue_style( 'fullcalendar-print', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.print.css', array( 'fullcalendar' ), null, 'print' );
        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/fullcalendar/lib/moment.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar-fr', get_stylesheet_directory_uri() . '/js/fullcalendar/lang/fr.js', array( 'fullcalendar' ), null, false );
        wp_enqueue_style( 'calendar-style', get_stylesheet_directory_uri() . '/css/calendar.css', array( 'main' ), null );
    }
    if(!is_front_page()){
        wp_enqueue_script( 'easyListSplitter', get_stylesheet_directory_uri() . '/js/jquery.easyListSplitter.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'isotope', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/js/theme.js', array( 'bootstrap', 'slick' ), null, false );
    }

    if(($template_name != 'template-pages-offre.php')
       &&($template_name != 'tpl-nos-formations.php')
       &&(is_page(260)) // page Clients
      ){
        wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home_style.css', array( 'main' ), null );
    }
}

add_action( 'wp_enqueue_scripts', 'tp_enqueue_scripts' );


/**
 * Chargement des styles et scripts pour les pages   'Offre'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_offre');
//Load scripts (and styles)
function custom_scripts_and_styles_offre(){
    if(is_page()){ //Check if we are viewing a page
        global $wp_query;
        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if($template_name == 'template-pages-offre.php'){
            wp_enqueue_script( 'modal', get_stylesheet_directory_uri() . '/js/modal.js', array( 'jquery' ), null, false );
            wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.carousel.min.js', null, null, false );
            wp_enqueue_script( 'pages-offre', get_stylesheet_directory_uri() . '/pages-offre/pages-offre.js', array( 'jquery', 'owl-carousel' ), null, false );
            wp_enqueue_style( 'modal', get_template_directory_uri() . '/css/modal.css', null );
            wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.carousel.min.css', null );
            wp_enqueue_style( 'owl-carousel-theme-style', get_template_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.theme.default.min.css', null );
            wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home_style.css', array( 'main' ), null );
            wp_enqueue_style( 'pages-offre-style', get_template_directory_uri() . '/pages-offre/pages-offre.css', array( 'home-style' ), null );
            wp_enqueue_style( 'bootstrap-4-grid', get_template_directory_uri() . '/pages-offre/vendor/bootsrap4/css/bootstrap-grid.min.css', array( 'bootstrap' ) );
            // dequeue
            wp_dequeue_style('gforms_css');
            wp_dequeue_style('gforms_formsmain_css');
            wp_dequeue_style('gforms_reset_css');
        }
    }
}

/**
 * Chargement des styles et scripts pour les pages   'Qui sommes nous'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_quiSommesNous');
//Load scripts (and styles)
function custom_scripts_and_styles_quiSommesNous(){
    if(is_page()){ //Check if we are viewing a page
        global $wp_query;
        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if($template_name == 'template-qui-sommes-nous.php'){
            wp_enqueue_style( 'qui-sommes-nous-style', get_template_directory_uri() . '/css/qui-sommes-nous.css', null );
        }
    }
}

/**
 * Chargement des styles et scripts pour les pages   'Thematiques'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_taxo_thema');
//Load scripts (and styles)
function custom_scripts_and_styles_taxo_thema(){
    global $wp_query;
    //Check which template is assigned to current page we are looking at
    if ( is_tax( 'thematique' ) || is_page_template( 'tpl-nos-thematiques.php' ) ) {
        wp_enqueue_style( 'bootstrap4-grid', get_template_directory_uri() . '/landing-page-catalogue/vendor/bootsrap4/css/bootstrap-grid.min.css', null );
        wp_enqueue_style( 'page-nos-formations', get_template_directory_uri() . '/css/page-nos-formations.css', array( 'main', 'references-style' ), null );
        wp_enqueue_style( 'taxonomy-thematiques', get_template_directory_uri() . '/css/taxonomy-thematiques.css', null );
        wp_enqueue_script( 'angular', get_stylesheet_directory_uri() . '/js/angular.min.js', null, null, false );
        wp_enqueue_script( 'angular-sanitize', get_stylesheet_directory_uri() . '/js/angular-sanitize.min.js', null, null, false );
        wp_enqueue_script( 'angular-animate', get_stylesheet_directory_uri() . '/js/angular-animate.min.js', null, null, false );
        wp_enqueue_script( 'angular-controller', get_stylesheet_directory_uri() . '/js/tpl-nos-formations.js', array( 'jquery', 'angular', 'angular-sanitize', 'angular-animate' ), null, false );
        wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.css', null, null, null );
        wp_enqueue_style( 'fullcalendar-print', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.print.css', array( 'fullcalendar' ), null, 'print' );
        wp_enqueue_style( 'calendar-style', get_stylesheet_directory_uri() . '/css/calendar.css', array( 'main' ), null );
        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/fullcalendar/lib/moment.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.min.js', array( 'moment' ), null, false );
        wp_enqueue_script( 'fullcalendar-fr', get_stylesheet_directory_uri() . '/js/fullcalendar/lang/fr.js', array( 'fullcalendar' ), null, false );        
        wp_enqueue_script( 'getCoursesByKeyword', get_stylesheet_directory_uri() . '/js/ajaxurl.js', array('jquery'), '1.0', true );
        wp_localize_script('getCoursesByKeyword', 'ajaxurl', admin_url( 'admin-ajax.php' ) );    
    }
}

/**
 * Chargement des styles et scripts pour les pages   'Une formation'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_singleFormation');
//Load scripts (and styles)
function custom_scripts_and_styles_singleFormation(){
    if(is_single()){ //Check if we are viewing an article

        wp_enqueue_style( 'formation-style', get_template_directory_uri() . '/css/single-formation.css', array( 'main' ), null );
        wp_enqueue_style( 'testimonial', get_template_directory_uri() . '/css/testimonial.css', array( 'main' ), null );
        wp_enqueue_script( 'toggable-tabs', get_stylesheet_directory_uri() . '/js/bootstrap-toggable-tabs.js', array( 'moment' ), null, false );
        wp_enqueue_script( 'toggable-tabs-init', get_stylesheet_directory_uri() . '/js/bootstrap-toggable-tabs-kz-init.js', array( 'toggable-tabs' ), null, false );
        wp_enqueue_style( 'custom_form_style', get_template_directory_uri() . '/css/form.css', array(), null );
        wp_enqueue_script( 'single-formation', get_stylesheet_directory_uri() . '/js/single-formation.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'accordeon', get_stylesheet_directory_uri() . '/js/accordeon.js', array( 'jquery' ), null, false );
        wp_enqueue_style( 'accordeon', get_template_directory_uri() . '/css/accordeon.css', array( 'main' ), null );
        // datepicker load
        wp_enqueue_style( 'datepicker-tiny', get_template_directory_uri() . '/css/tiny-date-picker.min.css', array( 'main' ), null );
        wp_enqueue_script( 'datepicker-tiny', get_stylesheet_directory_uri() . '/js/tiny-date-picker.min.js', array( 'jquery' ), null, false );
    }
}

/**
 * Chargement des styles et scripts pour la page   'Contact'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_contact');
//Load scripts (and styles)
function custom_scripts_and_styles_contact(){
    if(is_page()){ //Check if we are viewing a page
        global $wp_query;
        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if ( is_page( 'contact' ) ) {
            wp_enqueue_style( 'contact-style', get_template_directory_uri() . '/css/contact.css', null );
        }
    }
}
//Disabling Automatic Scrolling On All Forms
add_filter( 'gform_confirmation_anchor', '__return_false' );


/**
 * Chargement des styles et scripts pour les pages   'eGate SEO'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_egate', 9999 );
add_action( 'wp_head', 'custom_scripts_and_styles_egate', 9999 );
//Load scripts (and styles)
function custom_scripts_and_styles_egate(){
    if(is_page()){ //Check if we are viewing a page
        global $wp_query;
        //Check which template is assigned to current page we are looking at
        if( isset($wp_query->post->ID) ){
            $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        }else{
            $template_name = false;
        }
        if($template_name == 'tpl-egate.php'){
            wp_enqueue_style( 'egate-style', get_template_directory_uri() . '/css/egate.css', null );
            wp_enqueue_script( 'egate-script', get_stylesheet_directory_uri() . '/js/egate.js', array( 'jquery' ), null, false );
            wp_dequeue_script( 'formsubmission' );
            wp_dequeue_style( 'js_composer_front' ); //not working
            wp_dequeue_script( 'wpb_composer_front_js' ); //not working
            wp_dequeue_script( 'slick' );
            wp_dequeue_style( 'slick' );
        }
    }
}
/**
 * Chargement des styles et scripts pour la page   'Home'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_home');
//Load scripts (and styles)
function custom_scripts_and_styles_home(){
    if(is_page()){ 
        if(is_front_page()){
            wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home_style.css', array( 'main' ), null );
            wp_enqueue_style( 'testimonial', get_template_directory_uri() . '/css/testimonial.css', array( 'main' ), null );
            wp_enqueue_script( 'home-script', get_stylesheet_directory_uri() . '/js/home_script.js', array( 'jquery' ), null, false );
        }
    }
}

/**
 * Chargement des styles et scripts pour la page   'Nos solutions de formation'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_nos_solutions');
//Load scripts (and styles)
function custom_scripts_and_styles_nos_solutions(){
    if(is_page()){ //Check if we are viewing a page
        global $wp_query;
        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if($template_name == 'template-nos-solutions-de-formation.php'){
            wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home_style.css', array( 'main' ), null );
            wp_enqueue_script( 'home-script', get_stylesheet_directory_uri() . '/js/home_script.js', array( 'jquery' ), null, false );
            wp_enqueue_style( 'nos-solutions-style', get_template_directory_uri() . '/css/nos-solutions.css', array( 'home-style' ), null );
            wp_enqueue_style( 'testimonial', get_template_directory_uri() . '/css/testimonial.css', array( 'main' ), null );
            wp_enqueue_script( 'accordeon', get_stylesheet_directory_uri() . '/js/accordeon.js', array( 'jquery' ), null, false );
            wp_enqueue_style( 'accordeon', get_template_directory_uri() . '/css/accordeon.css', array( 'main' ), null );
        }
    }
}


/**
 * Chargement des styles et scripts pour la page /blog
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_blog_home');
//Load scripts (and styles)
function custom_scripts_and_styles_blog_home(){
    if(is_home()){
        wp_enqueue_style( 'blog-home-style', get_template_directory_uri() . '/css/blog-home.css', array( 'main' ), null );
    }
}

/**
 * Chargement des styles et scripts pour les pages Articles de blog
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_blog');
//Load scripts (and styles)
function custom_scripts_and_styles_blog(){
    if(is_single()){ //Check if we are viewing an article
        wp_enqueue_style( 'blog-style', get_template_directory_uri() . '/css/blog.css', array( 'main' ), null );
    }
}


/**
 * Chargement des styles et scripts pour la page Témoignages (archive)
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_testimonial');
//Load scripts (and styles)
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_testimonial');
//Load scripts (and styles)
function custom_scripts_and_styles_testimonial(){
    if(is_archive()){ //Check if we are viewing an archive page.
        if ( is_post_type_archive( 'temoignage' ) ) {
            wp_enqueue_style( 'chart', get_template_directory_uri() . '/css/chart.css', array( 'main' ), null );
            wp_enqueue_script( 'chart', get_stylesheet_directory_uri() . '/js/chart.js', array( 'owl-carousel', 'accordeon', 'jquery' ), null, false );
            wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array( 'main' ), null );
            wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), null, false );
            wp_enqueue_script( 'accordeon', get_stylesheet_directory_uri() . '/js/accordeon.js', array( 'jquery' ), null, false );
        }
    }
}


/**
 * Chargement des styles et scripts pour la page 'Nos formations'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_courses');
//Load scripts (and styles)
function custom_scripts_and_styles_courses(){
    global $wp_query;
    //Check which template is assigned to current page we are looking at
    if( isset($wp_query->post->ID) ){
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
    }else{
        $template_name = false;
    }
    if(($template_name == 'tpl-nos-formations.php')||(isCoursesListPage())){
        wp_enqueue_style( 'bootstrap4-grid', get_template_directory_uri() . '/landing-page-catalogue/vendor/bootsrap4/css/bootstrap-grid.min.css', null );
        wp_enqueue_style( 'page-nos-formations', get_template_directory_uri() . '/css/page-nos-formations.css', array( 'main', 'references-style' ), null );

        wp_enqueue_script( 'angular', get_stylesheet_directory_uri() . '/js/angular.min.js', null, null, false );
        wp_enqueue_script( 'angular-sanitize', get_stylesheet_directory_uri() . '/js/angular-sanitize.min.js', null, null, false );
        wp_enqueue_script( 'angular-animate', get_stylesheet_directory_uri() . '/js/angular-animate.min.js', null, null, false );
        wp_enqueue_script( 'angular-controller', get_stylesheet_directory_uri() . '/js/tpl-nos-formations.js', array( 'jquery', 'angular', 'angular-sanitize', 'angular-animate' ), null, false );

        wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.css', null, null, null );
        wp_enqueue_style( 'fullcalendar-print', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.print.css', array( 'fullcalendar' ), null, 'print' );
        wp_enqueue_style( 'calendar-style', get_stylesheet_directory_uri() . '/css/calendar.css', array( 'main' ), null );
        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/fullcalendar/lib/moment.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.min.js', array( 'moment' ), null, false );
        wp_enqueue_script( 'fullcalendar-fr', get_stylesheet_directory_uri() . '/js/fullcalendar/lang/fr.js', array( 'fullcalendar' ), null, false );        
    }
    wp_enqueue_script( 'getCoursesByKeyword', get_stylesheet_directory_uri() . '/js/ajaxurl.js', array('jquery'), '1.0', true );
    wp_localize_script('getCoursesByKeyword', 'ajaxurl', admin_url( 'admin-ajax.php' ) );    
}
// check whether we are on the page "/formations"  or not
function isCoursesListPage(){
    $a = get_link_by_slug('formations');
    $b = getCurrentPageURL();
    if($a == $b){ return true; }else{ 
        if(strpos($b, "https://www.digitalacademy.fr/formations/?thematique=") === 0) {  
            return true;
        }else if(strpos($b, "https://www.digitalacademy.fr/formations/?q=") === 0) {
            return true; 
        }else{
            return false; 
        }
    };
}
function get_link_by_slug($slug, $type = 'page'){
    $post = get_page_by_path($slug, OBJECT, $type);
    if($post == NULL){ return false; }else{
        return get_permalink($post->ID);
    }    
}
function getCurrentPageURL(){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
    else  
        $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
    return $url;  
}

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------

//---------------------------------------------------------------------------------
//---------------------------------------------------------------------------------



if ( ! function_exists( 'digitalacademy_setup' ) ) {
    function digitalacademy_setup() {
        load_theme_textdomain( 'digitalacademy', get_template_directory() . '/languages' );

        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 367, 183, true );

        add_image_size( 'header-formation', 270, 120, true );
        add_image_size( 'blog', 1230, 310, true );
        add_image_size( 'testimony', 100, 100, true );
        add_image_size( 'press', 120, 120, true );


        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'top'    => __( 'Top menu', 'digitalacademy' ),
            'bottom' => __( 'Bottom menu', 'digitalacademy' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );

        // This theme uses its own gallery styles.
        add_filter( 'use_default_gallery_style', '__return_false' );
    }
}
add_action( 'after_setup_theme', 'digitalacademy_setup' );


function digitalacademy_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer left', 'digitalacademy' ),
        'id'            => 'footer-1',
        'description'   => __( 'Footer sidebar that appears on the left.', 'digitalacademy' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer center', 'digitalacademy' ),
        'id'            => 'footer-2',
        'description'   => __( 'Footer sidebar that appears on the center.', 'digitalacademy' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Blog', 'digitalacademy' ),
        'id'            => 'blog',
        'description'   => __( 'Blog sidebar that appears on the right.', 'digitalacademy' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
}

add_action( 'widgets_init', 'digitalacademy_widgets_init' );

function digital_share_bouton( $link, $title ) {
?>

<div id="social-share">
    <a target="_blank" title="Twitter" class="share-tw"
       href="https://twitter.com/share?url=<?php echo urlencode( $link ); ?>&text=<?php echo urlencode( $title ); ?>&via=Digital_Ac"
       rel="nofollow"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700'); return false;">
        Twitter
    </a>
    <a target="_blank" title="Facebook" class="share-fb"
       href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( $link ); ?>&t=<?php echo urlencode( $title ); ?>"
       rel="nofollow"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700'); return false;">
        Facebook
    </a>
    <a target="_blank" title="linkedin" class="share-linkedin"
       href="https://www.linkedin.com/cws/share?url=<?php echo urlencode( $link ); ?>" rel="nofollow"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650'); return false;">
        LinkedIn
    </a>
    <a title="Email" class="share-email"
       href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $link; ?>" rel="nofollow">
        E-mail
    </a>
</div>

<?php
                                               }
function digital_get_thematiques_picto() {
    $pictos = false;

    if ( $thematiques = get_terms( 'thematique' ) ) {
        foreach ( $thematiques as $thematique ) {
            if ( $picto = get_field( 'picto', 'thematique_' . $thematique->term_id ) ) {
                $pictos[] = $picto;
            }
        }
    }
    return $pictos;
}

function digital_get_thematiques_menu( $term_id = false, $first = false ) {
    global $post;

    $current_page        = get_permalink( $post->ID );
    $page_nos_formations = get_field( 'page_nos_formations', 'option' );

    $current_thematique = isset( $_GET['thematique'] ) ? $_GET['thematique'] : null;

    $menu = '<ul>';

    if ( $current_page == $page_nos_formations ) {
        $menu .= '<li class="' . ( empty( $current_thematique ) ? "current-menu-item" : "" ) . '"><a href="' . $page_nos_formations . '">Toutes les formations</a></li>';
    } else {
        if ( $first ) {
            $menu .= '<li class="current-menu-item"><a href="' . get_field( 'page_thematiques', 'option' ) . '">Toutes les formations</a></li>';
        } else {
            $menu .= '<li><a href="' . get_field( 'page_thematiques', 'option' ) . '">Toutes les formations</a></li>';
        }
    }

    if ( $thematiques = get_terms( 'thematique' ) ) {
        foreach ( $thematiques as $thematique ) {
            // Default classes
            $classes = array();

            // Set color class
            $couleur = get_field( 'couleur', 'thematique_'.$thematique->term_id );
            if ( ! empty( $couleur ) ) {
                $classes[] = 'theme-'.$couleur;
            }

            // Set current menu item class
            if ( ( $term_id && $thematique->term_id == $term_id ) OR ( $current_thematique == $thematique->slug ) ) {
                $classes[] = 'current-menu-item';
            }

            // Implode built array classes for the current term
            $class = ! empty( $classes ) ? 'class="' . implode( ' ', $classes ) . '"' : '';

            $menu .= '<li ' . $class . '>';
            if ( $current_page == $page_nos_formations ) {
                $menu .= '<a href="' . $page_nos_formations . '?thematique=' . $thematique->slug . '">';
            } else {
                $menu .= '<a href="' . get_term_link( $thematique, 'thematique' ) . '">';
            }
            $menu .= $thematique->name . '</a></li>';
        }
    }
    $menu .= '</ul>';


    return $menu;
}

function digital_get_reference_menu( $term_id = false, $first = false ) {
    $current_term = get_queried_object();
    if ( empty( $current_term ) || $current_term->slug == 'digital-learning' ) {
        return '';
    }

    $type_url = get_term_link( $current_term );
    $class    = '/' . $current_term->taxonomy  . '/' . $current_term->slug . '/' === $_SERVER['REQUEST_URI'] ? ' class="btn btn-xs btn-red marginR"' : ' class="btn btn-xs btn-gray marginR" ';
    $menu     = '<ul>';
    $menu .= '<a ' . $class . 'href="' . esc_url( $type_url ) . '">Toutes les catégories</a>';

    $categories = get_terms( 'domaine', array( 'hide_empty' => false ) );

    if ( ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            $class = strpos( $_SERVER['REQUEST_URI'], $category->slug ) ? ' class="btn btn-xs btn-red marginR"' : ' class="btn btn-xs btn-gray marginR" ';
            $menu .= '<a ' . $class . ' href="' . esc_url( 'https://www.digitalacademy.fr/type/' . substr($current_term->slug,0,5) . '-' . $category->slug . '/') . '">';
            $menu .= esc_html( $category->name );
            $menu .= '</a>';
        }
    }
    $menu .= '</ul>';

    return $menu;
}

function digital_get_type_menu( $taxonomy = 'type' ) {
    $current_term   = get_queried_object();
    $parent_term_id = empty( $current_term->parent ) ? $current_term->term_id : $current_term->parent;
    $menu = '';

    if ( $types = get_terms( $taxonomy, array( 'parent' => 0 ) ) ) {
        foreach ( $types as $type ) {
            $class = '';
            if ( $type->term_id == $parent_term_id ) {
                $class = 'active';
            }
            $menu .= '<a href="' . get_term_link( $type, $taxonomy ) . '" class="btn btn-white ' . $class . '">' . $type->name . '</a>';
        }
    }

    return $menu;
}

add_action( 'pre_get_posts', 'dg_liste_references' );
function dg_liste_references( $query ) {
    if ( $query->is_tax( 'type' ) && $query->is_main_query() ) {
        $query->set( 'posts_per_page', - 1 );
        $query->set( 'post_type', 'reference' );
    }
}

add_action( 'pre_get_posts', 'dg_liste_temoignages' );
function dg_liste_temoignages( $query ) {
    if ( $query->is_post_type_archive( 'temoignage' ) && $query->is_main_query() ) {
        $query->set( 'posts_per_page', - 1 );
        $query->set( 'orderby', 'rand' );
    }
}

function digital_get_formation_dates( $formation_id ) {
    if ( $sessions = get_field( 'sessions', $formation_id ) ) {
        $dates = false;
        $i     = 0;
        foreach ( $sessions as $session ) {
            if ( $session['ouvert'] ) {
                $dates[ $i ]['url']          = get_the_permalink( $formation_id );
                $dates[ $i ]['date']         = $session['date_session'];
                $dates[ $i ]['nombre_jours'] = get_field( 'nombre_jours', $formation_id );
                $dates[ $i ]['lieu']         = $session['lieu_session'];
                $dates[ $i ]['titre']        = get_the_title( $formation_id );

                $i ++;
            }
        }

        return $dates;
    } else {
        return false;
    }
}

add_action( 'pre_get_posts', 'no_limit_archive' );
function no_limit_archive( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( array( 'formation' ) ) ) {
        $query->set( 'posts_per_page', - 1 );
    }
}


add_action( 'send_headers', 'tgm_io_strict_transport_security' );
/**
 * Enables the HTTP Strict Transport Security (HSTS) header.
 *
 * @since 1.0.0
*/
function tgm_io_strict_transport_security() {
    //header( 'Strict-Transport-Security: max-age=10886400; includeSubDomains; preload' );
    // DISABLED, this line cause an PHP warning: "Cannot modify header information - headers already sent by (output started at D:\www\local.digitalacademy.fr\wp-includes\functions.php:4196) in D:\www\local.digitalacademy.fr\wp-content\themes\digitalacademy\functions.php"
}


/* pour ne plus afficher automatiquement les liens vers flux */
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_footer', 'gdl_add_cufon', 10, 0);


add_filter( 'gform_init_scripts_footer', '__return_true' );
function init_scripts() {
    return true;
}

add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open' );
function wrap_gform_cdata_open( $content = '' ) {
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
    return $content;
}
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close' );
function wrap_gform_cdata_close( $content = '' ) {
    $content = ' }, false );';
    return $content;
}




// -----------------------------------------------------------------------
// FN: Custom walker for nav / multi level / CSS only
// -----------------------------------------------------------------------

class KZ_Walker_Digital_Top_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $output .= '<li>';
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        $submenus = 0 == $depth || 1 == $depth ? get_posts( array(
            'post_type'   => 'nav_menu_item',
            'numberposts' => 1,
            'meta_query'  => array(
                array(
                    'key'    => '_menu_item_menu_item_parent',
                    'value'  => $item->ID,
                    'fields' => 'ids'
                )
            )
        ) ) : false;
        $item_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<span class="drop-icon">-</span><label title="Toggle Drop-down" class="drop-icon" for="sm'. $item->ID .'">+</label></a><input type="checkbox" id="sm'. $item->ID .'">' : '' ) : '</a>';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



// -----------------------------------------------------------------------
// FN: SEARCH COURSES BY KEYWORDS (including ACF fields)
// (if keywords = " " the function return all courses)
// -----------------------------------------------------------------------

include_once(get_stylesheet_directory().'/inc/acf/custom-search.php');

function kz_search($keywords, $thema_ID = false){

    if(isset($_POST['keywords'])){
        $keywords = $_POST['keywords'];
    }
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'formation',
        'post_status'    => 'publish',
        's'              => $keywords
    );

    // Add thematique filter if is set
    if($thema_ID){
        $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'formation',
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'thematique',
                    'field'    => 'term_id',
                    'terms'    => $thema_ID,
                )
            )
        );
    }
    // The Query
    $ACF_query = new WP_Query( $args );

    /* Restore original Post Data */
    wp_reset_postdata();
    if ( has_post_thumbnail() ) {
        $class = '';
    }
    // pass paramaters
    $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
    if(isset($url_parameters[1])){
        $url_parameters = $url_parameters[1];
    }else{
        $url_parameters = '';
    }
    // get query string
    $search_query = isset($_GET['q']) ?  $_GET['q'] : null ;  // ...
    // ...
    $arr = array();
    $thema_arr = array();
    $formations = $ACF_query->posts;

    if ( $formations ) { 
        foreach ( $formations as $formation ) {
            // thematique(s)
            $terms = get_the_terms($formation->ID, 'thematique');        
            unset($course_thematique);
            $course_thematique[] = array();
            if( ( isset($terms) )&&( is_array($terms) ) ){
                foreach($terms as $i => $term) {
                    if( ( isset($terms[$i]->name) )&&( isset($terms[$i]->slug) ) ){
                        $course_thematique[] = array('name' => $terms[$i]->name, 'slug' => $terms[$i]->slug, 'color' => $terms[$i]->couleur);
                        // global thema array push if not dupply
                        $thema_arr[] = [ 
                            'slug' => $terms[$i]->slug,
                            'name' => $terms[$i]->name,
                            'color' => get_field( 'couleur', 'thematique_'. $terms[$i]->term_id )
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
            if ( get_field( 'tag_nouvelle_formation', $formation->ID ) ){
                // New Course ?
                $course_new = true;
            }else{
                $course_new = false;
            }
            if ( get_field( 'tag_top_formation', $formation->ID ) ){
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
                $course_description = wp_trim_words( get_field( 'presentation', $formation->ID ), 20, '...' );
            }else{
                $course_description = false;
            }
            // Course goals
            $course_goals = '';
            if ( get_field( 'intro_objectifs', $formation->ID ) )
                $course_goals .= get_field( 'intro_objectifs', $formation->ID );
            if ( get_field( 'objectifs_1', $formation->ID ) )
                $course_goals .= get_field( 'objectifs_1', $formation->ID );
            if ( get_field( 'objectifs_2', $formation->ID ) )
                $course_goals .= get_field( 'objectifs_2', $formation->ID );
            $course_goals = goalsClearTags($course_goals);
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
                'course_thema' => $course_thematique,
                'course_goals' => $course_goals
            ];
            //clear vars
            $course_link = $course_image = $course_new = $course_top = $course_title = $course_description = $next_session_place = $next_session_date = $next_session_link = $trainer_name = $trainer_image = $course_thematique = null;
        }
    }
    // response output
    $json_arr = json_encode($arr);
    $json_thema_arr = json_encode($thema_arr);

    // if keywords not set,  return full array of courses
    if ($keywords == " "){
        return array($json_arr, $json_thema_arr);
        // else, print courses
    }else{
        echo json_encode(array('courses'=>$arr,'thema_arr'=>$thema_arr));
    }
}

// CLean goals HTML tags
function goalsClearTags($goalsHTML){

    $goalsHTML_arr = explode("\n", $goalsHTML);
    $goalsHTML_arr_clean = array();

    foreach( $goalsHTML_arr as $goalsHTML_item ){

        $goalsHTML_item = str_replace("<p>", "", $goalsHTML_item);
        $goalsHTML_item = str_replace("</p>", "", $goalsHTML_item);

        $goalsHTML_item = str_replace("<strong>", "<li>", $goalsHTML_item);
        $goalsHTML_item = str_replace("</strong>", "</li>", $goalsHTML_item);

        if( substr( $goalsHTML_item, 0, 4 ) === "<li>" ){
            array_push($goalsHTML_arr_clean, $goalsHTML_item);
        }
    }

    return implode($goalsHTML_arr_clean);
}

add_action('wp_ajax_kz_search', 'kz_search');
add_action('wp_ajax_nopriv_kz_search', 'kz_search');



// -----------------------------------------------------------------------
// FN: Display Courses Slider
// -----------------------------------------------------------------------

function kz_shortcode_coursesSlider( $atts ) {   
    global $post;
    if(isset($post->ID)){
        $post_id = $post->ID;
    }else{
        $post_id = null;
    }


    wp_enqueue_script( 'slick-courses' );
    wp_enqueue_style( 'course-card');

    // get attributes
    $a = shortcode_atts( array(
        'type' => false,
        'nb'   => 8,
        'taxo' => false,
        'wrapper' => false,
        'bg' => true
    ), $atts );

    // slider 'Top Formations'
    if ( $a['taxo'] == 'top' ) {
        $args = array(
            'posts_per_page' => $a['nb'],
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
        // other sliders
    }else{
        $args = array(
            'post_type'      => 'formation',
            'post_status'    => 'publish',
            'posts_per_page' => $a['nb'],
            'post__not_in'   => array( $post_id ),
        );
    }
    if ( $a['taxo'] == 'formateur' ) {
        $args['tax_query']    = array(
            array(
                'taxonomy' => 'formateur',
                'terms'    => get_queried_object()->term_id,
                'field'    => 'term_id'
            )
        );
        $args['post__not_in'] = array();
    } elseif ( $a['taxo'] == 'thematique' ) {
        $thematiques       = get_the_terms( $post_id, 'thematique' );
        $id_terms          = wp_list_pluck( $thematiques, 'term_id' );
        $args['tax_query'] = array( array( 'taxonomy' => 'thematique', 'terms' => $id_terms, 'field' => 'term_id' ) );
    } else {
        $args['meta_query'] = array( array( 'key' => 'top_formation', 'value' => true, 'compare' => '=' ) );
    }
    if ( $a['wrapper'] ) {    
?><section id="top-formations" style="text-align:center;<?php if ( $a['bg'] ) {echo '#eee;';} ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br><br>
                <h3>Un catalogue de plus de 30 formations digitales</h3>
                <h2>Nos formations digitales</h2>
                <hr>
                <?php }

    $formations = get_posts( $args );
    if ( $formations ) { 
        $i=0; ?> 
                <div id="nos-formations">
                    <style>main .slick-list{overflow:hidden !important;}</style>
                    <div id="formations"> 
                        <?php foreach ( $formations as $formation ) { ?>
                        <div class="col-kard">
                            <div class="wrapper">
                                <!-- Image -->  
                                <?php if ( get_field( 'image_header_formation', $formation->ID ) ): ?>
                                <a href="<?php echo get_the_permalink( $formation->ID ); ?>">   
                                    <img src="<?php the_field( 'image_header_formation', $formation->ID ); ?>" alt="">
                                </a>
                                <?php endif; ?>
                                <div>
                                    <a href="<?php echo get_the_permalink( $formation->ID ); ?>">
                                        <h4><?php echo $formation->post_title; ?></h4>
                                    </a>  
                                    <?php if ( get_field( 'tag_nouvelle_formation', $formation->ID ) ): echo "<div class='nouvelle_formation'></div>" ?><?php endif; ?>
                                    <?php if ( get_field( 'tag_top_formation', $formation->ID ) ): echo "<div class='top_formation'></div>" ?><?php endif; ?>
                                    <?php // Course goals
                                                                     $course_goals = '';
                                                                     if ( get_field( 'intro_objectifs', $formation->ID ) )
                                                                         $course_goals .= get_field( 'intro_objectifs', $formation->ID );
                                                                     if ( get_field( 'objectifs_1', $formation->ID ) )
                                                                         $course_goals .= get_field( 'objectifs_1', $formation->ID );
                                                                     if ( get_field( 'objectifs_2', $formation->ID ) )
                                                                         $course_goals .= get_field( 'objectifs_2', $formation->ID );
                                                                     $course_goals = goalsClearTags($course_goals); ?>
                                    <div class="goals"><?php echo $course_goals; ?></div>
                                </div>
                                <a class="en-savoir-plus" href="<?php echo get_the_permalink( $formation->ID ); ?>">
                                    <div class="btn btn-xs btn-red margin0">En savoir plus</div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php  }

    if ( $a['wrapper'] ) {    
                ?>              <a id="allCourses" href="/formations/"><div class="btn btn-red">Découvrir toutes nos formations</div></a>
                <br><br><br>
            </div>
        </div>
    </div>
</section>
<?php }

}
add_shortcode( 'kz_courses_slider', 'kz_shortcode_coursesSlider' );
add_shortcode( 'formations_slider', 'kz_shortcode_coursesSlider' );


// -----------------------------------------------------------------------
// Shortcode: Get blog article associated courses
// -----------------------------------------------------------------------

function kz_shortcode_blogArticle_associatedCourses( $atts ) {  

    // get article id
    global $post;
    if(isset($post->ID)){
        $post_id = $post->ID;
    }else{
        $post_id = null;
    }

    // get associated categories slugs
    $post_categories = get_the_category($post_id);
    $categories_slugs = array();

    if ( ! empty( $post_categories ) ) {
        foreach( $post_categories as $post_category ){
            array_push($categories_slugs, $post_category -> slug);
        }
    }

    // get courses cards style
    wp_enqueue_style( 'course-card');

    // get courses by thema (if category slug == course thema : add them to array)
    $args = array(
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'post_type'      => 'formation',
        'tax_query'      => array(
            array(
                'taxonomy' => 'thematique',
                'field'    => 'slug',
                'terms'    => $categories_slugs,
            )
        )
    );
    $formations = get_posts( $args );

    // if there is no associated courses, randomize
    if( empty($formations) ){
        $args = array(
            'posts_per_page' => 2,
            'orderby' => 'rand',
            'post_type'      => 'formation'
        );
        $formations = get_posts( $args );
    }

    $out = '<div id="formations">';
    if ( $formations ) { 

        foreach ( $formations as $formation ) {

            // get data
            // ----------
            $img_src =  get_field( 'image_header_formation', $formation->ID ) ? get_field( 'image_header_formation', $formation->ID ) : "https://digitalacademy.fr/wp-content/themes/digitalacademy/images/blog-thumb-placeholder.jpg";
            $top =      get_field( 'tag_nouvelle_formation', $formation->ID ) ? '<div class="nouvelle_formation"></div>' : '';
            $new =      get_field( 'tag_top_formation', $formation->ID ) ? '<div class="top_formation"></div>' : '';
            $permalink = get_the_permalink( $formation->ID );
            $title = $formation->post_title ;
            $goals = '';
            if ( get_field( 'intro_objectifs', $formation->ID ) )
                $goals .= get_field( 'intro_objectifs', $formation->ID );
            if ( get_field( 'objectifs_1', $formation->ID ) )
                $goals .= get_field( 'objectifs_1', $formation->ID );
            if ( get_field( 'objectifs_2', $formation->ID ) )
                $goals .= get_field( 'objectifs_2', $formation->ID );
            $goals = goalsClearTags($goals); 

            // populate
            // ----------


            $out .= <<<EOF
            <div class="col-kard" style="margin:0!important;margin-bottom:2em!important;">
                 <div class="wrapper">
                     <a href="$permalink">   
                         <img src="$img_src" alt="">
                     </a>
                     <div>
                         <a href="$permalink">
                             <h4>$title</h4>
                         </a>  
                         $new
                         $top
                         <div class="goals">$goals</div>
                     </div>
                     <a class="en-savoir-plus" href="$permalink">
                         <div class="btn btn-xs btn-red margin0">En savoir plus</div>
                     </a>
                </div>
            </div>
            EOF;
        }
    }
    echo $out . "</div>";
}
add_shortcode( 'kz_shortcode_associatedCourses', 'kz_shortcode_blogArticle_associatedCourses' );



// -----------------------------------------------------------------------
// FN: Display Ref Slider
// -----------------------------------------------------------------------

function kz_shortcode_refSlider( $atts ) {


    wp_enqueue_script( 'slick-refs' );
    wp_enqueue_style( 'references-style');

    $a = shortcode_atts( array(
        'type' => false,
        'wrapper' => false,
        'bg' => false
    ), $atts );

    $args = array(
        'post_type'      => 'reference',
        'post_status'    => 'publish',
        'posts_per_page' => - 20,
    );
    if ( $a['type'] ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'reference',
                'terms'    => $a['type'],
                'field'    => 'slug'
            )
        );
    }
    if ( $a['wrapper'] ) {    
?><section id="references" <?php if ( $a['bg'] ) {echo 'style="background:#eee;"';} ?>>
    <div class="container" style="mix-blend-mode: multiply;">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <h3 style="margin-top: 106px;">Depuis 10 ans, la Digital Academy forme aux métiers du web</h3>
                <h2>Nos références clients en formation</h2>
                <hr> <?php
                         }
    $references = new WP_Query( $args );
    $refs = array();
    if ( $references->have_posts() ) {
        $out = '<div class="wrapper">';
        while ( $references->have_posts() ) {
            $references->the_post();
            $ref = [
                "url" => esc_url( get_field( 'url' ) ),
                "thumb" => get_the_post_thumbnail( get_the_ID() ),
            ];
            array_push($refs, $ref);
        }
        foreach ($refs as &$that_ref) {
            $out .= '<a class="ref" href="' . $that_ref['url'] . '">';
            $out .= $that_ref['thumb'];
            $out .= '</a>';
        }
        $out .= '</div>';
        echo $out;
    }
    if ( $a['wrapper'] ) {    
                ?><a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<style>.bg-gray, .bg-gray:before, .bg-gray:after {background: #f7f7f7;}</style><?php
    }
}
add_shortcode( 'kz_ref_slider', 'kz_shortcode_refSlider' );
add_shortcode( 'references_slider', 'kz_shortcode_refSlider' );


/* Push all js into the footer
--------------------------------------------------------------
*/
add_action( 'wp_enqueue_scripts', 'js_to_footer' );
function js_to_footer() {
    remove_action( 'wp_head', 'wp_print_scripts' );
    remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
    remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
}


///* formulaires
//--------------------------------------------------------------
//*/
// dequeue gravity form stylesheet for all forms
add_action( 'gform_enqueue_scripts', 'dequeue_gf_stylesheets', 11 );
function dequeue_gf_stylesheets() {
    wp_dequeue_style( 'gforms_reset_css' );
    wp_dequeue_style( 'gforms_datepicker_css' );
    wp_dequeue_style( 'gforms_formsmain_css' );
    wp_dequeue_style( 'gforms_ready_class_css' );
    wp_dequeue_style( 'gforms_browsers_css' );
}
// enqueue custom
add_action( 'gform_enqueue_scripts', 'enqueue_custom_form_script_and_style', 10, 2 );
function enqueue_custom_form_script_and_style( $form, $is_ajax ) {
    if ( $is_ajax ) {
        wp_enqueue_script( 'custom_form_script', get_stylesheet_directory_uri() . '/js/form.js', array( 'jquery' ), null, false );
        wp_enqueue_style( 'custom_form_style', get_template_directory_uri() . '/css/form.css', array(), null );
        wp_enqueue_script( 'button_anim', get_stylesheet_directory_uri() . '/js/button-anim.js', array( 'jquery' ), null, false );
        wp_enqueue_style( 'button_anim', get_template_directory_uri() . '/css/button-anim.css', array(), null );
    }
}
// custom spinner
add_filter("gform_ajax_spinner_url", "spinner_url", 10, 2);
function spinner_url($image_src, $form) {
    $spinnerPath = get_template_directory_uri() . '/images/spinner.gif';
    return $spinnerPath;
}

// -----------------------------------------------------------------------
// FN: Preinscription form heading
// -----------------------------------------------------------------------

function kz_shortcode_preInscrFormHeading( $atts ) {
    if ( isset($_GET["objet"]) ){
?><script>
    document.addEventListener("DOMContentLoaded", function() {
        if(jQuery('#courseTitle').length){}else{
            jQuery('#gform_1 .gform_body').before('<div id="courseTitle"><?php echo $_GET["objet"]; ?></i>');
            jQuery('#form-heading').hide();
        }
    });
</script>
<style>#form-heading, hr{display:none!important;}</style><?php
                                }
}
add_shortcode( 'kz_preInscrFormHeading', 'kz_shortcode_preInscrFormHeading' );


// -----------------------------------------------------------------------
// CLASS: Get thematiques data
// -----------------------------------------------------------------------
function kz_get_thema_data() {
    $th_list = array();
    if ( $thematiques = get_terms( 'thematique' ) ) {
        foreach ( $thematiques as $thematique ) {
            $th = array();
            $th["id"] = $thematique->term_id;
            $th["name"] = $thematique->name;
            $th["slug"] = $thematique->slug;
            $th["color"] = get_field('couleur', $thematique);
            $th["img"] = get_field('picto', $thematique);
            $th["url"] = site_url() . '/thematique-formation/' . $thematique->slug;
            array_push($th_list, $th);
        }
    }
    return($th_list);
}
class KzThema{

    function __construct($id = 0)
    {
        $this->themas = kz_get_thema_data();
        $this->id = $id;
        $this->slug = $this->getSlug();
        $this->name = $this->getName();
        $this->color = $this->getColor();
        $this->colorhex = $this->getColorHex();
        $this->image = $this->getImage();
        $this->url = $this->getUrl();
    }
    function getColor()
    {
        foreach( $this->themas as $key => $th ){
            if($th['id'] == $this->id){
                return $th['color'];
            }
        }
        return false;
    }
    function getName()
    {
        foreach( $this->themas as $key => $th ){
            if($th['id'] == $this->id){
                return $th['name'];
            }
        }
        return false;
    }
    function getSlug()
    {
        foreach( $this->themas as $key => $th ){
            if($th['id'] == $this->id){
                return $th['slug'];
            }
        }
        return false;
    }
    function getImage()
    {
        foreach( $this->themas as $key => $th ){
            if($th['id'] == $this->id){
                return $th['img'];
            }
        }
        return false;
    }
    function getUrl()
    {
        foreach( $this->themas as $key => $th ){
            if($th['id'] == $this->id){
                return $th['url'];
            }
        }
        return false;
    }
    function getColorHex()
    {
        foreach( $this->themas as $key => $th ){
            if($this->color == 'orange'){
                return "#e74c3c";
            }
            if($this->color == 'gray'){
                return "#95a5a6";
            }
            if($this->color == 'blue'){
                return "#3498db";
            }
            if($this->color == 'yellow'){
                return "#f59d00";
            }
            if($this->color == 'green'){
                return "#2ecc71";
            }
            if($this->color == 'blue-dark'){
                return "#34495e";
            }
        }
        return false;
    }
    function setColorHex()
    {
        foreach( $this->themas as $key => $th ){
            $this->color = $th['color'];
            $this->themas[$key]['colorhex'] = $this->getColorHex();
        }
    }
    function getData()
    {
        $this->setColorHex() ;
        return $this->themas ;
    }
}
// -----------------------------------------------------------------------
// -----------------------------------------------------------------------


