<?php
/**
* MBP Bartoszyce functions and definitions.
*
* @package MBP Bartoszyce
* @since 0.1.0
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*/

/* ==================================================
Global constants

Nie nadpiswyane przez child, absolutna(/home/user/) lub uri(http://..):
- get_template_directory() -
- get_template_directory_uri() -

Nadpisywane przez child:
- get_stylesheet_directory()
- get_stylesheet_directory_uri()

================================================== */
define( 'THEME_NAME',    wp_get_theme()->get( 'Name' ) );
define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'THEME_INC',     get_template_directory() . '/inc/' );
define( 'THEME_URL',     get_stylesheet_directory_uri() . '/' );
define( 'THEME_PATH',    get_stylesheet_directory() . '/' );





if ( ! function_exists( 'wpg_setup' ) ) :
	/**
	* Sets up theme defaults and registers support for various WordPress features.
	*
	* Note that this function is hooked into the after_setup_theme hook, which
	* runs before the init hook. The init hook is too late for some features, such
	* as indicating support for post thumbnails.
	*
	*/
	function wpg_setup() {

		if ( ! isset( $content_width ) ) {
			$content_width = 1600;
		}

		load_theme_textdomain( 'wpg_theme', THEME_PATH . 'languages' );

		/**
		* Post format
		*
		* array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video','audio', 'chat' ) );
		*/
		add_theme_support( 'post-formats', array('gallery','video'));

		/**
		* Add default posts and comments RSS feed links to head.
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		* Let WordPress manage the document title.
		*/
		add_theme_support( 'title-tag' );

		/**
		*  Add theme support for Custom Logo.
		*/
		add_theme_support( 'custom-logo', array(
			'height'      => 287,
			'width'       => 768,
			'flex-height' => true,
			'flex-width'  => true
		));

		/**
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		* Switch core markup to output valid HTML5.
		*/
		add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption'));

		/**
		* This theme uses wp_nav_menu().
		*/
		register_nav_menus( array(
			'header'        => esc_html__( 'Header Menu - Top', 'wpg_theme' ),
			'header_bottom' => esc_html__( 'Header Menu - Bottom ', 'wpg_theme' )
		));

		/**
		* Update image size;
		*/

		//thumbnail
		update_option( 'thumbnail_size_w', 320 );
        update_option( 'thumbnail_size_h', 480 );
		update_option( 'thumbnail_crop', false );
		//medium
        update_option( 'medium_size_w', 768);
		update_option( 'medium_size_h', 512 );
		//large
        update_option( 'large_size_w', 1366);
        update_option( 'large_size_h', 911 );
	}
	add_action( 'after_setup_theme', 'wpg_setup' );
endif;

/**
* Enqueue scripts and styles.
*/
function wpg_enqueue() {
	//css
	wp_enqueue_style( 'wpg-style', get_stylesheet_uri() );

	//enqueue_script
	wp_deregister_script( 'jquery' );

	// jquery and plugins
	wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');

	// fallback for flexbox
	wp_enqueue_script( 'wpg-modernizr-flexbox', THEME_URL . 'js/assets/modernizr-flexbox.min.js','', THEME_VERSION);

	wp_enqueue_script( 'wpg-image-popup-js', THEME_URL . 'js/assets/wpg-image.min.js',array('jquery'), THEME_VERSION, true );

	wp_enqueue_style( 'slick-css', THEME_URL . "/css/slick.css");
	wp_enqueue_script( 'slick-js', THEME_URL . 'js/assets/slick.min.js',array('jquery'), THEME_VERSION, true );

	// theme main js
	wp_enqueue_script( 'wpg-main',	THEME_URL . 'js/main.min.js',array('jquery'), THEME_VERSION, true );

	wp_localize_script('wpg-main', 'datalanuge', array(
		'next'        => __('Previous Image (left arrow key)', 'wpg_theme'),
		'prev'        => __('Next Image (right arrow key)', 'wpg_theme'),
		'of'          => __('of', 'wpg_theme'),
		'close'       => __('Close (Escape key)', 'wpg_theme'),
		'load'        => __('Loading ...', 'wpg_theme'),
		'image'       => __('Image', 'wpg_theme'),
		'error_image' => __('it cannot be loaded.', 'wpg_theme')
	));

	wp_enqueue_script( 'tabs-js', THEME_URL . 'js/assets/jquery-accessible-tabs.min.js',array('jquery'), THEME_VERSION, true );


	// Old ie
	wp_enqueue_style( 'wpg-ie', THEME_URL . 'css/ie.css');
	wp_enqueue_script( 'html5', THEME_URL . 'js/assets/html5shiv.min.js',array(), THEME_VERSION, false );

	wp_style_add_data( 'wpg-ie', 'conditional', 'lt IE 9' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'wpg_enqueue' );

/**
* Include file with customizer.
*/
require THEME_PATH . '/inc/customizer/wpg_customizer.php';

/**
* Include file with base setting:
*/
require THEME_PATH . 'inc/fn_disabled.php';
require THEME_PATH . 'inc/template-functions.php';
require THEME_PATH . 'inc/template-tags.php';

require THEME_PATH . 'inc/meta_box.php';

/**
* Include file with custom admin setting:
* 1. fn_tinymce   - Add plugin [table]
*/
//require THEME_PATH . '/inc/admin/fn_tinymce.php';
