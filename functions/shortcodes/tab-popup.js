(function() {
	tinymce.create('tinymce.plugins.tabs', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mcetabs', function() {
				ed.windowManager.open({
					file : url + '/tab-window.php', // file that contains HTML for our modal window
					width : 220 + parseInt(ed.getLang('box.delta_width', 0)), // size of our window
					height : 180 + parseInt(ed.getLang('box.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
	// Register buttons
			ed.addButton('tabs', {
			title : 'Insert List', 
			cmd : 'mcetabs', 
			image: url + '/images/uitab.png' });
		},
		  createControl : function(ed, url){
            return null;
        },
		getInfo : function() {
			return {
				longname : 'Insert tab',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	// first parameter is the tab ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);

})();