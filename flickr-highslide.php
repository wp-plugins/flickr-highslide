<?php
/*
Plugin Name: Flickr + Highslide
Plugin URI: http://www.pimlinders.com/wordpress/
Description: This plugin displays flickr photos using highslide.
Version: 1.0.1
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

Highslide JS is licensed under a Creative Commons Attribution-NonCommercial
2.5 License. This means you need the author's permission to use highslide 
http://www.highslide.com/ on commercial websites. 
*/
function flickr_highslide_menu() {
  add_options_page('Flickr + Highslide Options', 'Flickr + Highslide', 8, __FILE__, 'flickr_highslide_options');
}
function flickr_highslide_head() {	
	$plugindir = get_bloginfo('wpurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
	echo "<script type='text/javascript' src='$plugindir/highslide/highslide-with-gallery.packed.js'></script>\n";
	echo "<script type='text/javascript'>hs.graphicsDir = '$plugindir/highslide/graphics/'; hs.showCredits = false;</script>\n";
	echo "<script type='text/javascript'>";
	$options = get_option('options');
	if ($options == '1'){
		echo "hs.wrapperClassName = 'wide-border';";
	}
	else if ($options == '2'){
		echo "
			hs.registerOverlay({
			html: '<div class=\"closebutton\" onclick=\"return hs.close(this)\" title=\"Close\"></div>',
			position: 'top right',
			fade: 2
		});
		hs.wrapperClassName = 'borderless';
		";
	}
	else if ($options == '3'){
		echo "hs.outlineType = 'rounded-white';";
	}
	else if ($options == '4'){
		echo "
			hs.outlineType = 'outer-glow';
			hs.wrapperClassName = 'outer-glow';
		";
	}
	else if ($options == '5'){
		echo "
			hs.outlineType = null;
			hs.wrapperClassName = 'colored-border';
		";
	}
	else if ($options == '6'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'rounded-white';
			hs.fadeInOut = true;
			hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .75,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		";
	}
	else if ($options == '7'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'glossy-dark';
			hs.wrapperClassName = 'dark';
			hs.fadeInOut = true;
			if (hs.addSlideshow) hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .6,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		";
	}
	else if ($options == '8'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'rounded-white';
			hs.wrapperClassName = 'controls-in-heading';
			hs.fadeInOut = true;
			if (hs.addSlideshow) hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: false,
				overlayOptions: {
					opacity: 1,
					position: 'top right',
					hideOnMouseOut: false
				}
			});
		";
	}
	else if ($options == '9'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.wrapperClassName = 'dark borderless floating-caption';
			hs.fadeInOut = true;
			hs.dimmingOpacity = .75;
			if (hs.addSlideshow) hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .6,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		";
	}
	else if ($options == '10'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.outlineType = 'rounded-white';
			hs.fadeInOut = true;
			hs.dimmingOpacity = 0.75;
			hs.useBox = true;
			hs.width = 640;
			hs.height = 480;
			hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: 1,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		";
	}
	else if ($options == '11'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.fadeInOut = true;
			hs.dimmingOpacity = 0.8;
			hs.wrapperClassName = 'borderless floating-caption';
			hs.captionEval = 'this.thumb.alt';
			hs.marginLeft = 100; 
			hs.marginBottom = 80
			hs.numberPosition = 'caption';
			hs.lang.number = '%1/%2';
			hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				overlayOptions: {
					className: 'text-controls',
					position: 'bottom center',
					relativeTo: 'viewport',
					offsetX: 50,
					offsetY: -5
		
				},
				thumbstrip: {
					position: 'middle left',
					mode: 'vertical',
					relativeTo: 'viewport'
				}
			});
			hs.registerOverlay({
				html: '<div class=\"closebutton\" onclick=\"return hs.close(this\)\" title=\"Close\"></div>',
				position: 'top right',
				fade: 2
			});
		";
	}
	else if ($options == '12'){
		echo "
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.fadeInOut = true;
			hs.dimmingOpacity = 0.8;
			hs.outlineType = 'rounded-white';
			hs.captionEval = 'this.thumb.alt';
			hs.marginBottom = 105;
			hs.numberPosition = 'caption';
			hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				overlayOptions: {
					className: 'text-controls',
					position: 'bottom center',
					relativeTo: 'viewport',
					offsetY: -60
				},
				thumbstrip: {
					position: 'bottom center',
					mode: 'horizontal',
					relativeTo: 'viewport'
				}
			});
		";
	}
	else if ($options == '13'){
		echo "
			hs.transitions = ['expand', 'crossfade'];
			hs.restoreCursor = null;
			hs.lang.restoreTitle = 'Click for next image';
			hs.addSlideshow({
				interval: 5000,
				repeat: true,
				useControls: true,
				overlayOptions: {
					position: 'bottom right',
					offsetY: 50
				},
				thumbstrip: {
					position: 'above',
					mode: 'horizontal',
					relativeTo: 'expander'
				}
			});
			var inPageOptions = {
				outlineType: null,
				allowSizeReduction: false,
				wrapperClassName: 'in-page controls-in-heading',
				useBox: true,
				width: 600,
				height: 400,
				targetX: 'gallery-area 10px',
				targetY: 'gallery-area',
				captionEval: 'this.thumb.alt',
				numberPosition: 'caption'
			}
			hs.addEventListener(window, 'load', function() {
				document.getElementById('thumb1').onclick();
			});
			hs.Expander.prototype.onImageClick = function() {
				if (/in-page/.test(this.wrapper.className))	return hs.next();
			}
			hs.Expander.prototype.onBeforeClose = function() {
				if (/in-page/.test(this.wrapper.className))	return false;
			}
			hs.Expander.prototype.onDrag = function() {
				if (/in-page/.test(this.wrapper.className))	return false;
			}
			hs.addEventListener(window, 'resize', function() {
				var i, exp;
				hs.page = hs.getPageSize();
		
				for (i = 0; i < hs.expanders.length; i++) {
					exp = hs.expanders[i];
					if (exp) {
						var x = exp.x,
							y = exp.y;
						exp.tpos = hs.getPosition(exp.el);
						x.calcThumb();
						y.calcThumb();
						x.pos = x.tpos - x.cb + x.tb;
						x.scroll = hs.page.scrollLeft;
						x.clientSize = hs.page.width;
						y.pos = y.tpos - y.cb + y.tb;
						y.scroll = hs.page.scrollTop;
						y.clientSize = hs.page.height;
						exp.justify(x, true);
						exp.justify(y, true);
						exp.moveTo(x.pos, y.pos);
					}
				}
			});
		";
	}
	else{
		echo "hs.wrapperClassName = 'wide-border';";
	}
	echo "</script>\n";
	echo "<link rel='stylesheet' href='$plugindir/highslide/highslide.css' type='text/css' />\n";
	if ($options == '11'){
		echo "
			<style type=\"text/css\">
				.highslide-caption {
					width: 100%;
					text-align: center;
				}
				.highslide-close {
					display: none !important;
				}
				.highslide-number {
					display: inline;
					padding-right: 1em;
					color: white;
				}
			</style>
		";
	}	
	if ($options == '13'){
		echo "
		<style type=\"text/css\">
			.highslide-image {
				border: 1px solid black;
			}
			.highslide-controls {
				width: 90px !important;
			}
			.highslide-controls .highslide-close {
				display: none;
			}
			.highslide-caption {
				padding: .5em 0;
			}
		</style>
		";
	}
}
function flickr_highslide_activate() {
	update_option("id");
	update_option("imageNum");
	update_option("title");
	update_option("options");
	update_option("order");
	update_option("imageSize");
	update_option("thumb");
}
function flickr_highslide_init(){
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
	register_setting('flickr_highslide_options', 'title');
	register_setting('flickr_highslide_options', 'options');
	register_setting('flickr_highslide_options', 'order');
	register_setting('flickr_highslide_options', 'imageSize');
	register_setting('flickr_highslide_options', 'thumb');	
}
function flickr_highslide_options() {
	register_setting('flickr_highslide_options', 'id');
	register_setting('flickr_highslide_options', 'imageNum');
	register_setting('flickr_highslide_options', 'title');
	register_setting('flickr_highslide_options', 'options');
	register_setting('flickr_highslide_options', 'order');
	register_setting('flickr_highslide_options', 'imageSize');
	register_setting('flickr_highslide_options', 'thumb');	
?>
<div class="wrap">
<table class="form-table">
    <form method="post" action="options.php">
        <h2>Flickr + Highslide by: <a href="http://www.pimlinders.com/">Pim Linders</a></h2>
        <?php settings_fields('flickr_highslide_options'); ?>
        <tr valign="top">
            <th scope="row">Flickr user ID:</th>
            <td><input type="text" name="id" value="<?php echo get_option('id'); ?>" /><a style="margin-left:5px;" href="http://idgettr.com/">Find your flickr user ID</a></td>
        </tr>
        <tr valign="top">
            <th scope="row">Number of images:</th>
            <td><input type="text" name="imageNum" value="<?php echo get_option('imageNum'); ?>" /><span style="margin-left:5px;">(Up to 100 images)</span></td>
        </tr>
        <tr valign="top">
            <th scope="row">Highslide:</th>
            <td><select name="options">							
                <option <?php if (get_option('options') == '1') { ?> selected="selected" <?php } ?> value="1">White border and drop shadow</option>
                <option <?php if (get_option('options') == '2') { ?> selected="selected" <?php } ?> value="2">Drop shadow and no border</option>
                <option <?php if (get_option('options') == '3') { ?> selected="selected" <?php } ?> value="3">White outline with rounded corners</option>
                <option <?php if (get_option('options') == '4') { ?> selected="selected" <?php } ?> value="4">Dark border with outer glow</option>
                <option <?php if (get_option('options') == '5') { ?> selected="selected" <?php } ?> value="5">No graphic outline</option>
                <option <?php if (get_option('options') == '6') { ?> selected="selected" <?php } ?> value="6">Gallery - White design</option>
                <option <?php if (get_option('options') == '7') { ?> selected="selected" <?php } ?> value="7">Gallery - Dark design</option>
                <option <?php if (get_option('options') == '8') { ?> selected="selected" <?php } ?> value="8">Gallery - Controls in the heading</option>
                <option <?php if (get_option('options') == '9') { ?> selected="selected" <?php } ?> value="9">Gallery - No border and a floating caption</option>
                <option <?php if (get_option('options') == '10') { ?> selected="selected" <?php } ?> value="10">Gallery - Images within a fixed box</option>
                <option <?php if (get_option('options') == '11') { ?> selected="selected" <?php } ?> value="11">Gallery - Vertical thumbstrip to the left</option>
                <option <?php if (get_option('options') == '12') { ?> selected="selected" <?php } ?> value="12">Gallery - Horizontal thumbstrip at the bottom</option>
                <option <?php if (get_option('options') == '13') { ?> selected="selected" <?php } ?> value="13">Gallery - Gallery in the parent page</option>
            </select></td>
        </tr>
        <tr valign="top">
            <th scope="row">Image Size:</th>
            <td><select name="imageSize">							
                <option <?php if (get_option('imageSize') == 'large') { ?> selected="selected" <?php } ?> value="large">Large</option>
                <option <?php if (get_option('imageSize') == 'medium') { ?> selected="selected" <?php } ?> value="medium">Medium</option>
                <option <?php if (get_option('imageSize') == 'small') { ?> selected="selected" <?php } ?> value="small">Small</option>
            </select></td>
        </tr>
        <tr valign="top">
            <th scope="row">Thumbnail:</th>
            <td><select name="thumb">							
                <option <?php if (get_option('thumb') == 'square') { ?> selected="selected" <?php } ?> value="square">Square</option>
                <option <?php if (get_option('thumb') == 'thumbnail') { ?> selected="selected" <?php } ?> value="thumbnail">Thumbnail</option>
            </select></td>
        </tr>
        <tr valign="top">
            <th scope="row">Order:</th>
            <td><select name="order">							
                <option <?php if (get_option('order') == 'latest') { ?> selected="selected" <?php } ?> value="latest">Latest</option>
                <option <?php if (get_option('order') == 'random') { ?> selected="selected" <?php } ?> value="random">Random</option>
            </select></td>
        </tr>
        <tr valign="top">
            <th scope="row">Display titles:</th>
            <td><input type="checkbox" name="title" value="true" <?php if(get_option('title')  == "true"){echo "checked" ;}?>/></td>
        </tr>
        <tr valign="top">
        	<td><p class="submit"><input type="submit" name="Submit" value="Save changes"/></p></td>
        </tr>
    </form>
</table>
</div>
<?php
}
add_action( "wp_head", 'flickr_highslide_head' );
add_action('admin_menu', 'flickr_highslide_menu');
add_action( 'admin_init', 'flickr_highslide_init' );
add_shortcode('flickr_highslide', 'flickr_highslide');
register_activation_hook( __FILE__, 'flickr_highslide_activate' );
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
	$apikey =  '7410a0ef9c742bc8175d7930c1fa7022';
	$id = get_option('id');
	$imageNum = get_option('imageNum');
	$order = get_option('order');
	$imageSize = get_option('imageSize');
	$thumbnail = get_option('thumb');
	$options = get_option('options');
	if($id == '' || $imageNum == '')
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
			if ($options == '9' || $options == '13')
				$size = '';
			if ($thumbnail == 'thumbnail')
				$thumbnail = '_t';
			else
				$thumbnail = '_s';	
		?>
        <!-- Flickr + Highslide by Pim Linders http://www.pimlinders.com/ -->
        <?php if($options == '13'){ ?>
        	<div class="flickr_highslide" style="overflow:auto; display:none;">
        <?php } else{ ?>
        	<div class="flickr_highslide" style="overflow:auto;">
        <?php } ?>
		<?php
			if($options == '8')
				$heading = true;
			for ($k=0; $k<$imageNum; $k++) {
				if ($order == 'random')
					$i = $random[$k];
				else
					$i = $k;
				if($xml->photos->photo[$i]['server'] == NULL)
					break;
				?>
                <?php if (get_option('title')==true && $heading == true){ ?>
                    <div class="highslide-heading">
                       <?php echo $xml->photos->photo[$i]['title'] ?>
                    </div>
				<?php } if(get_option('title')==false && $heading == true){?>
                    <div class="highslide-heading"></div>
                <?php } ?>
                <a 
				<?php if($options == '13' && $k==0){ ?>
                	id="thumb1"
                <?php } ?>
                href="<?php 
                echo "http://static.flickr.com/";
                echo $xml->photos->photo[$i]['server'];
                echo "/";
                echo $xml->photos->photo[$i]['id'];
                echo "_";
                echo $xml->photos->photo[$i]['secret'];
                echo "$size.jpg"; 
                ?>" <?php if($options == '13'){ ?>
                	class="highslide" onclick="return hs.expand(this, inPageOptions)">
				<?php } else{ ?>
                	class="highslide" onclick="return hs.expand(this)">
				<?php } ?>
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
                <?php if (get_option('title') && $heading == false){ ?>
                    <div class="highslide-caption">
                        <?php echo $xml->photos->photo[$i]['title'] ?>
                    </div>
                <?php
				}
			}
			?></div>
        	<?php if($options == '13'){ ?>
        		<div id="gallery-area" style="width: 620px; height: 605px; margin: 0 auto; border: 1px solid silver"></div>
			<?php
			}
		}
	}
}
?>