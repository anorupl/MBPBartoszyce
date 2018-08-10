<?php
/**
* The template for displaying the footer.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package MBP Bartoszyce
* @since 0.1.0
*/


wp_footer(); ?>

<footer class="clear-both">
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
