<?php global $data;?>
<?php
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'front-masonry');
?>
<?php $attachments = get_children( array(
    'post_parent' =>get_the_ID(),
    'post_type' => 'attachment',
    'post_status' => null,
    'orderby' => 'menu_order ID',
    'order' => 'ASC',
    'exclude' => get_post_thumbnail_id(),
    'numberposts' => -1
    ) );
if( $attachments ): ?>
	<div class="standard-image"></div>

    <div class="posts-slider">
      <?php foreach( $attachments as $attachment => $attachment ):?>
      <div><?php echo wp_get_attachment_image( $attachment, 'front-masonry' ); ?></div>
    <?php endforeach;?>
    </div>
<?php endif;?>
	<div class="grid-content">
		<div class="post-subject">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="post-meta"><i class="fa fa-folder-o"></i>	<?php the_category(', '); ?></div>
		<p>
			<?php the_content();?> </p>
	</div>
	<div class="grid-footer"><i class="fa fa-clock-o"></i> <?php echo the_time('Y-m-j'); ?></div>
