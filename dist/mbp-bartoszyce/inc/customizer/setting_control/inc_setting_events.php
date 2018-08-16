<?php
/**
* File with setting and control in 'events' section
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

// ==============================================
//  = Show/Hidde 							=
//  =============================================
$wp_customize->add_setting('wpg_events_active', array(
  'default'    => false,
  'capability' => 'edit_theme_options',
));
$wp_customize->add_control(
  new WPG_Customize_Control_Switch($wp_customize, 'wpg_events_active', array(

    'settings' => 'wpg_events_active',
    'section'  => $event_section_id ,
    'label'    => __('Show section', 'wpg_theme'),
    'type'     => 'switch'
  )
  )
);

// ==============================================
//  = Section title						=
//  =============================================
$wp_customize->add_setting('wpg_events_title', array(
  'default'           => __('Upcoming events', 'wpg_theme'),
  'capability'        => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'

));

$wp_customize->add_control( 'wpg_events_title', array(
  'settings' => 'wpg_events_title',
  'label'    => __('Title section', 'wpg_theme'),
  'section'  => $event_section_id ,
  'type'     => 'text'
));

?>
