<?php

add_filter( 'rwmb_meta_boxes', 'wpg_register_meta_boxes' );

function wpg_register_meta_boxes( $meta_boxes ) {

	$prefix = 'wpg_';
	
	// 1st meta box
	$meta_boxes[] = array(
		'id'         => 'wpg_partner_metabox',
		'title'  => __('Partner url','wpg_theme'),
		'post_types' => array( 'partner'),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => __('Partner url','wpg_theme'),
				'id'   => $prefix. 'url_partner',
				'type' => 'url'
			)
		),
	);
	return $meta_boxes;
}
?>
