<?php
/**
* The template for displaying 404 page.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
get_header();
?>
<div id="content" class="site-content">
    <div id="primary" class="content-area hentry-single">
        <main id="main" class="site-main">
            <div class="error-404 not-found">
                <header class="entry-header text-center">
                    <h1><?php _e('Oops! That page can&rsquo;t be found.', 'wpg_theme'); ?></h1>
                </header>
                <div class="entry-content class-h2 text-center">
                    <?php _e('It looks like nothing was found at this location.', 'wpg_theme'); ?>

                    <?php get_search_form(); ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer(); ?>
