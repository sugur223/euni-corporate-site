<?php
/**
 * Check Environment
 * Checks if the environment meets the theme requirements
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Required PHP version
if ( version_compare( phpversion(), '8.0.0', '<' ) ) {
    $GLOBALS['euni_env_err_text'] = sprintf(
        /* translators: %s: Current PHP version */
        __( 'お使いのPHPバージョン(%s)がEuniテーマの必要動作環境を満たしていません。PHPバージョン8.0.0以上へ更新してください。', 'euni-theme' ),
        phpversion()
    );
}

// Required WordPress version
if ( version_compare( get_bloginfo( 'version' ), '6.0', '<' ) ) {
    $GLOBALS['euni_env_err_text'] = sprintf(
        /* translators: %s: Current WordPress version */
        __( 'お使いのWordPressバージョン(%s)がEuniテーマの必要動作環境を満たしていません。WordPressバージョン6.0以上へ更新してください。', 'euni-theme' ),
        get_bloginfo( 'version' )
    );
}

// Display admin notice if environment check fails
if ( isset( $GLOBALS['euni_env_err_text'] ) ) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="notice notice-error"><p>' . wp_kses_post( $GLOBALS['euni_env_err_text'] ) . '</p></div>';
        }
    );

    // Also display in theme customizer
    add_action(
        'customize_controls_print_styles',
        function () {
            echo '<style>.wp-full-overlay-sidebar-content::before { content: "' . esc_js( $GLOBALS['euni_env_err_text'] ) . '"; display: block; padding: 20px; background: #dc3232; color: #fff; font-weight: bold; }</style>';
        }
    );
}
