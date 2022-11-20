<?php

/**
 * Block Name: DAC - Slider des articles de blog
 *
 * This is the template that displays the block.
 */

wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), null, false);
wp_enqueue_style('swiper-js', get_template_directory_uri() . '/css/swiper-bundle.min.css', null);
?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Slider des articles de blog</h3>
    </div>

<?php else : ?>


    <div class="swiper blog-swiper">
        <div class="swiper-wrapper">

            <?php
            // the query
            $query = new WP_Query(array(
                'posts_per_page' => 9,
            ));
            ?>

            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="swiper-slide" style="margin-bottom:2em;">
                        <div class="thewrapper bs br-3 oh h-100 container-border">
                            <a href="<?php the_permalink(); ?>" rel="nofollow">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php $post_thumbnail_id = get_post_thumbnail_id($post); ?>
                                    <?php $post_thumbnail_url = wp_get_attachment_image_url($post_thumbnail_id, 'post-thumbnails'); ?>
                                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo $post_thumbnail_url ?>) ;"></div>
                                <?php else : ?>
                                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/blog-thumb-placeholder.jpg) ;"></div>
                                <?php endif; ?>
                            </a>
                            <div class="content-white p-1">
                                <div class="h2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                                <p class="header-infos"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?>
                                    | <?php the_author(); ?></a></p>

                                <p><a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            ?>

        </div>
    </div>
    <div class="swiper-pagination-blog container py-4"></div>

<?php endif; ?>