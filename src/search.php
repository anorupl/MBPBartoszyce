<?php
/**
* The template for displaying search results pages
*
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

get_header(); ?>
<section id="content" class="site-content">
    <div id="primary" class="content-area hentry-multi">
        <main id="main" class="site-main ">
            <header class="section-title">
                <h1><?php printf( __( 'Search Results for: %s', 'wpg_theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <hr>
                    <p><?php the_archive_description(); ?></p>
                </header>
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
            </main>
        </div>
    </section><!-- end section -->
    <?php get_footer(); ?>
