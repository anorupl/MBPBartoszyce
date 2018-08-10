<?php
/**
 * File with context functions
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */


 /**
  * Context functions
  *
  * Context functions for wpg_body_google_font. Checks if option 'google' is selected
  *
  * @since 0.1.0
  *
  * @param object $control
  * @return bool
  */
function wpg_body_font_field($control) {

	$option = $control->manager->get_setting('wpg_body_font');
	return $option->value() == 'google';
}


/**
 * Context functions
 *
 * Context functions for wpg_heading_google_font. Checks if option 'google' is selected
 *
 * @since 0.1.0
 *
 * @param object $control
 * @return bool
 */
function wpg_heading_font_field($control) {
	$option = $control->manager->get_setting('wpg_heading_font');
	return $option->value() == 'google';
}

/**
 * Context functions
 *
 * Context functions for 'google_subsets'. Checks if option 'google' is selected
 *
 * @since 0.1.0
 *
 * @param object $control
 * @return bool
 */
function wpg_subset_field($control) {

	$option 	= $control->manager->get_setting('wpg_heading_font');
	$option_two = $control->manager->get_setting('wpg_body_font');

	return ($option->value() == 'google' || $option_two->value() == 'google') ? true : false;


}





?>