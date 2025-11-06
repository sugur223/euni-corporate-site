<?php
/**
 * Theme Customizer Settings
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function euni_customize_register( $wp_customize ) {

    // Add Company Information Section
    $wp_customize->add_section(
        'euni_company_info',
        array(
            'title'       => __( '会社情報', 'euni-theme' ),
            'description' => __( '会社概要の情報を設定します。', 'euni-theme' ),
            'priority'    => 30,
        )
    );

    // CEO Name
    $wp_customize->add_setting(
        'euni_ceo_name',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_ceo_name',
        array(
            'label'       => __( '代表取締役', 'euni-theme' ),
            'description' => __( '代表取締役の氏名を入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // Establishment Date
    $wp_customize->add_setting(
        'euni_establishment',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_establishment',
        array(
            'label'       => __( '設立', 'euni-theme' ),
            'description' => __( '設立年月を入力してください（例：2025年1月）。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // Capital
    $wp_customize->add_setting(
        'euni_capital',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_capital',
        array(
            'label'       => __( '資本金', 'euni-theme' ),
            'description' => __( '資本金を入力してください（例：1,000万円）。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // Address
    $wp_customize->add_setting(
        'euni_address',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_address',
        array(
            'label'       => __( '所在地', 'euni-theme' ),
            'description' => __( '会社の所在地を入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'textarea',
        )
    );

    // Email
    $wp_customize->add_setting(
        'euni_email',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_email',
        array(
            'label'       => __( 'メールアドレス', 'euni-theme' ),
            'description' => __( 'お問い合わせ用のメールアドレスを入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'email',
        )
    );

    // Phone
    $wp_customize->add_setting(
        'euni_phone',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_phone',
        array(
            'label'       => __( '電話番号', 'euni-theme' ),
            'description' => __( 'お問い合わせ用の電話番号を入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'tel',
        )
    );

    // reCAPTCHA Site Key
    $wp_customize->add_setting(
        'euni_recaptcha_site_key',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_recaptcha_site_key',
        array(
            'label'       => __( 'reCAPTCHA サイトキー', 'euni-theme' ),
            'description' => __( 'Google reCAPTCHA v3のサイトキーを入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // reCAPTCHA Secret Key
    $wp_customize->add_setting(
        'euni_recaptcha_secret_key',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_recaptcha_secret_key',
        array(
            'label'       => __( 'reCAPTCHA シークレットキー', 'euni-theme' ),
            'description' => __( 'Google reCAPTCHA v3のシークレットキーを入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // Employees
    $wp_customize->add_setting(
        'euni_employees',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_employees',
        array(
            'label'       => __( '従業員数', 'euni-theme' ),
            'description' => __( '従業員数を入力してください（例：10名）。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // Business Hours
    $wp_customize->add_setting(
        'euni_business_hours',
        array(
            'default'           => '平日 10:00 - 18:00',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_business_hours',
        array(
            'label'       => __( '営業時間', 'euni-theme' ),
            'description' => __( '営業時間を入力してください。', 'euni-theme' ),
            'section'     => 'euni_company_info',
            'type'        => 'text',
        )
    );

    // ========================================
    // SEO Settings Section
    // ========================================
    $wp_customize->add_section(
        'euni_seo_settings',
        array(
            'title'       => __( 'SEO設定', 'euni-theme' ),
            'description' => __( 'サイトのSEO関連設定を管理します。', 'euni-theme' ),
            'priority'    => 31,
        )
    );

    // SEO Description
    $wp_customize->add_setting(
        'euni_seo_description',
        array(
            'default'           => 'つながりの中で生きる社会を目指し、成長支援コミュニティ事業、ITソリューション事業、コンサルティング事業を展開する株式会社Euniのコーポレートサイトです。',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_seo_description',
        array(
            'label'       => __( 'サイト説明（メタディスクリプション）', 'euni-theme' ),
            'description' => __( '検索結果に表示される説明文です（120-160文字推奨）。', 'euni-theme' ),
            'section'     => 'euni_seo_settings',
            'type'        => 'textarea',
        )
    );

    // OGP Image
    $wp_customize->add_setting(
        'euni_ogp_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'euni_ogp_image',
            array(
                'label'       => __( 'OGP画像', 'euni-theme' ),
                'description' => __( 'SNSでシェアされた際に表示される画像（1200x630px推奨）。', 'euni-theme' ),
                'section'     => 'euni_seo_settings',
            )
        )
    );

    // Twitter Username
    $wp_customize->add_setting(
        'euni_twitter_username',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_twitter_username',
        array(
            'label'       => __( 'Twitterユーザー名', 'euni-theme' ),
            'description' => __( '@なしで入力（例：euni_inc）', 'euni-theme' ),
            'section'     => 'euni_seo_settings',
            'type'        => 'text',
        )
    );

    // ========================================
    // Social Media Section
    // ========================================
    $wp_customize->add_section(
        'euni_social_media',
        array(
            'title'       => __( 'SNS設定', 'euni-theme' ),
            'description' => __( 'SNSアカウントのURLを設定します。', 'euni-theme' ),
            'priority'    => 32,
        )
    );

    // Facebook URL
    $wp_customize->add_setting(
        'euni_facebook_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_facebook_url',
        array(
            'label'       => __( 'Facebook URL', 'euni-theme' ),
            'section'     => 'euni_social_media',
            'type'        => 'url',
        )
    );

    // Twitter URL
    $wp_customize->add_setting(
        'euni_twitter_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_twitter_url',
        array(
            'label'       => __( 'Twitter (X) URL', 'euni-theme' ),
            'section'     => 'euni_social_media',
            'type'        => 'url',
        )
    );

    // Instagram URL
    $wp_customize->add_setting(
        'euni_instagram_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_instagram_url',
        array(
            'label'       => __( 'Instagram URL', 'euni-theme' ),
            'section'     => 'euni_social_media',
            'type'        => 'url',
        )
    );

    // LinkedIn URL
    $wp_customize->add_setting(
        'euni_linkedin_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_linkedin_url',
        array(
            'label'       => __( 'LinkedIn URL', 'euni-theme' ),
            'section'     => 'euni_social_media',
            'type'        => 'url',
        )
    );

    // ========================================
    // CEO Message Section
    // ========================================
    $wp_customize->add_section(
        'euni_ceo_message',
        array(
            'title'       => __( '代表メッセージ', 'euni-theme' ),
            'description' => __( '代表者のメッセージと写真を設定します。', 'euni-theme' ),
            'priority'    => 33,
        )
    );

    // CEO Photo
    $wp_customize->add_setting(
        'euni_ceo_photo',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'euni_ceo_photo',
            array(
                'label'       => __( '代表者写真', 'euni-theme' ),
                'description' => __( '代表者の写真をアップロードしてください。', 'euni-theme' ),
                'section'     => 'euni_ceo_message',
            )
        )
    );

    // CEO Message
    $wp_customize->add_setting(
        'euni_ceo_message',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_ceo_message',
        array(
            'label'       => __( '代表メッセージ', 'euni-theme' ),
            'description' => __( '代表者のメッセージを入力してください。', 'euni-theme' ),
            'section'     => 'euni_ceo_message',
            'type'        => 'textarea',
        )
    );

    // CEO Career
    $wp_customize->add_setting(
        'euni_ceo_career',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'euni_ceo_career',
        array(
            'label'       => __( '代表者略歴', 'euni-theme' ),
            'description' => __( '代表者の略歴を入力してください。', 'euni-theme' ),
            'section'     => 'euni_ceo_message',
            'type'        => 'textarea',
        )
    );
}
add_action( 'customize_register', 'euni_customize_register' );
