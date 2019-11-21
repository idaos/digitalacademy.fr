<?php
/**
*   Template Name: Nos formateurs
*/
?>
<?php get_header();

if( has_post_thumbnail() ) {
    $class = '';
    $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center"';
}
?>

<style>
    hr{margin:2em auto}
    .content-white ul{padding-bottom: 3em;}
</style>

<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
    </div>
</div>
<div class="container-slider main-slider slider-header slider-formateur hidden-xs" <?php echo $bg; ?>>
    <div class="slick-slide">
        <div class="clearfix">
            <h1 class="title-slider"><?php the_title(); ?></h1>
        </div>
        <?php if( get_field( 'sous_titre' ) ): ?>
        <p><?php the_field( 'sous_titre' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<main class="content">
    <div class="container">
        <div class="wrapper">
            <?php if( get_field( 'texte_introduction' ) ): ?>
            <div class="full-width bg-gray fs20 p30 border-left-bold">
                <p><?php the_field( 'texte_introduction' ); ?></p>
            </div>
            <?php endif; ?>


            <div  id="matchheight-container">
                <div class="row display-flex">
                    <?php
                    $formateurs = get_terms( 'formateur', array('hide_empty'=>false) );
                    if ( $formateurs ) {
                        $i=0;
                        foreach( $formateurs as $formateur ) { ?>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="thewrapper container-border">
                            <div class="content-white">
                                <?php if( get_field( 'avatar', 'formateur_'. $formateur->term_id ) ): ?>
                                <img class="formateur-thumb" src="<?php the_field( 'avatar', 'formateur_'. $formateur->term_id ); ?>" alt="<?php echo $formateur->name; ?>" width="100" height="100" >
                                <?php endif; ?>
                                <h4><?php echo $formateur->name; ?></h4>
                                <p>
                                    <?php if( get_field( 'specialite', 'formateur_'. $formateur->term_id ) ): ?>
                                    <?php the_field( 'specialite', 'formateur_'. $formateur->term_id ); ?>
                                    <?php endif; ?>                                
                                </p>
                                <hr>
                                <?php $formations = get_posts(array(
                            'posts_per_page' => 3,
                            'post_type' => 'formation',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'formateur',
                                    'field' => 'term_id',
                                    'terms' => $formateur->term_id,
                                )
                            )
                        ) );
                                                              if( $formations ) {
                                                                  echo '<ul>';
                                                                  foreach( $formations as $formation ) { ?>
                                <li><a class="lien-formation" href="<?php echo get_the_permalink( $formation->ID ); ?>"><?php echo $formation->post_title; ?></a></li>
                                <?php } } ?>
                            </div>
                            <a href="<?php echo get_term_link( $formateur, 'formateur' ); ?>" class="btn btn-xs btn-red">En savoir plus</a>
                        </div>
                    </div>
                    <?php }
                        echo '</ul>';

                    } ?>
                </div>
            </div>


            <div class="full-width bg-orange full-width-contact">
                <p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
            </div>
        </div>
    </div>
</main><!-- Main end -->

<section id="references">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br><br><br>
                <span class="reverse"><h2>Nos références clients en formation</h2><h3>Depuis 10 ans, la Digital Academy forme aux métiers du web</h3></span>     
                <hr>
                <?php echo do_shortcode( '[kz_ref_slider]' ); ?>
                <a href="/type-reference/intra-entreprise/"><div class="btn btn-red">Voir toutes nos références</div></a>
                <br><br><br>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>