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
            </div>
        </div>
    </section>

    <!-- Business Section -->
    <section id="business" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">BUSINESS</span>
                <h2 class="c-secHeading">事業内容</h2>
                <p class="c-secDscr">
                    新しい出会いを生み出し、今ある関係を深める。<br>
                    IT技術で「つながり」を創り、育てます。
                </p>
            </div>

            <div class="p-section__body">
                <!-- Main Business: IT Business (2 columns) -->
                <div class="p-businessGrid">
                    <!-- Left: Create Connections -->
                    <article class="p-businessGrid__item c-card">
                        <div class="p-businessGrid__icon c-card__icon -svg">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="20" r="8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <path d="M20 44 C20 36 25 32 32 32 C39 32 44 36 44 44" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                <circle cx="16" cy="24" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <path d="M8 44 C8 38 11 35 16 35" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <circle cx="48" cy="24" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                                <path d="M56 44 C56 38 53 35 48 35" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.6"/>
                            </svg>
                        </div>
                        <div class="p-businessGrid__content">
                            <h3 class="c-card__title">つながりを創る</h3>
                            <p class="c-card__text">
                                新しい出会いと関係性を生み出します。企業と顧客、人と人の最初の接点を創ります。
                            </p>
                            <ul class="p-businessGrid__services">
                                <li>HP/LP制作・Webアプリ開発</li>
                                <li>マッチングシステム開発</li>
                                <li>生成AI活用・チャットボット開発</li>
                            </ul>
                            <div class="p-businessGrid__cta">
                                <a href="#contact" class="c-btn c-btn--outline-dark">
                                    お問い合わせ
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- Right: Nurture Connections -->
                    <article class="p-businessGrid__item c-card">
                        <div class="p-businessGrid__icon c-card__icon -svg">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- trending-up icon (Lucide) -->
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="16 7 22 7 22 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="p-businessGrid__content">
                            <h3 class="c-card__title">つながりを育てる</h3>
                            <p class="c-card__text">
                                今ある関係を深め、継続させます。顧客・社員との信頼関係を強化します。
                            </p>
                            <ul class="p-businessGrid__services">
                                <li>CRM・顧客管理システム開発</li>
                                <li>コミュニティプラットフォーム開発</li>
                                <li>データ分析・AI活用システム開発</li>
                            </ul>
                            <div class="p-businessGrid__cta">
                                <a href="#contact" class="c-btn c-btn--outline-dark">
                                    お問い合わせ
                                </a>
                            </div>
                        </div>
                    </article>
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
                    <p class="p-mvvPurpose__text">人と人のつながりが<br>可能性を拓く</p>
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
                            人と人の善いつながりを築く<br>
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

                <!-- Link to Philosophy Page -->
                <div class="p-mvv__link">
                    <a href="<?php echo esc_url( home_url( '/philosophy/' ) ); ?>" class="c-btn c-btn--text">
                        社名に込めた想い →
                    </a>
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
                    <div class="p-ceoMessageCard__content">
                        <?php if ( get_theme_mod( 'euni_ceo_message' ) ) : ?>
                            <div class="p-ceoMessageCard__text">
                                <?php echo nl2br( esc_html( get_theme_mod( 'euni_ceo_message' ) ) ); ?>
                            </div>
                        <?php else : ?>
                            <div class="p-ceoMessageCard__text">
                                <p>今、どんな分岐点に立っていますか？<br>
                                誰とどんなつながりを築きたいですか？</p>

                                <p>人生には、無数の選択肢がありますが、<br>
                                その選択に最も影響を与えるのが、「人とのつながり」だと、私は信じています。</p>

                                <p>ふとした出会いが、見えなかった道を照らしてくれる。<br>
                                何気ない会話が、踏み出せなかった一歩を後押ししてくれる。<br>
                                誰かとの関係が、自分でも気づかなかった可能性を引き出してくれる。<br>
                                つながりは、人生を大きく変える力を持っています。</p>

                                <p>Euniは、「誰とどんなつながりを築くか」という問いに、一緒に向き合いたい。<br>
                                人生の分岐点で、より良い選択を後押しする「きっかけ」でありたい。</p>

                                <p>人と人をつなぎ、善い関係へと導く接点として、<br>
                                未来に寄り添えたらと思っています。</p>

                                <p>一人ひとりが、自分らしく可能性を広げられる。<br>
                                互いに支え合い、高め合える関係が、当たり前にある。<br>
                                そんな社会を、一緒に築いていけたら嬉しいです。</p>
                            </div>
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
                                <td>株式会社Euni（ユニ）</td>
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
                                        <li>つながりを創るIT事業<br>（HP制作、Webアプリ開発、マッチングシステム等）</li>
                                        <li>つながりを育てるIT事業<br>（CRM、コミュニティプラットフォーム、データ分析等）</li>
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
