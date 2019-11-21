<?php get_header(); ?>



<div class="breadcrumb hidden-xs">

    <div class="container">

        <?php

        if (function_exists('yoast_breadcrumb')) {

            yoast_breadcrumb();

        }

        ?>

    </div>

</div>



<div class="container-slider main-slider nos-formations slider-header hidden-xs" style="background-image:url(<?php the_field('img_recherche', 'option') ?>)">

    <div class="slick-slide">

        <div class="clearfix">

            <h1 class="title-slider"><?php printf('Résultats de recherche pour "%s"', get_search_query()); ?></h1>

        </div>

    </div>

</div>



<main class="content">

    <div class="container">



        <div class="wrapper">



            <div class="p30">

                <h2 class="text-center">Recherche</h2>

                <div class="row clearfix p015">

                    <?php

                    global $wp_query;

                    if ($wp_query->found_posts > 0) :

                        // Start the Loop.

                        while (have_posts()) : the_post();

                    

                    		$post_type = get_post_type( get_the_ID() );

                    

                    		if ($post_type == "formations") continue;

                    

                            ?>



                            <div class="border-block">

                                <div class="container-business-case bg-gray-light search__content">

                                    <div class="clearfix row-height">

                                        <?php if (has_post_thumbnail()): ?>

                                            <?php the_post_thumbnail(); ?>

                                        <?php endif; ?>

                                        <div class="">

                                            <h3 class="sub-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>

                                            <?php the_excerpt(); ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php

                        endwhile;

                    else :

                        // If no content, include the "No posts found" template.

                        //get_template_part( 'content', 'none' );

                        echo '<p style="text-align:center">Aucun résultat pour cette recherche</p>';

                    endif;

                    ?>

                    <div class="col-sm-12">

                        <?php wpbeginner_numeric_posts_nav(); ?>

                    </div>

                </div>

            </div>

        </div>



        <div class="full-width bg-orange full-width-contact">

            <p class="clearfix"><span class="m-100">Découvrez la liste complète  de nos formations ?</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</De></a></p>

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