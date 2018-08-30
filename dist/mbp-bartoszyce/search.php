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
<div id="content" class="site-content clear-both">
  <div class="header-content pad-all white-two text-center">
    <div class="class-h2 h--xxl" aria-hidden="true">
      <?php printf( __( 'Search Results for: %s', 'wpg_theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
    </div>
  </div><!-- .header-content -->
  <div class="container">
  <section class="content-area">
    <div id="primary" class="col-primary hentry-multi gutters">
      <header class="screen-reader">
        <h2><?php printf( __( 'Search Results for: %s', 'wpg_theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
      </header>
      <main id="main" class="site-main ">
        <?php
        if ( have_posts() ) :
          /* Start the Loop */
          while ( have_posts() ) : the_post();
            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part( 'components/content_multi/content', get_post_format() );
          endwhile;

            // Previous/next page navigation.
            the_posts_pagination( array(
              'prev_text'          => __( 'Previous page', 'wpg_theme' ),
              'next_text'          => __( 'Next page', 'wpg_theme' ),
              'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
            ));

        else :
          get_template_part( 'components/content_multi/content', 'none' );
        endif; ?>
      </main><!-- .site-main -->
    </div><!-- #primary -->
  </section>
  <?php get_sidebar(); ?>
  </div><!-- .container -->
</div><!-- #content -->
<?php get_footer(); ?>
