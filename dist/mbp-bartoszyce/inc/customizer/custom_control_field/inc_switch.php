<?php
/**
 * Customize control for field switch
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

/**
 * Custom class for field Google map .
 *
 * @since 0.1.0
 * @access public
 */
 
class WPG_Customize_Control_Switch extends WP_Customize_Control {
		
	public $type = 'switch';
	public function render_content() {
	?>
		
			<input	id="<?php echo esc_attr($this->id); ?>" type="checkbox" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
			<label for="<?php echo esc_attr($this->id); ?>" class="onoffswitch-label">
				<span class="onoffswitch">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</span>
				<?php echo esc_html( $this->label ); ?>	
			</label>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>	

				
	<?php
	}
} 
 
?>