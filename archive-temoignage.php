<?php get_header(); ?>


<div class="header" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/temoignages.jpg);">    
	<!--<div class="header" style="background-image:url(<?php //the_field('img_temoignages', 'option') ?>)">    -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<h1 class="title-slider" style="color:#fff;">Après la formation</h1>
				<hr>
				<p style="font-size: 1.3em;">Satisfaction et témoignages de nos apprenants</p>
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
<div class="content" style="margin-top:-4vw;">
	<div class="container">
		<div class="wrapper">
			<div class="row">
				<div class="col-xs-12">
					<h2 style="width:100%;text-align:center;font-style:inherit;margin-top:4em;">Satisfaction de nos apprenants</h2>
					<hr> 
					<div id="chart-wrp"></div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="content" style="background:#f7f7f7;margin-top:4em;padding-top:3em;">
	<div class="container">
		<div class="wrapper">


			<h2 style="width:100%;text-align:center;font-style:inherit;">Témoignages</h2>
			<hr>
			<div id="matchheight-container">
				<div class="row display-flex">
					<?php
					if ( have_posts() ) :
					$i=0;
					// Start the Loop.
					while ( have_posts() ) : the_post();
					?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="container-border" style="background:#fff;">
							<?php if( has_post_thumbnail() ): ?>
							<div class="content-img">
								<?php the_post_thumbnail(); ?>
							</div>
							<?php endif; ?>
							<div class="content-gray">
								<h2><?php the_title(); ?></h2>
								<?php if( get_field('entreprise') ): ?>
								<strong><?php the_field('entreprise'); ?></strong>
								<?php endif; ?>
								<p><?php the_content(); ?></p>
							</div>
						</div>
					</div>
					<?php
					endwhile;
					else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'tpl/cta', 'contact' ); ?>
</div><!-- Main end -->
<?php get_footer(); ?>