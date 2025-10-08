<?php
/**
 * Shortcodes
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Button shortcode
 *
 * Usage: [euni_button url="https://example.com" text="Click Here" style="primary" target="_blank"]
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function euni_button_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'url'    => '#',
            'text'   => 'Button',
            'style'  => 'primary', // primary, outline
            'target' => '_self',
            'class'  => '',
        ),
        $atts,
        'euni_button'
    );

    $classes = 'btn btn-' . esc_attr( $atts['style'] );
    if ( ! empty( $atts['class'] ) ) {
        $classes .= ' ' . esc_attr( $atts['class'] );
    }

    $target_attr = ( '_blank' === $atts['target'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';

    return sprintf(
        '<a href="%s" class="%s"%s>%s</a>',
        esc_url( $atts['url'] ),
        esc_attr( $classes ),
        $target_attr,
        esc_html( $atts['text'] )
    );
}
add_shortcode( 'euni_button', 'euni_button_shortcode' );

/**
 * News list shortcode
 *
 * Usage: [euni_news count="3" category=""]
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function euni_news_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'count'    => 3,
            'category' => '',
        ),
        $atts,
        'euni_news'
    );

    $args = array(
        'post_type'      => 'news',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if ( ! empty( $atts['category'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field'    => 'slug',
                'terms'    => $atts['category'],
            ),
        );
    }

    $query = new WP_Query( $args );

    if ( ! $query->have_posts() ) {
        return '<p>' . esc_html__( 'ニュースが見つかりませんでした。', 'euni-theme' ) . '</p>';
    }

    ob_start();
    ?>
    <div class="euni-news-shortcode">
        <div class="news-grid">
            <?php
            while ( $query->have_posts() ) :
                $query->the_post();
                ?>
                <article class="news-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="news-thumbnail-wrapper">
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'news-thumbnail' ) ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="news-content">
                            <div class="news-date"><?php echo esc_html( get_the_date() ); ?></div>
                            <h3 class="news-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'euni_news', 'euni_news_shortcode' );

/**
 * Box shortcode (info box with icon)
 *
 * Usage: [euni_box icon="👥" title="Title"]Content here[/euni_box]
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Content between shortcode tags.
 * @return string
 */
function euni_box_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'icon'  => '',
            'title' => '',
            'style' => 'default', // default, primary, success, warning
        ),
        $atts,
        'euni_box'
    );

    $class = 'euni-box euni-box-' . esc_attr( $atts['style'] );

    $output  = '<div class="' . esc_attr( $class ) . '">';
    $output .= '<div class="euni-box-header">';

    if ( ! empty( $atts['icon'] ) ) {
        $output .= '<span class="euni-box-icon">' . esc_html( $atts['icon'] ) . '</span>';
    }

    if ( ! empty( $atts['title'] ) ) {
        $output .= '<h4 class="euni-box-title">' . esc_html( $atts['title'] ) . '</h4>';
    }

    $output .= '</div>';
    $output .= '<div class="euni-box-content">' . do_shortcode( $content ) . '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'euni_box', 'euni_box_shortcode' );

/**
 * 2 Column layout shortcode
 *
 * Usage:
 * [euni_columns]
 *   [euni_column]Content 1[/euni_column]
 *   [euni_column]Content 2[/euni_column]
 * [/euni_columns]
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Content between shortcode tags.
 * @return string
 */
function euni_columns_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'gap' => 'normal', // small, normal, large
        ),
        $atts,
        'euni_columns'
    );

    $class = 'euni-columns euni-columns-gap-' . esc_attr( $atts['gap'] );

    return '<div class="' . esc_attr( $class ) . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'euni_columns', 'euni_columns_shortcode' );

/**
 * Column shortcode
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Content between shortcode tags.
 * @return string
 */
function euni_column_shortcode( $atts, $content = null ) {
    return '<div class="euni-column">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'euni_column', 'euni_column_shortcode' );

/**
 * Add shortcode styles to wp_head
 */
function euni_shortcode_styles() {
    ?>
    <style>
    /* Box Shortcode */
    .euni-box {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-left: 4px solid #2563eb;
    }

    .euni-box-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .euni-box-icon {
        font-size: 1.5rem;
    }

    .euni-box-title {
        margin: 0;
        font-size: 1.25rem;
        color: #1e293b;
    }

    .euni-box-content {
        color: #475569;
        line-height: 1.8;
    }

    .euni-box-primary {
        background-color: rgba(37, 99, 235, 0.05);
        border-left-color: #2563eb;
    }

    .euni-box-success {
        background-color: rgba(34, 197, 94, 0.05);
        border-left-color: #22c55e;
    }

    .euni-box-warning {
        background-color: rgba(251, 191, 36, 0.05);
        border-left-color: #fbbf24;
    }

    /* Columns Shortcode */
    .euni-columns {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        margin: 1.5rem 0;
    }

    .euni-columns-gap-small {
        gap: 1rem;
    }

    .euni-columns-gap-normal {
        gap: 2rem;
    }

    .euni-columns-gap-large {
        gap: 3rem;
    }

    .euni-column {
        min-width: 0;
    }

    @media (max-width: 768px) {
        .euni-columns {
            grid-template-columns: 1fr;
        }
    }
    </style>
    <?php
}
add_action( 'wp_head', 'euni_shortcode_styles' );
