<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="text" value="Search" onfocus="if( this.value == this.defaultValue ) this.value = ''" onblur="if( this.value == '' ) this.value = this.defaultValue" name="s" id="s" class="search-text" />
	<button type="submit" id="searchsubmit" class="searchsubmit" name="searchsubmit">Search</button>
</form>