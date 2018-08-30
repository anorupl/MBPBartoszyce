<?php
/**
* The template for displaying 404 page.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
get_header(); ?>
<div id="content" class="site-content clear-both">
  <div class="header-content pad-all white-two text-center">
        <div class="class-h1 h--xxl">
            <?php _e('Oops! That page can&rsquo;t be found.', 'wpg_theme'); ?>
        </div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <section>
    <div id="primary" class="content-area col-primary--12 gutters">
      <main id="main" class="site-main ">
        <div class="error-404 not-found">
            <header class="entry-header text-center">
                <h1><?php _e('Oops! That page can&rsquo;t be found.', 'wpg_theme'); ?></h1>
            </header>
            <div class="entry-content class-h2 text-center">
                <?php _e('It looks like nothing was found at this location.', 'wpg_theme'); ?>

                <?php get_search_form(); ?>
            </div>
        </div>
      </main>
    </div><!-- #primary -->
  </section>
  </div><!-- .container -->
</div><!-- #content -->
<?php get_footer();  ?>
