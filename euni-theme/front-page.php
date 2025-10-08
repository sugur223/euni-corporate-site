<?php
/**
 * Front Page Template (SWELL-based structure with Euni content)
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
            <p class="p-hero__text">全ての人がありたい姿を実現できる社会を創造します</p>
            <div class="p-hero__btns">
                <a href="#contact" class="c-btn c-btn--primary">お問い合わせ</a>
            </div>
        </div>
    </div>
</div>

<div class="l-mainContent">

    <!-- Stats Section -->
    <section class="p-stats">
        <div class="l-container">
            <div class="p-stats__grid">
                <div class="c-statCard">
                    <div class="c-statCard__number">500+</div>
                    <div class="c-statCard__label">コミュニティ参加者</div>
                    <div class="c-statCard__text">若手社会人が成長を実感</div>
                </div>
                <div class="c-statCard">
                    <div class="c-statCard__number">95%</div>
                    <div class="c-statCard__label">満足度</div>
                    <div class="c-statCard__text">参加者の継続率</div>
                </div>
                <div class="c-statCard">
                    <div class="c-statCard__number">200+</div>
                    <div class="c-statCard__label">イベント開催数</div>
                    <div class="c-statCard__text">オンライン・オフライン合計</div>
                </div>
                <div class="c-statCard">
                    <div class="c-statCard__number">50+</div>
                    <div class="c-statCard__label">企業パートナー</div>
                    <div class="c-statCard__text">共に価値を創造</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section id="philosophy" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">PHILOSOPHY</span>
                <h2 class="c-secHeading">企業理念</h2>
            </div>

            <div class="p-section__body">
                <p class="c-bigText -center">
                    善き心でつながり、全ての人がありたい姿を実現できる社会を創造する
                </p>

                <div class="p-philosophy__content">
                    <p class="c-text -large">
                        <strong>Euni（ユニ）</strong>という社名には、3つの意味が込められています。
                    </p>

                    <div class="p-philosophy__grid">
                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">Eunoia（ユーノイア）</h3>
                            <p class="c-boxCard__text">ギリシャ語で「善き心、美しい思考」を意味します。</p>
                        </div>

                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">UNI</h3>
                            <p class="c-boxCard__text">User Network Interface - 人と人をつなぐ接点となること。</p>
                        </div>

                        <div class="c-boxCard">
                            <h3 class="c-boxCard__title">Uni</h3>
                            <p class="c-boxCard__text">ラテン語で「一つ」を意味し、つながりの本質を表しています。</p>
                        </div>
                    </div>

                    <p class="c-text -large -center" style="margin-top: 3rem;">
                        私たちは、善き心でつながり合うことで、一人ひとりが自分らしく成長し、<br>
                        理想の未来を実現できる社会を創造します。
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section -->
    <section id="service" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">SERVICE</span>
                <h2 class="c-secHeading">事業内容</h2>
                <p class="c-secDscr">若手社会人の成長とつながりを支援し、孤独・孤立問題の解決に貢献します。</p>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col3">
                    <div class="c-card">
                        <div class="c-card__icon">👥</div>
                        <h3 class="c-card__title">成長支援コミュニティ</h3>
                        <p class="c-card__text">
                            若手社会人が互いに学び合い、成長し合えるコミュニティを企画・運営しています。
                            多様なバックグラウンドを持つメンバーとの出会いを通じて、新たな気づきと可能性を提供します。
                        </p>
                        <div class="c-card__detail">
                            <strong>主な活動：</strong>
                            <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                                <li>月2回のオンライン勉強会</li>
                                <li>四半期ごとのオフライン交流会</li>
                                <li>テーマ別の分科会活動</li>
                            </ul>
                        </div>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon">🔗</div>
                        <h3 class="c-card__title">つながり支援サービス</h3>
                        <p class="c-card__text">
                            テクノロジーと人の温かみを融合させた、つながり支援サービスを開発・提供しています。
                            善き心でのつながりを大切にし、一人ひとりに寄り添ったサポートを実現します。
                        </p>
                        <div class="c-card__detail">
                            <strong>提供サービス：</strong>
                            <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                                <li>マッチング支援プラットフォーム</li>
                                <li>1on1メンタリング</li>
                                <li>キャリア相談窓口</li>
                            </ul>
                        </div>
                    </div>

                    <div class="c-card">
                        <div class="c-card__icon">🌱</div>
                        <h3 class="c-card__title">成長支援プログラム</h3>
                        <p class="c-card__text">
                            個人の強みを活かし、本来の自分らしさを発揮できる成長プログラムを提供します。
                            関係性の中での学びを重視し、持続可能な成長を支援します。
                        </p>
                        <div class="c-card__detail">
                            <strong>プログラム例：</strong>
                            <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                                <li>リーダーシップ開発</li>
                                <li>キャリアデザイン研修</li>
                                <li>コミュニケーション強化</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MVV Section -->
    <section id="mvv" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">MISSION & VISION</span>
                <h2 class="c-secHeading">ミッション & ビジョン</h2>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col2">
                    <div class="c-card -border">
                        <h3 class="c-card__label">Mission<span class="c-card__sublabel">使命</span></h3>
                        <p class="c-card__text -large">
                            善き心でつながり合うことで、人々が自分らしく成長し、理想の未来を実現できる世界を創る
                        </p>
                    </div>

                    <div class="c-card -border">
                        <h3 class="c-card__label">Vision<span class="c-card__sublabel">目指す未来</span></h3>
                        <p class="c-card__text -large">
                            2030年までに「善き心でつながり、共に成長し合うことが当たり前の社会」を実現する
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section id="values" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">VALUES</span>
                <h2 class="c-secHeading">大切にする価値観</h2>
                <p class="c-secDscr">私たちが日々の活動において大切にしている5つの価値観です。</p>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col3">
                    <div class="c-valueCard">
                        <div class="c-valueCard__num">01</div>
                        <h3 class="c-valueCard__title">Eunoia Spirit<span class="c-valueCard__subtitle">善き心の精神</span></h3>
                        <p class="c-valueCard__text">
                            相手の立場に立ち、一人ひとりの個性と可能性を信じます。
                            誠実さと思いやりを持って、全ての人との関係を築きます。
                        </p>
                    </div>

                    <div class="c-valueCard">
                        <div class="c-valueCard__num">02</div>
                        <h3 class="c-valueCard__title">Authentic Being<span class="c-valueCard__subtitle">本来の自分</span></h3>
                        <p class="c-valueCard__text">
                            他人との比較ではなく、自分らしい道を歩むことを支援します。
                            一人ひとりが本来の自分を発揮できる環境を大切にします。
                        </p>
                    </div>

                    <div class="c-valueCard">
                        <div class="c-valueCard__num">03</div>
                        <h3 class="c-valueCard__title">Connected Growth<span class="c-valueCard__subtitle">つながりの中の成長</span></h3>
                        <p class="c-valueCard__text">
                            関係性の中でこそ、新たな気づき、創造性、可能性が生まれると信じています。
                            共に学び、成長し合うコミュニティを大切にします。
                        </p>
                    </div>

                    <div class="c-valueCard">
                        <div class="c-valueCard__num">04</div>
                        <h3 class="c-valueCard__title">Thoughtful Innovation<span class="c-valueCard__subtitle">思いやりのあるイノベーション</span></h3>
                        <p class="c-valueCard__text">
                            テクノロジーは手段、人の幸福が目的です。
                            人の温かみを大切にしながら、革新的なソリューションを創造します。
                        </p>
                    </div>

                    <div class="c-valueCard">
                        <div class="c-valueCard__num">05</div>
                        <h3 class="c-valueCard__title">Sustainable Impact<span class="c-valueCard__subtitle">持続可能な価値創造</span></h3>
                        <p class="c-valueCard__text">
                            一時的な解決ではなく、根本的な変化を追求します。
                            長期的な視点で、持続可能な社会価値を創造していきます。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Voice Section -->
    <section id="voice" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">VOICE</span>
                <h2 class="c-secHeading">参加者の声</h2>
                <p class="c-secDscr">コミュニティに参加した方々の生の声をご紹介します。</p>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col3">
                    <div class="c-voiceCard">
                        <div class="c-voiceCard__header">
                            <div class="c-voiceCard__avatar">👤</div>
                            <div class="c-voiceCard__info">
                                <div class="c-voiceCard__name">A.T さん</div>
                                <div class="c-voiceCard__meta">IT企業 / 入社3年目</div>
                            </div>
                        </div>
                        <p class="c-voiceCard__text">
                            「同じ境遇の仲間と出会え、悩みを共有できたことで、仕事への向き合い方が変わりました。
                            月1回のイベントが今では楽しみで仕方ありません。」
                        </p>
                    </div>

                    <div class="c-voiceCard">
                        <div class="c-voiceCard__header">
                            <div class="c-voiceCard__avatar">👤</div>
                            <div class="c-voiceCard__info">
                                <div class="c-voiceCard__name">M.K さん</div>
                                <div class="c-voiceCard__meta">メーカー / 入社2年目</div>
                            </div>
                        </div>
                        <p class="c-voiceCard__text">
                            「他業界の方との交流で視野が広がり、自分のキャリアについて深く考えるきっかけになりました。
                            一人では気づけなかった強みを発見できました。」
                        </p>
                    </div>

                    <div class="c-voiceCard">
                        <div class="c-voiceCard__header">
                            <div class="c-voiceCard__avatar">👤</div>
                            <div class="c-voiceCard__info">
                                <div class="c-voiceCard__name">S.Y さん</div>
                                <div class="c-voiceCard__meta">コンサル / 入社4年目</div>
                            </div>
                        </div>
                        <p class="c-voiceCard__text">
                            「孤独を感じていた社会人生活が一変しました。ここには本音で話せる仲間がいて、
                            お互いの成長を応援し合える環境があります。」
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="p-section">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">FEATURES</span>
                <h2 class="c-secHeading">Euniが選ばれる理由</h2>
            </div>

            <div class="p-section__body">
                <div class="p-cardGrid -col2">
                    <div class="c-featureCard">
                        <div class="c-featureCard__icon">🎯</div>
                        <h3 class="c-featureCard__title">厳選されたコミュニティメンバー</h3>
                        <p class="c-featureCard__text">
                            成長意欲の高い若手社会人のみが参加。事前審査により、
                            互いに高め合える質の高いコミュニティを実現しています。
                        </p>
                        <ul class="c-featureCard__list">
                            <li>多様な業界・職種から参加</li>
                            <li>20代〜30代前半が中心</li>
                            <li>主体的に学ぶ姿勢を重視</li>
                        </ul>
                    </div>

                    <div class="c-featureCard">
                        <div class="c-featureCard__icon">📚</div>
                        <h3 class="c-featureCard__title">体系的な成長プログラム</h3>
                        <p class="c-featureCard__text">
                            キャリア、リーダーシップ、コミュニケーションなど、
                            若手社会人に必要なスキルを段階的に学べる設計です。
                        </p>
                        <ul class="c-featureCard__list">
                            <li>月2回のオンラインイベント</li>
                            <li>四半期ごとのオフライン交流会</li>
                            <li>個別メンタリング制度</li>
                        </ul>
                    </div>

                    <div class="c-featureCard">
                        <div class="c-featureCard__icon">🤝</div>
                        <h3 class="c-featureCard__title">本音で話せる安心な場</h3>
                        <p class="c-featureCard__text">
                            守秘義務の徹底と心理的安全性の確保により、
                            普段は言えない悩みや本音を共有できる環境を提供します。
                        </p>
                        <ul class="c-featureCard__list">
                            <li>少人数グループでの対話</li>
                            <li>経験豊富なファシリテーター</li>
                            <li>非競争的な支援文化</li>
                        </ul>
                    </div>

                    <div class="c-featureCard">
                        <div class="c-featureCard__icon">🌐</div>
                        <h3 class="c-featureCard__title">全国どこからでも参加可能</h3>
                        <p class="c-featureCard__text">
                            オンラインを中心としたハイブリッド形式により、
                            地方在住の方も首都圏と同等の学びと出会いを得られます。
                        </p>
                        <ul class="c-featureCard__list">
                            <li>オンライン完結型イベント</li>
                            <li>録画による見逃し配信</li>
                            <li>地域別オフ会の開催</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="p-section -bg">
        <div class="l-container">
            <div class="p-section__head">
                <span class="c-secLabel">FAQ</span>
                <h2 class="c-secHeading">よくあるご質問</h2>
            </div>

            <div class="p-section__body">
                <div class="p-faq">
                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">どのような方が参加していますか？</h3>
                        <p class="c-faqItem__answer">
                            20代〜30代前半の若手社会人が中心です。業界はIT、コンサル、メーカー、金融、商社など多岐にわたり、
                            多様なバックグラウンドを持つメンバーが集まっています。共通しているのは、自己成長への高い意欲と、
                            他者との関わりの中で学びたいという姿勢です。
                        </p>
                    </div>

                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">参加にあたって審査はありますか？</h3>
                        <p class="c-faqItem__answer">
                            はい、事前に簡単な面談を行っています。これは選別ではなく、コミュニティの価値観や
                            活動内容がご自身に合っているかを相互に確認するためのものです。
                            成長意欲と他者への敬意を持っている方であれば、どなたでもご参加いただけます。
                        </p>
                    </div>

                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">忙しくて毎回参加できないのですが大丈夫ですか？</h3>
                        <p class="c-faqItem__answer">
                            はい、大丈夫です。オンラインイベントは録画を共有していますので、
                            後日視聴することも可能です。ご自身のペースで無理なく参加していただけます。
                            ただし、継続的な参加がより多くの学びと出会いにつながります。
                        </p>
                    </div>

                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">費用はどのくらいかかりますか？</h3>
                        <p class="c-faqItem__answer">
                            コミュニティへの参加は月額制となっており、詳細はお問い合わせください。
                            質の高いプログラム提供と持続可能な運営のため、適正な料金を設定しています。
                            初回は無料体験イベントにご参加いただけます。
                        </p>
                    </div>

                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">退会はいつでもできますか？</h3>
                        <p class="c-faqItem__answer">
                            はい、いつでも退会可能です。最低利用期間などの縛りはありません。
                            ただし、継続的な参加によって得られる学びや人間関係の深まりを考えると、
                            最低でも3ヶ月程度の参加をお勧めしています。
                        </p>
                    </div>

                    <div class="c-faqItem">
                        <h3 class="c-faqItem__question">地方在住ですが参加できますか？</h3>
                        <p class="c-faqItem__answer">
                            はい、もちろんです。イベントの多くはオンラインで開催されており、
                            全国どこからでもご参加いただけます。また、地域ごとのオフライン交流会も
                            定期的に企画していますので、近隣のメンバーとリアルで会う機会もあります。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Section -->
    <section id="company" class="p-section -bg">
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
                                        <li>若手社会人向けの成長支援コミュニティの企画・運営</li>
                                        <li>つながり支援サービスの開発・提供</li>
                                        <li>成長支援プログラムの提供</li>
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
                <span class="c-secLabel -white">CONTACT</span>
                <h2 class="c-secHeading -white">お問い合わせ</h2>
                <p class="c-secDscr -white">
                    サービスに関するご質問やご相談など、お気軽にお問い合わせください。
                </p>
            </div>

            <div class="p-section__body">
                <?php if ( get_theme_mod( 'euni_email' ) ) : ?>
                    <div class="p-contact__info">
                        <p class="p-contact__email">
                            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'euni_email' ) ); ?>">
                                <?php echo esc_html( get_theme_mod( 'euni_email' ) ); ?>
                            </a>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</div><!-- .l-mainContent -->

<?php
get_footer();
