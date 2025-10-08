<?php
/**
 * Search Form Template
 *
 * @package Euni_Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-field" class="screen-reader-text">
        <?php esc_html_e( '検索:', 'euni-theme' ); ?>
    </label>
    <div class="search-form-wrapper">
        <input
            type="search"
            id="search-field"
            class="search-field"
            placeholder="<?php echo esc_attr_x( 'キーワードを入力', 'placeholder', 'euni-theme' ); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        />
        <button type="submit" class="search-submit">
            <span class="screen-reader-text"><?php esc_html_e( '検索', 'euni-theme' ); ?></span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM18.5 18.5l-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</form>

<style>
.search-form {
    width: 100%;
}

.search-form-wrapper {
    display: flex;
    align-items: center;
    position: relative;
}

.search-form .search-field {
    width: 100%;
    padding: 0.75rem 3rem 0.75rem 1rem;
    font-size: 1rem;
    border: 2px solid var(--color-border, #e2e8f0);
    border-radius: 50px;
    background-color: var(--color-bg-white, #ffffff);
    transition: all 0.3s ease;
}

.search-form .search-field:focus {
    outline: none;
    border-color: var(--color-primary, #2563eb);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-form .search-submit {
    position: absolute;
    right: 0.5rem;
    width: 40px;
    height: 40px;
    padding: 0;
    border: none;
    background-color: var(--color-primary, #2563eb);
    color: var(--color-bg-white, #ffffff);
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.search-form .search-submit:hover {
    background-color: var(--color-gradient-start, #667eea);
    transform: scale(1.05);
}

.search-form .search-submit svg {
    width: 18px;
    height: 18px;
}
</style>
