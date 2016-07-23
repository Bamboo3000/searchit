<?php

$the_module_mb = $the_module = new WPAlchemy_MetaBox(array
(
	'id' => '_the_module',
	'title' => 'Module link',
	'context' => 'normal',
	'types' => array('modules',),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/the_module_meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */