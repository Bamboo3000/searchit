<?php

$about_mb = $about = new WPAlchemy_MetaBox(array
(
	'id' => '_about',
	'title' => 'About',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/about_meta.php',
	'include_template' => 'page-about.php',
));

/* eof */