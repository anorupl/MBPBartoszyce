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
  <div class="header-content pad-all text-light a-light a-hover-two text-center">
        <div class="class-h1 h--xxl">
            <?php the_title(); ?>
        </div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <div id="primary" class="content-area col-primary gutters">
      <main id="main" class="site-main ">
        <article>
          <header class="entry-header screen-reader">
              <h2 class="entry-title h--xxl">
                  <?php the_title(); ?>
              </h2>
          </header>
          <div class="entry-meta">
            <div class="meta__item">
              <i class="icon-clock"></i><?php wpg_time() ?>
            </div>
            <div class="meta__item hide-on-small"><i class="icon-user"></i>
              <span class="screen-reader"><?php _e('Author', 'wpg_theme'); ?></span><?php the_author();?>
            </div>
          </div><!-- .entry-meta -->
          <div class="entry-content">
              <?php
              the_content();

              wp_link_pages(array(
                  'before' => '<nav class="page-links pagination-inside" role="navigation"><span class="page-links-title">' . __('Pages:', 'wpg_theme') . '</span>',
                  'after' => '</nav>',
                  'link_before' => '<span>',
                  'link_after' => '</span>',
                  'pagelink' => '<span class="screen-reader-text">' . __('Page', 'wpg_theme') . '</span> %',
                  'separator' => '<span class="screen-reader-text">, </span>',
              ));
              ?>
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
    <?php get_sidebar(); ?>
  </div><!-- .container -->
  <?php endwhile; ?>
</div><!-- #content -->
<?php get_footer();  ?>
