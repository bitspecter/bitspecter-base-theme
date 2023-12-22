<?php

add_action('admin_menu', 'add_theme_settings_page');
function add_theme_settings_page() {
    add_menu_page(
        __('Theme Settings', 'bitspecter'), 
        __('Theme Settings', 'bitspecter'),
        'manage_options', 
        'theme-settings', 
        'theme_settings_page', 
        'dashicons-admin-generic', 
        81
    );
}

// Vykresluje stránku nastavení
function theme_settings_page() {
    ?>
    <div class="wrap">
        <h1>
            <?= __('Theme Settings', 'bitspecter'); ?>
        </h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('general'); // Skupina nastavení
            do_settings_sections('theme-settings'); // Slug stránky
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registrace nastavení
add_action('admin_init', 'register_theme_settings');
function register_theme_settings() {
    register_setting('general', 'disable_comments', ['type' => 'boolean']);

    add_settings_section(
        'theme_settings_section',
        __('Theme Settings', 'bitspecter'),
        'theme_settings_section_cb',
        'theme-settings'
    );

    add_settings_field(
        'disable_comments',
        __('Disable Comments', 'bitspecter'),
        'disable_comments_cb',
        'theme-settings',
        'theme_settings_section'
    );
}

function theme_settings_section_cb() {
    echo '<p>' . __('Here you can set various template settings.', 'bitspecter') . '</p>';
}
function disable_comments_cb() {
    $disable_comments = get_option('disable_comments');
    $checked = ($disable_comments) ? 'checked' : '';
    echo '<input type="checkbox" id="disable_comments" name="disable_comments" value="1" ' . $checked . ' />';
}

// Přidání akcí a filtrů podmíněně na základě nastavení
if (get_option('disable_comments')) {
    add_action('admin_init', 'disable_comments_admin_init');
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    add_filter('comments_array', '__return_empty_array', 10, 2);
    add_action('admin_menu', 'disable_comments_admin_menu');
    add_action('init', 'disable_comments_init');
}

function disable_comments_admin_init() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

function disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}

function disable_comments_init() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
