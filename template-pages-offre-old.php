<?php
/*
Template Name: Page Offre Old
*/
get_header();
$class = 'nos-formations';
$bg = '';
if( has_post_thumbnail() ) {
    $class = '';
    $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center center"';
}
?>
<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
    </div>
</div>
<div class="container-slider main-slider slider-header <?php echo $class; ?>" <?php echo $bg; ?>>
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider"><?php the_title(); ?></h1>
        </div>
        <?php if( get_field( 'sous_titre' ) ): ?>
        <p><?php the_field( 'sous_titre' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<main class="content">
    <div class="container">
        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        the_content();
        endwhile;
        endif;
        ?>
    </div>
    <section id="references">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br><br>
                    <h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3>
                    <h2>Nos références clients en formation</h2>
                    <hr>
                    <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                    <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                    <br><br><br>
                </div>
            </div>
        </div>
    </section>
    <section id="slider-formations">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br>
                    <h3>Un catalogue de plus de 30 formations digitales</h3>
                    <h2>Nos formations digitales</h2>
                    <hr>
                    <?php echo do_shortcode( '[kz_courses_slider taxo="top"]' ); ?>
                    <a href="<?php echo get_page_link(318); ?>"><div class="btn btn-red">Découvrir toutes nos formations</div></a>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </section>

</main><!-- Main end -->



<?php get_footer(); ?>