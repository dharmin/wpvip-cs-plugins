<?php
/**
 * Plugin Name: Wistia WordPress Plugin
 * Plugin URI: https://github.com/wistia/wistia-wordpress-plugin
 *  Description: A plugin that allows you to embed videos from your Wistia account into WordPress.
 * Version: 0.8
 * Author: Wistia, Inc.
 * Author URI: http://wistia.com
 *  License: MIT
 * 
 * @package wistia-wordpress-oembed-plugin
 */

/**
 * Return the path of plugin file.
 */
function wistia_wordpress_plugin_file() {
	return __FILE__;
}

/**
 * This is the core of the plugin. Just basic oembed support.
 */
wp_oembed_add_provider(
	'/https?\:\/\/(.+)?(wistia\.com|wi\.st)\/.*/',
	'https://fast.wistia.com/oembed',
	true
);

// The anti-mangler is legacy and pretty broken, but if people rely on it, we
// don't want to just take it away. The Settings page lets the user turn it 
// off.
require plugin_dir_path( __FILE__ ) . 'wistia-wordpress-options.php';
require plugin_dir_path( __FILE__ ) . 'wistia-anti-mangler.php';
require plugin_dir_path( __FILE__ ) . 'anti-mangler-filters.php';
require plugin_dir_path( __FILE__ ) . 'settings-page.php';
require plugin_dir_path( __FILE__ ) . 'upgrade-actions.php';
