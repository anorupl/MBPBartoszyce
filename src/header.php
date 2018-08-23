<?php
/**
 * The header for our theme
 * and
 * This is the template that displays all of the <head> <header>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes();?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
    <?php wp_head();?>
</head>

<body <?php body_class();?> >
  <div id="top-bar" class="header-top clear-both hide-on-small">
      <div id="top-bar__address" class="inline-left">
          <?php wpg_the_adress();?>
      </div>
      <div class="inline-right">
        <div class="form-wcga inline-left">
          <form id="kontrast" action="http://gmina-bartoszyce.pl/" method="post">
            <input role="button" id="contrast-button" type="submit" value="Włącz kontrast">
          </form>
          <form id="fontsize-form" action="http://gmina-bartoszyce.pl/" method="POST">
                <input class="normal-font fontsize-button" role="button" title="Standartowy rozmiar czcionki" name="normal" id="fontsize-normal" type="submit" value="A">
                <input class="medium-font fontsize-button" role="button" title="Powiększ czcionkę 150%" name="medium" id="fontsize-medium" type="submit" value="A">
                <input class="big-font fontsize-button" role="button" title="Powiększ czcionkę 200%" name="big" id="fontsize-big" type="submit" value="A">
          </form>
        </div>
        <div id="top-bar__social" class="l-icon inline-left">
            <?php wpg_social_net_link('<span class="screen-reader-text">%1$s</span>%2$s');?>
        </div>
        <div id="top-bar__btn-search" class="l-icon inline-left">
          <a href="#top-bar__search" class="icon-search" aria-expanded="false" aria-controls="top-bar__search">
            <span class="screen-reader-text"><?php _e( 'Search', 'twentyfourteen' ); ?></span>
          </a>
        </div>
      </div>
      <div id="top-bar__search" class="pad-all hide">
          <?php get_search_form(); ?>
      </div>
  </div>
    <header id="site-header">
            <div class="title-area">
                <h1 class="site-title">
                    <span class="screen-reader-text"><?php bloginfo('name');?></span>
                    <?php if (!has_custom_logo()): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a>
                    <?php else: ?>
                        <?php the_custom_logo();?>
                    <?php endif;?>
                </h1>
            </div>
        <?php if (has_nav_menu('header')): ?>
            <button class="icon-button-small-menu hide-desktop right-button">
                <?php _e('Menu', 'wpg_theme');?>
            </button>
            <?
            wp_nav_menu(array(
                'container'      => false,
                'theme_location' => 'header',
                'menu_id'        => 'header-menu',
                'items_wrap'     => '<nav id="%1$s" class="h-nav h-nav--color h-nav--arrow hide-on-small wp-nav" data-class="h-nav h-nav--color h-nav--arrow hide-on-small wp-nav"><ul class="%2$s">%3$s</ul></nav>',
            ));
            ?>
        <?php else :
            // only if administrator
            if (current_user_can( 'administrator' )) : 	?>
                <!-- Menu poziome -->
                <button class="icon-button-small-menu hide-desktop right-button" aria-expanded="false" aria-controls="header-menu"><?php _e('Menu', 'wpg_theme'); ?></button>
                <nav id="header-menu" class="horizontal hide-on-small rtl wp-nav" data-class="horizontal hide-on-small rtl wp-nav" role="navigation">
                    <ul class="menu">

                        <li class="menu-item"><a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e('Add menu', 'wpg_theme'); ?></a></li>
                    </ul>
                </nav>
             <?php
             endif;
        endif;
        ?>
    </header>
