<?php
/*
Plugin Name: W3 TC setting
Plugin URI: #
Description: W3 Total Cache settings and flush. You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting.
Author: Ramon Fincken
Version: 1.1
Author URI: http://www.mijnpress.nl


Notice:

Code written by ManagedWPHosting.nl/MijnPress.nl for usage on their WordPress hosting platform.
You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting

 */

/**
* Performs JS action
*/
function mp_w3tc_js() {
	echo '<script type="text/javascript">jQuery( document ).ready(function( jQuery ) { jQuery("select").find("option[value=\'memcached\']").attr("selected",true); }); </script>';
}

/**
* Notifies client
*/
function mp_w3tc_notice() {
	if(isset($_GET['page']))
	{
		if(substr_count($_GET['page'],'w3tc'))
		{
			echo '<div id="mp_w3tc_notice" class="updated fade">';
			if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
		_e('Hi there, welcome at your W3TC management page(s). We have allready chosen the fasted setup for your caches.' , 'managedwphosting_nl' );
		echo '</br>';
		_e('The <strong>memcached</strong> storage method is much faster than storage on disk and will not reduce your hosting hard disk quota. Please adjust and save your settings rightaway.<br/>Please do NOT enable the database cache to avoid errors.' , 'managedwphosting_nl' );
		echo '</div>';
		}
	}
}

add_action( 'admin_notices', 'mp_w3tc_notice' );
add_action( 'admin_footer', 'mp_w3tc_js' );

/**
* Calls flush URLs
*/
function mp_w3_flush_varnish() {
        if(isset($_GET['w3tc_note']) && ($_GET['w3tc_note'] == 'flush_all' || $_GET['w3tc_note'] == 'flush_varnish' || $_GET['w3tc_note'] == 'flush_pgcache' || $_GET['w3tc_note'] == 'flush_minify')) {
                if(class_exists('W3_Config')) {
                        $w3 = new W3_Config();
                        $get_servers = $w3->get_array('varnish.servers');

                        if(is_array($get_servers) && count($get_servers) > 0) {
				echo '<div class="updated fade"><p>';
				if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
				echo 'Flushed : ';
                                foreach($get_servers as $server) {
					$server = strtolower($server);
					$pos = strpos($server, 'http');
					if($pos === false) {
						// Assume http protocol
						$server = 'http://'.$server;
					}
                                        wp_remote_post($server);
					echo '<br/>'.$server;
                                }
				echo '</p></div>';
                        }
                }
        }
}

add_action( 'admin_notices', 'mp_w3_flush_varnish' );
?>
