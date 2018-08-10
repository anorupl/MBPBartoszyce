<?php
/**
 * Customize control for opening hours
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 */

/**
 * Custom class for field opening hours .
 *
 * @since 1.0.0
 * @access public
 */
class WPG_Custom_OpeningHours extends WP_Customize_Control {

   /**
    * The type of customize control being rendered.
    *
 * @since 1.0.0
    * @access public
    * @var    string
    */
    public $type = 'wpg_opening_hours';



    /**
     * Displays the control content.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

        if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

  
        <div class="openhours hours-list">
            <table>
                <tr>
                    <td scope="col"><?php _e('Day') ?></td>
                    <td scope="col"><?php _e('Opening Hours', 'wpg_theme') ?></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Monday'); ?></td>
                    <td><input id="mo" data-obj="mo" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Tuesday'); ?></td>
                    <td><input id="tu" data-obj="tu" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Wednesday'); ?></td>
                    <td><input id="we" data-obj="we" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Thursday'); ?></td>
                    <td><input id="th" data-obj="th" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Friday'); ?></td>
                    <td><input id="fr" data-obj="fr" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Saturday'); ?></td>
                    <td><input id="sa" data-obj="sa" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>
                <tr>
                    <td scope="row"><?php _e('Sunday'); ?></td>
                    <td><input id="su" data-obj="su" type="text" class="wpg-time" placeholder="Time" value=""></td>
                </tr>        
            </table>
        </div>
        <input id="open_inputs" type="hidden" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" />
        <?php
    }
        
}