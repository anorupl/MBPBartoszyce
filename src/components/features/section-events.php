<?php
/**
 * Template part for displaying events section.
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 */
 ?>
 <section id="wpg-evets" class="page-section pad-all col-7">
   <div class="ev-wrapper">
     <header class="header-section col-6">
       <div class="h-wrapper">
         <h2 class="h--xxl"><?php _e('Upcoming events', 'wpg_theme'); ?></h2>
       </div>
     </header>
     <div class="green_bg pad-all clear-both">
       <div id="upcoming_event" class="col-6">
         <?php
         if (class_exists('EM_Events')) {
           echo EM_Events::output( array(
             'limit'=>1,
             'format_header' => '',
             'format' => '<div class="ev-top-title white-one"><h3 class="two-line">#_EVENTLINK</h3></div><div class="ev_block"><div class="ev_block__icon white-one xl-icon"><i class="icon-calendar"></i></div><div class="ev_block__content"><div class="ev-title class-h4">Kiedy:</div><div class="ev-content white-one"><span>#_EVENTDATES</span> | <span>#_EVENTTIMES</span></div></div></div><!-- ev_block--><div class="ev_block"><div class="ev_block__icon  white-one xl-icon"><i class="icon-map-marker"></i></div><div class="ev_block__content"><div class="ev-title class-h4">Gdzie:</div><div class="ev-content white-one">{has_location}#_LOCATIONNAME<br/> #_LOCATIONTOWN, #_LOCATIONADDRESS{/has_location}</div></div></div><!-- ev_block-->',
             'format_footer' => ''
           ) );
         }
         ?>
       </div><!-- #upcoming_event -->
       <div id="calendar_events" class="col-6">
         <?php
         if (class_exists('EM_Calendar')) {
           echo EM_Calendar::output();
         }
         ?>
       </div>
     </div>
   </section>
