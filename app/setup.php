<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\asset;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), ['jquery'], null, true);
    wp_enqueue_script('sage/app.js', asset('scripts/app.js')->uri(), ['sage/vendor.js', 'jquery'], null, true);

    wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_style('sage/app.css', asset('styles/app.css')->uri(), false, null);
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    if ($manifest = asset('scripts/manifest.asset.php')->get()) {
        wp_enqueue_script('sage/vendor.js', asset('scripts/vendor.js')->uri(), $manifest['dependencies'], null, true);
        wp_enqueue_script('sage/editor.js', asset('scripts/editor.js')->uri(), ['sage/vendor.js'], null, true);

        wp_add_inline_script('sage/vendor.js', asset('scripts/manifest.js')->contents(), 'before');
    }

    wp_enqueue_style('sage/editor.css', asset('styles/editor.css')->uri(), false, null);
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls'
    ]);

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Add theme support for Wide Alignment
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('align-wide');

    /**
     * Enable responsive embeds
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style'
    ]);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Enable theme color palette support
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
     */
    add_theme_support('editor-color-palette', [
        [
            'name' => __('Primary', 'sage'),
            'slug' => 'primary',
            'color' => '#525ddc',
        ]
    ]);
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];

    $footerConfig = [
        'before_widget' => '<li class="footer__column %1$s %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="footer__title">',
        'after_title' => '</h3>'
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary'
    ] + $config);

    register_sidebar([
        'name' => __('Footer Main', 'sage'),
        'id' => 'sidebar-footer-main'
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column 1', 'sage'),
        'id' => 'sidebar-column-1'
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column 2', 'sage'),
        'id' => 'sidebar-column-2'
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column 3', 'sage'),
        'id' => 'sidebar-column-3'
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Column 4', 'sage'),
        'id' => 'sidebar-column-4'
    ] + $footerConfig);

    register_sidebar([
        'name' => __('Footer Low', 'sage'),
        'id' => 'sidebar-footer-low'
    ] + [
        'before_widget' => '<div class="footer__inline-element %1$s %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="footer__title footer__title--hidden">',
        'after_title' => '</h3>'
    ]);
});

/**
 * Add favicons to <head>.
 * See: https://gist.github.com/schalkburger/46862231f41702018e6f46e65b360297
 */
add_action('wp_head', function () {
    $favicon_path = get_template_directory_uri() . '/resources/assets/images/favicons';
?>
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-57x57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-60x60.png" sizes="60x60">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-72x72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-114x114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-120x120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-144x144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-152x152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="<?php echo $favicon_path; ?>/apple-icon-180x180.png" sizes="180x180">
    <link rel="icon" type="image/png" href="<?php echo $favicon_path; ?>/android-icon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo $favicon_path; ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo $favicon_path; ?>/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo $favicon_path; ?>/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo $favicon_path; ?>/manifest.json">
    <meta name="msapplication-TileColor" content="#000">
    <meta name="msapplication-TileImager" content="ms-icon-144x144">
    <meta name="theme-color" content="#000">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon_path; ?>/favicon.ico">
    <link rel="icon" type="image/x-icon" href="<?php echo $favicon_path; ?>/favicon.ico">
<?php
});
