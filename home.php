<?php get_header(); ?>
<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
    </div>
</div>
<div class="header" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/blog.jpg);">    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<h1 class="title-slider" style="color:#fff">Blog</h1>
				<hr>
				<p><?php the_field( 'sous_titre', get_queried_object_id() ); ?></p>
			</div>
		</div>
	</div>
</div>
<div class="svg-wrapper-bottom">
	<svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#fff" points="0,0 0,100 40,40"></polygon>
	</svg>
	<svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
	</svg>
	<svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#f6f6f6" points="0,0 100,100 0,100"></polygon>
	</svg>
</div>    
<main class="content" style="background:#f6f6f6!important;margin-top:-2vw">
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
                                        | <?php the_author(); ?></p>

                                    <p><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-xs btn-red absolute100" rel="nofollow">Lire
                                        la suite</a>
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