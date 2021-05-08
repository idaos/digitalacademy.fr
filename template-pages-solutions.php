<?php
/*
Template Name: Pages Solutions
*/
get_header(); 


// Get featured image
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

<!-- Heading -->


<?php  if( have_rows('header') ): while( have_rows('header') ): the_row(); ?>

<section id="heading">
        <div class="bloc-1"<?php echo $bg; ?>>
            <svg class="svg-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#000" points="50,0 100,0 100,100 40,100"/>
            </svg>
            <svg class="svg-1-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#000" points="0,0 100,0 100,100 0,100"/>
            </svg>
            <svg class="svg-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#fff" points="0,100 100,0 100,100"/>
                <polygon fill="#bf3b2b" points="20,80 100,0 100,100"/>
            </svg>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <span class="reverse">   
                                <h1><?php the_title(); ?></h1>
                            <h3><?php if ( get_field( 'sous-titre_de_page' ) ) { the_field( 'sous-titre_de_page' ); } ?></h3>
                        </span>
                        <hr>
                        <p><?php if ( get_sub_field( 'header_p' ) ) { the_sub_field( 'header_p' ); } ?></p>

                        <?php  if( have_rows('bouton_1') ): while( have_rows('bouton_1') ): the_row(); ?>
                            <?php  if (get_sub_field('bouton_1_activer') == 'Oui') { ?>
                                <a href="<?php if ( get_sub_field( 'bouton_1_-_url' ) ) { the_sub_field( 'bouton_1_-_url' ); } ?>">
                                    <div class="btn btn-red marginR"><?php if ( the_sub_field( 'bouton_1_nom' ) ) { the_sub_field( 'bouton_1_nom' ); } ?></div>
                                </a>
                            <?php } ?>
                        <?php endwhile; endif; ?>
                        <?php  if( have_rows('bouton_2') ): while( have_rows('bouton_2') ): the_row(); ?>
                            <?php  if (get_sub_field('bouton_2_activer') == 'Oui') { ?>
                                <a class="contact-btn" href="<?php if ( the_sub_field( 'bouton_2_-_url' ) ) { the_sub_field( 'bouton_2_-_url' ); } ?>">
                                    <div class="btn btn-red-alt-neg"><?php if ( the_sub_field( 'bouton_2_nom' ) ) { thethe_sub_field_field( 'bouton_2_nom' ); } ?></div>
                                </a>
                            <?php } ?>
                        <?php endwhile; endif; ?>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; endif; ?>






<?php
$page_newsletter = get_field( 'page_newsletter', 'option' );
echo do_shortcode( '[cta texte="Restez informé sur nos formations digitales" url="' . $page_newsletter . '" texte_bouton="S’inscrire à la newsletter"]' );
?>

<?php get_footer(); ?>