<?php
global $data; //fetch options stored in $data
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'saxonTheme' ), max( $paged, $page ) );

	?>
</title>
<link rel="icon" type="image/png" href="<?php echo $data['custom_favicon'];?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if($data['theme_skin_color']!=''){ if ($data['theme_skin_color']!='default') { ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/styles/<?php echo $data['theme_skin_color'];?>" />


<?php } }?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />


<?php if($data['custom_font_href_css']!=''){

echo stripslashes($data['custom_font_href_css']);

	} ?>




<?php if($data['custom_font_java']!=''){

echo stripslashes($data['custom_font_java']);

	} ?>


<!-- Fire up HTML5 IE Queries-->
<!--[if lt IE 9]>   <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php

// include custom skin
//include_once(TEMPLATEPATH .'/styles/custom-style.php');
//include_once(TEMPLATEPATH .'/styles/custom-fonts.php');
?>


<?php
// show tracking code

?>
<?php
//run script for threaded comments
if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php if (!empty($data['header_tracking_analytics'])){
echo stripslashes($data['header_tracking_analytics']);
}?>

<?php

//require('functions/scripts.php');
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */

	wp_head(); //header hoook - do not remove this!
?>



</head>

<body <?php body_class(); ?>>

  <div id="main-slider">
    <div class="new-slider">
      <?php
 $slides = $data['home_slider'];
      foreach ($slides as $slide){ ?>
      <div style="background: url(<?php echo $slide['url']; ?>) no-repeat;background-size: cover;background-position: center center ;">&nbsp;</div>
      <?php } ?>
    </div>
    <div class="main-overlay"></div>
    <div class="navigation-wrapper">
      <div class="navigation">
        <div class="navigation-inside">
          <?php wp_nav_menu( array(
        																																								'theme_location' => 'main_menu',
        																																								'sort_column' => 'menu_order',
        																																								'menu_class' => 'sf-menu',
        																																								'fallback_cb' => 'default_menu'

        																																							)); ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="slider-content-wrapper">
      <div class="slider-content">
        <h1>Obsession</h1>
<div class="header-description">A Pinterest Inspired Wordpress Theme</div>
      </div>
    </div>
  </div>
  <div id="social-wrapper">
    <div class="social-container">
      <ul>
        <li><i class="fa fa-instagram fa-lg"></i></li>
        <li><i class="fa fa-facebook fa-lg"></i></li>
        <li><i class="fa fa-google-plus fa-lg"></i></li>
          <li><i class="fa fa-twitter fa-lg"></i></li>
      </ul>
    </div>
  </div>
    <div id="main-wrapper">
