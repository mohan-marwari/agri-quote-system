<?php
if (!defined('WP_DEBUG')) {
    die('Direct access forbidden.');
}

// Enqueue scripts and styles
function blocksy_child_enqueue_assets() {
    // Parent style
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Child CSS
    wp_enqueue_style(
        'blocksy-child-css',
        get_stylesheet_directory_uri() . '/assets/css/custom.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/custom.css')
    );
    
    // Child JS
    wp_enqueue_script(
        'blocksy-child-js',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        array('jquery'),
        filemtime(get_stylesheet_directory() . '/assets/js/custom.js'),
        true
    );
    
    // Localize script for AJAX URL
    wp_localize_script('blocksy-child-js', 'blocksy_child_vars', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'blocksy_child_enqueue_assets');

// WooCommerce modifications
require_once get_stylesheet_directory() . '/inc/woocommerce.php';

// AJAX handlers
require_once get_stylesheet_directory() . '/inc/ajax-handlers.php';