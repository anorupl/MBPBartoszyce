<?php
/**
 * Customize control for field Google map
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

/**
 * Custom class for field leafletjs map .
 *
 * @since 0.1.0
 * @access public
 */
class WPG_Customize_Control_leafletjs_MAP extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since 1.0.0
     * @access public
     * @var    string
     */
    public $type = 'leafletjs_map';

    /**
     * Displays the control content.
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function render_content() {


        if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>
		<div class="draggable-map" style="width: 100%; height: 300px; display: block !important; "></div>
        <input id="geo_latlng" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />

    <?php }
}
?>
