<?php
$entity = elgg_extract('entity', $vars, false);

if (!$entity) {
    return true;
}

elgg_load_css('starrating.base.css');
elgg_load_js('starrating.widget.js');
elgg_load_js('starrating.base.js');

$options = hj_starrating_get_rating_values();
$options_values = $options['values'];

$entity_ratings = hj_starrating_get_entity_ratings($entity);
$selected_value = $entity_ratings['average_value'];

$disabled = "disabled";

$input = elgg_view('input/dropdown', array(
    'name' => 'starrating',
    'value' => $selected_value,
    'options_values' => $options_values,
    'disabled' => $disabled,
    'class' => 'hj-starrating-default-select hidden'
));

$submit = elgg_view('input/submit', array('value' => elgg_echo('rate')));

$form = elgg_view('input/form', array(
    'body' => $input . $submit,
    'action' => "action/stars/rate?e={$entity->guid}",
    'id' => "hj-starrating-entity-{$entity->guid}",
    'class' => 'hj-ajaxed-starrating clearfix'
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