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
?>
