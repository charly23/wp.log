<div id="sidebar" class="sidebar-wrapper col-lg-3">
	<div class="sidebar-pad">

		<div class="sidebar-wrap">
			<div class="sidebar <?php if (is_front_page()) { echo "front-page"; } else { echo "sub-page"; } ?>">
				<?php dynamic_sidebar('first-widget-area'); ?>
			</div>
		</div>

	</div>
</div>