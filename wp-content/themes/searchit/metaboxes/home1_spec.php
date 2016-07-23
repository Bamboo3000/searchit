<?php

$home_claim_mb = $home_claim = new WPAlchemy_MetaBox(array
(
	'id' => '_claim',
	'title' => 'Main Claim',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/home1_meta.php',
	'include_template' => 'templates/home-page.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */