<?php

$home_slider_mb = $home_slider = new WPAlchemy_MetaBox(array
(
	'id' => '_home_slider',
	'title' => 'home slider',
	'types' => array('home_slider',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/home_slider_meta.php',
));

/* eof */