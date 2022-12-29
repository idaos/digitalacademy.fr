<?php get_header(); ?>

<style>
    .content-main a {text-decoration: underline;}
</style>

<div class="header" style="">
    
<?php if( has_post_thumbnail() ): ?>	
    <?php the_post_thumbnail( 'blog', array( 'class' => 'img-thumbnail' ) ); ?>										
<?php endif; ?> 
</div>
<main class="content" style="z-index:5;background:none;">
    <div class="container" style="padding-bottom:2em;">
        <div class="wrapper" style="background:rgba(0,0,0,0)">
            <div class="row clearfix">
                <div class="container-blog col-md-8">

                    
                    <div class="row clearfix">
                    
                        <!-- BreadCrumbs -->
                        <div class="breadcrumb breadcrumb-header" style="padding-left: 0;">
                            <div class="container" style="padding-left: 0;">
                                <?php if (function_exists('yoast_breadcrumb')) {  yoast_breadcrumb(); } ?>
                                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                            </div>
                        </div>
            
                        <h1 style="margin-bottom: 1rem;margin-top: 2rem;"><?php the_title(); ?></h1>
                        <div style="display: flex; align-items:center">
                            <div>Publié le <time class="updated entry-time" datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_date(); ?></time>&nbsp;|&nbsp; <?php if (function_exists('wp_time_to_read')) { wp_time_to_read(); } ?></div>
                            &nbsp; &nbsp;<?php digital_share_bouton( get_the_permalink(), get_the_title() ); ?>	
                        </div>
                    
                        <?php if ( have_posts() ) :	  while ( have_posts() ) : the_post(); ?>	
                        <div class="content-main">	
                            <?php if( has_excerpt( $id ) ): ?>		
                            <h2 class="chapo" style="font-weight: bold;"><?php the_excerpt(); ?></h2>
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
                     <br>
                     <div class="h2" style="color: #bf3b2b; font-weight:bold; font-size:22px; text-align:center">Quelle formation recherchez-vous ?</div>
                     <br>
                     <?php echo do_shortcode('[courses-search-bar]') ; ?>
                     <a class="btn btn-sm btn-red" style="display: inline-flex;left: 50%;transform: translateX(-50%);" href="/formations/">Toutes nos formations</a>

                    <?php echo do_shortcode( '[kz_shortcode_associatedCourses]' ); ?>
                    
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
<?php get_footer(); ?>