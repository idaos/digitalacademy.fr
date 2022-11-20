<?php

/**
 * Block Name: DAC - Slider des références clients
 *
 * This is the template that displays the block.
 */

wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), null, false);
wp_enqueue_style('swiper-js', get_template_directory_uri() . '/css/swiper-bundle.min.css', null);
?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Slider des références clients</h3>
    </div>

<?php else : ?>

    <?php
    $args = array(
        'post_type'      => 'reference',
        'post_status'    => 'publish',
        'posts_per_page' => -20
    );
    $references = new WP_Query($args);
    $refs = array();
    if ($references->have_posts()) {
        $out = '<div class="swiper clients-swiper"><div class="swiper-wrapper">';
        while ($references->have_posts()) {
            $references->the_post();
            $ref = [
                "url" => esc_url(get_field('url')),
                "thumb" => get_the_post_thumbnail(get_the_ID()),
            ];
            array_push($refs, $ref);
        }
        foreach ($refs as &$that_ref) {
            $out .= '<div class="swiper-slide">';
            $out .= $that_ref['thumb'];
            $out .= '</div>';
        }
        $out .= '</div></div><div class="swiper-pagination-clients container py-4"></div>';
        echo $out;
    }
    ?>

<?php endif; ?>