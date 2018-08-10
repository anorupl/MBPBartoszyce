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
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_google_map.php';
	// Class "WPG_Custom_OpeningHours".
	require get_template_directory() . '/inc/customizer/custom_control_field/inc_field_open_hours.php';



	// Class "WPG_Customize_Control_Custom_Dropdown" - Custom control with custom dropdown.
	//require get_template_directory() . '/inc/customizer/custom_control_field/inc_custom_dropdown.php';



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



	$existes_club = post_type_exists( 'clubnews' );
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
	 * 3. Kluby w Bibliotece
	 * 4. Nowości wydawnicze
	 * 5. Catl
	 * 6. Kontakt
	 * 7. Social media
	 * 8. Partnerzy
	 * 9. Blog
     *
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

    // 2. Event
    $event_section_id = 'wpg_event_stc';

    $wp_customize->add_section( $event_section_id, array(
		'priority'   		=> '2',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'News and event', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));



	if ($existes_club) {
		// 3. club
		$club_section_id = 'wpg_club_stc';

		$wp_customize->add_section( $club_section_id, array(
			'priority'   		=> '2',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'Clubs in the library', 'wpg_theme' ),
			'panel' 			=> $theme_panel_id,
		));

		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_club.php';
	}
	if ($existes_collection) {
		// 4. new
		$new_section_id = 'wpg_new_stc';

		$wp_customize->add_section( $new_section_id, array(
			'priority'   		=> '2',
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'      		=> __( 'New releases', 'wpg_theme' ),
			'panel' 			=> $theme_panel_id,
		));

		require get_template_directory() . '/inc/customizer/setting_control/inc_setting_new.php';			
	}

    // 5. catl
    $catl_section_id = 'wpg_catl_stc';

    $wp_customize->add_section( $catl_section_id, array(
		'priority'   		=> '2',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Catl', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));

    // 6. Kontakt
    $contact_section_id = 'wpg_contact_stc';

    $wp_customize->add_section( $contact_section_id, array(
		'priority'   		=> '10',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Contact', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));

    // 7. Social
    $social_section_id = 'wpg_social_stc';

    $wp_customize->add_section(  $social_section_id, array(
		'priority'   		=> '8',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Social networks', 'wpg_theme' ),
	    'panel' 			=> $theme_panel_id,
	));

	// 8. Partnerzy
	$partners_section_id = 'wpg_client_stc';

	$wp_customize->add_section( $partners_section_id, array(
		'priority'   		=> '6',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __( 'Partners', 'wpg_theme' ),
		'panel' 			=> $theme_panel_id,
	));

	// 9.Blog
    $blog_section_id = 'wpg_blog_stc';

    $wp_customize->add_section( $blog_section_id, array(
		'priority'   		=> '9',
		'capability' 		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'      		=> __('Last post', 'wpg_theme'),
	    'panel' 			=> $theme_panel_id,
	));


	/* 
	 * Setting and control 
	 * */

	 // 1 
	 require get_template_directory() . '/inc/customizer/setting_control/inc_setting_fonts.php';
	 // 2
	 //require get_template_directory() . '/inc/customizer/setting_control/inc_setting_event.php';		 
 	 
	 // 5
	 require get_template_directory() . '/inc/customizer/setting_control/inc_setting_catl.php';		 
	 // 6
	 require get_template_directory() . '/inc/customizer/setting_control/inc_setting_contact.php';	
	 // 7
	require get_template_directory() . '/inc/customizer/setting_control/inc_setting_social.php';
	 // 8
	 require get_template_directory() . '/inc/customizer/setting_control/inc_setting_blog.php';






}


add_action( 'customize_register', 'wpg_customizer_general' );

?>
