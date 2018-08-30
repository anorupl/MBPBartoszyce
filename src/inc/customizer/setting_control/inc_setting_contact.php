<?php
/**
* File with setting and control in 'club' section
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

// ==============================================
//  = Show map=
//  =============================================
$wp_customize->add_setting('wpg_contact_maps', array(
	'default'=> false,
	'capability' => 'edit_theme_options',
));

$wp_customize->add_control( 'wpg_contact_maps', array(
	'settings' => 'wpg_contact_maps',
	'label'   => __('Show map in contact', 'wpg_theme'),
	'section'  => $contact_section_id,
	'type'=> 'checkbox'
));

for ( $i = 1; $i <= 4; $i++ ) {
	// ==============================================
	//  = Place title						=
	//  =============================================
	$wp_customize->add_setting("wpg_contact_place_$i", array(
		'default'           => __('Tab', 'wpg_theme'),
		'capability' 		=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( "wpg_contact_place_$i", array(
		'settings' => "wpg_contact_place_$i",
		'label'   => __('Tab #', 'wpg_theme') . $i,
		'section'  => $contact_section_id,
		'type'    => 'text'
	));

	// ==============================================
	//  = Place Addres=
	//  =============================================
	$wp_customize->add_setting("wpg_contact_adres_$i", array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( "wpg_contact_adres_$i", array(
		'settings' => "wpg_contact_adres_$i",
		'label'    => __('Tab #', 'wpg_theme') . $i . ' ' . __('Address', 'wpg_theme'),
		'section'  => $contact_section_id,
		'type'=> 'text'
	));

	// ==============================================
	//  = Place Phone
	//  =============================================
	$wp_customize->add_setting("wpg_contact_phone_$i", array(
		'default'=> '',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( "wpg_contact_phone_$i", array(
		'settings'  => "wpg_contact_phone_$i",
		'label'     => __('Tab #', 'wpg_theme') . $i . ' ' .  __('Telephone number', 'wpg_theme'),
		'section'   => $contact_section_id,
		'type'      => 'text'
	));

	// ==============================================
	//  = E-mail (text) =
	//  =============================================
	$wp_customize->add_setting("wpg_contact_email_$i", array(
		'default'=> '',
		'sanitize_callback' => 'sanitize_email'
	));

	$wp_customize->add_control( "wpg_contact_email_$i", array(
		'settings' => "wpg_contact_email_$i",
		'label'    => __('Tab #', 'wpg_theme') . $i . ' ' . __('E-mail', 'wpg_theme'),
		'section'  => $contact_section_id,
		'type'     => 'email'
	));

	// ==============================================
	//  = Opening Hours							=
	//  =============================================
	$wp_customize->add_setting("wpg_contact_open_$i", array(
		'default'    => base64_encode('{"mo":"9:00-17:00","tu":"9:00-17:00","we":"9:00-17:00","th":"9:00-17:00","fr":"9:00-17:00","sa":"9:00-17:00","su":"9:00-17:00"}'),
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control(
		new WPG_Custom_OpeningHours($wp_customize, "wpg_contact_open_$i", array(

			'settings' 	=> "wpg_contact_open_$i",
			'section'  	=> $contact_section_id,
			'label'    	=> __('Tab #', 'wpg_theme') . $i . ' ' . __('Opening Hours', 'wpg_theme'),
			'type'		=> 'wpg_opening_hours'
		))
	);

	// ==============================================
	//  = Drag/drop marker Google map=
	//  =============================================
	$wp_customize->add_setting( "wpg_contact_map_latlong_$i", array(
		'default'   => '54.248997, 20.804780',
	));

	$wp_customize->add_control(
		new WPG_Customize_Control_leafletjs_MAP($wp_customize, "wpg_contact_map_latlong_$i", array(
			'settings' => "wpg_contact_map_latlong_$i",
			'section'  => $contact_section_id,
			'label'    => __('Tab #', 'wpg_theme') . $i . ' ' . __( 'Select a location on map', 'wpg_theme' )
		))
	);

}
