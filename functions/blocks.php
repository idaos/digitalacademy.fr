<?php
/*
 * Register Custom Gutenberg Blocks
 * 
 *  -- Available options: -- @see: https://vincentdubroeucq.com/creer-bloc-acf-pro/
 *  -
// $data = acf_register_block_type( array(
//     'name'              => 'hero',                                         // Unique slug for the block
//     'title'             => __( 'Hero block', 'example' ),                  // Diplay title for the block
//     'description'       => __( 'A simple hero block to use as header for a page.', 'example' ), // Optional
//     'category'          => 'layout',                                       // Inserter category
//     'icon'              => 'carrot',                                       // Optional. Custom SVG or dashicon slug.
//     'example'           => 'true',                                         // Determines whether to show an example in the inserter or not
//     'keywords'          => array( __( 'hero', 'example' ), __( 'header', 'example' ) ), // Optional. Useful to find the block in the inserter
//     'post_types'        => array( 'post', 'page' ),                        // Optional. Default posts, pages
//     'mode'              => 'preview',                                      // Optional. Default value of 'preview'
//     'align'             => 'full',                                         // Default alignment. Default empty string
//     'render_template'   => plugin_dir_path( __FILE__ ) . 'hero/block.php', // Path to template file. Default false
//     // 'render_callback'   => 'example_block_markup',                      // Callback function to display the block if you prefer.
//     'enqueue_style'     => plugins_url( '/hero/block.css', __FILE__ ),     // URL to CSS file. Enqueued on both frontend and backend
//     'enqueue_script'    => plugins_url( '/hero/block.js', __FILE__ ),      // URL to JS file. Enqueued on both frontend and backend
//     // 'enqueue_assets'    => 'example_block_assets',                      // Callback to enqueue your scripts
//     'supports'          => array(                                          // Optional. Array of standard editor supports
//         'align'           => array( 'wide', 'full' ),                      // Toolbar alignment supports
//         'anchor'          => true,                                         // Allows for a custom ID.
//         'customClassName' => true,                                         // Allows for a custom CSS class name
//         'mode'            => true,                                         // Allows for toggling between edit/preview modes. Default true.
//         'multiple'        => false,                                        // Allows for multiple instances of the block. Default true.
//     ),
// ) );
 */

add_action('acf/init', 'nvp_register_blocks');
function nvp_register_blocks()
{
    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        acf_register_block_type(array(
            'name'                => 'courses-search-bar',
            'title'               => __('DAC - Barre de recherche d\'une formation'),
            'description'         => __('Barre de recherche d\'une formation'),
            'render_template'     => 'blocks/courses-search-bar/courses-search-bar.php',
            'category'            => 'formatting',
            'icon'                => 'admin-comments',
            'keywords'            => array('dac', 'recherche', 'formation', 'barre', 'search', 'loupe'),
            'mode'            => 'preview',
            'supports'        => [
                'align'            => false,
                'anchor'        => true,
                'customClassName'    => true,
                'jsx'             => true,
            ],
            'enqueue_style' => get_template_directory_uri() . '/blocks/courses-search-bar/courses-search-bar.css',
        ));
        acf_register_block_type(array(
            'name'                => 'courses-slider',
            'title'               => __('DAC - Slider des formations'),
            'description'         => __(''),
            'render_template'     => 'blocks/courses-slider/courses-slider.php',
            'category'            => 'formatting',
            'icon'                => 'admin-comments',
            'keywords'            => array('dac', 'slider', 'formation', 'carrousel', 'carousel'),
            'mode'            => 'preview',
            'supports'        => [
                'align'            => false,
                'anchor'        => true,
                'customClassName'    => true,
                'jsx'             => true,
            ],
            'enqueue_style' => get_template_directory_uri() . '/blocks/courses-slider/courses-slider.css',
        ));
    }
}

