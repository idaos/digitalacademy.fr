<?php 
/**
 *   Template Name: SEO Page - eGate
 */

get_header(); 

if ( get_field( 'image' ) ){

    $img_url = get_field( 'image' );
    $bg = 'style="background-image:url(\''. $img_url .'\');background-size: cover;background-position:center center"';
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
                    <div id="pitch-elevator-title">
                        <?php the_field( 'pitch_elevator_title' ); ?>
                    </div>
                    <hr>
                    <div id="pitch-elevator-content">
                        <?php the_field( 'pitch_elevator_content' ); ?>
                    </div>

                    <a href="https://www.digitalacademy.fr/"><div class="btn btn-red-alt-neg marginR">Digital Academy</div></a>
                    <a title="Bouton de contact" class="contact-btn" href="/contact/?utm_source=seo-page&utm_medium=seo-page&utm_campaign=egate" value="Prendre contact avec la Digital Academy"><div class="btn btn-red">Contactez-nous</div></a>
                </div>
            </div>
        </div>
    </div>
</section>
 
<main class="content">
    <div class="container" style="z-index:5">
        <h1><?php the_title(); ?></h1>
        <?php if ( get_field( 'description' ) ){ ?><p style="font-style:italic"><?php the_field( 'description' ); ?></p><?php } ?>
        <hr style="margin:0">
        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        the_content();
        endwhile;
        endif;
        ?>
    </div>
</main><!-- Main end -->

<!-- Glossary -->
<div id="glossary">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                $i = 0;
                $pages = get_pages(array(
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'tpl-egate.php'
                ));
                $numItems = count($pages);
                foreach($pages as $page){
                    $slug = str_replace("-", " ", $page->post_name);
                    echo '<a href="' .get_page_link($page->ID). '">' .$slug. '</a>';
                    if(++$i === $numItems) {}else{
                        echo " | ";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>