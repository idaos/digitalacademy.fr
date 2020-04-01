<?php get_header(); ?>

<?php
// Start the Loop.
$formateur_ID = get_queried_object_id();
?>
<div class="container-slider main-slider slider-header slider-formateur">
    <?php if ( get_field( 'avatar', 'formateur_' . $formateur_ID ) ): ?>
    <img src="<?php the_field( 'avatar', 'formateur_' . $formateur_ID ); ?>"
         alt="<?php echo single_cat_title(); ?>" width="100" height="100">
    <?php endif; ?>
    <h1><?php echo single_cat_title(); ?></h1>
    <?php if ( get_field( 'specialite', 'formateur_' . $formateur_ID ) ): ?>
    <p><?php the_field( 'specialite', 'formateur_' . $formateur_ID ); ?></p>
    <?php endif; ?>
    <?php if ( have_rows( 'reseaux', 'formateur_' . $formateur_ID ) ): ?>
    <ul class="picto clearfix">
        <?php while ( have_rows( 'reseaux', 'formateur_' . $formateur_ID ) ) : the_row(); ?>
        <?php if ( get_sub_field( 'url' ) ): ?>
        <li><a href="<?php the_sub_field( 'url' ); ?>" target="_blank">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-<?php echo the_sub_field( 'reseau' ); ?>-rounded.png" alt=""/>
            </a>
        </li>
        <?php endif; ?>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>
</div>
<main class="content">
    <div class="wrapper">
        <div class="container">
            <?php if ( get_field( 'biographie', 'formateur_' . $formateur_ID ) ): ?>
            <div class="full-width bg-gray fs20 p30 border-left-bold">
                <?php the_field( 'biographie', 'formateur_' . $formateur_ID ); ?>
            </div>
            <?php endif; ?>
            <?php if ( get_field( 'video_url', 'formateur_' . $formateur_ID ) ): ?>
            <div class="border-light fs20 display-table p30 margin-mobil">
                <h2>Vidéo</h2>
                <div class="clearfix row">
                    <div class="col-sm-4">
                        <a href="<?php the_field( 'video_url', 'formateur_' . $formateur_ID ); ?>"
                           target="_blank">
                            <img src="<?php the_field( 'video_image', 'formateur_' . $formateur_ID ); ?>"
                                 alt=""/>
                        </a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <img
                             src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-digital-academy-video.jpg"
                             alt=""/>
                        <p class="m2020">Retrouvez toutes nos vidéos sur note châine Dailymotion</p>
                        <a href="<?php echo get_field( 'url_dailymotion', 'option' ); ?>" class="btn-orange">Cliquez
                            ici</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <p><strong>Une question ?</strong></p>
                        <p>Appelez-nous au</p>
                        <p><?php echo get_field( 'telephone', 'option' ); ?></p>
                        <p>OU</p>
                        <a href="<?php echo get_field( 'page_contact', 'option' ); ?>" class="btn-orange">Contactez-nous</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    ob_start(); // prevent echo when the shortcode return is null
    echo do_shortcode( '[kz_courses_slider nb=20 taxo="formateur"]' );
    $short_out = ob_get_contents();
    ob_end_clean();
    if(strlen($short_out)>0){ ?>
    <section id="slider-formations">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br>
                    <h2>Ses formations DigitalAcademy</h2>
                    <hr>
                    <?php echo $short_out; ?>
                    <a href="/formations/"><div class="btn btn-red">Découvrir toutes nos formations</div></a>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>


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