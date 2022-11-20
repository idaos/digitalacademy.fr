<?php

/**
 * Block Name: DAC - Formulaire d\'insription à la newsletter
 *
 * This is the template that displays the block.
 */

?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Formulaire d'inscription à la newsletter</h3>
    </div>

<?php else : ?>

    <div id="newsletter-form">
        <div class="heading">Inscrivez-vous à nos newsletters !</div>
        <?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
    </div>

<?php endif; ?>