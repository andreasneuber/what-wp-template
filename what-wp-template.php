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
        add_action( 'wp_footer', array( $this, 'display_template_var_in_wp_footer' ) );
    }

    function display_config(){
        $cfg = array();
        $cfg['text_color']  = 'white';
        $cfg['text_size']   = 'h2';

        return $cfg;
    }

    function display_template_var_in_wp_footer() {
        global $template;
        $cfg = $this->display_config();
        echo "<{$cfg['text_size']} style='margin:20px; color: {$cfg['text_color']}'>" . $template . "</{$cfg['text_size']}>";
    }



}

$what_wp_template = new What_WP_Template();