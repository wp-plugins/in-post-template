<?php
/*
Plugin Name: In-post Template
Plugin URI: http://dosesdiarias.seucaminho.com
Description: Add in-post content
Version: 0.2
Author: Fabio A. Mazzarino <fabio.mazzarino@gmail.com>
Author URI: http://dosesdiarias.seucaminho.com
*/

/*  Copyright 2009 Fabio A. Mazzarino (email: fabio.mazzarino@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_filter('the_content', 'ipt_replace_tag', 0);

function ipt_replace_tag($content) {
	if (!is_single()) {
		return $content;
	}

	if (preg_match('/\<span id\="more\-.+"\>\<\/span\>/', $content)) {
		$content = preg_replace('/(\<span id\="more\-.+"\>)(\<\/span\>)/', '$1' . get_option('wp_ipt_content') . '$2', $content);
			return $content;
	} 

	if (get_option('wp_ipt_nomark') == 'before') {
		$content = get_option('wp_ipt_content') . $content;
		return $content;
	}

	if (get_option('wp_ipt_nomark') == 'after') {
		$content .= get_option('wp_ipt_content');
		return $content;
	}

	return $content;
}

add_action('admin_menu', 'ipt_plugin_menu');
add_action('admin_init', 'ipt_register_settings');
function ipt_plugin_menu() {
	add_options_page("In-post Template Options", "In-post Template", 8, "inpost-template", "ipt_plugin_options");
}

function ipt_register_settings() {
	register_setting('wp_ipt_options', 'wp_ipt_content');
	register_setting('wp_ipt_options', 'wp_ipt_nomark');
}

function ipt_plugin_options() {
	if ($_POST['action'] == 'update') {
		$message = "In-post Template Options Updated";

		$content = $_POST['wp_ipt_content'];
		$nomark = $_POST['wp_ipt_nomark'];

		if (	!update_option('wp_ipt_content', $content)	||
			!update_option('wp_ipt_nomark', $nomark)
		)
			$message = 'In-post Template Options Update Failed';
		echo '<div id="message" class="updated fade"><p>'.$message.'.</p></div>';

	}

	include('options-form.php');
	return;
}
?>
