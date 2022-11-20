<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="widget-title ttl">Vous avez une question ?</div>
                <div class="f">
                    <div>
                        <div class="wp-block-button aligncenter is-style-outline btn-phone"><a class="wp-block-button__link wp-element-button" href="tel:0977235321">09 77 23 53 21</a></div>
                    </div>
                    <div>
                        <div class="wp-block-button aligncenter is-style-outline btn-mail"><a class="wp-block-button__link wp-element-button" href="mailto:contact@digitalacademy.fr">contact@digitalacademy.fr</a></div>
                    </div>
                </div>
                <small>Appel non surtaxé. Du lundi au vendredi de 9h30 à 18h</small>

            </div>
            <div class="col-sm-6">

                <div class="widget-title ttl">Suivez-nous !</div>
                <div class="clearfix social">
                    <a rel="noopener" title="Page Facebook" href="https://www.facebook.com/LaDigitalAcademy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/fb.svg" alt="" /></a>
                    <a rel="noopener" title="Page Twitter" href="https://twitter.com/digital_ac" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/t.svg" alt="" /></a>
                    <a rel="noopener" title="Page LinkedIn" href="https://www.linkedin.com/company/digital-academy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/li.svg" alt="" /></a>
                    <a rel="noopener" title="Chaine Youtube" href="https://www.youtube.com/channel/UCRRym8ZzrDiyAvVbpjaO1_A" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/y.svg" alt="" /></a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php if (is_active_sidebar('footer-1')) {
                    dynamic_sidebar('footer-1');
                } ?>
            </div>
            <div class="col-sm-6">
                <?php if (is_active_sidebar('footer-2')) {
                    dynamic_sidebar('footer-2');
                } ?>
                <p class="adresse">
                    17 rue du Faubourg Montmartre<br>
                    75009 Paris<br>
                    Île-de-France
                </p>
            </div>
        </div>
    </div>
    </div>
</footer><!-- Footer end -->

<div class="footer-bottom">
    <div class="container">

        <div class="col-sm-9">

            <span style="margin-top:.8em; display:block;color:#fff;font-weight:bold; font-style:italic;margin-bottom:1rem">* Donnez vie à l'apprentissage numérique</span>
            <p>La DigitalAcademy est une marque déposée, propriété de la société DigitalAcademy/IDAOS.</p>
            <p>La DigitalAcademy est enregistrée au titre de la formation professionnelle auprès de la DIRECCTE <span class='no-wrap'>n°11 92 17377 92 </span></p>
            <p>Cet enregistrement ne vaut pas agrément de l’Etat. Notre règlement intérieur est accessible <a href="https://www.digitalacademy.fr/wp-content/uploads/2022/05/reglement-interieur-digitalacademy-idaos.pdf"><span>ici</span></a></p>
            <p>La DigitalAcademy est référencée Datadock. La certification Qualiopi nous a été délivrée au titre de nos actions de formation.</p>
            <div>
                <span class="copyright">Copyright DigitalAcademy <?php echo date('Y'); ?></span> <?php echo wp_nav_menu(array('theme_location' => 'bottom', 'container' => false,)); ?>
            </div>
        </div>

        <div class="col-sm-3">
            <img style="margin: 20px auto 0 auto; max-width: 200px;display:block" src="<?php bloginfo('template_url'); ?>/images/datadock-logo.svg" title="Logo Datadock blanc" />
            <img style="margin: 20px auto 0 auto; max-width: 150px;display:block" src="<?php bloginfo('template_url'); ?>/images/logoqualiopi2022.png" title="Logo Qualiopi" />
        </div>
    </div>
</div>

</div>

<?php wp_footer(); ?>
</body>

</html>