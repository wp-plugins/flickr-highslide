<?php
/*
Plugin Name: Flickr + Highslide
Plugin URI: http://www.pimlinders.com/wordpress/
Description: This plugin displays flickr photos using highslide.
Version: 0.1
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
	echo "<link rel='stylesheet' href='$plugindir/highslide/highslide.css' type='text/css' />\n";
}
function flickr_highslide_activate() {
	update_option("apikey");
	update_option("id");
	update_option("imageNum");
}
function flickr_highslide_init(){
	register_setting('flickr_highslide_options', 'apikey');
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
}
function flickr_highslide_options() {
	register_setting('flickr_highslide_options', 'apikey');
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
?>
	<div class="wrap">
    	<h2>Flickr + Highslide by: <a href="http://www.pimlinders.com/wordpress">Pim Linders</a></h2>
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
function flickr_highslide(){
	$apikey = get_option('apikey');
	$id = get_option('id');
	$imagesNum = get_option('imageNum');
	if($apikey == '' || $id == '' || $imagesNum == ''){
		echo '<p>To configure Flickr + Highslide go to Admin -> Setting -> Flickr + Highslide</p>';
	}
	else{	
		$xml = simplexml_load_file("http://flickr.com/services/rest/?method=flickr.people.getPublicPhotos&user_id=$id&api_key=$apikey");
		if ($xml->err['msg']){
			echo '<p>Flickr + Highslide is not configured correctly</p><p>Error Message: ' . $xml->err['msg'] . '</p>';	
		}
		else{
		?>
        <!-- Flickr + Highslide by Pim Linders http://www.pimlinders.com/ -->
		<div class="flickr_highslide" style="overflow:auto;">
		<?php
			for ($i = 0; $i<$imagesNum; $i++) {
				if($xml->photos->photo[$i]['server'] == NULL){
					break;
				}
				?>
                <a href="<?php 
                echo "http://static.flickr.com/";
                echo $xml->photos->photo[$i]['server'];
                echo "/";
                echo $xml->photos->photo[$i]['id'];
                echo "_";
                echo $xml->photos->photo[$i]['secret'];
                echo "_b.jpg"; 
                ?>" class="highslide" onclick="return hs.expand(this)">
                <img src="<?php 
                echo "http://static.flickr.com/";
                echo $xml->photos->photo[$i]['server'];
                echo "/";
                echo $xml->photos->photo[$i]['id'];
                echo "_";
                echo $xml->photos->photo[$i]['secret'];
                echo "_s.jpg"; 
                ?>" 
                alt="<?php echo $xml->photos->photo[$i]['title'] ?>" /></a>
				<?php
			}
		?></div><?php
		}
	}
}
?>
