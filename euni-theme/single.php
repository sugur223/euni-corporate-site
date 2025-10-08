<?php
/**
 * Template for displaying single posts (News)
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
        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <div class="entry-meta">
                        <span class="posted-on">
                            <time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>
                        </span>

                        <?php
                        // Display post categories if any
                        $categories_list = get_the_category_list( esc_html__( ', ', 'euni-theme' ) );
                        if ( $categories_list ) :
                            ?>
                            <span class="cat-links" style="margin-left: 1rem;">
                                <?php echo $categories_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </span>
                        <?php endif; ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="entry-thumbnail" style="margin: 2rem 0;">
                        <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto; border-radius: 12px;' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'euni-theme' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--color-border);">
                    <?php
                    // Display tags
                    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'euni-theme' ) );
                    if ( $tags_list ) :
                        ?>
                        <div class="tags-links" style="margin-bottom: 1rem;">
                            <strong><?php esc_html_e( 'Tags:', 'euni-theme' ); ?></strong>
                            <?php echo $tags_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_edit_post_link() ) : ?>
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Post title. Only visible to screen readers. */
                                    __( 'Edit <span class="screen-reader-text">%s</span>', 'euni-theme' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    <?php endif; ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // Previous/Next post navigation
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( '前の記事', 'euni-theme' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( '次の記事', 'euni-theme' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

            // If comments are open or there is at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </div><!-- .container -->
</div><!-- .section -->

<?php
get_footer();
