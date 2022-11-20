<?php

/**
 * Block Name: DAC - Formulaire de contact
 *
 * This is the template that displays the block.
 */

?>

<?php if (is_admin()) : ?>

    <div class="gutenberg-placeholder">
        <h3>Formulaire de contact</h3>
    </div>

<?php else : ?>

    <section id="contact"><span id="contact-anchor"></span>
        <div d="form-bottom">
            <div class="container form-container">
                <div id="contact-form" class="row">
                    <?php echo do_shortcode('[gravityform id="11" title="false" description="false" ajax="true"]'); ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>