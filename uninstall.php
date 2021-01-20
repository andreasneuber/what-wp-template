<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

delete_option( 'what-wp-template_text-color-dd' );
delete_option( 'what-wp-template_text-size-dd' );
