<?php
/**
 * Template Name: Educational Blog Theme
 * Author: Your Name
 * Description: A clean and minimalist WordPress theme for educational content, updates, and announcements.
 */

// Ensure the WordPress environment is loaded.
if (!defined('ABSPATH')) exit;

/**
 * Functions.php file: Theme setup and custom functions.
 */
function educational_blog_theme_setup() {
    // Support for dynamic titles.
    add_theme_support('title-tag');

    // Support for featured images.
    add_theme_support('post-thumbnails');

    // Register navigation menus.
    register_nav_menus([
        'primary' => __('Primary Menu', 'educational-blog')
    ]);
}
add_action('after_setup_theme', 'educational_blog_theme_setup');

function educational_blog_enqueue_styles() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'educational_blog_enqueue_styles');

/**
 * Header.php: Theme header.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <nav>
            <?php wp_nav_menu(['theme_location' => 'primary']); ?>
        </nav>
    </header>

<?php
/**
 * Index.php: Main template file.
 */
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile;
else : ?>
    <p><?php _e('No posts found.', 'educational-blog'); ?></p>
<?php endif; ?>

<?php
/**
 * Footer.php: Theme footer.
 */
?>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Educational Blog. All rights reserved.</p>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
