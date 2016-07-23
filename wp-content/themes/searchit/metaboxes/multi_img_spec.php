<?php

$multi_img_mb = $multi_img = new WPAlchemy_MetaBox(array
(
	'id' => '_multi_img',
	'title' => 'Multiple image add',
	'context' => 'normal',
	'types' => array('public_art', 'news_exhibitions',),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/multi_img_meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */