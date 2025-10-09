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
        <div class="p-hero__content">
            <h1 class="p-hero__title">善き心で、つながろう</h1>
            <p class="p-hero__subtitle">EUNOIA ∞ USER NETWORK INTERFACE</p>
            <p class="p-hero__text">全ての人が善いつながりの中でありたい姿を実現できる社会を創造する</p>
            <div class="p-hero__btns">
                <a href="#vision" class="c-btn c-btn--primary">私たちのビジョン</a>
                <a href="#contact" class="c-btn c-btn--outline">お問い合わせ</a>
            </div>
        </div>
    </div>
</div>

<div class="l-mainContent">

    <!-- News Section -->
    <section id="news" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">NEWS</span>
                <h2 class="c-secHeading">ニュース・お知らせ</h2>
                <p class="c-secDscr">Euniの最新情報をお届けします</p>
            </div>

            <div class="p-section__body">
                <div class="p-newsGrid">
                    <?php
                    // Get latest news posts (limit to 5)
                    $news_query = new WP_Query(array(
                        'post_type' => 'news',
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    // If no news posts exist, show dummy data
                    if (!$news_query->have_posts()) :
                        // Dummy news data
                        $dummy_news = array(
                            array(
                                'date' => '2025.10.01',
                                'category' => 'プレスリリース',
                                'category_class' => 'press',
                                'title' => '企業向け組織開発支援サービスを正式リリース',
                            ),
                            array(
                                'date' => '2025.09.15',
                                'category' => 'メディア掲載',
                                'category_class' => 'media',
                                'title' => '「現代社会の孤独・孤立問題」について代表インタビューが掲載されました',
                            ),
                            array(
                                'date' => '2025.09.01',
                                'category' => 'イベント',
                                'category_class' => 'event',
                                'title' => '第200回記念イベント「つながりの未来を考える」を開催しました',
                            ),
                            array(
                                'date' => '2025.08.20',
                                'category' => 'お知らせ',
                                'category_class' => 'info',
                                'title' => 'パートナー企業が50社を突破しました',
                            ),
                            array(
                                'date' => '2025.08.01',
                                'category' => 'プレスリリース',
                                'category_class' => 'press',
                                'title' => 'コミュニティ参加者数が500名を突破',
                            ),
                        );

                        foreach ($dummy_news as $news) :
                    ?>
                        <article class="c-newsCard">
                            <div class="c-newsCard__meta">
                                <time class="c-newsCard__date"><?php echo esc_html($news['date']); ?></time>
                                <span class="c-newsCard__cat -<?php echo esc_attr($news['category_class']); ?>">
                                    <?php echo esc_html($news['category']); ?>
                                </span>
                            </div>
                            <h3 class="c-newsCard__title">
                                <a href="#news"><?php echo esc_html($news['title']); ?></a>
                            </h3>
                        </article>
                    <?php
                        endforeach;

                    else :
                        // Display actual news posts
                        while ($news_query->have_posts()) : $news_query->the_post();
                            $categories = get_the_terms(get_the_ID(), 'news_category');
                            $cat_name = $categories ? $categories[0]->name : 'お知らせ';
                            $cat_slug = $categories ? $categories[0]->slug : 'info';
                    ?>
                        <article class="c-newsCard">
                            <div class="c-newsCard__meta">
                                <time class="c-newsCard__date"><?php echo get_the_date('Y.m.d'); ?></time>
                                <span class="c-newsCard__cat -<?php echo esc_attr($cat_slug); ?>">
                                    <?php echo esc_html($cat_name); ?>
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
                    <a href="<?php echo esc_url(home_url('/news/')); ?>" class="c-btn c-btn--outline-dark">
                        ニュース一覧を見る →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Overview Section -->
    <section id="business" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">BUSINESS</span>
                <h2 class="c-secHeading">事業内容</h2>
                <p class="c-secDscr">人と人とのつながりを支援し、一人ひとりの成長と可能性の実現に貢献します。</p>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col3">
                    <div class="c-card">
                        <div class="c-card__icon">👥</div>
                        <h3 class="c-card__title">成長支援コミュニティ事業</h3>
                        <p class="c-card__text">
                            互いに学び合い、成長し合えるコミュニティの企画・運営。
                            多様なバックグラウンドを持つメンバーとの出会いを通じて、新たな気づきと可能性を提供します。
                        </p>
                        <a href="#contact" class="c-btn-link">詳しく見る →</a>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon">💻</div>
                        <h3 class="c-card__title">ITソリューション事業</h3>
                        <p class="c-card__text">
                            つながり支援プラットフォームの開発・運営、企業向けITシステム開発・導入支援、AI活用コンサルティング、
                            業務効率化のためのデジタル化支援、起業家向けプロトタイプ開発支援を提供します。
                        </p>
                        <a href="#contact" class="c-btn-link">お問い合わせ →</a>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon">📊</div>
                        <h3 class="c-card__title">コンサルティング事業</h3>
                        <p class="c-card__text">
                            企業向けの組織開発支援、人材育成プログラムの設計・提供。
                            関係性の中での学びを重視した、持続可能な成長を支援します。
                        </p>
                        <a href="#contact" class="c-btn-link">お問い合わせ →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section id="vision" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">OUR VISION</span>
                <h2 class="c-secHeading">私たちのビジョン</h2>
            </div>

            <div class="p-section__body">
                <p class="c-bigText -center">
                    全ての人が善いつながりの中でありたい姿を実現できる社会を創造する
                </p>

                <div class="p-philosophy__content" style="margin-top: 4rem;">
                    <div class="p-philosophy__grid">
                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">Eunoia（ユーノイア）</h3>
                            <p class="c-boxCard__text">ギリシャ語で「善き心、美しい思考」を意味します。相手を思いやり、誠実に向き合う心を大切にします。</p>
                        </div>

                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">UNI</h3>
                            <p class="c-boxCard__text">User Network Interface - 人と人をつなぐ接点となること。つながりを生み出すプラットフォームを目指します。</p>
                        </div>

                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">Uni</h3>
                            <p class="c-boxCard__text">ラテン語で「一つ」を意味し、つながりの本質を表しています。一人ひとりが繋がり、共に成長する社会を創ります。</p>
                        </div>
                    </div>

                    <!-- Mission・Vision・Value Grid -->
                    <div class="p-mvvGrid" style="margin-top: 4rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
                        <div class="c-card -border">
                            <h3 class="c-card__label">Mission<span class="c-card__sublabel">使命</span></h3>
                            <p class="c-card__text -large" style="margin-bottom: 1.5rem;">
                                善き心でつながり合うことで、人々が自分らしく成長し、理想の未来を実現できる世界を創る
                            </p>
                            <div class="c-card__detail">
                                <p>
                                    私たちは、人と人とのつながりを支援し、孤独・孤立という社会課題の解決に取り組んでいます。
                                    善き心（Eunoia）を持った人々が出会い、つながり、共に成長し合えるコミュニティとプラットフォームを提供することで、
                                    一人ひとりが本来の可能性を発揮できる社会を実現します。
                                </p>
                            </div>
                        </div>

                        <div class="c-card -border">
                            <h3 class="c-card__label">Vision<span class="c-card__sublabel">目指す未来</span></h3>
                            <p class="c-card__text -large" style="margin-bottom: 1.5rem;">
                                善き心でつながり、共に成長し合うことが当たり前の社会を実現する
                            </p>
                            <div class="c-card__detail">
                                <p>
                                    孤独や孤立が社会問題となる現代において、私たちは人と人とのつながりの価値を再定義します。
                                    テクノロジーと温かみのある関係性を融合させ、誰もが安心して自分らしくいられる、
                                    新しい時代のコミュニティと働き方を創造していきます。
                                </p>
                            </div>
                        </div>

                        <div class="c-card -border">
                            <h3 class="c-card__label">Value<span class="c-card__sublabel">大切にする価値観</span></h3>
                            <p class="c-card__text -large" style="margin-bottom: 1.5rem;">
                                善き心、誠実さ、成長マインドを持って行動する
                            </p>
                            <div class="c-card__detail">
                                <ul>
                                    <li><strong>善き心（Eunoia）：</strong>相手を思いやり、誠実に向き合う心を大切にします</li>
                                    <li><strong>つながり（Connection）：</strong>多様性を尊重し、関係性の中での学びを重視します</li>
                                    <li><strong>成長（Growth）：</strong>常に学び、挑戦し、共に成長し続けます</li>
                                    <li><strong>誠実さ（Integrity）：</strong>透明性と説明責任を持って行動します</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CEO Message Section -->
    <section id="message" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">CEO MESSAGE</span>
                <h2 class="c-secHeading">代表メッセージ</h2>
            </div>

            <div class="p-section__body">
                <div class="p-ceoMessage">
                    <div class="p-ceoMessage__profile">
                        <div class="c-ceoCard">
                            <div class="c-ceoCard__photo">
                                <?php if ( get_theme_mod( 'euni_ceo_photo' ) ) : ?>
                                    <img src="<?php echo esc_url( get_theme_mod( 'euni_ceo_photo' ) ); ?>" alt="代表者写真">
                                <?php else : ?>
                                    <div class="c-ceoCard__placeholder">👤</div>
                                <?php endif; ?>
                            </div>
                            <div class="c-ceoCard__info">
                                <p class="c-ceoCard__title">代表取締役</p>
                                <p class="c-ceoCard__name">
                                    <?php echo esc_html( get_theme_mod( 'euni_ceo_name', '代表者名' ) ); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-ceoMessage__content">
                        <div class="c-messageBox">
                            <?php if ( get_theme_mod( 'euni_ceo_message' ) ) : ?>
                                <div class="c-messageBox__text">
                                    <?php echo nl2br( esc_html( get_theme_mod( 'euni_ceo_message' ) ) ); ?>
                                </div>
                            <?php else : ?>
                                <div class="c-messageBox__text">
                                    <p>
                                        私たちEuniは、「全ての人が善いつながりの中でありたい姿を実現できる社会を創造する」という理念のもと、
                                        人と人とのつながりを支援し、孤独・孤立という社会課題の解決に取り組んでいます。
                                    </p>
                                    <p>
                                        現代社会において、多くの人々が職場や私生活での人間関係に悩み、
                                        孤独を感じながら日々を過ごしています。しかし、人は本来、関係性の中でこそ成長し、
                                        可能性を開花させることができる存在です。
                                    </p>
                                    <p>
                                        私たちは、善き心を持った人々が出会い、つながり、共に成長し合えるコミュニティとプラットフォームを提供することで、
                                        一人ひとりが本来の自分を発揮し、理想の未来を実現できる社会を創っていきます。
                                    </p>
                                    <p>
                                        「善き心でつながり、共に成長し合うことが当たり前の社会」を実現することが、
                                        私たちのビジョンです。この挑戦に、ぜひご一緒していただければ幸いです。
                                    </p>
                                </div>
                                <?php if ( get_theme_mod( 'euni_ceo_career' ) ) : ?>
                                    <div class="c-messageBox__career">
                                        <h4>略歴</h4>
                                        <p><?php echo nl2br( esc_html( get_theme_mod( 'euni_ceo_career' ) ) ); ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Section -->
    <section id="company" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">COMPANY</span>
                <h2 class="c-secHeading">会社概要</h2>
            </div>

            <div class="p-section__body">
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
                            <?php if ( get_theme_mod( 'euni_ceo_name' ) ) : ?>
                            <tr>
                                <th>代表取締役</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_ceo_name' ) ); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_establishment' ) ) : ?>
                            <tr>
                                <th>設立</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_establishment' ) ); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_capital' ) ) : ?>
                            <tr>
                                <th>資本金</th>
                                <td><?php echo esc_html( get_theme_mod( 'euni_capital' ) ); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ( get_theme_mod( 'euni_address' ) ) : ?>
                            <tr>
                                <th>所在地</th>
                                <td><?php echo nl2br( esc_html( get_theme_mod( 'euni_address' ) ) ); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th>事業内容</th>
                                <td>
                                    <ul class="c-list">
                                        <li>成長支援コミュニティの企画・運営</li>
                                        <li>つながり支援プラットフォームの開発・運営</li>
                                        <li>ITシステム開発・導入支援、AI活用コンサルティング</li>
                                        <li>起業家向けプロトタイプ開発支援</li>
                                        <li>組織開発・人材育成プログラムの提供</li>
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
                <p class="c-secDscr">
                    サービスに関するご質問やご相談など、お気軽にお問い合わせください。
                </p>
            </div>

            <div class="p-section__body">
                <div class="p-contact__grid">
                    <!-- Contact Info -->
                    <div class="p-contact__info">
                        <div class="c-contactInfo">
                            <h3 class="c-contactInfo__title">お問い合わせ先</h3>

                            <?php if ( get_theme_mod( 'euni_email' ) ) : ?>
                                <div class="c-contactInfo__item">
                                    <div class="c-contactInfo__label">Email</div>
                                    <div class="c-contactInfo__value">
                                        <a href="mailto:<?php echo esc_attr( get_theme_mod( 'euni_email' ) ); ?>">
                                            <?php echo esc_html( get_theme_mod( 'euni_email' ) ); ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

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
