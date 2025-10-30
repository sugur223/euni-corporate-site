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
            <div class="l-footer__content l-container">
                <div class="l-footer__grid">
                    <!-- Company Info -->
                    <div class="l-footer__brand">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-logo" rel="home">
                            <span class="c-logo__text">株式会社ユニ / Euni Inc.</span>
                        </a>
                        <p class="l-footer__tagline">つながろう。あなたの未来のために。</p>
                        <p class="l-footer__description">
                            誰もがつながりの中で生きる社会へ。<br>
                            人と人をつなぐ接点となり、善いつながりを育む。
                        </p>

                        <!-- SNS Links -->
                        <div class="l-footer__social">
                            <?php if ( get_theme_mod( 'euni_twitter_url' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'euni_twitter_url' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_facebook_url' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'euni_facebook_url' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_linkedin_url' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'euni_linkedin_url' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_instagram_url' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'euni_instagram_url' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Site Map Column 1 -->
                    <nav class="l-footer__nav">
                        <h3 class="l-footer__navTitle">会社情報</h3>
                        <ul class="c-footer-nav">
                            <li><a href="<?php echo esc_url( home_url( '/#mvv' ) ); ?>">企業理念</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#philosophy' ) ); ?>">社名の由来</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#message' ) ); ?>">代表メッセージ</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#company' ) ); ?>">会社概要</a></li>
                        </ul>
                    </nav>

                    <!-- Site Map Column 2 -->
                    <nav class="l-footer__nav">
                        <h3 class="l-footer__navTitle">サービス</h3>
                        <ul class="c-footer-nav">
                            <li><a href="<?php echo esc_url( home_url( '/#business' ) ); ?>">事業内容</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">ニュース</a></li>
                        </ul>
                    </nav>

                    <!-- Site Map Column 3 -->
                    <nav class="l-footer__nav">
                        <h3 class="l-footer__navTitle">お問い合わせ</h3>
                        <ul class="c-footer-nav">
                            <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">一般お問い合わせ</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">採用について</a></li>
                            <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">取材について</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="l-footer__bottom">
                <div class="l-container">
                    <div class="c-copyright">
                        <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            株式会社ユニ
                        </a>
                        All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #body_wrap -->

<?php wp_footer(); ?>

</body>
</html>
