<?php

$two_img_mb = $two_img = new WPAlchemy_MetaBox(array
(
	'id' => '_two_img',
	'title' => __('<u>Two vertical</u> images or <u>one horizontal</u> image below project description', 'rijnboutt'),
	'types' => array('projects',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/two_img_meta.php',
));

/* eof */