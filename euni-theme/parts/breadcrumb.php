<?php
/**
 * Breadcrumb Navigation
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't show breadcrumbs on front page
if ( is_front_page() ) {
    return;
}

$breadcrumbs = array();

// Home link
$breadcrumbs[] = array(
    'url'   => home_url( '/' ),
    'title' => __( 'ホーム', 'euni-theme' ),
);

// Add hierarchy based on page type
if ( is_single() ) {
    // Single post
    $post_type = get_post_type();

    if ( 'post' === $post_type ) {
        // Blog post
        if ( get_option( 'page_for_posts' ) ) {
            $breadcrumbs[] = array(
                'url'   => get_permalink( get_option( 'page_for_posts' ) ),
                'title' => get_the_title( get_option( 'page_for_posts' ) ),
            );
        }

        // Categories
        $categories = get_the_category();
        if ( $categories ) {
            $category       = $categories[0];
            $breadcrumbs[] = array(
                'url'   => get_category_link( $category->term_id ),
                'title' => $category->name,
            );
        }
    } elseif ( 'news' === $post_type ) {
        // News post
        $archive_link = get_post_type_archive_link( 'news' );
        if ( $archive_link ) {
            $breadcrumbs[] = array(
                'url'   => $archive_link,
                'title' => __( 'ニュース', 'euni-theme' ),
            );
        }
    }

    // Current post
    $breadcrumbs[] = array(
        'title' => get_the_title(),
    );
} elseif ( is_page() ) {
    // Page hierarchy
    $post       = get_post();
    $ancestors = array_reverse( get_post_ancestors( $post->ID ) );

    foreach ( $ancestors as $ancestor ) {
        $breadcrumbs[] = array(
            'url'   => get_permalink( $ancestor ),
            'title' => get_the_title( $ancestor ),
        );
    }

    // Current page
    $breadcrumbs[] = array(
        'title' => get_the_title(),
    );
} elseif ( is_category() ) {
    // Category archive
    $category = get_queried_object();

    // Parent categories
    if ( $category->parent ) {
        $ancestors = array_reverse( get_ancestors( $category->term_id, 'category' ) );
        foreach ( $ancestors as $ancestor ) {
            $ancestor_cat  = get_category( $ancestor );
            $breadcrumbs[] = array(
                'url'   => get_category_link( $ancestor ),
                'title' => $ancestor_cat->name,
            );
        }
    }

    // Current category
    $breadcrumbs[] = array(
        'title' => $category->name,
    );
} elseif ( is_post_type_archive( 'news' ) ) {
    // News archive
    $breadcrumbs[] = array(
        'title' => __( 'ニュース', 'euni-theme' ),
    );
} elseif ( is_archive() ) {
    // Other archives
    $breadcrumbs[] = array(
        'title' => get_the_archive_title(),
    );
} elseif ( is_search() ) {
    // Search results
    $breadcrumbs[] = array(
        'title' => sprintf( __( '「%s」の検索結果', 'euni-theme' ), get_search_query() ),
    );
} elseif ( is_404() ) {
    // 404 page
    $breadcrumbs[] = array(
        'title' => __( 'ページが見つかりません', 'euni-theme' ),
    );
}

// Output breadcrumbs
if ( ! empty( $breadcrumbs ) ) :
    ?>
    <nav class="breadcrumb-navigation" aria-label="<?php esc_attr_e( 'パンくずリスト', 'euni-theme' ); ?>">
        <div class="container">
            <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
                <?php
                foreach ( $breadcrumbs as $index => $crumb ) :
                    $position = $index + 1;
                    ?>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <?php if ( ! empty( $crumb['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $crumb['url'] ); ?>" itemprop="item">
                                <span itemprop="name"><?php echo esc_html( $crumb['title'] ); ?></span>
                            </a>
                        <?php else : ?>
                            <span itemprop="name"><?php echo esc_html( $crumb['title'] ); ?></span>
                        <?php endif; ?>
                        <meta itemprop="position" content="<?php echo esc_attr( $position ); ?>" />
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </nav>

    <style>
    .breadcrumb-navigation {
        background-color: var(--color-bg-light, #f8fafc);
        padding: 1rem 0;
        font-size: 0.875rem;
    }

    .breadcrumb-list {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
    }

    .breadcrumb-item:not(:last-child)::after {
        content: '›';
        margin-left: 0.5rem;
        color: var(--color-text-light, #64748b);
    }

    .breadcrumb-item a {
        color: var(--color-text-medium, #475569);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--color-primary, #2563eb);
    }

    .breadcrumb-item:last-child span {
        color: var(--color-text-dark, #1e293b);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .breadcrumb-navigation {
            font-size: 0.75rem;
        }
    }
    </style>
    <?php
endif;
