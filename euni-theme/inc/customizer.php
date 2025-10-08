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
}
add_action( 'customize_register', 'euni_customize_register' );
