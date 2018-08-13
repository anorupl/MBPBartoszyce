<?php
/**
 * File with setting and control in 'club' section
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

 	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================
	$wp_customize->add_setting('wpg_catl_active', array(
		'default'    => false,
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_catl_active', array(

		                'settings' 	=> 'wpg_catl_active',
		                'section'  	=> $catl_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
    );

 	// ==============================================
    //  = Section title						=
    //  =============================================
    $wp_customize->add_setting('wpg_catl_title', array(
		'default'           => __('Digital archive of local tradition', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_catl_title', array(
		'settings' => 'wpg_catl_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $catl_section_id,
		'type'    => 'text'
    ));

 	// ==============================================
    //  = button title						=
    //  =============================================
    $wp_customize->add_setting('wpg_catl_btn_title', array(
		'default'           => __('Go to the website', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_catl_btn_title', array(
		'settings' => 'wpg_catl_btn_title',
		'label'   => __('Button title', 'wpg_theme'),
		'section'  => $catl_section_id,
		'type'    => 'text'
    ));

 	// ==============================================
    //  = button url					=
    //  =============================================
    $wp_customize->add_setting('wpg_catl_btn_url', array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('wpg_catl_btn_url', array(
        'label' => __('Button url', 'wpg_theme'),
        'section' => $catl_section_id,
        'settings' => 'wpg_catl_btn_url',
        'type' => 'url',
    ));

    for ( $i = 1; $i <= 3; $i++ ) {
        // ==============================================
        //  = Tab title						=
        //  =============================================
        $wp_customize->add_setting("wpg_catl_tab_$i", array(
            'default'           => __('Tab', 'wpg_theme'),
            'capability' 		=> 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'

        ));

        $wp_customize->add_control( "wpg_catl_tab_$i", array(
            'settings' => "wpg_catl_tab_$i",
            'label'   => __('Tab', 'wpg_theme') . ' #' . $i,
            'section'  => $catl_section_id,
            'type'    => 'text'
        ));

        // ==============================================
        //  = Tab content				=
        //  =============================================

        $wp_customize->add_setting("wpg_catl_tabcontent_$i", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control( "wpg_catl_tabcontent_$i", array(
            'settings' => "wpg_catl_tabcontent_$i",
            'label'   => __('Tab Description', 'wpg_theme'),
            'section'  => $catl_section_id,
            'type'    => 'textarea'
        ));
    }
