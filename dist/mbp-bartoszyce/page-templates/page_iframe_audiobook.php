<?php
/**
 * Template Name: Audiobooki - Katalog online
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
  <div class="header-content gutters white-a text-center">
        <div>
            <h2 class="h--xxl"><?php the_title(); ?></h2>
        </div>
  </div><!-- header-content -->
    <div id="primary" class="content-area col-primary--12">
      <main id="main" class="site-main ">
        <iframe id="site-main__iframe" name="iframe" src="http://www.wbp.olsztyn.pl/cgi-bin/pow_bartoszycki/makwww?BM=2" width="100%" height="900px" scrolling="auto" align="top" frameborder="0" class="wrapper"><?php _e('This page is visible only in browsers that support frames.','wpg_theme'); ?></iframe>
        </div>
      </main>
    </div><!-- #primary -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer('wfidkar');  ?>
