<?php

$project_slider_mb = $project_slider = new WPAlchemy_MetaBox(array
(
	'id' => '_project_slider',
	'title' => 'Rest of photo (slider)',
	'types' => array('projects',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/project_slider_meta.php',
));

/* eof */