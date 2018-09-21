<?php
add_action( 'wp_enqueue_scripts', 'style' );
function style() {
	if(isset($_POST['wcga'])) {
		// fontsize
		switch ($_POST['wcga']) {
			case 'base':
				setcookie('font-size', '', time() + 3600, '/');
				wp_dequeue_style( 'font-size' );
				break;
			case 'medium':
				wp_enqueue_style( 'font-size' , get_template_directory_uri() . '/css/medium.css' );
				setcookie('font-size', 'medium', time() + 3600, '/');
				break;
			case 'big':
				wp_enqueue_style( 'font-size' , get_template_directory_uri() . '/css/big.css' );
				setcookie('font-size', 'big', time() + 3600, '/');
				break;

			default:
				cookie_font_size($_COOKIE['font-size']);
				break;
		}
		// color style
		switch ($_POST['wcga']) {

			case 'contrast':
				wp_enqueue_style( 'contrast-style' , get_template_directory_uri() . '/css/contrast.css' );
				setcookie('color', 'contrast', time() + 3600, '/');
				break;
			case 'normal':
				setcookie('color', '', time() - 3600, '/');
				wp_dequeue_style( 'color' );
				break;
			default:
				if (isset( $_COOKIE['color']) && $_COOKIE['color'] == 'contrast') {
					wp_enqueue_style( 'contrast-style' , get_template_directory_uri() . '/css/contrast.css' );
				}
				break;
		}

	} else {

		if (isset( $_COOKIE['color']) && $_COOKIE['color'] == 'contrast') {
			wp_enqueue_style( 'contrast-style' , get_template_directory_uri() . '/css/contrast.css' );
		}
		if (isset( $_COOKIE['font-size'])) {
			wp_enqueue_style( 'font-size' , get_template_directory_uri() . '/css/'. $_COOKIE['font-size']. '.css' );
		}
	}
}


function cookie_font_size($cookie_name){
	if (isset($cookie_name)) {
		switch ($cookie_name) {
			case 'medium':
				wp_enqueue_style( 'font-size' , get_template_directory_uri() . '/css/medium.css' );
				break;
			case 'big':
				wp_enqueue_style( 'font-size' , get_template_directory_uri() . '/css/big.css' );
				break;
			default:
				wp_dequeue_style( 'font-size' );
				break;
		}
	}
}


function form_wcga(){

	$button = __('Włącz kontrast', 'wpg_theme');
	$style  = 'contrast';

	if(isset($_POST['wcga'])) {
		switch ($_POST['wcga']) {
			case 'contrast':
					$button = __('Wyłącz kontrast', 'wpg_theme');
					$style  = 'normal';
					break;
			case 'normal':
					$button = __('Włącz kontrast', 'wpg_theme');
					$style  = 'contrast';
					break;
			default:
				if (isset( $_COOKIE['color']) && $_COOKIE['color'] == 'contrast') {
					$button = __('Wyłącz kontrast', 'wpg_theme');
					$style  = 'normal';
				}
				break;
		}
	} else {
		if (isset( $_COOKIE['color']) && $_COOKIE['color'] == 'contrast') {
			$button = __('Wyłącz kontrast', 'wpg_theme');
			$style  = 'normal';
		}
	}

	?>
	<form action="<?php echo home_url(); ?>/" method='post'>
		<?php printf('<button type="submit" value="%1$s" name="wcga" class="normal-font">%2$s</button>',$style,$button); ?>
		<button type="submit" value="base" name="wcga" class="normal-font"><span aria-hidden="true">A</span><span class="screen-reader-text"><?php _e('Standard font size','wpg_theme'); ?></span></button>
		<button type="submit" value="medium" name="wcga" class="medium-font"><span aria-hidden="true">A</span><span class="screen-reader-text"><?php _e('Increase font size 150%','wpg_theme'); ?></span></button>
		<button type="submit" value="big" name="wcga" class="big-font"><span aria-hidden="true">A</span><span class="screen-reader-text"><?php _e('Increase font size 200%','wpg_theme'); ?></span></button>
	</form>
	<?php
}






?>
