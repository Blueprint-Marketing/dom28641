<?php 
/*
	Plugin Name: WP Responsive Tabs
	Plugin URI: http://androidbubble.com/blog/wprtp
	Description: An easy way to create tabs for unique posts/pages and feel freedom to use them anywhere in your content or files.
	Version: 1.2.3
	Author: Fahad Mahmood 
	Author URI: http://www.androidbubbles.com
	License: GPL3
*/ 


	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 
    include('functions.php');

	
	add_action( 'admin_enqueue_scripts', 'register_wprtabs_scripts' );
	add_action( 'wp_enqueue_scripts', 'register_wprtabs_scripts' );
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'ertab_plugin_links' );