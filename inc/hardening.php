<?php

namespace Bitspecter\Hardening;

defined('ABSPATH') || exit;

define_constants();
add_security_hooks();

/**
 * Defines necessary constants for security.
 */
function define_constants()
{
    defined('FORCE_SSL_ADMIN') || define('FORCE_SSL_ADMIN', true);
    defined('DISALLOW_FILE_EDIT') || define('DISALLOW_FILE_EDIT', true);
    defined('DISALLOW_FILE_MODS') || define('DISALLOW_FILE_MODS', true);
}

/**
 * Adds hooks related to security.
 */
function add_security_hooks()
{
    add_action('init', __NAMESPACE__ . '\\disable_wp_features');
    add_filter('redirect_canonical', __NAMESPACE__ . '\\prevent_user_enumeration', 10, 2);
    add_filter('login_errors', __NAMESPACE__ . '\\hide_login_errors');
    add_action('init', __NAMESPACE__ . '\\remove_unnecessary_wp_head_items');
    add_filter('rest_authentication_errors', __NAMESPACE__ . '\\disable_rest_api_for_unauthorized_users');
    add_action('send_headers', __NAMESPACE__ . '\\add_security_headers');
}

/**
 * Disables various WordPress features for security enhancements.
 */
function disable_wp_features()
{
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');
    add_filter('pings_open', '__return_false');
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('the_generator', '__return_empty_string');
    header_remove('x-powered-by');
}

/**
 * Prevents enumeration of usernames through '?author=(id)' URLs.
 */
function prevent_user_enumeration($redirect_url, $requested_url)
{
    if (preg_match('/\?author=([0-9]*)/i', $requested_url)) {
        return home_url();
    }
    return $redirect_url;
}

/**
 * Hides login errors for security.
 */
function hide_login_errors()
{
    return __('Login details are incorrect.', 'theme-domain');
}

/**
 * Removes unnecessary information from the <head> tag.
 */
function remove_unnecessary_wp_head_items()
{
    $head_items_to_remove = [
        'feed_links', 'feed_links_extra', 'rsd_link', 'wlwmanifest_link',
        'wp_generator', 'start_post_rel_link', 'index_rel_link',
        'parent_post_rel_link', 'adjacent_posts_rel_link_wp_head',
        'wp_oembed_add_discovery_links', 'rest_output_link_wp_head',
        'rest_output_link_header', 'wp_shortlink_header'
    ];

    foreach ($head_items_to_remove as $item) {
        remove_action('wp_head', $item);
    }
}

/**
 * Disables the JSON REST API for unauthorized users.
 */
function disable_rest_api_for_unauthorized_users($access)
{
    if (!is_user_logged_in()) {
        return new WP_Error('rest_cannot_access', 'Pouze autorizovaní uživatelé mají přístup k REST API.', array('status' => rest_authorization_required_code()));
    }
    return $access;
}

/**
 * Adds various security headers.
 */
function add_security_headers()
{
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: no-referrer-when-downgrade");
    header("Content-Security-Policy: upgrade-insecure-requests;");
    header('Strict-Transport-Security: "max-age=31536000" env=HTTPS');
}
