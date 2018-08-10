<?php
/**
* Template part for displaying single posts.
*
* @package MBP Bartoszyce
* @since 0.1.0
*
*/
?>
<article <?php post_class(); ?>>
    <header class="entry-header text-center">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <hr>
    <div class="entry-meta">
        <?php printf(__('Post published in category %1$s, on <time class="entry-date published updated" datetime="%2$s">%3$s</time>, by <span class="author vcard"><span class="fn">%4$s</span></span>','wpg_theme'),
        get_the_category_list(','),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        get_the_author()
    ); ?>
</div>
<div class="entry-share">
    <?php wpg_share(); ?>
</div>
<div class="entry-content">
    <?php
    the_content();

    wp_link_pages(array(
        'before' => '<nav class="page-links pagination-inside" role="navigation"><span class="page-links-title">' . __('Pages:', 'wpg_theme') . '</span>',
        'after' => '</nav>',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'pagelink' => '<span class="screen-reader-text">' . __('Page', 'wpg_theme') . ' </span>',
        'separator' => '<span class="screen-reader-text">, </span>',
    ));
    ?>
</div><!-- .entry-content -->
</article>
