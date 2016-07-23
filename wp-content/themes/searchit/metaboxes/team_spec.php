<?php

$team_mb = $team = new WPAlchemy_MetaBox(array
(
	'id' => '_team',
	'title' => 'Team',
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => TRUE,
	'types' => array('team',),
	'template' => TEMPLATEPATH . '/metaboxes/team_meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'prefix' => '_my_',
));

/* eof */