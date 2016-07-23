	<footer>
		<div class="footer-up">
			<div class="row">
				<div class="col-l-1-of-4 col-s-1-of-2 col-xs-1-of-1 footer-section">
					<hr>
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-l-1-of-4 col-s-1-of-2 col-xs-1-of-1 footer-section">
					<hr>
					<span><?php echo __('Recent Jobs', 'searchit'); ?></span>
					<?php 
						$args=array(
						  'post_type' => 'post',
						  'post_status' => 'publish',
						  'posts_per_page' => 12,
						);
						$post_query = null;
						$post_query = new WP_Query($args);
					?>
					<div class="textwidget">
						<p>
						<?php if ( $post_query->have_posts() ) : ?>
							<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
							<?php endwhile; ?>
						<?php endif; ?>
						</p>
					</div>
				</div>
				<div class="col-l-1-of-4 col-s-1-of-2 col-xs-1-of-1 footer-section">
					<hr>
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-l-1-of-4 col-s-1-of-2 col-xs-1-of-1 footer-section">
					<hr>
					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-4' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="footer-down">
			
		</div>
	</footer>
	</div> <!-- wrapper end -->
	<?php wp_footer(); ?>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '382574281913074',
	      xfbml      : true,
	      version    : 'v2.5'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));

	  function myFacebookLogin() {
		FB.login(function(response){
		  if (response.status === 'connected') {
		    console.log('Logged in.');
		    FB.api('/me', {fields: 'name, email, location, gender'}, function(response1){
		    	// console.log(response1['name']);
		    	$('.apply-form').find('input.name').val(response1['name']);
		    	$('.apply-form').find('input.email').val(response1['email']);
		    	$('.apply-form').find('input.address').val(response1['location']);
		    	$('.apply-form').find('input.gender').val(response1['gender']);
		    });
		    FB.api('/me/picture',{"redirect": false, "height": 200, "width": 200, "type": "normal"}, function(response2){
		    	// console.log(response2['data']['url']);
		    	$('.apply-form').find('input.photo-url').val(response2['data']['url']);
		    	if((response2['data']['url']).length){
		    		$('.apply-form').find('#labelP').css('background-image', 'url('+response2['data']['url']+')');
		    		$('.photoLabel').text('');
		    		$('.apply-form').find('.photo-file').val('');
		    	}
		    });
		  }
		  else {
		    FB.login();
		  }
		}, {scope: 'publish_actions'} );
	}
	</script>
	<script type="text/javascript" src="//platform.linkedin.com/in.js">
	    $(window).on('load', function() {
	    	api_key: 77dug7ogaz4ouh
		    onLoad: OnLinkedInFrameworkLoad
		    authorize: true
	    });
	</script>
	<script type="text/javascript">
		function liAuth(){
		   IN.User.authorize(function(){
		       onLinkedInLoad();
		   });
		}

		function OnLinkedInFrameworkLoad() {
		  IN.Event.on(IN, "auth", onLinkedInLoad);
		}
		// Setup an event listener to make an API call once auth is complete
	    function onLinkedInLoad() {
	        IN.API.Profile("me").result(getProfileData);
	    }

	    // Handle the successful return from the API call
	    function onSuccess(data) {
	        console.log(data);
	        $('.apply-form').find('input.name').val(data['firstName']+' '+data['lastName']);
	        $('.apply-form').find('input.photo-url').val(data['pictureUrl']);
	    	if((data['pictureUrl']).length){
	    		$('.apply-form').find('#labelP').css('background-image', 'url('+data['pictureUrl']+')');
	    		$('.photoLabel').text('');
	    		$('.apply-form').find('.photo-file').val('');
	    	}
	    }

	    // Handle an error response from the API call
	    // function onError(error) {
	    //     console.log(error);
	    // }

	    // Use the API call wrapper to request the member's basic profile data
	    function getProfileData() {
	        IN.API.Raw("/people/~:(first-name,last-name,picture-url)").result(onSuccess);
	    }
	</script>
</body>
</html>