<?php
/**
 * HTML markup for Settings page.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wrap">
	<h1><?php _e('WC Ajax Layered Navigation with Multi-Select Filters', WCHWEB_LOCALE); ?></h1>
	<form method="post" action="options.php">
		<?php
		settings_fields('wchweb_settings');
		do_settings_sections('wchweb_settings');

		// check if filter is applied
		$settings = apply_filters('wchweb_settings', get_option('wchweb_settings'));
		?>

		<?php if (has_filter('wchweb_settings')): ?>
			<p><span class="dashicons dashicons-info"></span> <?php _e('Filter has been applied and that may modify the settings below.', WCHWEB_LOCALE); ?></p>
		<?php endif ?>

		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Shop loop container', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="text" name="wchweb_settings[shop_loop_container]" size="50" value="<?php echo esc_attr($settings['shop_loop_container']); ?>">
					<br />
					<span><?php _e('Selector for tag that is holding the shop loop. Most of cases you won\'t need to change this.', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('No products container', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="text" name="wchweb_settings[not_found_container]" size="50" value="<?php echo esc_attr($settings['not_found_container']); ?>">
					<br />
					<span><?php _e('Selector for tag that is holding no products found message. Most of cases you won\'t need to change this.', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Pagination container', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="text" name="wchweb_settings[pagination_container]" size="50" value="<?php echo esc_attr($settings['pagination_container']); ?>">
					<br />
					<span><?php _e('Selector for tag that is holding the pagination. Most of cases you won\'t need to change this.', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Overlay background color', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="text" name="wchweb_settings[overlay_bg_color]" size="50" value="<?php echo esc_attr($settings['overlay_bg_color']); ?>">
					<br />
					<span><?php _e('Change this color according to your theme, eg: #fff', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Product sorting', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="checkbox" name="wchweb_settings[sorting_control]" value="1" <?php (!empty($settings['sorting_control'])) ? checked(1, $settings['sorting_control'], true) : ''; ?>>
					<span><?php _e('Check if you want to sort your products via ajax.', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="checkbox" name="wchweb_settings[scroll_to_top]" value="1" <?php (!empty($settings['scroll_to_top'])) ? checked(1, $settings['scroll_to_top'], true) : ''; ?>>
					<span><?php _e('Check if to enable scroll to top after updating shop loop.', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top offset', WCHWEB_LOCALE); ?></th>
				<td>
					<input type="text" name="wchweb_settings[scroll_to_top_offset]" size="50" value="<?php echo esc_attr($settings['scroll_to_top_offset']); ?>">
					<br />
					<span><?php _e('You need to change this value to match with your theme, eg: 100', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Custom JavaScript after update', WCHWEB_LOCALE); ?></th>
				<td>
					<textarea name="wchweb_settings[custom_scripts]" rows="5" cols="70"><?php echo esc_attr($settings['custom_scripts']); ?></textarea>
					<br />
					<span><?php _e('If you want to add custom scripts that would be loaded after updating shop loop, eg: alert("hello");', WCHWEB_LOCALE); ?></span>
				</td>
			</tr>
		</table>
		<?php submit_button() ?>
	</form>
</div>