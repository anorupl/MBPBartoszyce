<?php
/**
* Additional features to allow styling of the templates
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
function wpg_post_per_page( $query ) {
	if ( $query->is_main_query() && $query->is_home() && !is_paged()) {
		$query->set('ignore_sticky_posts', 1);
		$query->set('posts_per_page', 4);
	} elseif ($query->is_main_query() && $query->is_home() && is_paged()) {
		//$query->set('offset', 4);
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
//add_action('categorycollection_edit_form_fields', 'render_field_edit', 10, 2);


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
//add_action('categorycollection_add_form_fields', 'render_field_add', 10, 2);


add_filter('em_event_output_placeholder', 'filterEventThumbnail', 10, 3);

/**
* get event image as regular WordPress thumbnail
* (or any registered WordPress image size)
* @param string $result
* @param EM_Event $EM_Event
* @param string $placeholder
* @return string
*/
function filterEventThumbnail($result, $EM_Event, $placeholder) {
    if ($placeholder == '#_CUSTOMEVENTIMAGETHUMB') {
        $imageID = get_post_thumbnail_id($EM_Event->post_id);
        if ($imageID) {
            $result = wp_get_attachment_image($imageID, 'thumbnail');
        }
    }

    return $result;
}

?>
