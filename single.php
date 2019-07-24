<?php get_header(); ?>
<div class="breadcrumb hidden-xs">
<div class="container">			
<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>		
</div>	
</div>
<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php the_field( 'img_bandeau', get_the_ID() ) ?>)">		
<div class="slick-slide">
<div class="clearfix">
<h1 class="title-slider">Blog</h1>
</div>
<p>
Suivez l'actualité de la DigitalAcademy©</p>
</div>	</div>	
<main class="content">
	<div class="container">
		<div class="wrapper p5000">
			<div class="row clearfix">
				<div class="col-sm-7 container-blog">	
					<div class="row clearfix">
					<?php if ( have_posts() ) :	
					while ( have_posts() ) : the_post();
					?>	
					<header class="header-title clearfix">
					<div class="left content-date">
					<p class="month"><?php echo get_the_date( 'M' ); ?></p>				
					<p class="day"><?php echo get_the_date( 'd' ); ?></p>	
					</div>										
					<h1><?php the_title(); ?></h1>										
					<p><?php the_date(); ?> | <?php echo get_the_category_list( ', ' ); ?></p>	
					</header>
					
					<div class="content-share">	<p>Partager :</p>	
					<?php digital_share_bouton( get_the_permalink(), get_the_title() ); ?>	
					</div>		
					<div class="content-main">			
					<?php if( has_post_thumbnail() ): ?>	<?php the_post_thumbnail( 'blog', array( 'class' => 'img-thumbnail' ) ); ?>										<?php endif; ?>										<?php the_content(); ?>									</div>									<div class="content-share">										<p>Partager :</p>										<?php digital_share_bouton( get_the_permalink(), get_the_title() ); ?>									</div>									<div class="content-author clearfix display-table">										<?php										$author_id = get_the_author_meta('ID');										if( get_field( 'avatar', 'user_'. $author_id ) ):											?>											<img src="<?php the_field( 'avatar', 'user_'. $author_id ); ?>" alt="" />										<?php endif; ?>										<p><strong><?php the_author(); ?></strong></p>									</div>								<?php								endwhile;							endif;							?>						</div>					</div>					<aside class="sidebar col-sm-5">						<?php get_sidebar(); ?>					</aside>				</div>															</div>		</div>						<?php related_posts(); ?>		<div class="container">			<div class="wrapper ">                                				<?php get_template_part( 'tpl/cta', 'contact' ); ?>			</div>		</div>	</main><!-- Main end -->	<div class="wrapper text-center container-reference">		<div class="p030">			<h3>Nos références clients en formation</h3>			<?php echo do_shortcode( '[references_slider]' ); ?>		</div>	</div><?php get_footer(); ?>