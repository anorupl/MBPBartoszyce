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

get_header();

/* ===============================
 * Display Only in front page    *
 * ==============================*/

if (is_home() && !is_paged()) {

    get_template_part('components/site/loop', 'homepage' );

    /* ====================
  	 * Section - featured category   *
  	 * ===================*/
  	if (get_theme_mod('wpg_featuredcat_active', false) === true) {
      get_template_part('components/features/section', 'featured_category' );

    }
    /* ====================
  	 * Section - featured category   *
  	 * ===================*/
  	if (get_theme_mod('wpg_featuredcat_active', false) === true) {
      get_template_part('components/features/section', 'events' );

    }
    /* ====================
  	 * Section - events   *
  	 * ===================*/
  	if (get_theme_mod('wpg_events_active', false) === true) {
      get_template_part('components/features/section', 'events' );
    }
    /* ====================
  	 * Section - clubs    *
  	 * ===================*/
  	if (get_theme_mod('wpg_clubs_active', false) === true) {
      get_template_part('components/features/section', 'clubs' );
    }
    /* ============================
  	 * Section - new colection    *
  	 * ===========================*/
  	if (get_theme_mod('wpg_new_active', false) === true) {
      get_template_part('components/features/section', 'new' );
    }
    /* ====================
     * Section - catl     *
     * ===================*/
    if (get_theme_mod('wpg_catl_active', false) === true) {
      get_template_part('components/features/section', 'catl' );
    }
} else {
?>
  <div id="content" class="site-content clear-both">
    <div class="header-content gutters white-a text-center">
      <div class="class-h2 h--xxl" aria-hidden="true">
            <?php
            if ( is_front_page() && is_home() ) {
              // Default homepage
              echo get_theme_mod('wpg_blog_title', __('Last post', 'wpg_theme'));

              if ( $paged > 1 ) {
                _e(' - page: ', 'wpg_theme');
                echo $paged;
              }
            } elseif (is_category()){
              echo single_cat_title( '', false );
            } else {
              the_archive_title();
            }?>
      </div>
      <div id="breadcrumbs">
        <span><?php _e('You are here: &nbsp;', 'wpg_theme'); ?></span><?php if (function_exists('wpg_breadcrumbs')) wpg_breadcrumbs(); ?>
      </div>
    </div><!-- .header-content -->
    <div class="container">
    <section class="content-area">
  	<div id="primary" class="col-primary hentry-multi gutters">

        <header class="screen-reader">
          <h2>
            <?php
            if ( is_front_page() && is_home() ) {
              // Default homepage
              echo get_theme_mod('wpg_blog_title', __('Last post', 'wpg_theme'));

              if ( $paged > 1 ) {
                _e(' - page: ', 'wpg_theme');
                echo $paged;
              }
            } elseif (is_category()){
              echo single_cat_title( '', false );
            } else {
              the_archive_title();
            }?>
          </h2>
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
<?php
}
get_footer();
?>
