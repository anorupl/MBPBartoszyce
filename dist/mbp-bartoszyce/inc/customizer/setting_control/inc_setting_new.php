<?php
/**
 * File with setting and control in 'new' section
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
 	// ==============================================
	//  = Show/Hidde 							=
	//  =============================================
	$wp_customize->add_setting('wpg_new_active', array(
		'default'    => false,
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_new_active', array(

		                'settings' 	=> 'wpg_new_active',
		                'section'  	=> $new_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
    );

 	// ==============================================
    //  = Section title						=
    //  =============================================
    $wp_customize->add_setting('wpg_new_title', array(
		'default'           => __('New in the library', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_new_title', array(
		'settings' => 'wpg_new_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $new_section_id,
		'type'    => 'text'
    ));

    // ======================================
    //  = New tab category =
    //  =====================================
    $tab_category_lists = get_all_terms(false, true, array(
        'categorycollection' => __('Category', 'wpg_theme'),
    ));

    $wp_customize->add_setting('wpg_new_tabs', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wpg_sanitize_MultiChecbox',
    )
    );
    $wp_customize->add_control(
        new WPG_Customize_Control_Checkbox_Multiple_Sort($wp_customize, 'wpg_new_tabs', array(
            'section' => $new_section_id,
            'label' => __('Choose offers', 'wpg_theme'),
            'choices' => $tab_category_lists['categorycollection'],
        )
        )
    );
