<?php
/**
 * File with setting and control in 'Typography' section
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

 		// Default setting
		$default_font_setting = array(
						'body_base' 				=> 'arial',
						'body_google' 				=> 'Open Sans',
						'body_google_variants' 		=> 'regular',
						'heading_base' 				=> 'tahoma',
						'heading_google' 			=> 'Oswald',
						'heading_google_variants' 	=> 'regular',
						'google_subsets'			=> 'latin-ext'


		);

		/* Add setting and control - Body Font Family
		 *******************************/

		// Standard Body Font Family
		$wp_customize->add_setting( 'wpg_body_font', array(
		    		'default'   		=> $default_font_setting['body_base'],
		    		'sanitize_callback' => 'wpg_sanitize_font_family',
		    		'capability' 		=> 'edit_theme_options'

				)
		);

		$wp_customize->add_control('wpg_body_font', array(
			        'section'  		=> $font_section_id,
			        'label'    		=> __('Body Font Family','wpg_theme'),
			        'description' 	=> __('Select font or option Google Font to see advanced options google fonts.','wpg_theme'),
			        'type'     		=> 'select',
			        'choices'  		=> set_font_list()
			   	 )
		);

		// Add Body Google Font Family
		$wp_customize->add_setting( 'wpg_body_google_font', array (
			 	'default'  			=>	$default_font_setting['body_google'],
			 	'sanitize_callback' => 'wpg_sanitize_font_family'
			 	//'transport' 		=> 'postMessage'
				)
		);

		$wp_customize->add_control(

    		new Fonts_Dropdown_Google( $wp_customize, 'wpg_body_google_font',array(
				'label'				=> __('Google Font Family','wpg_theme'),
				'settings'			=> 'wpg_body_google_font',
				'section'			=> $font_section_id,
				'type'				=> 'google_font',
				'active_callback'	=> 'wpg_body_font_field'
				)
		));

		// Add Body Google Font Style
		$wp_customize->add_setting('wpg_body_google_variants',
   		 		array (
		 		'default' 			=> $default_font_setting['body_google_variants'],
		 		'sanitize_callback' => 'wpg_sanitize_font_variant'
		       	)
		);

		$wp_customize->add_control(
			new Fonts_Dropdown_Google( $wp_customize, 'wpg_body_google_variants', array(
				'label' 			=> __('Font Variant','wpg_theme'),
				'description'		=> __('Different variants of the font, provides control over font-weight and italics','wpg_theme'),
				'settings' 			=> 'wpg_body_google_variants',
				'section'  			=> $font_section_id,
				'type'				=> 'google_variants',
				'font_field'		=> 'wpg_body_google_font', // connect with font family
				'active_callback' 	=> 'wpg_body_font_field'
				)
			)
		);

		/* Add setting and control - Heading Font Family
		 *******************************/

		// Standard Heading Font Family
		$wp_customize->add_setting( 'wpg_heading_font', array(
		    		'default'   		=> $default_font_setting['heading_base'],
		    		'sanitize_callback' => 'wpg_sanitize_font_family',
		    		'capability' 		=> 'edit_theme_options'

				)
		);

		$wp_customize->add_control('wpg_heading_font', array(
			        'section'  		=> $font_section_id,
			        'label'    		=> __('Heading Font Family','wpg_theme'),
			        'description' 	=> __('Select font or option Google Font to see advanced options google fonts.','wpg_theme'),
			        'type'     		=> 'select',
			        'choices'  		=> set_font_list()
			   	 )
		);

		// Heading Google Font Family
		$wp_customize->add_setting( 'wpg_heading_google_font', array (
			 	'default'  			=>	$default_font_setting['heading_google'],
			 	'sanitize_callback' => 'wpg_sanitize_font_family'
			 	//'transport' 		=> 'postMessage'
				)
		);

		$wp_customize->add_control(

    		new Fonts_Dropdown_Google( $wp_customize, 'wpg_heading_google_font',array(
				'label'				=> __('Heading - Google Font Family','wpg_theme'),
				'settings'			=> 'wpg_heading_google_font',
				'section'			=> $font_section_id,
				'type'				=> 'google_font',
				'active_callback'	=> 'wpg_heading_font_field'
				)
		));

		// Heading Google Font Style
		$wp_customize->add_setting('wpg_heading_google_variants',
   		 		array (
		 		'default' 			=> $default_font_setting['heading_google_variants'],
		 		'sanitize_callback' => 'wpg_sanitize_font_variant'
		       	)
		);

		$wp_customize->add_control(
			new Fonts_Dropdown_Google( $wp_customize, 'wpg_heading_google_variants', array(
				'label' 			=> __('Font Variant','wpg_theme'),
				'description'		=> __('Different variants of the font, provides control over font-weight and italics','wpg_theme'),
				'settings' 			=> 'wpg_heading_google_variants',
				'section'  			=> $font_section_id,
				'type'				=> 'google_variants',
				'font_field'		=> 'wpg_heading_google_font', // connect with font family
				'active_callback' 	=> 'wpg_heading_font_field'

				)
			)
		);


		/* Add setting and control - Google Subsets [Multi checbox]
		 *******************************/

		// Array with choice in control 'google_subsets'
		$google_subsets = array(
			'latin'        => __( 'Latin', 'wpg_theme' ),
			'latin-ext'    => __( 'Latin Extended', 'wpg_theme' ),
			'greek'        => __( 'Greek', 'wpg_theme' ),
			'greek-ext'    => __( 'Greek Extended', 'wpg_theme' ),
			'cyrillic'     => __( 'Cyrillic', 'wpg_theme' ),
			'cyrillic-ext' => __( 'Cyrillic Extended', 'wpg_theme' ),
			'vietnamese'   => __( 'Vietnamese', 'wpg_theme' ),
			'arabic'       => __( 'Arabic', 'wpg_theme' ),
			'khmer'        => __( 'Khmer', 'wpg_theme' ),
			'devanagari'   => __( 'Devanagari', 'wpg_theme' )
		);

 		$wp_customize->add_setting( 'google_subsets', array(

		            'default'           =>  $default_font_setting['google_subsets'],
		            'sanitize_callback' => 'wpg_sanitize_MultiChecbox'
		        )
		);

		$wp_customize->add_control(
		        new WPG_Customize_Control_Checkbox_Multiple($wp_customize, 'google_subsets', array(

		                'section' 			=> $font_section_id,
		                'label'   			=> __( 'Choose Google Font Subsets', 'wpg_theme' ),
		                'active_callback' 	=> 'wpg_subset_field',
						'choices' 			=> $google_subsets

		            )
		        )
		);

?>