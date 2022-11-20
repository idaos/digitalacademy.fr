<?php

/**
 * Block Name: DAC - Formulaire de rappel téléphonique
 *
 * This is the template that displays the block.
 */

?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Formulaire de rappel téléphonique</h3>
    </div>

<?php else : ?>

    <div id="callback-form">
        <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true"]'); ?>
    </div>

<?php endif; ?>