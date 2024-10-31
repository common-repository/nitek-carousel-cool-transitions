<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.1.0
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/admin
 * @author     Edgar DJENONTIN <#>
 */
class Nitek_Carousel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nitek_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nitek_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nitek-carousel-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nitek_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nitek_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nitek-carousel-admin.js', array( 'jquery' ), $this->version, false );

	}




	/**
	 * Redirect to setting page of Nitek Carousel plugin after activation
	 *
	 * @since    1.1.0
	 */
	public function nitek_activate_plugin(){
 		exit(wp_redirect(admin_url('plugins.php?page=nitek-menu-carousel&tab=general_sect')) ); 		
	}



	 /**
	 * Create a Custom Post Type for carousel
	 *
	 * @since    1.1.0
	 */
	public function nitek_create_cpt(){

		$labels = array(
			'name'               => __('Nitek Carousel', 'nitek-carousel'),
			'singular_name'      => __('Nitek Carousel', 'nitek-carousel'),
			'menu_name'          => __('Nitek Carousel', 'nitek-carousel'),
			'name_admin_bar'     => __('Nitek Carousel', 'nitek-carousel'),
			'add_new'            => __('Add New', 'nitek-carousel'),
			'add_new_item'       => __('Add New Item', 'nitek-carousel'),
			'new_item'           => __('New Item', 'nitek-carousel'),
			'edit_item'          => __('Edit Item', 'nitek-carousel'),
			'view_item'          => __('View Item', 'nitek-carousel'),
			'all_items'          => __('All Items', 'nitek-carousel'),
			'search_items'       => __('Search Items', 'nitek-carousel'),			
			'not_found'          => __('No items found.', 'nitek-carousel'),
			'not_found_in_trash' => __('No items found in Trash.', 'nitek-carousel')
		);

		$args = array( 
			'public'      => true, 
			'labels'      => $labels,
			'description' => 'A Custom Post Type for choosing images and content which outputs  Carousel slider',
			'taxonomies'		=> array( 'category' ),
			'supports'      => array( 'title', 'thumbnail' ),
			'hierarchical' => true,
			'has_archive'  => true,
			'menu_icon'   => 'dashicons-images-alt',
		);	
		
		register_post_type( 'nitek-carousel-cpt', $args );
	}




	/**
	 * Create meta box fields
	 *
	 * @since    1.1.0
	*/
	public function nitek_create_mb() {
		add_meta_box(
			'nitek-carousel-mb', 
			__('Carousel fields', 'nitek-carousel'), 
			array($this,'show_meta_box_fields_cb'), 
			'nitek-carousel-cpt', 
			'normal', 
			'high' 
		);
	}



	/**
	 * Show meta box fields
	 *
	 * @since    1.1.0
	*/
	public function show_meta_box_fields_cb() {
		global $post;  
			$metaDesc = get_post_meta( $post->ID, 'mb_desc', true ); 
			$metaLink = get_post_meta( $post->ID, 'mb_caption_link', true ); 
			$metaImg = get_post_meta( $post->ID, 'mb_img_slider', true ); ?>

		<input type="hidden" name="nitek_mb_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

		<?php

	    include_once 'partials/nitek-carousel-admin-display-mb.php';

	}


	/**
	 * Save meta box fields
	 *
	 * @since    1.1.0
	*/
	public function save_meta_box_fields( $post_id ) {   
		// verify nonce
		if ( isset($_POST['nitek_mb_nonce']) 
			&& !wp_verify_nonce( $_POST['nitek_mb_nonce'], basename(__FILE__) ) ) {
			return $post_id; 
		}

		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// check permissions
		if (isset($_POST['post_type'])) { //Fix 2
			if ( 'page' === $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}  
			}
		}

		$oldDesc = get_post_meta( $post_id, 'mb_desc', true );

		if (isset($_POST['mb_desc'])) { //Fix 3

			$newDesc =  sanitize_text_field ( $_POST['mb_desc'] ) ;

			if ( $newDesc && $newDesc !== $oldDesc ) {
				update_post_meta( $post_id, 'mb_desc', $newDesc );
			} elseif ( '' === $newDesc && $oldDesc ) {
				delete_post_meta( $post_id, 'mb_desc', $oldDesc );
			}
		}

		$oldLink = get_post_meta( $post_id, 'mb_caption_link', true );

		if (isset($_POST['mb_caption_link'])) { 

			$newLink =  esc_url(strip_tags( stripslashes( $_POST['mb_caption_link'] ) ) ) ;
			if ($newLink == "" || $newLink = null){$newLink = "#";}
			
			if ( $newLink && $newLink !== $oldLink ) {
				update_post_meta( $post_id, 'mb_caption_link', $newLink );
			} elseif ( '' === $newLink && $oldLink ) {
				delete_post_meta( $post_id, 'mb_caption_link', $oldLink );
			}
		}

		$oldImg = get_post_meta( $post_id, 'mb_img_slider', true );

		if (isset($_POST['mb_img_slider'])) { //Fix 3

			$newImg =  sanitize_text_field ( $_POST['mb_img_slider'] ) ;

			if ( $newImg && $newImg !== $oldImg ) {
				update_post_meta( $post_id, 'mb_img_slider', $newImg );
			} elseif ( '' === $newImg && $oldImg ) {
				delete_post_meta( $post_id, 'mb_img_slider', $oldImg );
			}
		}
	}






	 /**
	 * Create menu page for carousel in admin area.
	 *
	 * @since    1.1.0
	 */
	public function nitek_create_plugin_page(){

		add_plugins_page(			
	        'Nitek Carousel Settings',         
	        __('Nitek Carousel Settings', 'nitek-carousel'),  
	        'manage_options',            
	        'nitek-menu-carousel',                  
	        array($this, 'nitek_plugin_page_display_cb')
	    );
	}


	/**
	 * Callback function to display menu page for carousel in admin area.
	 *
	 * @since    1.1.0
	 */
	public function nitek_plugin_page_display_cb(){

		include_once 'partials/nitek-carousel-admin-display.php';
	}


	/**
	 * Register general section for CPT settings
	 *
	 * @since    1.1.0
	*/
	public function nitek_create_general_section(){
		
		add_settings_section(
	        'nitek-general-section',         
	        __('Welcome to Nitek Carousel Plugin (Cool transition effects)', 'nitek-carousel'),                  
	        array($this, 'nitek_display_general_section_cb'), 
	        'nitek-carousel-display-general'                           
	    );
	}


	/**
	 * Render text for general section
	 *
	 * @since    1.1.0
	*/
	public function nitek_display_general_section_cb(){ 
		include_once 'partials/nitek-carousel-admin-display-general-sect.php';	
	}





	/*--------------------------------------------------------------------------   */
	/*-------------------------- CONFIG PAGE 1 ---------------------------------   */
	/*--------------------------------------------------------------------------   */

	/**
	 * Register config section for CPT settings
	 *
	 * @since    1.1.0
	*/
	public function nitek_create_config_section(){

		add_settings_section(
	        'nitek-config-section',         
	        __('Settings carousel options for nitek_slider_1 category', 'nitek-carousel'),                  
	        array($this, 'nitek_display_config_section_1_cb'), 
	        'nitek-carousel-display-config'                           
	    );

	    add_settings_field( 
		    'field_duration_1',                      
		    __('Interval Diapo duration (ms)', 'nitek-carousel'), 
		    array($this, 'nitek_show_duration_field_1_cb'),   
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',        
		    array('Length of time for the caption to pause on each image. Time in milliseconds.' )
		);


		add_settings_field( 
		    'field_show_caption_1', 
		    __('Show caption ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_caption_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Show slides captions or not.' )
		);

		add_settings_field( 
		    'field_show_bullet_1', 
		    __('Show pagination ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_bullet_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Show pagination on slides' )
		);

		add_settings_field( 
		    'field_change_bullet_1', 
		    __('Change pagination ', 'nitek-carousel'),                           
		    array($this, 'nitek_change_bullet_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Change pagination type on slides' )
		);

		add_settings_field( 
		    'field_show_arrows_1', 
		    __('Show navigation arrows ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_arrows_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Show navigation arrows on slides' )
		);

		add_settings_field( 
		    'field_change_arrows_1', 
		    __('Change navigation arrows ', 'nitek-carousel'),                           
		    array($this, 'nitek_change_arrows_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Change navigation arrows type on slides' )
		);

		add_settings_field( 
		    'field_transition_effect_1', 
		    __('Transitions effects ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_transition_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Choose a transition effects for slides' )
		);

		add_settings_field( 
		    'field_category_1', 
		    __('Slides Category ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_category_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Category for which belongs CPT slides' )
		);

		add_settings_field( 
		    'field_img_size_1', 
		    __('Image size ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_img_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Image size in slides' )
		);

		add_settings_field( 
		    'field_link_caption_1', 
		    __('Enable Caption link', 'nitek-carousel'),                           
		    array($this, 'nitek_show_link_field_1_cb'),  
		    'nitek-carousel-display-config',                          
		    'nitek-config-section',         
		    array('Hyperlink each image of carousel' )
		);


		register_setting('nitek-carousel-display-config',  'field_duration_1', 'sanitize_field_duration_1' );
		register_setting('nitek-carousel-display-config',  'field_show_caption_1' );
		register_setting('nitek-carousel-display-config',  'field_show_bullet_1' );
		register_setting('nitek-carousel-display-config',  'field_change_bullet_1' );
		register_setting('nitek-carousel-display-config',  'field_show_arrows_1' );
		register_setting('nitek-carousel-display-config',  'field_change_arrows_1' );
		register_setting('nitek-carousel-display-config',  'field_transition_effect_1' );
		register_setting('nitek-carousel-display-config',  'field_category_1' );
		register_setting('nitek-carousel-display-config',  'field_img_size_1' );
		register_setting('nitek-carousel-display-config',  'field_link_caption_1' );
	}


	/**
	 * Render text for config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_display_config_section_1_cb(){
		echo '<p>' . __('Use below options to set styles for carousel to display sliders for nitek_slider_1 category', 'nitek-carousel') . '</p> <hr>';
	}

	/**
	 * Render text for Duration field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_duration_field_1_cb($args){
		$options = (int) get_option( 'field_duration_1' );
		if ($options == null || $options <= 1000){ $options = 1000 ;}
	    
	    echo '<input type="text" id="field_duration_1" name="field_duration_1" value="' . $options . '" />';
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for="field_duration_1"> '. $args[0] .'</label>';      
	}

	/**
	 * Sanitize text field for duration field in config section
	 *
	 * @since    1.1.0
	*/
	function sanitize_field_duration_1($input){
		return (int) (strip_tags( stripslashes( $input) ) );
	}


	/**
	 * Render text for Caption text field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_caption_field_1_cb($args){
		$options = get_option( 'field_show_caption_1' );
	     
	    $html = '<input type="radio" id="field_show_caption_1_one" name="field_show_caption_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_caption_1_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_caption_1_two" name="field_show_caption_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_caption_1_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ; 

	    echo $html;     
	}


	/**
	 * Render showing Bullet / Pagination field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_bullet_field_1_cb($args){
		$options = get_option( 'field_show_bullet_1' );
	     
	    $html = '<input type="radio" id="field_show_bullet_1_one" name="field_show_bullet_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_bullet_1_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_bullet_1_two" name="field_show_bullet_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_bullet_1_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}

	/**
	 * Render changing Bullet / Pagination field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_change_bullet_field_1_cb($args){
		$options = get_option( 'field_change_bullet_1' );
		$path1 = plugin_dir_url( __FILE__ ).'../public/css/img/bullet1.PNG';
		$path2 = plugin_dir_url( __FILE__ ).'../public/css/img/bullet2.PNG';		
	     
	    $html = '<input type="radio" id="field_change_bullet_1_one" name="field_change_bullet_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_change_bullet_1_one"> <img src='.$path1.'  width="100"/> </label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_change_bullet_1_two" name="field_change_bullet_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_change_bullet_1_two"> <img src='.$path2.'  width="100"/> </label>';

	    

	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}


	/**
	 * Render showing Navigation arrows field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_arrows_field_1_cb($args){
		$options = get_option( 'field_show_arrows_1' );		
	     
	    $html = '<input type="radio" id="field_show_arrows_1_one" name="field_show_arrows_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_arrows_1_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_arrows_1_two" name="field_show_arrows_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_arrows_1_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}


	/**
	 * Render changin Navigation arrows field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_change_arrows_field_1_cb($args){
		$options = get_option( 'field_change_arrows_1' );
		$path1 = plugin_dir_url( __FILE__ ).'../public/css/img/arrow1.png';
		$path2 = plugin_dir_url( __FILE__ ).'../public/css/img/arrow2.png';
	     
	    $html = '<input type="radio" id="field_change_arrows_1_one" name="field_change_arrows_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_change_arrows_1_one"> <img src='.$path1.'  width="60" height="50"/>  </label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_change_arrows_1_two" name="field_change_arrows_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_change_arrows_1_two"> <img src='.$path2.'  width="60" height="50"/>  </label>';
	    

	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}


	/**
	 * Render showing Transition effects field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_transition_field_1_cb($args){
		$options = get_option( 'field_transition_effect_1' );		
	     
	    $html = '<select id="field_transition_effect_1" name="field_transition_effect_1">';

	    	$html .= '<option value="ParabolaStairsIn"' . selected( $options, 'ParabolaStairsIn', false) . '>Parabola stairs</option>';

	        $html .= '<option value="CollapseStairs"' . selected( $options, 'CollapseStairs', false) . '>Collapse as stairs</option>';

			$html .= '<option value="DodgeDanceIn"' . selected( $options, 'DodgeDanceIn', false) . '>Dodge dance in</option>';

			$html .= '<option value="Fade"' . selected( $options, 'Fade', false) . '>Fade</option>';		

			$html .= '<option value="Slide"' . selected( $options, 'Slide', false) . '>Slide</option>';

			$html .= '<option value="SwingInStairs"' . selected( $options, 'SwingInStairs', false) . '>Swing in stairs</option>';			

			$html .= '<option value="ZoomIn"' . selected( $options, 'ZoomIn', false) . '>Zoom In</option>';				

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_duration_1"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Category field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_category_field_1_cb($args){
		$options = get_option( 'field_category_1' );
	     
	    $html = '<select id="field_category_1" name="field_category_1">';

	        $html .= '<option value="nitek_slider_1"' . selected( $options, 'nitek_slider_1', false) . '>nitek_slider_1</option>';

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_category_1"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Image size field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_img_field_1_cb($args){
		$options = get_option( 'field_img_size_1' );
	     
	    $html = '<select id="field_img_size_1" name="field_img_size_1">';

	        
	        $html .= '<option value="responsive"' . selected( $options, 'responsive', false) . '>Responsive</option>';

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_img_size_1"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Text link caption field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_link_field_1_cb($args){
		$options = get_option( 'field_link_caption_1' );		
	     
	    $html = '<input type="radio" id="field_link_caption_1_one" name="field_link_caption_1" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_link_caption_1_one">Yes</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_link_caption_1_two" name="field_link_caption_1" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_link_caption_1_two">No</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}




	/* ---------------------------------------------------------------------------*/
	/*-------------------------- CONFIG PAGE 2 ---------------------------------   */
	/* ---------------------------------------------------------------------------*/

	/**
	 * Register config section 2 for CPT settings
	 *
	 * @since    1.1.0
	*/
	public function nitek_create_config_section_2(){

		add_settings_section(
	        'nitek-config-section-2',         
	        __('Settings carousel options for nitek_slider_2 category', 'nitek-carousel'),                  
	        array($this, 'nitek_display_config_section_2_cb'), 
	        'nitek-carousel-display-config-2'                           
	    );

	    add_settings_field( 
		    'field_duration_2',                      
		    __('Interval Diapo duration (ms)', 'nitek-carousel'), 
		    array($this, 'nitek_show_duration_field_2_cb'),   
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',        
		    array('Length of time for the caption to pause on each image. Time in milliseconds.' )
		);


		add_settings_field( 
		    'field_show_caption_2', 
		    __('Show caption ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_caption_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Show slides captions or not.' )
		);

		add_settings_field( 
		    'field_show_bullet_2', 
		    __('Show pagination ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_bullet_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Show pagination on slides' )
		);

		add_settings_field( 
		    'field_change_bullet_2', 
		    __('Change pagination ', 'nitek-carousel'),                           
		    array($this, 'nitek_change_bullet_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Change pagination type on slides' )
		);

		add_settings_field( 
		    'field_show_arrows_2', 
		    __('Show navigation arrows ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_arrows_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Show navigation arrows on slides' )
		);

		add_settings_field( 
		    'field_change_arrows_2', 
		    __('Change navigation arrows ', 'nitek-carousel'),                           
		    array($this, 'nitek_change_arrows_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Change navigation arrows type on slides' )
		);

		add_settings_field( 
		    'field_transition_effect_2', 
		    __('Transitions effects ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_transition_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Choose a transition effects for slides' )
		);

		add_settings_field( 
		    'field_category_2', 
		    __('Slides Category ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_category_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Category for which belongs CPT slides' )
		);

		add_settings_field( 
		    'field_img_size_2', 
		    __('Image size ', 'nitek-carousel'),                           
		    array($this, 'nitek_show_img_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Image size in slides' )
		);

		add_settings_field( 
		    'field_link_caption_2', 
		    __('Enable Caption link', 'nitek-carousel'),                           
		    array($this, 'nitek_show_link_field_2_cb'),  
		    'nitek-carousel-display-config-2',                          
		    'nitek-config-section-2',         
		    array('Hyperlink each image of carousel' )
		);


		register_setting('nitek-carousel-display-config-2',  'field_duration_2', 'sanitize_field_duration_2' );
		register_setting('nitek-carousel-display-config-2',  'field_show_caption_2' );
		register_setting('nitek-carousel-display-config-2',  'field_show_bullet_2' );
		register_setting('nitek-carousel-display-config-2',  'field_change_bullet_2' );
		register_setting('nitek-carousel-display-config-2',  'field_show_arrows_2' );
		register_setting('nitek-carousel-display-config-2',  'field_change_arrows_2' );
		register_setting('nitek-carousel-display-config-2',  'field_transition_effect_2' );
		register_setting('nitek-carousel-display-config-2',  'field_category_2' );
		register_setting('nitek-carousel-display-config-2',  'field_img_size_2' );
		register_setting('nitek-carousel-display-config-2',  'field_link_caption_2' );
	}


	/**
	 * Render text for config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_display_config_section_2_cb(){
		echo '<p>' . __('Use below options to set styles for carousel to display sliders for nitek_slider_2 category', 'nitek-carousel') . '</p> <hr>';
	}

	/**
	 * Render text for Duration field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_duration_field_2_cb($args){
		$options = (int) get_option( 'field_duration_2' );
		if ($options == null || $options <= 1000){ $options = 1000 ;}
	    
	    echo '<input type="text" id="field_duration_2" name="field_duration_2" value="' . $options . '" />';
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for="field_duration_2"> '. $args[0] .'</label>';      
	}


	/**
	 * Sanitize text field for duration field in config section
	 *
	 * @since    1.1.0
	*/
	function sanitize_field_duration_2($input){
		return (int) (strip_tags( stripslashes( $input) ) );
	}


	/**
	 * Render text for Caption text field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_caption_field_2_cb($args){
		$options = get_option( 'field_show_caption_2' );		
	     
	    $html = '<input type="radio" id="field_show_caption_2_one" name="field_show_caption_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_caption_2_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_caption_2_two" name="field_show_caption_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_caption_2_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ; 

	    echo $html;     
	}


	/**
	 * Render showing Bullet / Pagination field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_bullet_field_2_cb($args){
		$options = get_option( 'field_show_bullet_2' );		
	     
	    $html = '<input type="radio" id="field_show_bullet_2_one" name="field_show_bullet_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_bullet_2_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_bullet_2_two" name="field_show_bullet_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_bullet_1_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}

	/**
	 * Render changing Bullet / Pagination field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_change_bullet_field_2_cb($args){
		$options = get_option( 'field_change_bullet_2' );
		$path1 = plugin_dir_url( __FILE__ ).'../public/css/img/bullet1.PNG';
		$path2 = plugin_dir_url( __FILE__ ).'../public/css/img/bullet2.PNG';
	     
	    $html = '<input type="radio" id="field_change_bullet_2_one" name="field_change_bullet_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_change_bullet_2_one"> <img src='.$path1.'  width="100"/> </label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_change_bullet_2_two" name="field_change_bullet_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_change_bullet_2_two"> <img src='.$path2.'  width="100"/> </label>';
	   


	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}


	/**
	 * Render showing Navigation arrows field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_arrows_field_2_cb($args){
		$options = get_option( 'field_show_arrows_2' );		
	     
	    $html = '<input type="radio" id="field_show_arrows_2_one" name="field_show_arrows_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_show_arrows_2_one">Show</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_show_arrows_2_two" name="field_show_arrows_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_show_arrows_2_two">Hide</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}



	/**
	 * Render changin Navigation arrows field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_change_arrows_field_2_cb($args){
		$options = get_option( 'field_change_arrows_2' );
		$path1 = plugin_dir_url( __FILE__ ).'../public/css/img/arrow1.png';
		$path2 = plugin_dir_url( __FILE__ ).'../public/css/img/arrow2.png';
	     
	    $html = '<input type="radio" id="field_change_arrows_2_one" name="field_change_arrows_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_change_arrows_2_one"> <img src='.$path1.'  width="60" height="50"/>  </label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_change_arrows_2_two" name="field_change_arrows_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_change_arrows_2_two"> <img src='.$path2.'  width="60" height="50"/>  </label>';
	   

	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}



	/**
	 * Render showing Transition effects field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_transition_field_2_cb($args){
		$options = get_option( 'field_transition_effect_2' );		
	     
	    $html = '<select id="field_transition_effect_2" name="field_transition_effect_2">';

	    	$html .= '<option value="ParabolaStairsIn"' . selected( $options, 'ParabolaStairsIn', false) . '>Parabola stairs</option>';

	        $html .= '<option value="CollapseStairs"' . selected( $options, 'CollapseStairs', false) . '>Collapse as stairs</option>';

			$html .= '<option value="DodgeDanceIn"' . selected( $options, 'DodgeDanceIn', false) . '>Dodge dance in</option>';

			$html .= '<option value="Fade"' . selected( $options, 'Fade', false) . '>Fade</option>';		

			$html .= '<option value="Slide"' . selected( $options, 'Slide', false) . '>Slide</option>';

			$html .= '<option value="SwingInStairs"' . selected( $options, 'SwingInStairs', false) . '>Swing in stairs</option>';			

			$html .= '<option value="ZoomIn"' . selected( $options, 'ZoomIn', false) . '>Zoom In</option>';	

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_duration_2"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Category field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_category_field_2_cb($args){
		$options = get_option( 'field_category_2' );
	     
	    $html = '<select id="field_category_2" name="field_category_2">';

	        $html .= '<option value="nitek_slider_2"' . selected( $options, 'nitek_slider_2', false) . '>nitek_slider_2</option>';

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_category_2"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Image size field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_img_field_2_cb($args){
		$options = get_option( 'field_img_size_2' );
	     
	    $html = '<select id="field_img_size_2" name="field_img_size_2">';

	        
	        $html .= '<option value="responsive"' . selected( $options, 'responsive', false) . '>Responsive</option>';

	    $html .= '</select>';
	      
	  
	    $html .=  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="field_img_size_2"> '. $args[0] .'</label>';  

	    echo $html;     
	}


	/**
	 * Render showing Text link caption field in config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_show_link_field_2_cb($args){
		$options = get_option( 'field_link_caption_2' );
	     
	    $html = '<input type="radio" id="field_link_caption_2_one" name="field_link_caption_2" value="1"' . checked( 1, $options, false ) . '/>';
	    $html .= '<label for="field_link_caption_2_one">Yes</label>';

	    $html .="    ";
	     
	    $html .= '<input type="radio" id="field_link_caption_2_two" name="field_link_caption_2" value="2"' . checked( 2, $options, false ) . '/>';
	    $html .= '<label for="field_link_caption_2_two">No</label>';
	    $html .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	     
	  
	    $html .=  $args[0] ;  

	    echo $html;     
	}


	
	/*-------------------------------------------------------------------------   */
	/*-------------------------- CONTACT PAGE ---------------------------------   */
	/*-------------------------------------------------------------------------   */

	/**
	 * Register contact section for CPT settings
	 *
	 * @since    1.1.0
	*/
	public function nitek_create_contact_section(){

		add_settings_section(
	        'nitek-contact-section',         
	        __('Free vs Premium options', 'nitek-carousel'),                  
	        array($this, 'nitek_display_contact_section_cb'), 
	        'nitek-carousel-display-contact'                           
	    );
	}


	/**
	 * Render text for config section
	 *
	 * @since    1.1.0
	*/
	public function nitek_display_contact_section_cb(){

		include_once 'partials/nitek-carousel-admin-display-free_premium-sect.php';		
	 }

}
