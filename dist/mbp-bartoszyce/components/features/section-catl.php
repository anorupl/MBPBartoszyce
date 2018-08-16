<?php
/**
 * Template part for displaying section clubs.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
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
