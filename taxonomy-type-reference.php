<?php get_header(); ?>
<?php $thematique_ID = get_queried_object_id(); ?>
<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) {yoast_breadcrumb();}?>
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</div>
<div class="header" style="height:200px; padding:2em 0;background-image:url(<?php the_field( 'img_bandeau', 'type-reference_' . get_queried_object_id() ) ?>)">    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<h1 class="title-slider" style="color:#fff;">Nos références en formation</h1>
			</div>
		</div>
	</div>
</div>  
<div class="full-width bg-orange content-declinaison text-center">
    <div class="clearfix">
        <span>Filtrer les références en formation :</span>
        <?php echo digital_get_type_menu( 'type-reference' ); ?>
    </div>
</div>
<div class="xs-container-menu-filtre">
    <div class="container-menu-filtre">
        <div class="container">
            <?php echo digital_get_reference_menu( $thematique_ID ); ?>
        </div>
    </div>
</div>
<style>
    .content{
        text-align: center;
    }
    .content, .site-container{
        background: #eee;
    }
    .col-sm-6{
        margin-bottom: 1em;
    }
    .bg-wht{
        background: #fff;
        padding: 2.5em;
    }
    h2{
        text-transform: uppercase;
        color:#BF3B2B;
        margin-bottom: .5em !important;
    }
    hr{
        margin: 0 auto 2em auto !important;
    }
</style>
<main class="content container">
    <div class="row">
        <h2>Nos références <?php echo  strtolower( esc_html(get_queried_object()->name ) ); ?></h2>
        <hr>
    </div>
    <?php if ( have_posts() ) : ?>
    <div class="row">
        <div class="container-slider references clearfix matchHeight-watch">
            <?php // Start the Loop.
            $i = 0;
            while( have_posts() ) : the_post(); ?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a href="<?php echo esc_url( get_field( 'url' ) ); ?>" target="_blank">
                    <div class="bg-wht">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </a>
            </div>
            <?php
            if ( $i % 4 == 3 ) {
                echo '</div></div><div class="row"><div class="container-slider references clearfix matchHeight-watch">';
            }
            $i ++;
            endwhile; ?>
        </div>
    </div>
    <?php else : ?>
    <div class="row">
        <h3>Aucun résultats correspondant à vos critères !</h3>
    </div>
    <?php endif; ?>
</main><!-- Main end -->
<div class="full-width bg-orange full-width-contact">
    <p class="clearfix"><span class="m-100">Une question sur nos formations ?</span> <a
                                                                                        href="<?php echo get_field( 'page_demande_catalogue', 'option' ); ?>" class="btn-white">Demander le catalogue</a>
    </p>
</div>
<?php get_footer(); ?>