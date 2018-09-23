<?php
/**
* File with setting and control in 'club' section
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

// ==============================================
//= Show/Hidde 	=
//=============================================
$wp_customize->add_setting('wpg_clubs_active', array(
	'default'=> false,
	'capability' => 'edit_theme_options',
));

$wp_customize->add_control(
	new WPG_Customize_Control_Switch($wp_customize, 'wpg_clubs_active', array(
		'settings' 	=> 'wpg_clubs_active',
		'section'	=> $club_section_id,
		'label'	=> __('Show section', 'wpg_theme'),
		'type'=> 'switch'
	))
);

// ==============================================
//= Section title=
//=============================================
$wp_customize->add_setting('wpg_clubs_title', array(
	'default' => __('Clubs in the library', 'wpg_theme'),
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control( 'wpg_clubs_title', array(
	'settings' => 'wpg_clubs_title',
	'label' => __('Title section', 'wpg_theme'),
	'section'=> $club_section_id,
	'type'=> 'text'
));

// ==============================================
//=Section Description=
//=============================================
$wp_customize->add_setting('wpg_clubs_desc', array(
	'default' => '',
	'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control( 'wpg_clubs_desc', array(
	'settings' => 'wpg_clubs_desc',
	'label' => __('Description', 'wpg_theme'),
	'section'=> $club_section_id,
	'type'=> 'textarea'
));


// ======================================
//= Clubs =
//=====================================

// Terms for clubs
$clubs_list 	= get_all_terms(false, true, array('clubs' => __('Category','wpg_theme')));

for ( $i = 1; $i <= 3; $i++ ) {

	// ======================================
	//= Club title =
	//=====================================
	$wp_customize->add_setting("wpg_club_title_$i", array(
		'default'	=> '',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( "wpg_club_title_$i", array(
		'settings' 	=> "wpg_club_title_$i",
		'label' 	=> __('Club title', 'wpg_theme') . ' #' . $i,
		'section'	=> $club_section_id,
		'type'	=>'text'
	));

	// ======================================
	//= Club Description =
	//=====================================
	$wp_customize->add_setting("wpg_club_desc_$i", array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( "wpg_club_desc_$i", array(
		'settings' => "wpg_club_desc_$i",
		'label' => __('Description', 'wpg_theme') . ' #' . $i,
		'section'=> $club_section_id,
		'type'=> 'textarea'
	));

	// ======================================
	//= Chose Terms - =
	//=====================================
	$wp_customize->add_setting("wpg_club_terms_$i", array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wpg_intval',
	));

	$wp_customize->add_control("wpg_club_terms_$i", array(
		'type' => 'select',
		'label' => __('Select Category', 'wpg_theme') . ' #' . $i,
		'description' => __('Select category to show in Section.', 'wpg_theme'),
		'section' => $club_section_id,
		'choices' => $clubs_list['clubs'],
	));
}
