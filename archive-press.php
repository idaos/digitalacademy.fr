<?php get_header(); ?>
<style>
.vcenter {
    display: inline-block;
    vertical-align: middle;
    float: none;
}
</style>


<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
    </div>
</div>
<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field('img_dans_les_medias', 'option') ?>)">
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider">Dans les médias</h1>
        </div>
        <p>Découvrez comment la presse nous relaie régulièrement dans les médias offline</p>
    </div>
</div>
<main class="content" style="height:initial;background:#eee;">
    <div class="container">
        <div class="wrapper">
            <div class="full-width bg-gray fs20 p30 border-left-bold">
                <?php echo the_field('intro_dans_les_medias', 'options') ?>
            </div>


            <div class="p30">
                <div class="row">
                    <?php
    if ( have_posts() ) :
     // Start the Loop.
     while ( have_posts() ) : the_post();
     the_content();
                    ?>


                    <div class="container" style="margin:2em 0;background:#fff;border-left:solid 10px #be3929;">



                        <?php if( has_post_thumbnail() ): ?>
                        <div class="col-sm-2 vcenter" style="padding:1em;">
                            <?php the_post_thumbnail('press'); ?>
                        </div><!--
                        <?php endif; ?>
                        --><div class="col-sm-10 vcenter">
                            <h3 class="sub-title">
                                <?php if( get_field( 'url_media' ) ): ?>
                                <a href="<?php the_field('url_media'); ?>" target="_blank" style="color:#000;">
                                    <?php endif; ?>
                                    <?php if( get_field( 'source_media' ) ): ?>
                                    <strong><?php the_field('source_media'); ?></strong> -
                                    <?php endif; ?>            
                                    <?php the_title(); ?>
                                    <?php if( get_field( 'date_media' ) ): ?>
                                    - <?php the_field('date_media'); ?>
                                    <?php endif; ?>
                                    <?php if( get_field( 'url_media' ) ): ?>
                                </a>
                                <?php endif; ?>
                            </h3>
                        </div>


                    </div>


                    <?php
                    endwhile;
                    else :
                    // If no content, include the "No posts found" template.
                    get_template_part( 'content', 'none' );
                    endif;
                    ?>
                    <div class="col-sm-12">
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    </div>
                </div>
            </div>





        </div>
    </div>
</main><!-- Main end -->
<section id="references">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br>
                <h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3>
                <h2>Nos références clients en formation</h2>
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<div class="full-width bg-orange full-width-contact">
    <p class="clearfix"><span class="m-100">Découvrez la liste complète  de nos formations ?</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
</div>
<?php get_footer(); ?>