<?php //get theme options


global $data;
?>
<?php get_header(); ?>
<div class="grid-container">
  <div class="row">
    <div class="grid-item col-4">
      <div class="post-content">
		<?php if(have_posts()): while (have_posts()) : the_post();?>
<?php the_content( $more_link_text = null, $strip_teaser = false );?>
<?php endwhile;?>
    <?php endif;?>
      </div>
    </div>
<?php get_sidebar();?>
  </div>
</div>

<?php get_footer(); ?>
