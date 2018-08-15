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



<section id="catl" class="catl white-a page-section clear-both">
  <div class="container clear-both">
  <div class="catl-svg hide-on-small">
    <?php echo wp_get_attachment_image( absint( get_theme_mod('wpg_catl_image')), 'full'); ?>
  </div>
    <div class="catl-content">
      <header class="header-section">
          <span class="header-span">
              <h2><?php echo esc_html(get_theme_mod('wpg_catl_title','Digital archive of local tradition')); ?></h2>
              <span class="border"></span>
          </span>
          <p><?php echo esc_html(get_theme_mod('wpg_clubs_desc','')); ?></p>
      </header>
      <div class="tab-home">
        <div class="js-tabs">
          <ul class="js-tablist">
            <?php for ($i=1; $i <= 3; $i++) : ?>
            <li class="class-h4 js-tablist__item">
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
      <div class="catl-links">
        <a id="catl-btn" class="btn btn--catl" href="<?php echo esc_url(get_theme_mod("wpg_catl_btn_url",'#')); ?>">
            <?php echo esc_html(get_theme_mod("wpg_catl_btn_title",__('Go to the website', 'wpg_theme'))); ?>
        </a>
      </div>
    </div>
  </div>
</section>



<section id="contact" class="page-section clear-both">
  <header class="header-section text-center">
    <div><h2><?php echo esc_html(get_theme_mod('wpg_contact_title',__('let\'s stay in contact', 'wpg_theme'))); ?></h2></div>
  </header>

  <?php
    $days = [
      'mo' => __('Monday'),
      'tu' => __('Tuesday'),
      'we' => __('Wednesday'),
      'th' => __('Thursday'),
      'fr' => __('Friday'),
      'sa' => __('Saturday'),
      'su' => __('Sunday')];
  ?>
  <div id="contact__content" class="text-color-two clear-both">
    <div id="contact__tabs" class="pad-all">
      <div class="js-tabs">
        <!-- Tabs Contact -->
        <ul class="js-tablist">
          <?php for ($i=1; $i <= 4; $i++) : ?>
            <li class="js-tablist__item">
              <h3><a href="#id_contact_tab_<?php echo $i; ?>" id="label_id_contact_tab_<?php echo $i; ?>" class="js-tablist__link"><?php echo esc_html(get_theme_mod("wpg_contact_place_$i",__('Tab ', 'wpg_theme'))); ?></a></h3>
            </li>
          <?php endfor; ?>
        </ul>
        <!-- Tab content container -->
        <div class="js-tabs__contents">
          <?php for ($i=1; $i <= 4; $i++) : ?>
            <!-- Tab content -->
            <div id="id_contact_tab_<?php echo $i; ?>" class="js-tabcontent">
              <!-- Left contact blok -->
              <div id="contact-info" class="col-6">
                <!-- Address -->
                <div class="contact-item address">
                  <div class="contact-item__icon">
                    <i class="icon-map-marker"></i><h4><?php _e('Address', 'wpg_theme');?></h4>
                  </div>
                  <div class="contact-item__text">
                    <?php echo esc_html(get_theme_mod("wpg_contact_adres_$i",'')); ?>
                  </div>
                </div>
                <!-- Email -->
                <div class="contact-item email">
                  <div class="contact-item__icon">
                    <i class="icon-envelope"></i><h4><?php _e('E-mail', 'wpg_theme');?></h4>
                  </div>
                  <div class="contact-item__text">
                    <?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod("wpg_contact_email_$i"))); ?>
                  </div>
                </div>
                <!-- Phone -->
                <div class="contact-item phone">
                  <div class="contact-item__icon">
                    <i class="icon-phone_android"></i><h4><?php _e('Telephone number', 'wpg_theme');?></h4>
                  </div>
                  <div class="contact-item__text">
                    <?php printf('<a href="tel:%1s">%1$s</a>', antispambot(get_theme_mod("wpg_contact_phone_$i"))); ?>
                  </div>
                </div>
              </div>
              <!-- Right contact blok -->
              <div id="open-hours" class="col-6">
                <div class="contact-item__icon">
                  <i class="icon-clock"></i><h4><?php _e('Opening Hours', 'wpg_theme');?></h4>
                </div>
                <div class="contact-item__text">
                  <table>
                    <tbody>
                  <?php
                  $open_hours = get_theme_mod("wpg_contact_open_$i", '');

                  if ($open_hours !== '') :

                    $open_hours = json_decode(base64_decode($open_hours));

                    foreach ($open_hours as $key => $value) :
                      ?>
                      <tr>
                        <td class="day"><?php echo $days[$key]; ?></td>
                        <td class="hours"><?php echo $value; ?></td>
                      </tr>

                    <?php endforeach; ?>
                  <?php endif; ?>
                  </tbody>
                  </table>
                </div><!-- .contact-item__text -->
              </div><!-- #open-hours -->
            </div><!-- #id_contact_tab_* -->
          <?php endfor; ?>
        </div><!-- .js-tabs__contents -->
      </div><!-- .js-tabs -->
    </div><!-- #contact__tabs -->
    <div id="contact__map">
      <div id="map-canvas"></div>
    </div>
  </div>
</section>

<section id="partners" class="page-section clear-both">
  <header class="header-section text-center">
    <div><h2><?php echo esc_html(get_theme_mod('wpg_partners_title',__('Partners', 'wpg_theme'))); ?></h2></div>
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




<?php get_footer(); ?>
