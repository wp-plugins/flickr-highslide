<?php
/*
Plugin Name: Flickr + Highslide
Plugin URI: http://www.pimlinders.com/wordpress/
Description: This plugin displays flickr photos using highslide.
Version: 0.3
Author: Pim Linders
Author URI: http://www.pimlinders.com
 ____                       
/\  _`\   __                
\ \ \L\ \/\_\    ___ ___    
 \ \ ,__/\/\ \ /' __` __`\  
  \ \ \/  \ \ \/\ \/\ \/\ \ 
   \ \_\   \ \_\ \_\ \_\ \_\
    \/_/    \/_/\/_/\/_/\/_/                                                       
 __                       __                         
/\ \       __            /\ \                        
\ \ \     /\_\    ___    \_\ \     __   _ __   ____  
 \ \ \  __\/\ \ /' _ `\  /'_` \  /'__`\/\`'__\/',__\ 
  \ \ \L\ \\ \ \/\ \/\ \/\ \L\ \/\  __/\ \ \//\__, `\
   \ \____/ \ \_\ \_\ \_\ \___,_\ \____\\ \_\\/\____/
    \/___/   \/_/\/_/\/_/\/__,_ /\/____/ \/_/ \/___/ 
                                                                                                                                                                                                      
Copyright 2009  Pim Linders

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

** Please note **

NB. Highslide JS is licensed under a Creative Commons Attribution-NonCommercial
2.5 License. This means you need the author's permission to use highslide 
http://www.highslide.com/ on commercial websites. 
*/
?>
<?php
function flickr_highslide_menu() {
  add_options_page('Flickr + Highslide Options', 'Flickr + Highslide', 8, __FILE__, 'flickr_highslide_options');
}
function flickr_highslide_head() {	
	$plugindir = get_bloginfo('wpurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
	echo "<script type='text/javascript' src='$plugindir/highslide/highslide.packed.js'></script>\n";
	echo "<script type='text/javascript'>hs.graphicsDir = '$plugindir/highslide/graphics/'; hs.showCredits = false;</script>\n";
	echo "<script type='text/javascript'>";
	$options = get_option('options');
	if ($options == '1'){
		echo "hs.wrapperClassName = 'wide-border';";
	}
	else if ($options == '2'){
		echo "hs.registerOverlay({html: \"<div class='closebutton' onclick='return hs.close(this)' title='Close'></div>\",position: 'top right',fade: 2 });hs.wrapperClassName = 'borderless'; ";
	}
	else if ($options == '3'){
		echo "hs.outlineType = 'rounded-white';";
	}
	else if ($options == '4'){
		echo "hs.outlineType = 'outer-glow';hs.wrapperClassName = 'outer-glow';";
	}
	else if ($options == '5'){
		echo "hs.outlineType = null; hs.wrapperClassName = 'colored-border';";
	}
	else{
		echo "hs.wrapperClassName = 'wide-border';";
	}
	echo "</script>\n";
	echo "<link rel='stylesheet' href='$plugindir/highslide/highslide.css' type='text/css' />\n";
}
function flickr_highslide_activate() {
	update_option("apikey");
	update_option("id");
	update_option("imageNum");
	update_option("title");
	update_option("options");
	update_option("order");
	update_option("imageSize");
	update_option("thumb");
}
function flickr_highslide_init(){
	register_setting('flickr_highslide_options', 'apikey');
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
	register_setting('flickr_highslide_options', 'title');
	register_setting('flickr_highslide_options', 'options');
	register_setting('flickr_highslide_options', 'order');
	register_setting('flickr_highslide_options', 'imageSize');
	register_setting('flickr_highslide_options', 'thumb');	
}
function flickr_highslide_options() {
	register_setting('flickr_highslide_options', 'apikey');
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
	register_setting('flickr_highslide_options', 'title');
	register_setting('flickr_highslide_options', 'options');
	register_setting('flickr_highslide_options', 'order');
	register_setting('flickr_highslide_options', 'imageSize');
	register_setting('flickr_highslide_options', 'thumb');	
?>
	<div class="wrap">
    	<h2>Flickr + Highslide by: <a href="http://www.pimlinders.com/">Pim Linders</a></h2>
        <form method="post" action="options.php" style="margin-top:10px;">
            <?php settings_fields('flickr_highslide_options'); ?>
            <label style="position:absolute; padding-top:5px;">Flickr API key:</label>
            <input style="margin-left:130px; width:300px;" type="text" name="apikey" value="<?php echo get_option('apikey'); ?>" />
            <br />
            <label style="position:absolute; padding-top:5px;">Flickr user ID:</label>
            <input style="margin-left:130px;" type="text" name="id" value="<?php echo get_option('id'); ?>" />
            <br />
            <label style="position:absolute; padding-top:5px;">Number of images:</label>
            <input style="margin-left:130px;" type="text" name="imageNum" value="<?php echo get_option('imageNum'); ?>" />
            <br />
            <label style="position:absolute; padding-top:5px;">Highslide:</label>
			<select name="options"style="margin-left:130px;">							
				<option <?php if (get_option('options') == '1') { ?> selected="selected" <?php } ?> value="1">White border and drop shadow</option>
				<option <?php if (get_option('options') == '2') { ?> selected="selected" <?php } ?> value="2">Drop shadow and no border</option>
                <option <?php if (get_option('options') == '3') { ?> selected="selected" <?php } ?> value="3">White outline with rounded corners</option>
                <option <?php if (get_option('options') == '4') { ?> selected="selected" <?php } ?> value="4">Dark border with outer glow</option>
                <option <?php if (get_option('options') == '5') { ?> selected="selected" <?php } ?> value="5">No graphic outline</option>
			</select>
            <br />
           	<label style="position:absolute; padding-top:5px;">Image Size:</label>
			<select name="imageSize" style="margin-left:130px;">							
				<option <?php if (get_option('imageSize') == 'large') { ?> selected="selected" <?php } ?> value="large">Large</option>
				<option <?php if (get_option('imageSize') == 'medium') { ?> selected="selected" <?php } ?> value="medium">Medium</option>
                <option <?php if (get_option('imageSize') == 'small') { ?> selected="selected" <?php } ?> value="small">Small</option>
			</select>
            <br />
            <label style="position:absolute; padding-top:5px;">Thumbnail:</label>
			<select name="thumb" style="margin-left:130px;">							
				<option <?php if (get_option('thumb') == 'square') { ?> selected="selected" <?php } ?> value="square">Square</option>
				<option <?php if (get_option('thumb') == 'thumbnail') { ?> selected="selected" <?php } ?> value="thumbnail">Thumbnail</option>
			</select>
            <br />
            <label style="position:absolute; padding-top:5px;">Order:</label>
			<select name="order" style="margin-left:130px;">							
				<option <?php if (get_option('order') == 'latest') { ?> selected="selected" <?php } ?> value="latest">Latest</option>
				<option <?php if (get_option('order') == 'random') { ?> selected="selected" <?php } ?> value="random">Random</option>
			</select>
            <br />
            <label style="position:absolute; padding-top:5px;">Display titles:</label>
            <input style="margin-left:130px; margin-top:6px;" type="checkbox" name="title" value="true" <?php if(get_option('title')  == "true"){echo "checked" ;}?>/>
            <p class="submit" style="padding-top:10px;"><input type="submit" name="Submit" value="Save changes"/></p>
        </form>
   		<h4>Like Flickr + Highslide? make a donation</h4>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="4821221" />
            <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" />
            <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
        </form>
    </div>
<?php
}
add_action( "wp_head", 'flickr_highslide_head' );
add_action('admin_menu', 'flickr_highslide_menu');
add_action( 'admin_init', 'flickr_highslide_init' );
add_shortcode('flickr_highslide', 'flickr_highslide');
register_activation_hook( __FILE__, 'flickr_highslide_activate' );
?>
<?php
function random($total){
	$imageNum = get_option('imageNum');
	if($total > 100)
		$total = 100;
	if ($imageNum > $total)
		$imageNum = $total;
	$numbers = array(); 
	for ($i=0; $i<$total; $i++) {
		$numbers[$i] = $i;
	}
	$rand = array_rand($numbers, $imageNum);
	return $rand;
}
function flickr_highslide(){
	$apikey = get_option('apikey');
	$id = get_option('id');
	$imageNum = get_option('imageNum');
	$order = get_option('order');
	$imageSize = get_option('imageSize');
	$thumbnail = get_option('thumb');
	if($apikey == '' || $id == '' || $imageNum == '')
		echo '<p>To configure Flickr + Highslide go to Admin -> Setting -> Flickr + Highslide</p>';
	else{	
		$xml = simplexml_load_file("http://flickr.com/services/rest/?method=flickr.people.getPublicPhotos&user_id=$id&api_key=$apikey");
		if ($xml->err['msg']){
			echo '<p>Flickr + Highslide is not configured correctly</p><p>Error Message: ' . $xml->err['msg'] . '</p>';	
		}
		else{
			$total = $xml->photos['total'];
			if ($order == 'random')
				$random = random($total);
			if ($imageSize == 'medium')
				$size = '';
			else if ($imageSize == 'small')
				$size = '_m';
			else
				$size = '_b';
			if ($thumbnail == 'thumbnail')
				$thumbnail = '_t';
			else
				$thumbnail = '_s';	
		?>
        <!-- Flickr + Highslide by Pim Linders http://www.pimlinders.com/ -->
		<div class="flickr_highslide" style="overflow:auto;">
		<?php
			for ($k=0; $k<$imageNum; $k++) {
				if ($order == 'random')
					$i = $random[$k];
				else
					$i = $k;
				if($xml->photos->photo[$i]['server'] == NULL)
					break;
				?>
                <a href="<?php 
                echo "http://static.flickr.com/";
                echo $xml->photos->photo[$i]['server'];
                echo "/";
                echo $xml->photos->photo[$i]['id'];
                echo "_";
                echo $xml->photos->photo[$i]['secret'];
                echo "$size.jpg"; 
                ?>" class="highslide" onclick="return hs.expand(this)">
                <img src="<?php 
                echo "http://static.flickr.com/";
                echo $xml->photos->photo[$i]['server'];
                echo "/";
                echo $xml->photos->photo[$i]['id'];
                echo "_";
                echo $xml->photos->photo[$i]['secret'];
                echo "$thumbnail.jpg"; 
                ?>" 
                alt="" /></a>
                <?php if (get_option('title')){ ?>
                    <div class="highslide-caption">
                        <?php echo $xml->photos->photo[$i]['title'] ?>
                    </div>
                <?php
				}
			}
		?></div><?php
		}
	}
}
?>