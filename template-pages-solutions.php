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

<?php // Heading ?> 


<?php  if( have_rows('header') ): while( have_rows('header') ): the_row(); ?>

<section id="heading">
        <div class="bloc-1">

            <div class="container-fluid">
            <div class="img-holder"<?php echo $bg; ?>></div>
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6 wht-to-right">
                            <span class="reverse">   
                                    <h1><?php the_title(); ?></h1>
                                <h3><?php if ( get_sub_field( 'sous-titre_de_page' ) ) { the_sub_field( 'sous-titre_de_page' ); } ?></h3>
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
                                        <div class="btn btn-bf3b2b-alt"><?php if ( the_sub_field( 'bouton_2_nom' ) ) { the_sub_field( 'bouton_2_nom' ); } ?></div>
                                    </a>
                                <?php } ?>
                            <?php endwhile; endif; ?>
                            <br><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php endwhile; endif; ?>


<div class="breadcrumb">
    <div class="container">
        <?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb();  } ?>
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</div>


<?php // Blocs solution ?> 

<?php $blocks_count = -1; ?>
<?php  if( have_rows('blocs_solution') ): while( have_rows('blocs_solution') ): the_row(); ?>


    <?php  if( have_rows('bloc_image_a_gauche__texte_a_droite') ): while( have_rows('bloc_image_a_gauche__texte_a_droite') ): the_row(); ?>
    <?php $blocks_count ++; ?>
    <?php if ( get_sub_field( 'couleur' ) ) {
        
        $color = get_sub_field( 'couleur' ); 
        $color_hex = ltrim($color, '#'); 
        $color_style = <<<EOF
<style>
    .btn-$color_hex {
        background-color:$color!important;
    }
    .btn-$color_hex:hover {
        filter: brightness(85%);
    }
    .btn-$color_hex-alt{
        color:$color!important;
        background: rgb(255 255 255)!important;
        border: solid 1px $color!important;
    }
    .offer_bloc-$color_hex ul li:before {
        color: $color;
    }
    .free_block h4{
        color: $color;
        font-size:1.3em;
    }
</style>
EOF;
    echo $color_style; 
 } ?>



    <section class="offer_bloc offer_bloc-<?php echo $color_hex; ?> <?php if ($blocks_count % 2): ?>odd-pad<?php endif; ?>" style="<?php if ($blocks_count % 2): ?>background:#f1f1f1<?php endif; ?>;">

        <?php if (($blocks_count % 2) == 0): ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index: 12;">
                <polygon fill="#fff" points="0,0 100,0 100,100"/>
            </svg>
            <?php  if( have_rows('business_case') ): while( have_rows('business_case') ): the_row(); ?>
            <?php  if (get_sub_field('activer') == 'Non'): ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="bottom-triangle">
                <polygon fill="<?php echo $color; ?>" points="0,0 100,20 0,100"></polygon>
            </svg>
            <?php endif; endwhile; endif; ?>
        <?php endif; ?>
        <?php if ($blocks_count % 2): ?>
            <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#fff" points="0,100 100,0 100,100"/>
                <polygon fill="<?php echo $color; ?>" points="20,80 100,0 100,100"/>
            </svg>
        <?php endif; ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm<?php if (($blocks_count % 2) == 0): ?>-push<?php endif; ?>-6 col-md-6 col-lg-6">
                    <img src="<?php if ( get_sub_field( 'image' ) ) { the_sub_field( 'image' ); } ?>">
                </div>
                <div class="col-sm-6 col-sm<?php if (($blocks_count % 2) == 0): ?>-pull<?php endif; ?>-6 col-md-6 col-lg-6">
                    <span class="reverse">
                        <h2 style="color:<?php echo $color; ?>;"><?php if ( get_sub_field( 'titre' ) ) { the_sub_field( 'titre' ); } ?></h2>
                        <h3><?php if ( get_sub_field( 'sous_titre' ) ) { the_sub_field( 'sous_titre' ); } ?></h3>
                    </span>
                    <?php if ( get_sub_field( 'titre' ) ) { ?>
                    <hr>
                    <?php }; ?>
                    <p><?php if ( the_sub_field( 'contenu' ) ) { the_sub_field( 'contenu' ); } ?></p>

                    <?php  if( have_rows('bouton_1') ): while( have_rows('bouton_1') ): the_row(); ?>
                    <?php  if (get_sub_field('activer') == 'Oui'): ?>
                        <a href="<?php if ( get_sub_field( 'url' ) ) { the_sub_field( 'url' ); } ?>">
                            <div class="btn btn-<?php echo $color_hex; ?> marginR"><?php if ( get_sub_field( 'nom' ) ) { the_sub_field( 'nom' ); } ?></div>
                        </a>
                    <?php endif; ?>
                    <?php endwhile; endif; ?>
                    <?php  if( have_rows('bouton_2') ): while( have_rows('bouton_2') ): the_row(); ?>
                    <?php  if (get_sub_field('activer') == 'Oui'): ?>
                        <a class="contact-btn" href="<?php if ( get_sub_field( 'url' ) ) { the_sub_field( 'url' ); } ?>">
                            <div class="btn btn-<?php echo $color_hex; ?>-alt marginR"><?php if ( get_sub_field( 'nom' ) ) { the_sub_field( 'nom' ); } ?></div>
                        </a>
                    <?php endif; ?>
                    <?php endwhile; endif; ?>
                    <?php  if( have_rows('bouton_3') ): while( have_rows('bouton_3') ): the_row(); ?>
                    <?php  if (get_sub_field('activer') == 'Oui'): ?>
                        <a class="contact-btn" href="<?php if ( get_sub_field( 'url' ) ) { the_sub_field( 'url' ); } ?>">
                            <div class="btn btn-<?php echo $color_hex; ?>-alt"><?php if ( get_sub_field( 'nom' ) ) { the_sub_field( 'nom' ); } ?></div>
                        </a>
                    <?php endif; ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php // Business Case ?> 
    <?php  if( have_rows('business_case') ): while( have_rows('business_case') ): the_row(); ?>
    <?php  if (get_sub_field('activer') == 'Oui'): ?>

        <?php //  Triangles ?> 
        <section class="business-case" style="background-color: <?php echo $color; ?>;">
            <svg class="svg-top business-case-triangle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="<?php echo $color; ?>" points="0,100 100,0 100,100"></polygon>
            </svg>
            <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="height:12vw;bottom:0;z-index:0;">
                <polygon fill="#fff" points="100,100 100,0 0,100"/>
            </svg>
            <div style="filter: drop-shadow(-1px 6px 10px rgba(0, 0, 0, 0.2));">
                <div class="container w testimonial-wrapper" style="max-width: 1100px;">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 style="color:<?php echo $color; ?>;"><?php if ( get_sub_field( 'titre' ) ) { the_sub_field( 'titre' ); } ?></h4>
                            <hr>
                            <p><b style="font-size:1.1em;"><?php if ( get_sub_field( 'sous-titre' ) ) { the_sub_field( 'sous-titre' ); } ?></b></p>
                        </div>
                    </div>
                    <div class="row valign g">
                        <?php if ( get_sub_field( 'image' ) ) { ?>
                        <div class="col-md-4 alignRight">
                            <img style="border-radius:7px;display:inline-block;margin:auto;position:relative;" src="<?php the_sub_field( 'image' );?>" alt="">
                        </div>
                        <div class="col-md-8 alignLeft">
                        <?php }; ?>
                            <p><?php if ( get_sub_field( 'contenu' ) ) { the_sub_field( 'contenu' ); } ?></p>
                        <?php if ( get_sub_field( 'image' ) ) { ?>
                        </div>
                        <?php }; ?>
                    </div>
                    <div class="toggable">
                        <div class="toggable-content">
                            <div class="container w testimonial-wrapper margin0" style="clip-path:none;padding: 3em 3em 1em 3em;">
                                <div class="row row-same-height">
                                <?php  if( have_rows('temoignage') ): while( have_rows('temoignage') ): the_row(); ?>

                                        <div class="col-md-4 x">
                                            <div class="wrapper" style="height:100%!important">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                                                    <polygon fill="#f5f5f5" points="0,0 100,100 0,100"/>
                                                </svg>
                                                <?php if ( get_sub_field( 'nom__prenom' ) ) { ?><div class="name"><?php the_sub_field( 'nom__prenom' ); ?></div><?php } ?>
                                                <?php if ( get_sub_field( 'entreprise' ) ) { ?><div class="company"><span class="noWrap"><?php the_sub_field( 'entreprise' ); ?></span></div><?php } ?>
                                                <hr>
                                                <?php if ( get_sub_field( 'temoignage' ) ) { ?><div class="testimonial"><?php the_sub_field( 'temoignage' ); ?></div><?php } ?>
                                                <?php if ( get_sub_field( 'logo_de_lentreprise' ) ) { ?><img src="<?php the_sub_field( 'logo_de_lentreprise' ); ?>"><?php } ?>
                                                <?php if ( get_sub_field( 'formation' ) ) { ?><div class="course"><?php the_sub_field( 'formation' ); ?></div><?php } ?>
                                            </div>
                                        </div>

                                <?php endwhile; endif; ?>
                                </div>

                                <div class="row numerical-data" style="margin-top: 3em;">
                                    <?php  if( have_rows('icones') ): while( have_rows('icones') ): the_row(); ?>
                                    <div class="col-sm-6 col-md-3">
                                        <?php if ( get_sub_field( 'image' ) ) { ?><img src="<?php the_sub_field( 'image' ); ?>"><?php } ?>
                                        <?php if ( get_sub_field( 'texte' ) ) { ?><?php the_sub_field( 'texte' ); ?>"<?php }; ?>
                                    </div>
                                    <?php endwhile; endif; ?>
                                </div>

                                <?php if ( get_sub_field( 'paragraphe' ) ) { ?>
                                    <p><?php the_sub_field( 'paragraphe' ); ?></p>
                                <?php }; ?>
                                <?php if ( get_sub_field( 'encadre' ) ) { ?>
                                    <div class="row row-same-height">
                                        <div class="encart">
                                            <?php the_sub_field( 'encadre' ); ?>
                                        </div>
                                    </div>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="toggable-btn btn btn-sm btn-<?php echo $color_hex; ?>-alt">En savoir +</div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
    <?php endwhile; endif; ?>



    <?php // Icones block ?> 
    <?php  if( have_rows('bloc_dicones') ): while( have_rows('bloc_dicones') ): the_row(); ?>
    <?php  if (get_sub_field('activer') == 'Oui') { ?>
        <?php if ( get_sub_field( 'couleur' ) ) {
        
        $color = get_sub_field( 'couleur' ); 
        $color_hex = ltrim($color, '#'); 
        $color_style = <<<EOF
<style>
    .difference .elt > [class*='col-']:nth-child(2), .elt > [class*='col-']:nth-child(4), .elt > [class*='col-']:nth-child(5), .elt > [class*='col-']:nth-child(7){
        background: $color;
    } 
    .difference .elt > [class*='col-']:nth-child(1):before, .elt > [class*='col-']:nth-child(3):before, .elt > [class*='col-']:nth-child(6):before, .elt > [class*='col-']:nth-child(8):before{
        border: solid 2px $color;
    } 
</style>
EOF;
    echo $color_style; 
 } ?>

    <div class="difference">
        <div class="container">
            <?php if ( get_sub_field( 'titre' ) ) { ?>
                <div class="row">
                    <div class="col-12 alignCenter">
                        <h2><?php the_sub_field( 'titre' ); ?></h2>
                    </div>
                </div>
            <?php }; ?>
            <div class="row elt">
                <?php  if( have_rows('icones') ): while( have_rows('icones') ): the_row(); ?>
                    <div class="col-sm-12 col-md-3">
                        <img src="<?php if ( get_sub_field( 'image' ) ) { the_sub_field( 'image' ); } ?>">
                        <br><span><?php if ( get_sub_field( 'texte' ) ) { the_sub_field( 'texte' ); } ?></span>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php endwhile; endif; ?>

    <?php // Free block ?> 
    <?php if ( get_sub_field( 'bloc_libre' ) ) { ?>
        <div class="free_block">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <?php the_sub_field( 'bloc_libre' ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


<?php // block end ?> 
<?php endwhile; endif; ?> 
<?php // Blocks end ?> 
<?php endwhile; endif; ?>




<?php // Satisfaction ?> 
<?php  if( have_rows('satisfaction') ): the_row(); ?>
<?php  if (get_sub_field('activer') == 'Oui'): ?>
<section id="satisfaction">
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#2f905e" points="0,100 100,0 100,100"/>
    </svg>
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon fill="#60dd9c" points="0,0 0,100 100,0"/>
    </svg>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/like-icon.svg" alt="">
                <h4><?php if ( get_sub_field( 'texte' ) ) { the_sub_field( 'texte' ); } ?></h4>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php // Contact form ?> 
<?php  if( have_rows('formulaire_de_contact') ): while( have_rows('formulaire_de_contact') ): the_row(); ?>
<?php  if (get_sub_field('activer') == 'Oui'): ?>
    <section id="contact"><span id="contact-anchor"></span>
        <div class="container">
            <div class="row row-same-height">
                <div class="col-md-5 col-lg-7 valign">
                    <div class="container">
                        <div class="row alignCenter">
                            <span><img id="logo_dac" src="<?php echo get_template_directory_uri(); ?>/landing-page-catalogue/res/img/logo-digitalacademy.svg" width="150" alt="Logo Digital Academy"></span>
                            <b>Nos conseillers vous répondent au :</b>
                            <span id="phone"><a title="Bouton d'appel téléphonique" href="tel:0977215321">09 77 21 53 21</a></span>
                            <i>appel non surtaxé du lundi au vendredi de 9h30 à 19h</i>
                            <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true"]'); ?>
                            <i style="margin-top: 2em;">ou par e-mail</i>
                            <a title="Nous envoyer un email" id="adresse-email" href="mailto:contact@digitalacademy.fr">contact@digitalacademy.fr</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-5 valign" id="form-bottom" action="#">
                    <div class="container">
                        <div class="row">
                            <div class="col-12"></div>
                            <div class="container form-container">
                                <div class="row">
                                    <?php echo do_shortcode('[gravityform id="11" title="false" description="false" ajax="true"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php // Contact form end ?> 
<?php endwhile; endif; ?>




<?php // Newsletter ?> 
<?php
$page_newsletter = get_field( 'page_newsletter', 'option' );
echo do_shortcode( '[cta texte="Restez informé sur nos formations digitales" url="' . $page_newsletter . '" texte_bouton="S’inscrire à la newsletter"]' );
?>

<?php get_footer(); ?>