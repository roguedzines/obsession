<?php global $data;?>
<?php
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'front-masonry');
?>

	<?php if(has_post_thumbnail()){ ?>
		<div class="standard-image"></div>
	<div class="grid-image">
		<div class="image-post-title">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="meta-post">by <strong>Admin</strong></div>
			<div class="meta-date"><i class="fa fa-folder-o"></i>	<?php the_category(', '); ?></div>
		</div>
	<div class="post-image-overlay"></div><img src="<?php echo $thumbnail[0];?>" width="<?php echo $thumbnail[1];?> " height="<?php echo $thumbnail[2];?>">
	</div>
	<? } else { ?>
<div class="no-image"></div>
		<?php } ?>
	<div class="grid-content">
		<?php if(!has_post_thumbnail()){ ?>
			<div class="post-subject">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<?php } ?>

		<div class="post-meta"></div>
		<p>
			<?php better_excerpts('40','Continue Reading','','','');?> </p>
	</div>
	<div class="grid-footer"><i class="fa fa-clock-o"></i> <?php echo the_time('Y-m-j'); ?></div>
