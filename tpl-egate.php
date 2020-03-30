<?php 
/**
 *   Template Name: SEO Page - eGate
 */

get_header(); ?>


<?php
$bg = '';
if( has_post_thumbnail() ) {
    $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center center"';
}else{
    $bg = 'style="background-image:url('.get_stylesheet_directory_uri().'/images/formation-au-digital.jpg);background-size: cover;background-position:center center"';
}
?>


<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb(); } ?>
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</div>
<div class="header" <?php echo $bg; ?>>    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 alignCenter">

                <h1 class="title-slider">
                    Organisme de formation spécialiste du digital &amp; des réseaux sociaux
                </h1>
                <hr>
                <p>Digital Academy est un organisme de formation expert en réseaux sociaux. DigitalAcademy est un organisme qui propose un accompagnement personnalisé pour un programme de formation.</p>
                
                <a href="<?php echo get_page_link(270); ?>"><div class="btn btn-red-alt-neg">Découvrir nos solutions</div></a>
                <a title="Bouton de contact" class="contact-btn" href="/contact/?utm_source=seo-page&utm_medium=seo-page&utm_campaign=egate" value="Prendre contact avec la Digital Academy"><div class="btn btn-red marginR">Contactez-nous</div></a>

            </div>
        </div>
    </div>
</div>

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


        <h1><?php the_field( 'description' ); ?></h1>
        <hr>

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