<?php
add_theme_support( 'align-wide' );

/**
 * Enqueue block editor style
 */
function mytheme_block_editor_styles() {
    wp_enqueue_style( 'mytheme-block-editor-styles', get_theme_file_uri( '/inc/style-gutenberg.css' ), false, '1.0', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'mytheme_block_editor_styles' );

?>