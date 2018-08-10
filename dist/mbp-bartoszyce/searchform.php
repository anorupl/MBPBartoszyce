<?php
/**
* Template for displaying search forms
*
* @package MBP Bartoszyce
* @since 0.1.0
*/
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>" class="screen-reader-text"><?php _e('Search','wpg_theme'); ?></label>
	<input type="text" id="<?php echo $unique_id; ?>" class="field" name="s" placeholder="<?php _e('Search','wpg_theme'); ?>">
	<button type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e('Search','wpg_theme'); ?>"><i class="icon-search"></i></button>
</form>
