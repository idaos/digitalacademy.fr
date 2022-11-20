<?php

/**
 * Block Name: DAC - Slider des formations
 *
 * This is the template that displays the block.
 */

wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), null, false);
wp_enqueue_style('swiper-js', get_template_directory_uri() . '/css/swiper-bundle.min.css', null);


global $post;
if (isset($post->ID)) $post_id = $post->ID;
else $post_id = null;

// get attributes
$a = shortcode_atts(array(
    'type' => false,
    'nb'   => 8,
    'taxo' => false,
), $atts);

// slider 'Top Formations'
// if ($a['taxo'] == 'top') {
$args = array(
    'posts_per_page' => $a['nb'],
    'post_type'      => 'formation',
    'post_status'    => 'publish',
    'meta_key'       => 'position_formation',
    'orderby'        => 'meta_value_num',
    'order'             => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'top_formation',
            'value'   => true,
            'compare' => '=',
        )
    )
);
//     // other sliders
// } else {
//     $args = array(
//         'post_type'      => 'formation',
//         'post_status'    => 'publish',
//         'posts_per_page' => $a['nb'],
//         'post__not_in'   => array($post_id),
//     );
// }
// if ($a['taxo'] == 'thematique') {
//     $thematiques       = get_the_terms($post_id, 'thematique');
//     $id_terms          = wp_list_pluck($thematiques, 'term_id');
//     $thColor           = new KzThema($id_terms);
//     $thColor           = $thColor->getColor();
//     $args['tax_query'] = array(array('taxonomy' => 'thematique', 'terms' => $id_terms, 'field' => 'term_id'));
// } else {
//     $args['meta_query'] = array(array('key' => 'top_formation', 'value' => true, 'compare' => '='));
// }

$formations = get_posts($args);

if(!function_exists('getNextSession')){
function getNextSession($sessions)
{
    if (!isset($sessions) || count($sessions) === 0) return '';
    $now = new DateTime("now");
    $date_buffer = $now;
    $ts_buffer = $now->getTimestamp();
    foreach ($sessions as $session) {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $session['date_session']);
        if ($date < $now) continue; // ignor past events
        $ts_interval = $date->getTimestamp() - $now->getTimestamp();
        if ($ts_interval < $ts_buffer) {
            $ts_buffer = $ts_interval;
            $date_buffer = $session['date_session'];
        }
    }
    if (is_string($date_buffer)) {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $date_buffer);
        return '<span class="next-session btn btn-red-alt btn-xs">PROCHAINE SESSION : ' . $date->format('d/m/Y') . '</span>';
    } else {
        return '';
    }
}
}

?>


<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Slider des formations</h3>
    </div>

<?php else : ?>


    <div class="swiper courses-swiper">
        <div class="swiper-wrapper">
            <?php foreach ($formations as $formation) :
                $acf_fields = get_fields($formation->ID);
            ?>
                <a class="swiper-slide" href="<?php echo get_the_permalink($formation->ID); ?>">
                    <div class="card">
                        <!-- Image -->
                        <?php if (get_field('visuel_presentation', $formation->ID)) : ?>
                            <img src="<?php the_field('visuel_presentation', $formation->ID); ?>" alt="">
                        <?php endif; ?>
                        <div>

                            <!-- Title -->
                            <h4 class="px-2"><?php echo $formation->post_title; ?></h4>

                            <div class="tags px-2">
                                <!-- Tag top formation -->
                                <div>
                                    <?php if (get_field('tag_nouvelle_formation', $formation->ID)) {
                                        echo "<div class='nouvelle_formation btn btn-red btn-xs'>nouvelle_formation</div>" ?><?php } ?>
                                    <?php if ((get_field('tag_top_formation', $formation->ID)) || get_field('top_formation', $formation->ID)) {
                                        echo "<div class='top_formation btn btn-red btn-xs'>Top formation</div>" ?><?php }; ?>
                                </div>
                                <!-- Prochaine session -->
                                <div>
                                    <?php echo getNextSession($acf_fields['sessions']); ?>
                                </div>
                            </div>
                            <div class="px-2 bb-r">
                                <div class="fs-xs">
                                    <div class="ico"></div>
                                    <span><?php echo $acf_fields['texte_duree']; ?></span>
                                </div>
                                <div class="fs-xs">
                                    <div class="ico"></div>
                                    <span><?php echo $acf_fields['texte_tarif']; ?></span>
                                </div>
                                <div class="fs-xs">
                                    <div class="ico"></div>
                                    <span>présentiel ou distanciel</span>
                                </div>
                            </div>

                            <!-- Objectifs -->
                            <?php
                            $course_goals = '';
                            if (get_field('intro_objectifs', $formation->ID))
                                $course_goals .= get_field('intro_objectifs', $formation->ID);
                            if (get_field('objectifs_1', $formation->ID))
                                $course_goals .= get_field('objectifs_1', $formation->ID);
                            if (get_field('objectifs_2', $formation->ID))
                                $course_goals .= get_field('objectifs_2', $formation->ID);
                            $course_goals = goalsClearTags($course_goals); ?>
                            <div class="goals px-2"><?php echo $course_goals; ?></div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="swiper-pagination swiper-pagination-courses container py-4"></div>

<?php endif; ?>