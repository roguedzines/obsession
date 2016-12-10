<?php //get theme options
global $data;
?>
<?php get_header('single'); ?>
<div class="grid-container">
  <div class="row">
    <div class="grid-item col-4">
      <div class="post-content">
		<?php if(have_posts()): while (have_posts()) : the_post();?>
      <?php //image sizes
      	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'single-image');
          $video = rwmb_meta( 'rw_videoembed', 'type=oembed' );
      ?>
      <?php if(has_post_format('gallery')){
            $attachments = get_children( array(
            'post_parent' =>get_the_ID(),
            'post_type' => 'attachment',
            'post_status' => null,
            'orderby' => 'menu_order ID',
            'order' => 'ASC',
            'exclude' => get_post_thumbnail_id(),
            'numberposts' => -1
            ) );
        if( $attachments ) : ?>

            <div class="posts-slider">
              <?php foreach( $attachments as $attachment => $attachment ):?>
              <div><?php echo wp_get_attachment_image( $attachment, 'single-image' ); ?></div>
            <?php endforeach;?>
            </div>
        <?php endif;?>
      <?php } ?>
      <?php if(has_post_thumbnail()) { ?>
        <div class="single-image-container">
      <div class="single-image">
        <a href="<?php echo $full_size[0];?>" rel="prettyPhoto"><img src="<?php echo $thumbnail[0];?>" width="<?php echo $thumbnail[1];?> " height="<?php echo $thumbnail[2];?>"></a>
      </div>
      <div class="single-post-subject">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-date"><i class="fa fa-clock-o"></i> <?php echo the_date('F j, Y'); ?></div>
      </div>
    </div>
      <?php } else {  ?>
        <div class="post-subject">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        </div>
        <?php } ?>
        	<?php if(!empty($video)){ ?>

            <div class="video-container">
          <?php echo $video;?>
            </div>
            <?php } ?>
<?php the_content( $more_link_text = null, $strip_teaser = false );?>
<div class="comments-container">
  <?php comments_template( '', true ); ?>
</div>
<nav class="nav-single">
  <?php
                  $prevPost = get_previous_post();
                  $prevthumbnail = get_the_post_thumbnail($prevPost->ID); ?>
  <span class="nav-previous"> <?php previous_post_link( '%link',$prevthumbnail .'<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
  <?php
                $nextPost = get_next_post();
                $nextthumbnail = get_the_post_thumbnail($nextPost->ID); ?>
  <span class="nav-next"> <?php next_post_link( '%link', $nextthumbnail . '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
  <div class="clear"></div>
</nav><!-- .nav-single -->
<?php endwhile;?>
    <?php endif;?>
      </div>
    </div>
<?php get_sidebar();?>
  </div>
</div>

<?php get_footer(); ?>
