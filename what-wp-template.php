<?php
/*
 * Plugin Name: What WordPress Template
 * Description: Displays in WP footer which template file is currently used.
 * Author: Andreas Neuber
 * Version: 0.1
 * Text Domain: what-wp-template
 *
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 */


class What_WP_Template{


	function __construct() {
		add_action( 'wp_footer', array( $this, 'wwtemp_display_template_var_in_wp_footer' ) );
		add_action( 'admin_menu', array( $this, 'wwtemp_add_template_var_config_menu' ) );
		add_action( 'admin_init', array( $this, 'wwtemp_register_what_wp_template_settings' ) );
	}


	function wwtemp_display_template_var_in_wp_footer() {
		global $template;
		$text_color = esc_attr( get_option('what-wp-template_text-color-dd') );
		$text_size  = esc_attr( get_option('what-wp-template_text-size-dd') );

		echo "<{$text_size} style='margin:20px; color: {$text_color}'>" . $template . "</{$text_size}>";
	}


	function wwtemp_add_template_var_config_menu() {

		add_options_page(
			'Template Var Display',
			'Template Var Display',
			'manage_options',
			'what-wp-template',
			array( $this, 'wwtemp_display_template_var_config_page' )
		);

	}


	function wwtemp_display_template_var_config_page() {
		?>
		<div class="wrap">
			<div id="icon-plugins" class="icon32"></div>
			<h2>Template Var - Display Options</h2>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'myoption-group' );
					do_settings_sections( 'myoption-group' );

					$text_color_saved   = get_option( 'what-wp-template_text-color-dd' );
					$text_size_saved    = get_option( 'what-wp-template_text-size-dd' );

					$text_colors            = array();
					$text_colors['white']   = "White";
					$text_colors['green']   = "Green";
					$text_colors['yellow']  = "Yellow";
					$text_colors['red']     = "Red";
					$text_colors['blue']    = "Blue";

					$text_sizes         = array();
					$text_sizes['h1']   = "H1";
					$text_sizes['h2']   = "H2";
					$text_sizes['h3']   = "H3";
					$text_sizes['h4']   = "H4";
					$text_sizes['h5']   = "H5";
					$text_sizes['h6']   = "H6";
				?>

				<table class="form-table">

					<tr valign="top">
					<th scope="row">Text Color</th>
					<td>
						<select name="what-wp-template_text-color-dd">
							<?php
								foreach( $text_colors as $color_key => $color_label ){
									$selected_color = ( $text_color_saved == $color_key ? 'selected="selected"' : null);
									echo '<option value="'.$color_key.'"'.$selected_color.'>'.$color_label.'</option>';
								}
							?>
						</select>
					</td>
					</tr>
					<tr valign="top">
					<th scope="row">Text Size</th>
					<td>
						<select name="what-wp-template_text-size-dd">
							<?php
							foreach( $text_sizes as $size_key => $size_label ){
								$selected_size = ( $text_size_saved == $size_key ? 'selected="selected"' : null);
								echo '<option value="'.$size_key.'"'.$selected_size.'>'.$size_label.'</option>';
							}
							?>
						</select>
					</td>
					</tr>

				</table>

				<?php
					submit_button();
				?>
			</form>
		</div>
		<?php
	}


	function wwtemp_register_what_wp_template_settings() {
		register_setting( 'myoption-group', 'what-wp-template_text-color-dd' );
		register_setting( 'myoption-group', 'what-wp-template_text-size-dd' );
	}


	static function wwtemp_set_default_values_on_activation(){
		add_option( 'what-wp-template_text-color-dd', 'red');
		add_option( 'what-wp-template_text-size-dd', 'h1');
	}

}
register_activation_hook( __FILE__, array( 'What_WP_Template', 'wwtemp_set_default_values_on_activation' ) );

$what_wp_template = new What_WP_Template();
