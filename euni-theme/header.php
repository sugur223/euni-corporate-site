<?php
/**
 * Header Template (SWELL-based structure)
 *
 * @package Euni_Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="body_wrap" class="l-body">

    <!-- Header -->
    <header id="header" class="l-header">
        <div class="l-header__inner l-container">
            <div class="l-header__logo">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-logo" rel="home">
                        <span class="c-logo__text">株式会社ユニ</span>
                    </a>
                    <?php
                }
                ?>
            </div>

            <!-- ハンバーガーメニューボタン -->
            <button class="l-header__toggle" id="menuToggle" aria-label="メニューを開く" aria-expanded="false">
                <span class="l-header__toggle-bar"></span>
                <span class="l-header__toggle-bar"></span>
                <span class="l-header__toggle-bar"></span>
            </button>

            <nav id="gnav" class="l-header__gnav c-gnavWrap">
                <ul class="c-gnav" id="primary-menu">
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#mvv' ) ); ?>">企業理念</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#philosophy' ) ); ?>">社名の由来</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#business' ) ); ?>">事業概要</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#message' ) ); ?>">代表メッセージ</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">ニュース</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#company' ) ); ?>">会社概要</a></li>
                    <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">お問い合わせ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div id="content" class="l-content">
