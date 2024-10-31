<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.1.0
 *
 * @package    Nitek_Carousel
 * @subpackage Nitek_Carousel/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<?php 

    $field_duration = (int)  get_option('field_duration_2', 1000);

    $field_show_caption = get_option('field_show_caption_2',1);

    $field_show_bullet = get_option('field_show_bullet_2',1);

    $field_change_bullet = get_option('field_change_bullet_2',1);

    $field_show_arrows = get_option('field_show_arrows_2',1);

    $field_change_arrows = get_option('field_change_arrows_2',1);


    $field_transition_effect = get_option('field_transition_effect_2', 'ParabolaStairsIn');

    $field_category = get_option('field_category_2');

    $field_img_size = get_option('field_img_size_2');

    $field_link_caption = get_option('field_link_caption_2',1);
    
?>

<!-- <script src="<?php //echo plugin_dir_url( __FILE__ ).'../js/2-jssor.slider-21.1.5.min.js'; ?>"> </script> -->

<script>

    var field_duration = <?php echo $field_duration; ?>;
    var field_transition_effect = "<?php echo $field_transition_effect; ?>";
    var field_show_caption = <?php echo $field_show_caption; ?>;

    var field_show_bullet = <?php echo $field_show_bullet; ?>;
    var field_change_bullet = <?php echo $field_change_bullet; ?>;
    var field_show_arrows = <?php echo $field_show_arrows; ?>;
    var field_change_arrows = <?php echo $field_change_arrows; ?>;

    // var field_link_caption = "<?php //echo $field_link_caption; ?>";
    
   // console.log("Durée 5 : "+field_duration);
     /*console.log("Transition : "+field_transition_effect);
    console.log("Caption : "+field_show_caption);
    console.log("Arrow : "+field_change_arrows);
    console.log("Bullet : "+field_change_bullet);*/
    
    // console.log("Position 1___avant fonction ");

    jssor_22_slider_init = function() {      

        var jssor_22_Transition ;
        var jssor_22_options = {};

        /* --------- Defining jssor transitions effects ---------------*/

        if( field_transition_effect == "Fade"){
            jssor_22_Transition = [{$Duration:field_duration, $Opacity:2}];
        }
        else if( field_transition_effect == "CollapseStairs"){
            jssor_22_Transition = [{$Duration:field_duration,$Delay:12,$Cols:10,$Rows:5,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:$Jease$.$OutQuad,$Opacity:2,$Assembly:2049},];
        }
        else if( field_transition_effect == "SwingInStairs"){
            jssor_22_Transition = [{$Duration:field_duration,x:0.2,y:-0.1,$Delay:16,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Opacity:2,$Assembly:260,$Round:{$Left:1.3,$Top:2.5}},];
        }
        else if( field_transition_effect == "ParabolaStairsIn"){
            jssor_22_Transition = [{$Duration:field_duration,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InQuart,$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear},$Opacity:2} ,];
        }
        else if( field_transition_effect == "Slide"){
            jssor_22_Transition = [{$Duration:field_duration,x:-1,$Easing:$Jease$.$InQuad,$Opacity:2} , ];
        }
        else if( field_transition_effect == "DodgeDanceIn"){
            jssor_22_Transition = [{$Duration:field_duration,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Opacity:2,$Assembly:260,$Round:{$Left:0.8,$Top:2.5}} , ];
        }
        else if( field_transition_effect == "ZoomIn"){
            jssor_22_Transition = [{$Duration:field_duration,$Zoom:11,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2} , ];
        }
        
        // console.log("Position 2___after transitions ");
        
        /* --------- Setting jssor options  ---------------*/
        jssor_22_options = {
            $AutoPlay: true,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_22_Transition,
                $TransitionsOrder: 1
            }
        };

        // console.log("Position 3___debut des if show ");

        if( field_show_caption == 1 ){
            var captionOpt = {
                $Class : $JssorThumbnailNavigator$,
                $Orientation : 2,
                $NoDrag : true
            };          

            jssor_22_options['$ThumbnailNavigatorOptions'] = captionOpt;
                        
        } //End if Caption == 1

        if( field_show_bullet == 1 ){
            if (field_show_caption == 1){
                var bulletOpt = {
                    $Class : $JssorBulletNavigator$
                };
            }
            else {
                var bulletOpt = {
                    $Class : $JssorBulletNavigator$,
                    $AutoCenter: 1
                };
            }                       

            jssor_22_options['$BulletNavigatorOptions'] = bulletOpt;

        } //End if Bullet == 1


        if( field_show_arrows == 1 ){
            var arrowsOpt = {
                $Class : $JssorArrowNavigator$
            };          

            jssor_22_options['$ArrowNavigatorOptions'] = arrowsOpt;

        } //End if Arrows == 1

                
        // console.log("Position 4___init fonction ");

        var jssor_22_slider = new $JssorSlider$("jssor_22", jssor_22_options);

        // console.log("Position 5___end init ");
        
        //Responsive slider display
        
        function ScaleSlider() {
            var refSize = jssor_22_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 600);
                jssor_22_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        //responsive code end

        // console.log("Position 6___end ");
    };
</script>

    
   


    <div id="jssor_22" 
    style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 900px; height: 500px; overflow: hidden; visibility: hidden;" >

        <!-- Loading Screen -->
        <!-- <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src=" <?php //plugin_dir_url( __FILE__ ) . 'css/static-svg/double-tail-spin.svg' ; ?>" />
        </div> -->


        <!-- Images Slides -->
        <div 
        data-u="slides" 
        style="cursor: default; position: relative; top: 0px; left: 0px; width: 900px; height: 500px; overflow: hidden;" >

        <?php 
            $args = array(
                'post_type' => 'nitek-carousel-cpt',
                'category_name' => 'nitek_slider_2',
                'posts_per_page' => '30'
            );

            $req = new WP_Query($args);

            // if ( $req->have_posts() ) : while ($req->have_posts() ) : $req->the_post(); 

            if ($req->have_posts()){

                while( $req->have_posts() ){
                    $req->the_post();

                    $metaDesc = get_post_meta( get_the_ID(), 'mb_desc', true ); 
                    $metaLink = get_post_meta( get_the_ID(), 'mb_caption_link', true ); 
                    $metaImg = get_post_meta( get_the_ID(), 'mb_img_slider', true );

                    ?>
                    
                    <div data-p="112.50" style="display: none;">

                        <?php  if ($field_link_caption == 1) {  ?>
                        <a id="nitek_link_caption" href=" <?php echo $metaLink; ?>" target="blank">
                            <img data-u="image" src="<?php echo $metaImg; ?>" />
                        </a>

                        <?php } else{ ?>
                         <img data-u="image" src="<?php echo $metaImg; ?>" /> 
                        <?php } ?>
                        <div data-u="thumb"> <?php echo $metaDesc; ?> </div>
                    </div>

                    <?php
                } //End while 
                
            } //End if

            //endwhile; endif; 
            wp_reset_postdata();

        ?>
        
        </div>


        <!-- Thumbnail Navigator -->
        <?php  
        if ($field_show_caption == 1) { ?>
        
        <div id="nitek_id_thumb" data-u="thumbnavigator" style="position:absolute;bottom:0px;left:0px;width:980px;height:50px;color:#FFF;overflow:hidden;cursor:default;background-color:rgba(0,0,0,.5);">
            <div data-u="slides">
                <div data-u="prototype" style="position:absolute;top:0;left:0;width:980px;height:50px;">
                    <div data-u="thumbnailtemplate" style="position:absolute;top:0;left:0;width:100%;height:100%;font-family:verdana;font-weight:normal;line-height:50px;font-size:16px;padding-left:10px;box-sizing:border-box;"></div>
                </div>
            </div>
        </div>
        <?php } ?>


        <!-- Bullet Navigator -->

        <?php  
        if ($field_show_bullet == 1) { 
            if ($field_change_bullet == 1){
            ?>
        <div id="nitek_id_bullet" data-u="navigator" class="jssorb031" style="position:absolute;bottom:12px;right:12px;">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <?php 

            }else if ($field_change_bullet == 2){  ?>
            <div data-u="navigator" class="jssorb035" style="position:absolute;bottom:12px;right:12px;" data-scale="0.5" data-scale-bottom="0.75">
                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                    <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <rect class="b" x="2200" y="2200" width="11600" height="11600"></rect>
                    </svg>
                </div>
            </div>
         <?php    } } ?>
       


        <!-- Arrow Navigator -->
       <?php  
        if ($field_show_arrows == 1) { 
            if ($field_change_arrows == 1){ ?>
        <div id="nitek_id_arrows" data-u="arrowleft" class="jssora092" style="width:24px;height:40px;top:0px;left:-1px;" data-autocenter="2" data-scale="0.75" data-scale-left="0">
            <svg viewBox="-199 -3000 9600 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="c" d="M-199-2428.1C317.2-2538.7,851.8-2600,1401-2600c4197.3,0,7600,3402.7,7600,7600 s-3402.7,7600-7600,7600c-549.2,0-1083.8-61.3-1600-171.9V-2428.1z"></path>
                <polygon class="a" points="4806.7,1528.5 4806.7,1528.5 4806.7,2707.8 2691.1,5000 4806.7,7292.2 4806.7,8471.5 4806.7,8471.5 1602,5000 "></polygon>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora092" style="width:24px;height:40px;top:0px;right:-1px;" data-autocenter="2" data-scale="0.75" data-scale-right="0">
            <svg viewBox="-199 -3000 9600 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="c" d="M9401,12428.1c-516.2,110.6-1050.8,171.9-1600,171.9c-4197.3,0-7600-3402.7-7600-7600 s3402.7-7600,7600-7600c549.2,0,1083.8,61.3,1600,171.9V12428.1z"></path>
                <polygon class="a" points="7401,5000 4196.3,8471.5 4196.3,8471.5 4196.3,7292.2 6311.9,5000 4196.3,2707.8 4196.3,1528.5 4196.3,1528.5 "></polygon>
            </svg>
        </div>

        <?php } elseif ($field_change_arrows == 2){ ?>
        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
            </svg>
        </div>

        <?php  } } ?>

        
    </div>  <!-- End slider -->


    <!-- Trigger -->
    <script>
        jssor_22_slider_init();
    </script>