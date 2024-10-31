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


<p>
	<label for="mb_desc">Description </label>
	<br>
	<input type="text" name="mb_desc" id="mb_desc" class="regular-text" value="<?php if ( isset($metaDesc) ) { echo $metaDesc;} ?>" required>
</p>

<p>
	<label for="mb_caption_link">Caption link (hyperlink image) </label>
	<br>
	<input type="text" name="mb_caption_link" id="mb_caption_link" class="regular-text" value="<?php if (isset($metaLink) ) { echo $metaLink ;} ?>">
</p>


<p>
		<label for="mb_img_slider">Carousel image</label><br>
		<input type="text" name="mb_img_slider" id="mb_img_slider" class="meta-image regular-text" value="<?php if (isset($metaImg)){ echo $metaImg ; } ?>" required>
		<input type="button" class="button image-upload" value="Choose Image slider">
	</p>
	<div class="image-preview">
		<img src="<?php if (isset($metaImg)) {echo $metaImg;} ?>" style="max-width: 250px;">
	</div>


<script>
    jQuery(document).ready(function ($) {
      // Instantiates the variable that holds the media library frame.
      var meta_image_frame;
      // Runs when the image button is clicked.
      $('.image-upload').click(function (e) {
        // Get preview pane
        var meta_image_preview = $(this).parent().parent().children('.image-preview');
        // Prevents the default action from occuring.
        e.preventDefault();
        var meta_image = $(this).parent().children('.meta-image');
        // If the frame already exists, re-open it.
        if (meta_image_frame) {
          meta_image_frame.open();
          return;
        }
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
          title: meta_image.title,
          button: {
            text: meta_image.button
          }
        });
        // Runs when an image is selected.
        meta_image_frame.on('select', function () {
          // Grabs the attachment selection and creates a JSON representation of the model.
          var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
          // Sends the attachment URL to our custom image input field.
          meta_image.val(media_attachment.url);
          meta_image_preview.children('img').attr('src', media_attachment.url);
        });
        // Opens the media library frame.
        meta_image_frame.open();
      });
    });
</script>

