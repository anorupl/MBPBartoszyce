<?php
/**
* The template for displaying attachment.
*
* @package MBP Bartoszyce
* @since 0.1.0
*/

get_header();
?>
<div id="content" class="site-content">
    <div id="primary" class="content-area hentry-single">
        <main id="main" class="site-main ">
            <?php while (have_posts()) : the_post(); ?>

                <?php $attachment_data = wp_prepare_attachment_for_js($post->ID); ?>

                <div <?php post_class(); ?>>
                    <div class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <hr>
                    </div><!-- .entry-header -->
                    <div class="attachment-content text-center">
                        <div class="attachment-file text-center">
                            <?php
                            //icon button
                            echo wp_get_attachment_link($post->ID, 'thumbnail', false, true, false);
                            ?>
                        </div>
                        <div>
                            <span class="class-h3"><a class="btn btn__dark" href="<?php echo $attachment_data['url']; ?>"><?php _e('Click to download', 'wpg_theme') ?></a></span>
                        </div>
                        <div class="attachment-size">
                            <?php
                            _e('File size: ', 'wpg_theme');
                            echo $attachment_data['filesizeHumanReadable'];
                            ?>
                        </div>
                    </div>
                </div>

            <?php endwhile; // End of the loop.	  ?>
        </main><!-- #main -->
    </div><!-- primary -->
</div><!-- #content -->
<?php get_footer(); ?>
