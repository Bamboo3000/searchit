<?php

$follow_mb = $follow = new WPAlchemy_MetaBox(array
(
	'id' => '_follow',
	'title' => 'Follow',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => TEMPLATEPATH . '/metaboxes/follow_meta.php',
	'include_template' => 'contact-page.php',
));

/* eof */