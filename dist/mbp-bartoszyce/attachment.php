<?php
/**
* The template for displaying attachment.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

get_header(); ?>
<div id="content" class="site-content clear-both">
  <?php
  /* Start the Loop */
  while (have_posts()) : the_post();

  $attachment_data = wp_prepare_attachment_for_js($post->ID);

  ?>
  <div class="header-content pad-all text-light a-light a-hover-two text-center">
    <div class="class-h1 h--xxl" aria-hidden="true">
      <?php the_title(); ?>
    </div>
  </div><!-- header-content -->
  <div class="container clear-both">
    <div id="primary" class="content-area col-primary--12 gutters">
      <main id="main" class="site-main ">
        <div id="post-<?php the_ID(); ?>" <?php post_class('attachment--other clear-both'); ?>>
          <div class="attachment__header entry-header">
            <h2 class="entry-title">
              <?php
              _e('File name: ', 'wpg_theme');
              the_title();
              ?>
            </h2>
          </div>
          <div class="attachment__size col-12">
            <?php
            _e('File size: ', 'wpg_theme');
            echo $attachment_data['filesizeHumanReadable'];
            ?>
          </div>
          <div class="attachment__file text-center col-2" aria-hidden="true">
            <?php echo wp_get_attachment_link($post->ID, 'thumbnail', false, true, false); //icon button ?>
          </div>
          <div class="attachment__btn text-center col-10">
            <a class="btn class-h4" href="<?php echo $attachment_data['url']; ?>"><?php _e('Click to download', 'wpg_theme') ?></a>
          </div>
        </div>
      </main><!-- #main -->
    </div><!-- #primary -->
  </div><!-- .container -->
<?php endwhile; // End of the loop.	?>
</div><!-- #content -->
<?php get_footer(); ?>
