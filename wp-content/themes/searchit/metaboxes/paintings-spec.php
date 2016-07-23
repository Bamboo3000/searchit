<?php

$paintings_mb = $paintings = new WPAlchemy_MetaBox(array
(
	'id' => '_paintings',
	'title' => 'Painting Credits',
	'types' => array('paintings',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/paintings-meta.php',
));

/* eof */