<div class="my_meta_control">

    <p>
		<?php $mb->the_field('module_link'); ?>
		<label>Module link</label>
		<textarea name="<?php $mb->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea>
	</p>
	<label>Open in new tab?</label><br/>
	<?php $mb->the_field('is_new_tab'); ?>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="new_tab"<?php $mb->the_checkbox_state('new_tab'); ?>/>Yes<br/>
 
</div>