<?php
/**
 * File with setting and control link in section Social networks.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

 	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================
	$wp_customize->add_setting('wpg_partners_active', array(
		'default'    => false,
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_partners_active', array(

		                'settings' 	=> 'wpg_partners_active',
		                'section'  	=> $partners_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
    );

 	// ==============================================
    //  = Section title						=
    //  =============================================
    $wp_customize->add_setting('wpg_partners_title', array(
		'default'           => __('Partners', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_partners_title', array(
		'settings' => 'wpg_partners_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $partners_section_id,
		'type'    => 'text'
    ));
