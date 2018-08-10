<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

get_header(); ?>
<div id="content" class="site-content">
    <div id="primary" class="content-area hentry-single">
        <main id="main" class="site-main ">
            <?php
            while (have_posts()) : the_post();

            switch (get_post_type(get_the_ID())) {
                case '':



                break;
                default:

                get_template_part('components/content_single/content', get_post_format());

                // Previous/next post navigation.
                the_post_navigation(array(
                    'next_text' => '<span class="meta-nav">' . __('Next', 'wpg_theme') . '</span> ' .
                    '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav">' . __('Previous', 'wpg_theme') . '</span> ' .
                    '<span class="post-title">%title</span>',
                ));
                break;
            }//switch

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>

        <?php endwhile; // End of the loop.	 ?>
    </main><!-- #main -->
</div><!-- primary -->
</div><!-- #content -->
<?php get_footer(); ?>
