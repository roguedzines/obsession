<?php
/******************************************
/* Flickr Widget
******************************************/
// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

  // register widget
  add_action( 'widgets_init', function () {
      register_widget('saxon_instagram_widget');
  });

class saxon_instagram_widget extends WP_Widget {

  /**
  	 * Register widget with WordPress.
  	 */
  	function __construct() {
  		parent::__construct(
  			'saxon_instagram_widget', // Base ID
  			__('Saxon Instagram Widget', 'text_domain'), // Name
  			array( 'description' => __( 'Add Instagram widget', 'text_domain' ), ) // Args
  		);

          add_action('wp_enqueue_scripts', array($this, 'upload_scripts'));
  	}


  public function upload_scripts()
    {

    wp_enqueue_script('instafeed',get_template_directory_uri() . '/js/instafeed.min.js',array('jquery','easing'),'1.4.8',true);
    }

    // display the widget
  public function widget( $args, $instance ) {
  		extract($args);

  		$title = apply_filters('widget_title', $instance['title']);
			$instagram_user_id  = $instance['instagram_user_id'];
			$instagram_token = $instance['instagram_token'];
			$image_link = $instance['image'];



  		echo $before_widget;
        if ( $title )
        echo $before_title . $title . $after_title; ?>
        <div id="instagram-widget-container">
        <div id="instagram-feed">
        	<ul id="sidebarInsta" class="instafeed"></ul>
        	<div class="clear"></div>
        </div>
        </div>

  			<?php

  		echo $after_widget;

  		//end
?>

<script type="text/javascript">
jQuery(function($) {
  $(document).ready(function() {
    var userFeed = new Instafeed({
			get: 'user',
			target:'sidebarInsta',
     userId:<?php if($instance['instagram_user_id']!=''){echo $instance['instagram_user_id'];} ?>,
     accessToken:'<?php if ($instance['instagram_token']!=''){echo $instance['instagram_token'];}?>',
      limit:<?php if ($instance['instagram_number']!=''){echo $instance['instagram_number'];}?>,
      template: '<li class="instagram-image-wrap"><div class="insta_image"><a href="{{link}}" target="_blank"><img src="{{image}}" class="instafeed" target="_blank"/></a></div></li>',
			resolution:'thumbnail'
  });
   userFeed.run();
});
});
</script>
<?
  	}


		// print the widget option form on the widget management screen
public function form( $instance ) {
	$title = esc_attr($instance['title']);
	$instagram_user_id = esc_attr($instance['instagram_user_id']);
	$instagram_token = esc_attr($instance['instagram_token']);
	$instagram_number = esc_attr($instance['instagram_number']);

	// print the form fields
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title'];?>" /></p>

	<p><label for="<?php echo $this->get_field_id('instagram_user_id'); ?>"><?php _e('Instagram ID:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('instagram_user_id'); ?>" name="<?php echo $this->get_field_name('instagram_user_id'); ?>" type="text" value="<?php echo $instance['instagram_user_id'];?>" /></p>


  	<p><label for="<?php echo $this->get_field_id('instagram_token'); ?>"><?php _e('Instagram Access Token:'); ?></label>
  	<input class="widefat" id="<?php echo $this->get_field_id('instagram_token'); ?>" name="<?php echo $this->get_field_name('instagram_token'); ?>" type="text" value="<?php echo $instance['instagram_token'];?>" /></p>


		  	<p><label for="<?php echo $this->get_field_id('instagram_number'); ?>"><?php _e('How many items to show:'); ?></label>
		  	<input class="widefat" id="<?php echo $this->get_field_id('instagram_number'); ?>" name="<?php echo $this->get_field_name('instagram_number'); ?>" type="text" value="<?php echo $instance['instagram_number'];?>" /></p>



	<?php
	}


		// update the widget
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['instagram_user_id'] = strip_tags($new_instance['instagram_user_id']);
		$instance['instagram_token'] = strip_tags($new_instance['instagram_token']);
		$instance['instagram_number'] = strip_tags($new_instance['instagram_number']);

		return $instance;
	}





}

?>
