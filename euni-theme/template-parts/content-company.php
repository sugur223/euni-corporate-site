<?php
/**
 * Template part for displaying Company Information section
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get company information from customizer
$euni_ceo         = get_theme_mod( 'euni_ceo_name', '' );
$euni_established = get_theme_mod( 'euni_establishment', '' );
$euni_capital     = get_theme_mod( 'euni_capital', '' );
$euni_address     = get_theme_mod( 'euni_address', '' );
$euni_phone       = get_theme_mod( 'euni_phone', '' );
$euni_email       = get_theme_mod( 'euni_email', '' );
?>

<section id="company" class="section section-bg-light">
    <div class="container text-center">
        <span class="section-label">COMPANY</span>
        <h2 class="section-title">会社概要</h2>

        <div class="company-table">
            <table>
                <tbody>
                    <tr>
                        <th>会社名</th>
                        <td>株式会社Euni</td>
                    </tr>
                    <tr>
                        <th>英語表記</th>
                        <td>Euni Inc.</td>
                    </tr>
                    <?php if ( $euni_ceo ) : ?>
                    <tr>
                        <th>代表取締役</th>
                        <td><?php echo esc_html( $euni_ceo ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( $euni_established ) : ?>
                    <tr>
                        <th>設立</th>
                        <td><?php echo esc_html( $euni_established ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( $euni_capital ) : ?>
                    <tr>
                        <th>資本金</th>
                        <td><?php echo esc_html( $euni_capital ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( $euni_address ) : ?>
                    <tr>
                        <th>所在地</th>
                        <td><?php echo nl2br( esc_html( $euni_address ) ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( $euni_phone ) : ?>
                    <tr>
                        <th>電話番号</th>
                        <td><a href="tel:<?php echo esc_attr( str_replace( array( '-', ' ', '(', ')' ), '', $euni_phone ) ); ?>"><?php echo esc_html( $euni_phone ); ?></a></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( $euni_email ) : ?>
                    <tr>
                        <th>メールアドレス</th>
                        <td><a href="mailto:<?php echo esc_attr( $euni_email ); ?>"><?php echo esc_html( $euni_email ); ?></a></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>事業内容</th>
                        <td style="text-align: left;">
                            <ul style="list-style: disc; padding-left: 1.5rem;">
                                <li style="margin-bottom: 0.5rem;">若手社会人向けの成長支援コミュニティの企画・運営</li>
                                <li style="margin-bottom: 0.5rem;">つながり支援サービスの開発・提供</li>
                                <li>成長支援プログラムの提供</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if ( ! $euni_ceo && ! $euni_established && ! $euni_capital && ! $euni_address ) : ?>
        <p style="margin-top: 2rem; color: var(--color-text-light); font-size: 0.9rem;">
            ※ 会社情報は、WordPressの「外観」→「カスタマイズ」→「会社情報」から編集できます。
        </p>
        <?php endif; ?>
    </div>
</section>
