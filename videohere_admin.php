<?php
/*
Author: Douglas Karr
Author URI: http://www.dknewmedia.com
Description: Administrative options for PostPost
*/

load_plugin_textdomain('wpbtv',$path = 'wp-content/plugins/videohere');
$location = get_option('siteurl') . '/wp-admin/options-general.php?page=videohere/videohere.php';

/*Lets add some default options if they don't exist*/
add_option('wpbtv_key', __('', 'wpbtv'));

/* update options */
if ('process' == $_POST['stage'])
{
update_option('wpbtv_key', __($_POST['wpbtv_key'], 'wpbtv'));
}

/*Get options for form fields*/
$wpbtv_key = stripslashes(get_option('wpbtv_key'));

?>

<div class="wrap">
  <h2><?php _e('VideoHere', 'wpbtv') ?></h2>
  <p>VideoHere is a plugin to load your videos in WordPress by <a href="http://dknewmedia.com">DK New Media</a>. Be sure to read <a href="http://blog.cantaloupe.tv">The Cantaloupe TV Blog</a>... here are the latest posts:</p>
	<?php // Get RSS Feed(s)
    include_once(ABSPATH . WPINC . '/rss.php');
    $rss = fetch_rss('http://blog.cantaloupe.tv/rss.php?blog_id=18bec770-af88-4aa4-81a4-87fecbab9a31&sid=8fc5f2b0-037f-41bc-a4d6-3ec1e4fcea5c');
    $maxitems = 7;
    $items = array_slice($rss->items, 0, $maxitems);
    ?>
    
    <ul style="list-style:square; margin-left: 50px">
    <?php foreach ( $items as $item ) : ?>
    <?php if (substr($item['title'],0,5)!="links") { ?>
    <li><a href='<?php echo $item['link']; ?>' 
    title='<?php echo $item['title']; ?>'>
    <?php echo $item['title']; ?>
    </a></li>
    <?php } endforeach; ?>
    </ul>
  <h2><?php _e('VideoHere Options', 'wpbtv') ?></h2>
  <p>Simply paste your API Key into the text area and update options..</p>
  <form name="form1" method="post" action="<?php echo $location ?>&amp;updated=true">
	<input type="hidden" name="stage" value="process" />
    <table width="875px" cellspacing="5" cellpadding="5">
      <tr valign="top">
        <th scope="row" width="200px" align="right"><?php _e('VideoHere API Key:') ?></th>
		<td width="600px">
        	<input type="text" name="wpbtv_key" id="wpbtv_key" value="<?php echo $wpbtv_key; ?>" />
        </td>
      </tr>
	</table>
    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options', 'wpbtv') ?> &raquo;" />
    </p>
  </form>
</div>