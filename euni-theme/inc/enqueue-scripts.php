<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue frontend scripts and styles
 */
function euni_enqueue_scripts() {
    // Enqueue SWELL base styles (copied from SWELL theme)
    wp_enqueue_style(
        'euni-swell-base',
        EUNI_THEME_URI . '/assets/css/main-swell.css',
        array(),
        EUNI_THEME_VERSION
    );

    // Enqueue Euni custom styles (overrides and additions)
    wp_enqueue_style(
        'euni-custom-style',
        EUNI_THEME_URI . '/assets/css/euni-custom.css',
        array( 'euni-swell-base' ),
        EUNI_THEME_VERSION
    );

    // Enqueue main JavaScript
    wp_enqueue_script(
        'euni-main-script',
        EUNI_THEME_URI . '/assets/js/main.js',
        array(),
        EUNI_THEME_VERSION,
        true
    );

    // Add inline script for AJAX URL
    wp_localize_script(
        'euni-main-script',
        'euniTheme',
        array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'euni-theme-nonce' ),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'euni_enqueue_scripts' );
