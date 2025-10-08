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
                        <span class="c-logo__text"><?php bloginfo( 'name' ); ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>

            <nav id="gnav" class="l-header__gnav c-gnavWrap">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'c-gnav',
                            'container'      => false,
                            'fallback_cb'    => false,
                        )
                    );
                }
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="l-content">
