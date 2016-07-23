// window.fbAsyncInit = function() {
// FB.init({
//   appId: '382574281913074',
//   cookie: true, // This is important, it's not enabled by default
//   version: 'v2.5'
// });
// };

// logInWithFacebook = function() {
// 	FB.login(function(response) {
// 	  if (response.authResponse) {
// 	    alert('You are logged in &amp; cookie set!');
// 	    $.ajax({ 
// 	    	type: 'POST',
// 	    	url : 'https://www.searchitrecruitment.com/wp-content/themes/searchit/functions.php',
// 	    	data: {
// 	    		action : 'loginFB',
// 	    	},
// 	   //  	success : function( response ) {
// 				// $('.CURL').html( response );
// 	   //  	},
// 	   	});
// 	    // Now you can redirect the user or do an AJAX request to
// 	    // a PHP script that grabs the signed request from the cookie.
// 	  } else {
// 	    alert('User cancelled login or did not fully authorize.');
// 	  }
// 	});
// 	return false;
// };

// (function(d, s, id){
// var js, fjs = d.getElementsByTagName(s)[0];
// if (d.getElementById(id)) {return;}
// js = d.createElement(s); js.id = id;
// js.src = "//connect.facebook.net/en_US/sdk.js";
// fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));