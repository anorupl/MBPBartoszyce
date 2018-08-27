<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
        <div class="class-h1 h--xxl">
            <?php the_title(); ?>
        </div>
        <div id="breadcrumbs">
          <span><?php _e('You are here: &nbsp;', 'wpg_theme'); ?></span><?php if (function_exists('wpg_breadcrumbs')) wpg_breadcrumbs(); ?>
        </div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <div id="primary" class="content-area col-primary gutters">
      <main id="main" class="site-main ">
        <?php get_template_part( 'components/content_single/content', 'event' ); ?>
      </main>
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
  </div><!-- .container -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer();  ?>
