<?php get_header(); ?>

<div class="header" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/blog.jpg);">    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<h1 class="title-slider" style="color:#fff"><?php the_title(); ?></h1>
				<hr>
				<p>
				Publié le <time class="updated entry-time" datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_date(); ?></time>
				&nbsp;|&nbsp; 
				<?php if (function_exists('wp_time_to_read')) { wp_time_to_read(); } ?>
                <?php // echo get_the_category_list( ', ' ); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="svg-wrapper-bottom">
	<svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#eee" points="0,0 0,100 40,40"></polygon>
	</svg>
	<svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
	</svg>
	<svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#fff" points="0,0 100,100 0,100"></polygon>
	</svg>
</div>    
<main class="content" style="margin-top:-4vw;z-index:5;background:none;">
    <div class="container" style="padding-bottom:2em;">
        <div class="wrapper p5000" style="background:rgba(0,0,0,0)">
            <div class="row clearfix stretch">
                <div class="container-blog col-md-8">
                    <div class="row clearfix">
                        <?php if ( have_posts() ) :	  while ( have_posts() ) : the_post(); ?>	
                        <div class="content-share">
                            <p>Partager cet article :</p>
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
                            Retrouvez nos articles classés dans la thématique <?php echo get_the_category_list( ', ' ); ?>
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
                                <a class="btn btn-sm" style="line-height: 2.1em;" href="/solutions">Découvrir</a>
                            </div>
                        </div>
                    </div>
                    <h3 style="font-weight:normal;font-size:1.2em;">Nos formations</h3>
                    <hr style="margin-bottom: 2em;width:80%!important;">
                    <?php echo do_shortcode( '[kz_shortcode_associatedCourses]' ); ?>
                     <a class="btn btn-sm btn-red-alt" style="margin:auto;margin: auto;display: flow-root;max-width: 19em;" href="/formations">Toutes les formations</a>
                    
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
        <div class="wrapper w100"> <?php get_template_part( 'tpl/cta', 'contact' ); ?> </div>
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