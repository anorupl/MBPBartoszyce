<?php
/**
* The template for displaying the footer.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

wp_footer();

?>
<footer class="clear-both">
<?php
  /* ====================
   * Section - contact  *
   * ===================*/
  get_template_part('components/features/section', 'contact' );

  /* ====================
   * Section - partners *
   * ===================*/
  if (get_theme_mod('wpg_partners_active', false) === true) {
    get_template_part('components/features/section', 'partners' );
  }
?>
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">&copy; <?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.<?php  _e('All Rights Reserved', 'wpg_theme'); ?></div>
        <div class="col-4"></div>
    </div>
</div>
</footer>
</body>
</html>
