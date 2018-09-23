<?php
/**
 * The template for displaying the post on home page in header.
 *
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
?>
<div class="wrapper">
<div id="posts-header" class="clear-both">
    <main id="main" class="site-main clear-both">

    <?php
    if (have_posts()):
        $i = 0;
    /* Start the Loop */
        while (have_posts()): the_post();

            $url_thumb = get_the_post_thumbnail_url($post, 'large');
            if ($url_thumb == false) {
                $url_thumb = get_template_directory_uri() . '/img/default/no_image.jpg';
            }


            if ($i == 0): ?>
            <article id="post-<?php the_ID();?>" <?php post_class('f-post col-8 white-two');?> style="background-image:url('<?php echo esc_url($url_thumb); ?>');">
                <div class="f-post-content col-5 gutters">
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a></h2>
                    </header>
                    <div class="entry-summary">
                      <p><?php echo wpg_get_excerpt(40); ?></p>
                      <a href="<?php the_permalink();?>" class="btn"><? printf(__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wpg_theme' ), get_the_title()); ?> <i class="icon-angle-right"></i></a>
                    </div>
                </div>
            </article>

            <?php else: ?>

        <?php if ($i == 1) {echo '<div id="posts-min" class="arrows-tr col-4 white-one">';}?>
                <article id="post-<?php the_ID();?>" <?php post_class();?> style="background-image:url('<?php echo esc_url($url_thumb); ?>');">
                    <div class="s-post-content gutters">
                        <h2 class="entry-title"><a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a></h2>
                    </div>
                </article>
        <?php if ($i == 2) {echo '</div>';}?>
        <?php endif; $i++; endwhile;?>
        <a class="arrow-allpost-icon text-center" href="<?php echo get_next_posts_page_link(); ?>"><?php _e('Show more news', 'wpg_theme');?><i class="icon-angle-right"></i></a>
        <?php endif; ?>
    </main>
    <div id="header-nav-bottom" class="col-11 gutters">
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
</div>
