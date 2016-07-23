<?php

$testimonials_post_mb = $testimonials_post = new WPAlchemy_MetaBox(array
(
	'id' => '_testimonials_post',
	'title' => 'Testimonials',
	'context' => 'normal',
	'types' => array('testimonials'),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/testimonials_post_meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */