<?php

$english = array(

    'hj:starrating:entity:stats' => '%s/%s (%s votes)',
    'hj:starrating:saving' => 'Saving ...',
    'hj:starrating:rate:error' => 'There was a problem saving your rating',
    'hj:starrating:rate:success' => 'Your rating was successfully saved',
    'hj:starrating:rate:alreadyrated' => 'Sorry, you can\'t rate the same item twice',

	'hj:starrating:widget' => 'Most Rated',
	'hj:starrating:widget:numbertodisplay' => 'Number of items to display',
	'hj:starrating:widget:types' => 'Types of entities',
	'hj:starrating:widget:subtypes' => 'Object subtypes',
	'hj:starrating:widget:description' => 'Most Rated widget',

	'rate' => 'Rate',

	'edit:plugin:hypestarrating:params[stars_type_subtype_pairs]' => 'Rateable entity types/subtypes',
	'edit:plugin:hypestarrating:hint:stars_type_subtype_pairs' => 'Types of entities that can be rated using star rating widget',
	
	'edit:plugin:hypestarrating:label' => 'Verbose score for %s',

	"edit:plugin:hypestarrating:hint:scores" => 'Please enter description corresponding to each score. If you would like to use a scale of 1 to 5, enter values corresponding to those scores, and leave the rest blank.',
	

);

add_translation("en", $english);
?>