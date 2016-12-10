<?php
class saxonTheme_recent_posts extends WP_Widget{


	function saxonTheme_recent_posts(){
		// init

		parent::WP_Widget(false, $name = 'Saxon recent posts with thumbnails');

	}



 function widget($args,$instance){
		//build the widget
		extract ($args);
		$title = apply_filters('widget_title',$instance['title']);
		$number = apply_filters('widget_title',$instance['number']);


		echo $before_widget;


		if ($title) echo $before_title . $title . $after_title;  ?>

		<ul class="widget-recent-posts clearfix">

		<?php
		global $post;
		$tmp_post = $post;
		$args = array(
		'numberposts'=>$number,
		);

$myposts = get_posts($args);
$count = 0;
foreach ($myposts as $post):setup_postdata($post);
$count ++;
?>

<?php if(has_post_thumbnail()){?>

	<li class="widget_recent">
	<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('recent-posts-thumb');?></a>

	<?php
	$thetitle = $post->post_title;
	$getlength = strlen($thetitle);
	$thelength = 30;
//	echo substr($thetitle,0,$thelength);

	//if ($getlength > $thelength) echo "...";

	?>

<!--</a>-->
<div class="widget-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo substr($thetitle,0,$thelength); if ($getlength > $thelength) echo "...";?></a><div>
	<div class="time_recent">posted <?php echo human_time_diff(get_the_time('U'),current_time('timestamp')).' ago';?></div>


	<?php //better_excerpts('18','Read More','','',''); ?>
	<div class="clearfix"></div>
	</li>

	<?php	} ?>
<?php endforeach;?>
<?php $post = $tmp_post;?>
</ul>
<?php echo $after_widget;?>
<?php }

function update($new_instance,$old_instance){

		$instance = $old_instance;
		$instance ['title'] = strip_tags($new_instance['title']);
			$instance ['number'] = strip_tags($new_instance['number']);

		return $instance;
	}
	function form($instance){

		//output the options to admin

		$title = esc_attr($instance['title']);
		$number = esc_attr($instance['number']);
		$offset = esc_attr($instance['offset']);
		?>
		<p><label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title');?>" type="text" value="<?php echo $title;?>" name="<?php echo $this->get_field_name('title');?>" /></p>

		</p>
				<p><label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of Posts to show:');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number');?>" type="text" value="<?php echo $number;?>" name="<?php echo $this->get_field_name('number');?>" /></p>

		</p>
					</p>
		<?php
	}

 } ?>
<?
add_action('widgets_init',create_function('','return register_widget("saxonTheme_recent_posts");'));
function saxonTheme_recent_posts(){
	register_widget('saxonTheme_recent_posts');
}
?>
