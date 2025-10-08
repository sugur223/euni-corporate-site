<?php
/**
 * Euni Theme Functions
 *
 * @package Euni_Theme
 * @version 2.0.0
 * @link https://euni.co.jp
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'EUNI_THEME_VERSION', '2.0.0' );
define( 'EUNI_THEME_DIR', get_template_directory() );
define( 'EUNI_THEME_URI', get_template_directory_uri() );

/**
 * Check environment requirements
 */
require_once EUNI_THEME_DIR . '/lib/check_environment.php';

/**
 * Theme setup
 */
require_once EUNI_THEME_DIR . '/lib/theme_setup.php';

/**
 * Register widget areas
 */
function euni_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area', 'euni-theme' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Widgets in this area will be shown in the footer.', 'euni-theme' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'euni_widgets_init' );

/**
 * Remove Content Security Policy headers that block JavaScript
 */
function euni_remove_csp_headers() {
    if ( ! is_admin() ) {
        header_remove( 'Content-Security-Policy' );
        header_remove( 'X-Content-Security-Policy' );
        header_remove( 'X-WebKit-CSP' );
    }
}
add_action( 'send_headers', 'euni_remove_csp_headers' );

/**
 * Create default navigation menu
 */
function euni_create_default_menu() {
    // Check if already created
    if ( get_option( 'euni_default_menu_created' ) ) {
        return;
    }

    // Check if menu already exists
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Add menu items
        $menu_items = array(
            array(
                'title' => '企業理念',
                'url'   => '#philosophy',
            ),
            array(
                'title' => '事業内容',
                'url'   => '#service',
            ),
            array(
                'title' => '参加者の声',
                'url'   => '#voice',
            ),
            array(
                'title' => '選ばれる理由',
                'url'   => '#features',
            ),
            array(
                'title' => 'よくある質問',
                'url'   => '#faq',
            ),
            array(
                'title' => 'お問い合わせ',
                'url'   => '#contact',
            ),
        );

        foreach ( $menu_items as $item ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'   => $item['title'],
                'menu-item-url'     => home_url( '/' ) . $item['url'],
                'menu-item-status'  => 'publish',
                'menu-item-type'    => 'custom',
            ) );
        }

        // Assign menu to location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );

        // Mark as created
        update_option( 'euni_default_menu_created', true );
    }
}
add_action( 'init', 'euni_create_default_menu' );

/**
 * Include core files
 */
require_once EUNI_THEME_DIR . '/inc/enqueue-scripts.php';
require_once EUNI_THEME_DIR . '/inc/custom-post-types.php';
require_once EUNI_THEME_DIR . '/inc/customizer.php';

/**
 * Include library files
 */
require_once EUNI_THEME_DIR . '/lib/utility.php';
require_once EUNI_THEME_DIR . '/lib/shortcode.php';
