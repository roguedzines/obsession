<?php
/**
 * The template for displaying masonry posts
 *
 * @package WordPress
 * @subpackage Obsession
 * @since Saxon 1.0
	*BEGIN get theme options */
global $data;
?>
<?php 	while(have_posts()):the_post(); ?>
  <div class="grid-sizer"></div>
  <div class="row">
    <div class="grid-item col-2">
      <div class="column-container">

        <?php if(has_post_format('image')){ ?>
          <?php get_template_part('format','image'); ?>
        <?php } else{  ?>
          <?php if(has_post_format('gallery')){ ?>
            <?php get_template_part('format','gallery'); ?>
          <?php } else {  ?>
            <?php if(has_post_format('quote')){ ?>
            <?php get_template_part('format','quote'); ?>
              <?php } else { ?>
                <?php if(has_post_format('video')){ ?>
                <?php get_template_part('format','video'); ?>
                  <?php } else { ?>
          <? get_template_part('format','standard'); ?>
          <?php } } } }?>
      </div>
    </div>

  </div>
<?php endwhile; ?>
<?php wp_reset_postdata(); //reset postdata ?>
