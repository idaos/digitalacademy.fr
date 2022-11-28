<?php

/**
 * Block Name: DAC - Barre de recherche d\'une formation
 *
 * This is the template that displays the block.
 */

?>

<form action="<?php echo get_post_type_archive_link('formation'); ?>" class="container alignCenter search-form" method="get">
    <input placeholder="Exemple : Marketing digital" name="q" type="text" class="search-txt ng-pristine ng-untouched ng-valid ng-empty">
    <div class="btn btn-red search-btn" onclick="this.parentElement.submit()">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13">
            <g stroke-width="2" stroke="#fff" fill="none">
                <path d="M11.29 11.71l-4-4"></path>
                <circle cx="5" cy="5" r="4"></circle>
            </g>
        </svg>
    </div>
</form>