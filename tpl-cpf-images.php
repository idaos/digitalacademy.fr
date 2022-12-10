<?php 
/**
 *   Template Name: Page CPF IMAGES
 */

get_header(); 

if ( get_field( 'image' ) ){
    $img_url = get_field( 'image' );
    $bg = 'style="background-image:url(\''. $img_url .'\');background-size: cover;background-position:center center"';
}else if( has_post_thumbnail() ) {
    $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center center"';
}else{
    $bg = 'style="background-image:url('.get_stylesheet_directory_uri().'/images/formation-au-digital.jpg);background-size: cover;background-position:center center"';
}
?>

<section>
    <div style="margin-top:-18px;">
       <img src='https://recette.digitalacademy.fr/wp-content/uploads/2021/12/20211208-bandeau-filtre.jpg' >
    </div>
</section>
 
<main class="content">
    <div class="container" style="z-index:5">
        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        the_content();
        endwhile;
        endif;
        ?>
    </div>
</main><!-- Main end -->

<?php get_footer(); ?>