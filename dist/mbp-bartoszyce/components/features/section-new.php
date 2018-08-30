<?php
/**
 * Template part for displaying loop new colections.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section class="newitems page-section clear-both">
   <div class="container">
       <header class="header-section">
           <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_new_title',__('New in the library', 'wpg_theme'))); ?></h2>
       </header>
   </div>
   <div class="container">
       <div class="js-tabs">
       <?php

       $id_terms   = get_theme_mod('wpg_new_tabs','');
       $terms_tax	= 'categorycollection';

       //chceck taxonomy
       if(taxonomy_exists($terms_tax)) :
         // get terms object
         $terms = get_terms( array(
           'taxonomy'   => $terms_tax,
           'order'      => 'ASC',
           'include'    => $id_terms,
           'hide_empty' => false,
         ) );
         ?>

           <ul class="js-tablist col-3">
             <?php foreach ( $terms as $term ) : ?>
               <li class="class-h3 js-tablist__item">
                 <a href="#id_<?php echo $term->slug;?>" id="label_id_<?php echo $term->slug;?>" class="js-tablist__link">
                   <i class="icon-<?php echo $term->slug;?>"></i>
                   <span class="hide-on-small"><?php echo $term->name;?></span>
                 </a>
               </li>
             <?php endforeach; //tabs?>
           </ul>

           <div class="col-9">
             <?php foreach ( $terms as $term ) : ?>
               <div id="id_<?php echo $term->slug;?>" class="js-tabcontent col-12">
                 <?php

                 $args_colletion = [
                   'post_type' =>'post_collection',
                   'posts_per_page'=> 1,
                   'tax_query' => [['taxonomy' => $terms_tax,'field' => 'slug','terms' => $term->slug]]
                 ];

                 $query_colletion = new WP_Query($args_colletion);

                 if ( $query_colletion->have_posts()) : while ($query_colletion->have_posts()) : $query_colletion->the_post(); ?>

                 <div class="coletion-image white-one col-4">
                   <a tabindex="-1" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php wpg_the_thumbnail(); ?></a>
                 </div>
                 <div class="coletion-content white-one col-4">
                   <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                   <?php the_excerpt() ?>
                 </div>
                 <div class="coletion-gallery white-two col-4">
                   <div class="coletion-gallery__gallery clear-both">
                     <?php wpg_the_image_attachment('thumbnail', 3);?>
                   </div>
                   <a class="btn show-coletion" href="<?php the_permalink() ?>"><?php _e('Show', 'wpg_theme'); ?></a>
                 </div>

                 <?php endwhile; endif; wp_reset_query(); ?>

                 <div class="coletions-link">
                   <a id="colection_<?php echo $term->slug;?>" class="btn" href="<?php echo get_term_link($term, $terms_tax) ?>"><?php _e('Older collections of new products', 'wpg_theme'); ?></a>
                 </div>
               </div>
             <?php endforeach; // tabs content ?>
           </div>
         <?php endif; //chceck taxonomy?>
       </div><!-- .js-tabs -->
   </div><!-- .continer -->
 </section>
