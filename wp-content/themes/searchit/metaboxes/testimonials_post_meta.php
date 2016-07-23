<div class="my_meta_control">

<?php 
	
	$mb->the_field('testimonials-check'); ?>
	<label>Goes to home page?</label>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/> Yes

</div>