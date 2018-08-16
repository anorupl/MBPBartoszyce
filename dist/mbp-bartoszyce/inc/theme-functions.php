<?php
/**
* Additional features to allow styling of the templates
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
function wpg_post_per_page( $query ) {
	if ( $query->is_main_query() && $query->is_home() && !is_paged()) {
		$query->set('posts_per_page', 4);
	} else {
		$query->set('offset', 4);
	}
}
add_action( 'pre_get_posts', 'wpg_post_per_page' );









/**
* Adds custom classes to the array of body classes.
*
* @see 	Function Reference/body class
* @link 	https://codex.wordpress.org/Function_Reference/body_class
*
* @param 	array $classes Classes for the body element.
*/
function wpg_body_class($class) {

	$class[] = 'hfeed site';

	return $class;
}
add_filter( 'body_class', 'wpg_body_class' );

/**
* Adds custom classes to the array of post classes.
*
* @param 	array $classes Classes for the post element.
*/
function wpg_post_class($class) {

	return $class;
}
add_filter( 'post_class', 'wpg_post_class' );






/**
* Handles JavaScript detection.
*
* Adds a `js` class to the root `<html>` element when JavaScript is detected.
*
* @since Twenty Seventeen 1.0
*/
function wpg_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wpg_javascript_detection', 0 );

/**
* Filtr add responsive container to video embeds.
*
* @param 	string $html Code of player
* @param 	string $url Link to embeds providers.
* @return 	string
*/
function wpg_rwd_video_container($html, $url='') {

	$wrapped = '<div class="fluid-width-video-wrapper">' . $html . '</div>';

	if ( empty( $url ) && 'video_embed_html' == current_filter() ) { // Jetpack
		$html = $wrapped;
	} elseif ( !empty( $url ) ) {
		$players = array( 'youtube', 'youtu.be', 'vimeo', 'dailymotion', 'hulu', 'blip.tv', 'wordpress.tv', 'viddler', 'revision3' );
		foreach ( $players as $player ) {
			if ( false !== strpos( $url, $player ) ) {
				$html = $wrapped;
				break;
			}
		}
	}
	return $html;
}
add_filter( 'embed_oembed_html', 'wpg_rwd_video_container', 10, 3 );
add_filter( 'video_embed_html', 'wpg_rwd_video_container' ); // Jetpack

/**
* Filtr add wmode transparent to video embeds.
*
* @param 	string $html Code of player.
* @param 	string $url Link to embeds providers.
* @param	array $attr.
*
* @return 	string
*/
function wpg_add_video_wmode_transparent($html, $url, $attr) {

	if ( strpos( $html, "<embed src=" ) !== false )
	{ return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
	elseif ( strpos ( $html, 'feature=oembed' ) !== false )
	{ return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
	else
	{ return $html; }
}
add_filter( 'embed_oembed_html', 'wpg_add_video_wmode_transparent', 10, 3);

/**
* Filtr add custom class to Popup image jquery plugin
*
* @see 	Filters the value of the attachment’s image tag class attribute.
* @link	https://developer.wordpress.org/reference/hooks/get_image_tag_class/
*/
function wpg_popup_image_class($class) {
	$class .= 'single-image';
	return $class;
}
add_filter('get_image_tag_class', 'wpg_popup_image_class' );

function wpg_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'wpg_nav_description', 10, 4 );


?>
