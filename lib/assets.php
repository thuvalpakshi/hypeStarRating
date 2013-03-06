<?php

elgg_register_js('starrating.widget.js', '/mod/hypeStarRating/vendors/jquery.ui/jquery.ui.stars.js', 'footer');

elgg_register_js('starrating.base.js', elgg_get_simplecache_url('js', 'framework/stars/base'), 'footer');
elgg_register_simplecache_view('js/framework/stars/base');

elgg_register_css('starrating.base.css', elgg_get_simplecache_url('css', 'framework/stars/base'));
elgg_register_simplecache_view('css/framework/stars/base');