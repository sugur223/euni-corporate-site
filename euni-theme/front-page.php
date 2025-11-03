<?php
/**
 * Front Page Template (Simplified Structure)
 *
 * @package Euni_Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<!-- Hero Section -->
<div class="p-hero">
    <div class="p-hero__inner l-container">
        <div class="p-hero__grid">
            <!-- Left: Text Content -->
            <div class="p-hero__content">
                <p class="p-hero__subtitle">Connect to possibilities.</p>
                <h1 class="p-hero__title">つながりで<br>未来をひらく</h1>
            </div>

            <!-- Right: Network Animation -->
            <div class="p-hero__visual">
                <canvas id="networkCanvas" class="p-hero__canvas"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="l-mainContent">

    <!-- News Section -->
    <section id="news" class="p-section p-news js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">NEWS</span>
                <h2 class="c-secHeading">ニュース・お知らせ</h2>
            </div>

            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-news__shape1 js-parallax">
                    <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 75 L75 30 L120 75 L75 120 Z" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                        <path d="M50 75 L75 50 L100 75 L75 100 Z" stroke="currentColor" stroke-width="2" opacity="0.5"/>
                    </svg>
                </div>
                <div class="p-news__shape2 js-parallax2">
                    <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="30" y="30" width="120" height="120" stroke="currentColor" stroke-width="2" opacity="0.4" rx="15"/>
                        <rect x="55" y="55" width="70" height="70" stroke="currentColor" stroke-width="2" opacity="0.6" rx="10"/>
                    </svg>
                </div>
                <div class="p-newsGrid">
                    <?php
                    $news_query = new WP_Query(array(
                        'post_type'      => 'news',
                        'posts_per_page' => 5,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ));

                    if ( ! $news_query->have_posts() ) :
                        $dummy_news = array(
                            array(
                                'date'            => '2025.11.XX',
                                'category'        => 'プレスリリース',
                                'category_class'  => 'press',
                                'title'           => '株式会社Euni設立のお知らせ',
                            ),
                            array(
                                'date'            => '2025.11.XX',
                                'category'        => 'お知らせ',
                                'category_class'  => 'info',
                                'title'           => 'コーポレートサイトを公開しました',
                            ),
                            array(
                                'date'            => '2025.12.XX',
                                'category'        => 'イベント',
                                'category_class'  => 'event',
                                'title'           => 'キックオフイベント開催予定',
                            ),
                        );

                        foreach ( $dummy_news as $news ) :
                    ?>
                        <article class="c-newsCard">
                            <div class="c-newsCard__meta">
                                <time class="c-newsCard__date"><?php echo esc_html( $news['date'] ); ?></time>
                                <span class="c-newsCard__cat -<?php echo esc_attr( $news['category_class'] ); ?>">
                                    <?php echo esc_html( $news['category'] ); ?>
                                </span>
                            </div>
                            <h3 class="c-newsCard__title">
                                <a href="#news"><?php echo esc_html( $news['title'] ); ?></a>
                            </h3>
                        </article>
                    <?php
                        endforeach;
                    else :
                        while ( $news_query->have_posts() ) :
                            $news_query->the_post();
                            $categories = get_the_terms( get_the_ID(), 'news_category' );
                            $cat_name   = $categories ? $categories[0]->name : 'お知らせ';
                            $cat_slug   = $categories ? $categories[0]->slug : 'info';
                    ?>
                        <article class="c-newsCard">
                            <div class="c-newsCard__meta">
                                <time class="c-newsCard__date"><?php echo get_the_date( 'Y.m.d' ); ?></time>
                                <span class="c-newsCard__cat -<?php echo esc_attr( $cat_slug ); ?>">
                                    <?php echo esc_html( $cat_name ); ?>
                                </span>
                            </div>
                            <h3 class="c-newsCard__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <div class="p-section__cta">
                    <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="c-btn c-btn--outline-dark">
                        ニュース一覧を見る →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Overview Section -->
    <section id="business" class="p-section -bg p-business js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__head">
                <div class="p-section__icon">
                    <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Network/connection pattern -->
                        <circle cx="35" cy="15" r="5" stroke="currentColor" stroke-width="2.5" opacity="0.8"/>
                        <circle cx="15" cy="35" r="5" stroke="currentColor" stroke-width="2.5" opacity="0.8"/>
                        <circle cx="55" cy="35" r="5" stroke="currentColor" stroke-width="2.5" opacity="0.8"/>
                        <circle cx="25" cy="55" r="5" stroke="currentColor" stroke-width="2.5" opacity="0.8"/>
                        <circle cx="45" cy="55" r="5" stroke="currentColor" stroke-width="2.5" opacity="0.8"/>
                        <circle cx="35" cy="35" r="8" stroke="currentColor" stroke-width="2.5" opacity="0.85"/>
                        <circle cx="35" cy="35" r="3" fill="currentColor" opacity="0.7"/>
                        <!-- Connection lines -->
                        <line x1="35" y1="20" x2="35" y2="27" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                        <line x1="20" y1="35" x2="27" y2="35" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                        <line x1="43" y1="35" x2="50" y2="35" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                        <line x1="30" y1="41" x2="27" y2="52" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                        <line x1="40" y1="41" x2="43" y2="52" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                    </svg>
                </div>
                <span class="c-secLabel">BUSINESS</span>
                <h2 class="c-secHeading">事業概要</h2>
                <p class="c-secDscr">
                    Euniでは<br>
                    3つの事業を展開しています。</p>
            </div>

            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-business__shape1 js-parallax">
                    <svg width="190" height="190" viewBox="0 0 190 190" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Triangular grid pattern -->
                        <path d="M95 20 L165 85 L95 150 L25 85 Z" stroke="currentColor" stroke-width="2.5" opacity="0.25" stroke-linejoin="round"/>
                        <path d="M95 40 L145 95 L95 130 L45 95 Z" stroke="currentColor" stroke-width="2.5" opacity="0.35" stroke-linejoin="round"/>
                        <path d="M95 60 L125 95 L95 110 L65 95 Z" stroke="currentColor" stroke-width="2" opacity="0.45" stroke-linejoin="round"/>
                        <!-- Internal triangles -->
                        <path d="M95 20 L95 85 L25 85 Z" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <path d="M95 20 L95 85 L165 85 Z" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <path d="M95 85 L25 85 L95 150 Z" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <path d="M95 85 L165 85 L95 150 Z" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <!-- Center point -->
                        <circle cx="95" cy="85" r="5" fill="currentColor" opacity="0.35"/>
                    </svg>
                </div>
                <div class="p-business__shape2 js-parallax2">
                    <svg width="170" height="170" viewBox="0 0 170 170" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Pentagon pattern -->
                        <path d="M85 15 L155 60 L130 135 L40 135 L15 60 Z" stroke="currentColor" stroke-width="2.5" opacity="0.25" stroke-linejoin="round"/>
                        <path d="M85 35 L135 70 L115 125 L55 125 L35 70 Z" stroke="currentColor" stroke-width="2.5" opacity="0.35" stroke-linejoin="round"/>
                        <path d="M85 55 L115 80 L100 115 L70 115 L55 80 Z" stroke="currentColor" stroke-width="2" opacity="0.45" stroke-linejoin="round"/>
                        <!-- Star lines from center -->
                        <line x1="85" y1="85" x2="85" y2="15" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="85" y1="85" x2="155" y2="60" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="85" y1="85" x2="130" y2="135" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="85" y1="85" x2="40" y2="135" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="85" y1="85" x2="15" y2="60" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <!-- Center circle -->
                        <circle cx="85" cy="85" r="6" fill="currentColor" opacity="0.35"/>
                    </svg>
                </div>
                <div class="p-cardGrid -col3">
                    <div class="c-card">
                        <div class="c-card__icon -svg">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="20" r="8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <path d="M20 44 C20 36 25 32 32 32 C39 32 44 36 44 44" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <circle cx="16" cy="24" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <path d="M8 44 C8 38 11 35 16 35" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <circle cx="48" cy="24" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <path d="M56 44 C56 38 53 35 48 35" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                            </svg>
                        </div>
                        <h3 class="c-card__title">成長支援コミュニティ事業</h3>
                        <p class="c-card__text">
                            キャリアに悩む人に、学びと対話の場を提供します。<br>
                            多様な出会いと気づきを通じて、一人ひとりが自分らしい選択を見つけ、<br>
                            前へ進む力を育むコミュニティを運営しています。
                        </p>
                        <a href="https://service.euni.jp" class="c-btn-link" target="_blank" rel="noopener">サービスサイトを見る</a>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon -svg">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="12" width="48" height="36" rx="3" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <line x1="8" y1="20" x2="56" y2="20" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <rect x="16" y="28" width="12" height="12" rx="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
                                <line x1="36" y1="30" x2="48" y2="30" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
                                <line x1="36" y1="36" x2="48" y2="36" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
                                <circle cx="32" cy="52" r="4" fill="currentColor" opacity="0.6"/>
                            </svg>
                        </div>
                        <h3 class="c-card__title">ITソリューション事業</h3>
                        <p class="c-card__text">
                            コミュニティ運営に取り組む企業・団体へ、プラットフォーム開発から運用まで伴走します。<br>
                            システム開発・AI活用で、メンバー同士の自発的なつながりを促進し、<br>
                            長期的な関係性を育む仕組みを共に創ります。
                        </p>
                        <a href="#contact" class="c-btn-link">お問い合わせ</a>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon -svg">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="52" x2="52" y2="52" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <line x1="12" y1="12" x2="12" y2="52" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <polyline points="20,40 26,32 32,36 38,24 44,28 50,16" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                                <circle cx="20" cy="40" r="2.5" fill="currentColor"/>
                                <circle cx="26" cy="32" r="2.5" fill="currentColor"/>
                                <circle cx="32" cy="36" r="2.5" fill="currentColor"/>
                                <circle cx="38" cy="24" r="2.5" fill="currentColor"/>
                                <circle cx="44" cy="28" r="2.5" fill="currentColor"/>
                                <circle cx="50" cy="16" r="2.5" fill="currentColor"/>
                            </svg>
                        </div>
                        <h3 class="c-card__title">コンサルティング事業</h3>
                        <p class="c-card__text">
                            組織内のつながりを強化したい企業へ、組織開発・人材育成をサポートします。<br>
                            関係性の質を高めるプログラムを通じて、<br>
                            一人ひとりが安心して力を発揮できる組織文化を共に育てます。
                        </p>
                        <a href="#contact" class="c-btn-link">お問い合わせ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Purpose & MVV Section -->
    <section id="mvv" class="p-section p-mvv js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">PHILOSOPHY</span>
                <h2 class="c-secHeading">企業理念</h2>
            </div>

            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-mvv__shape1 js-parallax">
                    <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 20 L170 60 L170 140 L100 180 L30 140 L30 60 Z" stroke="currentColor" stroke-width="2.5" opacity="0.25" stroke-linejoin="round"/>
                        <path d="M100 40 L150 70 L150 130 L100 160 L50 130 L50 70 Z" stroke="currentColor" stroke-width="2.5" opacity="0.35" stroke-linejoin="round"/>
                        <path d="M100 60 L130 80 L130 120 L100 140 L70 120 L70 80 Z" stroke="currentColor" stroke-width="2" opacity="0.45" stroke-linejoin="round"/>
                        <line x1="100" y1="20" x2="100" y2="180" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="30" y1="60" x2="170" y2="140" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="170" y1="60" x2="30" y2="140" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                    </svg>
                </div>
                <div class="p-mvv__shape2 js-parallax2">
                    <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="90" cy="90" r="70" stroke="currentColor" stroke-width="2.5" opacity="0.25"/>
                        <circle cx="90" cy="90" r="52" stroke="currentColor" stroke-width="2.5" opacity="0.35"/>
                        <circle cx="90" cy="90" r="34" stroke="currentColor" stroke-width="2" opacity="0.45"/>
                        <line x1="90" y1="20" x2="90" y2="160" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="20" y1="90" x2="160" y2="90" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="35" y1="35" x2="145" y2="145" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <line x1="145" y1="35" x2="35" y2="145" stroke="currentColor" stroke-width="1.5" opacity="0.2"/>
                        <circle cx="90" cy="20" r="4" fill="currentColor" opacity="0.3"/>
                        <circle cx="160" cy="90" r="4" fill="currentColor" opacity="0.3"/>
                        <circle cx="90" cy="160" r="4" fill="currentColor" opacity="0.3"/>
                        <circle cx="20" cy="90" r="4" fill="currentColor" opacity="0.3"/>
                    </svg>
                </div>

                <!-- Purpose Statement -->
                <div class="p-mvvPurpose">
                    <p class="p-mvvPurpose__text">人と人とのつながりが<br>可能性を拓く</p>
                    <div class="p-mvvPurpose__detail">
                        <p>ふとした出会いが、新しい道を見せてくれる<br>
                        誰かの言葉が、背中を押してくれる</p>

                        <p>Euniは、そんなつながりや関係性が生まれる機会を創ります<br>
                        一人ひとりの可能性が、誰かとつながることで広がっていく<br>
                        迷いながらでも、一歩ずつ前へ進める関係を、もっと当たり前にしたい</p>

                        <p>人と人がつながることで、未来は変わっていく</p>

                        <p class="p-mvvPurpose__tagline">Connect to possibilities.</p>
                    </div>
                </div>

                <div class="p-mvvContent">
                    <div class="p-mvvItem">
                        <div class="p-mvvItem__label">
                            <span class="p-mvvItem__en">Mission</span>
                            <span class="p-mvvItem__jp">使命</span>
                        </div>
                        <p class="p-mvvItem__text">
                            豊かな発想と高い技術力によって、<br>
                            善いつながりを育み、<br>
                            すべての人々の可能性を広げる
                        </p>
                    </div>

                    <div class="p-mvvItem">
                        <div class="p-mvvItem__label">
                            <span class="p-mvvItem__en">Vision</span>
                            <span class="p-mvvItem__jp">企業のありたい姿</span>
                        </div>
                        <p class="p-mvvItem__text">
                            人と人との善いつながりを築く<br>
                            インターフェースとして<br>
                            信頼される存在になる
                        </p>
                    </div>
                </div>

                <!-- Values Section -->
                <div class="p-values">
                    <div class="p-values__shape js-parallax">
                        <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="150" cy="150" r="120" stroke="currentColor" stroke-width="2" opacity="0.2"/>
                            <circle cx="150" cy="150" r="90" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                            <circle cx="150" cy="150" r="60" stroke="currentColor" stroke-width="2" opacity="0.4"/>
                        </svg>
                    </div>
                    <div class="p-values__inner">
                        <div class="p-values__head">
                            <div class="p-values__icon">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 30 L30 10 L50 30 L30 50 Z" stroke="currentColor" stroke-width="2" opacity="0.7"/>
                                    <path d="M18 30 L30 18 L42 30 L30 42 Z" stroke="currentColor" stroke-width="2" opacity="0.9"/>
                                </svg>
                            </div>
                            <h3 class="c-subTitle">
                                <span class="c-subTitle__en">Values</span>
                                <span class="c-subTitle__jp">私たちの価値観</span>
                            </h3>
                        </div>
                        <ul class="p-values__list">
                            <li class="p-values__item">
                                <div class="p-values__num">01</div>
                                <dl class="p-values__content">
                                    <dt class="p-values__title">問い続けよう</dt>
                                    <dd class="p-values__text">本当に大切なことは何か<br>当たり前を疑って、本質を探ろう</dd>
                                </dl>
                            </li>
                            <li class="p-values__item">
                                <div class="p-values__num">02</div>
                                <dl class="p-values__content">
                                    <dt class="p-values__title">近くから幸せに</dt>
                                    <dd class="p-values__text">目の前の人を、まず幸せに<br>その小さな輪が広がって、社会を温かくする</dd>
                                </dl>
                            </li>
                            <li class="p-values__item">
                                <div class="p-values__num">03</div>
                                <dl class="p-values__content">
                                    <dt class="p-values__title">心から楽しもう</dt>
                                    <dd class="p-values__text">楽しむ心で、自分の意思に正直に<br>遊び心を持って、わくわくしながら、まずやってみよう</dd>
                                </dl>
                            </li>
                            <li class="p-values__item">
                                <div class="p-values__num">04</div>
                                <dl class="p-values__content">
                                    <dt class="p-values__title">循環を創ろう</dt>
                                    <dd class="p-values__text">受け取ったものへの感謝を胸に、また誰かに<br>善意と感謝が巡る流れを創ろう</dd>
                                </dl>
                            </li>
                            <li class="p-values__item">
                                <div class="p-values__num">05</div>
                                <dl class="p-values__content">
                                    <dt class="p-values__title">矛盾を受け入れよう</dt>
                                    <dd class="p-values__text">完璧じゃなくていい<br>矛盾も、不完全も受け入れる。それでも、少しずつ前へ</dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CEO Message Section -->
    <section id="message" class="p-section -bg p-ceo js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">CEO MESSAGE</span>
                <h2 class="c-secHeading">代表メッセージ</h2>
            </div>

            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-ceo__shape1 js-parallax">
                    <svg width="190" height="190" viewBox="0 0 190 190" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="95" cy="95" r="75" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                        <circle cx="95" cy="95" r="55" stroke="currentColor" stroke-width="2" opacity="0.5"/>
                        <circle cx="95" cy="95" r="35" stroke="currentColor" stroke-width="2" opacity="0.7"/>
                    </svg>
                </div>
                <div class="p-ceo__shape2 js-parallax2">
                    <svg width="160" height="160" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="30" y="30" width="100" height="100" stroke="currentColor" stroke-width="2" opacity="0.4" rx="10"/>
                        <rect x="50" y="50" width="60" height="60" stroke="currentColor" stroke-width="2" opacity="0.6" rx="6"/>
                    </svg>
                </div>

                <div class="p-ceoMessageCard">
                    <div class="p-ceoMessageCard__profile">
                        <div class="p-ceoProfile">
                            <div class="p-ceoProfile__photo">
                                <?php if ( get_theme_mod( 'euni_ceo_photo' ) ) : ?>
                                    <img src="<?php echo esc_url( get_theme_mod( 'euni_ceo_photo' ) ); ?>" alt="代表者写真">
                                <?php else : ?>
                                    <div class="p-ceoProfile__placeholder">👤</div>
                                <?php endif; ?>
                            </div>
                            <div class="p-ceoProfile__info">
                                <p class="p-ceoProfile__title">代表取締役</p>
                                <p class="p-ceoProfile__name">
                                    <?php echo esc_html( get_theme_mod( 'euni_ceo_name', '代表者名' ) ); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-ceoMessageCard__content">
                        <?php if ( get_theme_mod( 'euni_ceo_message' ) ) : ?>
                            <div class="p-ceoMessageCard__text">
                                <?php echo nl2br( esc_html( get_theme_mod( 'euni_ceo_message' ) ) ); ?>
                            </div>
                        <?php else : ?>
                            <div class="p-ceoMessageCard__text">
                                <p>あなたは今、どんな分岐点に立っていますか？</p>
                                <p>人生には、無数の選択肢があります。その一つ一つの選択に最も影響を与える存在が、「人」なのではないでしょうか。</p>
                                <p>誰かとの出会いが、新しい道を見せてくれる。誰かの言葉が、一歩を踏み出す勇気をくれる。誰かとの関係が、あなたの可能性を広げてくれる。</p>
                                <p>私自身、深く孤独を経験した時期がありました。その時、救ってくれたのは人とのつながりでした。一つの出会いが、閉じていた道を開いてくれる。一つの関係が、前を向く力を与えてくれる。</p>
                                <p>Euniは、あなたの人生の分岐点で、より良い選択を後押しする「きっかけ」となりたい。</p>
                                <p>人と人をつなぎ、可能性へと導くインターフェースとして、あなたの未来に寄り添いたいと考えています。</p>
                                <p>一人ひとりが、自分らしく可能性を広げられる。互いに支え合い、高め合える関係が、当たり前にある。そんな未来を、共に築いていきましょう。</p>
                            </div>
                            <div class="p-ceoMessageCard__signature">
                                <p>代表取締役 <?php echo esc_html( get_theme_mod( 'euni_ceo_name', '代表者名' ) ); ?></p>
                            </div>
                            <?php if ( get_theme_mod( 'euni_ceo_career' ) ) : ?>
                                <div class="p-ceoMessageCard__career">
                                    <h4>略歴</h4>
                                    <p><?php echo nl2br( esc_html( get_theme_mod( 'euni_ceo_career' ) ) ); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Section -->
    <section id="company" class="p-section -bg p-company js-parallax-trigger">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">COMPANY</span>
                <h2 class="c-secHeading">会社概要</h2>
            </div>

            <div class="p-section__body">
                <!-- Decorative shapes -->
                <div class="p-company__shape1 js-parallax">
                    <svg width="160" height="160" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="80" cy="80" r="65" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                        <circle cx="80" cy="80" r="45" stroke="currentColor" stroke-width="2" opacity="0.5"/>
                    </svg>
                </div>
                <div class="p-company__shape2 js-parallax2">
                    <svg width="170" height="170" viewBox="0 0 170 170" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M85 15 L155 155 L15 155 Z" stroke="currentColor" stroke-width="2" opacity="0.4"/>
                        <path d="M85 45 L125 125 L45 125 Z" stroke="currentColor" stroke-width="2" opacity="0.6"/>
                    </svg>
                </div>
                <div class="c-companyTable">
                    <table class="c-table">
                        <tbody>
                            <tr>
                                <th>会社名</th>
                                <td>株式会社Euni</td>
                            </tr>
                            <tr>
                                <th>英語表記</th>
                                <td>Euni Inc.</td>
                            </tr>
                            <tr>
                                <th>代表取締役</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_ceo_name', '松本卓' ) ); ?></td>
                            </tr>
                            <tr>
                                <th>設立</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_establishment', '2025年11月（予定）' ) ); ?></td>
                            </tr>
                            <tr>
                                <th>資本金</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_capital', '300万円' ) ); ?></td>
                            </tr>
                            <tr>
                                <th>所在地</th>
                                <td><?php echo nl2br( esc_html( get_theme_mod( 'euni_address', "〒150-0041\n東京都渋谷区神南一丁目１１番地４号　ＦＰＧリンクス神南 5階" ) ) ); ?></td>
                            </tr>
                            <tr>
                                <th>事業内容</th>
                                <td>
                                    <ul class="c-list">
                                        <li>成長支援コミュニティ事業</li>
                                        <li>ITソリューション事業</li>
                                        <li>コンサルティング事業</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="p-section p-contact">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">CONTACT</span>
                <h2 class="c-secHeading">お問い合わせ</h2>
            </div>

            <div class="p-section__body">
                <div class="p-contact__grid">
                    <!-- Contact Info -->
                    <div class="p-contact__info">
                        <div class="c-contactInfo">
                            <h3 class="c-contactInfo__title">お問い合わせ先</h3>

                            <?php
                            $euni_email = get_theme_mod( 'euni_email', 'info@euni.jp' );
                            ?>
                            <div class="c-contactInfo__item">
                                <div class="c-contactInfo__label">Email</div>
                                <div class="c-contactInfo__value">
                                    <a href="mailto:<?php echo esc_attr( $euni_email ); ?>">
                                        <?php echo esc_html( $euni_email ); ?>
                                    </a>
                                </div>
                            </div>

                            <?php if ( get_theme_mod( 'euni_phone' ) ) : ?>
                                <div class="c-contactInfo__item">
                                    <div class="c-contactInfo__label">電話</div>
                                    <div class="c-contactInfo__value">
                                        <a href="tel:<?php echo esc_attr( str_replace('-', '', get_theme_mod( 'euni_phone' )) ); ?>">
                                            <?php echo esc_html( get_theme_mod( 'euni_phone' ) ); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="c-contactInfo__item">
                                <div class="c-contactInfo__label">営業時間</div>
                                <div class="c-contactInfo__value">
                                    <?php echo esc_html( get_theme_mod( 'euni_business_hours', '平日 10:00 - 18:00' ) ); ?>
                                </div>
                            </div>

                            <div class="c-contactInfo__note">
                                <p>※ お問い合わせ内容によっては、回答までにお時間をいただく場合がございます。</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="p-contact__form">
                        <form id="contactForm" class="c-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                            <input type="hidden" name="action" value="euni_contact_form">
                            <?php wp_nonce_field( 'euni_contact_form', 'euni_contact_nonce' ); ?>

                            <div class="c-form__row">
                                <label for="contact_name" class="c-form__label">お名前 <span class="c-form__required">必須</span></label>
                                <input type="text" id="contact_name" name="contact_name" class="c-form__input" required>
                            </div>

                            <div class="c-form__row">
                                <label for="contact_company" class="c-form__label">会社名・組織名 <span class="c-form__optional">任意</span></label>
                                <input type="text" id="contact_company" name="contact_company" class="c-form__input">
                            </div>

                            <div class="c-form__row">
                                <label for="contact_email" class="c-form__label">メールアドレス <span class="c-form__required">必須</span></label>
                                <input type="email" id="contact_email" name="contact_email" class="c-form__input" required>
                            </div>

                            <div class="c-form__row">
                                <label for="contact_phone" class="c-form__label">電話番号 <span class="c-form__optional">任意</span></label>
                                <input type="tel" id="contact_phone" name="contact_phone" class="c-form__input">
                            </div>

                            <div class="c-form__row">
                                <label for="contact_type" class="c-form__label">お問い合わせ種別 <span class="c-form__required">必須</span></label>
                                <select id="contact_type" name="contact_type" class="c-form__select" required>
                                    <option value="">選択してください</option>
                                    <option value="general">一般お問い合わせ</option>
                                    <option value="recruit">採用について</option>
                                    <option value="media">取材・メディア掲載について</option>
                                    <option value="partnership">事業提携について</option>
                                    <option value="other">その他</option>
                                </select>
                            </div>

                            <div class="c-form__row">
                                <label for="contact_message" class="c-form__label">お問い合わせ内容 <span class="c-form__required">必須</span></label>
                                <textarea id="contact_message" name="contact_message" class="c-form__textarea" rows="8" required></textarea>
                            </div>

                            <div class="c-form__submit">
                                <button type="submit" class="c-btn c-btn--primary">送信する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div><!-- .l-mainContent -->

<?php
get_footer();
