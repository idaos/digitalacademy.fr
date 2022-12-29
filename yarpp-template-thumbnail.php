<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: Lucas Tesseron
*/ ?>
<style>
    h3{
        margin-top: 1em !important;
        margin-bottom: 1em!important;
        font-size: 1.5em !important;
        text-align: center !important;
        color: #bf3b2b !important;
        text-transform: initial !important;
        font-weight: bold !important;
        font-style: normal !important;
    }
    .blog .container-border {
        padding-bottom: 50px;
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
    @media (max-width:1200px) and (min-width:692px) {
        .yarpp-related [class^='col-']:last-child{
            display: none;
        }
    }
</style>



<h3>Nos articles similaires</h3>
    <div class="blog container">
    <div class="row">
        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="thewrapper bs br-3 container-border" style="padding-bottom:0">
                <a href="<?php the_permalink(); ?>" rel="nofollow">
                    <?php if ( has_post_thumbnail() ): ?>
                    <?php $post_thumbnail_id = get_post_thumbnail_id( $post ); ?>
                    <?php $post_thumbnail_url = wp_get_attachment_image_url( $post_thumbnail_id, 'post-thumbnails' ); ?>

                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo $post_thumbnail_url ?>) ;"></div>
                    <?php else : ?>
                    <div class="blog-thumb-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/blog-thumb-placeholder.jpg) ;"></div>
                    <?php endif; ?>
                </a>
                <div class="content-white" style="padding-bottom:0">
                    <h2><a href="<?php the_permalink(); ?>"
                           rel="bookmark"><?php the_title(); ?></a></h2>

                    <p class="header-infos"><?php echo get_the_date(); ?>
                        | L'équipe DigitalAcademy<!--&reg;--></p>

                    <p><?php the_excerpt(); ?></p>
                </div>
            </div>
        </div>
        <?php
        endwhile;
        endif;
        ?>
    </div>
    <div class="row">
        <a href="/blog" class="btn" style="margin:auto ;">Voir toutes nos actualités</a>
    </div>
</div>

