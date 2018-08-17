<?php
/**
 * Template part for displaying contact section.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section id="contact" class="page-section clear-both">
   <header class="header-section text-center">
     <div class="h-wrapper">
       <h2 class="h--xxl"><?php echo esc_html(get_theme_mod('wpg_contact_title',__('let\'s stay in contact', 'wpg_theme'))); ?></h2>
     </div>
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
       <div class="js-tabs text-color-two">
         <!-- Tabs Contact -->
         <ul class="js-tablist">
           <?php for ($i=1; $i <= 4; $i++) : ?>
             <li class="js-tablist__item">
               <a href="#id_contact_tab_<?php echo $i; ?>" id="label_id_contact_tab_<?php echo $i; ?>" class="js-tablist__link class-h3"><?php echo esc_html(get_theme_mod("wpg_contact_place_$i",__('Tab ', 'wpg_theme'))); ?></a>
             </li>
           <?php endfor; ?>
         </ul>
         <!-- Tab content container -->
         <div class="js-tabs__contents clear-both">
           <?php for ($i=1; $i <= 4; $i++) : ?>
             <!-- Tab content -->
             <div id="id_contact_tab_<?php echo $i; ?>" class="js-tabcontent">
               <!-- Left contact blok -->
               <div id="contact-info" class="col-6">
                 <!-- Address -->
                 <div class="contact-item address">
                   <div class="contact-item__icon">
                     <i class="icon-map-marker"></i><span class="class-h4"><?php _e('Address', 'wpg_theme');?></span>
                   </div>
                   <div class="contact-item__text">
                     <?php echo esc_html(get_theme_mod("wpg_contact_adres_$i",'')); ?>
                   </div>
                 </div>
                 <!-- Email -->
                 <div class="contact-item email">
                   <div class="contact-item__icon">
                     <i class="icon-envelope"></i><span class="class-h4"><?php _e('E-mail', 'wpg_theme');?></span>
                   </div>
                   <div class="contact-item__text">
                     <?php printf('<a href="mailto:%1s">%1$s</a>', antispambot(get_theme_mod("wpg_contact_email_$i"))); ?>
                   </div>
                 </div>
                 <!-- Phone -->
                 <div class="contact-item phone">
                   <div class="contact-item__icon">
                     <i class="icon-phone_android"></i><span class="class-h4"><?php _e('Telephone number', 'wpg_theme');?></span>
                   </div>
                   <div class="contact-item__text">
                     <?php printf('<a href="tel:%1s">%1$s</a>', antispambot(get_theme_mod("wpg_contact_phone_$i"))); ?>
                   </div>
                 </div>
               </div>
               <!-- Right contact blok -->
               <div id="open-hours" class="col-6">
                 <div class="contact-item__icon">
                   <i class="icon-clock"></i><span class="class-h4"><?php _e('Opening Hours', 'wpg_theme');?></span>
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
     <div id="contact-social" class="xl-icon dark-element-color text-center clear-both">
       <?php social_net_link('<span class="screen-reader-text">%1$s</span>%2$s');?>
     </div>
     </div><!-- #contact__tabs -->
     <div id="contact__map">
       <div id="map-canvas"></div>
     </div>
   </div>
 </section>
