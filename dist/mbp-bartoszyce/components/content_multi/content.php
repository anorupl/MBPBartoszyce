<?php
/**
* Template part for displaying posts content in multiple loop (archive, category).
*
* @package MBP Bartoszyce
* @since 0.1.0
*
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clear-both'); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
    </header>
    <?php if (has_post_thumbnail()) : ?>

      <figure class="post-thumbnail">
          <a href="<?php the_permalink(); ?>" aria-hidden="true">
              <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
          </a>
      </figure>
      <div class="entry-meta">
        <div class="meta__icon"><i class="icon-clock"></i></div>
        <div class="meta__text"><?php wpg_time() ?></div>

        <div class="meta__icon"><i class="icon-user"></i></div>
        <div class="meta__text"><?php ?></div>

        <div class="meta__icon"><i class="icon-folder-open"></i></div>
        <div class="meta__text"><?php echo get_the_term_list( $post->ID, 'category', $before, $sep, $after ); ?></php></div>




      </div>
      <div class="entry-summary">
          <?php the_excerpt() ?>
          <a class="btn continue_reading" href="<?php the_permalink() ?>"><?php _e('Continue reading', 'wpg_theme'); ?> <span class="screen-reader-text"><?php the_title(); ?></span></a>
      </div>

    <?php else: ?>
      <div class="entry-meta"></div>
      <div class="entry-content">
          <?php the_content('', true); ?>
      </div>
    <?php endif; ?>
</article>
