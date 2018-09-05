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
define( 'THEME_NAME',wp_get_theme()->get( 'Name' ) );
define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'THEME_INC', get_template_directory() . '/inc/' );
define( 'THEME_URL', get_stylesheet_directory_uri() . '/' );
define( 'THEME_PATH',get_stylesheet_directory() . '/' );





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
			$content_width = 1440;
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
			'height'  => 287,
			'width'   => 768,
			'flex-height' => true,
			'flex-width'  => true
		)
	);

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
		'header_bottom' => esc_html__( 'Header Menu - Bottom ', 'wpg_theme' ),
		'left_sidebar'  => esc_html__( 'Sidebar Menu - Left ', 'wpg_theme' )
	));

	/**
	* Update image size;
	*/
	update_option( 'thumbnail_size_w', 320 );
	update_option( 'thumbnail_size_h', 480 );
	update_option( 'thumbnail_crop', false );
	update_option( 'medium_size_w', 768);
	update_option( 'medium_size_h', 512 );
	update_option( 'large_size_w', 1366);
	update_option( 'large_size_h', 911 );
}
add_action( 'after_setup_theme', 'wpg_setup' );
endif;

/**
* Enqueue scripts and styles.
*/
function wpg_enqueue() {

	//deregister
	wp_deregister_script( 'jquery' );

	//css
	wp_enqueue_style( 'wpg-style', get_stylesheet_uri() );
	wp_enqueue_style( 'slick', THEME_URL . "css/slick.css");
	wp_enqueue_style( 'leaflet',"https://unpkg.com/leaflet@1.3.4/dist/leaflet.css");

	// fallback css
	wp_enqueue_style( 'wpg-ie', THEME_URL . 'css/ie.css');
	wp_style_add_data( 'wpg-ie', 'conditional', 'lt IE 9' );


	//Enqueue scripts
	wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
	wp_enqueue_script( 'cookie', THEME_URL . 'js/assets/jquery.cookie.js','', THEME_VERSION);
	wp_enqueue_script( 'tabs-js', THEME_URL . 'js/assets/jquery-accessible-tabs.min.js',array('jquery'), THEME_VERSION, true );
	wp_enqueue_script( 'wpg-image-popup-js', THEME_URL . 'js/assets/wpg-image.min.js',array('jquery'), THEME_VERSION, true );
	wp_enqueue_script( 'slick-js', THEME_URL . 'js/assets/slick.min.js',array('jquery'), THEME_VERSION, true );

	// fallback scripts
	wp_enqueue_script( 'wpg-modernizr-flexbox', THEME_URL . 'js/assets/modernizr-flexbox.min.js','', THEME_VERSION);
	wp_enqueue_script( 'html5', THEME_URL . 'js/assets/html5shiv.min.js',array(), THEME_VERSION, false );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	// theme main js
	wp_enqueue_script( 'wpg-main',THEME_URL . 'js/main.min.js',array('jquery'), THEME_VERSION, true );

	wp_localize_script('wpg-main', 'datalanuge', array(
		'offcontrast' => __('Wyłącz kontrast', 'wpg_theme'),
		'oncontrast' => __('Włącz kontrast', 'wpg_theme'),

		'url' 		    => get_bloginfo('template_directory'),
		'next'=> __('Previous Image (left arrow key)', 'wpg_theme'),
		'prev'=> __('Next Image (right arrow key)', 'wpg_theme'),
		'of'  => __('of', 'wpg_theme'),
		'close'   => __('Close (Escape key)', 'wpg_theme'),
		'load'=> __('Loading ...', 'wpg_theme'),
		'image'   => __('Image', 'wpg_theme'),
		'error_image' => __('it cannot be loaded.', 'wpg_theme')
	));

	// theme leafletjs maps
	wp_enqueue_script( 'leaflet-js', "https://unpkg.com/leaflet@1.3.4/dist/leaflet.js");
	wp_enqueue_script('leaflet-map', get_template_directory_uri() . '/js/mapa.min.js','', '1.0.1', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'wpg_enqueue' );

/**
 * Register widget area.
 *
 * @link 	https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'wpg_theme' ),
		'id'            => 'wpg-sidebar-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'wpg_theme' ),
		'id'            => 'wpg-sidebar-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpg_widgets_init' );


/**
* Include file with customizer.
*/
require THEME_PATH . '/inc/customizer/wpg_customizer.php';

/**
* Include file with base setting:
*/
require THEME_PATH . 'inc/fn_disabled.php';
require THEME_PATH . 'inc/theme-functions.php';
require THEME_PATH . 'inc/template-tags.php';

require THEME_PATH . 'inc/meta_box.php';

require THEME_PATH . 'inc/wcga_form.php';

/**
* Include file with custom admin setting:
* 1. fn_tinymce   - Add plugin [table]
*/
//require THEME_PATH . '/inc/admin/fn_tinymce.php';
