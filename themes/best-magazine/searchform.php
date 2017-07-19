<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div id="searchbox">
		<div class="searchback">
			<input  type="text" id="searchinput" value="<?php echo get_search_query(); ?>" name="s" id="s" class="searchbox_search" placeholder="<?php echo __('Type here', "best-magazine"); ?>"/> 
			<input type="submit" id="searchsubmit" value="<?php echo esc_attr_e('Search', "best-magazine"); ?>" class="read_more" style="" />
		</div>
	</div>
</form>