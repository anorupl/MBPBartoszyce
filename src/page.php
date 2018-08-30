<?php
/**
* The template for displaying all pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
  <div class="header-content pad-all white-two text-center">
        <div class="class-h1 h--xxl">
            <?php the_title(); ?>
        </div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <div id="primary" class="content-area col-primary gutters">
      <main id="main" class="site-main ">
        <?php get_template_part( 'components/content_single/content', 'page' ); ?>
      </main>
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
  </div><!-- .container -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer();  ?>
