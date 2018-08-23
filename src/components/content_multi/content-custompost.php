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
        <div class="meta__item"><i class="icon-clock"></i><?php wpg_time() ?></div>
        <div class="meta__item hide-on-small"><i class="icon-user"></i>
          <span class="screen-reader"><?php _e('Author', 'wpg_theme'); ?></span>
          <?php the_author();?>
        </div>
        <div class="meta__item"><i class="icon-folder-open"></i><?php the_list_terms(); ?></div>
      </div><!-- .entry-meta -->
      <div class="entry-summary">
          <?php the_excerpt() ?>
          <a class="btn continue_reading" href="<?php the_permalink() ?>"><?php _e('Continue reading', 'wpg_theme'); ?> <span class="screen-reader-text"><?php the_title(); ?></span></a>
      </div><!-- .entry-summary -->

    <?php else: ?>

      <div class="entry-meta">
        <div class="meta__item"><i class="icon-clock"></i><?php wpg_time() ?></div>
        <div class="meta__item hide-on-small"><i class="icon-user"></i>
          <span class="screen-reader"><?php _e('Author', 'wpg_theme'); ?></span>
          <?php the_author();?>
        </div>
        <div class="meta__item"><i class="icon-folder-open"></i><?php echo get_the_term_list( $post->ID, 'category'); ?></php></div>
      </div><!-- .entry-meta -->
      <div class="entry-content">
          <?php
          /* translators: %s: Name of current post */
      		the_content( sprintf(
      			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
      			get_the_title()
      		) );

          ?>
      </div><!-- .entry-content -->

    <?php endif; ?>
</article>
