<?php
//Obsession Theme
/*
* Version 1.0
* Theme Functions
* RogueDzines.com
*/

// get theme optiions
global $data;
/************* INCLUDE NEEDED FILES ***************/
require_once('admin/index.php' );

//set content width for the theme
if (!isset ($content_width))
$content_width=980;

// load required functions
require_once('functions/widgets/widget-recent-posts.php');
require_once('functions/widgets/twitter-widget.php');
require('functions/better-comments.php');
//require('functions/custom-excerpt.php');
require('functions/shortcodes/shortcodes.php');
require('functions/plugins.php');

/*--------------Remove junk from header------------*/
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

//add theme support for post-formats
add_theme_support( 'post-formats', array( 'aside','image','quote','video','gallery','status' ) );


//add localization

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('saxonTheme', get_template_directory() . '/lang');
}


// Thumbnail sizes
if (function_exists('add_theme_support')){
add_theme_support('post-thumbnails');
add_theme_support('custom-header',$args);
add_theme_support('automatic-feed-links');
add_editor_style('custom-editor-style.css');
add_theme_support('custom-background',$args);

set_post_thumbnail_size(120,80);
add_image_size('full-size', 9999,9999);
add_image_size('front-masonry',600,400, true);
add_image_size('posts-image-single',540,220, true);
add_image_size('single-slider-image',540,420, true);
add_image_size('single-image',1200,800, true);
}

if ( !is_admin()){
function load_saxon_scripts() {
global $data;
/************* Queue JS ********************/
//fire up jquery
wp_dequeue_script('jquery');
wp_enqueue_script('google jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js',array(),'2.2.2',false);

//load all the necessary scripts
wp_enqueue_script('hoverIntent',get_template_directory_uri() . '/js/hoverintent.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('superfish',get_template_directory_uri() . '/js/superfish.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('easing',get_template_directory_uri() . '/js/jquery.easing.1.3.js',array('jquery'),'1.3',true);
wp_enqueue_script('fitvids',get_template_directory_uri().'/js/jquery.fitvids.js',array('jquery'),'1.0',true);
wp_enqueue_script('custom',get_template_directory_uri() . '/js/custom.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('smoothscroll',get_template_directory_uri() . '/js/smoothscroll.min.js',array('jquery'),'1.4.8',true);
//start loading scripts for the front page
if(is_front_page()):
wp_enqueue_script('masonrycustom',get_template_directory_uri() . '/js/home-custom.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('masonry',get_template_directory_uri() . '/js/masonry.pkgd.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('slickslider',get_template_directory_uri() . '/js/slick.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('prettyPhoto',get_template_directory_uri() . '/js/jquery.prettyPhoto.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('infinitescroll',get_template_directory_uri() . '/js/jquery.infinitescroll.min.js',array('jquery'),'1.3',true);
wp_enqueue_script('masonrymanualtrigger',get_template_directory_uri() . '/js/manual-trigger.js',array('jquery'),'1.4.8',true);

// Dequeue the scripts that are not needed if certain conditions are not met

if($data['no_infinite_scroll']==1){
wp_dequeue_script('masonrymanualtrigger');

}


//end no infinite scroll

endif;



// load scripts for single pages
if(is_single()):
wp_enqueue_script('prettyPhoto',get_template_directory_uri() . '/js/jquery.prettyPhoto.js',array('jquery'),'1.4.8',true);
endif;

if(is_single() && has_post_format('gallery')){
  wp_enqueue_script('slickslider',get_template_directory_uri() . '/js/slick.min.js',array('jquery'),'1.4.8',true);
  wp_enqueue_script('singleslider',get_template_directory_uri() . '/js/single-slider.js',array('jquery'),'1.4.8',true);\
  wp_enqueue_style('slick', get_template_directory_uri() .	'/css/slick.css');
}
//load scripts for category, archive, search, tags, taxonomies
if(is_category() || is_archive() || is_tax() || is_search() || is_tag()) :
wp_enqueue_script('masonrycustom',get_template_directory_uri() . '/js/home-custom.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('masonry',get_template_directory_uri() . '/js/masonry.pkgd.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('slickslider',get_template_directory_uri() . '/js/slick.min.js',array('jquery'),'1.4.8',true);
wp_enqueue_script('prettyPhoto',get_template_directory_uri() . '/js/jquery.prettyPhoto.js',array('jquery'),'1.4.8',true);
if($data['no_infinite_scroll']!=0){
wp_enqueue_script('infinitescroll',get_template_directory_uri() . '/js/jquery.infinitescroll.min.js',array('jquery'),'1.3',true);
} else if($data['no_infinite_scroll']!=1) {
wp_enqueue_script('infinitescroll',get_template_directory_uri() . '/js/jquery.infinitescroll.min.js',array('jquery'),'1.3',true);
wp_enqueue_script('masonrymanualtrigger',get_template_directory_uri() . '/js/manual-trigger.js',array('jquery'),'1.4.8',true);
}

endif;
}
}




add_action('wp_enqueue_scripts','load_saxon_scripts');
/*************Add functions for menu ********************/

// Load stylesheets

function load_saxon_themecss(){
	global $data;
if (!is_admin()) {
	//load necessary style sheets
	if ($data['menu_style_choice']=='dark'){
wp_enqueue_style('menus',get_template_directory_uri().'/css/menu-dark.css');
	}
	else {
wp_enqueue_style('menus',get_template_directory_uri().'/css/menu.css');
	}
//wp_enqueue_style('wpstyles',get_template_directory_uri().'/css/wpstyles.css');

//load stylesheets for the main page
if(is_front_page()):
wp_enqueue_style('slick', get_template_directory_uri() .	'/css/slick.css');
wp_enqueue_style('prettyphotocss', get_template_directory_uri() .	'/css/prettyphoto.css');
endif;
if(is_category() || is_archive() || is_tax() || is_search() || is_tag()) :
  wp_enqueue_style('slick', get_template_directory_uri() .	'/css/slick.css');
  wp_enqueue_style('prettyphotocss', get_template_directory_uri() .	'/css/prettyphoto.css');
endif;
wp_enqueue_style('main', get_template_directory_uri() .	'/css/main.css');
wp_enqueue_style('posts', get_template_directory_uri() .	'/css/posts.css');
wp_enqueue_style('responsive', get_template_directory_uri() .	'/css/responsive.css');
wp_enqueue_style('wpstyles', get_template_directory_uri() .	'/css/wp-styles.css');
wp_enqueue_style('comments', get_template_directory_uri() .	'/css/comments.css');
wp_enqueue_style('widgetcss', get_template_directory_uri() .	'/css/widgets.css');
wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');

//load stylesheets for single pages
// if(is_single()||is_category() || is_archive() || is_tax() || is_search() || is_tag()):
// wp_enqueue_style('flexslider', get_template_directory_uri() .	'/css/flexslider.css');
// wp_enqueue_style('galleriffic', get_template_directory_uri() .	'/css/galleriffic.css');
// wp_enqueue_style('prettyphotocss', get_template_directory_uri() .	'/css/prettyPhoto.css');
//
// endif;
// if($data['no_infinite_scroll']==1){
//
// 	wp_enqueue_style('infscroll', get_template_directory_uri() .	'/css/conditional-style.css');
//
// }
}
}





// fire up stylesheets on load
add_action('wp_print_styles','load_saxon_themecss');


// add first and last class to nav menu
function add_first_and_last($output) {
$output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
$output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');



// menu fallback
function default_menu() {
require_once (TEMPLATEPATH . '/includes/default-menu.php');

}


// for nav description
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}


// register theme menus

add_action( 'init', 'register_theme_menu' );
function register_theme_menu() {
register_nav_menus(
array(
'main_menu' => __('Main','saxon'),
//'footer_menu' => __('Footer','saxon')

)
);
}
/// add home link to menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

//votes for masonry

$timebeforerevote = 1;

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
wp_localize_script('like_post', 'ajax_var', array(
	'url' => admin_url('admin-ajax.php'),
	'nonce' => wp_create_nonce('ajax-nonce')
));

function post_like()
{
	$nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');

	if(isset($_POST['post_like']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];

		$meta_IP = get_post_meta($post_id, "voted_IP");

		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP))
			$voted_IP = array();

		$meta_count = get_post_meta($post_id, "votes_count", true);

		if(!hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);

			echo $meta_count;
		}
		else
			echo "already";
	}
	exit;
}

function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;

	$meta_IP = get_post_meta($post_id, "voted_IP");
	$voted_IP = $meta_IP[0];
	if(!is_array($voted_IP))
		$voted_IP = array();
	$ip = $_SERVER['REMOTE_ADDR'];

	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();

		if(round(($now - $time) / 60) > $timebeforerevote)
			return false;

		return true;
	}

	return false;
}

function getPostLikeLink($post_id)
{
	$themename = "saxonTheme";

	$vote_count = get_post_meta($post_id, "votes_count", true);

	$output = '<p class="post-like">';
	if(hasAlreadyVoted($post_id))
		$output .= ' <span title="'.__('I already liked this article', $themename).'" class="qtip like alreadyvoted"></span>';
	else
		$output .= '<a href="#" data-post_id="'.$post_id.'">
					<span  title="'.__('I like this article', $themename).'"class="qtip like"></span>
				</a>';
	$output .= '<span class="count">'.$vote_count.'</span></p>';

	return $output;
}

//create function to add javascript fix to header

// create function for pagination

function saxonTheme_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


// create function for breadcrumbs

function saxonTheme_breadcrumbs() {

$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
$delimiter = '<span class="divider"></span>'; // delimiter between crumbs
$home = 'Home'; // text for the 'Home' link
$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
$before = '<li class="active"><span class="current">'; // tag before the current crumb
$after = '</span></li>'; // tag after the current crumb

global $post;
$homeLink = get_bloginfo('url');

if (is_home() || is_front_page()) {

if ($showOnHome == 1) echo '<ul id="crumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';

} else {

echo '<ul id="crumbs"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

if ( is_category() ) {
$thisCat = get_category(get_query_var('cat'), false);
if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
echo $before . '' . single_cat_title('', false) . '' . $after;

} elseif ( is_search() ) {
echo $before . 'Search results for "' . get_search_query() . '"' . $after;

} elseif ( is_day() ) {
echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
echo $before . get_the_time('d') . $after;

} elseif ( is_month() ) {
echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
echo $before . get_the_time('F') . $after;

} elseif ( is_year() ) {
echo $before . get_the_time('Y') . $after;

} elseif ( is_single() && !is_attachment() ) {
if ( get_post_type() != 'post' ) {
$post_type = get_post_type_object(get_post_type());
$slug = $post_type->rewrite;
echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;
} else {
$cat = get_the_category(); $cat = $cat[0];
$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
echo $cats;
if ($showCurrent == 1) echo $before . get_the_title() . $after;
}

} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
$post_type = get_post_type_object(get_post_type());
echo $before . $post_type->labels->singular_name . $after;

} elseif ( is_attachment() ) {
$parent = get_post($post->post_parent);
$cat = get_the_category($parent->ID); $cat = $cat[0];
echo get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

} elseif ( is_page() && !$post->post_parent ) {
if ($showCurrent == 1) echo $before . get_the_title() . $after;

} elseif ( is_page() && $post->post_parent ) {
$parent_id = $post->post_parent;
$breadcrumbs = array();
while ($parent_id) {
$page = get_page($parent_id);
$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
$parent_id = $page->post_parent;
}
$breadcrumbs = array_reverse($breadcrumbs);
for ($i = 0; $i < count($breadcrumbs); $i++) {
echo $breadcrumbs[$i];
if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . '</li> ';
}
if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

} elseif ( is_tag() ) {
echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

} elseif ( is_author() ) {
global $author;
$userdata = get_userdata($author);
echo $before . 'Articles posted by ' . $userdata->display_name . $after;

} elseif ( is_404() ) {
echo $before . 'Error 404' . $after;
}

if ( get_query_var('paged') ) {
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
echo __('Page') . ' ' . get_query_var('paged');
if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
}

echo '</ul>';

}
}

//google fonts for admin panel

function listgooglefontoptions() { $gfonts = array (

"Abel"=>"Abel " ,
"Abril Fatface"=>"Abril Fatface" ,
"Aclonica"=>"Aclonica" ,
"Acme"=>"Acme" ,
"Actor"=>"Actor " ,
"Adamina"=>"Adamina" ,
"Advent Pro"=>"Advent Pro" ,
"Aguafina Script"=>"Aguafina Script" ,
"Aladin"=>"Aladin" ,
"Aldrich"=>"Aldrich " ,
"Alex Brush"=>"Alex Brush" ,
"Alfa Slab One"=>"Alfa Slab One" ,
"Alice"=>"Alice " ,
"Alike Angular"=>"Alike Angular" ,
"Alike"=>"Alike " ,
"Allan"=>"Allan" ,
"Allerta Stencil"=>"Allerta Stencil" ,
"Allerta"=>"Allerta" ,
"Allura"=>"Allura" ,
"Almendra SC"=>"Almendra SC" ,
"Almendra"=>"Almendra" ,
"Amaranth"=>"Amaranth" ,
"Amatic SC"=>"Amatic SC" ,
"Amethysta"=>"Amethysta" ,
"Andada"=>"Andada" ,
"Andika"=>"Andika " ,
"Annie Use Your Telescope"=>"Annie Use Your Telescope" ,
"Anonymous Pro"=>"Anonymous Pro" ,
"Antic Didone"=>"Antic Didone" ,
"Antic Slab"=>"Antic Slab" ,
"Antic"=>"Antic" ,
"Anton"=>"Anton" ,
"Arapey"=>"Arapey" ,
"Arbutus"=>"Arbutus" ,
"Architects Daughter"=>"Architects Daughter" ,
"Arimo"=>"Arimo" ,
"Arizonia"=>"Arizonia" ,
"Armata"=>"Armata" ,
"Artifika"=>"Artifika" ,
"Arvo"=>"Arvo" ,
"Asap"=>"Asap" ,
"Asset"=>"Asset" ,
"Astloch"=>"Astloch" ,
"Asul"=>"Asul" ,
"Atomic Age"=>"Atomic Age" ,
"Aubrey"=>"Aubrey " ,
"Average"=>"Average" ,
"Averia Gruesa Libre"=>"Averia Gruesa Libre" ,
"Averia Libre"=>"Averia Libre" ,
"Averia Sans Libre"=>"Averia Sans Libre" ,
"Averia Serif Libre"=>"Averia Serif Libre" ,
"Bad Script"=>"Bad Script" ,
"Balthazar"=>"Balthazar" ,
"Bangers"=>"Bangers" ,
"Basic"=>"Basic" ,
"Baumans"=>"Baumans" ,
"Belgrano"=>"Belgrano" ,
"Bentham"=>"Bentham" ,
"Berkshire Swash"=>"Berkshire Swash" ,
"Bevan"=>"Bevan" ,
"Bigshot One"=>"Bigshot One" ,
"Bilbo Swash Caps"=>"Bilbo Swash Caps" ,
"Bilbo"=>"Bilbo" ,
"Bitter"=>"Bitter" ,
"Black Ops One"=>"Black Ops One " ,
"Bonbon"=>"Bonbon" ,
"Boogaloo"=>"Boogaloo" ,
"Bowlby One SC"=>"Bowlby One SC" ,
"Bowlby One"=>"Bowlby One" ,
"Brawler"=>"Brawler " ,
"Bree Serif"=>"Bree Serif" ,
"Bubblegum Sans"=>"Bubblegum Sans" ,
"Buda:light"=>"Buda" ,
"Buenard"=>"Buenard" ,
"Butcherman"=>"Butcherman" ,
"Butterfly Kids"=>"Butterfly Kids" ,
"Cabin Condensed"=>"Cabin Condensed" ,
"Cabin Sketch"=>"Cabin Sketch" ,
"Cabin Sketch:bold"=>"Cabin Sketch Bold" ,
"Cabin Sketch:regular,bold"=>"Cabin Sketch:regular,bold" ,
"Cabin"=>"Cabin" ,
"Caesar Dressing"=>"Caesar Dressing" ,
"Cagliostro"=>"Cagliostro" ,
"Calligraffitti"=>"Calligraffitti" ,
"Cambo"=>"Cambo" ,
"Candal"=>"Candal" ,
"Cantarell"=>"Cantarell" ,
"Cantata One"=>"Cantata One" ,
"Cardo"=>"Cardo" ,
"Carme"=>"Carme " ,
"Carter One"=>"Carter One" ,
"Caudex"=>"Caudex" ,
"Cedarville Cursive"=>"Cedarville Cursive" ,
"Ceviche One"=>"Ceviche One" ,
"Changa One"=>"Changa One" ,
"Chango"=>"Chango" ,
"Chelsea Market"=>"Chelsea Market" ,
"Cherry Cream Soda"=>"Cherry Cream Soda" ,
"Chewy"=>"Chewy" ,
"Chicle"=>"Chicle" ,
"Chivo"=>"Chivo" ,
"Coda"=>"Coda" ,
"Codystar"=>"Codystar" ,
"Comfortaa"=>"Comfortaa " ,
"Coming Soon"=>"Coming Soon" ,
"Concert One"=>"Concert One" ,
"Condiment"=>"Condiment" ,
"Contrail One"=>"Contrail One" ,
"Convergence"=>"Convergence" ,
"Cookie"=>"Cookie" ,
"Copse"=>"Copse" ,
"Corben"=>"Corben" ,
"Corben:bold"=>"Corben Bold" ,
"Cousine"=>"Cousine" ,
"Coustard"=>"Coustard " ,
"Covered By Your Grace"=>"Covered By Your Grace" ,
"Crafty Girls"=>"Crafty Girls" ,
"Creepster"=>"Creepster" ,
"Crete Round"=>"Crete Round" ,
"Crimson Text"=>"Crimson Text" ,
"Crushed"=>"Crushed" ,
"Cuprum"=>"Cuprum" ,
"Cutive"=>"Cutive" ,
"Damion"=>"Damion" ,
"Dancing Script"=>"Dancing Script" ,
"Dawning of a New Day"=>"Dawning of a New Day" ,
"Days One"=>"Days One " ,
"Delius Swash Caps"=>"Delius Swash Caps " ,
"Delius Unicase"=>"Delius Unicase " ,
"Delius"=>"Delius " ,
"Devonshire"=>"Devonshire" ,
"Didact Gothic"=>"Didact Gothic" ,
"Diplomata SC"=>"Diplomata SC" ,
"Diplomata"=>"Diplomata" ,
"Doppio One"=>"Doppio One" ,
"Dorsa"=>"Dorsa" ,
"Dr Sugiyama"=>"Dr Sugiyama" ,
"Droid Sans Mono"=>"Droid Sans Mono" ,
"Droid Sans"=>"Droid Sans" ,
"Droid Serif"=>"Droid Serif" ,
"Duru Sans"=>"Duru Sans" ,
"Dynalight"=>"Dynalight" ,
"EB Garamond"=>"EB Garamond" ,
"Eater"=>"Eater" ,
"Economica"=>"Economica" ,
"Electrolize"=>"Electrolize" ,
"Emblema One"=>"Emblema One" ,
"Emilys Candy"=>"Emilys Candy" ,
"Engagement"=>"Engagement" ,
"Enriqueta"=>"Enriqueta" ,
"Erica One"=>"Erica One" ,
"Esteban"=>"Esteban" ,
"Euphoria Script"=>"Euphoria Script" ,
"Ewert"=>"Ewert" ,
"Exo"=>"Exo" ,
"Expletus Sans"=>"Expletus Sans" ,
"Fanwood Text"=>"Fanwood Text" ,
"Fascinate Inline"=>"Fascinate Inline" ,
"Fascinate"=>"Fascinate" ,
"Federant"=>"Federant" ,
"Federo"=>"Federo " ,
"Felipa"=>"Felipa" ,
"Fjord One"=>"Fjord One" ,
"Flamenco"=>"Flamenco" ,
"Flavors"=>"Flavors" ,
"Fondamento"=>"Fondamento" ,
"Fontdiner Swanky"=>"Fontdiner Swanky" ,
"Forum"=>"Forum" ,
"Francois One"=>"Francois One" ,
"Fredoka One"=>"Fredoka One" ,
"Fresca"=>"Fresca" ,
"Frijole"=>"Frijole" ,
"Fugaz One"=>"Fugaz One" ,
"Galdeano"=>"Galdeano" ,
"Gentium Basic"=>"Gentium Basic " ,
"Gentium Book Basic"=>"Gentium Book Basic " ,
"Geo"=>"Geo" ,
"Geostar Fill"=>"Geostar Fill " ,
"Geostar"=>"Geostar " ,
"Germania One"=>"Germania One" ,
"Give You Glory"=>"Give You Glory" ,
"Glass Antiqua"=>"Glass Antiqua" ,
"Glegoo"=>"Glegoo" ,
"Gloria Hallelujah"=>"Gloria Hallelujah " ,
"Goblin One"=>"Goblin One" ,
"Gochi Hand"=>"Gochi Hand" ,
"Gorditas"=>"Gorditas" ,
"Goudy Bookletter 1911"=>"Goudy Bookletter 1911" ,
"Graduate"=>"Graduate" ,
"Gravitas One"=>"Gravitas One" ,
"Gruppo"=>"Gruppo" ,
"Gudea"=>"Gudea" ,
"Habibi"=>"Habibi" ,
"Hammersmith One"=>"Hammersmith One" ,
"Handlee"=>"Handlee" ,
"Happy Monkey"=>"Happy Monkey" ,
"Henny Penny"=>"Henny Penny" ,
"Herr Von Muellerhoff"=>"Herr Von Muellerhoff" ,
"Holtwood One SC"=>"Holtwood One SC" ,
"Homemade Apple"=>"Homemade Apple" ,
"Homenaje"=>"Homenaje" ,
"IM Fell DW Pica SC"=>"IM Fell DW Pica SC" ,
"IM Fell DW Pica"=>"IM Fell DW Pica" ,
"IM Fell Double Pica SC"=>"IM Fell Double Pica SC" ,
"IM Fell Double Pica"=>"IM Fell Double Pica" ,
"IM Fell English SC"=>"IM Fell English SC" ,
"IM Fell English"=>"IM Fell English" ,
"IM Fell French Canon SC"=>"IM Fell French Canon SC" ,
"IM Fell French Canon"=>"IM Fell French Canon" ,
"IM Fell Great Primer SC"=>"IM Fell Great Primer SC" ,
"IM Fell Great Primer"=>"IM Fell Great Primer" ,
"Iceberg"=>"Iceberg" ,
"Iceland"=>"Iceland" ,
"Imprima"=>"Imprima" ,
"Inconsolata"=>"Inconsolata" ,
"Inder"=>"Inder" ,
"Indie Flower"=>"Indie Flower" ,
"Inika"=>"Inika" ,
"Irish Grover"=>"Irish Grover" ,
"Irish Growler"=>"Irish Growler" ,
"Istok Web"=>"Istok Web" ,
"Italiana"=>"Italiana" ,
"Italianno"=>"Italianno" ,
"Jim Nightshade"=>"Jim Nightshade" ,
"Jockey One"=>"Jockey One" ,
"Jolly Lodger"=>"Jolly Lodger" ,
"Josefin Sans"=>"Josefin Sans" ,
"Josefin Slab"=>"Josefin Slab" ,
"Judson"=>"Judson" ,
"Julee"=>"Julee" ,
"Junge"=>"Junge" ,
"Jura"=>" Jura" ,
"Just Another Hand"=>"Just Another Hand" ,
"Just Me Again Down Here"=>"Just Me Again Down Here" ,
"Kameron"=>"Kameron" ,
"Karla"=>"Karla" ,
"Kaushan Script"=>"Kaushan Script" ,
"Kelly Slab"=>"Kelly Slab " ,
"Kenia"=>"Kenia" ,
"Knewave"=>"Knewave" ,
"Kotta One"=>"Kotta One" ,
"Kranky"=>"Kranky" ,
"Kreon"=>"Kreon" ,
"Kristi"=>"Kristi" ,
"Krona One"=>"Krona One" ,
"La Belle Aurore"=>"La Belle Aurore" ,
"Lancelot"=>"Lancelot" ,
"Lato" =>"Lato" ,
"Lato:regular"=>"Lato Regular" ,
"League Script"=>"League Script" ,
"Leckerli One"=>"Leckerli One " ,
"Ledger"=>"Ledger" ,
"Lekton"=>" Lekton " ,
"Lemon"=>"Lemon" ,
"Lilita One"=>"Lilita One" ,
"Limelight"=>" Limelight " ,
"Linden Hill"=>"Linden Hill" ,
"Lobster Two"=>"Lobster Two" ,
"Lobster"=>"Lobster" ,
"Londrina Outline"=>"Londrina Outline" ,
"Londrina Shadow"=>"Londrina Shadow" ,
"Londrina Sketch"=>"Londrina Sketch" ,
"Londrina Solid"=>"Londrina Solid" ,
"Lora"=>"Lora" ,
"Love Ya Like A Sister"=>"Love Ya Like A Sister" ,
"Loved by the King"=>"Loved by the King" ,
"Luckiest Guy"=>"Luckiest Guy" ,
"Lusitana"=>"Lusitana" ,
"Lustria"=>"Lustria" ,
"Macondo Swash Caps"=>"Macondo Swash Caps" ,
"Macondo"=>"Macondo" ,
"Magra"=>"Magra" ,
"Maiden Orange"=>"Maiden Orange" ,
"Mako"=>"Mako" ,
"Marck Script"=>"Marck Script" ,
"Marko One"=>"Marko One" ,
"Marmelad"=>"Marmelad" ,
"Marvel"=>"Marvel " ,
"Mate SC"=>"Mate SC" ,
"Mate"=>"Mate" ,
"Maven Pro"=>" Maven Pro" ,
"Meddon"=>"Meddon" ,
"MedievalSharp"=>"MedievalSharp" ,
"Medula One"=>"Medula One" ,
"Megrim"=>"Megrim" ,
"Merienda One"=>"Merienda One" ,
"Merriweather"=>"Merriweather" ,
"Metamorphous"=>"Metamorphous" ,
"Metrophobic"=>"Metrophobic" ,
"Michroma"=>"Michroma" ,
"Miltonian Tattoo"=>"Miltonian Tattoo" ,
"Miltonian"=>"Miltonian" ,
"Miniver"=>"Miniver" ,
"Miss Fajardose"=>"Miss Fajardose" ,
"Miss Saint Delafield"=>"Miss Saint Delafield" ,
"Modern Antiqua"=>"Modern Antiqua" ,
"Molengo"=>"Molengo" ,
"Monofett"=>"Monofett" ,
"Monoton"=>"Monoton " ,
"Monsieur La Doulaise"=>"Monsieur La Doulaise" ,
"Montaga"=>"Montaga" ,
"Montez"=>"Montez " ,
"Montserrat"=>"Montserrat" ,
"Mountains of Christmas"=>"Mountains of Christmas" ,
"Mr Bedford"=>"Mr Bedford" ,
"Mr Dafoe"=>"Mr Dafoe" ,
"Mr De Haviland"=>"Mr De Haviland" ,
"Mrs Saint Delafield"=>"Mrs Saint Delafield" ,
"Mrs Sheppards"=>"Mrs Sheppards" ,
"Muli"=>"Muli" ,
"Mystery Quest"=>"Mystery Quest" ,
"Neucha"=>"Neucha" ,
"Neuton"=>"Neuton" ,
"News Cycle"=>"News Cycle" ,
"Niconne"=>"Niconne" ,
"Nixie One"=>"Nixie One" ,
"Nobile"=>"Nobile" ,
"Nokora"=>"Nokora" ,
"Norican"=>"Norican" ,
"Nosifer"=>"Nosifer" ,
"Noticia Text"=>"Noticia Text" ,
"Nova Cut"=>"Nova Cut" ,
"Nova Flat"=>"Nova Flat" ,
"Nova Mono"=>"Nova Mono" ,
"Nova Oval"=>"Nova Oval" ,
"Nova Round"=>"Nova Round" ,
"Nova Script"=>"Nova Script" ,
"Nova Slim"=>"Nova Slim" ,
"Nova Square"=>"Nova Square" ,
"Numans"=>"Numans " ,
"Nunito"=>" Nunito Regular" ,
"Nunito:light"=>" Nunito Light" ,
"OFL Sorts Mill Goudy TT"=>"OFL Sorts Mill Goudy TT" ,
"Old Standard TT"=>"Old Standard TT" ,
"Oldenburg"=>"Oldenburg" ,
"Open Sans Condensed"=>"Open Sans Condensed" ,
"Open Sans"=>"Open Sans" ,
"Orbitron"=>"Orbitron" ,
"Original Surfer"=>"Original Surfer" ,
"Oswald"=>"Oswald" ,
"Over the Rainbow"=>"Over the Rainbow" ,
"Overlock SC"=>"Overlock SC" ,
"Overlock"=>"Overlock" ,
"Ovo"=>"Ovo " ,
"PT Mono"=>"PT Mono" ,
"PT Sans Caption"=>"PT Sans Caption" ,
"PT Sans Narrow"=>"PT Sans Narrow" ,
"PT Sans"=>"PT Sans" ,
"PT Serif Caption"=>"PT Serif Caption" ,
"PT Serif"=>"PT Serif" ,
"Pacifico"=>"Pacifico" ,
"Parisienne"=>"Parisienne" ,
"Passero One"=>"Passero One" ,
"Passion One"=>"Passion One" ,
"Patrick Hand"=>"Patrick Hand" ,
"Patua One"=>"Patua One" ,
"Paytone One"=>"Paytone One" ,
"Permanent Marker"=>"Permanent Marker" ,
"Petrona"=>"Petrona" ,
"Philosopher"=>"Philosopher" ,
"Piedra"=>"Piedra" ,
"Pinyon Script"=>"Pinyon Script" ,
"Plaster"=>"Plaster" ,
"Play"=>"Play" ,
"Playball"=>"Playball" ,
"Playfair Display"=>" Playfair Display " ,
"Podkova"=>" Podkova " ,
"Poiret One"=>"Poiret One" ,
"Poller One"=>"Poller One" ,
"Poly"=>"Poly" ,
"Pompiere"=>"Pompiere " ,
"Pontano Sans"=>"Pontano Sans" ,
"Port Lligat Sans"=>"Port Lligat Sans" ,
"Port Lligat Slab"=>"Port Lligat Slab" ,
"Prata"=>"Prata" ,
"Princess Sofia"=>"Princess Sofia" ,
"Prociono"=>"Prociono" ,
"Prosto One"=>"Prosto One" ,
"Puritan"=>"Puritan" ,
"Quantico"=>"Quantico" ,
"Quattrocento Sans"=>"Quattrocento Sans" ,
"Quattrocento"=>"Quattrocento" ,
"Questrial"=>"Questrial " ,
"Quicksand"=>"Quicksand" ,
"Qwigley"=>"Qwigley" ,
"Radley"=>"Radley" ,
"Raleway"=>"Raleway" ,
"Rammetto One"=>"Rammetto One" ,
"Rancho"=>"Rancho" ,
"Rationale"=>"Rationale " ,
"Redressed"=>"Redressed" ,
"Reenie Beanie"=>"Reenie Beanie" ,
"Revalia"=>"Revalia" ,
"Ribeye Marrow"=>"Ribeye Marrow" ,
"Ribeye"=>"Ribeye" ,
"Righteous"=>"Righteous" ,
"Rochester"=>"Rochester " ,
"Rock Salt"=>"Rock Salt" ,
"Rokkitt"=>"Rokkitt" ,
"Ropa Sans"=>"Ropa Sans" ,
"Rosario"=>"Rosario " ,
"Rouge Script"=>"Rouge Script" ,
"Ruda"=>"Ruda" ,
"Ruge Boogie"=>"Ruge Boogie" ,
"Ruluko"=>"Ruluko" ,
"Ruslan Display"=>"Ruslan Display" ,
"Ruthie"=>"Ruthie" ,
"Sail"=>"Sail" ,
"Salsa"=>"Salsa" ,
"Sancreek"=>"Sancreek" ,
"Sansita One"=>"Sansita One" ,
"Sarina"=>"Sarina" ,
"Satisfy"=>"Satisfy" ,
"Schoolbell"=>"Schoolbell" ,
"Seaweed Script"=>"Seaweed Script" ,
"Sevillana"=>"Sevillana" ,
"Shadows Into Light Two"=>"Shadows Into Light Two" ,
"Shadows Into Light"=>"Shadows Into Light" ,
"Shanti"=>"Shanti" ,
"Share"=>"Share" ,
"Shojumaru"=>"Shojumaru" ,
"Short Stack"=>"Short Stack " ,
"Sigmar One"=>"Sigmar One" ,
"Signika Negative"=>"Signika Negative" ,
"Signika"=>"Signika" ,
"Simonetta"=>"Simonetta" ,
"Sirin Stencil"=>"Sirin Stencil" ,
"Six Caps"=>"Six Caps" ,
"Slackey"=>"Slackey" ,
"Smokum"=>"Smokum " ,
"Smythe"=>"Smythe" ,
"Sniglet"=>"Sniglet" ,
"Snippet"=>"Snippet " ,
"Sofia"=>"Sofia" ,
"Sonsie One"=>"Sonsie One" ,
"Sorts Mill Goudy"=>"Sorts Mill Goudy" ,
"Special Elite"=>"Special Elite" ,
"Spicy Rice"=>"Spicy Rice" ,
"Spinnaker"=>"Spinnaker" ,
"Spirax"=>"Spirax" ,
"Squada One"=>"Squada One" ,
"Stardos Stencil"=>"Stardos Stencil" ,
"Stint Ultra Condensed"=>"Stint Ultra Condensed" ,
"Stint Ultra Expanded"=>"Stint Ultra Expanded" ,
"Stoke"=>"Stoke" ,
"Sue Ellen Francisco"=>"Sue Ellen Francisco" ,
"Sunshiney"=>"Sunshiney" ,
"Supermercado One"=>"Supermercado One" ,
"Swanky and Moo Moo"=>"Swanky and Moo Moo" ,
"Syncopate"=>"Syncopate" ,
"Tangerine"=>"Tangerine" ,
"Telex"=>"Telex" ,
"Tenor Sans"=>" Tenor Sans " ,
"Terminal Dosis Light"=>"Terminal Dosis Light" ,
"Terminal Dosis"=>"Terminal Dosis Regular" ,
"The Girl Next Door"=>"The Girl Next Door" ,
"Tinos"=>"Tinos" ,
"Titan One"=>"Titan One" ,
"Trade Winds"=>"Trade Winds" ,
"Trochut"=>"Trochut" ,
"Trykker"=>"Trykker" ,
"Tulpen One"=>"Tulpen One " ,
"Ubuntu Condensed"=>"Ubuntu Condensed" ,
"Ubuntu Mono"=>"Ubuntu Mono" ,
"Ubuntu"=>"Ubuntu" ,
"Ultra"=>"Ultra" ,
"Uncial Antiqua"=>"Uncial Antiqua" ,
"UnifrakturCook:bold"=>"UnifrakturCook" ,
"UnifrakturMaguntia"=>"UnifrakturMaguntia" ,
"Unkempt"=>"Unkempt" ,
"Unlock"=>"Unlock" ,
"Unna"=>"Unna " ,
"VT323"=>"VT323" ,
"Varela Round"=>"Varela Round" ,
"Varela"=>"Varela" ,
"Vast Shadow"=>"Vast Shadow" ,
"Vibur"=>"Vibur" ,
"Vidaloka"=>"Vidaloka " ,
"Viga"=>"Viga" ,
"Voces"=>"Voces" ,
"Volkhov"=>"Volkhov " ,
"Vollkorn"=>"Vollkorn" ,
"Voltaire"=>"Voltaire " ,
"Waiting for the Sunrise"=>"Waiting for the Sunrise" ,
"Wallpoet"=>"Wallpoet" ,
"Walter Turncoat"=>"Walter Turncoat" ,
"Wellfleet"=>"Wellfleet" ,
"Wire One"=>"Wire One" ,
"Yanone Kaffeesatz"=>"Yanone Kaffeesatz" ,
"Yellowtail"=>"Yellowtail " ,
"Yeseva One"=>"Yeseva One" ,
"Yesteryear"=>"Yesteryear" ,
"Zeyada"=>"Zeyada"
);
return $gfonts;
}



//Register post types

add_action( 'init', 'create_post_types' );
function create_post_types() {
// register_post_type('slides',
// array(
// 'labels' => array(
// 'name' => __( 'Custom Slides','post type general name' ),
// 'singular_name' => __( 'Custom Slide','post type singular name' ),
// 'add_new' => __( 'Add New Custom Slide'),
// 'add_new_item' => __( 'Add New Custom Slide' ),
// 'edit_item' => __( 'Edit Custom Slide' ),
// 'new_item' => __( 'New Custom Slide' ),
// 'view_item' => __( 'View Custom Slide' ),
// 'search_items' => __( 'Search Custom Slides' ),
// 'not_found' => __( 'No Custom Slides found' ),
// 'not_found_in_trash' => __( 'No Custom Slides found in trash' ),
//
// ),
// 'public' => true,
// 'supports' => array('title','thumbnail'),
// 'query_var' => true,
// 'hierarchical'=>false,
// 'menu_icon' => get_template_directory_uri().'/admin/assets/images/photo.png',
// 'rewrite' => array( 'slug' => 'slides' )
// ));
}


//register sidebars
add_action( 'widgets_init', 'saxon_widget_init' );
function saxon_widget_init(){
register_sidebar( array(
'name' => __( 'Sidebar Widget', 'saxonTheme' ),
'id' => 'sidebar_widget_1',
'description' => __( 'Widget for your sidebar', 'saxonTheme' ),
'before_widget' => '<div class="sidebar">',
'after_widget' => "</div>",
'before_title' => '<h3 class="sidebar-widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => __( 'Pages Widget', 'saxonTheme' ),
'id' => 'pages_widget_1',
'description' => __( 'Widget for pages', 'saxonTheme' ),
'before_widget' => '<div class="sidebar">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );


register_sidebar( array(
'name' => __( 'Home Page Widget', 'saxonTheme' ),
'id' => 'home_widget_1',
'description' => __( 'Widget for home page', 'saxonTheme' ),
'before_widget' => '<div class="sidebar">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => __( 'Single Post Page Widget', 'saxonTheme' ),
'id' => 'single_post_1',
'description' => __( 'Widget for single post page', 'saxonTheme' ),
'before_widget' => '<div class="sidebar">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar(array(
'name'=>__('Footer Area','saxonTheme'),
'id' => 'footer_widget',
'description' => __( 'Widget for your footer', 'saxonTheme' ),
'before_widget' => '<div class="footer-widget col-2">',
'after_widget' => "</div></div>",
'before_title' => '<h3 class="footer-widget-title">',
'after_title' => '</h3><div class="widget-holder">',
));


}
//meta box
add_filter( 'rwmb_meta_boxes', 'roguedzines_register_meta_boxes' );
function roguedzines_register_meta_boxes( $meta_boxes ) {
    $prefix = 'rw_';

    // 2nd meta box
    $meta_boxes[] = array(
        'title'      => __( 'Video', 'textdomain' ),
        'post_types' => 'post',
        'fields'     => array(
            array(
                'name' => __( 'Embed Code', 'textdomain' ),
                'id'   => $prefix . 'videoembed',
                'type' => 'oembed',
            ),
        )
    );
    return $meta_boxes;
}



//number of posts per page for taxonomy
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
global $option_posts_per_page;
global $options;
//get posts per page option from admin
if($options['archive_posts_per_page'] != '') {
$portfolio_posts_per_page = $options['portfolio_posts_per_page'];
} else { $portfolio_posts_per_page = '-1'; }

if ( is_tax() ) {
return $portfolio_posts_per_page;
} else {
return $option_posts_per_page;
}
}


// functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
$wp_rewrite->flush_rules();
}
?>
