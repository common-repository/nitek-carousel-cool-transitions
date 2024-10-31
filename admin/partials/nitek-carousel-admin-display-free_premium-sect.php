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



	<section style=' padding-top: 5%; padding-bottom:5%; padding-left: 10%; padding-right:10% '>	
		

		<table class='widefat fixed' cellspacing='0' style=''>
		    <thead >
		    <tr>
            <th id='opt' class='manage-column column-opt' scope='col' style='font-weight: bold; font-size:1.3em;'> Options</th>
            <th id='free' class='manage-column column-free' scope='col' style='font-weight: bold; font-size:1.3em; text-align:center'> Free plugin</th>
            <th id='premium' class='manage-column column-premium' scope='col' style='font-weight: bold; font-size:1.3em; text-align:center'>Premium plugin</th> 

		    </tr>
		    </thead>
		    

		    <tbody >
		        <tr class='alternate' >		            
		            <td class='column-opt' style='font-size:1.2em;'>Transition effects </td>
		            <td class='column-free' style='font-size:1.2em; text-align:center;'> 07 </td>
		            <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'> <strong> 25 </strong></td>
		        </tr>
		        <tr>
		            <td class='column-opt' style='font-size:1.2em;'>Arrows styles available</td>
		            <td class='column-free' style='font-size:1.2em; text-align:center;'> 02 </td>
		            <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'><strong> 04 </strong></td>
		        </tr>

		        <tr class='alternate'>		            
		            <td class='column-opt' style='font-size:1.2em;'>Pagination styles available </td>
		            <td class='column-free' style='font-size:1.2em; text-align:center;'> 02 </td>
		            <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'> <strong>04 </strong></td>
		        </tr>
		        <tr>
		            <td class='column-opt' style='font-size:1.2em;'>Support</td>
		            <td class='column-free' style='font-size:1.2em; text-align:center;'> Little </td>
		            <td class='column-premium' style='font-size:1.2em; text-align:center; color:green;'><strong> Great technical support </strong></td>
		        </tr>
		        
		    </tbody>
		</table>
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
		</div> -->

		<h3> Go to this page to get full options of plugin</h3> 
		<img src="<?php echo plugin_dir_url( __FILE__ ).'../css/img/premium-img.png'?>" alt="Premium plan" width="600" height="250">
		
	</section>

