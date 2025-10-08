<?php
/**
 * Theme Setup
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function euni_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'euni-theme', EUNI_THEME_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );

    // Set default thumbnail size
    set_post_thumbnail_size( 800, 450, true );

    // Add additional image sizes
    add_image_size( 'euni-large', 1200, 675, true );
    add_image_size( 'euni-medium', 600, 400, true );
    add_image_size( 'euni-small', 400, 300, true );

    // Add custom logo support
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 60,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    // Switch default core markup to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add support for responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Gutenberg - Enable wide and full alignment
    add_theme_support( 'align-wide' );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Add support for custom line height
    add_theme_support( 'custom-line-height' );

    // Add support for custom units
    add_theme_support( 'custom-units', 'px', '%', 'em', 'rem', 'vw', 'vh' );

    // Gutenberg color palette
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => __( 'メインカラー', 'euni-theme' ),
                'slug'  => 'primary',
                'color' => '#2563eb',
            ),
            array(
                'name'  => __( 'グラデーション開始', 'euni-theme' ),
                'slug'  => 'gradient-start',
                'color' => '#667eea',
            ),
            array(
                'name'  => __( 'グラデーション終了', 'euni-theme' ),
                'slug'  => 'gradient-end',
                'color' => '#764ba2',
            ),
            array(
                'name'  => __( '背景色（明るい）', 'euni-theme' ),
                'slug'  => 'bg-light',
                'color' => '#f8fafc',
            ),
            array(
                'name'  => __( 'テキスト（濃い）', 'euni-theme' ),
                'slug'  => 'text-dark',
                'color' => '#1e293b',
            ),
            array(
                'name'  => __( 'テキスト（中間）', 'euni-theme' ),
                'slug'  => 'text-medium',
                'color' => '#475569',
            ),
            array(
                'name'  => __( 'テキスト（薄い）', 'euni-theme' ),
                'slug'  => 'text-light',
                'color' => '#64748b',
            ),
            array(
                'name'  => __( '白', 'euni-theme' ),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => __( '黒', 'euni-theme' ),
                'slug'  => 'black',
                'color' => '#000000',
            ),
        )
    );

    // Gutenberg font sizes
    add_theme_support(
        'editor-font-sizes',
        array(
            array(
                'name'      => __( '小', 'euni-theme' ),
                'shortName' => 'S',
                'size'      => 14,
                'slug'      => 'small',
            ),
            array(
                'name'      => __( '標準', 'euni-theme' ),
                'shortName' => 'M',
                'size'      => 16,
                'slug'      => 'normal',
            ),
            array(
                'name'      => __( '中', 'euni-theme' ),
                'shortName' => 'L',
                'size'      => 18,
                'slug'      => 'medium',
            ),
            array(
                'name'      => __( '大', 'euni-theme' ),
                'shortName' => 'XL',
                'size'      => 24,
                'slug'      => 'large',
            ),
            array(
                'name'      => __( '特大', 'euni-theme' ),
                'shortName' => 'XXL',
                'size'      => 32,
                'slug'      => 'huge',
            ),
        )
    );

    // Disable custom colors in block editor
    // add_theme_support( 'disable-custom-colors' );

    // Disable custom font sizes in block editor
    // add_theme_support( 'disable-custom-font-sizes' );

    // Register navigation menus
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'euni-theme' ),
            'footer'  => esc_html__( 'Footer Menu', 'euni-theme' ),
        )
    );

    // Add excerpt support to pages
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'euni_theme_setup' );

/**
 * Set the content width in pixels
 */
function euni_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'euni_content_width', 1200 );
}
add_action( 'after_setup_theme', 'euni_content_width', 0 );
