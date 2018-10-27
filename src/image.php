<?php
/**
* The template for displaying attachment image.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
get_header(); ?>
<div id="content" class="site-content clear-both">
  <?php
  /* Start the Loop */
  while (have_posts()) : the_post(); ?>
  <div class="header-content pad-all text-light text-center">
    <div class="class-h1 h--xxl" aria-hidden="true"><?php the_title(); ?></div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <div id="primary" class="content-area col-primary--12 gutters">
      <main id="main" class="site-main ">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="attachment-header pad-all text-center">
            <div class="entry-header screen-reader">
              <h2 class="entry-title"><?php the_title(); ?></h2>
            </div>
            <div class="entry-meta">
                <?php
                $metadata = wp_get_attachment_metadata();
                printf(__('Photo published in size <a href="%1$s" title="Link to original file">%2$s pixels <span class="screen-reader-text">(Image Width)</span> to %3$s pixels <span class="screen-reader-text">(Image Height)</span></a> in the article <a href="%4$s" title="Back to %5$s" rel="gallery">%6$s</a>', 'wpg_theme'),
                esc_url(wp_get_attachment_url()),
                $metadata['width'],
                $metadata['height'],
                esc_url(get_permalink($post->post_parent)),
                esc_attr(strip_tags(get_the_title($post->post_parent))),
                get_the_title($post->post_parent)
              );
              ?>
            </div>
            <div class="entry-share xl-icon">
              <?php wpg_share(); ?>
            </div>
          </div>
        <div class="entry-content text-center">
          <?php echo wp_get_attachment_image($post->ID, 'full'); ?>
        </div><!-- .entry-content -->
      </div>
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .container -->
<?php endwhile; // End of the loop.	?>
</div><!-- #content -->
<?php get_footer(); ?>
