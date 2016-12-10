<?php
/******************************************
/* Flickr Widget
******************************************/

class saxon_flickr extends WP_Widget {
	
	function saxon_flickr() {
		
		
		$widget_ops = array('classname' => 'flickr_widget',
							'description' => __( 'Pulls in images from your Flickr account.','saxonTheme'));
		
 $this->WP_Widget( 'saxon_flickr', 'SaxonFlickr Posts', $widget_ops);  
	
	}
	
		// print the widget option form on the widget management screen
	function form( $instance ) {
		$defaults = array(
		'title' => 'Flickr',
		'flickr_id' =>'',
		'number' => 3
		);
	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, $defaults );
 
	
	
	
	// print the form fields
	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title'];?>" /></p>
	
	<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID'); ?>(<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
	<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $instance['flickr_id'];?>" /></p>

	<p><label for="<?php echo $this->get_field_id('number'); ?>">
	<?php _e('Number:'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number'];?>" /></p>

	<?php
	}
	
	
		// update the widget 
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);

		return $instance;
	}
	
	
	// display the widget 
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);

		
		echo $before_widget;
             if ( $title )
                 echo $before_title . $title . $after_title; ?>		
			<ul class="flickrpics">
			<li class="flickrimages">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $instance['number']; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $instance['flickr_id']; ?>"></script></li>
					</ul>
			
			<?php
			
		echo $after_widget;
		
		//end
	}
	


}
// register Flickr widget
add_action( 'widgets_init', 'saxon_load_widgets' );  
function saxon_load_widgets() {  
    register_widget('saxon_flickr');  
}  ?>