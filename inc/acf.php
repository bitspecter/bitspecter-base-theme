<?php

function register_option_pages() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => __('Page Settings', 'bitspecter'),
            'menu_title' => __('Page Settings', 'bitspecter'),
            'menu_slug'  => 'general-settings',
            'capability' => 'edit_theme_options',
            'redirect'   => false
        ));
    }
}

add_action( 'acf/init', 'register_option_pages' );