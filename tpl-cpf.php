<?php 
/**
 *   Template Name: Page CPF
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

<section id="heading">
    <div class="bloc-1" <?php echo $bg; ?>>
        <div class="container">
            <div class="row" style="padding-bottom: 3em;">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <h1><?php the_title(); ?></h1>
                    <?php if ( get_field( 'description' ) ){ ?><p style="font-style:italic"><?php the_field( 'description' ); ?></p><?php } ?>
                    <?php if ( get_field( 'has_button' ) ){ ?> 
                    <a title="Bouton de contact" class="contact-btn" href="<?php if ( get_field( 'button_href' ) ){ ?> <?php the_field( 'button_href' ); ?><?php } ?>">
                        <div class="btn btn-red"><?php if ( get_field( 'button_label' ) ){ ?> <?php the_field( 'button_label' ); ?><?php } ?></div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
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