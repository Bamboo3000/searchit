<?php

$testimonials_mb = $testimonials = new WPAlchemy_MetaBox(array
(
	'id' => '_testimonials',
	'title' => 'Testimonials',
	'context' => 'normal',
	'types' => array('page'),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/testimonials_meta.php',
	'include_template' => 'testimonials-page.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */