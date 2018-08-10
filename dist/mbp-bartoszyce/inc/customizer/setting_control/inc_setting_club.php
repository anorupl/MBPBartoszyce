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
	$wp_customize->add_setting('wpg_clubs_active', array(
		'default'    => false,
		'capability' => 'edit_theme_options',
	));
	
	$wp_customize->add_control(
		        new WPG_Customize_Control_Switch($wp_customize, 'wpg_clubs_active', array(

		                'settings' 	=> 'wpg_clubs_active',
		                'section'  	=> $club_section_id,
		                'label'    	=> __('Show section', 'wpg_theme'),
		                'type'		=> 'switch'
		            )
		        )
    );
    
 	// ==============================================
    //  = Section title						=
    //  =============================================
    $wp_customize->add_setting('wpg_clubs_title', array(
		'default'           => __('Clubs in the library', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_clubs_title', array(
		'settings' => 'wpg_clubs_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $club_section_id,
		'type'    => 'text'
    ));

 	// ==============================================
    //  =  Section Description						=
    //  =============================================  
	$wp_customize->add_setting('wpg_clubs_desc', array(
		'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
		
	$wp_customize->add_control( 'wpg_clubs_desc', array(
		'settings' => 'wpg_clubs_desc',
		'label'   => __('Description', 'wpg_theme'),
		'section'  => $club_section_id,
		'type'    => 'textarea'
    ));

 	// ==============================================
    //  = Number of items						=
    //  =============================================
	$wp_customize->add_setting( 'wpg_club_number',
		array(
			'default'           => 1,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpg_sanitize_number_range',
			)
	);
	$wp_customize->add_control( 'wpg_club_number',
		array(
			'label'           => __( 'No of items', 'wpg_theme' ),
			'description'     => sprintf(__('Enter number between %1s and %2s .Save and refresh the page then number of Blocks is changed.','wpg_theme'),'1','10' ),
			'section'         => $club_section_id,
			'type'            => 'number',
			'input_attrs'     => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
			)
    ); 
    
    
    // ======================================
    //  = Clubs =
    //  =====================================    

    $clubs_number = absint( get_theme_mod( 'wpg_club_number', '1') );
    
    // Terms for clubs
	$clubs_list   	= get_all_terms(false, true, array('clubs' => __('Category','wpg_theme')));
 

    if ( $clubs_number >= 1 ) {
		for ( $i = 1; $i <= $clubs_number; $i++ ) {
           
            // ======================================
		    //  = Club title =
		    //  =====================================
            $wp_customize->add_setting("wpg_club_title_$i", array(
				'default'        	=> '',
		        'sanitize_callback' => 'sanitize_text_field'
			));
		
			$wp_customize->add_control( "wpg_club_title_$i", array(
				'settings' 	=> "wpg_club_title_$i",
				'label'   	=> __('Club title', 'wpg_theme') . ' #' . $i,
				'section'  	=> $club_section_id,
				'type'    	=>'text'
            ));

   			// ======================================
		    //  = Club Description =
		    //  =====================================	
            $wp_customize->add_setting("wpg_club_desc_$i", array(
				'default'        => '',
		        'sanitize_callback' => 'sanitize_text_field'
			));
		
			$wp_customize->add_control( "wpg_club_desc_$i", array(
				'settings' => "wpg_club_desc_$i",
				'label'   => __('Description', 'wpg_theme') . ' #' . $i,
				'section'  => $club_section_id,
				'type'    => 'textarea'
			));             


   	
          
            // ======================================
            //  = Chose Terms - =
            //  =====================================
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
    }