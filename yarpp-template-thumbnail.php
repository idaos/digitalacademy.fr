<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: Lucas Tesseron
*/ ?>
<style>
    h3{
        margin-top: 2em !important;
        margin-bottom: .5em!important;
        font-size: 1.5em !important;
        text-align: center;
        /*
        text-transform: uppercase !important;
        letter-spacing: 2px;
        opacity: .7;
        font-weight: 100!important;
        */
    }
    .blog .container-border {
        padding-bottom: 50px;
    }
    hr{
        margin: 0 auto;
        margin-bottom: 4em;
        width: 50% !important;
            max-width: 500px;
    }
    .blog [class^='col-']{
        padding-bottom: 1.7em;
    }
    .yarpp-related{
        padding: 3em 0;
        background: #f6f6f6;
        margin-bottom: 0 !important;
    }
    .content-white, .thewrapper{
        background: #fff !important;
    }
    .blog.container > .row{
        display: flex !important;
        flex-wrap: wrap !important;
    }
</style>



<h3>Articles similaires</h3>
<hr>
<div class="blog container">
    <div class="row">
        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
        <div class="col-lg-4 ">
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
                    <h2><a href="<?php the_permalink(); ?>"
                           rel="bookmark"><?php the_title(); ?></a></h2>

                    <p class="header-infos"><?php echo get_the_date(); ?>
                        | L'équipe DigitalAcademy<!--&reg;--></p>

                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn-orange" rel="nofollow">Lire
                        la suite</a>
                </div>
            </div>
        </div>
        <?php
        endwhile;
        endif;
        ?>
    </div>
</div>

