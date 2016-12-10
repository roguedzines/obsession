<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");

		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");

		//Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
			$of_options_share 	= array("one" => "Facebook","two" => "Google Plus","three" => "Google Bookmarks","four" => "Twitter","five" => "Pinterest");

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			),
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = TEMPLATEPATH .'/styles/';
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }
		    }
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
				$opacity 		=  array("1","2","3","4","5","6","7","8","9","0");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		$slider_easing = array('linear','swing','easeInQuad','easeOutQuad','easeInOutQuad','easeInCubic','easeOutCubic','easeInOutCubic','easeInQuart','easeOutQuart','easeInOutQuart','easeInQuint','easeOutQuint','easeInOutQuint','easeInExpo','easeOutExpo','easeInOutExpo','easeInSine','easeOutSine','easeInOutSine','easeInCirc','easeOutCirc','easeInOutCirc','easeInElastic','easeOutElastic',
	'easeInOutElastic','easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce');
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");

$menu_options = array("dark","light");
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Hello there!",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Saxon Theme Options Panel</h3>
						Use this theme option panel if you want to make changes to the look and feel of the layout that isn't out the box. ",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( "name" => "Slider Options",
				"desc" => "Unlimited slider with drag and drop sortings.",
				"id" => "home_slider",
				"std" => "",
				"type" => "slider");

$of_options[] = array( 	"name" 		=> "Custom Favicon",
						"desc" 		=> "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
						"id" 		=> "custom_favicon",
						"std" 		=> "",
						"type" 		=> "upload"
				);
							$of_options[] = array( "name" => "Logo Uploader",
					"desc" => "Upload your own image to replace the logo.",
					"id" => "logo_upload",
					// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
					"std" => "",
					"type" => "media");


					$of_options[] = array( 	"name" 		=> "Custom Text Options",
						"desc" 		=> "If you choose to use text instead of an image, click this box for more options.",
						"id" 		=> "offline",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);


					$of_options[] = array( 	"name" 		=> "Header Text Options",
						"desc" 		=> "If you choose not to use a logo and want to use text to replace the image instead. Change it here.",
						"id" 		=> "header_logo_text",
						"std" 		=> "",
							"fold" 		=> "offline", /* the checkbox hook */
						"type" 		=> "text"
				);

								$of_options[] = array( 	"name" 		=> "Header Text Font Select",
						"desc" 		=> "Select the font type for your header text.",
						"id" 		=> "header_logo_text_select",
						"std" 		=> "",
										"fold" 		=> "offline", /* the checkbox hook */
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is the header text preview!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);
																							$of_options[] = array(
						"desc" 		=> "Pick a font color for the logo text.",
						"id" 		=> "header_logo_text_color",
						"std" 		=> "",
										"fold" 		=> "offline", /* the checkbox hook */
						"type" 		=> "color"
				);
								$of_options[] = array(
						"desc" 		=> "Choose a font size for the logo text.",
						"id" 		=> "header_logo_text_size",
						"std" 		=> array('size' => '12px','style' => 'normal'),
						"type" 		=> "typography",
										"fold" 		=> "offline", /* the checkbox hook */

				);


$of_options[] = array( 	"name" 		=> "Home Page",
						"type" 		=> "heading"
				);

//$url =  ADMIN_DIR . 'assets/images/';
//$of_options[] = array( 	"name" 		=> "Main Layout",
//						"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
//						"id" 		=> "layout",
//						"std" 		=> "2c-l-fixed.css",
//						"type" 		=> "images",
//						"options" 	=> array(
//							'1col-fixed.css' 	=> $url . '1col.png',
//							'2c-r-fixed.css' 	=> $url . '2cr.png',
//							'2c-l-fixed.css' 	=> $url . '2cl.png',
//							'3c-fixed.css' 		=> $url . '3cm.png',
//							'3c-r-fixed.css' 	=> $url . '3cr.png'
//						)
//				);

		// $of_options[] = array( 	"name" 		=> "Infinite Scrolling",
		// 				"desc" 		=> "By default you have to click to load more posts, if you want the posts to load automatically turn this switch on",
		// 				"id" 		=> "no_infinite_scroll",
		// 				"std" 		=> 0,
		// 								"on" 		=> "Enable",
		// 				"off" 		=> "Disable",
		// 				"type" 		=> "switch"
		// 		);

/*$of_options[] = array( 	"name" 		=> "Switch 3",
						"desc" 		=> "Switch with custom labels",
						"id" 		=> "switch_ex3",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);*/
//$of_options[] = array( 	"name" 		=> "Switch 2",
//						"desc" 		=> "Switch ON",
//						"id" 		=> "main_slider",
//		"std" 		=> 1,
//						"on" 		=> "Enable",
//						"off" 		=> "Disable",
//						"type" 		=> "switch"
//				);
$of_options[] = array( 	"name" 		=> "Enable or Disable Excerpt",
"desc" 		=> "Disable or enable excerpts the home page",
"id" 		=> "main_excerpt_switch_post",
"std" 		=> 1,
"on" 		=> "Enable",
"off" 		=> "Disable",
"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "If you choose to change the default text in the footer, change it here.",
						"id" 		=> "footer_text",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
	$of_options[] = array( 	"name" 		=> "Additional Footer Text (left side)",
						"desc" 		=> "If you choose to have additional footer text ont the left side you can enter it here.",
						"id" 		=> "footer_text_additional",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

				//instagram settings

				$of_options[] = array( 	"name" 		=> "Instagram Feed",
									"type" 		=> "heading",
									);
									$of_options[] = array( 	"name" 		=> "Enable Instagram Feed",
							"desc" 		=> "Enable Instagram Feed",
							"id" 		=> "instagram_feed_enable",
							"std" 		=> 0,
							"type" 		=> "switch"
					);
							$of_options[] = array( 	"name" 		=> "Instagram User ID",
									"desc" 		=> "Enter your Instagram User ID, you can get that information<a href='http://jelled.com/instagram/access-token' target='_blank'> here </a>",
									"id" 		=> "instagram_feeduserid",
									"std" 		=> "",
									"type" 		=> "text"
							);

							$of_options[] = array( 	"name" 		=> "Instagram Access Token",
									"desc" 		=> "Enter your Instagram Access Token, you can get that information <a href='http://jelled.com/instagram/access-token' target='_blank'>here</a>",
									"id" 		=> "instagram_feed_accesstoken",
									"std" 		=> "",
									"type" 		=> "text"
							);

							$of_options[] = array( 	"name" 		=> "Instagram Feed Autoplay",
								 "desc" 		=> "Autoplay on or off for feed",
								 "id" 		=> "instagram_feed_autoplay",
							   "std" 		=> 1,
								 "type" 		=> "switch"
			);
			// 								$of_options[] = array( 	"name" 		=> "Animation Loop",
			// 						"desc" 		=> "Slider animation loop On or Off",
			// 						"id" 		=> "gallery_slider_loop",
			// 						"std" 		=> 1,
			// 						"type" 		=> "switch"
			// 				);
	//slider settings

	$of_options[] = array( 	"name" 		=> "Post Gallery Slider",
						"type" 		=> "heading",
						);
				$of_options[] = array( 	"name" 		=> "Animation Speed",
						"desc" 		=> "Set the animation speed for the slider.<br /> Min: 1, max: 500, step: 3, default value: 45",
						"id" 		=> "gallery_slider_speed",
						"std" 		=> "600",
						"min" 		=> "300",
						"step"		=> "3",
						"max" 		=> "900",
						"type" 		=> "sliderui"
				);

								$of_options[] = array( 	"name" 		=> "Slider Easing",
						"desc" 		=> "Choose the easing for the animation on the slider. If you would like to see all the easing optiions <a href='http://jqueryui.com/resources/demos/effect/easing.html' target='_blank'>
						click here</a> to see them, all the examples on this page are found in the drop down",
						"id" 		=> "gallery_slider_easing",
						"std" 		=> "linear",
						"type" 		=> "select",
						"options" 	=> $slider_easing
				);

								$of_options[] = array( 	"name" 		=> "Slider Navigation Controls",
						"desc" 		=> "Controls on or off for slider",
						"id" 		=> "gallery_slider_controls",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				$of_options[] = array( 	"name" 		=> "Slider Pagination Controls",
					 "desc" 		=> "Controls on or off for slider",
					 "id" 		=> "gallery_slider_pagination",
				   "std" 		=> 1,
					 "type" 		=> "switch"
);
								$of_options[] = array( 	"name" 		=> "Animation Loop",
						"desc" 		=> "Slider animation loop On or Off",
						"id" 		=> "gallery_slider_loop",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				$of_options[] = array( 	"name" 		=> "Auto Play",
		"desc" 		=> "Slider autoplay",
		"id" 		=> "gallery_slider_auto",
		"std" 		=> 0,
		"type" 		=> "switch"
);


// social bookmark settings
$of_options[] = array( 	"name" 		=> "Social Networks",
						"type" 		=> "heading"
				);


				$of_options[] = array( 	"name" 		=> "Social Intro",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Saxon Social Network Options</h3>
						Social Network buttons will show up in the header according to the ones that you have filled out here, be sure <b>not</b> to include any &quot; &quot; in the address ",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				$of_options[] = array( 	"name" 		=> "Enable or Disable Social Sharing",
						"desc" 		=> "Enable or Disable social sharing on site(shown above navigation)",
						"id" 		=> "enable_social_buttons",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Google Plus Profile",
						"desc" 		=> "The link to your Google Plus Profile.",
						"id" 		=> "google_social_url",
						"std" 		=> "http://plus.google.com/",
						"type" 		=> "text"
				);

				$of_options[] = array( 	"name" 		=> "Flickr Profile",
						"desc" 		=> "The link to your Flickr Profile.",
						"id" 		=> "flickr_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
								$of_options[] = array( 	"name" 		=> "Facebook Profile",
						"desc" 		=> "The link to your Facebook Profile.",
						"id" 		=> "facebook_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

												$of_options[] = array( 	"name" 		=> "Dribble Profile",
						"desc" 		=> "The link to your Dribble Profile.",
						"id" 		=> "dribble_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
																	$of_options[] = array( 	"name" 		=> "Pinterest Profile",
						"desc" 		=> "The link to your Pinterest Profile.",
						"id" 		=> "pinterest_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

													$of_options[] = array( 	"name" 		=> "Digg Profile",
						"desc" 		=> "The link to your Digg Profile.",
						"id" 		=> "digg_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

													$of_options[] = array( 	"name" 		=> "Deviant Profile",
						"desc" 		=> "The link to your Google Plus Profile.",
						"id" 		=> "deviant_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);



													$of_options[] = array( 	"name" 		=> "Delicious Profile",
						"desc" 		=> "The link to your Delicious Profile.",
						"id" 		=> "delicious_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);


											$of_options[] = array( 	"name" 		=> "Blogger Profile",
						"desc" 		=> "The link to your Blogger Profile.",
						"id" 		=> "blogger_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

															$of_options[] = array( 	"name" 		=> "Vimeo Profile",
						"desc" 		=> "The link to your Vimeo Profile.",
						"id" 		=> "vimeo_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
															$of_options[] = array( 	"name" 		=> "Twitter Profile",
						"desc" 		=> "The link to your Twitter Profile.",
						"id" 		=> "twitter_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

																			$of_options[] = array( 	"name" 		=> "Souncloud Profile",
						"desc" 		=> "The link to your SoundCloud Profile.",
						"id" 		=> "soundcloud_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
																							$of_options[] = array( 	"name" 		=> "Reddit Profile",
						"desc" 		=> "The link to your Reddit Profile.",
						"id" 		=> "reddit_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
																											$of_options[] = array( 	"name" 		=> "Picasa Profile",
						"desc" 		=> "The link to your Picasa Profile.",
						"id" 		=> "picasa_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
																															$of_options[] = array( 	"name" 		=> "Instagram Profile",
						"desc" 		=> "The link to your Instagram Profile.",
						"id" 		=> "instagram_social_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
							// start page options

				$of_options[] = array( 	"name" 		=> "Blog Options",
						"type" 		=> "heading"
				);

				$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Sidebar Options",
						"desc" 		=> "Select which side you want the sidebar on.",
						"id" 		=> "sidebar_options",
						"std" 		=> "sidebar-right",
						"type" 		=> "images",
						"options" 	=> array(
								'sidebar-right' 	=> $url . '2cr.png',
							'sidebar-left' 	=> $url . '2cl.png',

						)
				);


						$of_options[] = array( 	"name" 		=> "Number of Posts on Homepage",
						"desc" 		=> "How many posts do you want to show on the front page?.",
						"id" 		=> "home_blog_post_count",
						"std" 		=> "8",
						"type" 		=> "select",
						"options" 	=> $other_entries
				);


						$of_options[] = array( 	"name" 		=> "Number of Posts on the Category Page",
						"desc" 		=> "How many posts do you want to show on the category page?.",
						"id" 		=> "category_blog_post_count",
						"std" 		=> "8",
						"type" 		=> "select",
						"options" 	=> $other_entries
				);
					$of_options[] = array( 	"name" 		=> "Number of Posts on the Archive Page",
						"desc" 		=> "How many posts do you want to show on the archive page?.",
						"id" 		=> "archive_blog_post_count",
						"std" 		=> "8",
						"type" 		=> "select",
						"options" 	=> $other_entries
				);

								$of_options[] = array( 	"name" 		=> "Disable or Enable Tags on Single Post Pages",
						"desc" 		=> "Show or hide the tags on single post page",
						"id" 		=> "toggle_tags_single",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
												$of_options[] = array( 	"name" 		=> "Disable or Enable Breadcrumbs",
						"desc" 		=> "Show or hide breadcrumbs",
						"id" 		=> "toggle_breadcrumbs",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
				//sharing on single page

				$of_options[] = array( 	"name" 		=> "Sharing/Bookmark Options",
						"desc" 		=> "Select for more sharing options on single post page",
						"id" 		=> "sharing_offline",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);


				$of_options[] = array( 	"name" 		=> "Turn off default sharing on single page",
						"desc" 		=> "If you wish to use a different sharing service for your posts, you may choose to turn off the default and use your own.",
						"id" 		=> "share_option",
						"std" 		=> 1,
						"on" 		=> "Enable",
											"fold" 		=> "sharing_offline", /* the checkbox hook */
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Sharing Text",
						"desc" 		=> "Change the text for sharing posts.",
						"id" 		=> "share_custom_text",
						"std" 		=> "",
											"fold" 		=> "sharing_offline", /* the checkbox hook */
						"type" 		=> "text"
				);


								$of_options[] = array( 	"name" 		=> "Social Networks",
						"desc" 		=> "Choose which social network you would like to show up on the single post page.",
						"id" 		=> "social_multicheck",
						"std" 		=> array('one','two','three','four','five'),
						"type" 		=> "multicheck",
											"fold" 		=> "sharing_offline", /* the checkbox hook */
						"options" 	=> $of_options_share
				);


				$of_options[] = array( 	"name" 		=> "Related Post Options",
						"desc" 		=> "Select for more sharing options on single post page",
						"id" 		=> "relatedposts_offline",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);



				$of_options[] = array( 	"name" 		=> "Disable or Enable related posts",
						"desc" 		=> "Show or hide the related posts",
						"id" 		=> "toggle_related_posts",
						"std" 		=> 0,
						"on" 		=> "Enable",
							"fold" 		=> "relatedposts_offline", /* the checkbox hook */
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "How many related post to show?",
						"desc" 		=> "How many related posts should be shown.",
						"id" 		=> "related_post_count",
						"std" 		=> "4",
													"fold" 		=> "relatedposts_offline", /* the checkbox hook */
						"type" 		=> "select",
						"options" 	=> $other_entries
				);


$of_options[] = array( 	"name" 		=> "Related Post Title",
						"desc" 		=> "Change the related post title.",
						"id" 		=> "related_post_tag",
						"std" 		=> "",
							"fold" 		=> "relatedposts_offline", /* the checkbox hook */
						"type" 		=> "text"
				);





				$of_options[] = array( 	"name" 		=> "Author Options &nbsp;<img src=".get_template_directory_uri()."/admin/assets/images/user_suit.png>",
						"desc" 		=> "Select for more author options on single post page",
						"id" 		=> "autor_option_offline",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "checkbox"
				);


				$of_options[] = array( 	"name" 		=> "Enable or Disable Author Info box on single page",
						"desc" 		=> "Show or hide the author box on single post pages.",
						"id" 		=> "toggle_author_box",
						"std" 		=> 1,
								"fold" 		=> "autor_option_offline", /* the checkbox hook */
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
				$of_options[] = array( 	"name" 		=> "Optional Additional Author Text",
						"desc" 		=> "Add optional text to the author box if you want to use html for example.",
						"id" 		=> "author_additional_text",
						"std" 		=> "",
								"fold" 		=> "autor_option_offline", /* the checkbox hook */
						"type" 		=> "textarea"
				);


			$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading"
				);

																$of_options[] = array( 	"name" 		=> "Body Font Select",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "body_font_select",
						"std" 		=> "Open Sans",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is the body text preview!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);


				$of_options[] = array(
						"desc" 		=> "Typography option with each property can be called individually.",
						"id" 		=> "body_font_main",
						"std" 		=> array('size' => '14px','style' => 'normal','color' => '#9a9a9a'),
						"type" 		=> "typography"
				);

//
//$of_options[] = array( 	"name" 		=> "Google Font Select2",
//						"desc" 		=> "Some description.",
//						"id" 		=> "g_select2",
//						"std" 		=> "Select a font",
//						"type" 		=> "select_google_font",
//						"options" 	=> listgooglefontoptions()
//
//				);
												$of_options[] = array( 	"name" 		=> "Headings",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "heading_font_select",
						"std" 		=> "Raleway",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my heading text preview!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);


								$of_options[] = array( 	"name" 		=> "Front Subject Font",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "subject_font_select",
						"std" 		=> "Open Sans",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my subject text preview!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);
								$of_options[] = array(
						"desc" 		=> "Typography option with each property can be called individually.",
						"id" 		=> "front_fsubject_size",
						"std" 		=> array('size' => '12px','style' => 'bold italic'),
						"type" 		=> "typography"
				);

								$of_options[] = array( 	"name" 		=> "Navigation",
						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
						"id" 		=> "navigation_font_select",
						"std" 		=> "PT Sans",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my navigation text preview!", //this is the text from preview box
										"size" => "30px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);
				$of_options[] = array(
						"desc" 		=> "Typography option with each property can be called individually.",
						"id" 		=> "navigation_font",
						"std" 		=> array('size' => '15px','style' => 'normal'),
						"type" 		=> "typography"
				);

				//sidebar


									$of_options[] = array( 	"name" 		=> "Sidebar Heading",
						"desc" 		=> "Choose a font for the sidebar titles.",
						"id" 		=> "sidebar_widget_heading_font_select",
						"std" 		=> "Abel",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my sidebar widget heading text preview!", //this is the text from preview box
										"size" => "22px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);
				$of_options[] = array(
						"desc" 		=> "Choose a size and style for the sidebar title.",
						"id" 		=> "sidebar_widget_heading",
						"std" 		=> array('size' => '18px','style' => 'normal'),
						"type" 		=> "typography"
				);


				//footer

									$of_options[] = array( 	"name" 		=> "Footer Heading",
						"desc" 		=> "Choose a font for the footer widget title.",
						"id" 		=> "footer_widget_heading_font_select",
						"std" 		=> "Roboto Slab",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is my footer widget heading text preview!", //this is the text from preview box
										"size" => "22px" //this is the text size from preview box
						),
						"options" 	=> listgooglefontoptions()
				);
				$of_options[] = array(
						"desc" 		=> "Choose a font size and font style for the footer title.",
						"id" 		=> "footer_widget_heading",
						"std" 		=> array('size' => '20px','style' => 'normal'),
						"type" 		=> "typography"
				);




// start general styling options
$of_options[] = array( 	"name" 		=> "Backgrounds",
						"type" 		=> "heading"
				);
				$of_options[] = array( 	"name" 		=> "Enable Preset Backgrounds",
						"desc" 		=> "Enable or diable the backgrounds that come with the theme",
						"id" 		=> "front_pattern_bg_switch",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

								$of_options[] = array( 	"name" 		=> "Choose Preset Background",
						"desc" 		=> "Select a background pattern for content area.",
						"id" 		=> "front_pattern_bg",
						"std" 		=> "repeat",


						"type" 		=> "tiles",
						"options" 	=> $bg_images,
				);

					$of_options[] = array( 	"name" 		=> "Main Background Repeat",
						"desc" 		=> "How should the background repeat itself?",
						"id" 		=> "front_pattern_bg_repeat",
						"std" 		=> "",

						"type" 		=> "select",
						"options" 	=> $body_repeat
				);
										$of_options[] = array( 	"name" 		=> "Enable or Disable Custom Backgrounds",
						"desc" 		=> "Enable or disable so you can use your own patten",
						"id" 		=> "front_custom_bg_switch",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);
						$of_options[] = array( 	"name" 		=> "Custom Background Upload",
						"desc" 		=> "If you choose to use your own background pattern you can upload it here.",
						"id" 		=> "front_custom_bg",
						"std" 		=> "",
						"mod" 		=> "min",
						"type" 		=> "upload"
				);
						$of_options[] = array( 	"name" 		=> "Custom Background Repeat",
						"desc" 		=> "How should your custom background repeat itself?",
						"id" 		=> "front_custom_bg_repeat",
						"std" 		=> "",

						"type" 		=> "select",
						"options" 	=> $body_repeat
				);
						$of_options[] = array( 	"name" 		=> "Enable or Disable Custom Color Backgrounds",
						"desc" 		=> "Enable or disable so you can use your own patten",
						"id" 		=> "front_custom_colorbg_switch",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);



								$of_options[] = array( 	"name" 		=> "Custom Background Color",
						"desc" 		=> "Pick a background color for main body.",
						"id" 		=> "front_custom_colorbg",
						"std" 		=> "",
						"type" 		=> "color"
				);

				$of_options[] = array( 	"name" 		=> "Header Background Options",
					"desc" 		=> "If you choose to use text instead of an image, click this box for more options.",
					"id" 		=> "offline",
					"std" 		=> 0,
					"folds" 	=> 1,
					"type" 		=> "checkbox"
			);
			$of_options[] = array( 	"name" 		=> "Enable or Disable Header Pattern Backgrounds",
			"desc" 		=> "Enable or disable so you can use your own patten",
			"id" 		=> "header_patternbg_switch",
			"std" 		=> 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
	);

				$of_options[] = array( 	"name" 		=> "Choose Header Background Pattern",
										"desc" 		=> "Select a background pattern for content area.",
										"id" 		=> "header_pattern_bg",
										"std" 		=> "repeat",
										"fold" 		=> "offline",
										"type" 		=> "tiles",
										"options" 	=> $bg_images,
								);
				$of_options[] = array( 	"name" 		=> "Header Background Color",
						"desc" 		=> "Pick a background color for the header (default: #fff).",
						"id" 		=> "header_background_color",
						"std" 		=> "",
						"fold" 		=> "offline",
						"type" 		=> "color"
				);
				$of_options[] = array( 	"name" 		=> "Header Custom Background Upload",
				"desc" 		=> "If you choose to use your own background pattern you can upload it here.",
				"id" 		=> "header_custom_bg",
				"std" 		=> "",
				"mod" 		=> "min",
					"fold" 		=> "offline",
				"type" 		=> "upload"
		);
				$of_options[] = array( 	"name" 		=> "Header Custom Background Repeat",
				"desc" 		=> "How should your custom background repeat itself?",
				"id" 		=> "header_custom_bg_repeat",
				"std" 		=> "",
	"fold" 		=> "offline",
				"type" 		=> "select",
				"options" 	=> $body_repeat
		);

$of_options[] = array( 	"name" 		=> "Footer Background Color",
						"desc" 		=> "Pick a background color for the footer (default: #fff).",
						"id" 		=> "footer_background",
						"std" 		=> "",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);
				// $of_options[] = array( 	"name" 		=> "Theme Stylesheet",
				// 		"desc" 		=> "Select your themes alternative color scheme.",
				// 		"id" 		=> "theme_skin_color",
				// 		"std" 		=> "default.css",
				// 		"type" 		=> "select",
				// 		"options" 	=> $alt_stylesheets
				// );

		// $of_options[] = array( 	"name" 		=> "Choose menu style",
		// 				"desc" 		=> "Choose Style for the menu.",
		// 				"id" 		=> "menu_style_choice",
		// 				"std" 		=> "light",
		// 				"type" 		=> "select",
		// 				"options" 	=> $menu_options,
		// 				);

//$of_options[] = array( 	"name" 		=> "Body Font Properties",
//						"desc" 		=> "Specify the body font properties",
//						"id" 		=> "body_font_main",
//						"std" 		=> array('size' => '14px','face' => 'Helvetica','style' => 'normal','color' => '#9a9a9a'),
//						"type" 		=> "typography"
//				);
//				$of_options[] = array( 	"name" 		=> "Background Images",
//						"desc" 		=> "Select a background pattern.",
//						"id" 		=> "custom_bg",
//						"std" 		=> $bg_images_url."bg0.png",
//						"type" 		=> "tiles",
//						"options" 	=> $bg_images,
//				);
//
$of_options[] = array( 	"name" 		=> "Main Link Properties",
						"desc" 		=> "Pick a color for the links.",
						"id" 		=> "main_link_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				$of_options[] = array(
						"desc" 		=> "Pick a hover color for the links.",
						"id" 		=> "main_link_hover_color",
						"std" 		=> "",
						"type" 		=> "color"
				);


				$of_options[] = array( 	"name" 		=> "Homepage Blog Footer Color",
										"desc" 		=> "Pick a color for the blog footer on the homepage.",
										"id" 		=> "blog_footer_color",
										"std" 		=> "",
										"type" 		=> "color"
								);

					$of_options[] = array(
							"desc" 		=> "Pick a color for the footer links.",
							"id" 		=> "blog_footer_link_color",
							"std" 		=> "",
							"type" 		=> "color"
					);

							$of_options[] = array(
									"desc" 		=> "Pick a color for the footer social links.",
									"id" 		=> "blog_footer_social_link_color",
									"std" 		=> "",
									"type" 		=> "color"
							);
							//
							// $of_options[] = array( 	"name" 		=> "Pagination Colors",
							// 						"desc" 		=> "Pick a background for the pagination.",
							// 						"id" 		=> "pagination_background_color",
							// 						"std" 		=> "",
							// 						"type" 		=> "color"
							// 				);
							// $of_options[] = array(
							// 		"desc" 		=> "Pick a hover backgroudn color for the pagination.",
							// 		"id" 		=> "pagination_background_hover_color",
							// 		"std" 		=> "",
							// 		"type" 		=> "color"
							// );
							// $of_options[] = array(
							// 		"desc" 		=> "Pick a link color for the pagination.",
							// 		"id" 		=> "pagination_link_color",
							// 		"std" 		=> "",
							// 		"type" 		=> "color"
							// );
							//
							//



				//sidebar
								$of_options[] = array(
								"name" 		=> "Sidebar Widget Heading Color",
						"desc" 		=> "Pick a hover color for the links .",
						"id" 		=> "sidebar_widget_font_color",
						"std" 		=> "",
						"type" 		=> "color"
				);

												$of_options[] = array( 	"name" 		=> "Sidebar Widget Title Border",
						"desc" 		=> "Change the border below the widget title.",
						"id" 		=> "sidebar_widget_title_border",

						"std" 		=> array(
											'width' => '10',
											'style' => 'solid',
											'color' => '#ffffff',

										),
						"type" 		=> "border"
				);

				//footer
								$of_options[] = array(
								"name" 		=> "Footer Widget Heading Color",
						"desc" 		=> "Pick a hover color for the links .",
						"id" 		=> "footer_widget_font_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
								$of_options[] = array( 	"name" 		=> "Footer Widget Title Border",
						"desc" 		=> "Change the border below the widget title.",
						"id" 		=> "footer_widget_title_border",

						"std" 		=> array(
											'width' => '10',
											'style' => 'solid',
											'color' => '#ffffff',

										),
						"type" 		=> "border"
				);

				$of_options[] = array( 	"name" 		=> "Navigation Style",
						"type" 		=> "heading"
				);
											//navi custom
								$of_options[] = array(
								"name" 		=> "Navigation Background Color",
						"desc" 		=> "Pick a background color for the navigation .",
						"id" 		=> "navigation_bg",
						"std" 		=> "",
						"type" 		=> "color"
				);

											$of_options[] = array(
								"name" 		=> "Navigation Top Level Link Color",
						"desc" 		=> "Pick a color for the top level navigation.",
						"id" 		=> "navigation_top_level_link",
						"std" 		=> "",
						"type" 		=> "color"
				);
																				$of_options[] = array(
						"name" 		=> "Navigation Dropdown Background Color",
						"desc" 		=> "Pick a background color for the navigation dropdown.",
						"id" 		=> "navi_dropdown_custom_bg",
						"std" 		=> "",
						"type" 		=> "color"
				);
								$of_options[] = array(
				"name" 		=> "Navigation Dropdown Background Hover Color",
				"desc" 		=> "Pick a background hover color for the navigation dropdown.",
				"id" 		=> "navi_dropdown_custom_bg_hover",
				"std" 		=> "",
				"type" 		=> "color"
				);

						$of_options[] = array(
								"name" 		=> "Navigation Dropdown Font Color",
						"desc" 		=> "Pick a font hover color for the navigation links.",
						"id" 		=> "navi_dropdown_color",
						"std" 		=> "",
						"type" 		=> "color"
				);

				// 											$of_options[] = array(
				// 				"name" 		=> "Navigation Font Color",
				// 		"desc" 		=> "Pick a font color for the navigation drop down links.",
				// 		"id" 		=> "navi_custom_color",
				// 		"std" 		=> "",
				// 		"type" 		=> "color"
				// );
				// 																$of_options[] = array(
				// 				"name" 		=> "Navigation Dropdown Font Color",
				// 		"desc" 		=> "Pick a font hover color for the navigation drop down links.",
				// 		"id" 		=> "navi_custom_color_hover",
				// 		"std" 		=> "",
				// 		"type" 		=> "color"
				// );

// styling options template
$of_options[] = array( 	"name" 		=> "Custom Styles",
						"type" 		=> "heading"
				);




$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "/* some custom styling */",
						"type" 		=> "textarea"
				);
				$of_options[] = array( 	"name" 		=> "Custom Font Stylesheets",
						"desc" 		=> "If there are fonts that are not included with this theme that you would like to use insert your link <strong>href</strong> code in the textbox.",
						"id" 		=> "custom_font_href_css",
						"std" 		=> "",
								"type" 		=> "text"
				);



$of_options[] = array( 	"name" 		=> "Custom Font CSS",
						"desc" 		=> "If you prefer to use the CSS format like the one provided by google, enter it here. ",
						"id" 		=> "custom_font_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Custom Google Font (Javascript Integration)",
						"desc" 		=> "If you prefer to use the Google Font Javascript Intergration method, insert the entire javascript here. <a href='http://www.google.com/fonts/#UsePlace:use'>Click here for an example</a> ",
						"id" 		=> "custom_font_java",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

				$of_options[] = array( 	"name" 		=> "Analytics",
						"type" 		=> "heading"
				);

		$of_options[] = array( 	"name" 		=> "Header Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.",
						"id" 		=> "header_tracking_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

					$of_options[] = array( 	"name" 		=> "Footer Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "footer_tracking_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
//$of_options[] = array( 	"name" 		=> "Example Options",
//						"type" 		=> "heading"
//				);
//
//$of_options[] = array( 	"name" 		=> "Typography",
//						"desc" 		=> "This is a typographic specific option.",
//						"id" 		=> "typography",
//						"std" 		=> array(
//											'size'  => '12px',
//											'face'  => 'verdana',
//											'style' => 'bold italic',
//											'color' => '#123456'
//										),
//						"type" 		=> "typography"
//				);
//
//$of_options[] = array( 	"name" 		=> "Border",
//						"desc" 		=> "This is a border specific option.",
//						"id" 		=> "border",
//						"std" 		=> array(
//											'width' => '2',
//											'style' => 'dotted',
//											'color' => '#444444'
//										),
//						"type" 		=> "border"
//				);
//
//$of_options[] = array( 	"name" 		=> "Colorpicker",
//						"desc" 		=> "No color selected.",
//						"id" 		=> "example_colorpicker",
//						"std" 		=> "",
//						"type" 		=> "color"
//					);
//
//$of_options[] = array( 	"name" 		=> "Colorpicker (default #2098a8)",
//						"desc" 		=> "Color selected.",
//						"id" 		=> "example_colorpicker_2",
//						"std" 		=> "#2098a8",
//						"type" 		=> "color"
//				);
//
//$of_options[] = array( 	"name" 		=> "Upload",
//						"desc" 		=> "An image uploader without text input.",
//						"id" 		=> "uploader",
//						"std" 		=> "",
//						"type" 		=> "upload"
//				);
//
//$of_options[] = array( 	"name" 		=> "Upload Min",
//						"desc" 		=> "An image uploader with text input.",
//						"id" 		=> "uploader2",
//						"std" 		=> "",
//						"mod" 		=> "min",
//						"type" 		=> "upload"
//				);
//
//$of_options[] = array( 	"name" 		=> "Input Text",
//						"desc" 		=> "A text input field.",
//						"id" 		=> "test_text",
//						"std" 		=> "Default Value",
//						"type" 		=> "text"
//				);
//
//$of_options[] = array( 	"name" 		=> "Input Checkbox (false)",
//						"desc" 		=> "Example checkbox with false selected.",
//						"id" 		=> "example_checkbox_false",
//						"std" 		=> 0,
//						"type" 		=> "checkbox"
//				);
//
//$of_options[] = array( 	"name" 		=> "Input Checkbox (true)",
//						"desc" 		=> "Example checkbox with true selected.",
//						"id" 		=> "example_checkbox_true",
//						"std" 		=> 1,
//						"type" 		=> "checkbox"
//				);
//
//$of_options[] = array( 	"name" 		=> "Normal Select",
//						"desc" 		=> "Normal Select Box.",
//						"id" 		=> "example_select",
//						"std" 		=> "three",
//						"type" 		=> "select",
//						"options" 	=> $of_options_select
//				);
//
//
//$of_options[] = array( 	"name" 		=> "Google Font Select",
//						"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
//						"id" 		=> "g_select",
//						"std" 		=> "Select a font",
//						"type" 		=> "select_google_font",
//						"preview" 	=> array(
//										"text" => "This is my preview text!", //this is the text from preview box
//										"size" => "30px" //this is the text size from preview box
//						),
//						"options" 	=> array(
//										"none" => "Select a font",//please, always use this key: "none"
//										"Advent Pro"=>"Advent Pro" ,
//"Aguafina Script"=>"Aguafina Script" ,
//"Aladin"=>"Aladin" ,
//"Aldrich"=>"Aldrich " ,
//"Alex Brush"=>"Alex Brush" ,
//"Alfa Slab One"=>"Alfa Slab One"
//						)
//				);
//								$of_options[] = array(
//						"desc" 		=> "Typography option with each property can be called individually.",
//						"id" 		=> "front_fsubject_type",
//						"std" 		=> array('size' => '12px','style' => 'bold italic'),
//						"type" 		=> "typography"
//				);
//
//
//$of_options[] = array( 	"name" 		=> "Google Font Select2",
//						"desc" 		=> "Some description.",
//						"id" 		=> "g_select2",
//						"std" 		=> "Select a font",
//						"type" 		=> "select_google_font",
//						"options" 	=> array(
//										"none" => "Select a font",//please, always use this key: "none"
//										"Lato" => "Lato",
//										"Loved by the King" => "Loved By the King",
//										"Tangerine" => "Tangerine",
//										"Terminal Dosis" => "Terminal Dosis"
//									)
//				);
//
//$of_options[] = array( 	"name" 		=> "Input Radio (one)",
//						"desc" 		=> "Radio select with default of 'one'.",
//						"id" 		=> "example_radio",
//						"std" 		=> "one",
//						"type" 		=> "radio",
//						"options" 	=> $of_options_radio
//				);
//
//$url =  ADMIN_DIR . 'assets/images/';
//$of_options[] = array( 	"name" 		=> "Image Select",
//						"desc" 		=> "Use radio buttons as images.",
//						"id" 		=> "images",
//						"std" 		=> "warning.css",
//						"type" 		=> "images",
//						"options" 	=> array(
//											'warning.css' 	=> $url . 'admin_fb.png',
//											'accept.css' 	=> $url . 'admin_gplus.png',
//											'wrench.css' 	=> $url . 'admin_twitter.png',
//												'wrench.css' 	=> $url . 'wrench.png',
//										)
//				);
//
//$of_options[] = array( 	"name" 		=> "Textarea",
//						"desc" 		=> "Textarea description.",
//						"id" 		=> "example_textarea",
//						"std" 		=> "Default Text",
//						"type" 		=> "textarea"
//				);
//
//$of_options[] = array( 	"name" 		=> "Multicheck",
//						"desc" 		=> "Multicheck description.",
//						"id" 		=> "example_multicheck",
//						"std" 		=> array('one','two','three'),
//						"type" 		=> "multicheck",
//						"options" 	=> $of_options_radio
//				);
//
//$of_options[] = array( 	"name" 		=> "Select a Category",
//						"desc" 		=> "A list of all the categories being used on the site.",
//						"id" 		=> "example_category",
//						"std" 		=> "Select a category:",
//						"type" 		=> "select",
//						"options" 	=> $of_categories
//				);
//
//
//
//
//
////Advanced Settings
//$of_options[] = array( 	"name" 		=> "Advanced Settings",
//						"type" 		=> "heading"
//				);
//
//$of_options[] = array( 	"name" 		=> "Folding Checkbox",
//						"desc" 		=> "This checkbox will hide/show a couple of options group. Try it out!",
//						"id" 		=> "offline",
//						"std" 		=> 0,
//						"folds" 	=> 1,
//						"type" 		=> "checkbox"
//				);
//
//$of_options[] = array( 	"name" 		=> "Hidden option 1",
//						"desc" 		=> "This is a sample hidden option 1",
//						"id" 		=> "hidden_option_1",
//						"std" 		=> "Hi, I\'m just a text input",
//						"fold" 		=> "offline", /* the checkbox hook */
//						"type" 		=> "text"
//				);
//
//$of_options[] = array( 	"name" 		=> "Hidden option 2",
//						"desc" 		=> "This is a sample hidden option 2",
//						"id" 		=> "hidden_option_2",
//						"std" 		=> "Hi, I\'m just a text input",
//						"fold" 		=> "offline", /* the checkbox hook */
//						"type" 		=> "text"
//				);
//
//$of_options[] = array( 	"name" 		=> "Hello there!",
//						"desc" 		=> "",
//						"id" 		=> "introduction_2",
//						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Grouped Options.</h3>
//						You can group a bunch of options under a single heading by removing the 'name' value from the options array except for the first option in the group.",
//						"icon" 		=> true,
//						"type" 		=> "info"
//				);
//
//				$of_options[] = array( 	"name" 		=> "Some pretty colors for you",
//										"desc" 		=> "Color 1.",
//										"id" 		=> "example_colorpicker_3",
//										"std" 		=> "#2098a8",
//										"type" 		=> "color"
//								);
//
//				$of_options[] = array( 	"name" 		=> "",
//										"desc" 		=> "Color 2.",
//										"id" 		=> "example_colorpicker_4",
//										"std" 		=> "#2098a8",
//										"type" 		=> "color"
//								);
//
//				$of_options[] = array( 	"name" 		=> "",
//										"desc" 		=> "Color 3.",
//										"id" 		=> "example_colorpicker_5",
//										"std" 		=> "#2098a8",
//										"type" 		=> "color"
//								);
//
//				$of_options[] = array( 	"name" 		=> "",
//										"desc" 		=> "Color 4.",
//										"id" 		=> "example_colorpicker_6",
//										"std" 		=> "#2098a8",
//										"type" 		=> "color"
//								);
//
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);

$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
