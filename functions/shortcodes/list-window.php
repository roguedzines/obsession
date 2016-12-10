<?php

//  Here was the main bug which prevented the isharis's plugin from working in some server configurations
// (tinyMCE form just redirected to the site homepage).
//  A good practice is to locate the  WP loader and use the includes_url() function before loading needed resources.

// Ensure single declaration of function!
// Credits: http://wordpress.stackexchange.com/questions/32388/solutions-for-generating-dynamic-javascript-css
if(!function_exists('wp_locate_loader')):
    /**
     * Locates wp-load.php looking backwards on the directory structure.
     * It listt from this file's folder.
     * Returns NULL on failure or wp-load.php path if found.
     *
     * @author EarnestoDev
     * @return string|null
     */
    function wp_locate_loader(){
        $increments = preg_split('~[\\\\/]+~', dirname(__FILE__));
        $increments_paths = array();
        foreach($increments as $increments_offset => $increments_slice){
            $increments_chunk = array_slice($increments, 0, $increments_offset + 1);
            $increments_paths[] = implode(DIRECTORY_SEPARATOR, $increments_chunk);
        }
        $increments_paths = array_reverse($increments_paths);
        foreach($increments_paths as $increments_path){
            if(is_file($wp_load = $increments_path.DIRECTORY_SEPARATOR.'wp-load.php')){
                return $wp_load;
            }
        }
        return null;
    }
endif;

// Now try to load wp-load.php and pull it in
if(!is_file($wp_loader = wp_locate_loader())){
    header("{$_SERVER['SERVER_PROTOCOL']} 403 Forbidden");
    header("Status: 403 Forbidden");
    echo 'Access denied!'; // Or whatever
    die;
}

require_once($wp_loader); // Pull it in
unset($wp_loader); // Cleanup variables

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Insert List</title>
	<style type='text/css' src='<?php echo includes_url('js/tinymce/themes/advanced/skins/wp_theme/dialog.css'); ?>'></style>
	<style type='text/css'>
body { background: #f1f1f1; }

#button-dialog { }

#button-dialog div { padding: 10px 0; }

#button-dialog label {
	display: block;
	margin: 0 8px 8px 0;
	color: #333;
}

#button-dialog input select, #button-dialog input[type=text] {
	display: block;
	padding: 3px 5px;
	width: 90%;
	font-size: 1em;
}

#button-dialog textarea {
	display: block;
	padding: 3px 5px;
	width: 90%;
	font-size: 1em;
}

#button-dialog input[type=radio] { float: left; }

#button-dialog input[type=submit] {
	padding: 5px;
	font-size: 1em;
}

#button-dialog input:disabled { background-color: #f1f1f1; }
</style>
	<script type='text/javascript' src='<?php echo includes_url('js/jquery/jquery.js'); ?>'></script>
	<script type='text/javascript' src='<?php echo includes_url('js/tinymce/tiny_mce_popup.js'); ?>'></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#button-form').submit(function(e) {
            ListDialog.insert(ListDialog.local_ed);
		    e.preventDefault();
		});

        jQuery('input[name=type]').change(function() {
            var type = jQuery('input[name=type]:checked').val();
            if (type == 'classic') {
                jQuery('input#title').attr("disabled", true);
            } else {
                jQuery('input#title').removeAttr("disabled");
                jQuery('input#title').val(type[0].toUpperCase() + type.slice(1));
            }
        });

	var ListDialog = {
			local_ed : 'ed',
			init : function(ed) {
				ListDialog.local_ed = ed;
 				tinyMCEPopup.resizeToInnerSize();
			},
			insert : function insertButton(ed) {
                // Try and remove existing style / blockquote
				tinyMCEPopup.execCommand('mceRemoveNode', false, null);

				// set up variables to contain our input values

		//var text = jQuery('input#list-text').val();
				var style = jQuery('input[name=style]:checked').val();
     var text = jQuery('input#list-text').val();

				var output = '';

				// setup the output of our shortcode
		output = '[list ';
				output += 'style="' + style + '"]';
 if (text)
		output += '' + text +'';

					output += ''+ListDialog.local_ed.selection.getContent() + '[/list]';

				tinyMCEPopup.execCommand('mceReplaceContent', false, output);

				// Return
				tinyMCEPopup.close();

				return false
			}
		};
		tinyMCEPopup.onInit.add(ListDialog.init, ListDialog);
	});
	</script>
	</head>
	<body>
	<div id="button-dialog">
	<form action="<?php echo home_url('/'); ?>" method="get" accept-charset="utf-8" id="button-form">
					<div>
							<label for="list-text">Add Text</label>
							<input id="list-text" name="list-text" type="text" value="" />
					</div>
					<div>
			<div class="radiolabel">List Style</div>

							<input type="radio"  name="01" value="01" />
							<label for="01"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/01.png';?>" /></label>



							<input type="radio"  name="style" value="02" />
							<label for="02"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/02.png';?>" /></label>

							<input type="radio"  name="style" value="03" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/03.png';?>" /></label>

							<input type="radio"  name="style" value="04" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/04.png';?>" /></label>


							<input type="radio"  name=style value="05" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/05.png';?>" /></label>


							<input type="radio"  name=style value="07" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/07.png';?>" /></label>




							<input type="radio"  name=style value="08" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/08.png';?>" /></label>




							<input type="radio"  name=style value="09" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/09.png';?>" /></label>
							<input type="radio"  name=style value="10" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/10.png';?>" /></label>
							<input type="radio"  name=style value="11" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/11.png';?>" /></label>
							<input type="radio"  name=style value="12" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/12.png';?>" /></label>
							<input type="radio"  name=style value="13" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/13.png';?>" /></label>
							<input type="radio"  name=style value="14" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/14.png';?>" /></label>
							<input type="radio"  name=style value="15" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/15.png';?>" /></label>
							<input type="radio"  name=style value="16a" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/16a.png';?>" /></label>
							<input type="radio"  name=style value="17" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/17.png';?>" /></label>
							<input type="radio"  name=style value="18" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/18.png';?>" /></label>
							<input type="radio"  name=style value="19" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/19.png';?>" /></label>
							<input type="radio"  name=style value="20" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/20.png';?>" /></label>
							<input type="radio"  name=style value="21" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/21.png';?>" /></label>
							<input type="radio"  name=style value="22" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/22.png';?>" /></label>
							<input type="radio"  name=style value="23" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/23.png';?>" /></label>
							<input type="radio"  name=style value="24" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/24.png';?>" /></label>
							<input type="radio"  name=style value="25" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/25.png';?>" /></label>
							<input type="radio"  name=style value="26" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/26.png';?>" /></label>
							<input type="radio"  name=style value="27" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/27.png';?>" /></label>
							<input type="radio"  name=style value="28" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/28.png';?>" /></label>
							<input type="radio"  name=style value="29" />
							<label for="style"><img src="<?php echo get_template_directory_uri().'/functions/shortcodes/images/list/29.png';?>" /></label>
					</div>
					<!--	<div>
                <label for="style">Column Size</label>
                <select name="style"  size="1">
                <option value="pink" selected="selected">Pink</option>
              <option value="orange">Orange</option>
                <option value="white">White</option>
																<option value="greem">Green</option>
																<option value="blue">Blue</option>
																<option value="black">Black</option>
																	<option value="gray">Gray</option>
               </select>
			</div>
-->

					<div>
							<input type='submit' value='Add a Button' />
					</div>
			</form>
	</div>
</body>
</html>
