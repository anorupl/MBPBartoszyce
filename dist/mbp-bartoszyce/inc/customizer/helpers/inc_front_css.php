<?php
/**
 * File CSS styles generated from Cusotmizer settings.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

/**
 * Add CSS styles generated from Cusotmizer settings
 *
 * @since 0.1.0
 */
function wpg_customizer_css() { ?>
	
<style id="customizer-style" type="text/css">
		<?php

		$body_font 		= get_theme_mod('wpg_body_font', 'Arial');
		$headings_font 	= get_theme_mod('wpg_heading_font','Tahoma');
		$font_weight	= 'normal';
		$font_style		= 'normal';
		
		if ($body_font !== '') :
			if ($body_font == 'google') {
	
				$body_font = get_theme_mod('wpg_body_google_font', 'Open Sans');
	
				$v			 	= get_theme_mod( 'wpg_body_google_variants', 'regular' );
				$font_weight 	= $v === 'regular' ? 'normal' : preg_replace( '/[^0-9]/', '', $v );
				$font_style 	= strpos( $v, 'italic' ) !== false ? 'italic' : 'normal';
	
	
			}
			printf( "body {font-family:\"%s\"; font-weight: %s; font-style: %s ;}", $body_font, $font_weight ,$font_style);
		endif;
		
		if ($headings_font !== '') :
		
			$font_weight	= 'normal';
			$font_style		= 'normal';

			if ($headings_font == 'google')	{
	
				$headings_font 	= get_theme_mod('wpg_heading_google_font', 'Oswald');
				$v				= get_theme_mod( 'wpg_heading_google_variants', 'regular' );
				$font_weight 	= $v === 'regular' ? 'normal' : preg_replace( '/[^0-9]/', '', $v );
				$font_style 	=  strpos( $v, 'italic' ) !== false ? 'italic' : 'normal';
	
			}
			printf( "h1,h2,h3,h4,h5,h6,.class-h1,.class-h2,.class-h3,.class-h4 {font-family:\"%s\"; font-weight: %s; font-style: %s ;}", $headings_font, $font_weight ,$font_style);
		
		endif;	?>
</style>
<?php
}
add_action( 'wp_head', 'wpg_customizer_css' );

// EOF