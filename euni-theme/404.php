<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="section">
    <div class="container">
        <div class="error-404" style="text-align: center; padding: 4rem 0;">
            <div style="font-size: 8rem; margin-bottom: 2rem; opacity: 0.5;">😕</div>

            <h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--color-text-dark);">
                <?php esc_html_e( '404', 'euni-theme' ); ?>
            </h1>

            <h2 style="font-size: 1.5rem; margin-bottom: 2rem; color: var(--color-text-medium);">
                <?php esc_html_e( 'ページが見つかりませんでした', 'euni-theme' ); ?>
            </h2>

            <p style="font-size: 1.1rem; color: var(--color-text-light); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                <?php esc_html_e( 'お探しのページは削除されたか、一時的にアクセスできない可能性があります。', 'euni-theme' ); ?>
            </p>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                    <?php esc_html_e( 'トップページへ戻る', 'euni-theme' ); ?>
                </a>

                <?php
                // Get news archive link if the news post type exists
                $news_archive = get_post_type_archive_link( 'news' );
                if ( $news_archive ) :
                    ?>
                    <a href="<?php echo esc_url( $news_archive ); ?>" class="btn btn-outline" style="background-color: transparent; color: var(--color-primary); border: 2px solid var(--color-primary);">
                        <?php esc_html_e( 'ニュース一覧', 'euni-theme' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Search Form -->
            <div style="margin-top: 4rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--color-text-dark);">
                    <?php esc_html_e( 'お探しのページを検索', 'euni-theme' ); ?>
                </h3>
                <?php get_search_form(); ?>
            </div>

            <!-- Helpful Links -->
            <?php
            if ( has_nav_menu( 'primary' ) ) :
                ?>
                <div style="margin-top: 4rem;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.5rem; color: var(--color-text-dark);">
                        <?php esc_html_e( '主要ページへのリンク', 'euni-theme' ); ?>
                    </h3>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'error-404-menu',
                            'container'      => 'nav',
                            'depth'          => 1,
                            'items_wrap'     => '<ul id="%1$s" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem 2rem; list-style: none; margin: 0; padding: 0;">%3$s</ul>',
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>
        </div><!-- .error-404 -->
    </div><!-- .container -->
</div><!-- .section -->

<?php
get_footer();
