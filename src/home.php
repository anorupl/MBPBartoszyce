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

if (!is_paged()) {
    get_template_part('components/site/loop', 'homepage' );
}

?>

<section class="clubs white-a page-section clear-both">
    <div class="container">
        <header class="header-section">
            <span class="header-span">
                <h2><?php echo esc_html(get_theme_mod('wpg_clubs_title',__('Clubs in the library', 'wpg_theme'))); ?></h2>
                <span class="border"></span>
            </span>
            <p><?php echo esc_html(get_theme_mod('wpg_clubs_desc','')); ?></p>
        </header>
    </div>
    <div class="clubs-bottom">
        <div class="container">
            <div class="wrap-continer clear-both">


<?php
$number_clubs = get_theme_mod( 'wpg_club_number','' );

if (!empty($number_clubs)) {

    for ( $i = 1; $i <= $number_clubs; $i++ ) {

        $id_terms = get_theme_mod("wpg_club_terms_$i",'');

        if (empty($id_terms))
        return false;

        $term = get_term_by('term_taxonomy_id', $id_terms, 'categorycollection');


    ?>
        <div class="club-item col-4 gutters">
            <?php echo the_term_thumbnail($term->term_id); ?>
            <h3><a href="<?php echo esc_url( get_term_link( $term->term_id ) ); ?>" ><?php echo get_theme_mod("wpg_club_title_$i",''); ?></a></h3>
            <p><?php echo get_theme_mod("wpg_club_desc_$i",''); ?></p>
        </div>
<?php }
}
?>
            </div>
        </div>
    </div>
</section>
<section class="newitems page-section clear-both">
  <div class="container">
      <header class="header-section">
          <span class="header-span">
              <h2>Nowości w Bibliotece</h2>
              <span class="border"></span>
          </span>
          <p><?php echo esc_html(get_theme_mod('wpg_clubs_desc','')); ?></p>
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
          'taxonomy' => $terms_tax,
          'order' => 'ASC',
          'include' => $id_terms,
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

          <div class="white-a col-9">
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

                <div class="coletion-image col-4">
                  <a tabindex="-1" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php wpg_the_thumbnail(); ?></a>
                </div>
                <div class="coletion-content col-4">
                  <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt() ?>
                </div>
                <div class="coletion-gallery col-4">
                  <div class="coletion-gallery__gallery clear-both">
                    <?php wpg_the_image_attachment('thumbnail', 3);?>
                  </div>
                  <a class="btn show-coletion"href="<?php the_permalink() ?>"><?php _e('Show', 'wpg_theme'); ?></a>
                </div>

                <?php endwhile; endif; wp_reset_query(); ?>

                <div id="coletions-link">
                  <a id="colection_<?php echo $term->slug;?>" class="btn" href="#"><?php _e('Show older', 'wpg_theme'); ?></a>
                </div>
              </div>
            <?php endforeach; // tabs content ?>
          </div>
        <?php endif; //chceck taxonomy?>
      </div><!-- .js-tabs -->
  </div><!-- .continer -->
</section>



<section class="catl white-a page-section clear-both">
<div class="container">
<div class="catl-svg col-5">

</div>
<div class="catl-content col-7">
  <header class="header-section">
      <span class="header-span">
          <h2><?php echo esc_html(get_theme_mod('wpg_catl_title','Digital archive of local tradition')); ?></h2>
          <span class="border"></span>
      </span>
      <p><?php echo esc_html(get_theme_mod('wpg_clubs_desc','')); ?></p>
  </header>
  <div class="tab-home">
    <div class="js-tabs col-12">
      <ul class="js-tablist">
        <?php for ($i=1; $i <= 3; $i++) : ?>
        <li class="class-h3 js-tablist__item">
          <a href="#id_catl_tab_<?php echo $i; ?>" id="label_id_catl_tab_<?php echo $i; ?>" class="js-tablist__link"><?php echo esc_html(get_theme_mod("wpg_catl_tab_$i",__('Tab ', 'wpg_theme'))); ?></a>
        </li>
        <?php endfor; ?>
      </ul>
      <div class="js-tabs__contents">
        <?php for ($i=1; $i <= 3; $i++) : ?>
          <div id="id_catl_tab_<?php echo $i; ?>" class="js-tabcontent">
              <?php echo esc_html(get_theme_mod("wpg_catl_tabcontent_$i",__('Tab content', 'wpg_theme'))); ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
  <a id="ctl_btn" class="btn btn--catl" href="<?php echo esc_url(get_theme_mod("wpg_catl_btn_url",'#')); ?>">
      <?php echo esc_html(get_theme_mod("wpg_catl_btn_title",__('Go to the website', 'wpg_theme'))); ?>
  </a>
</div>
</div>
</section>



<section id="contact" class="newitems page-section clear-both">
  <div class="container">
      <header class="header-section">
          <span class="header-span">
              <h2><?php echo esc_html(get_theme_mod('wpg_contact_title',__('let\'s stay in contact', 'wpg_theme'))); ?></h2>
              <span class="border"></span>
          </span>
      </header>
  </div>
<div id="contact__content" class="col-7">

</div>
<div id="contact__map" class="col-5">
  			<div id="map-canvas"></div>
</div>
</section






<?php get_footer(); ?>
