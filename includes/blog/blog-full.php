<?php // get data for options
global $data;
global $post;
if ($data['home_blog_post_count']!='8') {

	$home_blog_post_count = $data['home_blog_post_count'];
} else {

	$home_blog_post_count = 4;
}
?>
<div class="grid-container">
<?php // get posts
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
'paged'=>$paged,
'posts_per_page'=>$home_blog_post_count)
);
?>

<?php
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
