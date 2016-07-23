<?php

$cv_mb = $cv = new WPAlchemy_MetaBox(array
(
	'id' => '_cv',
	'title' => 'Selected',
	'types' => array('cv',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/cv-meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_cv_',
));

/* eof */