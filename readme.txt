=== Flickr + Highslide ===

Contributors: Pim Linders
Donate link: http://www.pimlinders.com/wordpress
Tags: photos, images, admin, gallery, post, photo-albums, pictures, photo, picture, image, flickr, highslide
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 0.3

== Description ==

This plugin displays flickr photos using highslide.

== Credits ==

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

== Installation ==

1. Upload the files to wp-content/plugins/flickr-highslide
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure Flickr + Highslide by going to Admin -> Settings -> Flickr + Highslide
4. Go to your post/page and insert the tag '[flickr_highslide]'
5. Alternatively you can insert `<?php flickr_highslide(); ?>` within your blog's templates by going to Admin -> Appearance -> Editor

== Screenshots ==

1. Admin Area
2. flickr gallery
3. Highslide

== Frequently Asked Questions ==

= Where can I get a flickr API key? =

You can sign up for a flickr api key here http://www.flickr.com/services/api/keys/apply/

= How do I find a flickr user ID? =

You can use this tool http://idgettr.com/ to find your flickr user ID.

= This photo is currently unavailable =

You get this error if you have changed the permission of your pictures from private to public and vice versa, this changes the URL of the images. If you want large images in your blog then you will need to re-upload your pictures as public to flickr. Changing the image size to medium or small will display your images.