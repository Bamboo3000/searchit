<?php

$links_mb = $links = new WPAlchemy_MetaBox(array
(
	'id' => '_links',
	'title' => 'Links',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/links_meta.php',
	'include_template' => 'links-page.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */