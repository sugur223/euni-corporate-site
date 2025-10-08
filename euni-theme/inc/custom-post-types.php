<?php
/**
 * Register Custom Post Types
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register News (ニュース) custom post type
 */
function euni_register_news_post_type() {
    $labels = array(
        'name'                  => _x( 'ニュース', 'Post type general name', 'euni-theme' ),
        'singular_name'         => _x( 'ニュース', 'Post type singular name', 'euni-theme' ),
        'menu_name'             => _x( 'ニュース', 'Admin Menu text', 'euni-theme' ),
        'name_admin_bar'        => _x( 'ニュース', 'Add New on Toolbar', 'euni-theme' ),
        'add_new'               => __( '新規追加', 'euni-theme' ),
        'add_new_item'          => __( '新規ニュースを追加', 'euni-theme' ),
        'new_item'              => __( '新規ニュース', 'euni-theme' ),
        'edit_item'             => __( 'ニュースを編集', 'euni-theme' ),
        'view_item'             => __( 'ニュースを表示', 'euni-theme' ),
        'all_items'             => __( 'すべてのニュース', 'euni-theme' ),
        'search_items'          => __( 'ニュースを検索', 'euni-theme' ),
        'parent_item_colon'     => __( '親ニュース:', 'euni-theme' ),
        'not_found'             => __( 'ニュースが見つかりませんでした。', 'euni-theme' ),
        'not_found_in_trash'    => __( 'ゴミ箱にニュースはありません。', 'euni-theme' ),
        'featured_image'        => _x( 'アイキャッチ画像', 'Overrides the "Featured Image" phrase', 'euni-theme' ),
        'set_featured_image'    => _x( 'アイキャッチ画像を設定', 'Overrides the "Set featured image" phrase', 'euni-theme' ),
        'remove_featured_image' => _x( 'アイキャッチ画像を削除', 'Overrides the "Remove featured image" phrase', 'euni-theme' ),
        'use_featured_image'    => _x( 'アイキャッチ画像として使用', 'Overrides the "Use as featured image" phrase', 'euni-theme' ),
        'archives'              => _x( 'ニュースアーカイブ', 'The post type archive label used in nav menus', 'euni-theme' ),
        'insert_into_item'      => _x( 'ニュースに挿入', 'Overrides the "Insert into post"/"Insert into page" phrase', 'euni-theme' ),
        'uploaded_to_this_item' => _x( 'このニュースにアップロード', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'euni-theme' ),
        'filter_items_list'     => _x( 'ニュースリストを絞り込み', 'Screen reader text for the filter links', 'euni-theme' ),
        'items_list_navigation' => _x( 'ニュースリストナビゲーション', 'Screen reader text for the pagination', 'euni-theme' ),
        'items_list'            => _x( 'ニュースリスト', 'Screen reader text for the items list', 'euni-theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'news' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'news', $args );
}
add_action( 'init', 'euni_register_news_post_type' );

/**
 * Flush rewrite rules on theme activation
 */
function euni_rewrite_flush() {
    euni_register_news_post_type();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'euni_rewrite_flush' );
