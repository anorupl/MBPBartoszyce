<?php
/**
* File with setting and control in 'featured Category' section
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

// ==============================================
//  = Show/Hidde 							=
//  =============================================
$wp_customize->add_setting('wpg_featuredcat_active', array(
  'default'    => false,
  'capability' => 'edit_theme_options',
));
$wp_customize->add_control(
  new WPG_Customize_Control_Switch($wp_customize, 'wpg_featuredcat_active', array(

    'settings' => 'wpg_featuredcat_active',
    'section'  => $featuredcat_section_id,
    'label'    => __('Show section', 'wpg_theme'),
    'type'     => 'switch'
  )
  )
);

// ==============================================
//  = Section title						=
//  =============================================
$wp_customize->add_setting('wpg_featuredcat_title', array(
  'default'           => __('In the library', 'wpg_theme'),
  'capability'        => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'

));

$wp_customize->add_control( 'wpg_featuredcat_title', array(
  'settings' => 'wpg_featuredcat_title',
  'label'    => __('Title section', 'wpg_theme'),
  'section'  => $featuredcat_section_id ,
  'type'     => 'text'
));

// ==============================================
//  = Select category					=
//  =============================================
$category_lists = get_all_terms(false, true);

$wp_customize->add_setting('wpg_featuredcat',array(
  'default'           => 0,
  'capability'        => 'edit_theme_options',
  'sanitize_callback' => 'wpg_intval'
)
);
$wp_customize->add_control('wpg_featuredcat',array(
  'type'        =>	'select',
  'label'       => __('Select Category','wpg_theme'),
  'description' => __('Select category to show in Section.','wpg_theme'),
  'section'     => $featuredcat_section_id,
  'choices'     => $category_lists['category']
)
);
