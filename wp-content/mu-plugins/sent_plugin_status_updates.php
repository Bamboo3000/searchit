<?php
/*
 Plugin Name: Sent plugin status updates
 Plugin URI: #
 Description: Sents plugin status updates. You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting.
 Author: Ramon Fincken MijnPress.nl ManagedWPHosting.nl
 Version: 1.0 Beta
 Author URI: http://www.mijnpress.nl


Notice:

Code written by ManagedWPHosting.nl/MijnPress.nl for usage on their WordPress hosting platform.
You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting

 */

global $wp_version;
define('MOUISWP28', version_compare($wp_version, '2.8', '>='));
define('MOUISWP30', version_compare($wp_version, '3.0', '>='));

//register_activation_hook(__FILE__, 'mpspsu_updater_activation');
register_deactivation_hook(__FILE__, 'mpspsu_updater_deactivation');

add_action( 'deactivate_plugin', 'mpspsu_prevent_disable', 1, 2);

function mpspsu_prevent_disable($plugin, $network_wide = false)
{
	if($plugin == plugin_basename(__FILE__))
	{
		wp_die( 'You may not disable this plugin (Sent plugin status updates)' );
	}
}

add_action('mp_updater_event', 'mpspsu_updater_cron');
function mpspsu_updater_activation() {
	wp_schedule_event(time(), 'twicedaily', 'mpspsu_updater_event');
}
function mpspsu_updater_deactivation() {
	wp_clear_scheduled_hook('mpspsu_updater_event');
}

add_action('login_head','mpspsu_maybe_run');
add_action('admin_footer','mpspsu_maybe_run');
function mpspsu_maybe_run()
{
	// Run by transient
	$mp_spu_key = 'twicedayly_updates_key';
	if (( false === ( $special_query_results = get_transient( $mp_spu_key ) ) ) ) {
		$all_ok = mpspsu_updater_cron();
		if($all_ok) 
		{
			set_transient( $mp_spu_key, 'has_run', 12*HOUR_IN_SECONDS );
		}
		else
		{
			set_transient( $mp_spu_key, 'has_run', 60*15 ); // 15 minute retry
		}
	}
}


// Disable updates for this plugin itself
add_filter('site_transient_update_plugins', 'mpspsu_post_schedule_remove_update_nag');
function mpspsu_post_schedule_remove_update_nag($value) {
	if(isset($value->response[ plugin_basename(__FILE__) ]))
	{
		unset($value->response[ plugin_basename(__FILE__) ]);
	}
	return $value;
}

function mpspsu_updater_cron()
{
	require_once( ABSPATH . WPINC . '/pluggable.php' );
	//include wordpress update functions
	require_once ( ABSPATH . 'wp-admin/includes/update.php' );
	require_once ( ABSPATH . 'wp-admin/admin-functions.php' );

	$site_url = str_replace('http://','',get_option('siteurl'));
	$site_url = str_replace('https://','',$site_url);



	//call the wordpress update function
	if (MOUISWP30) {
		wp_plugin_update_rows();
		$updates = get_site_transient('update_plugins');
	}
	else {
		wp_update_plugins();
		$updates = get_transient('update_plugins');
	}


	//get all plugins
	$plugins = array();
	$plugins['all'] = get_plugins();


	//$blogname = get_option('blogname');
	//$message  = '';
	$pluginNotVaildated = '';

	$screen = get_current_screen();

	// Create index with active / inactive next to existing [all]
	foreach ( (array) $plugins['all'] as $plugin_file => $plugin_data ) {
		// Filter into individual sections
		if ( is_multisite() && is_network_only_plugin( $plugin_file ) && !$screen->is_network ) {
			unset( $plugins['all'][ $plugin_file] );
		} elseif ( is_plugin_active_for_network($plugin_file) && !$screen->is_network ) {
			unset( $plugins['all'][ $plugin_file ] );
		} elseif ( is_multisite() && is_network_only_plugin( $plugin_file ) && !current_user_can( 'manage_network_plugins' ) ) {
			$plugins['network'][ $plugin_file ] = $plugin_data;
		} elseif ( $screen && ( !$screen->is_network && is_plugin_active( $plugin_file ) )
		|| ( $screen->is_network && is_plugin_active_for_network( $plugin_file ) ) ) {
			$plugins['active'][ $plugin_file ] = $plugin_data;
		} else {
			if ( $screen && !$screen->is_network && isset( $recently_activated[ $plugin_file ] ) ) // Was the plugin recently activated?
			$plugins['recently_activated'][ $plugin_file ] = $plugin_data;
			$plugins['inactive'][ $plugin_file ] = $plugin_data;
		}
	}

	$current = get_site_transient( 'update_plugins' );
	if(isset($plugins['all']))
	{
		foreach ( (array) $plugins['all'] as $plugin_file => $plugin_data ) {
			if ( isset( $current->response[ $plugin_file ] ) )
			{
				$plugins['upgrade'][ $plugin_file ] = $plugin_data;
				$plugins['upgrade'][ $plugin_file ]['upgradeinfo'] = (array) $updates->response[$plugin_file];
			}
		}
	}

	$plugins_serialized = base64_encode(maybe_serialize($plugins));
	$handshake = crc32($plugins_serialized);

	$request = new WP_Http;
	$body = array(
	'website' => $site_url,
	'info' => base64_encode(get_option('admin_email').'||'.md5(time().$site_url))
	);

	// Retrieve key
	$url = 'http://intel.managedwphosting.nl/get-key/';
	$result = $request->request( $url, array( 'method' => 'POST', 'body' => $body) );
	
	if(is_array($result) && isset($result['response']['code']) && $result['response']['code'] == 200)
	{
		$key = $result['body'];
	}
	else
	{
		return false;
	}

	if(isset($key))
	{
		$request = new WP_Http;
		$body = array(
			'website' => $site_url,
			'handshake' => $handshake,
			'key' => $key,
			'data' => $plugins_serialized
		);

		// Retrieve key
		$url = 'http://intel.managedwphosting.nl/sent-update/';
		$result = $request->request( $url, array( 'method' => 'POST', 'body' => $body) );
		if(is_array($result) && isset($result['response']['code']) && $result['response']['code'] == 200)
		{

		}
		else
		{
			return false;
		}
	}
	return true;
}
?>
