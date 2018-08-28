<?php
/**
* The template for displaying the footer with iframe fidkar (yellow bg).
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
?>
<footer class="clear-both fidkar-white">
  <?php
  /* ====================
  * Section - contact  *
  * ===================*/
  get_template_part('components/features/section', 'contact' );
  ?>
</footer>
<?php
/* ====================
* Section - partners *
* ===================*/
if (get_theme_mod('wpg_partners_active', false) === true) {
  get_template_part('components/features/section', 'partners' );
}
?>
<div id="copyright" class="col-12 pad-all text-center">&copy; <?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.<?php  _e('All Rights Reserved', 'wpg_theme'); ?></div>
<?php wp_footer(); ?>
</body>
</html>
