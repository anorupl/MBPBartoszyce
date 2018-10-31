<?php
/**
* Additional features to allow styling of the templates
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

/**
* The Code below will modify the main WordPress loop, before the queries fired
*/
function wpg_query_offset( $query) {

	// Before anything else, make sure this is the right query...
	if ( !is_admin() && $query->is_home() && $query->is_main_query() ) {

		$query->set( 'ignore_sticky_posts', '-1' );
		$query->set( 'post_type', array('post', 'clubnews') );

		// First, define your desired offset...
		$offset = 3;
		// Next, determine how many posts per page you want (we'll use WordPress's settings)
		$ppp = get_option( 'posts_per_page' );
		// Next, detect and handle pagination...
		if ( $query->is_paged ) {
			// Manually determine page query offset (offset + current page (minus one) x posts per page)
			$page_offset = 3 + ( ( $query->query_vars['paged']-2 ) * $ppp );
			// Apply adjust page offset
			$query->set( 'offset', $page_offset );
		}
		else {
			// This is the first page. Set a different number for posts per page
			$query->set( 'posts_per_page', 3 );
		}
	}
}
add_action( 'pre_get_posts', 'wpg_query_offset', 1 );

/**
* The Code below will modify the number of found posts for the query.
*/
function wpg_adjust_offset_pagination( $found_posts, $query ) {

	// Define our offset again...
	$offset = -3;

	// Ensure we're modifying the right query object...
	if ( $query->is_home() && $query->is_main_query() ) {
		// Reduce WordPress's found_posts count by the offset...
		return $found_posts - $offset;
	}
	return $found_posts;
}
add_filter( 'found_posts', 'wpg_adjust_offset_pagination', 1, 2 );

/**
* Adds custom classes to the array of body classes.
*
* @see 	Function Reference/body class
* @link https://codex.wordpress.org/Function_Reference/body_class
*
* @param 	array $classes Classes for the body element.
*/
function wpg_body_class($class) {

	$class[] = 'hfeed site';

	// Active sidebar - 2 column (content)
	if (is_active_sidebar( 'wpg-sidebar-right' ) ) {
		$class[] = 'active-sidebar';
	}
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
*/
function wpg_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wpg_javascript_detection', 0 );

/**
 * Filtr mark Posts/Pages as Untiled when no title is used
 *
 * @param 	string $title
 * @return 	string
 */
function wpg_no_title( $title ) {
  return $title == '' ? __('Untitled', 'wpg_theme') : $title;
}
add_filter( 'the_title', 'wpg_no_title' );

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



function wpg_nav_description( $item_output, $item, $depth, $args ) {
	if ( !empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'wpg_nav_description', 10, 4 );


/**
* Add class when image is added to the editor.
*
* Image added before doesn't have class. To work popup with old image must use filter the_content.
*/
function wpg_add_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'image-popup'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if ( preg_match('/<a.*? class=".*?">/', $html) ) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  } else {
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  return $html;
}
add_filter('image_send_to_editor','wpg_add_linked_images_class',10,8);

/**
* Add the visual editor to the edit tag screen
*
* HTML should match what is used in wp-admin/edit-tag-form.php
*
*
* @link https://github.com/sheabunge/visual-term-description-editor
*
* @param object $tag The tag currently being edited
* @param string $taxonomy The taxonomy that the tag belongs to
*/
function render_field_edit($term, $taxonomy){

	$settings = array(
		'textarea_name' => 'description',
		'textarea_rows' => 10,
		'editor_class'  => 'i18n-multilingual',
	);

	?>
	<tr class="form-field term-description-wrap">
		<th scope="row"><label for="description"><?php _e( 'Description' ); ?></label></th>
		<td>
			<?php	wp_editor( htmlspecialchars_decode( $term->description ), 'html-tag-description', $settings ); ?>
			<p class="description"><?php _e( 'The description is not prominent by default; however, some themes may show it.' ); ?></p>
		</td>
		<script>
		// Remove the non-html field
		jQuery('textarea#description').closest('.form-field').remove();
		</script>
	</tr>
	<?php
}
add_action('clubs_edit_form_fields', 'render_field_edit', 10, 2);

/**
* Add the visual editor to the add new tag screen
*
* HTML should match what is used in wp-admin/edit-tags.php
*
* @link https://github.com/sheabunge/visual-term-description-editor
* @param string $taxonomy The taxonomy that a new tag is being added to
*/
function render_field_add( $taxonomy ) {
	$settings = array(
		'textarea_name' => 'description',
		'textarea_rows' => 10,
		'editor_class'  => 'i18n-multilingual',
	);
	?>
	<div class="form-field term-description-wrap">
		<label for="tag-description"><?php _e( 'Description' ); ?></label>
		<?php	wp_editor( '', 'html-tag-description', $settings );	?>
		<p><?php _e( 'The description is not prominent by default; however, some themes may show it.' ); ?></p>
		<script>
		// Remove the non-html field
		jQuery('textarea#tag-description').closest('.form-field').remove();
		jQuery(function () {
			jQuery('#addtag').on('mousedown', '#submit', function () {
				tinyMCE.triggerSave();
				jQuery(document).bind('ajaxSuccess.vtde_add_term', function () {
					tinyMCE.activeEditor.setContent('');
					jQuery(document).unbind('ajaxSuccess.vtde_add_term', false);
				});
			});
		});
		</script>
	</div>
	<?php
}
add_action('clubs_add_form_fields', 'render_field_add', 10, 2);

/**
* get event image as regular WordPress thumbnail
* (or any registered WordPress image size)
*
* @param string $result
* @param EM_Event $EM_Event
* @param string $placeholder
* @return string
*/
function wpg_filterEventThumbnail($result, $EM_Event, $placeholder) {
    if ($placeholder == '#_CUSTOMEVENTIMAGETHUMB') {
        $imageID = get_post_thumbnail_id($EM_Event->post_id);
        if ($imageID) {
            $result = wp_get_attachment_image($imageID, 'thumbnail');
        }
    }

    return $result;
}
add_filter('em_event_output_placeholder', 'wpg_filterEventThumbnail', 10, 3);

/**
 * Modifies the menu container and adds class
 *
 * @see https://developer.wordpress.org/reference/hooks/widget_nav_menu_args/
 * @param array $nav_menu_args An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
 * @param stdClass $nav_menu Nav menu object for the current menu.
 * @param array $args Display arguments for the current widget.
 * @return array $args Updated menu args.
 */
function wpg_widget_nav_menu($nav_menu_args, $nav_menu, $args) {

	$nav_menu_args = array(

				 'container'       => 'nav',
				 'container_class' => 'v-nav dropdown',
         'menu'            => $nav_menu,
				 'fallback_cb'     => ''
     );

	return $nav_menu_args;
}
add_filter( 'widget_nav_menu_args', 'wpg_widget_nav_menu', 10, 3 );
?>
