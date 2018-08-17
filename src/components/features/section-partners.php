<?php
/**
 * Template part for displaying section partners.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section id="partners" class="page-section clear-both">
   <header class="header-section">
     <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_partners_title',__('Partners', 'wpg_theme'))); ?></h2>
   </header>
   <?php

   // The Query
   $partner_query = new WP_Query(array (
               'post_type'		=> array( 'partner' ),
               'post_status'	=> array( 'Publish' ),
               'posts_per_page'=>-1,
             ));


   if ( $partner_query->have_posts() ) : ?>
   <div id="partner-slider" class="partner-slider">
     <?php
     // The Loop
     while($partner_query ->have_posts()) : $partner_query ->the_post(); ?>
     <div>
       <a href="<?php echo (get_post_meta( get_the_ID(), 'wpg_url_partner', true ) ? esc_url(get_post_meta( get_the_ID(), 'wpg_url_partner', true )) : '#'); ?>" target="_blank">
         <figure>
         <?php
           if ( has_post_thumbnail() ) :
             the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
           endif;
         ?>
         </figure>
       </a>
     </div>
   <?php endwhile; ?>
   </div>
   <?php endif;
   // Restore original Post Data
   wp_reset_postdata();
   ?>
 </section>
