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
                        3つの言葉と想いが重なり合っています。<br>
                        それぞれの意味が、私たちの在り方を表しています。
                    </p>
                    <div class="p-philosophyOrigin__list">
                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">Eunoia</span>
                                <span class="p-philosophyOrigin__reading">ユーノイア</span>
                            </div>
                            <div class="p-philosophyOrigin__text">
                                <p class="p-philosophyOrigin__meaning">
                                    古代ギリシャ語で「善き心、美しい思考」を意味する言葉です。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    単なる善意ではなく、<br class="u-br-sp">自分も相手も大切にする心。<br>
                                    利己と利他を対立させるのではなく、<br class="u-br-sp">両方を大切にする知恵。<br>
                                    相手の幸せを願いながら、<br class="u-br-sp">自分も心地よくいられる。<br>
                                    そんなバランスの取れた関係性を、<br class="u-br-sp">私たちは大切にしています。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    この「善き心」は、<br class="u-br-sp">私たちの事業のすべての基盤です。<br>
                                    押し付けでもなく、<br class="u-br-sp">利益優先でもなく、<br>
                                    関わるすべての人が<br class="u-br-sp">心地よくいられることを目指しています。
                                </p>
                            </div>
                        </div>

                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">UNI</span>
                                <span class="p-philosophyOrigin__reading">User Network Interface</span>
                            </div>
                            <div class="p-philosophyOrigin__text">
                                <p class="p-philosophyOrigin__meaning">
                                    人と人を繋ぐインターフェース。<br>
                                    それが、私たちの役割です。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    技術は、<br class="u-br-sp">それ自体が目的ではありません。<br>
                                    人と人が出会い、<br class="u-br-sp">関係性が深まり、<br class="u-br-sp">可能性が広がる。<br>
                                    そのための「接点」「きっかけ」「場」を<br class="u-br-sp">創ることが、<br>
                                    私たちの使命だと考えています。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    WebサイトもシステムもAIも、<br class="u-br-sp">すべては手段です。<br>
                                    大切なのは、<br class="u-br-sp">その先にある人と人のつながり。<br>
                                    技術を通じて、<br class="u-br-sp">温かいつながりが生まれる瞬間を<br class="u-br-sp">創りたい。<br>
                                    それが私たちの目指す<br class="u-br-sp">「インターフェース」です。
                                </p>
                            </div>
                        </div>

                        <div class="p-philosophyOrigin__item">
                            <div class="p-philosophyOrigin__label">
                                <span class="p-philosophyOrigin__name">Uni</span>
                                <span class="p-philosophyOrigin__reading">ユニ</span>
                            </div>
                            <div class="p-philosophyOrigin__text">
                                <p class="p-philosophyOrigin__meaning">
                                    ラテン語で「一つ」を意味します。<br>
                                    これは、つながりと循環への願いです。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    人は誰しも、<br class="u-br-sp">一人では生きていくことはできません。<br>
                                    必ず誰かの恩恵を受け、<br class="u-br-sp">支えられながら生きています。<br>
                                    一人ひとりは<br class="u-br-sp">小さな存在かもしれない。<br>
                                    でも、<br class="u-br-sp">つながることで「一つ」になり、<br class="u-br-sp">大きな力になる。<br>
                                    誰かから受け取った恩恵を、<br class="u-br-sp">また別の誰かへ。<br>
                                    その循環が広がっていくことで、<br class="u-br-sp">社会は少しずつ温かくなる。
                                </p>
                                <p class="p-philosophyOrigin__detail">
                                    私たちは、<br class="u-br-sp">この「つながりの循環」を信じています。<br>
                                    それぞれの道を歩んでいるように見える<br class="u-br-sp">人々が、<br class="u-br-sp">実は一つにつながっている。<br>
                                    その見えないつながりを<br class="u-br-sp">可視化し、<br class="u-br-sp">育てていくこと。<br>
                                    それが、<br class="u-br-sp">Euniの目指す社会です。
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-philosophyOrigin__conclusion">
                        <p>
                            <strong>Eunoia（善き心）</strong>を持ち、<br>
                            <strong>User Network Interface（人と人を繋ぐ接点）</strong>となり、<br>
                            <strong>Uni（一つのつながり）</strong>を創る。
                        </p>
                        <p>
                            この3つの想いが重なり合い、「Euni（ユニ）」という社名になりました。<br>
                            私たちは、この名前に込めた想いを、日々の事業で実現していきます。
                        </p>
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
