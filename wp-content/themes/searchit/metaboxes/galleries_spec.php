<?php

$galleries_mb = $galleries = new WPAlchemy_MetaBox(array
(
	'id' => '_galleries',
	'title' => 'galleries',
	'context' => 'normal',
	'types' => array('galleries',),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/galleries_meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */