<?php

$universal_mb = $universal = new WPAlchemy_MetaBox(array
(
	'id' => '_universal',
	'title' => 'Content',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/universal_meta.php',
	'include_template' => array('templates/universal-template.php', 'templates/contact-template.php'),
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */