<? // get data for options
global $data;
global $post;

?>
<?php get_header();?>

<header class="page-header">
  <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentythirteen' ), get_search_query() ); ?></h1>
</header>
<div class="grid-container">
<?php // get posts

?>

<?
if(have_posts()):?>

<?php get_template_part('loop','masonry');
?>
<?php endif;?>
<?php wp_reset_query(); ?>
  </div>
	<div class="loadmore-wrap">
	    <div class="load-more">
	        <?php next_posts_link ('Load more posts') ?>
	<span class="load-more-button-load"></span>
	    </div>
	</div>

  <?php get_footer();?>
