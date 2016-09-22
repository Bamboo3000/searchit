<?php 

add_filter( 'cron_schedules', 'example_add_cron_interval' );
function example_add_cron_interval( $schedules ) {
    $schedules['five_minutes'] = array(
        'interval' => 300,
        'display'  => esc_html__( 'Every Five Minutes' ),
    );
    return $schedules;
}

if ( !wp_next_scheduled('moja_akcja') ) {
	wp_schedule_event( time(), 'five_minutes', 'moja_akcja' );
}


add_action( 'moja_akcja', 'moja_funkcja' );

function moja_funkcja() {
	
	$file = 'http://external.srch20.com/searchit/xml/jobs';
	$xml = simplexml_load_file($file) or die("Error: Cannot create object");
	$vacancy = $xml->vacancy;
	
	foreach($vacancy as $vacant) :
		$postTitle = wp_strip_all_tags($vacant->title);
		$postContent = $vacant->description;
		$publishDate = $vacant->publish_date;
		$updateDate = (string)$vacant->publish_date;
		$vacantCategory = $vacant->categories->category;
		$jobAddress = (string)$vacant->address;
		$jobSalaryMin = (string)$vacant->salary_fixed;
		$jobSalaryMax = (string)$vacant->salary_bonus;
		$jobSMin = str_replace(".", "", $jobSalaryMin);
		$jobSMax = str_replace(".", "", $jobSalaryMax);
		$jobID = (string)$vacant->id;
		$jobLat = (string)$vacant->lat;
		$jobLng = (string)$vacant->lng;
		$postNameDev = str_replace(" ", "-", $postTitle . " " . $jobID); 
		$postName = filter_var($postNameDev, FILTER_SANITIZE_URL);

		foreach($vacantCategory as $sCat) :
			if($sCat['group'] == '#2 Skill Area'){
				if($sCat == 'Sales' || $sCat == 'Recruitment'){
					$catid = get_cat_ID( 'Recruitment and Sales' );	
				} else {
					$catid = get_cat_ID( $sCat );
				}
			}
		endforeach;
		$allCat = get_cat_ID( 'All' );

		foreach($vacantCategory as $sCat) :
			if($sCat['group'] == '#1 Availability'){
				$jobType = (string)$sCat;
			}
		endforeach;

		$date_str1 = substr($publishDate, 0, 10);
		$date_str2 = substr($publishDate, 11, 18);
		$date1 = (explode("-", $date_str1));
		$dateF = $date1[2] . "-" . $date1[1] . "-" . $date1[0] . " " . $date_str2;

		$existing = post_exists( $postTitle, NULL, $dateF );
		$cron_jobID = get_post_meta( $existing, 'job_id', TRUE );
		$upd_date = get_post_meta( $existing, 'job_date', TRUE );

		query_posts('meta_key=job_id&meta_value=' . $jobID . '');
		if (have_posts()) :
			while (have_posts()) : the_post();
		    	$existingID = get_the_ID();
		    endwhile;
		endif;


		if($cron_jobID === $jobID && $dateF !== $upd_date) {

			$postarrup = array(
				'ID' => $existingID,
				'post_title' => $postTitle,
				'post_name' => $postName,
				'post_content' => $postContent,
				'post_status' => 'publish',
				'post_category' => array($allCat, $catid,),
			);
			wp_update_post( $postarrup );
			__update_post_meta( $existing, 'job_date', $updateDate );
			__update_post_meta( $existing, 'job_location', $jobAddress );
			__update_post_meta( $existing, 'job_type', $jobType );
			__update_post_meta( $existing, 'job_salary_min', $jobSMin );
			__update_post_meta( $existing, 'job_salary_max', $jobSMax );
			__update_post_meta( $existing, 'job_lat', $jobLat );
			__update_post_meta( $existing, 'job_lng', $jobLng );

		} else {
			
			if(!empty($existingID)) {

				$postarrup = array(
					'ID' => $existingID,
					'post_title' => $postTitle,
					'post_name' => $postName,
					'post_content' => $postContent,
					'post_status' => 'publish',
					'post_category' => array($allCat, $catid,),
				);
				wp_update_post( $postarrup );
				__update_post_meta( $existing, 'job_id', $jobID );
				__update_post_meta( $existing, 'job_date', $updateDate );
				__update_post_meta( $existing, 'job_location', $jobAddress );
				__update_post_meta( $existing, 'job_type', $jobType );
				__update_post_meta( $existing, 'job_salary_min', $jobSMin );
				__update_post_meta( $existing, 'job_salary_max', $jobSMax );
				__update_post_meta( $existing, 'job_lat', $jobLat );
				__update_post_meta( $existing, 'job_lng', $jobLng );

			} elseif ($existing !== 0) {

				$postarrup = array(
					'ID' => $existing,
					'post_title' => $postTitle,
					'post_name' => $postName,
					'post_content' => $postContent,
					'post_status' => 'publish',
					'post_category' => array($allCat, $catid,),
				);
				wp_update_post( $postarrup );
				__update_post_meta( $existing, 'job_id', $jobID );
				__update_post_meta( $existing, 'job_date', $updateDate );
				__update_post_meta( $existing, 'job_location', $jobAddress );
				__update_post_meta( $existing, 'job_type', $jobType );
				__update_post_meta( $existing, 'job_salary_min', $jobSMin );
				__update_post_meta( $existing, 'job_salary_max', $jobSMax );
				__update_post_meta( $existing, 'job_lat', $jobLat );
				__update_post_meta( $existing, 'job_lng', $jobLng );

			} else {

				$postarr = array(
					'post_title' => $postTitle,
					'post_name' => $postName,
					'post_content' => $postContent,
					'post_status' => 'publish',
					'post_date' => $dateF,
					'post_type'	=> 'post',
					'post_author' => 1,
					'post_category' => array($allCat, $catid,),
				);
				wp_insert_post( $postarr );

			}

		}
	endforeach;

	$wparray = array();
	$cronarray = array();

	foreach($vacancy as $vacant) :
		$jobID = (string)$vacant->id;
		array_push($cronarray, $jobID);
	endforeach;

	$args=array(
	  'post_type' => 'post',
	  'post_status' => 'publish',
	  'posts_per_page' => -1,
	);
	$cron_query = null;
	$cron_query = new WP_Query($args);
	if ( $cron_query->have_posts() ) :
		while ( $cron_query->have_posts() ) : $cron_query->the_post();
			
			$wp_job_id = get_post_meta( get_the_ID(), 'job_id', TRUE );
			array_push($wparray, $wp_job_id);

		endwhile;
	endif;

	$diffarray = array_diff($wparray, $cronarray);

	foreach($diffarray as $diff) {

		query_posts('meta_key=job_id&meta_value=' . $diff . '');
		if (have_posts()) :
			while (have_posts()) : the_post();
		    	$existingID = get_the_ID();
		    endwhile;
		endif;

		echo $existingID . '\r\n';
		
		$cat = get_cat_ID('Fulfilled');

		$postarrup = array(
			'ID' => $existingID,
			'post_category' => array($cat),
		);
		wp_update_post( $postarrup );

	}
	

}

if ( ! function_exists( 'post_exists' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}

function __update_post_meta( $post_id, $field_name, $value = '' ){
    if ( empty( $value ) OR ! $value ){
        delete_post_meta( $post_id, $field_name );
    } elseif ( ! get_post_meta( $post_id, $field_name ) ){
        add_post_meta( $post_id, $field_name, $value );
    } else{
        update_post_meta( $post_id, $field_name, $value );
    }
}
function __delete_post_meta( $post_id, $field_name, $value = '' ){
    delete_post_meta( $post_id, $field_name );
}

?>