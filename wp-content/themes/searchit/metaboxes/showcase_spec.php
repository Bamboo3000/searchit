<?php

$showcase_input_mb = $showcase_input = new WPAlchemy_MetaBox(array
(
	'id' => '_showcase_input',
	'title' => 'Choose and add paintings here',
	'context' => 'normal',
	'types' => array('showcase',),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/showcase_meta.php',
	// 'mode' => WPALCHEMY_MODE_EXTRACT,
	// 'prefix' => '_my_',
));

/* eof */