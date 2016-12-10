<?php
/******************************************
/* Flickr Widget
******************************************/
// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

  // register widget
  add_action( 'widgets_init', function () {
      register_widget('saxon_about_me');
  });

class saxon_about_me extends WP_Widget {

  /**
  	 * Register widget with WordPress.
  	 */
  	function __construct() {
  		parent::__construct(
  			'saxon_about_me', // Base ID
  			__('About Me', 'text_domain'), // Name
  			array( 'description' => __( 'Add about me section', 'text_domain' ), ) // Args
  		);
			add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
			add_action('admin_enqueue_styles', array($this, 'upload_admin_style'));
  	}

		public function upload_scripts()
	    {

				if(function_exists( 'wp_enqueue_media' )){
			    wp_enqueue_media();
			}else{
			    wp_enqueue_style('thickbox');
			    wp_enqueue_script('media-upload');
			    wp_enqueue_script('thickbox');
			}
	    }
			function upload_admin_style() {
				wp_enqueue_style('thickbox');
			}
    // display the widget
  public function widget( $args, $instance ) {
  		extract($args);

  		$title = apply_filters('widget_title', $instance['title']);
			$about_me = $instance['about_me_text'];
			$instagram_link = $instance['instagram_id'];
			$image_link = $instance['image'];



  		echo $before_widget;
        if ( $title )
        echo $before_title . $title . $after_title; ?>
  			<div class="about-me">
					<? if($about_me) { ?>
						<img src="<?php echo $instance['image'];?>"/>
  			<p> <?php echo $instance['about_me_text'];?></p>

				<? } ?>
</div>

  			<?php

  		echo $after_widget;

  		//end
  	}

		// print the widget option form on the widget management screen
public function form( $instance ) {
	$title = esc_attr($instance['title']);
	$about_me_text = esc_attr($instance['about_me_text']);
	$image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }


	// print the form fields
	?>
<script language="javascript">

jQuery(document).ready(function($){

$('.upload_image_button').click(function() {

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);

        wp.media.editor.send.attachment = function(props, attachment) {

            $(button).prev().prev().attr('src', attachment.url);
            $(button).prev().val(attachment.url);

            wp.media.editor.send.attachment = send_attachment_bkp;
        }

        wp.media.editor.open(button);

        return false;
    });

});
</script>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title'];?>" /></p>

	<p><label for="<?php echo $this->get_field_id('about_me_text'); ?>"><?php _e('About Me:'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('about_me_text'); ?>" name="<?php echo $this->get_field_name('about_me_text'); ?>"><?php if (!empty($about_me_text)) echo $about_me_text; ?></textarea></p>
	<p>
					<label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
					<input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
					<input class="upload_image_button button button-primary" type="button" value="Upload Image" />
			</p>


	<?php
	}


		// update the widget
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['about_me_text'] = strip_tags($new_instance['about_me_text']);
		$instance['image'] = strip_tags($new_instance['image']);

		return $instance;
	}





}

?>
