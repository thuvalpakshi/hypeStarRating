<?php

/* hypeStarRating
 *
 * Rating Widget
 * @package hypeJunction
 * @subpackage hypeStarRating
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyrigh (c) 2011-2013, Ismayil Khayredinov
 */

define('HYPESTARS_RELEASE', 1362277413);

elgg_register_event_handler('init', 'system', 'hj_starrating_init');

function hj_starrating_init() {

	$plugin = 'hypeStarRating';

	// Make sure hypeFramework is active and precedes hypeStarRating in the plugin list
	if (!is_callable('hj_framework_path_shortcuts')) {
		register_error(elgg_echo('framework:error:plugin_order', array($plugin)));
		disable_plugin($plugin);
		forward('admin/plugins');
	}

	// Run upgrade scripts
	hj_framework_check_release($plugin, HYPESTARS_RELEASE);

	$shortcuts = hj_framework_path_shortcuts($plugin);

	// Libraries
	$libraries = array(
		'base',
		'forms',
		'page_handlers',
		'actions',
		'assets',
		'views',
		'menus',
		'hooks',
		'views'
	);

	foreach ($libraries as $lib) {
		$path = "{$shortcuts['lib']}{$lib}.php";
		if (file_exists($path)) {
			elgg_register_library("starrating:library:$lib", $path);
			elgg_load_library("starrating:library:$lib");
		}
	}

	elgg_register_widget_type('highestrating', elgg_echo('hj:starrating:widget'), elgg_echo('hj:starrating:widget:description'), 'profile,dashboard,groups', false);
}
