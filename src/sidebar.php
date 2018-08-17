<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
if ( ! is_active_sidebar( 'wpg-sidebar-right' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area gutters col-8" role="complementary">
	<?php dynamic_sidebar( 'wpg-sidebar-right' ); ?>
</aside>
