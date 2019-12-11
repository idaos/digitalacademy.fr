<?php get_header(); ?>
<?php 
$url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
if (strpos($_SERVER["REQUEST_URI"], '?')) {

    $url_parameters = explode( '?', $_SERVER["REQUEST_URI"] );
    $url_parameters = $url_parameters[1];
}else{
    $url_parameters = null;
}
?>

<div class="breadcrumb hidden-xs">
    <div class="container">
        <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb();
} ?>
    </div>
</div>

<?php
if ( have_posts() ) :
// Start the Loop.
while ( have_posts() ) : the_post();
$thematic = wp_get_post_terms( get_the_ID(), 'thematique' );
$thematic = reset($thematic);
$thematic_css = get_field( 'couleur', 'thematique_'.$thematic->term_id );
$thematic_css = empty( $thematic_css ) ? '' : ' theme-'.$thematic_css; ?>
<div class="container-slider main-slider slider-header<?php echo esc_attr( $thematic_css ); ?>">
    <div class="slick-slide">
        <h1 class="title-slider"><?php the_title(); ?></h1>
    </div>
</div>
<div class="xs-container-menu-filtre">
    <div class="container-menu-filtre hidden-xs">
        <div class="container">
            <ul>
                <li><a class="btn btn-xs btn-gray" href="#presentation">Présentation</a></li>
                <li><a class="btn btn-xs btn-gray" href="#programme">Programme</a></li>
                <li><a class="btn btn-xs btn-gray" href="#informations">Informations</a></li>
                <li><a class="btn btn-xs btn-gray" href="#Inscription">Dates, lieu &amp; inscription</a></li>
                <li><a class="btn btn-xs btn-gray" href="#objectifs">Objectifs &amp; Témoignages</a></li>
            </ul>
        </div>
    </div>
</div>

<main class="content">
    <div class="container">
        <div class="wrapper">

            <div class="row clearfix border-bold fs20 p1030 display-table">
                <div class="col-sm-3 text-center<?php echo esc_attr( $thematic_css ); ?>">
                    <?php if ( ! empty( $thematic ) && ! empty( $thematic->name ) ) : ?>
                    <p class="big-title">
                        <strong>Thématique : <?php echo esc_html( $thematic->name ); ?></strong>
                    </p>
                    <?php endif;
                    if ( get_field( 'picto' ) ): ?>
                    <img src="<?php the_field( 'picto' ); ?>" alt="" style="max-width: 80px;"/>
                    <?php endif; ?>
                </div>
                <div class="col-sm-9">
                    <?php if ( get_field( 'intro_thematique' ) ): ?>
                    <?php the_field( 'intro_thematique' ); ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="full-width bg-gray fs20 p30" id="presentation">
                <div class="row clearfix">
                    <h2>Présentation</h2>

                    <div class="content-show">
                        <p class="visible-xs toggleplus">+</p>

                        <div class="col-sm-6">
                            <?php if ( get_field( 'visuel_presentation' ) ): ?>
                            <img src="<?php echo the_field( 'visuel_presentation' ); ?>"
                                 alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                            <?php endif; ?>

                            <?php if ( get_field( 'telephone', 'option' ) ): ?>
                            <p class="info-tel">Plus d’infos ? Appelez-nous
                                au  <?php echo get_field( 'telephone', 'option' ); ?></p>
                            <?php endif; ?>

                            <?php if ( get_field( 'fiche_formation' ) ): ?>
                            <a href="<?php the_field( 'fiche_formation' ); ?>" class="info-pdf"
                               target="_blank" rel="nofollow">Télécharger le programme de formation en pdf</a>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <?php if ( get_field( 'presentation' ) ): ?>
                            <?php the_field( 'presentation' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-light fs20 display-table p30" id="programme">
                <h2>Programme</h2>

                <div class="content-show">
                    <p class="visible-xs toggleplus">+</p>

                    <div class="clearfix row">
                        <div class="col-sm-4">
                            <?php if ( get_field( 'programme_1' ) ): ?>
                            <?php the_field( 'programme_1' ); ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-sm-4">
                            <?php if ( get_field( 'programme_2' ) ): ?>
                            <?php the_field( 'programme_2' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-4">
                            <?php if ( get_field( 'programme_3' ) ): ?>
                            <?php the_field( 'programme_3' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="full-width bg-gray fs20 display-table border-light p30" id="informations">
                <div class="clearfix row">
                    <h2>Informations</h2>

                    <div class="content-show">
                        <p class="visible-xs toggleplus">+</p>

                        <div class="col-sm-4 container__orange">
                            <p>
                                <strong>Informations pratiques</strong>
                            </p>
                            <?php if ( get_field( 'informations' ) ): ?>
                            <?php the_field( 'informations' ); ?>
                            <?php endif; ?>
                            <?php if ( get_field( 'prerequis_formation' ) ): ?>
                            <p><strong>Prérequis de la formation</strong></p>
                            <?php the_field( 'prerequis_formation' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-4">
                            <?php if ( get_field( 'pour_qui' ) ): ?>
                            <p><strong>A qui s’adresse cette formation ?</strong></p>
                            <?php the_field( 'pour_qui' ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-4">
                            <p><strong>Formateur(s)</strong></p>

                            <p>L’équipe d’intervenants sera coordonnée par notre équipe pédagogique.</p>

                            <?php if ( $formateurs = wp_get_post_terms( get_the_ID(), 'formateur' ) ): ?>

                            <?php foreach ( $formateurs as $formateur ): ?>

                            <div class="bloc-formateurs">
                                <img
                                     src="<?php the_field( 'avatar', 'formateur_' . $formateur->term_id ); ?>"
                                     alt="" width="100" height="100">

                                <p><strong><?php echo $formateur->name; ?></strong></p>

                                <p><?php the_field( 'specialite', 'formateur_' . $formateur->term_id ); ?></p>
                                <a href="<?php echo get_term_link( $formateur->term_id, 'formateur' ); ?>">Voir
                                    sa fiche</a>
                            </div>

                            <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>


            <div class="border-light fs20 display-table border-light p30" id="Inscription">
                <h2>Inscription</h2>

                <div class="content-show">
                    <p class="visible-xs toggleplus">+</p>

                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="col-sm-11" style="padding-right:0">
                                <p><strong>Découvrez les prochaines dates de la formation «<?php the_title(); ?>
                                    »</strong></p>

                                <p>Si cette formation vous intéresse mais que les dates ne vous conviennent pas,
                                    n’hésitez pas à nous contacter. </p>

                                <div class="content-info">
                                    <img
                                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-infos.jpg"
                                         alt=""/>

                                    <p>Plus d'infos ?</p>

                                    <p class="m250">
                                        <strong><?php echo get_field( 'telephone', 'option' ); ?></strong></p>
                                    <a href="<?php echo get_field( 'page_contact', 'option' ); ?>" onclick="return gtag_report_conversion();"
                                       class="btn btn-red">Nous contacter</a>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="col-sm-8" style="padding-left:0">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-11" style="padding:0">

                                <?php if ( have_rows( 'sessions' ) ): ?>

                                <table class="table-inscription" style="width:100%">
                                    <tr>
                                        <th>Prochaines dates*</th>
                                        <th>Lieu</th>
                                        <th>Inscription</th>
                                    </tr>

                                    <?php while ( have_rows( 'sessions' ) ) : the_row(); ?>
                                    <?php $date_session = strtotime( get_sub_field( 'date_session' ) ) ?>
                                    <?php if ( time() < $date_session ): ?>
                                    <tr>
                                        <td>
                                            <?php echo date_i18n( get_option( 'date_format' ), $date_session ); ?></td>
                                        <td><?php the_sub_field( 'lieu_session' ); ?></td>
                                        <?php if ( get_sub_field( 'ouvert' ) ):
                                        $corps = "Bonjour,\n\n Je souhaiterais me pré-inscrire à la formation " . $post->post_title . ' du ' . date_i18n( get_option( 'date_format' ), strtotime( get_sub_field( 'date_session' ) ) ) . ' à ' . get_sub_field( 'lieu_session' ) . '.';
                                        $url   = '?'. $url_parameters .'&objet=' . urlencode( 'Pré-inscription - ' . $post->post_title ) . '&corps=' . urlencode( $corps ) ;
                                        ?>
                                        <td>
                                            <a href="<?php echo get_field( 'page_contact', 'option' ) . $url ; ?>" 
                                               class="btn btn-xs btn-red">Pré-inscription</a></td>
                                        <?php else: ?>
                                        <td class="indisponible">
                                            <div class="btn btn-xs btn-red">Non disponible</div>
                                        </td>
                                        <?php endif; ?>
                                    </tr>

                                    <?php endif; ?>
                                    <?php endwhile; ?>

                                </table>
                                <small>*Pour les formations sur plusieurs jours, la date correspond au
                                    premier jour de la formation
                                </small>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="full-width bg-gray fs20 display-table border-light p30" id="objectifs">
                <h2>Objectifs</h2>

                <div class="content-show">
                    <p class="visible-xs toggleplus">+</p>

                    <div class="text-center mb50">

                        <?php if ( get_field( 'intro_objectifs' ) ): ?>
                        <?php the_field( 'intro_objectifs' ); ?>
                        <?php endif; ?>

                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">

                            <?php if ( get_field( 'objectifs_1' ) ): ?>
                            <?php the_field( 'objectifs_1' ); ?>
                            <?php endif; ?>

                        </div>
                        <div class="col-sm-6">

                            <?php if ( get_field( 'objectifs_2' ) ): ?>
                            <?php the_field( 'objectifs_2' ); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php if ( $temoignages = get_field( 'temoignages' ) ): ?>

            <div class="fs20 p30">
                <div class="clearfix">
                    <h2>Ce que disent nos clients de la DigitalAcademy©</h2>

                    <div class="content-show">
                        <p class="visible-xs toggleplus">+</p>

                        <p class="text-center">Retrouvez les points de vue des apprenants qui commentent les
                            formats, le contenu, la dynamique et les animations des formateurs
                            DigitalAcademy© sur une grande variété de thématiques. </p>
                        <hr>

                        <?php foreach ( $temoignages as $temoignage ): ?>
                        <div class="container-client">
                            <?php
                            $img_carre = get_field( 'visuel_carre', $temoignage->ID );
                            if ( $img_carre ) {
                                echo wp_get_attachment_image( $img_carre, 'testimony' );
                            } else {
                                echo get_the_post_thumbnail( $temoignage->ID, 'testimony' );
                            }
                            ?>
                            <p class="first">
                                <strong><?php echo $temoignage->post_title; ?></strong>, <?php echo get_field( 'entreprise', $temoignage->ID ); ?>
                            </p>

                            <p>«<?php echo $temoignage->post_content; ?>»</p>

                            <div style="clear:both"></div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <?php endif; ?>


            <?php if ( $types = wp_get_post_terms( get_the_ID(), 'type' ) ): ?>

            <div class="full-width bg-orange content-declinaison">
                <div class="clearfix">
                    <span>Cette formation se décline en :</span>

                    <?php
                    $type_to_page = array(
                        'intra-sur-mesure' => '/solutions/formations-en-entreprise/#intra',
                        'intra'            => null,
                        'inter'            => null,
                        'e-learning'       => '/solutions/digital-learning/',
                        'blended-learning' => '/solutions/formations-en-entreprise/#blended',
                    )
                    ?>

                    <?php foreach ( $types as $type ): ?>
                    <?php if ( $type_to_page[ $type->slug ] ): ?>
                    <a href="<?php echo home_url( $type_to_page[ $type->slug ] ); ?>"
                       class="btn-white"><?php echo $type->name; ?></a>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>

            <?php endif; ?>
        </div>
    </div>

    <section id="slider-formations">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br>
                    <span class="reverse">
                        <h2>Nos formations digitales</h2>
                        <h3>Un catalogue de plus de 30 formations digitales</h3>
                    </span>
                    <p>Les participants à cette formation ont également consulté les formations suivantes :</p>
                    <hr>
                    <?php echo do_shortcode( '[kz_courses_slider nb=-1 taxo="thematique"]' ); ?>
                    <a href="/formations/"><div class="btn btn-red">Découvrir toutes nos formations</div></a>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </section>

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

<?php
endwhile;
endif;
?>

<?php get_footer(); ?>