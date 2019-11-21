
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if (is_active_sidebar('footer-1')) {
    dynamic_sidebar('footer-1');
} ?>
            </div>
            <div class="col-sm-4 hidden-xs">
                <?php if (is_active_sidebar('footer-2')) {
    dynamic_sidebar('footer-2');
} ?>
            </div>
            <div class="col-sm-4">
                <div class="widget-title">Une question ? être rappelé ?</div>
                <p class="infos"><a href="<?php echo get_field('page_contact', 'option'); ?>" class="mail">Par mail</a> OU <a href="tel:<?php echo get_field('telephone', 'option'); ?>" class="tel"><?php echo get_field('telephone', 'option'); ?></a></p>
                <div class="widget-title">Nous suivre</div>
                <div class="clearfix social">
                    <a rel="noopener" title="Page Facebook" href="https://www.facebook.com/LaDigitalAcademy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-fb.png" alt="" /></a>
                    <a rel="noopener" title="Page Twitter" href="https://twitter.com/digital_ac" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-twitter.png" alt="" /></a>
                    <a rel="noopener" title="Page LinkedIn" href="https://www.linkedin.com/company/digital-academy" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-linkedin.png" alt="" /></a>
                    <a rel="noopener" title="Chaine Youtube" href="https://www.youtube.com/channel/UCRRym8ZzrDiyAvVbpjaO1_A" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-youtube.png" alt="" /></a>
                </div>
                <div class="widget-title">Nous trouver</div>
                <div class="footer__map" style="width: 315px; overflow: hidden; height: 200px;">
                <img src="<?php bloginfo('template_url'); ?>/images/map.svg" alt="map" width="400" height="300">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.2419457270594!2d2.3408148156748942!3d48.87266407928891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e3ef369b3f7%3A0xa41e3c92e19a86c!2s17+Rue+du+Faubourg+Montmartre%2C+75009+Paris!5e0!3m2!1sfr!2sfr!4v1547222906549" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                </div>
                <div class="widget-title" style="text-transform:none">DigitalAcademy</div>
                <p class="adresse">
                    17 rue du Faubourg Montmartre<br>
                    75009 Paris<br>
                    Île-de-France
                </p>
            </div>
        </div>
    </div>
</footer><!-- Footer end -->

<div class="footer-bottom">
    <div class="container text-center">
        <p>La DigitalAcademy est une marque déposée, propriété de la société IDAOS, et enregistrée au titre de la formation professionnelle auprès de la DIRECCTE <span class='no-wrap'>n°11 92 17377 92 </span>
            <span style="margin-top:.8em; display:block;">La DigitalAcademy est référencée Datadock.</span><br>
            <img style="margin: 0px 11px;" src="<?php bloginfo('template_url'); ?>/images/datadock_wht.png" title="Logo Datadock blanc"/></p>
            <span style="margin-top:.8em; display:block;color:#fff; font-style:italic;font-weight:100;">* Donnez vie à l'apprentissage numérique.</span>
        <div>
            <span class="copyright">Copyright DigitalAcademy© <?php echo date('Y'); ?></span> <?php echo wp_nav_menu(array('theme_location' => 'bottom', 'container' => false,)); ?>
        </div>
    </div>
</div>

</div>

<?php wp_footer(); ?>
</body>
</html>