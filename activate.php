<?php

$options = array(
	array('score' => '1', 'desc' => 'Not so great'),
	array('score' => '2', 'desc' => 'Quite good'),
	array('score' => '3', 'desc' => 'Good'),
	array('score' => '4', 'desc' => 'Great!'),
	array('score' => '5', 'desc' => 'Excellent!'),
);

foreach ($options as $option) {
	if (!elgg_get_plugin_setting($option['score'])) {
		elgg_set_plugin_setting($option['score'], $option['desc'], 'hypeStarRating');
	}
}

return true;