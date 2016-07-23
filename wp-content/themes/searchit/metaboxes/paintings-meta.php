<div class="my_meta_control">
	
	<label>Painting Data</label>
	<p>
		<?php $mb->the_field('title'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		<span>Enter in a title</span>
	</p><br/>
	
	<label>Painting Description</label>
	<p>
		<?php $mb->the_field('description'); ?>
		<textarea name="<?php $mb->the_name(); ?>" rows="3"><?php $mb->the_value(); ?></textarea>
		<span>Enter in a description</span>
	</p><br/>

	<label>Do not show this on Paintings?</label><br/>
	<?php $mb->the_field('not_main'); ?>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="not_main"<?php $mb->the_checkbox_state('not_main'); ?>/>Yes<br/>
	<br/>
	<hr>
	<br/>

	<label>Is sold?</label><br/>
	<?php $mb->the_field('is_sold'); ?>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="sold"<?php $mb->the_checkbox_state('sold'); ?>/>Yes<br/>
	<br/>
	<hr>
	<br/>


	<label>Goes to private?</label><br/>
	<?php $mb->the_field('is_private'); ?>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="private"<?php $mb->the_checkbox_state('private'); ?>/>Yes<br/>
	<br/>
	<label>Price</label>
	<p>
		<?php $mb->the_field('price'); ?>
		$<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		<span>Enter in a price</span>
	</p><br/>

</div>