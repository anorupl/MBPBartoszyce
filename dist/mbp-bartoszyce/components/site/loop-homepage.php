<?php
/**
 * The template for displaying the post on home page in header.
 *
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
?>
<div id="posts-header" class="clear-both">
    <main id="main" class="site-main clear-both white-a">

    <?php
    if (have_posts()):
        $i = 0;
    /* Start the Loop */
        while (have_posts()): the_post();

            $url_thumb = get_the_post_thumbnail_url($post, 'full');
            if ($url_thumb == false) {
                $url_thumb = get_template_directory_uri() . '/img/default/no_image.jpg';
            }

            if ($i == 0): ?>
            <article id="post-<?php the_ID();?>" <?php post_class('f-post col-8');?> >
                <div class="f-post-thumbnail col-8" style="background-image:url('<?php echo esc_url($url_thumb); ?>');"></div>
                <div class="f-post-content col-4 gutters">
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a></h2>
                    </header>
                    <div class="entry-summary">
                    <?php the_excerpt();?>
                    </div>
                </div>
            </article>

            <?php else: ?>

        <?php if ($i == 1) {echo '<div id="header-content" class="slider-header arrows-tr header-offslider hentry-header">';}?>
            <div>
                <article id="post-<?php the_ID();?>" <?php post_class();?>>
                    <div class="s-post-thumbnail" style="background-image:url('<?php echo esc_url($url_thumb); ?>');"></div>
                    <div class="s-post-content gutters">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a></h2>
                        </header>
                        <a class="icon-angle-right arrow-more-icon" href="<?php the_permalink();?>">
                        <?php the_title();?>
                        </a>
                    </div>
                </article>
            </div>
        <?php if ($i == 3) {echo '</div>';}?>
        <?php endif; $i++; endwhile;?>
        <a class="arrow-allpost-icon" href="<?php echo get_next_posts_page_link(); ?>">
            <?php _e('Show more ', 'wpg_theme');?>
            <i class="icon-angle-right"></i>
        </a>
        <?php endif; ?>
    </main>
    <div id="header-nav-bottom" class="col-11 gutters radius">
        <?php if (has_nav_menu('header_bottom')) {
            wp_nav_menu(array(
                'container' => false,
                'theme_location' => 'header_bottom',
                'menu_id' => 'header_bottom',
                'items_wrap' => '<nav id="%1$s" class="h-nav h-nav--color h-nav--desc wp-nav"><h2 class="hide-desktop">Katalogi</h2><ul class="%2$s">%3$s</ul></nav>',
            ));
        }
        ?>
    </div>
</div>
