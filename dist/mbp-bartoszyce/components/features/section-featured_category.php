<?php
/**
 * Template part for displaying featured category.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section id="featured-cat" class="page-section col-12">
   <div class="container">
    <header class="header-section pad-all">
      <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_featuredcat_title',__('In the library', 'wpg_theme'))); ?></h2>
    </header>
  </div>
<div class="container">
  <div class="wrap-continer clear-both pad-all featured-item">

 <?php

 $featuredcat_id = get_theme_mod('wpg_featuredcat', 0);

 if ($featuredcat_id !== 0) :

   $sticky = get_option( 'sticky_posts' );

   $query_featuredcat = new WP_Query([
     'post_type'           =>'post',
     'posts_per_page'      => 3,
     'ignore_sticky_posts' => 1,
     'tax_query'           => [['taxonomy' => 'category','field' => 'id','terms' => $featuredcat_id]],
     'post__in'            => $sticky
   ]);

   if ( $query_featuredcat->have_posts()) : while ($query_featuredcat->have_posts()) : $query_featuredcat->the_post();

   $url_thumb = get_the_post_thumbnail_url($post, 'medium');
   if ($url_thumb == false) {
       $url_thumb = get_template_directory_uri() . '/img/default/no_image.jpg';
   }

  ?>

   <div class="col-4">
     <div <?php post_class(); ?> style="background-image:url('<?php echo esc_url($url_thumb); ?>');">
     <div class="featured-item__gradient"></div>
     <a href="<?php the_permalink(); ?>">
       <div class="entry-header">
         <h3 class="entry-title"><?php wpg_title_shorten(); ?></h3>
       </div>
     </a>
     </div>
   </div>
 <?php endwhile; endif; wp_reset_query(); endif;?>
</div>
 </div>
</section>
