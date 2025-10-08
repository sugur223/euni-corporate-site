<?php
/**
 * Template for displaying archive pages (News listing)
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Breadcrumb -->
<?php get_template_part( 'parts/breadcrumb' ); ?>

<div class="section">
    <div class="container">
        <header class="page-header" style="margin-bottom: 3rem; text-align: center;">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description" style="color: var(--color-text-light); margin-top: 1rem;">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>

            <div class="news-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-item' ); ?>>
                        <a href="<?php the_permalink(); ?>" style="display: block; color: inherit;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="news-thumbnail-wrapper">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'news-thumbnail' ) ); ?>
                                </div>
                            <?php else : ?>
                                <div class="news-thumbnail-wrapper">
                                    <div class="news-thumbnail" style="background: linear-gradient(135deg, var(--color-gradient-start) 0%, var(--color-gradient-end) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                        📰
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="news-content">
                                <div class="news-date">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                </div>

                                <h2 class="news-title">
                                    <?php the_title(); ?>
                                </h2>

                                <?php if ( has_excerpt() ) : ?>
                                    <div class="news-excerpt">
                                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="news-excerpt">
                                        <?php echo wp_trim_words( get_the_content(), 20, '...' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                // Display categories
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) :
                                    ?>
                                    <div class="news-categories" style="margin-top: 1rem;">
                                        <?php
                                        foreach ( $categories as $category ) :
                                            ?>
                                            <span style="display: inline-block; background-color: var(--color-bg-light); color: var(--color-primary); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; margin-right: 0.5rem;">
                                                <?php echo esc_html( $category->name ); ?>
                                            </span>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div><!-- .news-content -->
                        </a>
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                endwhile;
                ?>
            </div><!-- .news-grid -->

            <?php
            // Pagination
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; 前へ', 'euni-theme' ),
                    'next_text' => __( '次へ &raquo;', 'euni-theme' ),
                    'class'     => 'pagination',
                )
            );

        else :
            ?>

            <div class="no-results" style="text-align: center; padding: 4rem 0;">
                <h2 style="font-size: 2rem; margin-bottom: 1rem;"><?php esc_html_e( 'ニュースが見つかりませんでした', 'euni-theme' ); ?></h2>
                <p style="color: var(--color-text-light);">
                    <?php esc_html_e( '現在表示できるニュースはありません。', 'euni-theme' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="margin-top: 2rem; display: inline-block; background-color: var(--color-primary); color: white;">
                    <?php esc_html_e( 'トップページへ戻る', 'euni-theme' ); ?>
                </a>
            </div><!-- .no-results -->

            <?php
        endif;
        ?>
    </div><!-- .container -->
</div><!-- .section -->

<?php
get_footer();
