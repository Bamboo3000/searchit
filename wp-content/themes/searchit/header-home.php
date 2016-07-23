<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php// wp_title('|', true, 'right'); ?>Search It Recruitment</title>
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/sass/style.css">
	<?php wp_head(); ?>
</head>
<body <?php if(wp_is_mobile()){ body_class( 'mobile' );} else{ body_class('frontPage'); }?>>
	<?php get_sidebar(); ?>
	<div class="wrapper">