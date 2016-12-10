<?php global $data;?>
<?php //image sizes
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'front-masonry');
  $full_size = wp_get_attachment_image_src(get_post_thumbnail_id(),'full-size');
?>
<div class="post-image"></div>
<?php if(has_post_thumbnail()) { ?>
<div class="grid-image">
  <a href="<?php echo $full_size[0];?>" rel="prettyPhoto"><img src="<?php echo $thumbnail[0];?>" width="<?php echo $thumbnail[1];?> " height="<?php echo $thumbnail[2];?>"></a>
</div>
<?php } ?>
