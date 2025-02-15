<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
        <nav class="main-nav">
            <?php wp_nav_menu(['theme_location' => 'primary']); ?>
        </nav>
    </header>
