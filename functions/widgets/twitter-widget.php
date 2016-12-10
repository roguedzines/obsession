<?php 
class saxonTheme_recent_tweets extends WP_Widget{
	
	
	function saxonTheme_recent_tweets(){
		// init
		$widget_ops = array('classname' => 'flickr_widget',
							'description' => __( 'Latest Tweets from your Twitter account.','saxonTheme'));
		
 $this->WP_Widget( 'saxonTheme_recent_tweets', 'Saxon Tweets', $widget_ops);  
	
	}
	
		function form($instance){
		
		//output the options to admin
		$defaults = array(
		'title' => 'Latest Tweets',
		'username' =>'',
		'limit' => 3
		);
		
$instance = wp_parse_args((array) $instance, $defaults);?>

		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title');?>" type="text" value="<?php echo $instance['title'];?>" name="<?php echo $this->get_field_name('title');?>" /></p>
		
		</p>
				<p><label for="<?php echo $this->get_field_id('username');?>"><?php _e('Twitter Username:');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('username');?>" type="text" value="<?php echo $instance['username'];?>" name="<?php echo $this->get_field_name('username');?>" /></p>
		
		</p>
				<p><label>Number of Tweets:<select id="<?php echo $this->get_field_id('limit');?>" name="<?php echo $this->get_field_name('limit');?>">

		<?php for($i = 1; $i <=10; $i++): $selected =($instance['limit']==$i) ? 'selected="selected"':''?>
		<option value="<?php echo $i?>"<?php echo $selected?>><?php echo $i;?></option>
		<?php endfor;?>
		</select></label>
		</p>
		<?php 
	} 
	
	

	
	 function widget($args,$instance){
		//build the widget
		extract ($args);
		$title = apply_filters('widget_title',$instance['title']);
		
		echo $before_widget;
	
		if($title)
		
	echo $before_title . $title . $after_title;  ?>


<?php 
// render tweets to div element  
    echo '<div id="tweets"></div>';  
//script 
$replies = 'true';
		
?>
<script type="text/javascript">
jQuery(function($){
 
    $('#tweets').tweetable({ 
    username: '<?php echo $instance['username'];?>', 
    limit: <?php echo $instance['limit'];?>, 
    replies: true, 
				}); 
   	}); 
</script>
<?php echo $after_widget;?>
<?php } 



function update($new_instance,$old_instance){
		
		$instance = $old_instance;
		$instance ['title'] = strip_tags($new_instance['title']);
			$instance ['username'] = strip_tags($new_instance['username']);
				$instance ['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}

 } ?>
<?
// register Flickr widget
add_action( 'widgets_init', 'saxon_load_twitter' );  
function saxon_load_twitter() {  
    register_widget('saxonTheme_recent_tweets');  
}

?>