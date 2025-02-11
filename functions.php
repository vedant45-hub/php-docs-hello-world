<?php
function educational_blog_theme_setup() {
    // Add support for dynamic title tags
    add_theme_support('title-tag');
    
    // Add support for featured images
    add_theme_support('post-thumbnails');
    
    // Register navigation menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'educational-blog')
    ]);
}
add_action('after_setup_theme', 'educational_blog_theme_setup');

function educational_blog_enqueue_styles() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'educational_blog_enqueue_styles');
?>
