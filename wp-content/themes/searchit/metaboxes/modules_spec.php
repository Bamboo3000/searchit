<?php

$modules_mb = $modules = new WPAlchemy_MetaBox(array
(
	'id' => '_modules',
	'title' => 'modules',
	'context' => 'normal',
	'types' => array('post', 'page', 'news_exhibitions', 'public_art'),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/modules_meta.php',
));

/* eof */