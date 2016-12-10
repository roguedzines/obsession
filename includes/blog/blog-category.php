<? // get data for options
global $data;
global $post;
if ($data['home_blog_post_count']!='8') {

	$home_blog_post_count = $data['home_blog_post_count'];
} else {

	$home_blog_post_count = 4;
}
?>
<header class="archive-header">
  <h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

<?php if ( category_description() ) : // Show an optional category description ?>
  <div class="archive-meta"><?php echo category_description(); ?></div>
<?php endif; ?>
</header><!-- .archive-header -->

<div class="grid-container">
<?php // get posts
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
'paged'=>$paged,
'posts_per_page'=>$home_blog_post_count)
);
query_posts($query_string . "&posts_per_page=6");
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
