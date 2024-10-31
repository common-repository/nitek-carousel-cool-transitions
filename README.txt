=== Plugin Name ===
Contributors: djenh
Donate link: nitek.site
Tags: carousel, slider, image, cool transitions,image carousel, image slider, carousel slider, shortcode
Requires at least: 3.0.1
Tested up to: 4.9.6
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Nitek Carousel is user friendly wordpress carousel slider plugin. You can create  image carousel with lots of options and cool animation effects. It's an amazing transitions effects sliders using a Custom Post Type (CPT) for choosing images and content which outputs Carousel (slider) from a shortcode. 
You can also use category to group CPT in order to get different sliders.

== Description ==

Nitek Carousel is user friendly wordpress carousel slider plugin. You can create  image carousel with lots of options and cool animation effects. 

Amazing transitions effects sliders using a Custom Post Type (CPT) for choosing images and content which outputs Carousel (slider) from a shortcode <strong>[nitek_sc_1], [nitek_sc_2], [nitek_sc_3], [nitek_sc_4], [nitek_sc_5]</strong> . 
* You can use category to group CPT in order to get different sliders. 
* The plugin doesn't need jQuery to work. <br>

* Free version of this plugin give you one category with 07 transitions effects and 02 shortcodes available. 
* While with premium version you can use up to 05 differents shortcodes for each 05 categories you can create for sliders. For each category, you can apply differents style as 25 transitions effects, 04 arrows styles and 04 pagination styles.


== Powerful features ==
* Multiple image carousel.
* Lot of amazing transitions effects.
* Lot of styles for navigation arrows.
* Lot of styles for pagination / dots.
* Image caption support.
* Hyperlink image slider enabled.
* Full responsive image 
	



== Shortcode ==
Use these shortcodes in posts, articles or whereever you want : <strong>[ntek_sc_1] and [ntek_sc_2]</strong>. It's for free version of this plugin, then respectively for Carousel Custom Post Type in <strong>nitek_slider_1 and nitek_slider_2</strong> categories. 

For premium version you can use up to 05 differents shortcodes for each 05 categories. User following shortcode [nitek_sc_1], [nitek_sc_2], [nitek_sc_3], [nitek_sc_4] and [nitek_sc_5] respectively for category nitek_slider_1, nitek_slider_2, nitek_slider_3, nitek_slider_4 and nitek_slider_5.



== Carousel Options ==
All of these options can be set in the CPT Nitek Carousel Settings page. 
However, if you'd like more settings options for different sliders styles, you need to buy a premium version of this plugin.

* 'interval' _(default 1000)_
    Length of time for the caption to pause on each image. Time in milliseconds.

* 'showCaption' _(default true)_
    * Whether to display the text caption on each image or not. 'Show' or 'Hide' options are available.

* 'showArrows' _(default true)_
    * Whether to display the control arrows or not. 'Show' or 'Hide' options are available.
	
* 'showPagination' _(default true)_
    * Whether to display the pagination or not. 'Show' or 'Hide' options are available.

* 'transitionEffect' _(default Fade)_
    * Transition effects available for carousel. 07 effects are available in free version and 25 effects in premium version.

* 'category' _(default nitek_slider_1)_
	* Category for which belongs CPT slides. Create and apply "nitek_slider_1" or "nitek_slider_2" category to all carousel custom post type created. 05 categories are allowed in premium version.
	
* 'imageSize' _(default Responsive)_
    * Response size for image in carousel. 
	
* 'captionLink' _(default Yes)_
    * Hyperlink each image of carousel.


	
== Installation ==

= The easy way =

1. Go to the Plugins Menu in WordPress
2. Search for "Nitek Carousel Slider Cool Transitions"
3. Click 'Install'
4. Activate the plugin

= Manual Installation =

1. Download the plugin file while searching for "Nitek Carousel Slider Cool Transitions" plugin on net.
2. Unzip and upload the 'nitek-carousel' folder to the `/wp-content/plugins/` directory
3. Activate the 'nitek-carousel' plugin through the 'Plugins' menu in WordPress.

= Once Activated =

1. Place the '[nitek_sc_1]' shortcode in a Page or Post. You can also use PHP code '<?php do_action('[nitek_sc_1]'); ?> in your templates

2. 
	<ul>
	 	<li>Create a category with name "nitek_slider_1" and/or "nitek_slider_2"</li>

	 	<li>Create new items in the 'Nitek Carousel' post type. In 'Custom Carousel fields' in post type, write a text description, a caption link (this is not required), upload an Image slider and finaly add each item in <strong>nitek_slider_1 or nitek_slider_2</strong> category </li>

	 	<li>Text in description field of post type, is what will be displayed for caption text in each carousel image.</li>

	 	<li>You can hyperlink each image by entering the desired url Caption link field of post type when adding a new carousel image.</li>

	 	<li>Image you choose in image uploader is what will be display as carousel image slider</li>

	 	<li>Note that you can use 05 differents categories in premium version by creating others categories 'nitek_slider_2', 'nitek_slider_3', 'nitek_slider_4' and 'nitek_slider_5'.</li>
	</ul>


3. Go to Admin dashboard "Extensions", you'll see "Nitek Carousel Settings" at bottom of plugins submenu items. 
	Click on it, you see six tabs to set carousel options.
	On each tab, you can set options for each 05 categories allowed.




== Frequently Asked Questions ==

= Can I have different carousels with different images on the same site? =

Yes - create a few categories and add your specific images to a specific category.

= Can I customise the way it looks / works? =
Yes - you can choose between 07 transition effects in free version and 20 effects in premium version.
Also you can change arrows and pagination style in premium version.

= Help! Nothing is showing up at all =
1. Is the plugin installed and activated ?
2. Have you added any items in the 'Nitek Carousel' post type ?
3. Have you created and added any items in the 'nitek_slider_1' category ?
4. Have you placed the '[nitek_sc_1]' shortcode in your page?

Try writing the shortcode using the 'Text' editor instead of the 'Visual' editor, as the visual editor can sometimes add extra unwanted markup.



== Screenshots ==

1. Admin list interface showing Carousel options.
2. Post created with description caption, caption link and image slider choose in Nitek Carousel post type.
3. Output Example 1.
4. Output Example 2.

== Changelog ==

= 1.1.0 =
* Fix security issues
* Add one more navigation arrows style 
* Add one more pagination style 
* Add custom fields in custom post type
* Fix bug related to carousel images loading


= 1.0.0 =
* Initial release


