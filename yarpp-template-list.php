<?php
/*
YARPP Template: List
Description: This template returns the related posts as a comma-separated list.
Author: mitcho (Michael Yoshitaka Erlewine)
*/

$options = array( 'thumbnails_heading', 'thumbnails_default', 'no_results' );
extract( $this->parse_args( $args, $options ) );

$limit = 32;

?>

<div class="clearfix"></div>

<h3 style="margin-top:40px">Autres articles qui peuvent vous int&eacute;resser :</h3>

<?php if (have_posts()):?>

<div class="row twelve columns gdl-blog-widget">

<?php while (have_posts()) : 
	
	the_post(); 
	
	$post_id = get_the_ID();

	$text = get_the_content();
	$content = explode(' ', $text, $limit);
	
	if (count($content) >= $limit){
	    array_pop($content);
	    $content = implode(" ",$content) . ' [...]';
	} else {
	    $content = implode(" ",$content);
	}
	
	$content = strip_tags($content);
	
	$thumbnail_id = get_post_thumbnail_id( $post_id );
	
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail' );
	
	$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
	
	?>
	
	<div class="row" style="margin:20px 0;">
		<div class="col-sm-3">
			<div class="blog-media-wrapper gdl-image">
				<a href="<?php the_permalink() ?>">
					<img src="<?php echo $thumbnail[0] ?>" alt="<?php echo $alt_text ?>"/>
				</a>
			</div>
		</div>
		<div class="col-sm-9 blog-content-wrapper">
			<div class="blog-context-wrapper ">
				<a href="<?php the_permalink() ?>">
					<?php the_title(); ?>
				</a>
			</div>
			<div class="blog-content ">
				<?php echo $content; ?>
			</div>			
		</div>	
	</div>
	
	<!--<div class="">

	<div class="three columns">
	

	
	</div>
	
	<div class="nine columns">
	

	
	</div>
	
	</div>-->
	
	<?php endwhile; ?>

	</div>
	
<?php endif; ?>

