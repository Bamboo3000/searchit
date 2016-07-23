<section class="apply-form-section">
	<div class="row">
		<div class="col-xs-1-of-1">
			<?php
				$job_id_meta = get_post_meta(get_the_ID(), 'job_id', true); 
				if(!empty($job_id_meta)) : 
			?>
				<h3>
					<?php echo __('Apply for this job!', 'searchit'); ?>
				</h3>
				<hr class="job-green">
				<?php $jobID = get_post_meta(get_the_ID(), 'job_id', true); ?>
			<?php else : ?>
				<h3>
					<?php echo __('Upload your cv', 'searchit'); ?>
				</h3>
				<hr class="green">
				<?php $jobID = 0; ?>
			<?php endif; ?>
		</div>
	</div>
	<form action="<?php echo get_template_directory_uri(); ?>/includes/form.php" method="post" enctype="multipart/form-data" class="apply-form">
		<input type="hidden" name="job-id" class="job-id" value="<?php echo $jobID; ?>">
		<input type="hidden" name="gender" class="gender">
		<input type="text" name="name" class="name" placeholder="<?php echo __('Name*', 'searchit'); ?>" required>
		<input type="file" name="photo" accept="image/*" class="photo photo-file" onchange="readURL(this)">
		<input type="text" name="photoURL" class="photo photo-url">
		<label for="photo" id="labelP" class="input photoLabel"><?php echo __('Choose your photo', 'searchit'); ?></label>
		<input type="text" name="address" class="address" placeholder="<?php echo __('Address', 'searchit'); ?>">
		<input type="email" name="email" class="email" required  placeholder="<?php echo __('Email*', 'searchit'); ?>">
		<input type="text" name="phone" class="phone" placeholder="<?php echo __('Phone', 'searchit'); ?>">
		<input type="file" name="cv-file" id="cv-file" accept=".pdf" class="cv">
		<label for="cv" class="input cvLabel"><?php echo __('Choose your cv file', 'searchit'); ?></label>
		<div class="applyFB" onclick="myFacebookLogin()"><?php echo __('Apply with Facebook', 'searchit'); ?></div>
		<textarea name="message" class="message" placeholder="<?php echo __('Motivation and extra details', 'searchit'); ?>"></textarea>
		<div class="applyLI" onclick="liAuth()"><?php echo __('Apply with LinkedIn', 'searchit'); ?></div>
		<input type="submit" value="<?php echo __('Apply', 'searchit'); ?>" class="submit">
	</form>
</section>