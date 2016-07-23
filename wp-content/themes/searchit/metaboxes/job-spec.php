<?php

$job_mb = $job = new WPAlchemy_MetaBox(array
(
	'id' => '_job_meta',
	'title' => 'Job Details',
	'types' => array('post',),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/job-meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => 'my_',
));

/* eof */