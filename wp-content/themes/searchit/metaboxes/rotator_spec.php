<?php

$rotator_img_mb = $rotator_img = new WPAlchemy_MetaBox(array
(
	'id' => '_rotator_img',
	'title' => 'Rotating photos',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/rotator_meta.php',
	'include_template' => 'home-page.php',
	// 'mode' => WPALCHEMY_MODE_EXTRACT,
	// 'prefix' => '_my_',
));

/* eof */