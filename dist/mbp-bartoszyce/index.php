<?php

/**
* The main template file
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package MBP Bartoszyce
* @since 0.1.0
*
*/

get_header(); ?>
<div class="container">
<section id="content" class="page-section">
    <main id="main" class="site-main ">
        <header class="section-title">
            <?php
            if (is_category()) {
                echo '<h1>' . single_cat_title('', false) . '</h1>';
            } else {
                the_archive_title('<h1>', '</h1>');
            } 
            ?>
        </header>
        <div id="crumbs"></div>
        <div class="row">
            <div id="primary" class="content-area hentry-multi">
                <?php
                    if (have_posts()) :

                        /* Start the Loop */
                        while (have_posts()) : the_post();

                        get_template_part('components/content_multi/content', get_post_format());

                    endwhile;

                    // Previous/next page navigation.
                    the_posts_pagination(array(
                        'prev_text' => __('Previous page', 'wpg_theme'),
                        'next_text' => __('Next page', 'wpg_theme'),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'wpg_theme') . ' </span>',
                    ));

                    else :
                        get_template_part('components/content_multi/content', 'none');
                    endif;
                ?>                
            </div>
            <div id="secondary" class="widget-area"></div>
        </div>
    </main>
</section><!-- end section -->
</div>
<?php get_footer(); ?>
