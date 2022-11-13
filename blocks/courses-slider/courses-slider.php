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
        return '<span>PROCHAINE SESSION :<br>' . $date->format('d/m/Y') . '</span>';
    } else {
        return '';
    }
}

?>

<div class="swiper courses-swiper">
    <div class="swiper-wrapper">
        <?php foreach ($formations as $formation) :
            $acf_fields = get_fields($formation->ID);
        ?>
            <div class="swiper-slide ">
                <div class="card">
                    <!-- Image -->
                    <?php if (get_field('visuel_presentation', $formation->ID)) : ?>
                        <a href="<?php echo get_the_permalink($formation->ID); ?>">
                            <img src="<?php the_field('visuel_presentation', $formation->ID); ?>" alt="">
                        </a>
                    <?php endif; ?>
                    <div class="txt-content">
                        <!-- Title -->
                        <a href="<?php echo get_the_permalink($formation->ID); ?>">
                            <h4><?php echo $formation->post_title; ?></h4>
                        </a>


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 p-0">
                                    <?php if (get_field('tag_nouvelle_formation', $formation->ID)) {
                                        echo "<div class='nouvelle_formation btn btn-red btn-xs'>nouvelle_formation</div>" ?><?php } ?>
                                    <?php if (get_field('tag_top_formation', $formation->ID)) {
                                        echo "<div class='top_formation btn btn-red btn-xs'>Top formation</div>" ?><?php }; ?>
                                </div>
                                <div class="col-xs-6 p-0">
                                    <?php echo getNextSession($acf_fields['sessions']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-4 fs-xs">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-formation/ico-clock.jpg" alt="" class="multiply ico">
                                    <span><?php echo $acf_fields['texte_duree']; ?></span>
                                </div>
                                <div class="col-xs-4 fs-xs">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-formation/ico-coins.jpg" alt="" class="multiply ico">
                                    <span><?php echo $acf_fields['texte_tarif']; ?></span>
                                </div>
                                <div class="col-xs-4 fs-xs">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/single-formation/ico-pin.jpg" alt="" class="multiply ico">
                                    <span>Présentiel ou distanciel (Visio)</span>
                                </div>
                            </div>
                        </div>

                        <?php // Course goals
                        $course_goals = '';
                        if (get_field('intro_objectifs', $formation->ID))
                            $course_goals .= get_field('intro_objectifs', $formation->ID);
                        if (get_field('objectifs_1', $formation->ID))
                            $course_goals .= get_field('objectifs_1', $formation->ID);
                        if (get_field('objectifs_2', $formation->ID))
                            $course_goals .= get_field('objectifs_2', $formation->ID);
                        $course_goals = goalsClearTags($course_goals); ?>
                        <div class="goals"><?php echo $course_goals; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="swiper-pagination container py-4"></div>

<script>
    window.addEventListener('DOMContentLoaded', () => {

        var swiper = new Swiper(".courses-swiper", {
            slidesPerView: 3,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
        });
    })
</script>