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
define( 'EUNI_THEME_VERSION', '2.1.0' );
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

// メニューはheader.phpとfooter.phpに直接記述されているため、
// 動的なメニュー作成処理は不要

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

/**
 * Handle contact form submission
 */
function euni_handle_contact_form() {
    // Check nonce
    if ( ! isset( $_POST['euni_contact_nonce'] ) ||
         ! wp_verify_nonce( $_POST['euni_contact_nonce'], 'euni_contact_form' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize and validate inputs
    $name = sanitize_text_field( $_POST['contact_name'] );
    $company = sanitize_text_field( $_POST['contact_company'] );
    $email = sanitize_email( $_POST['contact_email'] );
    $phone = sanitize_text_field( $_POST['contact_phone'] );
    $type = sanitize_text_field( $_POST['contact_type'] );
    $message = sanitize_textarea_field( $_POST['contact_message'] );

    // Validate required fields
    if ( empty( $name ) || empty( $email ) || empty( $type ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', home_url( '/#contact' ) ) );
        exit;
    }

    // Prepare email
    $to = get_theme_mod( 'euni_email', get_option( 'admin_email' ) );
    $subject = '[Euniコーポレートサイト] ' . esc_html( $name ) . ' 様からお問い合わせ';

    $body = "お問い合わせがありました。\n\n";
    $body .= "■ お名前: " . $name . "\n";
    if ( ! empty( $company ) ) {
        $body .= "■ 会社名: " . $company . "\n";
    }
    $body .= "■ メールアドレス: " . $email . "\n";
    if ( ! empty( $phone ) ) {
        $body .= "■ 電話番号: " . $phone . "\n";
    }
    $body .= "■ お問い合わせ種別: " . $type . "\n\n";
    $body .= "■ お問い合わせ内容:\n" . $message . "\n";

    $headers = array(
        'From: ' . get_bloginfo( 'name' ) . ' <' . $to . '>',
        'Reply-To: ' . $email,
    );

    // Send email
    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', home_url( '/#contact' ) ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', home_url( '/#contact' ) ) );
    }
    exit;
}
add_action( 'admin_post_nopriv_euni_contact_form', 'euni_handle_contact_form' );
add_action( 'admin_post_euni_contact_form', 'euni_handle_contact_form' );
