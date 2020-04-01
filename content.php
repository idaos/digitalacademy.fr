<div class="container">
    <?php the_content(); ?>
    <div class="full-width bg-orange">
        <p class="clearfix"><span class="m-100">Découvrez la liste complète de nos formations</span> <a href="<?php echo get_field('page_demande_catalogue', 'option'); ?>" class="btn-white">Demander le catalogue</a></p>
    </div>
    <div class="wrapper text-center">
        <h3>Des formations au digital, des solutions pour votre entreprise</h3>
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formations-entreprise.jpg" class="hidden-xs" alt="Formations en entreprise | Digital Academy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formations-entreprise-mobile.jpg" class="visible-xs" alt="Formations en entreprise | Digital Academy" />
                <div class="content-block">
                    <h3>Formations en entreprise</h3>
                    <p class="sub-title">Formations Intra entreprise Blended learning</p>
                    <a href="#" class="btn-gray">En savoir plus</a>
                </div>
            </div>
            <div class="col-sm-3">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital-leadership.jpg" class="hidden-xs" alt="Digital leadership | Digital Academy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital-leadership-mobile.jpg" class="visible-xs" alt="Digital leadership | Digital Academy" />
                <div class="content-block">
                    <h3>Digital leadership</h3>
                    <p class="sub-title">Accompagnement dirigeants Transformation digitale Mentoring, Webtour</p>
                    <a href="#" class="btn-gray">En savoir plus</a>
                </div>
            </div>
            <div class="col-sm-3">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital-learning.jpg" class="hidden-xs" alt="Digital learning | Digital Academy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital-learning-mobile.jpg" class="visible-xs" alt="Digital learning | Digital Academy" />
                <div class="content-block">
                    <h3>Digital learning</h3>
                    <p class="sub-title">Formation à distance E-learning Serious gaming & training</p>
                    <a href="#" class="btn-gray">En savoir plus</a>
                </div>
            </div>
            <div class="col-sm-3">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/transformation-digitale.jpg" class="hidden-xs" alt="Transformation digitale | Digital Academy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/transformation-digitale-mobile.jpg" class="visible-xs" alt="Transformation digitale | Digital Academy" />
                <div class="content-block">
                    <h3>Transformation digitale</h3>
                    <p class="sub-title">Nous déployons notre expertise dans vos locaux</p>
                    <a href="#" class="btn-gray">En savoir plus</a>
                </div>
            </div>
        </div>
        <hr>
        <p class="top-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
        <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet,
            consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </div>
    <?php get_template_part( 'tpl/cta', 'contact' ); ?>
    <div class="wrapper text-center container-reference">
        <h3>Nos références clients en formation</h3>
        <div class="container-slider slide-logo clearfix">
            <div class="slick-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-barclays.jpg" alt="" />
            </div>
            <div class="slick-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-la-poste.jpg" alt="" />
            </div>
            <div class="slick-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-systeme-u.jpg" alt="" />
            </div>
            <div class="slick-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-pernod-ricard.jpg" alt="" />
            </div>
            <div class="slick-slide">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-groupm.jpg" alt="" />
            </div>
            <button type="button" data-role="none" class="slick-prev" aria-label="previous" style="display: inline-block;">Previous</button>
            <button type="button" data-role="none" class="slick-next" aria-label="previous" style="display: inline-block;">Next</button>
            <ul class="slick-dots" style="display: block;"></ul>
        </div>
    </div>
    <div class="full-width bg-gray">
        <h3>Nos TOP formations digitales</h3>
        <div class="row">
            <div class="container-slider slide-formations">
                <div class="slick-slide equal-height-column">
                    <div class="container-bg-white clearfix">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formation-commerciale.jpg" alt="" />
                        <div class="content-bg-white">
                            <h4>Formation booster son activité commerciale avec linkedin & viadeo</h4>
                            <p>Trouvez des clients et fidélisez-les sur LinkedIn & Viadeo.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn-gray">En savoir plus</a>
                    </div>
                </div>
                <div class="slick-slide equal-height-column">
                    <div class="container-bg-white clearfix">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formation-sociale.jpg" alt="" />
                        <div class="content-bg-white">
                            <h4>Formation Maîtriser les fondamentaux des médias sociaux : panorama général </h4>
                            <p>Trouvez des clients et fidélisez-les sur LinkedIn & Viadeo.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn-gray">En savoir plus</a>
                    </div>
                </div>
                <div class="slick-slide equal-height-column">
                    <div class="container-bg-white clearfix">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formation-strategie.jpg" alt="" />
                        <div class="content-bg-white">
                            <h4>Formation Twitter au service de sa stratégie d’influence - Niveau perfectionnement</h4>
                            <p>Trouvez des clients et fidélisez-les sur LinkedIn & Viadeo.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn-gray">En savoir plus</a>
                    </div>
                </div>
                <div class="slick-slide equal-height-column">
                    <div class="container-bg-white clearfix">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/formation-soe.jpg" alt="" />
                        <div class="content-bg-white">
                            <h4>Formation Optimiser son référencement naturel sur Google : SEO</h4>
                            <p>Trouvez des clients et fidélisez-les sur LinkedIn & Viadeo.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn-gray">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
        <p>Plus de 30 formations pour s’approprier la Communication Digitale de A à Z !</p>
        <a href="#" class="btn-border-orange">Voir toutes nos formations</a>
    </div>
    <div class="full-width bg-orange">
        <p class="clearfix"><span class="m-100">Restez informé sur nos formations digitales</span> <a href="#" class="btn-white">S’inscrire à la newsletter</a></p>
    </div>
</div>