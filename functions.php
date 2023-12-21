<?php

include_once( get_template_directory() . '/inc/branding.php' );
include_once( get_template_directory() . '/inc/hardening.php' );
include_once( get_template_directory() . '/inc/performance.php' );


function bitspecter_setup() {
    do_action( 'bitspecter_before_setup' );

    $logoDefaults = apply_filters( 'bitspecter_logo_defaults', array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    ));

    load_theme_textdomain( 'bitspecter', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true ); // Příklad velikosti

    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', $logoDefaults );
    
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    do_action( 'bitspecter_after_setup' );
}

add_action( 'after_setup_theme', 'bitspecter_setup' );

add_filter( 'auto_plugin_update_send_email', fn() => false );
add_filter( 'auto_theme_update_send_email', fn() => false );