<div class="my_meta_control">
<label>Sub Title</label>
<?php 
	$mb->the_field('galleries-sub-title');
	?><textarea name="<?php $metabox->the_name(); ?>" rows="2"><?php $mb->the_value(); ?></textarea><?php
?>
<label>Column 1</label>
<?php 
	$mb->the_field('galleries-column1');
	$mb_content1 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
	$mb_editor_id1 = sanitize_key($mb->get_the_name());
	$mb_settings1 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '15', 'wpautop' => true,);
	wp_editor( $mb_content1, $mb_editor_id1, $mb_settings1 );
?>   

<label>Column 2</label>
<?php 
	$mb->the_field('galleries-column2');
	$mb_content2 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
	$mb_editor_id2 = sanitize_key($mb->get_the_name());
	$mb_settings2 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '15', 'wpautop' => true,);
	wp_editor( $mb_content2, $mb_editor_id2, $mb_settings2 );
?>   


</div>