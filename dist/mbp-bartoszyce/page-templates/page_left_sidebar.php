<?php
/**
 * Template Name: Pokaż lewy pasek
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
        <div>
            <h2 class="h--xxl"><?php the_title(); ?></h2>
        </div>
  </div><!-- header-content -->
  <div class="container">
    <div id="primary" class="content-area col-primary gutters">
      <main id="main" class="site-main ">
        <article>
          <header class="entry-header screen-reader">
              <h2 class="entry-title h--xxl">
                  <?php the_title(); ?>
              </h2>
          </header>
          <div class="entry-content">
              <?php the_content(); ?>
          </div><!-- .entry-content -->

        </article>
        <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }
        ?>
      </main>
    </div><!-- #primary -->
    <?php get_sidebar('left'); ?>
  </div><!-- .container -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer('wfidkar');  ?>
