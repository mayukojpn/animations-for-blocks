<?php
/**
 * Plugin Name: Animations for Blocks
 * Plugin URI: https://wordpress.org/plugins/animations-for-blocks
 * Description: Allows to add animations to Gutenberg blocks on scroll.
 * Version: 1.0.6
 * Author: websevendev
 * Author URI: https://chap.website/author/websevendev
 */

namespace wsd\anfb;

defined('ABSPATH') || exit;

function_exists('get_plugin_data') || require_once ABSPATH . 'wp-admin/includes/plugin.php';
$anfb_plugin = get_plugin_data(__FILE__, false, false);
define('WSD_ANFB_VER', $anfb_plugin['Version']);
define('WSD_ANFB_FILE', __FILE__);
define('WSD_ANFB_DIR', dirname(__FILE__));
define('WSD_ANFB_AOS_HANDLE', 'animate-on-scroll');

require_once WSD_ANFB_DIR . '/includes/html-helpers.php';
require_once WSD_ANFB_DIR . '/includes/assets.php';
require_once WSD_ANFB_DIR . '/includes/anfb-attributes.php';
require_once WSD_ANFB_DIR . '/includes/blocks.php';

add_action('init', __NAMESPACE__ . '\\register_aos');
add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\\editor_assets', 5);
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\front_end_assets', 500);
add_filter('anfb_load_styles', __NAMESPACE__ . '\\disable_on_amp');
add_filter('anfb_load_scripts', __NAMESPACE__ . '\\disable_on_amp');
add_filter('register_block_type_args', __NAMESPACE__ . '\\block_args', 10, 2);

/**
 * Add GitHub link on the plugins page.
 *
 * @param array $plugin_meta
 * @param string $plugin_file
 * @return array
 */
function github_link($plugin_meta, $plugin_file) {
	if($plugin_file === plugin_basename(WSD_ANFB_FILE)) {
		$plugin_meta[] = '<a href="https://github.com/websevendev/animations-for-blocks" target="_blank" rel="noopener noreferrer">GitHub</a>';
	}
	return $plugin_meta;
}
add_filter('plugin_row_meta', __NAMESPACE__ . '\\github_link', 10, 2);
