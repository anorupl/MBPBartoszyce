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
    <div class="header-top clear-both hide-on-small">
        <div id="h-adress" class="col-8">
            <?php wpg_the_adress('1');?>
        </div>
        <div id="h-social-link" class="col-4">
            <?php social_net_link('<span class="screen-reader-text">%1$s</span>%2$s');?>
        </div>
    </div>
    <header id="site-header">
        <?php if (is_front_page()): ?>
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
        <?php else: ?>
            <div class="title-area">
                <?php if (!has_custom_logo()): ?>
                <span class="site-title class-h1">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name');?></a>
                </span>
                <?php else: ?>
                    <?php the_custom_logo();?>
                <?php endif;?>
            </div>
        <?php endif;?>

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
