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
  <h1 class="archive-title"><?php
    if ( is_day() ) :
      printf( __( 'Daily Archives: %s', 'stalkerTheme' ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() ) :
      printf( __( 'Monthly Archives: %s', 'stalkerTheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'stalkerTheme' ) ) . '</span>' );
    elseif ( is_year() ) :
      printf( __( 'Yearly Archives: %s', 'stalkerTheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'stalkerTheme' ) ) . '</span>' );
    else :
      _e( 'Archives', 'stalkerTheme' );
    endif;
  ?></h1>
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
