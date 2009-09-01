<div class="wrap">
	<h2 id="write-post">In-post Template</h2>
	<p>In-post Template will add extra data inside post content.</p>

	<h3>In-post Template Preferences</h3>
	<form method="post" action="options.php">
	<?php settings_fields('wp_ipt_options'); ?>
	<table class="form-table">
	<tbody><tr>
		<th>In-post Content:</th>
		<td>
			<textarea name="wp_ipt_content" cols="60" rows="10"><?php echo get_option('wp_ipt_content'); ?></textarea>
		</td>
	</tr></tbody>
	</table>
	<p class="submit">
	<input type="submit" value="<?php _e('Save Changes'); ?>" />
	</p>
	</form>
</div>

