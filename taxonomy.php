/**
*   Template Name: Nos formateurs
**/
<?php get_header(); ?>
<div class="breadcrumb hidden-xs">
	<div class="container">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
	</div>
</div>
<div class="container-slider main-slider slider-header slider-formateur hidden-xs">
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider">Nos formateurs</h1>
        </div>
        <p>Découvrez l'ensemble de nos formateurs DigitalAcademy©</p>
    </div>
</div>
<main class="content">
    <div class="container">
        <div class="wrapper p5000">
            <div class="row clearfix">
                <div class="col-sm-8 container-blog">
                    <div class="row clearfix">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                ?>
                                <div class="col-sm-6">
                                    <div class="container-border">
                                        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('post-thumbnails'); ?>
        <?php endif; ?>
                                        <div class="content-white">
                                            <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                            <p class="header-infos"><?php echo get_the_date(); ?> | <?php the_author(); ?></p>
                                            <p><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn-orange" rel="nofollow">Lire la suite</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
                <aside class="sidebar col-sm-4">
                <?php get_sidebar(); ?>
                </aside>
            </div>
            <?php get_template_part( 'tpl/cta', 'contact' ); ?>
        </div>
    </div>
</main><!-- Main end -->
<section id="references">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br><br>
                <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>