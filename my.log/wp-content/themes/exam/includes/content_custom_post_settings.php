<div class="titan-custom-posts-settings">
	<h2>Titan Custom Posts Settings</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'titan-custom-post-settings-group' ); ?>
		<?php do_settings_sections( 'titan-custom-post-settings-group' ); ?>
		<table class="form-table" style="width: 30%">
			<thead>
				<tr>
					<td style="font-weight: bold;">Custom Post Type</td>
					<td style="font-weight: bold;">Assigned Page</td>
				</tr>
			</thead>
			<?php
				// Construct the options for the pages
				$pages = get_pages();
				$options = '<option value="0"> -- Select Page -- </option>';
				foreach($pages as $page)
					$options .= '<option value="'. $page->ID .'">'. $page->post_title .'</option>';
					
				
				global $titan_custom_post_types;
				$html = '';
				foreach($titan_custom_post_types as $post_type) {
					$option_value = get_option('titan_'.$post_type);
					$html .= '
					<tr>
						<td>'. $post_type .'</td>
						<td>
							<select name="titan_'.$post_type.'">
								'. str_replace('"'.$option_value.'"','"'.$option_value.'" selected="selected"',$options) .'
							</select>
						</td>
					</tr>
					';
				}
				
				echo $html;
			?>
		</table>
		
		<?php submit_button(); ?>

	</form>
</div>