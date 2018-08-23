<?php
/**
* Template part for displaying single custom post type - club.
*
* @package MBP Bartoszyce
* @since 0.1.0
*
*/
?>
<article>
  <header class="entry-header screen-reader">
      <h2 class="entry-title h--xxl">
          <?php the_title(); ?>
      </h2>
  </header>
  <div class="entry-meta">
    <div class="meta__item"><i class="icon-clock"></i><?php wpg_time() ?></div>
    <div class="meta__item hide-on-small"><i class="icon-user"></i>
      <span class="screen-reader"><?php _e('Author', 'wpg_theme'); ?></span>
      <?php the_author();?>
    </div>
    <div class="meta__item"><i class="icon-folder-open"></i><?php the_list_terms(); ?></div>
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
// Previous/next post navigation.
      the_post_navigation( array(
        'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'wpg_theme' ) . '</span> ' .
          '<span class="screen-reader-text">' . __( 'Next post:', 'wpg_theme' ) . '</span> ' .
          '<span class="post-title">%title</span>',
        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'wpg_theme' ) . '</span> ' .
          '<span class="screen-reader-text">' . __( 'Previous post:', 'wpg_theme' ) . '</span> ' .
          '<span class="post-title">%title</span>'

      ) );
?>
<?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) {
      comments_template();
    }
?>
