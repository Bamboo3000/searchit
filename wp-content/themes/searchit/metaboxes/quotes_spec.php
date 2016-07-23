<?php

$quotes_mb = $quotes = new WPAlchemy_MetaBox(array
(
	'id' => '_quotes',
	'title' => 'quotes',
	'context' => 'normal',
	'types' => array('post', 'page', 'news_exhibitions', 'public_art'),
	'priority' => 'high',
	'autosave' => TRUE,
	'template' => get_stylesheet_directory() . '/metaboxes/quotes_meta.php',
));

/* eof */