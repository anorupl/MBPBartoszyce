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
  <div class="continer">
    <div class="tab-home">
    <div class="js-tabs">

<?php


$id_terms   = get_theme_mod('wpg_new_tabs','');
$terms_tax	= 'categorycollection';
//chceck taxonomy
if(taxonomy_exists($terms_tax)) {


  $terms = get_terms( array(
      'taxonomy' => $terms_tax,
      'order' => 'ASC',
      'include' => $id_terms,
      'hide_empty' => false,
  ) );
 ?>
 <ul class="js-tablist col-4">
    <?php foreach ( $terms as $term ) { ?>
      <li class="class-h3 js-tablist__item">
        <a href="#id_<?php echo $term->slug;?>" id="label_id_<?php echo $term->slug;?>" class="js-tablist__link">
          <i class="icon-<?php echo $term->slug;?>"></i>
          <span class="hide-on-small"><?php echo $term->name;?></span>
        </a>
      </li>
    <?php } ?>
 </ul>
 <div class="tabs-home__contents col-8">

  <?php
  foreach ( $terms as $term ) { ?>

    <div id="id_<?php echo $term->slug;?>" class="js-tabcontent">
    <?php

    $args_colletion = [
        'post_type' =>'post_collection',
        'posts_per_page'=> 1,
        'tax_query' => [[
          'taxonomy' => $terms_tax,
          'field'    => 'slug',
          'terms'    => $term->slug
        ],
      ]
    ];
    $query_colletion = new WP_Query($args_colletion);

    if ( $query_colletion->have_posts()) : while ($query_colletion->have_posts()) : $query_colletion->the_post(); ?>
                <div>
                  <a tabindex="-1" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php if (has_post_thumbnail()) {
                    the_post_thumbnail( ('thumbnail') ); }	else {
                      echo '<img alt="Domyślna fotografia Bartoszyc" src="'. $urlimg .'/img/photo-category-page.jpg" width="177" height="118"/>';
                    } ?>
                  </a>
                  <div class="title-niebieskie-tlo" title="<?php the_title(); ?>">
                    <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                  </div>
                </div>
              <?php endwhile; endif; wp_reset_query(); ?>
    </div>
<?php
              }
}
?>
</div>
</div>
</div>





</div>
</section>








<?php get_footer(); ?>
