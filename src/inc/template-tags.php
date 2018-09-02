<?php
/**
* The custom functions that can be used directly in theme file.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/


function wpg_get_excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}


/**
* Prints HTML with time information for the current post.
*
* @return 	string
*/
function wpg_time() {
	printf( '<time class="entry-date published updated" itemprop="datePublished dateModified" datetime="%1$s">%2$s</time>',
	esc_attr( get_the_date( 'c' ) ),
	esc_html( get_the_date() ),
	esc_attr( get_the_modified_date( 'c' ) ),
	esc_html( get_the_modified_date() )
);
}

/**
* Prints HTML with share link for the current post.
*
* @return 	string
*/
function wpg_share() {

	printf('
	<a title="%1$s" class="social-share" target="_blank" href="http://twitter.com/home?status=Reading:%4$s"><i class="icon-twitter-f"></i></a>
	<a title="%2$s" class="social-share" target="_blank" href="https://plus.google.com/share?url=%4$s"><i class="icon-google-f"></i></a>
	<a title="%3$s" class="social-share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=%4$s"><i class="icon-facebook-f"></i></a>',
	__('Share on Twitter!','wpg_theme'),
	__('Share on Google+','wpg_theme'),
	__('Share on Facebook','wpg_theme'),
	get_the_permalink());
}



/**
* Prints HTML with post meta information (category, data, author, comments) for the current post.
*
* @param 	bool $author. Default is false
* @param 	bool $time. Default is true
* @param 	bool $comments. Default is true
* @param 	bool $category. Default is true.
* @param 	string $class. Default is empty.
*
* @return 	string
*/
function wpg_meta( $author=false, $time=true, $comments=true, $category=true, $class='') {

	// print meta container
	printf('<div class="entry-meta %1$s">',$class);

	// print meta - author
	if ($author == true)	{
		printf('<div class="meta-item hidde-small">
		<span class="meta-left"><i class="icon-user2"></i></span>
		<span class="meta-right"><span class="screen-reader-text">%1$s: </span><span class="author vcard" itemprop="author creator editor" itemscope itemtype="http://schema.org/Person"><span class="fn" itemprop="name">%2$s</span></span></span>
		</div>',
		__('Author', 'wpg_theme'),
		get_the_author());
	}

	// print meta - data
	if ($time == true) {
		printf('
		<div class="meta-item">
		<span class="meta-left"><i class="icon-clock-full"></i></span>
		<span class="meta-right"><span class="screen-reader-text">%1$s: </span><time class="entry-date published updated" itemprop="datePublished dateModified" datetime="%2$s">%3$s</time></span>
		</div>',
		__('Data', 'wpg_theme'),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ));
	}

	// print meta - comments
	if ( $comments == true && ! post_password_required() && ( comments_open() || get_comments_number() ))	{

		echo '<div class="meta-item hidde-small"><span class="meta-left"><i class="icon-bubbles"></i></span><span class="meta-right">';
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'wpg_theme' ), get_the_title() ) );
		echo '</span></div>';
	}

	// print meta - category/taxonomy
	if ($category == true) {
		if ('post' === get_post_type()) {

			//Get category
			$category_list = get_the_category_list( ',', '', false );

			printf('<div class="meta-item"><span class="meta-left"><i class="icon-folder-open"></i></span><span class="meta-right"><span class="screen-reader-text">%1$s: </span>%2$s</span></div>',
			__('Category', 'wpg_theme'),
			$category_list
		);

	} else {

		global $post;

		// Get post type taxonomies
		$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );

		// Empty array for terms
		$out = array();

		foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy_slug );

			if ( !empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$out[] = '<a href="'.    get_term_link( $term->slug, $taxonomy_slug ) .'">'.$term->name."</a>";
				}
			}
		}
		printf('
		<div class="meta-item">
		<span class="meta-left"><i class="icon-folder-open"></i></span>
		<span class="meta-right"><span class="screen-reader-text">%1$s: </span>%2$s</span>
		</div>',
		__('Category', 'wpg_theme'),
		implode('', $out ));
	}
}
echo '</div>'; // end meta container
}


/**
* Get the category list - Can set limit item.
*
* @param string $separator Optional, default is empty string. Separator for between the categories.
* @param string $limit Optional, Default is 3.
* @param string $parents Optional. How to display the parents.
* @param int $post_id Optional. Post ID to retrieve categories.
* @return string
*/
function wpg_the_limit_category_list( $separator = '',$limit = 3, $parents='', $post_id = false  ) {

	if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
		return false;
	}

	$categories = get_the_category( $post_id );

	if ( empty( $categories)) {
		return false;
	}

	$rel = 'rel="category tag"';

	$thelist = '';

	$i = 0;

	foreach ( $categories as $category ) {
		if ( $limit > $i) {
			if (0 < $i )
			$thelist .= $separator;
			switch ( strtolower( $parents ) ) {
				case 'multiple':
				if ( $category->parent )
				$thelist .= get_category_parents( $category->parent, true, $separator );
				$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a><div class="clear"></div>';
				break;
				case 'single':
				$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>';
				if ( $category->parent )
				$thelist .= get_category_parents( $category->parent, false, $separator );
				$thelist .= "$category->name</a><div class='clear'></div>";
				break;
				case '':
				default:
				$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '>' . $category->name.'</a><div class="clear"></div>';
			}
			++$i;
		}
	}
	echo $thelist;
}


/**
* Prints short title.
*
* @param 	int $length Optional. Default is 200.
* @param 	string $after Optional. Default is '...'
*
* @return 	string
*/
function wpg_title_shorten($length=200,$after='...') {

	$mytitle = get_the_title();

	if (strlen($mytitle) > $length) {

		$mytitle 	= substr($mytitle, 0, $length);
		$i 			= strrpos($mytitle, " ");
		$mytitle 	= substr($mytitle, 0, $i);

		echo $mytitle . $after;
	} else {
		echo $mytitle;
	}
}



/**
* Display navigation to next/previous comments when applicable.
*/
function wpg_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'wpg_theme' ); ?></h2>
			<div class="nav-links">
				<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'wpg_theme' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'wpg_theme' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
	endif;
}

/**
* Display last gallery in post.
*
* @param	int	$post_id
* @param	bool $html / true
*
* @return	string with html
*/
function wpg_get_last_post_gallery(  $post_id, $html = true ) {

	if ( $post_id ) {
		$post_gallery = get_post_galleries( $post_id, $html );

		return end($post_gallery);
	}
}

/**
* Display image attachment in post.
*
* @param	string	$size
* @param	int	$limit
* @param	int	$offset
*
* @return	string with html
*/
function wpg_the_image_attachment($size = 'large', $limit = 0,$column= 3, $offset = 0) {

	global $post;

	$thumb_id = get_post_thumbnail_id($post->ID); // gets the post thumbnail ID
	$images 	= get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'exclude' => $thumb_id ) );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		echo '<div id="gallery-'. $post->ID .'" class="gallery gallery-columns-'. $column. '">';

		foreach ($images as $image) {
			if ($start <= $i and $i < $stop) {
				/*
				$image->post_title;   // title.
				$image->post_content; // description.
				$image->post_excerpt; // caption.
				wp_get_attachment_url($image->ID); // url of the full size image.
				image_downsize( $image->ID, $size );
				$preview_array[0]; // thumbnail or medium image to use for preview.
				*/
				$image_attributes   = wp_get_attachment_image_src( $image->ID, $size );

				printf('<figure class="gallery-item"><div class="gallery-icon"><a  href="%1$s" target="_blank"><img src="%2$s" alt="%3$s" /></a></div></figure>',
				$image->guid,
				$image_attributes[0],
				$image->post_excerpt

			);
		}
		$i++;
	}
	echo '</div>';
} else {
	echo '<div class="gallery"></div>';
}
}

/**
* Get tag <blockquote> from a post content
*
* @return string
*/
function wpg_quote() {

	$content = apply_filters( 'the_content', get_the_content() );

	preg_match('/<blockquote.*?<\/blockquote>/is', $content, $matches_blockquote);

	echo $matches_blockquote ? $matches_blockquote[0] : '';

}


/**
* Get media file embedded in post content
*
* @param	array $type. List of tags that should be found (iframe,video,embed,audio).
* @return	string
*/
function wpg_embedded_content($type=array()) {

	if (!empty($type)){

		$content = apply_filters( 'the_content', get_the_content() );
		$media = get_media_embedded_in_content($content, $type);

		echo !empty($media) ? $media[0] : '';

	}
}

/**
* Get from post content first image.
*
* @global $post
* @return string
*/
function wpg_catch_that_image() {
	global $post;

	$first_img = get_template_directory_uri() . '/img/svg/one.svg';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

	if(isset($matches[1][0])) {
		$first_img = $matches[1][0];
	}

	return $first_img;
}

/**
* If post not have thumbnail display first image or default svg.
*
* @global $post
* @param string $format, (figure,link,image) Default: figure.
* @param bool $image_content, Default: false.
*
* @return string
*/
function wpg_no_thumbnail($format = 'figure', $image_content = false)
{

    global $post;

    $class = 'img-thumb';
    $first_img = get_template_directory_uri() . '/img/default/no_image.jpg';

    if ($image_content == true) {
        preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

        if (isset($matches[1][0])) {
            $class = 'img-thumb';
            $first_img = $matches[1][0];
        }
    }

    switch ($format) {
        case 'link':
            printf('<a class="link-thumbnail %1$s" href="%2$s" ><img src="%3$s" alt="" /></a>',
                esc_attr($class),
                esc_url(get_permalink()),
                $first_img
            );
            break;
        case 'image':
            printf('<img class="image-thumbnail %1$s" src="%2$s" alt="" />',
                esc_attr($class),
                $first_img
            );
            break;

        default:
            printf('<figure class="post-thumbnail %1$s"><a href="%2$s" aria-hidden="true"><img src="%3$s" alt="" /></a></figure>',
                esc_attr($class),
                esc_url(get_permalink()),
                $first_img
            );
            break;
    }
}


/**
* Return the post URL.
*
* Falls back to the post permalink if no URL is found in the post.
*
* @see get_url_in_content()
* @return string The Link format URL.
*/
function wpg_get_link_url()
{
    $has_url = get_url_in_content(get_the_content());

    return $has_url ? $has_url : apply_filters('the_permalink', get_permalink());
}



/**
* Strip shortcode gallery form content
*
* @param string $content.
* @param string $code. Shortcode pattern form get_shortcode_regex
*
* @param string
*/
function wpg_strip_shortcode_gallery($content, $code)
{
    preg_match_all('/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER);

    if (!empty($matches)) {
        foreach ($matches as $shortcode) {
            if ($code === $shortcode[2]) {
                $pos = strpos($content, $shortcode[0]);
                $pos2 = strlen($shortcode[0]);
                if ($pos !== false) {
                    $content = substr_replace($content, '', $pos, $pos2);
                }
            }
        }

        $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content));

        echo $content;

    } else {
        echo apply_filters('the_content', $content);
    }
}
/**
* If post not have thumbnail display default image
*
* sizes: thumbnail, medium, medium_large, large, full.
*
* @param string $size.
* @return string html

*/
function wpg_the_thumbnail( $size='thumbnail' ){

	if (has_post_thumbnail()) {
		the_post_thumbnail( ($size) );
	} else {
		echo '<img alt="Domyślna fotografia Bartoszyc" src="'. $urlimg .'/img/photo-category-page.jpg" width="177" height="118"/>';
	}

}

/**
* Indicate the current page’s location within a navigational hierarchy that automatically adds separators via CSS
*
* @return string html
*/
function wpg_breadcrumbs() {
	/* === OPTIONS === */
	$text['home']     = __('Home','wpg_theme'); // text for the 'Home' link
	$text['category'] = __('<span class="screen-reader-text">Archive by Category</span> %s','wpg_theme'); // text for a category page
	$text['search']   = __('<span class="screen-reader-text">Search Results for</span> %s','wpg_theme'); // text for a search results page
	$text['tag']      = __('<span class="screen-reader-text">Posts Tagged</span> %s','wpg_theme'); // text for a tag page
	$text['author']   = __('<span class="screen-reader-text">Articles Posted by</span> %s','wpg_theme'); // text for an author page
	$text['404']      = __('<span class="screen-reader-text">Error 404</span>','wpg_theme'); // text for the 404 page
	$text['page']     = __('<span class="screen-reader-text">Page</span> %s','wpg_theme'); // text 'Page N'
	$text['cpage']    = __('<span class="screen-reader-text">Comment Pag</span>e %s','wpg_theme'); // text 'Comment Page N'


	$wrap_before    = '<span class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
		$wrap_after     = '</span><!-- .breadcrumbs -->'; // the closing wrapper tag
		$sep            = '›'; // separator between crumbs
		$sep_before     = '<span class="sep">'; // tag before separator
		$sep_after      = '</span>'; // tag after separator
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_current   = 1; // 1 - show current page title, 0 - don't show
		$before         = '<span class="current">'; // tag before the current crumb
		$after          = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;

		$home_url       = home_url('/');
		$link_before    = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			$link_after     = '</span>';
			$link_attr      = ' itemprop="item"';
			$link_in_before = '<span itemprop="name">';
			$link_in_after  = '</span>';
			$link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
			$frontpage_id   = get_option('page_on_front');
			$parent_id      = ($post) ? $post->post_parent : '';
			$sep            = ' ' . $sep_before . $sep . $sep_after . ' ';
			$home_link      = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

			if (is_home() || is_front_page()) {
				if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;
			} else {
				echo $wrap_before;
				if ($show_home_link) echo $home_link;
				if(is_category() || is_tax() ){
					$query_obj = get_queried_object();
					if ($query_obj->parent != 0) {
						$cats = get_term_parents_list($query_obj->parent, $query_obj->taxonomy, array(
							'separator' => $sep,
							'link'      => true,
							'format'    => 'name',
						));
						$cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
						$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
						if ($show_home_link) echo $sep;
						echo $cats;
					}
					if ( get_query_var('paged') ) {
						echo $sep . sprintf($link, get_term_link($query_obj->term_id,$query_obj->taxonomy ), $query_obj->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) echo $sep . $before . sprintf($text['category'], $query_obj->name) . $after;
					}
				}
				elseif ( is_search() ) {
					if (have_posts()) {
						if ($show_home_link && $show_current) echo $sep;
						if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
					} else {
						if ($show_home_link) echo $sep;
						echo $before . sprintf($text['search'], get_search_query()) . $after;
					}
				} elseif ( is_day() ) {
					if ($show_home_link) echo $sep;
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
					echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
					if ($show_current) echo $sep . $before . get_the_time('d') . $after;
				} elseif ( is_month() ) {
					if ($show_home_link) echo $sep;
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
					if ($show_current) echo $sep . $before . get_the_time('F') . $after;
				} elseif ( is_year() ) {
					if ($show_home_link && $show_current) echo $sep;
					if ($show_current) echo $before . get_the_time('Y') . $after;
				} elseif ( is_single() && !is_attachment() ) {
					if ($show_home_link) echo $sep;
					if ( get_post_type() != 'post' ) {
						// Get post type taxonomies
						$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );
						foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
							// get the terms related to post
							$terms = get_the_terms( $post->ID, $taxonomy_slug );
							if ( !empty( $terms ) ) {
								foreach ( $terms as $term ) {
									printf($link, get_term_link( $term->slug, $taxonomy_slug ), $term->name);
								}
							}
						}
						if ($show_current) echo $sep . $before . get_the_title() . $after;
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $sep);
						if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
						$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
						echo $cats;
						if ( get_query_var('cpage') ) {
							echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
						} else {
							if ($show_current) echo $before . get_the_title() . $after;
						}
					}
					// custom post type
				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());

					if ( get_query_var('paged') ) {
						echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) echo $sep . $before . $post_type->label . $after;
					}
				} elseif ( is_attachment() ) {
					if ($show_home_link) echo $sep;
					$parent = get_post($parent_id);
					$cat = get_the_category($parent->ID); $cat = $cat[0];
					if ($cat) {
						$cats = get_category_parents($cat, TRUE, $sep);
						$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
						echo $cats;
					}
					printf($link, get_permalink($parent), $parent->post_title);
					if ($show_current) echo $sep . $before . get_the_title() . $after;
				} elseif ( is_page() && !$parent_id ) {
					if ($show_current) echo $sep . $before . get_the_title() . $after;
				} elseif ( is_page() && $parent_id ) {
					if ($show_home_link) echo $sep;
					if ($parent_id != $frontpage_id) {
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							if ($parent_id != $frontpage_id) {
								$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							echo $breadcrumbs[$i];
							if ($i != count($breadcrumbs)-1) echo $sep;
						}
					}
					if ($show_current) echo $sep . $before . get_the_title() . $after;
				} elseif ( is_tag() ) {
					if ( get_query_var('paged') ) {
						$tag_id = get_queried_object_id();
						$tag = get_tag($tag_id);
						echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
					}
				} elseif ( is_author() ) {
					global $author;
					$author = get_userdata($author);
					if ( get_query_var('paged') ) {
						if ($show_home_link) echo $sep;
						echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_home_link && $show_current) echo $sep;
						if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
					}
				} elseif ( is_404() ) {
					if ($show_home_link && $show_current) echo $sep;
					if ($show_current) echo $before . $text['404'] . $after;
				} elseif ( has_post_format() && !is_singular() ) {
					if ($show_home_link) echo $sep;
					echo get_post_format_string( get_post_format() );
				}
				echo $wrap_after;
			}
		}

function the_list_terms(){
	global $post;

	// Get post type taxonomies
	$taxonomies = get_object_taxonomies( $post->post_type, 'objects' );

	// Empty array for terms
	$out = array();

	foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy_slug );

		if ( !empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$out[] = '<a href="'.    get_term_link( $term->slug, $taxonomy_slug ) .'">'.$term->name."</a> ";
			}
		}
	}

	echo implode('', $out );
}
