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
define( 'EUNI_THEME_VERSION', '2.3.4' );
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
        $page_description = get_theme_mod( 'euni_seo_description', '新しい出会いを生み出し、今ある関係を深める。IT技術で『つながり』を創り、育てる株式会社Euni（ユニ）のコーポレートサイトです。' );
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
 * Get contact type label in Japanese
 */
function euni_get_contact_type_label( $type ) {
    $types = array(
        'general'     => '一般お問い合わせ',
        'recruit'     => '採用について',
        'media'       => '取材・メディア掲載について',
        'partnership' => '事業提携について',
        'other'       => 'その他',
    );
    return isset( $types[ $type ] ) ? $types[ $type ] : $type;
}

/**
 * Verify reCAPTCHA v3 token
 */
function euni_verify_recaptcha( $token ) {
    $secret_key = get_theme_mod( 'euni_recaptcha_secret_key', '' );

    if ( empty( $secret_key ) || empty( $token ) ) {
        return false;
    }

    $response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
        'body' => array(
            'secret'   => $secret_key,
            'response' => $token,
        ),
    ) );

    if ( is_wp_error( $response ) ) {
        return false;
    }

    $response_body = wp_remote_retrieve_body( $response );
    $result = json_decode( $response_body, true );

    // Check if verification was successful and score is above threshold (0.5)
    if ( isset( $result['success'] ) && $result['success'] === true ) {
        if ( isset( $result['score'] ) && $result['score'] >= 0.5 ) {
            return true;
        }
    }

    return false;
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

    // Verify reCAPTCHA if enabled
    $recaptcha_token = isset( $_POST['recaptcha_token'] ) ? sanitize_text_field( $_POST['recaptcha_token'] ) : '';
    $recaptcha_secret = get_theme_mod( 'euni_recaptcha_secret_key', '' );

    if ( ! empty( $recaptcha_secret ) ) {
        if ( ! euni_verify_recaptcha( $recaptcha_token ) ) {
            wp_redirect( add_query_arg( 'contact', 'recaptcha_error', home_url( '/#contact' ) ) );
            exit;
        }
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

    // Get type label
    $type_label = euni_get_contact_type_label( $type );

    // Admin email
    $admin_email = get_theme_mod( 'euni_email', get_option( 'admin_email' ) );

    // 1. Send notification to admin
    $admin_subject = '[Euniコーポレートサイト] ' . esc_html( $name ) . ' 様からお問い合わせ';

    $admin_body = "お問い合わせがありました。\n\n";
    $admin_body .= "■ お名前: " . $name . "\n";
    if ( ! empty( $company ) ) {
        $admin_body .= "■ 会社名: " . $company . "\n";
    }
    $admin_body .= "■ メールアドレス: " . $email . "\n";
    if ( ! empty( $phone ) ) {
        $admin_body .= "■ 電話番号: " . $phone . "\n";
    }
    $admin_body .= "■ お問い合わせ種別: " . $type_label . "\n\n";
    $admin_body .= "■ お問い合わせ内容:\n" . $message . "\n";

    $admin_headers = array(
        'From: ' . get_bloginfo( 'name' ) . ' <' . $admin_email . '>',
        'Reply-To: ' . $email,
    );

    // Send email to admin
    $sent = wp_mail( $admin_email, $admin_subject, $admin_body, $admin_headers );

    // 2. Send auto-reply to user
    if ( $sent ) {
        $user_subject = 'お問い合わせありがとうございます｜株式会社Euni';

        $user_body = $name . " 様\n\n";
        $user_body .= "この度は、株式会社Euniへお問い合わせいただき、誠にありがとうございます。\n\n";
        $user_body .= "以下の内容でお問い合わせを承りました。\n";
        $user_body .= "内容を確認の上、担当者より折り返しご連絡させていただきます。\n\n";
        $user_body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $user_body .= "■ お名前: " . $name . "\n";
        if ( ! empty( $company ) ) {
            $user_body .= "■ 会社名: " . $company . "\n";
        }
        $user_body .= "■ メールアドレス: " . $email . "\n";
        if ( ! empty( $phone ) ) {
            $user_body .= "■ 電話番号: " . $phone . "\n";
        }
        $user_body .= "■ お問い合わせ種別: " . $type_label . "\n\n";
        $user_body .= "■ お問い合わせ内容:\n" . $message . "\n";
        $user_body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $user_body .= "※ このメールは自動送信されています。\n";
        $user_body .= "※ 本メールに心当たりのない方は、お手数ですが削除をお願いいたします。\n\n";
        $user_body .= "――――――――――――――――――――――――――――――――――\n";
        $user_body .= "株式会社Euni（ユニ）\n";
        $user_body .= "〒150-0041 東京都渋谷区神南一丁目１１番地４号 ＦＰＧリンクス神南 5階\n";
        $user_body .= "Email: " . $admin_email . "\n";
        $user_body .= "Website: " . home_url( '/' ) . "\n";
        $user_body .= "――――――――――――――――――――――――――――――――――\n";

        $user_headers = array(
            'From: ' . get_bloginfo( 'name' ) . ' <' . $admin_email . '>',
        );

        wp_mail( $email, $user_subject, $user_body, $user_headers );
    }

    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', home_url( '/#contact' ) ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', home_url( '/#contact' ) ) );
    }
    exit;
}
add_action( 'admin_post_nopriv_euni_contact_form', 'euni_handle_contact_form' );
add_action( 'admin_post_euni_contact_form', 'euni_handle_contact_form' );

/**
 * Auto-create Philosophy page on theme activation
 * テーマ有効化時に「社名に込めた想い」ページを自動作成
 */
function euni_create_philosophy_page() {
    // Check if page already exists
    $page = get_page_by_path( 'philosophy' );
    
    if ( ! $page ) {
        // Create the page
        $page_data = array(
            'post_title'    => '社名に込めた想い',
            'post_content'  => '', // Content is handled by template
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'philosophy',
            'page_template' => 'page-philosophy.php',
        );
        
        wp_insert_post( $page_data );
    }
}
add_action( 'after_switch_theme', 'euni_create_philosophy_page' );
