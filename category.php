<?php get_header(); ?>

<div class="container-slider main-slider slider-header slider-formateur" style="background-image:url(<?php the_field('img_blog', 'option') ?>)">
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider">Blog / <?php echo single_cat_title( '', false ); ?></h1>
        </div>
        <div class="container">
            <p><?php echo category_description( '', false ); ?></p>
        </div>
    </div>
</div>
<main class="content">
    <div class="container">
        <div class="wrapper">
            <?php $introduction = get_field( 'texte_introduction', get_queried_object_id() );
            if( ! empty( $introduction ) ) : ?>
            <div class="full-width bg-gray fs20 p30 border-left-bold">
                <p><?php echo $introduction; ?></p>
            </div>
            <?php endif; ?>
            <div class="row clearfix p5000">
                <div class="col-xs-12 container-blog">
                    <div class="row display-flex clearfix">
                        <?php
                        if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                        ?>
                        <div class="col-sm-6 col-md-4" style="margin-bottom:2em;">
                            <div class="thewrapper bs br-3 container-border" style="max-height: 728px;">
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
                                        | <?php the_author(); ?></p>

                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        endif;
                        ?>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part( 'tpl/cta', 'contact' ); ?>
        </div>
    </div>
</main><!-- Main end -->
<?php get_footer(); ?>