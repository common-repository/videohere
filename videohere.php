<?php
/*
Plugin Name: VideoHere
Plugin URI: http://www.videohere.com
Description: <a href="http://www.videohere.com">VideoHere</a> is a video hosting platform from <a href="http://www.cantaloupe.tv">Cantaloupe</a>.
Author: Douglas Karr
Version: 1.0.1
Author URI: http://www.dknewmedia.com/
*/

function videohere_header() {
	$dir = dirname(__FILE__);
	$pluginRootURL = get_option('siteurl').substr($dir, strpos($dir, '/wp-content'));
	$wpbtv_key = urlencode(stripslashes(get_option('wpbtv_key')));
	echo '<script src="http://www.backlight.tv/videohere/?accountKey='.$wpbtv_key.'&libraryKey=myLibraryKey&buttonType=VIDEO_SELECTOR&buttonParentElementID=NO" type="text/javascript"></script><script language="javascript">function videoHere_SelectionHandler(selectedVideo) { alert(selectedVideo.embedCode); }</script>';
	echo '<script src="'.$pluginRootURL.'/wp-videohere.js" type="text/javascript"></script>';
	}
	
function videohere_admin() {
		include(dirname(__FILE__).'/videohere_admin.php');
	}

function videohere_options() {
	add_options_page('VideoHere Options', 'VideoHere',8,__FILE__, 'videohere_admin');
	}
	
function videohere_media_button($context) {
	$dir = dirname(__FILE__);
	$pluginRootURL = get_option('siteurl').substr($dir, strpos($dir, '/wp-content'));
	$image_btn = $pluginRootURL.'/videohere.jpg';
	$out = '<img id="buttonDiv" src="'.$image_btn.'" onclick="videoHereInstance.showOverlay()" style="cursor:pointer; padding: 0 0 0 10px;" />';
	return $context.$out;
}

add_action('admin_head', 'videohere_header',8);
add_action('admin_menu', 'videohere_options',8); 
add_action('media_buttons_context', 'videohere_media_button', 99);
?>