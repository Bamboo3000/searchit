<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="text" class="search-field" value="<?php echo __('Search for a job...', 'searchit'); ?>" name="s" onclick="if(this.defaultValue==this.value){ this.value='<?php echo get_search_query() ?>'}" onblur="if(this.value===''){this.value=this.defaultValue}">
	<input type="submit" class="search-submit" value="">
</form>