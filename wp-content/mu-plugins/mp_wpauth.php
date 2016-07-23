<?php
/**
 * Plugin Name: MijnPress WordPress auth
 * Author: Ramon Fincken, MijnPress.nl ManagedWPHosting.nl RamonFincken.com
 * Intel: Authy plugin
 * Description: Takes care of 2 factor authentication. You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting.
 * Version: 1.1.1
 * Based on Authy plugin


Notice:

Code written by ManagedWPHosting.nl/MijnPress.nl for usage on their WordPress hosting platform.
You are not allowed to apply/copy/migrate this code on hosting platforms that do not belong to ManagedWPHosting

 */
class mp_wpauth
{
	/**
	* Initiates plugin, adds hooks and filters
	*/
	public static function init()
	{
		$mp_wpauth = new mp_wpauth();
		// Authentication
		add_filter( 'authenticate', array($mp_wpauth, 'authenticate_user' ), 10, 3 );
			
		add_action( 'show_user_profile', array($mp_wpauth, 'profile_field' ));
		add_action( 'edit_user_profile', array($mp_wpauth, 'profile_field' ));		
		
		add_action( 'personal_options_update', array($mp_wpauth, 'save_profile_field' ));
		add_action( 'edit_user_profile_update', array($mp_wpauth, 'save_profile_field' ));		

		add_action('admin_menu', array($mp_wpauth,'my_users_menu_init'));
	}

	/**
	* Prepares WP menu for admins only (activate_plugins)
	*/
	function my_users_menu_init() 
	{
		$mp_wpauth = new mp_wpauth();		
		add_users_page('2Factor authentication', '2Factor authentication', 'activate_plugins', 'mp-2factor-auth-settings', array($mp_wpauth, 'my_users_menu_content'));
	}

	function my_users_menu_content() 
	{
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		global $wp_roles;
                $roles = $wp_roles->role_names;

		_e('Which roles should have 2Factor Authentication Login?<br/> Admins should always use 2 Factor Authentication!' , 'managedwphosting_nl' );
		echo '</br></br>';

		if(isset($_POST['save'])) {
			check_admin_referer( 'mp_2fa_settings');

			// Write stuff
			$setarray = array();
			if(is_array($_POST['role'])) {
				if(count($_POST['role']) > 0) {
					foreach($_POST['role'] as $role) {
						if(isset($roles[$role])) {
							$setarray[]=$role;
						}
					}
				}
			}
			update_option('mp_2fa_settings',$setarray);
			?>
		    <div class="updated">
		        <p><?php _e( 'Updated!', 'mp_wpauth' ); ?></p>
		    </div><br/>
    <?php
		}

		$mp_2fa_options = get_option('mp_2fa_settings',array('administrator'));

		echo '<form action="" method="post">';
		wp_nonce_field( 'mp_2fa_settings');

		foreach($roles as $role => $human) {
			echo '<input type="checkbox"'; 
			if(in_array($role,$mp_2fa_options)) {
				echo ' checked="checked"';
			}
			echo ' id="role_'.md5($role).'" name="role['.$role.']" value="'.$role.'"><label for="role_'.md5($role).'">'.$human.'</label></br/>';
		}

		echo '</br/>';
		submit_button('Save', 'primary', 'save', NULL , NULL);
		echo '</form>';
	}

	/**
	* Checks if user has any auth at all
	*/
	private function has_any_auth($userObject)
	{
		$mp_2fa_options = get_option('mp_2fa_settings',array('administrator'));
		// No roles should be checked?
		if(!is_array($mp_2fa_options) || count($mp_2fa_options) == 0) {
			return false;
		}

		$userRoles = $userObject->roles;
		// User has no roles?
		if(!is_array($userRoles) || count($userRoles) == 0) {
			return false;
		}

		$wp_mpauthmethod = get_the_author_meta( 'mp_wpauthmethod', $userObject->ID);
		if($wp_mpauthmethod == 'none')
		{
			return false;
		}

		foreach($mp_2fa_options as $toCheck) {
			foreach($userRoles as $userRole) {
				if($toCheck == $userRole) { 
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Checks if auth has been entered
	 */
	private function has_sms_auth()
	{
		return false;
	}

	/**
	 * Adds profile field
	 */
	public function profile_field( $user ) {
	?>
	  <h3><?php _e("MP WP auth 2 Factor authentication", "mp_wpauth"); ?></h3>
	  <table class="form-table">
	    <tr>
	      <th><label for="mp_wpauthphone"><?php echo __("Phonenumber", "mp_wpauth"). '<br/><em>'.__("Do not forget your countrycode, no + prefix sign required", "mp_wpauth"); ?></em></label></th>
	      <td align="left">
	        <input type="text" name="mp_wpauthphone" id="mp_wpauthphone" class="regular-text" 
	            value="<?php echo esc_attr( get_the_author_meta( 'mp_wpauthphone', $user->ID ) ); ?>" /><br />
	        <span class="description"><?php _e("Please enter your phonenumber.", "mp_wpauth"); ?><br/><?php _e("Example: 31623456789 (Dutch mobile number)", "mp_wpauth"); ?></span>
	    </td>
	    </tr>
	    
	    <tr>
	      <th><label><?php echo __("Token method", "mp_wpauth"); ?></label></th>
	      <td align="left">
			<?php 
			$wp_mpauthmethod = get_the_author_meta( 'mp_wpauthmethod', $user->ID );
			if(!$wp_mpauthmethod || empty($wp_mpauthmethod))
			{
				$wp_mpauthmethod = 'email';
			}
			?>
		<input type="radio" name="mp_wpauthmethod" id="mp_wpauthmethod_none" <?php if($wp_mpauthmethod == 'none') { echo 'checked="checked"'; } ?>class="mp_wpauthmethod_radio" 
	            value="none" />
	            <label for="mp_wpauthmethod_none"><span class="description"><?php _e("Disable the 2 factor login, this is not recommended!", "mp_wpauth"); ?></span></label>
	            <br/>
	        <input type="radio" name="mp_wpauthmethod" id="mp_wpauthmethod_email" <?php if($wp_mpauthmethod == 'email') { echo 'checked="checked"'; } ?>class="" 
	            value="email" />
	            <label for="mp_wpauthmethod_email"><span class="description"><?php _e("Email only", "mp_wpauth"); ?></span></label>
	            <br/>
<?php
/*	            
	        <input type="radio" name="mp_wpauthmethod" id="mp_wpauthmethod_phone" <?php if($wp_mpauthmethod == 'phone') { echo 'checked="checked"'; } ?>class="" 
	            value="phone" />
	            <label for="mp_wpauthmethod_phone"><span class="description"><?php _e("Phone (TEXT/SMS) only", "mp_wpauth"); ?></span></label>
	            <br/>	
	                        	            
	        <input type="radio" name="mp_wpauthmethod" id="mp_wpauthmethod_both" <?php if($wp_mpauthmethod == 'both') { echo 'checked="checked"'; } ?>class="" 
	            value="both" />
	            <label for="mp_wpauthmethod_both"><span class="description"><?php _e("Both email and phone (TEXT/SMS)", "mp_wpauth"); ?></span></label>
*/
?>

	    </td>
	      </tr>	    
	  </table>
	<?php
	}
	
	/**
	 * Stores profile data
	 */
	public function save_profile_field( $user_id ) {
		$saved = false;
		if ( current_user_can( 'edit_user', $user_id ) ) {
		$phone = preg_replace("/[^\d.]/i", "", $_POST['mp_wpauthphone']);
		// Cleanup some more
		$phone = ltrim($phone,'+');
	  	update_user_meta( $user_id, 'mp_wpauthphone', $phone);
		if(empty($phone) && in_array($_POST['mp_wpauthmethod'], array('both','phone')))
	  	{
	  			update_user_meta( $user_id, 'mp_wpauthmethod', 'email');
	  	}
	  	else
	  	{
	  		update_user_meta( $user_id, 'mp_wpauthmethod', esc_attr($_POST['mp_wpauthmethod']));
	  	}
	    $saved = true;
	  }
	  return true;
	}	

	/**
	 * @param mixed $user
	 * @param string $username
	 * @param string $password
	 * @uses XMLRPC_REQUEST, APP_REQUEST, this::user_has_mp_wpauth_id, this::get_user_mp_wpauth_id, this::api::check_token
	 * @return mixed
	 */
	public function authenticate_user( $user = '', $username = '', $password = '' ) {
		// If XMLRPC_REQUEST is disabled stop
		if ( ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) || ( defined( 'APP_REQUEST' ) && APP_REQUEST ) ) {
			return $user;
		}

		$step = isset( $_POST['step'] ) ? $_POST['step'] : null;
		$signature = isset( $_POST['mp_wpauth_signature'] ) ? $_POST['mp_wpauth_signature'] : null;
		$mp_wpauth_user_info = isset( $_POST['mp_wpauth_user'] ) ? $_POST['mp_wpauth_user'] : null;
		$remember_me = isset( $_POST['rememberme'] ) ? $_POST['rememberme'] : null;

		if ( !empty( $username ) ) {
			return $this->verify_password_and_redirect( $user, $username, $password, $_POST['redirect_to'], $remember_me );
		}

		if(isset($_POST) && is_array($_POST) && count($_POST) > 1 )
		{
			if( !isset( $signature)) {
				return new WP_Error( 'authentication_failed', __( '<strong>ERROR: missing credentials</strong>' ) );
			}
	
			$mp_wpauth_token = isset( $_POST['mp_wpauth_token'] ) ? $_POST['mp_wpauth_token'] : null;
	
			if ( empty( $step ) && $mp_wpauth_token )
			{
				$user = get_user_by( 'login', $_POST['username'] );
				// This line prevents WordPress from setting the authentication cookie and display errors.
				remove_action( 'authenticate', 'wp_authenticate_username_password', 20 );
	
				$redirect_to = isset( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : null;
				return $this->login_with_2FA( $user, $signature, $mp_wpauth_token, $redirect_to, $remember_me );
			}
	
			return new WP_Error( 'authentication_failed', __( '<strong>ERROR</strong>' ) );
		}
		return $user;
	}


    /**
     * Login user with Authy Two Factor Authentication
     *
     * @param mixed $user
     * @return mixed
     */
    public function login_with_2FA( $user, $signature, $mp_wpauth_token, $redirect_to, $remember_me ) {
    	// Do 2FA if signature is valid.
        if ($this->verify_signature( get_user_meta( $user->ID, 'mp_wpauth_signature', true ), $signature))  {
            // invalidate signature
            update_user_meta( $user->ID, 'mp_wpauth_signature', array( 'mp_wpauth_signature' => $this->generate_signature(), 'signed_at' => null ) );
            // Check the specified token
            if($this->verify_token($user->ID,$mp_wpauth_token)) {
                // If remember me is set the cookies will be kept for 14 days.
                $remember_me = ($remember_me == 'forever') ? true : false;
                wp_set_auth_cookie( $user->ID, $remember_me ); // token was checked so go ahead.
                wp_safe_redirect( $redirect_to );
                exit(); // redirect without returning anything.
            }
        	return new WP_Error( 'authentication_failed', __( '<strong>ERROR</strong> Invalid token. Please try again.', 'mp_wpauth' ) );
        }
        return new WP_Error( 'authentication_failed', __( '<strong>ERROR</strong> Authentication timed out. Please try again.', 'mp_wpauth' ) );
    }	
    
    private function verify_token($user_id,$token_entere)
    {
    	// Get token from DB
    	$token_stored = $this->decode_token($user_id, get_user_meta( $user_id, 'mp_wpauth_token', true ));
    	// Remove token
    	delete_user_meta($user_id, 'mp_wpauth_signature');
    	delete_user_meta($user_id, 'mp_wpauth_token');

    	if($token_stored == $token_entere)
    	{
    		return true;
    	}
    	return false;
    }
    /**
     * Retrieve a given user's Authy ID
     *
     * @param int $user_id
     * @uses this::get_mp_wpauth_data
     * @return int|null
     */
    private function get_user_mp_wpauth_id( $user_id ) {
        $data = $this->get_mp_wpauth_data( $user_id );

        if ( is_array( $data ) && is_numeric( $data['mp_wpauth_id'] ) ) {
            return (int) $data['mp_wpauth_id'];
        }

        return null;
    }
        
  /**
  * Verify if the given signature is valid.
  * @return boolean
  */
  private function verify_signature($user_data, $signature) {

	if(!isset($user_data['mp_wpauth_signature'])  || !isset($user_data['signed_at']) ) {
  		return false;
	}

    if((time() - $user_data['signed_at']) <= 300 && $user_data['mp_wpauth_signature'] === $signature ) {
    	return true;
    }

    return false;
  }    
    
	/**
	 * Do password authentication and redirect to 2nd screen
	 *
	 * @param mixed $user
	 * @param string $username
	 * @param string $password
	 * @param string $redirect_to
	 * @return mixed
	 */
	public function verify_password_and_redirect( $user, $username, $password, $redirect_to, $remember_me ) {
		$userWP = get_user_by( 'login', $username );
		// Don't bother if WP can't provide a user object.
		if ( ! is_object( $userWP ) || ! property_exists( $userWP, 'ID' ) ) {
			return $userWP;
		}

		if(!$this->has_any_auth($userWP))
		{
			return $user; 
		}

		// from here we take care of the authentication.
		remove_action( 'authenticate', 'wp_authenticate_username_password', 20 );
		$ret = wp_authenticate_username_password( $user, $username, $password );
		if ( is_wp_error( $ret ) ) {
			return $ret; // there was an error
		}

		$user = $ret;
		$this->signature_key = $this->generate_signature(64, true);
		update_user_meta( $user->ID, 'mp_wpauth_signature', array( 'mp_wpauth_signature' => $this->signature_key, 'signed_at' => time() ) );

		$this->token = $this->generate_token(6);
		update_user_meta( $user->ID, 'mp_wpauth_token', $this->encode_token($user->ID,$this->token));

		$this->sent_token($user->ID, $this->token);
		$this->render_mp_wpauth_token_page( $user, $redirect_to, $remember_me ); // Show the authy token page

		exit();
	}

	/**
	 * Sends out token
	 * @param unknown_type $userid
	 * @param unknown_type $token
	 */
	private function sent_token($userid, $token)
	{
		$user_info = get_userdata($userid);

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

		$extra .= 'WordPress gebruiker: '. $userid .' : '.htmlspecialchars($user_info->user_login)."\r\n";
		$extra .= 'Referrer: '. htmlspecialchars($_SERVER['HTTP_REFERER'])."\r\n";
		$extra .= 'User agent: '. htmlspecialchars($_SERVER['HTTP_USER_AGENT'])."\r\n\r\n";
		$extra .= 'Was u of uw webbeheerder niet aan het inloggen? Stuur dit bericht dan door naar uw webhost';

		wp_mail($user_info->user_email, __( "Your token", 'mp_wpauth' ), $token.$extra);
	}
	
	/**
	 * Provides salts
	 */
	private function token_salt($userid)
	{
		return $userid.md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_X_FORWARDED_FOR']);
	}
	
	private function encode_token($userid, $token)
	{
		return base64_encode($this->token_salt($userid). $token);
	}
	
	private function decode_token($userid, $token)
	{
		$token = base64_decode($token);
		return str_replace($this->token_salt($userid),'',$token);
	}
	
	/**
	 * Render the Two factor authentication page
	 *
	 * @param mixed $user
	 * @param string $redirect
	 * @uses _e
	 * @return string
	 */
	public function render_mp_wpauth_token_page( $user, $redirect, $remember_me ) {
		$username = $user->user_login;
		$user_data = $this->get_mp_wpauth_data( $user->ID );
		$user_signature = get_user_meta( $user->ID, 'mp_wpauth_signature', true );
		$this->mp_wpauth_token_form( $username, $user_data, $user_signature, $redirect, $remember_me );
	}

    /**
     * Retrieve a user's Authy data
     *
     * @param int $user_id
     * @uses get_user_meta, wp_parse_args
     * @return array
     */
    private function get_mp_wpauth_data( $user_id ) {
        // Bail without a valid user ID
        if ( ! $user_id ) {
            return $this->user_defaults;
        }

        // Get meta, which holds all Authy data by API key
        $data = get_user_meta( $user_id, $this->users_key, true );
        if ( ! is_array( $data ) ) {
            $data = array();
        }

        // Return data for this API, if present, otherwise return default data
        if ( array_key_exists( $this->api_key, $data ) ) {
            return wp_parse_args( $data[ $this->api_key ], $this->user_defaults );
        }

        return $this->user_defaults;
    }
    	

	/**
	* Generates human readable token, code from http://stackoverflow.com/questions/4356289/php-random-string-generator
	*/
	private function generate_token($length=6,$characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ')
	{
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	private function generate_signature($length=30, $include_standard_special_chars=false)
	{
		return wp_generate_password($length, $include_standard_special_chars, false);
	}

	/**
	 * Header for authy pages
	 * @deprecated 
	 */
	function mp_wpauth_header( $step = '' ) { ?>
<head>
	<?php
	global $wp_version;
	if ( version_compare( $wp_version, '3.3', '<=' ) ) {?>
<link rel="stylesheet" type="text/css"
	href="<?php echo admin_url( 'css/login.css' ); ?>" />
<link rel="stylesheet" type="text/css"
	href="<?php echo admin_url( 'css/colors-fresh.css' ); ?>" />
	<?php
	} else {
		?>
<link rel="stylesheet" type="text/css"
	href="<?php echo admin_url( 'css/wp-admin.css' ); ?>" />
<link rel="stylesheet" type="text/css"
	href="<?php echo includes_url( 'css/buttons.css' ); ?>" />
<link rel="stylesheet" type="text/css"
	href="<?php echo admin_url( 'css/colors-fresh.css' ); ?>" />
		<?php
	}
	?>
</head>
	<?php }

	/**
	 * Generate the authy token form
	 * @param string $username
	 * @param array $user_data
	 * @param array $user_signature
	 * @return string
	 */
	function mp_wpauth_token_form( $username, $user_data, $user_signature, $redirect, $remember_me ) {?>
<?php
if(function_exists('login_header')) {
	login_header(__('Login, step 2: Two-Factor Authentication','mp_wpauth'));
} else {
	echo $this->mp_wpauth_header(); 
}
?>
<h3 style="text-align: center; margin-bottom: 10px;"><?php _e('Login, step 2: Two-Factor Authentication','mp_wpauth'); ?></h3>
<p class="message"><?php _e( "You will recieve a token by medium you have selected. If none was selected, the token will be sent by email.<br/>Tokens are best copy pasted, not to be typed in manually", 'mp_wpauth' ); 
?><br/>
<strong>
<?php
$mp_token_url_title = __('Read more about 2 factor email and TXT login, a service by ManagedWPhosting.nl and MijnPress.nl','mp_wpauth');
?>
<a target="_blank" href="http://www.mijnpress.nl/diensten/2-factor-sms-login/" title="<?php echo $mp_token_url_title; ?>"><?php echo $mp_token_url_title; ?></a>
</strong></p>

<form method="POST" id="authy" action="wp-login.php"><label
	for="mp_wpauth_token"> <?php _e( 'Please enter your token', 'mp_wpauth' ); ?> <br/>
	<br/>
<input type="text" name="mp_wpauth_token" id="authy-token" class="input"
	value="" size="20" autofocus="true" /> </label> <input type="hidden"
	name="redirect_to" value="<?php echo esc_attr( $redirect ); ?>" /> <input
	type="hidden" name="username"
	value="<?php echo esc_attr( $username ); ?>" /> <input type="hidden"
	name="rememberme" value="<?php echo esc_attr( $remember_me ); ?>" /> <?php if ( isset( $user_signature['mp_wpauth_signature'] ) && isset( $user_signature['signed_at'] ) ) { ?>
<input type="hidden" name="mp_wpauth_signature"
	value="<?php echo esc_attr( $user_signature['mp_wpauth_signature'] ); ?>" />
<?php } ?>
<p class="submit"><input type="submit"
	value="<?php echo esc_attr_e( 'Login', 'mp_wpauth' ) ?>" id="wp_submit"
	class="button button-primary button-large" /></p>
</form>
</div>
<?php
if(function_exists('login_footer')) {
	login_footer('user_login');
} else { 

}
 }
}


// User whished to disable the 2factor login
if(!(defined('MP_NO_MPAUTH') && MP_NO_MPAUTH == true))
{
	add_action('init',array('mp_wpauth','init'));
}
