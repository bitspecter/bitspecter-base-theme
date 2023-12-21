<?php

namespace Bitspecter\Performance;

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', __NAMESPACE__ . '\\disable_emojis');
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\dequeue_unnecessary_scripts', 100);
add_action('after_setup_theme', __NAMESPACE__ . '\\remove_wp_meta_tags');
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\optimize_jquery');
add_action('init', __NAMESPACE__ . '\\enable_lazy_load');

/**
 * Disables emojis which removes the extra scripts and styles loaded by WordPress.
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

/**
 * Dequeues unnecessary scripts and styles to improve performance.
 */
function dequeue_unnecessary_scripts()
{
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_script('wp-embed');
    }
}

/**
 * Removes unnecessary WordPress meta tags from the head.
 */
function remove_wp_meta_tags()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}

/**
 * Optimizes jQuery loading by loading it from a CDN and only when necessary.
 */
function optimize_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, '3.6.0', true);
        add_filter('script_loader_tag', __NAMESPACE__ . '\\add_defer_attribute', 10, 2);
    }
}

/**
 * Adds defer attribute to scripts for non-blocking loading.
 */
function add_defer_attribute($tag, $handle)
{
    if ('jquery' === $handle) {
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    return $tag;
}

/**
 * Enables native lazy loading of images in WordPress.
 */
function enable_lazy_load()
{
    add_filter('wp_lazy_loading_enabled', '__return_true');
}
