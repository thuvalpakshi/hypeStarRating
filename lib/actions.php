<?php

$shortcuts = hj_framework_path_shortcuts('hypeStarRating');

elgg_register_action('hypeStarRating/settings/save', $shortcuts['actions'] . 'settings/stars.php', 'admin');
elgg_register_action('stars/rate', $shortcuts['actions'] . 'stars/rate.php');