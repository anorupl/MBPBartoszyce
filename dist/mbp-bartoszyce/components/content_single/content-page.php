<?php
/**
* Template part for displaying page content in page.php
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
?>

<article <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <hr>
    <div class="entry-meta">
        <?php printf(__('Page published on <time class="entry-date published updated" itemprop="datePublished dateModified" datetime="%1$s">%2$s</time>, by <span class="author vcard" ><span class="fn">%3$s</span></span>','wpg_theme'),
        get_the_date( 'c' ),
        get_the_date(),
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
