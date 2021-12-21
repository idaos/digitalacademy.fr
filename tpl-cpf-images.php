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


<div class="svg-wrapper-bottom" style="">
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:4">
        <polygon fill="#eee" points="0,0 0,100 40,40"></polygon>
    </svg>
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:3">
        <polygon fill="#3d00cc" points="0,0 100,20 100,100"></polygon>
    </svg>
    <svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:2">
        <polygon fill="#fff" points="0,0 100,100 0,100"></polygon>
    </svg>
</div>    
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