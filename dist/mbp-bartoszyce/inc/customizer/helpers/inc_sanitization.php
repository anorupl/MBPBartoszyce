<?php 
/**
 * Sanitize functions
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */ 
 
 
/**
 * Sanitize function for intval
 *
 * @since 0.1.0
 *
 * @param intval $value 
 * @return intval
 */ 
function wpg_intval($value) {
	return intval($value);
} 

/**
 * Sanitize function for Font Family
 *
 * @since 0.1.0
 *
 * @param string $value 
 * @param object $setting 
 * 
 * @return string
 */ 
function wpg_sanitize_font_family( $value, $setting ) {
		
	// Setting id 		
	$field = $setting->id;

	if ($field == 'wpg_body_font' || $field == 'wpg_heading_font') {
		if ( ! is_string( $value ) || $value === '' ) {
			return '';
		} else if ( in_array( $value, array_keys( set_font_list() ) )) {
			return $value; 
		}			
	}
		
	if ($field == 'wpg_body_google_font' || $field == 'wpg_heading_google_font') {
		if ( ! is_string( $value ) || $value === '' ) {
			return '';
		} else if ( in_array( $value, array_keys( set_font_list(false,true) ) )) {
			return $value; 
		}			
	}	
}

/**
 * Sanitize function to Font Family Variant
 *
 * @since 0.1.0
 *
 * @param string $value 
 * @return string
 */ 
function wpg_sanitize_font_variant( $value ) {

	$options = array(
		"100",
		"100italic",
		"200",
		"200italic",
		"300",
		"300italic",
		"500",
		"500italic",
		"600",
		"600italic",
		"700",
		"700italic",
		"800",
		"800italic",
		"900",
		"900italic",
		"italic",
		"regular",
		"thin",
		"thin-italic",
		"bold",
		"bold-italic",
		"medium",
		"medium-italic",
		"extra-light",
		"extra-light-italic",
		"light",
		"light-italic",
		"serif",
		"serif-italic"
	);

	if ( ! is_string( $value ) || $value === '' ) {
		return 'regular';
	} else if ( in_array( $value, $options ) ) {
		return $value;
	}

	return 'regular';
}



 
/**
 * Sanitize function to Multi Checbox
 *
 * @since 1.0.0
 *
 * @param array $values, List select checbox
 * @return array
 */ 
function wpg_sanitize_MultiChecbox( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : '';
}


/**
 * Sanitize number range.
 *
 * @since 0.1.0
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $input Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise, the setting default.
 */
function wpg_sanitize_number_range( $input, $setting ) {

	// Ensure input is an absolute integer.
	$input = absint( $input );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get min.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $input );

	// Get max.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $input );

	// Get Step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the input is within the valid range, return it; otherwise, return the default.
	return ( $min <= $input && $input <= $max && is_int( $input / $step ) ? $input : $setting->default );

}
?>