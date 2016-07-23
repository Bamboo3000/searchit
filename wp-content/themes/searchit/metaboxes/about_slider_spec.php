<?php

$about_slider_mb = $about_slider = new WPAlchemy_MetaBox(array
(
	'id' => '_about_slider',
	'title' => 'about slider',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/about_slider_meta.php',
	'include_template' => 'page-about.php',
));

/* eof */