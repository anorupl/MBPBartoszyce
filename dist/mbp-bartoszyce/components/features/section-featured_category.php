<?php
/**
 * Template part for displaying featured category.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section id="featured-cat" class="page-section pad-all col-5">
 <header class="header-section">
   <div class="h-wrapper">
     <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_featuredcat_title',__('In the library', 'wpg_theme'))); ?></h2>
   </div>
 </header>
 <?php

 $featuredcat_id = get_theme_mod('wpg_featuredcat', 0);

 if ($featuredcat_id !== 0) :

   $query_featuredcat = new WP_Query([
     'post_type'     =>'post',
     'posts_per_page'=> 1,
     'tax_query'     => [['taxonomy' => 'category','field' => 'id','terms' => $featuredcat_id]]
   ]);

   if ( $query_featuredcat->have_posts()) : while ($query_featuredcat->have_posts()) : $query_featuredcat->the_post(); ?>

   <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
     <a href="<?php the_permalink(); ?>" aria-hidden="true">
       <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
     </a>
     <div class="entry-header">
       <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php wpg_title_shorten(); ?></a></h3>
     </div>
   </div>
 <?php endwhile; endif; wp_reset_query(); endif;?>
</section>
