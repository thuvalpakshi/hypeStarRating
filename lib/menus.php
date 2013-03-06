<?php

elgg_register_plugin_hook_handler('register', 'menu:entity', 'hj_starrating_menu_setup');
elgg_register_plugin_hook_handler('register', 'menu:title', 'hj_starrating_menu_setup');


function hj_starrating_menu_setup($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params, false);
	if (!elgg_instanceof($entity)) {
		return $return;
	}

	$type_subtype_pairs = hj_starrating_get_rateable_type_subtype_pairs();
	$type = $entity->getType();
	$subtype = $entity->getSubtype();

	if (!array_key_exists($type, $type_subtype_pairs)) {
		return $return;
	}

	if ($subtype && array_search($subtype, $type_subtype_pairs[$type]) === false) {
		return $return;
	}

	$starrating = array(
		'name' => 'starrating',
		'priority' => 10,
		'text' => elgg_view('input/starrating', $params),
		'href' => false,
		'encode_text' => false,
		'section' => 'rating'
	);
	$return[] = ElggMenuItem::factory($starrating);

	return $return;
}
