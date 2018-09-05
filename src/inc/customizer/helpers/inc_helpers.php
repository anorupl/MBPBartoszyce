<?php
/**
 * Functions used by Theme Customizer
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */


/**
 * Creates array with fonts
 *
 * @since 0.1.0

 * @param boolean $BaseFont Basic list of fonts, default: true.
 * @param boolean $google Google fonts list, default: false.
 *
 * @return array
 */
function set_font_list( $BaseFont = true, $google = false){

	$base =  array(
	       	'google'    		=> 'Google Font',
	       	'verdana'   		=> 'Verdana',
	       	'georgia'    		=> 'Georgia',
	       	'arial'      		=> 'Arial',
	       	'impact'     		=> 'Impact',
	       	'tahoma'     		=> 'Tahoma',
	        'times'      		=> 'Times New Roman',
	        'comic sans ms'     => 'Comic Sans MS',
	        'courier new'   	=> 'Courier New',
	        'helvetica'  		=> 'Helvetica'
	);

	if ($google == true) {

		$response = wp_remote_retrieve_body(wp_remote_get( get_stylesheet_directory_uri().'/inc/customizer/assets/fonts/google_fonts.json' ));
		$google_fonts = json_decode($response, true);

		foreach( $google_fonts['items'] as $google_font ){

			$google_font_list[$google_font['family']] = array(
					'variants' => $google_font['variants'],
					'subsets' => $google_font['subsets'],
			);
		}

		if ($google == true && $BaseFont == true) {
			return $merge_list = array_merge($base, $google_font_list);
		} else {
			return $google_font_list;
		}
	}
	else {
		return $base;
	}
}





/**
 * Modifies the get_terms_orderby argument if orderby == include
 *
 * @since 0.1.0
 *
 * @param  string $orderby Default orderby SQL string.
 * @param  array  $args    get_terms( $taxonomy, $args ) arg.
 * @return string $orderby Modified orderby SQL string.
 */
function wps_get_terms_orderby( $orderby, $args) {
  if ( isset( $args['orderby'] ) && 'include' == $args['orderby'] ) {
		$include = implode(',', array_map( 'absint', $args['include'] ));
		$orderby = "FIELD( t.term_id, $include )";
	}
	return $orderby;
}
add_filter( 'get_terms_orderby', 'wps_get_terms_orderby', 10, 2 );




/**
 * Get Category and all custom taxonomy with terms
 *
 * @since 0.1.0
 *
 * @param  bool $only_tax, default: false.
 * @param  bool $one_tax, default: false.
 * @param  bool $only_tax, default: false.
 *
 * @return array, with taxonomy or taxonomy with terms.
 */
function get_all_terms( $only_tax = false, $one_tax = false, $taxonomies = array()){

	$all_terms 	= array();

	if (empty($taxonomies))
	$taxonomies = array('category' => __('Category','wpg_theme'));


	if ($one_tax == false) {

		$custom_taxonomies = get_taxonomies( array('public' => true, '_builtin' => false), 'objects', 'and');

		if ($custom_taxonomies !== null ) {
		 	foreach ($custom_taxonomies  as $taxonomy ) {

				 $taxonomies[$taxonomy->name] = $taxonomy->labels->singular_name;
			}
			if ( $only_tax == true ) {

				return $taxonomies;
			}
		}//$custom_taxonomies
	}//$one_tax


	foreach ($taxonomies  as $name => $value) {

		$tax_terms = get_terms(array('taxonomy' => $name,'hide_empty' => false));

			$all_terms[$name][0] = __('All Categories','wpg_theme');

		foreach($tax_terms as $term) {
			$all_terms[$name][$term->term_id] = $term->name;
		}
	}
	return $all_terms;
}


/**
 * Return link to social networks
 *
 * @since 0.1.0
 * @param string $format_string Format for printf(), $1%s-title, $2%s links.
 *
 * @return string
 */
function wpg_social_net_link($format_string) {

	$social = array('facebook','google','twitter','youtube','vimeo','instagram');

	$links = '';

	foreach ($social as $value) {
		$key = 'wpg_sn_'.$value;

		if (get_theme_mod($key, '') !== '') {
			get_theme_mod($key);
			$links .= '<a href="'. get_theme_mod($key, '') . '"><i class="icon-'. $value .'-f"></i><span class="screen-reader-text">'. __('Profile on the site ','wpg_theme') . $value .'</span></a>';
		}
	}
	if ($links !== '') {
		printf($format_string, __('Find us on', 'wpg_theme'),$links);
	}
}
/**
 * Return list with categories
 *
 * @since 0.1.0
 *
 * @return array
 */
function wpg_category_lists(){
	$category 	=	get_categories();
	$cat_list 	=	array();
	$cat_list[0]=	__('Select Category','wpg_theme');
	$cat_list[0]=	__('All Categories','wpg_theme');
	foreach ($category as $cat) {
		$cat_list[$cat->term_id]	=	$cat->name;
	}
	return $cat_list;
}

/**
 * Display adress
 *
 * @since 0.1.0
 * @param	string $index_tab
 *
 * @return	string with html
 */
function wpg_the_adress($index_tab = '1'){
	if (get_theme_mod("wpg_contact_adres_$index_tab", '') !== '') : ?>

		<div class="contact-item adress-contact">
			<i class="icon-map-marker item-icon"></i><?php echo esc_html(get_theme_mod("wpg_contact_adres_$index_tab",'')); ?>
		</div>

	<?php endif; ?>
	<?php if (get_theme_mod("wpg_contact_email_$index_tab", '') !== '') : ?>

		<div class="contact-item adress-contact">
			<i class="icon-envelope item-icon"></i><?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod("wpg_contact_email_$index_tab",''))); ?>
		</div>

	<?php endif; ?>
	<?php if (get_theme_mod("wpg_contact_phone_$index_tab", '') !== '') : ?>

		<div class="contact-item adress-contact">
			<i class="icon-phone_android item-icon"></i><?php echo esc_html(get_theme_mod("wpg_contact_phone_$index_tab",'')); ?>
		</div>

	<?php endif;
}
?>
