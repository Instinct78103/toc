<?php

add_action('after_setup_theme', function () {

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => null,
            'width'       => null,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}, 100);

/**
 * Disables the block editor from managing widgets in the Gutenberg plugin.
 */
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

/**
 * Disables the block editor from managing widgets.
 */
add_filter( 'use_widgets_block_editor', '__return_false' );