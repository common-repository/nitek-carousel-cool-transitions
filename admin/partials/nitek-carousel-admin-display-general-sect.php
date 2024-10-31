<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.1.0
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/admin/partials
 */	
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<section 
style='background-color: white; padding-left: 3%; padding-right:3%; padding-bottom:3%; padding-top:5px'>		
		
		<h2> Description</h2>
		<p style='font-size:1.15em;'> 
		Nitek Carousel is user friendly wordpress carousel slider plugin. You can create  image carousel with lots of options and cool animation effects. <br>

		Amazing transitions effects sliders using a Custom Post Type (CPT) for choosing images and content which outputs Carousel (slider) from a shortcode <strong>[nitek_sc_1], [nitek_sc_2], [nitek_sc_3], [nitek_sc_4], [nitek_sc_5]</strong> . <br>
		You can use category to group CPT in order to get different sliders. <br>
		<strong>The plugin doesn't need jQuery to work.</strong></p> 

		<p style='font-size:1.15em;'>° Free version of this plugin give you one category with 07 transitions effects and 02 shortcodes available. <br>
		° While with premium version you can use up to 05 differents shortcodes for each 05 categories you can create for sliders. For each category, you can apply differents style as 25 transitions effects, 04 arrows styles and 04 pagination styles.</p>

		<p>
			<h3>Powerful features: </h3>
			<ul>
			 	<li><strong>* Multiple image carousel.</strong></li>
			 	<li><strong>* Lot of amazing transitions effects.</strong></li>
			 	<li><strong>* Lot of styles for navigation arrows.</strong></li>
			 	<li><strong>* Lot of styles for pagination / dots.</strong></li>
			 	<li><strong>* Image caption support.</strong></li>
			 	<li><strong>* Hyperlink image slider enabled.</strong></li>
			 	<li><strong>* Full responsive image </strong></li>
			</ul>
		</p>

		<h2>Shortcode</h2>
		<p style='font-size:1.15em;'>Use these shortcodes in posts, articles or whereever you want : <strong>[ntek_sc_1] and [ntek_sc_2]</strong>. It's for free version of this plugin, then respectively for Carousel Custom Post Type in <strong>nitek_slider_1 and nitek_slider_2</strong> categories. <br>

		For premium version you can use up to 05 differents shortcodes for each 05 categories. User following shortcode [nitek_sc_1], [nitek_sc_2], [nitek_sc_3], [nitek_sc_4] and [nitek_sc_5] respectively for category nitek_slider_1, nitek_slider_2, nitek_slider_3, nitek_slider_4 and nitek_slider_5.</p>

		<h2>Carousel options</h2>
		<p style='font-size:1.15em;'>All options can be set in the CPT Nitek Carousel Settings tabbed page. However, if you'd like more settings options for different sliders styles, you need to buy a premium version of this plugin.</p>

		<h2>How use it</h2>
		<p >
			<ul>
				<ol style='font-size:1.15em;'>° Place the <strong>[nitek_sc_1] / [nitek_sc_2]</strong> shortcode in a Page or Post. You can also use PHP code <strong>do_action('[nitek_sc_1]')</strong>  in your templates.
				</ol>

				<br>
				<ol style='font-size:1.15em;'>
					° Create a category with name <strong>nitek_slider_1 and nitek_slider_2</strong> <br>
					° Create new items in the 'Nitek Carousel' post type. In 'Custom Carousel fields' in post type, write a text description, a caption link (this is not required), upload an Image slider and finaly add each item in <strong>nitek_slider_1 or nitek_slider_2</strong> category. <br><br>
					° Text in description field of post type, is what will be displayed for caption text in each carousel image. <br>
					° You can hyperlink each image by entering the desired url Caption link field of post type when adding a new carousel image. <br>
					°Image you choose in image uploader is what will be display as carousel image slider <br> <br>
					° Note that you can use 05 differents categories in premium version by creating others categories 'nitek_slider_2', 'nitek_slider_3', 'nitek_slider_4' and 'nitek_slider_5'.
				</ol>

				<br>
				<ol style='font-size:1.15em;'>
					° Go to Admin dashboard 'Extensions', you'll see 'Nitek Carousel Settings' at bottom of plugins submenu items. Click on it, you will see four tabs to set carousel options. <br> <br>
					°First tab gives you a description of this Carousel slider. <br><br>
					° Second and third tab allow you to set options for each 02 categories of post type. So each post included in corresponding category here, will use category options set to display carousel. <br><br>
					°Fourth tab presents options for free and premium version of this plugin.
				</ol>
			</ul>
		</p>

		<!-- <br> <br>

	<div>
		<select id="licenses">
		   <option value="1" selected="selected">Single Site License</option>
		   <option value="2">2-Site License</option>
		</select>
		<button id="purchase" class="button button-primary">Get Premium Version</button>
		
		<script src="https://checkout.freemius.com/checkout.min.js"></script>
		<script>
			jQuery(function($) {

		    var handler = FS.Checkout.configure({
		        plugin_id:  '2262',
		        plan_id:    '3464',
		        public_key: 'pk_2091673dbe4b99c1233eb9c2e3f04',
		        image:      'https://nitek.site/logo-100x100.png'
		    });
		    
		    $('#purchase').on('click', function (e) {
		        handler.open({
		            name     : 'Nitek Carousel',
		            licenses : $('#licenses').val(),
		            // You can consume the response for after purchase logic.
		            purchaseCompleted  : function (response) {
		                // The logic here will be executed immediately after the purchase confirmation.                                // alert(response.user.email);
		            },
		            success  : function (response) {
		                // The logic here will be executed after the customer closes the checkout, after a successful purchase.                                // alert(response.user.email);
		            }
		        });
		        e.preventDefault();
		    }); 
		});
		</script>
	</div>
	<br> -->

		<h3> Go to this page to get full options of plugin</h3> 
		<img src="<?php echo plugin_dir_url( __FILE__ ).'../css/img/premium-img.png'?>" alt="Premium plan" width="600" height="250">

		<h4>For any support, please contact us at contact@nitek.site </h4>
		
		<h4>Developped by Nitek ( http://www.nitek.site )</h4>
		
</section>
     
	    

