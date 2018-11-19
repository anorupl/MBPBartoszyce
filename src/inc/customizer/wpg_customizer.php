<?php
/**
* Theme Customizer
*
* @package MBP Bartoszyce
* @since 0.1.0
*
* @global object $wp_customize WP_Customize instance.
*
*/

global $wp_customize;

/* Load necessary files with additional elements
************************************************/
require get_template_directory() . '/inc/customizer/helpers/inc_front_css.php';
require get_template_directory() . '/inc/customizer/helpers/inc_helpers.php';
require get_template_directory() . '/inc/customizer/helpers/inc_scripts_and_style.php';


if(isset($wp_customize)) {


	/* Load necessary files with additional elements only if custumizer on
	************************************************/
	require get_template_directory() . '/inc/customizer/helpers/inc_context.php';
	require get_template_directory() . '/inc/customizer/helpers/inc_sanitization.php';


	/* Load extends class WP_Customize_Control
	************************************************/

	// Class "WPG_Customize_Control_Google_MAP".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_switch.php';

	// Class "Fonts_Dropdown_Google" - Custom control fonts field.
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_field_fonts.php';
	// Class "WPG_Customize_Control_Checkbox_Multiple" - Custom control with mutli checbox.
	// niezbędne dla pola
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_multi_checbox.php';
	// Class "WPG_Customize_Control_Checkbox_Multiple_Sort"
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_multisort_checbox.php';
	// Class "WPG_Customize_Control_Google_MAP".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_leafletjs_map.php';
	// Class "WPG_Custom_OpeningHours".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_field_open_hours.php';
	// Class "WPG_TinyMCE_Custom_control".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_tinymce.php';
}

/**
* Add customizations for this theme
*
* @since 0.1.0
*
* @param object $wp_customize WP_Customize instance
* @return void
*/
function wpg_customizer_general($wp_customize) {

	$existes_club       = post_type_exists( 'clubnews' );
	$existes_collection = post_type_exists( 'post_collection' );


	// Modify existing controls and settings
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	// Add panel - Theme Settings
	$theme_panel_id = 'wpg_general';

	$wp_customize->add_panel( $theme_panel_id, array(
		'priority' 			=> '10',
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __( 'Theme Settings', 'wpg_theme' )
	) );

	/* Add Section - to panel [Theme Settings]
	* 1.Typography
	* 2. Wydarzenia
	* 3. featured category
	* 4. Kluby w Bibliotece
	* 5. Nowości wydawnicze
	* 6. Catl
	* 7. Kontakt
	* 8. Social media
	* 9. Partnerzy
	* 10. Blog
	************************************************/

	// 1. Typography
	$font_section_id = 'wpg_typography_stc';

	$wp_customize->add_section( $font_section_id, array(
		'priority'   		=> '1',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Typography', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id,
	));

	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_fonts.php';


	// 2. Event
	$event_section_id = 'wpg_event_stc';

	$wp_customize->add_section( $event_section_id, array(
		'priority'   		=> '2',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Events', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id,
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_events.php';


	// 3. featured category
	$featuredcat_section_id = 'wpg_featuredcat_stc';

	$wp_customize->add_section( $featuredcat_section_id, array(
		'priority'   		=> '3',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __('Featured category ', 'wpg_theme'),
		'panel' 			=> $theme_panel_id
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_featured_category.php';


	if ($existes_club) {
		// 4. club
		$club_section_id = 'wpg_club_stc';

		$wp_customize->add_section( $club_section_id, array(
			'priority'   		=> '4',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'Clubs in the library', 'wpg_theme' ),
			'panel' 			=> $theme_panel_id,
		));

		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_club.php';
	}


	if ($existes_collection) {
		// 5. new
		$new_section_id = 'wpg_new_stc';

		$wp_customize->add_section( $new_section_id, array(
			'priority'   		=> '5',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'New releases', 'wpg_theme' ),
			'panel' 			=> $theme_panel_id,
		));

		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_new.php';
	}


	// 6. catl
	$catl_section_id = 'wpg_catl_stc';

	$wp_customize->add_section( $catl_section_id, array(
		'priority'   		=> '6',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Catl', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id,
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_catl.php';


	// 7. Kontakt
	$contact_section_id = 'wpg_contact_stc';

	$wp_customize->add_section( $contact_section_id, array(
		'priority'   		=> '7',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Contact', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id,
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_contact.php';


	// 8. Social
	$social_section_id = 'wpg_social_stc';

	$wp_customize->add_section(  $social_section_id, array(
		'priority'   		=> '8',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Social networks', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_social.php';


	// 9. Partnerzy
	$partners_section_id = 'wpg_partners_stc';

	$wp_customize->add_section( $partners_section_id, array(
		'priority'   		=> '9',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Partners', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_partners.php';


	// 10.Blog
	$blog_section_id = 'wpg_blog_stc';

	$wp_customize->add_section( $blog_section_id, array(
		'priority'   		=> '10',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __('Last post', 'wpg_theme'),
		'panel' 			=> $theme_panel_id
	));
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_blog.php';
}


add_action( 'customize_register', 'wpg_customizer_general' );

?>
