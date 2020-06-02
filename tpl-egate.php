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

<!--
<div class="header" <?php // echo $bg; ?>>    
<div class="container" style="z-index:inherit">
<div class="row">
<div class="col-xs-12 alignCenter">
<img id="speechelevator-xs">
<img id="speechelevator-sm">
<img id="speechelevator-md">
<img id="speechelevator-lg">
<a href="<?php // echo get_page_link(270); ?>"><div class="btn btn-red-alt-neg">Découvrir nos solutions</div></a>
<a title="Bouton de contact" class="contact-btn" href="/contact/?utm_source=seo-page&utm_medium=seo-page&utm_campaign=egate" value="Prendre contact avec la Digital Academy"><div class="btn btn-red marginR">Contactez-nous</div></a>
</div>
</div>
</div>
</div>
-->

<section id="heading">
    <div class="bloc-1" <?php echo $bg; ?>>
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
            <div class="row" style="padding-bottom: 3em;">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <h1 style="font-size: 2.1em;color:#fff;">Organisme de formation spécialiste du digital <span class="noWrap">&amp; du e-learning</span></h1>
                    <hr>
                    <p style="font-size: 1.2em;">La Digital Academy, institut de formation qui fait vivre le digital en entreprise, propose des formations digitales en web 2.0, médias sociaux, web marketing.</p>
                    <a href="<?php echo get_page_link(270); ?>"><div class="btn btn-red-alt-neg marginR">Découvrir nos solutions</div></a>
                    <a title="Bouton de contact" class="contact-btn" href="#form-bottom" value="Prendre contact avec la Digital Academy"><div class="btn btn-red">Contactez-nous</div></a>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="svg-wrapper-bottom" style="">
    <svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:4">
        <polygon fill="#eee" points="0,0 0,100 40,40"></polygon>
    </svg>
    <svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:3">
        <polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
    </svg>
    <svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" style="z-index:2">
        <polygon fill="#fff" points="0,0 100,100 0,100"></polygon>
    </svg>
</div>    
<main class="content">
    <div class="container" style="z-index:5">
        <h1><?php the_title(); ?></h1>
        <p style="font-style:italic"><?php the_field( 'description' ); ?></p>
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