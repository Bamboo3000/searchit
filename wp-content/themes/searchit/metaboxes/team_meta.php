<div class="my_meta_control">

<p>Phone</p>
<?php 
	$mb->the_field('team_phone');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
?>
<p>E-mail</p>
<?php 
	$mb->the_field('team_email');
	?><input name="<?php $metabox->the_name(); ?>" value="<?php $mb->the_value(); ?>" style="width:80%;"><?php
?>
<br/>
<br/>
<p>Bio</p>
<?php 
	$mb->the_field('team_bio');
	$mb_content1 = html_entity_decode($mb->get_the_value(), ENT_QUOTES, 'UTF-8');
	$mb_editor_id1 = sanitize_key($mb->get_the_name());
	$mb_settings1 = array('textarea_name'=>$mb->get_the_name(),'textarea_rows' => '10', 'wpautop' => true,);
	wp_editor( $mb_content1, $mb_editor_id1, $mb_settings1 );
?>  
<br/>

</div>