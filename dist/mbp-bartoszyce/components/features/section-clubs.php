<?php
/**
 * Template part for displaying section clubs.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section class="clubs white-one page-section">
     <div class="container">
         <header class="header-section text-center">
             <div class="h-wrapper">
                 <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_clubs_title',__('Clubs in the library', 'wpg_theme'))); ?></h2>
             </div>
             <p><?php echo esc_html(get_theme_mod('wpg_clubs_desc','')); ?></p>
         </header>
         <div class="wrap-continer clear-both pad-all">


         <?php
         $number_clubs = get_theme_mod( 'wpg_club_number','' );

         if (!empty($number_clubs)) {

         for ( $i = 1; $i <= $number_clubs; $i++ ) {

         $id_terms = get_theme_mod("wpg_club_terms_$i",'');

         if (empty($id_terms))
         return false;

         $term = get_term_by('term_taxonomy_id', $id_terms, 'categorycollection');


         ?>
         <div class="club-item col-4 pad-all">
         <?php echo the_term_thumbnail($term->term_id); ?>
         <h3 class="two-line"><a href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>" ><?php echo get_theme_mod("wpg_club_title_$i",''); ?></a></h3>
         <p><?php echo get_theme_mod("wpg_club_desc_$i",''); ?></p>
         </div>
         <?php }
         }
         ?>
         </div>
     </div>
 </section>
