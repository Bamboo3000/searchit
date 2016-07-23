<?php

$home_mb = $home = new WPAlchemy_MetaBox(array
(
	'id' => '_home',
	'title' => 'Three boxes on the bottom',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/home_meta.php',
	'include_template' => 'home-page.php',
));

/* eof */