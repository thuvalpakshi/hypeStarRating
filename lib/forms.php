<?php

elgg_register_plugin_hook_handler('init', 'form:edit:plugin:hypestarrating', 'hj_starrating_init_plugin_settings_form');

function hj_starrating_init_plugin_settings_form($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);

	// Types and subtypes to rate
	$dbprefix = elgg_get_config('dbprefix');
	$data = get_data("SELECT type AS type, subtype AS subtype
								FROM {$dbprefix}entity_subtypes");

	foreach ($data as $r) {
		$type = $r->type;
		$subtype = $r->subtype;

		$types[$type][] = $subtype;

		$str = elgg_echo("item:$type:$subtype");
		$subtype_options[$str] = "$type:$subtype";
	}

	if (!array_key_exists('user', $types)) {
		$str = elgg_echo("item:user");
		$subtype_options[$str] = "user:default";
	}

	if (!array_key_exists('group', $types)) {
		$str = elgg_echo("item:group");
		$subtype_options[$str] = "group:default";
	}

	$config['fields']["params[stars_type_subtype_pairs]"] = array(
		'input_type' => 'checkboxes',
		'default' => false,
		'value' => explode(',', $entity->stars_type_subtype_pairs),
		'options' => $subtype_options,
		'hint' => elgg_echo('edit:plugin:hypestarrating:hint:stars_type_subtype_pairs')
	);

	for ($i = 1; $i <= 10; $i++) {
		$config['fields']["params[$i]"] = array(
			'value' => $entity->$i,
			'maxlength' => 25,
			'size' => 25,
			'label' => array('text' => elgg_echo("edit:plugin:hypestarrating:label", array($i))),
			'hint' => elgg_echo("edit:plugin:hypestarrating:hint:scores")
		);
	}

	$config['buttons'] = false;

	return $config;
}
