<?php
/**
 * Footer Template (SWELL-based structure)
 *
 * @package Euni_Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

    </div><!-- .l-content -->

    <!-- Footer -->
    <footer id="footer" class="l-footer">
        <div class="l-footer__inner">
            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="l-footer__widgets l-container">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>

            <div class="l-footer__bottom">
                <div class="l-container">
                    <div class="c-copyright">
                        <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                        <?php esc_html_e( 'All rights reserved.', 'euni-theme' ); ?></p>
                    </div>

                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer',
                                'menu_id'        => 'footer-menu',
                                'menu_class'     => 'c-footer-nav',
                                'container'      => 'nav',
                                'container_class' => 'l-footer__nav',
                                'depth'          => 1,
                            )
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #body_wrap -->

<?php wp_footer(); ?>

</body>
</html>
