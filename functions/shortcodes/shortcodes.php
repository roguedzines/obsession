<?php
/******************************************
/* Shortcodes
******************************************/
/**** Clean UP SHORTCODES ****///Clean Up WordPress Shortcode Formatting - important for nested shortcodes
//adjusted from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

//move wpautop filter to AFTER shortcode is processed
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );




// registers the buttons for use
function saxonTheme_register_buttons($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
array_push($buttons,"theme_button","columns","list");
	return $buttons;
}


// filters the tinyMCE buttons and adds our custom buttons
function saxonTheme_shortcode_buttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter('mce_external_plugins', 'saxonTheme_add_tinymce_plugin');
		add_filter('mce_buttons', 'saxonTheme_register_buttons');
	}
}
add_action('init', 'saxonTheme_shortcode_buttons');
// add the button to the tinyMCE bar
function saxonTheme_add_tinymce_plugin($plugin_array) {
	$plugin_array['theme_button'] = get_template_directory_uri() . '/functions/shortcodes/button-popup.js';
	$plugin_array['columns'] = get_template_directory_uri() . '/functions/shortcodes/column-popup.js';
	$plugin_array['list'] = get_template_directory_uri() . '/functions/shortcodes/list-popup.js';

	return $plugin_array;
}

// init process for button control



/* ------- Buttons --------*/
function saxonTheme_button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'default',
	  'url' => '',
	  'text' => ''
      ), $atts ) );
	  if($url) {
		return '<div class="shtcd-btn-holder"><span class="shtcd-btn-button ' . $color . '"><a href="' . $url . '">' . $content . '</a></span></div>';
	  } else {
		return '<div class="shtcd-btn-holder"><span class="shtcd-btn-button ' . $color . '">' . $content . '</span></div>';
	}
}
add_shortcode('theme_button', 'saxonTheme_button_shortcode');



/**
	 * Shortcode: column
	 *
	 */
	function saxonTheme_column_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'size' => '',

				), $atts ) );

		return '<div class="columns column-'.$size.'">'.do_shortcode( $content ) .'</div>';
	}
	add_shortcode('columns', 'saxonTheme_column_shortcode');

	/**
	 * Shortcode: list
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function saxonThemelist_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'style' => '',
				), $atts ) );

		return '<div class="list-style-'.$style.'">' .$content. '</div>';
	}
		add_shortcode('list', 'saxonThemelist_shortcode');


add_filter('the_content','do_shortcode');
add_filter('widget_text','do_shortcode');
?>
