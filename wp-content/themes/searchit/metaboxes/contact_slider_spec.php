<?php

$contact_slider_mb = $contact_slider = new WPAlchemy_MetaBox(array
(
	'id' => '_contact_slider',
	'title' => 'contact slider',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/contact_slider_meta.php',
	'include_template' => 'page-contact.php',
));

/* eof */