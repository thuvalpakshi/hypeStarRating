<?php
$entity = elgg_extract('entity', $vars, false);

if (!$entity) {
	return true;
}

elgg_load_js('starrating.widget.js');
elgg_load_js('starrating.base.js');
elgg_load_css('starrating.base.css');

$options = hj_starrating_get_rating_values();
$options_values = $options['values'];

$entity_ratings = hj_starrating_get_entity_ratings($entity);
$selected_value = $entity_ratings['average_value'];

if (hj_starrating_user_votes(elgg_get_logged_in_user_entity(), $entity) || !elgg_is_logged_in()) {
	$disabled = "disabled";
}
$input = elgg_view('input/dropdown', array(
	'name' => 'starrating',
	'value' => $selected_value,
	'options_values' => $options_values,
	'disabled' => $disabled,
	'class' => 'hj-starrating-default-select hidden'
		));

$submit = elgg_view('input/submit', array('value' => elgg_echo('rate'), 'class' => 'hidden'));

$form = elgg_view('input/form', array(
	'body' => $input . $submit,
	'action' => "action/stars/rate?e={$entity->guid}",
	'data-uid' => $entity->guid,
	'class' => 'hj-ajaxed-starrating'
		));

$stats = elgg_echo('hj:starrating:entity:stats', array($entity_ratings['average'], $options['max'], $entity_ratings['count']));

$html = <<<HTML
    <div class="hj-starrating-container">
        $form
        <div class="hj-starrating-caption hidden">
            $stats
        </div>
    </div>
HTML;

echo $html;