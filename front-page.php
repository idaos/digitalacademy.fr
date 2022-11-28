<?php
/*
Front page template
*/

wp_enqueue_style( 'gutenberg-style', get_template_directory_uri() . '/css/gutenberg-style.css?v=2', array( 'main' ), null );
get_header();

?>

<main class="content">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>

</main><!-- Main end -->
<?php get_footer(); ?>