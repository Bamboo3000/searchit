<div class="my_meta_control">
	
	<label>Selected text</label>
	<p>
		<?php $mb->the_field('selected'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	</p>

</div>