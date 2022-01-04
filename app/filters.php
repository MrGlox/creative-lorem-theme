<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});


/**
 * Remove admin custom field tab.
 *
 * @return bool
 */
add_filter('acf/settings/show_admin', '__return_false');

/**
 * Remove admin footer text.
 *
 * @return bool
 */
add_filter('admin_footer_text', '__return_false', 100);

/**
 * Allow some uploads
 *
 * @return array
 */
add_filter('upload_mimes', function ($mime_types) {
    $mime_types['json'] = 'application/json'; // Adding .json extension
    $mime_types['svg'] = 'image/svg+xml'; // Adding .svg 
    return $mime_types;
}, 1, 1);
