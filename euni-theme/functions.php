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
 * Add SEO meta tags, OGP, and structured data
 */
function euni_add_seo_meta_tags() {
    // Get site information
    $site_name = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description' );
    $site_url = home_url( '/' );

    // Get page-specific information
    if ( is_front_page() ) {
        $page_title = $site_name . ' | ' . $site_description;
        $page_description = get_theme_mod( 'euni_seo_description', 'つながりの中で生きる社会を目指し、成長支援コミュニティ事業、ITソリューション事業、コンサルティング事業を展開する株式会社Euniのコーポレートサイトです。' );
        $page_url = $site_url;
        $page_type = 'website';
    } else {
        $page_title = wp_get_document_title();
        $page_description = has_excerpt() ? get_the_excerpt() : $site_description;
        $page_url = get_permalink();
        $page_type = 'article';
    }

    // Get OGP image
    $ogp_image = get_theme_mod( 'euni_ogp_image', get_template_directory_uri() . '/assets/images/ogp-default.jpg' );
    if ( has_post_thumbnail() ) {
        $ogp_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    }

    // Twitter username
    $twitter_username = get_theme_mod( 'euni_twitter_username', '' );
    ?>

    <!-- Meta Description -->
    <meta name="description" content="<?php echo esc_attr( $page_description ); ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url( $page_url ); ?>">

    <!-- Open Graph Protocol (OGP) -->
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $page_type ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $page_url ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $ogp_image ); ?>">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $page_description ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $ogp_image ); ?>">
    <?php if ( $twitter_username ) : ?>
    <meta name="twitter:site" content="@<?php echo esc_attr( $twitter_username ); ?>">
    <?php endif; ?>

    <?php
    // Add structured data (JSON-LD) only on front page
    if ( is_front_page() ) {
        euni_add_structured_data();
    }
}
add_action( 'wp_head', 'euni_add_seo_meta_tags' );

/**
 * Add structured data (JSON-LD) for Organization
 */
function euni_add_structured_data() {
    $site_name = get_bloginfo( 'name' );
    $site_url = home_url( '/' );
    $logo_url = get_theme_mod( 'custom_logo' )
        ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' )
        : get_template_directory_uri() . '/assets/images/logo.png';

    $structured_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $site_name,
        'alternateName' => 'Euni Inc.',
        'url' => $site_url,
        'logo' => $logo_url,
        'description' => get_theme_mod( 'euni_seo_description', 'つながりの中で生きる社会を目指し、成長支援コミュニティ事業、ITソリューション事業、コンサルティング事業を展開する企業です。' ),
        'foundingDate' => get_theme_mod( 'euni_establishment', '2025-11' ),
        'sameAs' => array_filter( array(
            get_theme_mod( 'euni_facebook_url', '' ),
            get_theme_mod( 'euni_twitter_url', '' ),
            get_theme_mod( 'euni_instagram_url', '' ),
            get_theme_mod( 'euni_linkedin_url', '' ),
        ) ),
    );

    // Add address if available
    if ( get_theme_mod( 'euni_address' ) ) {
        $structured_data['address'] = array(
            '@type' => 'PostalAddress',
            'addressCountry' => 'JP',
            'addressLocality' => '東京都',
            'streetAddress' => get_theme_mod( 'euni_address', '' ),
        );
    }

    // Add contact point if email is available
    if ( get_theme_mod( 'euni_email' ) ) {
        $structured_data['contactPoint'] = array(
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'email' => get_theme_mod( 'euni_email', '' ),
        );

        // Add telephone if available
        if ( get_theme_mod( 'euni_phone' ) ) {
            $structured_data['contactPoint']['telephone'] = get_theme_mod( 'euni_phone', '' );
        }
    }

    ?>
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    <?php echo wp_json_encode( $structured_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
    </script>
    <?php
}

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
