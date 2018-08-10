<?php
/**
* Disabled/Remove default wordpress function
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

/**
* Remove Emoji (emotniki :) )
* @credits https://wordpress.org/plugins/disable-emojis/
*/
function wpg_disable_emojis() {

    remove_action('wp_head', 'print_emoji_detection_script', 7); // Front-end browser support detection script
    remove_action('admin_print_scripts', 'print_emoji_detection_script'); // Admin browser support detection script
    remove_action('wp_print_styles', 'print_emoji_styles'); // Emoji styles
    remove_action('admin_print_styles', 'print_emoji_styles'); // Admin emoji styles
    remove_filter('the_content_feed', 'wp_staticize_emoji'); // Remove from feed, this is bad behaviour!
    remove_filter('comment_text_rss', 'wp_staticize_emoji'); // Remove from feed, this is bad behaviour!
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); // Remove from mail
    if (get_site_option('initial_db_version') >= 32453) {
        remove_action('init', 'smilies_init', 5); // This removes the ascii to smiley convertion
    }
    //* Remove DNS prefetch s.w.org (used for emojis, since WP 4.7)
    add_filter('emoji_svg_url', '__return_false');
    //* Remove DNS prefetch s.w.org (used for emojis, since WP 4.7)
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'wpg_disable_emojis', 4);

/**
* Disable 'medium_large' Image size
*/
function wpg_filter_image_sizes($sizes) {

    unset( $sizes['medium_large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'wpg_filter_image_sizes');

/**
* Function to remove version numbers
*/
function wpg_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}
// Remove WP Version From Styles
//add_filter( 'style_loader_src', 'wpg_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
//add_filter( 'script_loader_src', 'wpg_remove_ver_css_js', 9999 );
?>
