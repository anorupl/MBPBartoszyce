<?php
/**
 * Fonts Control class
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */
 
 /**
  * Fonts customize control class
  *
 * @since 0.1.0
  * @access public 
  */
class Fonts_Dropdown_Google extends WP_Customize_Control
{
   /**
     * The custom parameter to connect font family with style.
     *
     * @since 0.1.0
     * @access public
     * @var    string
     */
	public $font_field;

    /**
     * Displays the control content.
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
     public function render_content()    {

		// Font list
		$google_font_list = set_font_list(false,true);
		
		// Get setting google font family to select variants
		$font_family = get_theme_mod( $this->font_field, 'Open Sans');
	
		switch( $this->type ) {
				case 'google_font': ?>
	              <hr>
	                <label>
	                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<?php if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span>
						<?php endif; ?>
	                    <select <?php $this->link(); ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" class="google-font-select">
				        <?php
				        
							foreach ($google_font_list as $key => $item) {
	
								printf('<option value="%s" %s>%s</option>', $key, selected( $this->value(), $key, false ), $key);
							}
						?>
	            		</select>
	                </label>
	            	<?php
					break;
				
					
				case 'google_variants':
					?>
					<hr>
	                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<?php if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span>
						<?php endif; ?>
	                    <select <?php $this->link(); ?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" class="google-weight" >
	                 	<?php
	
						foreach ( $google_font_list[$font_family]['variants'] as $key => $item) {
	
							printf('<option value="%s" %s>%s</option>', $item, selected( $this->value(), $item, false ), $item);
						}
						?>
	            		</select>
	                </label>
					<?php
					break;
		}
    }
}
?>