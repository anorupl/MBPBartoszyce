<?php
/**
 * The left sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
?>

<aside id="secondary" class="widget-area col-secondary gutters" role="complementary">
	<?php
	if (has_nav_menu('left_sidebar')) {

			wp_nav_menu(array(
					'container'      => false,
					'theme_location' => 'left_sidebar',
					'menu_id'        => 'left_sidebar-menu',
					'items_wrap'     => '<nav id="%1$s" class="v-nav dropdown wp-nav"><ul class="%2$s">%3$s</ul></nav>',
			));

	}
	if (  is_active_sidebar( 'wpg-sidebar-left' ) ) {
		dynamic_sidebar( 'wpg-sidebar-left' );
	}
	?>
</aside>
