<?php

$contact_mb = $contact = new WPAlchemy_MetaBox(array
(
	'id' => '_contact',
	'title' => 'Contact',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/contact_meta.php',
	'include_template' => 'contact-page.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */