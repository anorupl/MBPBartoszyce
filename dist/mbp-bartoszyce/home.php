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
        <header class="header-center entry-header-section text-center">
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





<?php get_footer(); ?>