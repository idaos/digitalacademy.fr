<?php
/**
 *   Template Name: JSON Export Courses
 */

// -----------------------------------------------------------------------
// Conf
// -----------------------------------------------------------------------

$site_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '<br><br>';
$site_url = explode("?", $site_url);
$site_url = $site_url[0];
$wp_uploads_path = $site_url . "wp-content/uploads/";

// -----------------------------------------------------------------------
// Serialize PHP objects to XML
// -----------------------------------------------------------------------

class XMLSerializer {

    // functions adopted from http://www.sean-barton.co.uk/2009/03/turning-an-array-or-object-into-xml-using-php/

    public static function generateValidXmlFromObj(stdClass $obj, $node_block='course', $node_name='node') {
        $arr = get_object_vars($obj);
        return self::generateValidXmlFromArray($arr, $node_block, $node_name);
    }

    public static function generateValidXmlFromArray($array, $node_block='course', $node_name='node') {

        $xml = '';
        /*$xml = '<?xml version="1.0" encoding="UTF-8" ?>';*/

        $xml .= '<' . $node_block . '>';
        $xml .= self::generateXmlFromArray($array, $node_name);
        $xml .= '</' . $node_block . '>';

        return $xml;
    }

    private static function generateXmlFromArray($array, $node_name) {
        $xml = '';

        if (is_array($array) || is_object($array)) {
            foreach ($array as $key=>$value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }
                $xml .= '<' . $key . '>' . self::generateXmlFromArray($value, $node_name) . '</' . $key . '>';
            }
        } else {
            $xml = htmlspecialchars($array, ENT_QUOTES);
            //            $xml = $array;
        }

        return $xml;
    }
}

// -----------------------------------------------------------------------
// Clear HTML tags from string and output it into an array, each line is an entry
// -----------------------------------------------------------------------

function HTMLtagsCleanAndExptXML($str, $tag){
    $arr = explode("\n", $str);
    $out = array();

    foreach( $arr as $item ){

        $item = strip_tags($item);
        if($item != ''){
            array_push($out, $item);
        }
    }
    $out = implode('</' . $tag . '>' . PHP_EOL . '<' . $tag . '>', $out) ;
    $out = PHP_EOL . '<' . $tag . '>'. $out .'</' . $tag . '>' . PHP_EOL;
    return  $out;

}

// -----------------------------------------------------------------------
// FN: Return All Courses
// -----------------------------------------------------------------------

include_once(get_stylesheet_directory().'/inc/acf/custom-search.php');

function allCourses(){

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'formation',
        'post_status'    => 'publish'
    );
    // The Query
    $ACF_query = new WP_Query( $args );

    // clear original Post Data 
    wp_reset_postdata();
    if ( has_post_thumbnail() ) {
        $class = '';
    }
    // ...
    $arr = array();
    $thema_arr = array();
    $formations = $ACF_query->posts;

    if ( $formations ) { 
        foreach ( $formations as $formation ) {

            // Obsolete ?
            if ( get_field( 'obsolete', $formation->ID ) ){
                if ( get_field( 'obsolete', $formation->ID ) != null ){

                    //---------------------------------------------------------------------
                    // thematique(s)
                    //---------------------------------------------------------------------
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

                    //---------------------------------------------------------------------
                    // img header
                    //---------------------------------------------------------------------
                    if ( get_field( 'image_header_formation', $formation->ID ) ){
                        // Course Link
                        $course_link = get_the_permalink( $formation->ID );
                        // Course Image
                        $course_image = get_field( 'image_header_formation', $formation->ID );
                        // Fix image href for inDesign local img Import
                        global $wp_uploads_path;
                        $course_image = str_replace($wp_uploads_path, 'File:///img/', $course_image);
                    }

                    //---------------------------------------------------------------------
                    // tag_nouvelle_formation & tag_top_formation
                    //---------------------------------------------------------------------
                    //                if ( get_field( 'tag_nouvelle_formation', $formation->ID ) ){
                    //                    // New Course ?
                    //                    $course_new = true;
                    //                }else{
                    //                    $course_new = false;
                    //                }
                    //                if ( get_field( 'tag_top_formation', $formation->ID ) ){
                    //                    // Top Course ?
                    //                    $course_top = true;
                    //                }else{
                    //                    $course_top = false;
                    //                }

                    //---------------------------------------------------------------------
                    // Course Sessions
                    //---------------------------------------------------------------------
                    //                $session_arr = array();
                    //                if( have_rows('sessions', $formation->ID) ){    
                    //                    $row = 0;
                    //                    while ( have_rows('sessions', $formation->ID) ) { 
                    //                        the_row();
                    //                        $row +=1;
                    //                        $date_session = strtotime( get_sub_field( 'date_session' ) );
                    //                        if ( time() < $date_session ){
                    //                            // Session Place
                    //                            $session_place = get_sub_field('lieu_session');
                    //                            // Session Date
                    //                            $session_date = date_i18n( get_option( 'date_format' ), $date_session );
                    //                            // Session Link
                    //                            $session_link = get_the_permalink( $formation->ID ) ;
                    //                            $session_arr[] = [ 
                    //                                'place' => $session_place,
                    //                                'date' => $session_date,
                    //                                'link' => $session_link
                    //                            ];
                    //                        }
                    //                    };
                    //                }; 



                    //---------------------------------------------------------------------
                    // Trainers                                     
                    //---------------------------------------------------------------------
                    //                if ( $formateurs = wp_get_post_terms( $formation->ID, 'formateur' ) ){
                    //                    $j = 0; 
                    //                    foreach ( $formateurs as $formateur ){
                    //                        if($j==0){
                    //                            // Trainer picture
                    //                            $trainer_image = get_field( 'avatar', 'formateur_' . $formateur->term_id );
                    //                            // Trainer name
                    //                            $trainer_name = $formateur->name; 
                    //                        }
                    //                    }
                    //                    $j=+1;    
                    //                }

                    //---------------------------------------------------------------------
                    // Course Title
                    //---------------------------------------------------------------------
                    $course_title = get_the_title( $formation->ID );


                    //---------------------------------------------------------------------
                    // Course Reference
                    //---------------------------------------------------------------------
                    $course_id = $formation->ID;
                    $course_ref = '3120' . $course_id; 


                    //---------------------------------------------------------------------
                    // Course Presentation
                    //---------------------------------------------------------------------
                    $course_presentation = ( get_field( 'presentation', $formation->ID ) ) ? get_field( 'presentation', $formation->ID ) : false;
                    $presentation_arr = explode("\n", $course_presentation);
                    $presentation_arr_clean = array();

                    foreach( $presentation_arr as $presentation_item ){

                        $presentation_item = str_replace("<p>", PHP_EOL . "<presentation_item>" , $presentation_item);
                        $presentation_item = str_replace("</p>", "</presentation_item>", $presentation_item);

                        array_push($presentation_arr_clean, $presentation_item);
                    }
                    $course_presentation = implode($presentation_arr_clean) . PHP_EOL;

                    //---------------------------------------------------------------------
                    // Course Duration
                    //---------------------------------------------------------------------
                    $course_duration = ( get_field( 'duree', $formation->ID ) ) ? get_field( 'duree', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Size
                    //---------------------------------------------------------------------
                    $course_size = ( get_field( 'taille', $formation->ID ) ) ? get_field( 'taille', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Price
                    //---------------------------------------------------------------------
                    $course_price = ( get_field( 'prix', $formation->ID ) ) ? get_field( 'prix', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Place
                    //---------------------------------------------------------------------
                    $course_place = ( get_field( 'lieu', $formation->ID ) ) ? get_field( 'lieu', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Version
                    //---------------------------------------------------------------------
                    $course_version = ( get_field( 'version', $formation->ID ) ) ? get_field( 'version', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Methodology
                    //---------------------------------------------------------------------
                    $course_methodology = ( get_field( 'methodologie', $formation->ID ) ) ? get_field( 'methodologie', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course Evaluation
                    //---------------------------------------------------------------------
                    $course_evaluation = ( get_field( 'evaluation', $formation->ID ) ) ? get_field( 'evaluation', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course trainer trainer
                    //---------------------------------------------------------------------
                    $course_trainer = ( get_field( 'formateur_descr', $formation->ID ) ) ? get_field( 'formateur_descr', $formation->ID ) : false;


                    //---------------------------------------------------------------------
                    // Course trainer prerequisite
                    //---------------------------------------------------------------------
                    $course_prerequisite = ( get_field( 'prerequis_formation', $formation->ID ) ) ? get_field( 'prerequis_formation', $formation->ID ) : false;
                    $course_prerequisite = HTMLtagsCleanAndExptXML($course_prerequisite, 'prerequisite_item');


                    //---------------------------------------------------------------------
                    // Course trainer public
                    //---------------------------------------------------------------------
                    $course_public = ( get_field( 'pour_qui', $formation->ID ) ) ? get_field( 'pour_qui', $formation->ID ) : false;
                    $course_public = HTMLtagsCleanAndExptXML($course_public, 'public_item');


                    //---------------------------------------------------------------------
                    // Course program
                    //---------------------------------------------------------------------
                    $course_program = '';
                    $course_program .= ( get_field( 'programme_1', $formation->ID ) ) ? get_field( 'programme_1', $formation->ID ) : false;
                    $course_program .= ( get_field( 'programme_2', $formation->ID ) ) ? get_field( 'programme_2', $formation->ID ) : false;
                    $course_program .= ( get_field( 'programme_3', $formation->ID ) ) ? get_field( 'programme_3', $formation->ID ) : false;

                    $programme_arr = explode("\n", $course_program);
                    $program_arr_clean = array();

                    foreach( $programme_arr as $program_item ){

                        $program_item = str_replace("<p><span style=\"font-weight: 400;\">", PHP_EOL . "<program_item>", $program_item);
                        $program_item = str_replace("</span></p>", "</program_item>", $program_item);

                        $program_item = str_replace("<span style=\"font-weight: 400;\">", "", $program_item);
                        $program_item = str_replace("</span>", "", $program_item);

                        $program_item = str_replace("<p><strong>", PHP_EOL . "<program_title>", $program_item);
                        $program_item = str_replace("</strong></p>", "</program_title>", $program_item);

                        $program_item = str_replace("<p><em>", PHP_EOL . "<program_highlight>", $program_item);
                        $program_item = str_replace("</em></p>", "</program_highlight>", $program_item);

                        $program_item = str_replace("<p>", PHP_EOL . "<program_item>", $program_item);
                        $program_item = str_replace("</p>", "</program_item>", $program_item);

                        $program_item = str_replace("<li>", PHP_EOL . "<program_item>", $program_item);
                        $program_item = str_replace("</li>", "</program_item>", $program_item);

                        $program_item = str_replace("<i>", "", $program_item);
                        $program_item = str_replace("</i>", "", $program_item);

                        $program_item = str_replace(PHP_EOL . "<program_item>&nbsp;</program_item>", "", $program_item);

                        if(( $program_item != "</span></p>" ) && ( $program_item != "" ) && ( $program_item != "<ul>" ) && ( $program_item != "</ul>" ) && ( $program_item != "<li>&nbsp;</li>" ) && ( $program_item != PHP_EOL . "<program_item>&nbsp;</program_item>" )){
                            array_push($program_arr_clean, $program_item);
                        }
                    }
                    $course_program = implode($program_arr_clean) . PHP_EOL;


                    //---------------------------------------------------------------------
                    // Course goals
                    //---------------------------------------------------------------------
                    $course_goals = '';
                    $course_goals .= ( get_field( 'objectifs_1', $formation->ID ) ) ? get_field( 'objectifs_1', $formation->ID ) : false;
                    $course_goals .= ( get_field( 'objectifs_2', $formation->ID ) ) ? get_field( 'objectifs_2', $formation->ID ) : false;
                    $course_goals .= ( get_field( 'objectifs_3', $formation->ID ) ) ? get_field( 'objectifs_3', $formation->ID ) : false;
                    $course_goals = HTMLtagsCleanAndExptXML($course_goals, 'goal');



                    //---------------------------------------------------------------------

                    //---------------------------------------------------------------------
                    // Build array
                    //---------------------------------------------------------------------
                    $obj = (object) [
                        'title' => $course_title, 
                        'image' => $course_image, 
                        'goals' => $course_goals, 
                        'trainer' => $course_trainer, 
                        'presentation' => $course_presentation, 
                        'program' => $course_program, 
                        'version' => $course_version, 
                        'reference' => $course_ref, 
                        'place' => $course_place, 
                        'duration' => $course_duration, 
                        'size' => $course_size, 
                        'price' => $course_price, 
                        'prerequisite' => $course_prerequisite, 
                        'public' => $course_public, 
                        'methodology' => $course_methodology, 
                        'evaluation' => $course_evaluation, 
                        'thema' => str_replace('&', 'zk_Amp', $course_thematique[0]['name']),
                        'link' => $course_link,
                        //                'id' => $formation->ID, 
                        //                'course_new' => $course_new, 
                        //                'course_top' => $course_top, 
                        //                'course_sessions' => $session_arr,
                        //                'trainer_name' => $trainer_name, 
                        //                'trainer_image' => $trainer_image,
                    ];
                    array_push($arr, $obj);
                    //clear vars
                    $course_goals = $course_public = $course_prerequisite = $course_program = $course_trainer = $course_evaluation = $course_methodology = $course_version = $course_place = $course_price = $course_size = $course_ref = $course_duration = $course_link = $course_image = $course_new = $course_top = $course_title = $course_presentation = $next_session_place = $next_session_date = $next_session_link = $trainer_name = $trainer_image = $course_thematique = null;
                }
            } // endif obsolete
        } // endif obsolete
    }
    // response output
    // var_dump($arr);
    return array($arr);
}




//---------------------------------------------------------------------
// Output XML
//---------------------------------------------------------------------


// Get array of Courses
$courses = allCourses();

// generate XML from array of objects
$xml = '<root>';
foreach( $courses[0] as $course ){

    $xml_generater = new XMLSerializer; 
    $std_class = json_decode(json_encode($course)); 
    $xml .= $xml_generater->generateValidXmlFromObj($std_class);
}
$xml .= '</root>';


// Fix image tag for inDesign local img Import
$xml = str_replace('<image>', '<image href="', $xml); 
$xml = str_replace('</image>', '"></image>', $xml); 

// Remove empty program line
$xml = str_replace('<program_item>&nbsp;</program_item>', '', $xml); 

// fix special char
$xml = str_replace('&amp;', '&', $xml); 
$xml = str_replace('&rsquo;', '\'', $xml); 
$xml = str_replace('&nbsp;', ' ', $xml); 
$xml = str_replace('zk_Amp', '&amp;', $xml); 



// Indent and output XML to File
$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
//$dom->formatOutput = false;
$dom->loadXML($xml);
$out = $dom->saveXML();
$out = html_entity_decode ($out);

// remove indentation
$out = str_replace('  ', '', $out);
// remove document declaration
$out = str_replace('<?xml version="1.0"?>', '', $out); 
// remove empty lines
$out = implode("\n", array_filter(explode("\n", $out)));

print_R($out);



// dl xml
//header("Content-type: text/plain");
//header("Content-Disposition: attachment; filename=courses.xml");
//echo $out;



