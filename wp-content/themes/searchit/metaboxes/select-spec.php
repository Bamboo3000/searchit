<?php

$custom_select_mb = $build_credits = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_select_meta',
	'title' => 'Additional Project Credits',
	'types' => array('projects',),
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/select-meta.php',
));

/* eof */