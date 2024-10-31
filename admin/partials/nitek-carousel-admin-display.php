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



	<div class="wrap">
		<h2>Nitek Carousel Plugin</h2>	
	</div>

	<?php 
		settings_errors(); 

		if ( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = sanitize_text_field($_GET[ 'tab' ]) ;
		}else {
			$active_tab = 'general_sect' ;
		}


	    // $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_sect';
	?>
	 
	<h2 class="nav-tab-wrapper">
	    <a href="?page=nitek-menu-carousel&tab=general_sect" class="nav-tab <?php echo $active_tab == 'general_sect' ? 'nav-tab-active' : ''; ?>">Getting Started</a>

	    <a href="?page=nitek-menu-carousel&tab=config_sect_1" class="nav-tab <?php echo $active_tab == 'config_sect_1' ? 'nav-tab-active' : ''; ?>">Category 1 options</a>

	   <a href="?page=nitek-menu-carousel&tab=config_sect_2" class="nav-tab <?php echo $active_tab == 'config_sect_2' ? 'nav-tab-active' : ''; ?>">Category 2 options</a>

	   <a href="?page=nitek-menu-carousel&tab=contact_sect" class="nav-tab <?php echo $active_tab == 'contact_sect' ? 'nav-tab-active' : ''; ?>">Free vs Premium</a>	   
	</h2>



	<form method="post" action="options.php">
	    <?php
	         
	        if( $active_tab == 'general_sect' ) {	        	
	            settings_fields( 'nitek-carousel-display-general' );
	            do_settings_sections( 'nitek-carousel-display-general' );
	        } 
	        else if( $active_tab == 'config_sect_1' ) {
	            settings_fields( 'nitek-carousel-display-config' );
	            do_settings_sections( 'nitek-carousel-display-config' );
	            submit_button();
	        }
	        else if( $active_tab == 'config_sect_2' ) {
	            settings_fields( 'nitek-carousel-display-config-2' );
	            do_settings_sections( 'nitek-carousel-display-config-2' );
	            submit_button();
	        }
	        else if( $active_tab == 'contact_sect' ) {
	            settings_fields( 'nitek-carousel-display-contact' );
	            do_settings_sections( 'nitek-carousel-display-contact' );
	        }
	       	        	        
	         
	    ?>
	</form>
     
	    

