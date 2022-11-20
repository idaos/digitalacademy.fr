<?php

/**
 * Block Name: DAC - Slider des OPCOs partenaires
 *
 * This is the template that displays the block.
 */

wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), null, false);
wp_enqueue_style('swiper-js', get_template_directory_uri() . '/css/swiper-bundle.min.css', null);
?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Slider des OPCOs partenaires</h3>
    </div>

<?php else : ?>

    <?php

    $args = array(
        'post_type'      => 'OPCO',
        'post_status'    => 'publish',
        'posts_per_page' => -20
    );

    $opcos = new WP_Query($args);
    $opcos_arr = array();
    if ($opcos->have_posts()) {
        $out = '<div class="swiper opcos-swiper"><div class="swiper-wrapper">';
        while ($opcos->have_posts()) {
            $opcos->the_post();
            $opco = [
                "thumb" => get_the_post_thumbnail(get_the_ID()),
            ];
            array_push($opcos_arr, $opco);
        }
        foreach ($opcos_arr as &$that_opco) {
            $out .= '<div class="swiper-slide">';
            $out .= $that_opco['thumb'];
            $out .= '</div>';
        }
        $out .= '</div></div><div class="swiper-pagination-opcos container py-4"></div>';
        echo $out;
    }
    ?>

<?php endif; ?>