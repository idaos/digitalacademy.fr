<?php get_header(); ?>



<?php

if ( have_posts() ) :

	// Start the Loop.

	while ( have_posts() ) : the_post();



		get_template_part( 'content', get_post_format() );



	endwhile;



else :

	// If no content, include the "No posts found" template.

	get_template_part( 'content', 'none' );



endif;

?>



<?php get_footer(); ?>