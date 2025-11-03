<?php
/**
 * Template Name: Philosophy Page (社名に込めた想い)
 * Template Post Type: page
 *
 * @package Euni_Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="l-mainContent">

    <!-- Page Hero -->
    <section class="p-pageHero">
        <div class="l-container">
            <div class="p-pageHero__inner">
                <span class="p-pageHero__label">PHILOSOPHY</span>
                <h1 class="p-pageHero__title">社名に込めた想い</h1>
                <p class="p-pageHero__lead">
                    私たちの社名「Euni（ユニ）」には、<br>
                    3つの想いが込められています。
                </p>
            </div>
        </div>
    </section>

    <!-- Philosophy Content Section -->
    <section class="p-section -bg p-philosophy js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-philosophy__shape1 js-parallax">
                    <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 20 L180 180 L20 180 Z" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                        <path d="M100 50 L150 150 L50 150 Z" stroke="currentColor" stroke-width="2" opacity="0.5"/>
                    </svg>
                </div>
                <div class="p-philosophy__shape2 js-parallax2">
                    <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="75" cy="75" r="60" stroke="currentColor" stroke-width="2" opacity="0.4"/>
                        <circle cx="75" cy="75" r="45" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                        <circle cx="75" cy="75" r="30" stroke="currentColor" stroke-width="2" opacity="0.7"/>
                    </svg>
                </div>

                <div class="p-philosophyOrigin">
                    <h2 class="p-philosophyOrigin__title">社名の由来</h2>
                    <p class="p-philosophyOrigin__intro">
                        私たちの社名「Euni（ユニ）」には、<br>
                        3つの想いが込められています。
                    </p>
                    <div class="p-philosophyOrigin__list">
                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">Eunoia</span>
                                <span class="p-philosophyOrigin__reading">ユーノイア</span>
                            </div>
                            <p class="p-philosophyOrigin__text">
                                ギリシャ語で「善き心、美しい思考」を意味します。<br>
                                自分も相手も大切にする、利己と利他を両立する心。<br>
                                私たちは、この「善き心」を大切にし、<br>
                                すべての活動の基盤としています。
                            </p>
                        </div>

                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">UNI</span>
                                <span class="p-philosophyOrigin__reading">User Network Interface</span>
                            </div>
                            <p class="p-philosophyOrigin__text">
                                人と人を繋ぐインターフェース。<br>
                                私たちは、出会いと関係性を創る接点となり、<br>
                                人々の可能性を広げる架け橋でありたいと考えています。
                            </p>
                        </div>

                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">Uni</span>
                                <span class="p-philosophyOrigin__reading">ユニ</span>
                            </div>
                            <p class="p-philosophyOrigin__text">
                                ラテン語で「一つ」を意味します。<br>
                                善意の循環、つながりの循環。<br>
                                一人ひとりの小さな善意が、<br>
                                大きな温かい流れを生み出す。<br>
                                そんな社会を目指しています。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to Top Link -->
    <section class="p-section">
        <div class="l-container">
            <div class="p-section__cta">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-btn c-btn--outline-dark">
                    トップページへ戻る
                </a>
            </div>
        </div>
    </section>

</div><!-- .l-mainContent -->

<?php
get_footer();
