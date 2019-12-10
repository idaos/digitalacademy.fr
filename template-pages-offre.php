<?php
/*
Template Name: Page Offre
*/
get_header(); 
$color1 = get_field( 'color1');
$color2 = get_field( 'color2');
?>
<?php $heading_img = get_field('page-header-image'); ?>
<style>
    h2 > span{color: rgb(<?php echo $color1; ?>);}
    h1{color: #bec7ff !important;}
    .gray-bg{background-color: rgb(<?php echo $color2; ?>);}
    .elt > [class*='col-']:nth-child(2), .elt > [class*='col-']:nth-child(4), .elt > [class*='col-']:nth-child(5), .elt > [class*='col-']:nth-child(7){
        background: rgb(<?php echo $color2; ?>);
    } 
    .elt > [class*='col-']:nth-child(1):before, .elt > [class*='col-']:nth-child(3):before, .elt > [class*='col-']:nth-child(6):before, .elt > [class*='col-']:nth-child(8):before{
        border: solid 2px rgb(<?php echo $color2; ?>);
    } 
    #arrow-prev:hover, #arrow-next:hover{color: rgb(<?php echo $color1; ?>) !important;}
    @media (max-width: 768px) {
        .elt > [class*='col-']:nth-child(2), .elt > [class*='col-']:nth-child(3), .elt > [class*='col-']:nth-child(6), .elt > [class*='col-']:nth-child(7){
            background: rgb(<?php echo $color2; ?>);
        } 
    }
    .blend{background: rgba(<?php echo $color1; ?>,.52);}
    #business li:before, .offre li:before{background-color: rgb(<?php echo $color1; ?>);}
    #heading .bloc-1{
        background-image: url(<?php echo $heading_img['url']; ?>);
    }
    .svg-1, .svg-1-md{
        filter: brightness(40%);
        opacity: .7;
    }
    .bloc-1{
        background-position: center;
    }
</style>
<!--<div id="baseline"><?php //if ( get_field( 'page-header-baseline' ) ) {the_field( 'page-header-baseline' );}?></div>-->

<?php $blocs_offre = get_field('blocs_offre');
if($blocs_offre){ ?>

<div id="page">                    
   
    <section id="heading">
        <div class="bloc-1">
            <svg class="svg-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#000" points="50,0 100,0 100,100 40,100"/>
            </svg>
            <svg class="svg-1-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="#000" points="0,0 100,0 100,100 0,100"/>
            </svg>
            <svg class="svg-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon fill="rgb(<?php echo $color2; ?>)" points="0,100 100,0 100,100"/>
                <polygon fill="#bf3b2b" points="20,80 100,0 100,100"/>
            </svg>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6"></div>
                    <div class="col-xl-6">
                        <h1><?php if ( get_field( 'page-header-h1' ) ) {the_field( 'page-header-h1' );}?></h1>
                        <hr>
                        <p><?php if ( get_field( 'page-header-p' ) ) {the_field( 'page-header-p' );}?></p>
                        <a href="<?php if ( get_field( 'page-header-btn-link' ) ) {the_field( 'page-header-btn-link' );}?>" class="btn btn-blue contact-btn marginR" value="<?php if ( get_field( 'page-header-btn-option' ) ) {the_field( 'page-header-btn-option' );}?>">
                            <?php if ( get_field( 'page-header-btn-name' ) ) {the_field( 'page-header-btn-name' );}?>
                        </a>
                        <a href="<?php if ( get_field( 'page-header-btn2-link' ) ) {the_field( 'page-header-btn2-link' );}?>" class="btn btn-blue-alt-neg contact-btn" value="<?php if ( get_field( 'page-header-btn2-option' ) ) {the_field( 'page-header-btn2-option' );}?>">
                            <?php if ( get_field( 'page-header-btn2-name' ) ) {the_field( 'page-header-btn2-name' );}?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="gray-bg blanckspace"></div>
    <?php foreach($blocs_offre as $bloc_offre){
    $bulletpoints = $bloc_offre['bulletpoints'];
    $video_url = $bloc_offre['video_url']; ?>
    <div class="offre-wrapper gray-bg">
        <div class="container offre">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-12 col-md-6">
                   <?php if($video_url){ echo '<a href="'. $video_url .'" data-modal="button">'; } ?>
                      <img src="<?php echo $bloc_offre['image']['url']; ?>" alt="<?php echo $bloc_offre['image']['alt']; ?>">
                   <?php if($video_url){ echo '</a>'; } ?>
                    <!--<div class="blend"></div>-->
                </div>
                <div class="col-12 col-md-6 txt">
                    <h2><?php echo $bloc_offre['h2-1']; ?><span><?php echo $bloc_offre['h2-2']; ?></span><?php echo $bloc_offre['h2-3']; ?></h2>
                    <p><?php echo $bloc_offre['p']; ?></p>
                    <?php if($bulletpoints){
        echo '<ul>';
        foreach($bulletpoints as $bulletpoint){
            echo '<li>'. $bulletpoint['bulletpoint'] .'</li>';
        }
        echo '</ul>';
    } ?><br>
                    <a href="<?php echo $bloc_offre['bouton_lien']; ?>">
                        <div value="Contacter la Digital Academy" class="btn btn-blue contact-btn"><?php echo $bloc_offre['bouton_nom']; ?></div>
                    </a>
                </div>
            </div>
        </div>
    </div>    
    <?php } ?>    
    <div class="gray-bg blanckspace"></div>
    <?php } ?>
    <?php $blocs_icone = get_field('blocs_icone');
    if($blocs_icone){ ?>
    <div id="difference" class="">
        <div class="container">
            <div class="row">
                <div class="col-12 alignCenter">
                    <h2><?php if ( get_field( 'titre_blocs_icone_1-3' ) ) {the_field( 'titre_blocs_icone_1-3' );}?><span><?php if ( get_field( 'titre_blocs_icone_2-3' ) ) {the_field( 'titre_blocs_icone_2-3' );}?></span><?php if ( get_field( 'titre_blocs_icone_3-3' ) ) {the_field( 'titre_blocs_icone_3-3' );}?></h2>
                </div>
            </div>
            <div class="row elt">
                <?php foreach($blocs_icone as $bloc_icone){ ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <img src="<?php echo $bloc_icone['image']['url']; ?>" alt="<?php echo $bloc_icone['image']['alt']; ?>">
                    <br><span><?php echo $bloc_icone['texte']; ?></span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php $blocs_solution = get_field('blocs_solution');
    if($blocs_solution){ ?>
    <div class="cards gray-bg" id="business">
        <div class="container">
            <div class="row">
                <?php foreach($blocs_solution as $bloc_solution){
        $bulletpoints = $bloc_solution['bulletpoints']; ?>
                <div class="col-12 col-md-6 bevel">
                    <div class="wrapper">
                        <div class="img-wrapper">
                            <img src="<?php echo $bloc_solution['image']['url']; ?>" alt="<?php echo $bloc_solution['image']['alt']; ?>">
                            <!--                            <div class="blend"></div>-->
                        </div>
                        <h2><?php echo $bloc_solution['h2-1']; ?><span><?php echo $bloc_solution['h2-2']; ?></span><?php echo $bloc_solution['h2-3']; ?></h2>
                        <?php if($bulletpoints){
            echo '<ul>';
            foreach($bulletpoints as $bulletpoint){
                echo '<li>'. $bulletpoint['bulletpoint'] .'</li>';
            }
            echo '</ul>';
        } ?><br>
                        <a value="Contacter la Digital Academy" href="#the-form-bottom" class="btn btn-blue contact-btn" style="height:auto">Contactez-nous</a>
                    </div>
                </div>
                <?php } ?>    
            </div>
        </div>
    </div>
    <?php } ?>
    <?php $references = get_field('references');
    if($references){ ?>
    <div id="ref" class="container">
        <div class="row alignCenter">
            <a value="Voir nos references clients en Digital Learning" href="/type-reference/digital-learning/"><h2><span>Références</span></h2></a>
        </div>
        <div class="row owl-carousel owl-theme">
            <?php foreach($references as $reference){?>
            <div class="item">
                <img src="<?php echo $reference['image']['url']; ?>" alt="<?php echo $reference['image']['alt']; ?>">
            </div>
            <?php } ?>    
        </div>
        <a value="Voir nos references clients en Digital Learning" href="/type-reference/digital-learning/" class="btn btn-blue-alt btn-sm" style="height:auto;display: table;margin:auto;">Toutes nos références</a>
    </div>
    <?php } ?>

    <!-- WP Bakery content-->
    <div class="content"> 
        <div class="container">
            <?php
            if ( have_posts() ) :
            while ( have_posts() ) : the_post();
            the_content();
            endwhile;
            endif;
            ?>
        </div>
    </div>

    <section id="contact">
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
                            <div class="col-12"><span id="the-form-bottom"></span></div>
                            <div class="container form-container">
                                <div class="row">
                                    <?php echo do_shortcode('[gravityform id="9" title="false" description="false" ajax="true"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





</div>
<?php get_footer(); ?>        