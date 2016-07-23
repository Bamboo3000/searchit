<?php 
/*
Template Name: Test
*/
 ?>
<?php get_header(); ?>
<div class="test-container">
	<?php// get_template_part('templates/apply', 'form'); ?>
	<?php 
		$file = 'http://external.srch20.com/searchit/xml/jobs';
		$xml = simplexml_load_file($file) or die("Error: Cannot create object");
		$vacancy = $xml->vacancy;
		foreach($vacancy as $vacant) :
			$postTitle = wp_strip_all_tags($vacant->title);
			$postContent = $vacant->description;
			$publishDate = $vacant->publish_date;
			$existing = post_exists( $postTitle );
			$vacantCategory = $vacant->categories->category;
			$jobAddress = (string)$vacant->address;
			$jobSalaryMin = (string)$vacant->salary_fixed;
			$jobSalaryMax = (string)$vacant->salary_bonus;
			$jobID = (string)$vacant->id;

			$newSMin = str_replace('.', '', $jobSalaryMin);
			$newSMax = str_replace('.', '', $jobSalaryMax);
			var_dump($jobSalaryMin);
			var_dump((string)$newSMin);
		endforeach;

	 ?>
</div>
<?php get_footer('jobs'); ?>