<?php
 /**
 * File with setting and control in 'Blog' section
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

	// ==============================================
    //  = Section title								=
    //  =============================================
 	$wp_customize->add_setting('wpg_blog_title', array(
		'default'        => __('Last post', 'wpg_theme'),
   		'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'

	));

	$wp_customize->add_control( 'wpg_blog_title', array(
		'settings' => 'wpg_blog_title',
		'label'   => __('Title section', 'wpg_theme'),
		'section'  => $blog_section_id,
		'type'    => 'text'
	));

  ?>
