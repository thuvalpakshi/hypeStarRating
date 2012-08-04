<?php

/* hypeStarRating
 *
 * SoundCloud Integration for Elgg
 * @package hypeJunction
 * @subpackage hypeSound
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyrigh (c) 2011, Ismayil Khayredinov
 */

elgg_register_event_handler('init', 'system', 'hj_starrating_init');

function hj_starrating_init() {

	$plugin = 'hypeStarRating';
	if (!elgg_is_active_plugin('hypeFramework')) {
		register_error(elgg_echo('hj:framework:disabled', array($plugin, $plugin)));
		disable_plugin($plugin);
	}

	$shortcuts = hj_framework_path_shortcuts($plugin);

	elgg_register_library('hj:starrating:base', $shortcuts['lib'] . 'starrating/base.php');
	elgg_register_library('hj:starrating:setup', $shortcuts['lib'] . 'starrating/setup.php');
	elgg_load_library('hj:starrating:base');

	$css_url = elgg_get_simplecache_url('css', 'vendors/stars/base');
	elgg_register_css('hj.starrating.base', $css_url);

	$js_lib_url = elgg_get_config('url') . "mod/$plugin/views/default/js/vendors/stars/jquery.ui.stars.js";
	elgg_register_js('hj.starrating.lib', $js_lib_url, 'head', 501);

	$js_url = elgg_get_simplecache_url('js', 'vendors/stars/base');
	elgg_register_js('hj.starrating.base', $js_url, 'head', 502);

	elgg_load_css('hj.starrating.base');
	elgg_load_js('hj.starrating.lib');
	elgg_load_js('hj.starrating.base');
	
	if (!elgg_get_plugin_setting('hj:starrating:setup')) {
		elgg_load_library('hj:starrating:setup');
		if (hj_starrating_setup())
			system_message('hypeStarRating was successfully configured');
	}

	elgg_register_action('stars/rate', $shortcuts['actions'] . 'hj/starrating/rate.php');

	elgg_register_plugin_hook_handler('register', 'menu:entity', 'hj_starrating_entity_menu');
	elgg_register_plugin_hook_handler('register', 'menu:hjentityhead', 'hj_starrating_entity_menu');

	elgg_register_widget_type('highestrating', elgg_echo('hj:starrating:widget'), elgg_echo('hj:starrating:widget:description'), 'profile,dashboard,groups', false);

	elgg_extend_view('object/summary/extend', 'hj/starrating/widget_rating');
}

function hj_starrating_entity_menu($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);

	switch ($entity->getType()) {

		case 'object' :
			$subtypes_to_check = get_registered_entity_types('object');
			
			// Check to see if there is a defined list of subtypes
			$subtypes_to_check = elgg_trigger_plugin_hook('hj:starrating:subtypes', 'object', null, $subtypes_to_check);
			if (!in_array($entity->getSubtype(), $subtypes_to_check)) {
				return $return;
			}
			break;
			
		case 'user' :
		case 'group' :
			if (elgg_get_plugin_setting($entity->getType(), 'hypeStarRating') == 'no') {
				return $return;
			}
			break;
		
		default :
			return $return;
			break;
	}

	if (elgg_trigger_plugin_hook('hj:starrating:custom', 'object', $entity, false)) {
		return $return;
	}

	$starrating = array(
		'name' => 'starrating',
		'priority' => 10,
		'text' => elgg_view('input/starrating', $params),
		'href' => false,
		'encode_text' => false,
		'section' => 'dropdown'
	);
	$return[] = ElggMenuItem::factory($starrating);

	return $return;
}
