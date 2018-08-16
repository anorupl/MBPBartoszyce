<?php

/**
* The home template file
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

if (is_front_page()) {
 if (!is_paged()) {

    get_template_part('components/site/loop', 'homepage' );

    /* ====================
  	 * Section - featured category   *
  	 * ===================*/
  	if (get_theme_mod('wpg_featuredcat_active', false) === true) {
      get_template_part('components/features/section', 'featured_category' );

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
  <section id="content" class="site-content col-12">
    <header class="header-index col-12">
				<h1>
					<?php
					if ( is_front_page() && is_home() ) {
						// home page - paged
						echo esc_html(get_theme_mod('wpg_blog_title',__('Last post', 'wpg_theme')));
						_e(' - page: ', 'wpg_theme');
						echo $paged;
					} else {
						//everything else
						the_archive_title();
					}
					?>
				</h1>
		</header>
  	<div id="primary" class="content-area hentry-multi">
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

    			if (is_archive()):
    				// Previous/next page navigation.
    				the_posts_pagination( array(
    					'prev_text'          => __( 'Previous page', 'wpg_theme' ),
    					'next_text'          => __( 'Next page', 'wpg_theme' ),
    					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpg_theme' ) . ' </span>',
    				));
    			endif;

    		else :
    			get_template_part( 'components/content_multi/content', 'none' );
    		endif; ?>
  		</main><!-- .site-main -->
  	</div><!-- #primary -->
  	<?php get_sidebar(); ?>
  </section><!-- #content -->

  <?php
  }
}

get_footer();

?>
