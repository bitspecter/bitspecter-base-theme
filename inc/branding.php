<?php

namespace Bitspecter\Branding;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adds a custom item to the WordPress admin bar.
 * 
 * @param WP_Admin_Bar $admin_bar The WordPress Admin Bar object.
 */
function admin_bar_item(\WP_Admin_Bar $admin_bar)
{
    $admin_bar->add_menu(array(
        'parent' => 'bitspecter',
        'title'  => 'Support',
        'href'   => 'https://bitspecter.com/kontakt',
        'meta'   => [
            'target' => '_blank',
        ]
    ));
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\admin_bar_item', 500);

/**
 * Changes the login logo URL to the site's home page.
 * 
 * @return string Home URL of the site.
 */
function login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', __NAMESPACE__ . '\\login_logo_url');

/**
 * Changes the login page logo to a custom logo.
 * Enqueues a custom style sheet for the login page.
 */
function login_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    if ($logo) {
        wp_enqueue_style('bitspecter-custom-login', get_stylesheet_directory_uri() . '/css/custom-login.css');
    }
}
add_action('login_enqueue_scripts', __NAMESPACE__ . '\\login_logo');

/**
 * Adds custom CSS to the WordPress login page.
 * This is where the actual styles for the custom logo are applied.
 */
function bitspecter_login_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    $logoSrc = $logo ? $logo[0] : get_stylesheet_directory_uri() . '/resources/images/logo.png';

    echo '<style type="text/css">
        #wpml-login-ls-form, #backtoblog { display: none !important; }
        h1 a { background-image:url(' . $logoSrc . ') !important; background-size: contain !important; }
    </style>';
}

add_action('login_head', __NAMESPACE__ . '\\bitspecter_login_logo');

function custom_login_stylesheet() {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/css/login.css');
}
add_action('login_enqueue_scripts', __NAMESPACE__ . '\\custom_login_stylesheet');

function custom_admin_footer_text() {
    return 'Powered by <a href="https://bitspecter.com" target="_blank">BitSpecter</a>';
}
add_filter('admin_footer_text', __NAMESPACE__ . '\\custom_admin_footer_text');
