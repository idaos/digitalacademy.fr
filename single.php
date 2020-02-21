<?php get_header(); ?>

<div class="breadcrumb hidden-xs">
    <div class="container">			
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>		
    </div>
</div>
<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field( 'img_bandeau', get_the_ID() ) ?>)">
    <div class="slick-slide">
        <div class="clearfix">
            <p class="title-slider">Blog</p>
        </div>
        <p>
            Suivez l'actualité de la DigitalAcademy
        </p>
    </div>
</div>
<main class="content">
    <div class="container" style="padding-bottom:5em;">
        <div class="wrapper p5000">
            <div class="row clearfix stretch">
                <div class="container-blog col-md-8">
                    <div class="row clearfix">
                        <?php if ( have_posts() ) :	  while ( have_posts() ) : the_post(); ?>	
                        <header class="header-title clearfix">
                            <div class="left content-date">
                                <p class="month"><?php echo get_the_date( 'M' ); ?></p>
                                <p class="day"><?php echo get_the_date( 'd' ); ?></p>
                            </div>
                            <h1><?php the_title(); ?></h1>
                            <p><?php the_date(); ?> | <?php echo get_the_category_list( ', ' ); ?></p>
                        </header>
                        <div class="content-share">
                            <p style="margin-bottom: .3em;">Partager cet article</p>
                            <?php digital_share_bouton( get_the_permalink(), get_the_title() ); ?>	
                        </div>
                        <div class="content-main">	
                            <?php if( has_excerpt( $id ) ): ?>		
                            <h2 class="chapo"><?php the_excerpt(); ?></h2>
                            <?php endif; ?> 
                            <?php if( has_post_thumbnail() ): ?>	
                            <?php the_post_thumbnail( 'blog', array( 'class' => 'img-thumbnail' ) ); ?>										
                            <?php endif; ?> 
                            <?php the_content(); ?>									
                        </div>
                        <div class="article-categories">
                            Catégories : <?php echo get_the_category_list( ', ' ); ?>
                        </div>
                        <div class="content-author clearfix display-table">
                            <?php $author_id = get_the_author_meta('ID');										
                            if( get_field( 'avatar', 'user_'. $author_id ) ):	?>											
                            <img src="<?php the_field( 'avatar', 'user_'. $author_id ); ?>" alt="" />										
                            <?php endif; ?>
                            <p><strong><a href="https://digitalacademy.fr/digital-academy/qui-sommes-nous/" style="color:#000"><?php the_author(); ?></a></strong></p>
                        </div>
                        <?php endwhile; endif; ?>						
                    </div>
                </div>
                <?php $recentPosts = new WP_Query( array( 'showposts' => 2, 'post__not_in' => array($id) ) ); ?>
                <aside class="sidebar hidden-sm col-md-4">
                    <div style="margin-bottom:2em;margin-top:2em;">
                        <div class="thewrapper container-border">
                            <div class="offre-cta" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/Offre-de-formation-Digital-Academy.jpg')">
                                <p>Découvrez notre offre de formation</p>
                                <p>DigitalAcademy, l'institut de formation qui fait vivre le digital en entreprise</p>
                                <a class="btn btn-sm" style="line-height: 2.1em;" href="https://digitalacademy.fr/">Découvrir</a>
                            </div>
                        </div>
                    </div>
                    <h3 style="font-weight:normal;font-size:1.2em;">Derniers articles</h3>
                    <hr style="margin-bottom: 2em;width:80%!important;">
                    <?php
                    if ( $recentPosts->have_posts() ) :
                    while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                    ?>
                    <div style="margin-bottom:2em;">
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
                                <p class="last-article-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></p>
                                <p class="header-infos"><?php echo get_the_date(); ?> | <?php the_author(); ?></p>
                                <p class="p-cut-3"><?php the_excerpt(); ?></p>
                                <div class="button-wrapper">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-xs btn-red absolute100" rel="nofollow">Lire la suite</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    endif;
                    ?>
                </aside> 
            </div>
        </div>
    </div>
    <div class="thewrapper container-border visible-xs visible-sm">
        <div class="offre-cta" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/Offre-de-formation-Digital-Academy.jpg')">
            <p>Découvrez notre offre de formation</p>
            <p>DigitalAcademy, l'institut de formation qui fait vivre le digital en entreprise</p>
            <a class="btn btn-sm" style="line-height: 2.1em;" href="https://digitalacademy.fr/">Découvrir</a>
        </div>
    </div>
    <?php related_posts(); ?>		
    <div class="container">
        <div class="wrapper "> <?php get_template_part( 'tpl/cta', 'contact' ); ?> </div>
    </div>
</main>
<!-- Main end -->	
<section id="references">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br><br>
                <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-xs btn-red">Voir toutes nos références</div></a>
                <br><br><br>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>