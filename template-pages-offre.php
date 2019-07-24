<?php
/*
Template Name: Page Offre
*/
get_header(); 


$color1 = get_field( 'color1');
$color2 = get_field( 'color2');

?>

<style>
    h2 > span{color: rgb(<?php echo $color1; ?>);}
    .button{background: rgb(<?php echo $color1; ?>); outline: solid 2px rgb(<?php echo $color1; ?>); }
    .button:hover{color: rgb(<?php echo $color1; ?>);}
    .button-invert{outline: solid 2px rgb(<?php echo $color1; ?>); color: rgb(<?php echo $color1; ?>);}
    .button-invert:hover{background: rgb(<?php echo $color1; ?>);}
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
    #heading2 .button:hover{color: rgb(<?php echo $color1; ?>);}
    #business li:before, .offre li:before{background-color: rgb(<?php echo $color1; ?>);}
</style>


<div id="heading2">
    <?php $heading_img = get_field('page-header-image'); ?>
    <img src="<?php echo $heading_img['url']; ?>" alt="<?php echo $heading_img['alt']; ?>">
    <div class="blend"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?php if ( get_field( 'page-header-h1' ) ) {the_field( 'page-header-h1' );}?></h1>
                <p><?php if ( get_field( 'page-header-sous-titre' ) ) {the_field( 'page-header-sous-titre' );}?></p>
                <a href="<?php if ( get_field( 'page-header-btn-link' ) ) {the_field( 'page-header-btn-link' );}?>">
                    <div class="button">
                        <?php if ( get_field( 'page-header-btn-name' ) ) {the_field( 'page-header-btn-name' );}?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="baseline"><?php if ( get_field( 'page-header-baseline' ) ) {the_field( 'page-header-baseline' );}?></div>

<?php $blocs_offre = get_field('blocs_offre');
if($blocs_offre){ ?>
<div class="gray-bg blanckspace"></div>
<?php foreach($blocs_offre as $bloc_offre){
$bulletpoints = $bloc_offre['bulletpoints']; ?>
<div class="offre-wrapper gray-bg">
    <div class="container offre">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-12 col-md-6">
                <img src="<?php echo $bloc_offre['image']['url']; ?>" alt="<?php echo $bloc_offre['image']['alt']; ?>">
                <div class="blend"></div>
            </div>
            <div class="col-12 col-md-6 txt">
                <h2><?php echo $bloc_offre['h2-1']; ?><span class="noWrap"><?php echo $bloc_offre['h2-2']; ?></span><?php echo $bloc_offre['h2-3']; ?></h2>
                <p><?php echo $bloc_offre['p']; ?></p>
                <?php if($bulletpoints){
                    echo '<ul>';
                    foreach($bulletpoints as $bulletpoint){
                        echo '<li>'. $bulletpoint['bulletpoint'] .'</li>';
                    }
                    echo '</ul>';
                } ?><br>
                <a href="<?php echo $bloc_offre['bouton_lien']; ?>">
                    <div class="button"><?php echo $bloc_offre['bouton_nom']; ?></div>
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
                        <div class="blend"></div>
                    </div>
                    <h2><?php echo $bloc_solution['h2-1']; ?><span class="noWrap"><?php echo $bloc_solution['h2-2']; ?></span><?php echo $bloc_solution['h2-3']; ?></h2>
                <?php if($bulletpoints){
                    echo '<ul>';
                    foreach($bulletpoints as $bulletpoint){
                        echo '<li>'. $bulletpoint['bulletpoint'] .'</li>';
                    }
                    echo '</ul>';
                } ?><br>
                    <a href="#form-bottom">
                        <div class="button">Contactez-nous</div>
                    </a>
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
        <h2><span>Références</span></h2>
    </div>
    <div class="row owl-carousel owl-theme">
<?php foreach($references as $reference){?>
        <div class="item">
            <img src="<?php echo $reference['image']['url']; ?>" alt="<?php echo $reference['image']['alt']; ?>">
        </div>
<?php } ?>    
    </div>
</div>
<?php } ?>


<div id="contact" >
    <div class="container">
        <div class="row">
            <div class=" col-12 valign">
                <div class="container">
                    <div class="row alignCenter">
                        <span><img id="logo_dac" src="https://www.digitalacademy.fr/wp-content/themes/digitalacademy/images/Digital-Academy-logo-vector-min.svg" width="150" alt="Logo Digital Academy"></span>
                        <b>Nos conseillers vous répondent au :</b>
                        <span id="phone"><a href="tel:0977215321">09 77 21 53 21</a></span>
                        <i>appel non surtaxé <br>du lundi au vendredi de 9h30 à 18h</i><br><br><br>&nbsp;
                    </div>
                </div>
            </div>
            <div class="col-12 valign" id="form-bottom" action="#">
                <div class="col-12 form-header">Contactez-nous !</div>
                <div class="form-container">
                    <?php $formID = get_field('formulaire_id'); ?>
                    <?php echo do_shortcode('[gravityform id="'.$formID.'" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>        