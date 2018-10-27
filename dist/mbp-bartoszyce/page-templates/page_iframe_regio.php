<?php
/**
 * Template Name: Regionalna - Katalog online
 *
* @package MBP Bartoszyce
* @since 0.1.0
*/

get_header(); ?>
<div id="content" class="site-content clear-both">
  <?php
  /* Start the Loop */
  while ( have_posts() ) :
    the_post();
  ?>
  <div class="header-content pad-all text-light text-center">
    <div><h2 class="h--xxl"><?php the_title(); ?></h2></div>
  </div><!-- header-content -->
  <div id="primary" class="content-area col-primary--12 fidkar-white">
    <main id="main" class="site-main ">
      <div class="container">
        <iframe id="site-main__iframe" name="iframe" src="http://www.wbp.olsztyn.pl/cgi-bin/brwm/makwww?BM=23" width="100%" height="900px" scrolling="auto" align="top" frameborder="0"><?php _e('This page is visible only in browsers that support frames.','wpg_theme'); ?></iframe>
      </div>
    </main>
  </div><!-- #primary -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer('wfidkar');  ?>
