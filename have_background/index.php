<?
/*
Plugin Name: Have Background
Version: 0.3
Description: customize the background of your pages
Author: Jonathan Finnegan
Author URI: http://jonathanfinnegan.com
Plugin URI: http://jonathanfinnegan.com/have_background


Copyright (C) 2011 Jonathan Finnegan

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/


/* *** */
/* start background type */
/* *** */

add_action('init', 'create_background');
	function create_background() {
    	$background_args = array(
    		'label' => __('Backgrounds'),
			'labels' => array(
				'name' => __('Backgrounds'),
				'singular_name' => __('Background'),
				'add_new' => __('Add Background'),
				'add_new_item' => __('Add New Background'),
				'edit' => __('Edit'),
				'edit_item' => __('Edit Background'),
				'new_item' => __('New Background'),
				'view' => __('View Backgrounds'),
				'view_item' => __('View Background'),
				'search_items' => __('Search Backgrounds'),
				'not_found' => __('No Backgrounds found'),
				'not_found_in_trash' => __('No Backgrounds found in Trash'),
				'description' => __('Background Description')
			),
			'menu_position' => 44,
			//'menu_icon' => get_stylesheet_directory_uri() . '/images/ico_press.png',
			'query_var' => false,
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'rewrite' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'can_export' => true,
			'permalink_epmask' => EP_PERMALINK,
			'supports' => array('title', 'editor')
        );
    	register_post_type('background',$background_args);
	}
	add_action("admin_init", "add_background_options");
	add_action('save_post', 'update_background_options');
	function add_background_options(){
		add_meta_box("background_options", "Background Image Options", "background_options", "background", "normal", "low");
	}
	function background_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$background_position_horizontal = $custom["background_position_horizontal"][0];
		$background_position_vertical = $custom["background_position_vertical"][0];
		$background_repeat = $custom["background_repeat"][0];
		$background_attachment = $custom["background_attachment"][0];
		$background_color = $custom["background_color"][0];
?>
<style>
	#background_options
	{
		width:95%;
		display:block;
		margin:0 0 15px;
		text-align:left;
		float:none;
		clear:both;
	}
	#background_options label
	{
		width:100%;
		display:block;
		margin:4px 4px 4px 0;
		text-align:left;
		clear:both;
	}
	#background_options input
	{
		width:auto;
	}
	
	
	#background_options legend
	{
		font-size:1.2em;
		font-weight:bold;
	}
	
	#background_options fieldset
	{
		width:50%;
		display:block;
		margin:0 0 20px;
		text-align:left;
		float:left;
	}
</style>

<div id="background_options">
	<fieldset class="radio"> 
		<legend>background-position-horizontal:</legend> 
			<?			
			if($background_position_horizontal == '') {
			?>
			<label><input type="radio" name="background_position_horizontal" value="0" checked="checked" />  <input name="background_position_horizontal" value="0" /> numeric value (px)</label> 
			<?
			}elseif($background_position_horizontal != '' && is_numeric($background_position_horizontal)) {
			?>
			<label><input type="radio" name="background_position_horizontal" value="<?php echo $background_position_horizontal; ?>" checked="checked" />  <input name="background_position_horizontal" value="<?php echo $background_position_horizontal; ?>" /> numeric value (px)</label> 
			<?		
			}else {
			?>
			<label><input type="radio" name="background_position_horizontal" value="" />  <input name="background_position_horizontal" value="" /> numeric value (px)</label> 
			<?		
			}
			if($background_position_horizontal == 'left') {
			?>
			<label><input type="radio" name="background_position_horizontal" value="left" checked="checked" /> left</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_horizontal" value="left" /> left</label> 
			<?
			}
			if($background_position_horizontal == 'center') {
			?>
			<label><input type="radio" name="background_position_horizontal" value="center" checked="checked" /> center</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_horizontal" value="center" /> center</label> 
			<?
			}
			if($background_position_horizontal == 'right') {
			?>
			<label><input type="radio" name="background_position_horizontal" value="right" checked="checked" /> right</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_horizontal" value="right" /> right</label> 
			<?
			}
			?>
	</fieldset> 
	<fieldset class="text"> 
		<legend>background-color:</legend> 
		<?
			if($background_color == '') {
			?>
			<label>color:</label>  <input id="background_color" type="text" name="background_color" value="ffffff" />
			<?
			}else{
			?>
			<label>color:</label> <input id="background_color" type="text" name="background_color" value="<?php echo $background_color; ?>" />
			<?
			}
		?>
	</fieldset>
	<fieldset class="radio"> 
		<legend>background-position-vertical:</legend> 
			<?
			if($background_position_vertical == '') {
			?>
			<label><input type="radio" name="background_position_vertical" value="0" checked="checked" />  <input name="background_position_vertical" value="0" /> numeric value (px)</label> 
			<?
			}elseif($background_position_vertical != '' && is_numeric($background_position_vertical)) {
			?>
			<label><input type="radio" name="background_position_vertical" value="<?php echo $background_position_vertical; ?>" checked="checked" />  <input name="background_position_vertical" value="<?php echo $background_position_vertical; ?>" /> numeric value (px)</label> 
			<?		
			}else {
			?>
			<label><input type="radio" name="background_position_vertical" value="" />  <input name="background_position_vertical" value="" /> numeric value (px)</label> 
			<?		
			}			
			if($background_position_vertical == 'top') {
			?>
			<label><input type="radio" name="background_position_vertical" value="top" checked="checked" /> top</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_vertical" value="top" /> top</label> 
			<?
			}
			if($background_position_vertical == 'center') {
			?>
			<label><input type="radio" name="background_position_vertical" value="center" checked="checked" /> center</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_vertical" value="center" /> center</label> 
			<?
			}
			if($background_position_vertical == 'bottom') {
			?>
			<label><input type="radio" name="background_position_vertical" value="bottom" checked="checked" /> bottom</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_position_vertical" value="bottom" /> bottom</label> 
			<?
			}
			?>
	</fieldset> 
	<fieldset class="radio"> 
		<legend>background-repeat:</legend> 
		<?
			if($background_repeat == 'repeat' || $background_repeat == '') {
			?>
			<label><input type="radio" name="background_repeat" value="repeat" checked="checked" />  repeat</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_repeat" value="repeat" />  repeat</label> 
			<?		
			}
			if($background_repeat == 'no-repeat') {
			?>
			<label><input type="radio" name="background_repeat" value="no-repeat" checked="checked" />  no-repeat</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_repeat" value="no-repeat" />  no-repeat</label> 
			<?		
			}
			if($background_repeat == 'repeat-x') {
			?>
			<label><input type="radio" name="background_repeat" value="repeat-x" checked="checked" />  repeat-x (left to right)</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_repeat" value="repeat-x" />  repeat-x (left to right)</label> 
			<?		
			}
			if($background_repeat == 'repeat-y') {
			?>
			<label><input type="radio" name="background_repeat" value="repeat-y" checked="checked" />  repeat-y (top to bottom)</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_repeat" value="repeat-y" />  repeat-y (top to bottom)</label> 
			<?		
			}
		?>
	</fieldset>
	<fieldset class="radio"> 
		<legend>background-attachment:</legend> 
		<?
			if($background_attachment == 'fixed' || $background_attachment == '') {
			?>
			<label><input type="radio" name="background_attachment" value="fixed" checked="checked" />  fixed</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_attachment" value="fixed" />  fixed</label> 
			<?		
			}
			if($background_attachment == 'scroll') {
			?>
			<label><input type="radio" name="background_attachment" value="scroll" checked="checked" />  scroll</label> 
			<?
			}else{
			?>
			<label><input type="radio" name="background_attachment" value="scroll" />  scroll</label> 
			<?		
			}
		?>
	</fieldset>
		<br />
	</div><!--end background-options-->   
	<div style="clear:both;display:block;"><!--break--></div>
<?php
}
	function update_background_options(){
		global $post;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post->ID;	
		}
		$_POST["background_position_horizontal"] = str_replace("px","",$_POST["background_position_horizontal"]);
		$_POST["background_position_vertical"] = str_replace("px","",$_POST["background_position_vertical"]);
		if(($_POST["background_position_vertical"] != "top" || $_POST["background_position_vertical"] != "center" || $_POST["background_position_vertical"] != "bottom") && $_POST["background_position_vertical"]== ""){
			$_POST["background_position_vertical"] = 0;
		}
		if(($_POST["background_position_horizontal"] != "left" || $_POST["background_position_horizontal"] != "center" || $_POST["background_position_horizontal"] != "right") && $_POST["background_position_horizontal"] == ""){
			$_POST["background_position_horizontal"] = 0;
		}
		update_post_meta($post->ID, "background_position_horizontal", $_POST["background_position_horizontal"]);
		update_post_meta($post->ID, "background_position_vertical", $_POST["background_position_vertical"]);
		update_post_meta($post->ID, "background_repeat", $_POST["background_repeat"]);
		update_post_meta($post->ID, "background_attachment", $_POST["background_attachment"]);
		update_post_meta($post->ID, "background_color", $_POST["background_color"]);
	}
/* *** */
/* end background type */
/* *** */

function admin_header_colorpicker() {
	
?>
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/have_background/colorpicker/css/colorpicker.css" />
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/have_background/colorpicker/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/have_background/colorpicker/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/have_background/colorpicker/js/utils.js"></script>
    <script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/have_background/colorpicker/js/layout.js"></script>
<?
}
add_action('admin_head', 'admin_header_colorpicker');

function have_bg_select_box($bg_id){
	query_posts("post_type=background");
	if( $myposts){
	echo "<select name=\"bg_id\" id=\"bg_id\">";
	echo "<option value=\"". $postr->ID."\"".$is_blank.">".$postr->post_title."</option>\n\t";
	foreach($myposts->posts as $postr) :
		if($postr->ID == $bg_id){
			$is_selected = " selected=\"selected\"";
		}else{
			$is_selected = "";
		}
		echo "<option value=\"". $postr->ID."\"".$is_selected.">".$postr->post_title."</option>\n\t";
	endforeach;
	if($bg_id == ""){
		echo "<option value=\"\" selected=\"selected\">random background</option>\n\t";
	}else{
		echo "<option value=\"\">random background</option>\n\t";
	}
	echo "</select>";
	}
}

function add_have_options_page(){
	$post_types=get_post_types('','names'); 
	foreach ($post_types as $post_type ) {
		if($post->post_type == 'background')
		add_meta_box("have_options_page", "Custom Background", "have_options_page", $post_type, "normal", "high");
	}	
}
add_action("admin_init", "add_have_options_page");	
	function have_options_page(){
		global $post;
		$custom = get_post_custom($post->ID);
		$bg_id = $custom["bg_id"][0];
		// output editing form
		?>
		<div id="have_options">
		<?
			echo have_bg_select_box($bg_id);
		?>
		</div><!--end custom bg options-->  	
		<?php
	}

function update_have_options_page(){
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	return $post->ID;	
	}
	update_post_meta($post->ID, "bg_id", $_POST["bg_id"]);
	
}
add_action('save_post', 'update_have_options_page');

/*
	have_background_header determines what background image to display
	posts can have a specific background image, otherwise it pulls a random published background image
*/
function have_background_header(){
global $post, $wpdb;
//if $bg_id exists, display that for this page instead of random
if ( is_home() || $post->post_type == 'background') {
	$bg_id = "";
} else {
	$bg_id = get_post_meta($post->ID, "bg_id", true);
}
if((isset($bg_id) && $bg_id != "") && is_search() == FALSE){
	$index_background = $wpdb->get_results( $wpdb->prepare("SELECT * FROM  `wp_posts` WHERE  `ID` =  ".$bg_id." LIMIT 1" ));	
}else{	
	$index_background = $wpdb->get_results( $wpdb->prepare("SELECT * FROM  `wp_posts` WHERE `post_type` = 'background' AND `post_status` = 'publish' ORDER BY rand() LIMIT 1" ));	
}
	if( $index_background){
		$count = 0;
		foreach($index_background as $post_head){
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_head->post_content, $matches);
			$first_img = $matches [1] [0];					
			if(isset($first_img)){
				$first_img = $first_img;
			}else{
				$first_img="";
			}
			$background_url= $first_img;
			$bg_color = get_post_meta($post_head->ID, "background_color", true);
			$bg_repeat = get_post_meta($post_head->ID, "background_repeat", true);
			if($bg_repeat != ""){
				$bg_repeat = "".$bg_repeat;
			}else{
				$bg_repeat = "repeat";
			}
			$bg_position_horizontal = get_post_meta($post_head->ID, "background_position_horizontal", true);
			if($bg_position_horizontal != ""){
				if($bg_position_horizontal == 0){
					$bg_position_horizontal = "".$bg_position_horizontal;
				}else{
					$bg_position_horizontal = "".$bg_position_horizontal."px";
				}
			}else{
				$bg_position_horizontal = "0";
			}
			$bg_position_vertical = get_post_meta($post_head->ID, "background_position_vertical", true);
			if($bg_position_vertical != ""){
				if($bg_position_vertical == 0){
					$bg_position_vertical = "".$bg_position_vertical;
				}else{
					$bg_position_vertical = "".$bg_position_vertical."px";
				}
			}else{
				$bg_position_vertical = "0";
			}
			$bg_attach = get_post_meta($post_head->ID, "background_attachment", true);
			if($bg_attach != ""){
				$bg_attach = "".$bg_attach;
			}else{
				$bg_attach = "fixed";
			}
		}	//endforeach; 
	}	//if( $index_background)

	if($bg_color ==""){$bg_color = "ffffff";}else{$bg_color = $bg_color;}
	if($background_url ==""){
		$background_url = "";
	}else{
		$background_url = "url(".$background_url.") ".$bg_repeat." ".$bg_position_horizontal." ".$bg_position_vertical." ".$bg_attach;
	
	}
echo "\r\n<style type=\"text/css\">\r\n";
	echo "	body\r\n";
	echo "	{\r\n";
	echo "		background: ".$background_url." #" . $bg_color.";\r\n";
	echo "	}\r\n";
echo "\r\n</style>\r\n";
}	//function have_background_header
add_action('wp_head', 'have_background_header');