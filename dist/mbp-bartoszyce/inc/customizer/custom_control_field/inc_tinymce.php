<?php
/**
 * TinyMCE Custom Control
 *
 * @package MBP Bartoszyce
 * @since 0.1.0
 *
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @link https://github.com/maddisondesigns
 */
class WPG_TinyMCE_Custom_control extends WP_Customize_Control {
  /**
   * The type of control being rendered
   */
  public $type = 'tinymce_editor';
  /**
   * Enqueue our scripts and styles
   */
  public function enqueue(){
    wp_enqueue_editor();
  }
  /**
   * Pass our TinyMCE toolbar string to JavaScript
   */
  public function to_json() {
    parent::to_json();
    $this->json['wpgtinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
    $this->json['wpgtinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
  }
  /**
   * Render the control in the customizer
   */
  public function render_content(){
  ?>
    <div class="tinymce-control">
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <?php if( !empty( $this->description ) ) { ?>
        <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
      <?php } ?>
      <textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
    </div>
  <?php
  }
}
?>
