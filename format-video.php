<?php global $data;?>
<?php
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'front-masonry');
  $video = rwmb_meta( 'rw_videoembed', 'type=oembed' );
?>
	<?php if(!empty($video)){ ?>
		<div class="standard-image"></div>
	<div class="grid-image">
    <div class="video-container">
  <?php echo $video;?>
    </div>
	</div>
	<? } else { ?>
<div class="no-image"></div>
		<?php } ?>
	<div class="grid-content">
		<?php if(!has_post_thumbnail()){ ?>
			<div class="post-subject">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
  </div>
          <div class="meta-post">by <strong>Admin</strong></div>
          <div class="meta-date"><i class="fa fa-folder-o"></i>	<?php the_category(', '); ?></div>

			<?php } ?>
		<p>
			<?php better_excerpts('40','Continue Reading','','','');?> </p>
	</div>
	<div class="grid-footer"><i class="fa fa-clock-o"></i> <?php echo the_time('Y-m-j'); ?></div>
