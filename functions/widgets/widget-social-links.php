<?php
/******************************************
/* Flickr Widget
******************************************/
// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

  // register widget
  add_action( 'widgets_init', function () {
      register_widget('saxon_social_links');
  });

class saxon_social_links extends WP_Widget {

  /**
  	 * Register widget with WordPress.
  	 */
  	function __construct() {
  		parent::__construct(
  			'saxon_social_links', // Base ID
  			__('Social Media Links', 'text_domain'), // Name
  			array( 'description' => __( 'Add social media links', 'text_domain' ), ) // Args
  		);
  	}


    // display the widget
  public function widget( $args, $instance ) {
  		extract($args);

  		$title = apply_filters('widget_title', $instance['title']);
			$facebook_link = $instance['facebook_id'];
			$instagram_link = $instance['instagram_id'];
			$pinterest_link = $instance['pinterest_id'];
			$twitter_link = $instance['twitter_id'];
			$youtube_link = $instance['youtube_id'];
			$linkedin_link = $instance['linkedin_id'];
			$googleplus_link = $instance['googleplus_id'];


  		echo $before_widget;
        if ( $title )
        echo $before_title . $title . $after_title; ?>
  			<ul class="social-links">
					<? if($facebook_link) { ?>
  			<li><a href="<?php echo $instance['facebook_id'];?>" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
				<? } ?>
				<? if($instagram_link) { ?>
				<li><a href="<?php echo $instance['instagram_id'];?>" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></li>
			<? } ?>
			<? if($pinterest_link) { ?>
				<li><a href="<?php echo $instance['pinterest_id'];?>" target="_blank"><i class="fa fa-pinterest fa-2x"></i></a></li>
				<? } ?>
		 	<? if($twitter_link) { ?>
			<li><a href="<?php echo $instance['twitter_id'];?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
			<? } ?>
	  	<? if($youtube_link) { ?>
		<li><a href="<?php echo $instance['youtube_id'];?>" target="_blank"><i class="fa fa-youtube fa-2x"></i></a></li>
			<? } ?>
		<? if($linkedin_link) { ?>
			<li><a href="<?php echo $instance['linkedin_id'];?>" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a></li>
			<? } ?>
		<? if($googleplus_link) { ?>
			<li><a href="<?php echo $instance['googleplus_id'];?>" target="_blank"><i class="fa fa-google fa-2x"></i></a></li>
			<? } ?>

  					</ul>

  			<?php

  		echo $after_widget;

  		//end
  	}

		// print the widget option form on the widget management screen
public function form( $instance ) {
		$defaults = array(
		'title' => 'Social Media Links',
		'facebook_id' =>'',
		'instagram_id' =>'',
    'pinterest_id' =>'',
    'twitter_id' =>'',
    'youtube_id' =>'',
    'linkedin_id' =>'',
    'googleplus_id' =>'',


		);
	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, $defaults );




	// print the form fields
	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title'];?>" /></p>

	<p><label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo $instance['facebook_id'];?>" /></p>

	<p><label for="<?php echo $this->get_field_id('instagram_id'); ?>"><?php _e('Instagram:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('instagram_id'); ?>" name="<?php echo $this->get_field_name('instagram_id'); ?>" type="text" value="<?php echo $instance['instagram_id'];?>" /></p>

  <p><label for="<?php echo $this->get_field_id('pinterest_id'); ?>"><?php _e('Pinterest:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('pinterest_id'); ?>" name="<?php echo $this->get_field_name('pinterest_id'); ?>" type="text" value="<?php echo $instance['pinterest_id'];?>" /></p>

  <p><label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter:'); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $instance['twitter_id'];?>" /></p>

  <p><label for="<?php echo $this->get_field_id('youtube_id'); ?>"><?php _e('YouTube:'); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" type="text" value="<?php echo $instance['youtube_id'];?>" /></p>

  <p><label for="<?php echo $this->get_field_id('linkedin_id'); ?>"><?php _e('LinkedIn:'); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('linkedin_id'); ?>" name="<?php echo $this->get_field_name('linkedin_id'); ?>" type="text" value="<?php echo $instance['linkedin_id'];?>" /></p>

  <p><label for="<?php echo $this->get_field_id('googleplus_id'); ?>"><?php _e('Google Plus:'); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id('googleplus_id'); ?>" name="<?php echo $this->get_field_name('googleplus_id'); ?>" type="text" value="<?php echo $instance['googleplus_id'];?>" /></p>


	<?php
	}


		// update the widget
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
		$instance['instagram_id'] = strip_tags($new_instance['instagram_id']);
		$instance['pinterest_id'] = strip_tags($new_instance['pinterest_id']);
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
		$instance['youtube_id'] = strip_tags($new_instance['youtube_id']);
		$instance['linkedin_id'] = strip_tags($new_instance['linkedin_id']);
		$instance['googleplus_id'] = strip_tags($new_instance['googleplus_id']);

		return $instance;
	}





}

?>
