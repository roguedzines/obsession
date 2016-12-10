(function() {
	tinymce.create('tinymce.plugins.list', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mcelist', function() {
				ed.windowManager.open({
					file : url + '/list-window.php', // file that contains HTML for our modal window
					width : 220 + parseInt(ed.getLang('box.delta_width', 0)), // size of our window
					height : 180 + parseInt(ed.getLang('box.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register buttons
			ed.addButton('list', {
			title : 'Insert List', 
			cmd : 'mcelist', 
			image: url + '/images/list.png' });
		},
		  createControl : function(ed, url){
            return null;
        },
		getInfo : function() {
			return {
				longname : 'Insert List',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('list', tinymce.plugins.list);

})();