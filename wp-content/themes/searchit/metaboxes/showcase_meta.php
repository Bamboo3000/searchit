<div class="my_meta_control">
	<?php $options = array('length' => 2, 'limit' => 20); ?>
    <?php while($mb->have_fields_and_multi('showcase_multi')): ?>
    <?php $mb->the_group_open(); ?>
        <p>
			<?php $mb->the_field('showcase'); ?>
			<select name="<?php $mb->the_name(); ?>">
			<option value="none">None</option>

			<?php

			global $thispost;
			$myposts = get_posts('post_type=paintings&posts_per_page=-1');

			foreach($myposts as $thispost) : ?>

			<option value="<?php echo $thispost->ID; ?>" <?php $mb->the_select_state($thispost->ID);?> ><?php echo get_the_title($thispost->ID); ?></option>

			<?php endforeach; ?>
			<?php setup_postdata($thispost); ?>
			</select>
			<a href="#" class="dodelete button">Remove field</a>
		</p>
 
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
	<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-showcase_multi button">Add field</a></p>
 
</div>