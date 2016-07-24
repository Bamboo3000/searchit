<?php

$uploadcv_mb = $uploadcv = new WPAlchemy_MetaBox(array
(
	'id' => '_uploadcv',
	'title' => 'Main Claim',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/uploadcv_meta.php',
	'include_template' => array('templates/upload-cv-template.php', 'templates/testimonials-default.php', 'templates/testimonials-candidates.php', 'templates/testimonials-client.php', 'templates/our-team-page.php'),
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */