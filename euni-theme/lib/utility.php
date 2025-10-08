<?php
/**
 * Utility Functions
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get template part with optional caching
 *
 * @param string      $slug Template slug.
 * @param string|null $name Template name.
 * @param array       $args Arguments to pass to template.
 * @param string      $cache_key Cache key (empty string to disable caching).
 */
function euni_get_template_part( $slug, $name = null, $args = array(), $cache_key = '' ) {
    // Check cache if key is provided
    if ( ! empty( $cache_key ) ) {
        $cached_content = get_transient( 'euni_template_' . $cache_key );
        if ( false !== $cached_content ) {
            echo $cached_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }

    // Start output buffering if caching is enabled
    if ( ! empty( $cache_key ) ) {
        ob_start();
    }

    // Set args
    if ( ! empty( $args ) ) {
        set_query_var( 'template_args', $args );
    }

    // Get template part
    get_template_part( $slug, $name, $args );

    // Cache output if caching is enabled
    if ( ! empty( $cache_key ) ) {
        $content = ob_get_clean();
        set_transient( 'euni_template_' . $cache_key, $content, DAY_IN_SECONDS );
        echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/**
 * Check if current page is top page
 *
 * @return bool
 */
function euni_is_top() {
    return is_front_page() && ! is_paged();
}

/**
 * Get SVG icon
 *
 * @param string $icon Icon name.
 * @param int    $size Icon size.
 * @return string
 */
function euni_get_icon( $icon, $size = 24 ) {
    $icons = array(
        'search' => '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'menu'   => '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'close'  => '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'arrow'  => '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    );

    return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Get reading time
 *
 * @param int|null $post_id Post ID.
 * @return int
 */
function euni_get_reading_time( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $content    = get_post_field( 'post_content', $post_id );
    $word_count = mb_strlen( strip_tags( $content ) );
    $minutes    = ceil( $word_count / 600 ); // 日本語: 約600文字/分

    return max( 1, $minutes );
}

/**
 * Sanitize HTML classes
 *
 * @param string|array $classes Classes to sanitize.
 * @return string
 */
function euni_sanitize_html_classes( $classes ) {
    if ( is_array( $classes ) ) {
        $classes = implode( ' ', $classes );
    }

    return esc_attr( implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $classes ) ) ) );
}

/**
 * Get post views count
 *
 * @param int|null $post_id Post ID.
 * @return int
 */
function euni_get_post_views( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $count = get_post_meta( $post_id, 'euni_post_views', true );
    return $count ? absint( $count ) : 0;
}

/**
 * Set post views count
 *
 * @param int|null $post_id Post ID.
 */
function euni_set_post_views( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $count = euni_get_post_views( $post_id );
    update_post_meta( $post_id, 'euni_post_views', $count + 1 );
}

/**
 * Track post views automatically
 */
function euni_track_post_views() {
    if ( is_single() && ! is_user_logged_in() ) {
        euni_set_post_views();
    }
}
add_action( 'wp_head', 'euni_track_post_views' );

/**
 * Get related posts
 *
 * @param int   $post_id Post ID.
 * @param int   $number Number of posts to retrieve.
 * @param array $args Additional WP_Query arguments.
 * @return WP_Query
 */
function euni_get_related_posts( $post_id = null, $number = 3, $args = array() ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $categories = wp_get_post_categories( $post_id );

    $default_args = array(
        'posts_per_page'      => $number,
        'post__not_in'        => array( $post_id ),
        'category__in'        => $categories,
        'orderby'             => 'rand',
        'ignore_sticky_posts' => true,
    );

    $query_args = wp_parse_args( $args, $default_args );

    return new WP_Query( $query_args );
}

/**
 * Clear template cache
 */
function euni_clear_template_cache() {
    global $wpdb;
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_euni_template_%' OR option_name LIKE '_transient_timeout_euni_template_%'" );
}

/**
 * Clear cache on theme switch or customizer save
 */
add_action( 'switch_theme', 'euni_clear_template_cache' );
add_action( 'customize_save_after', 'euni_clear_template_cache' );
