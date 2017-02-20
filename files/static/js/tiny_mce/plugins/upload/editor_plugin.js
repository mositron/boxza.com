(function() {
	// Load plugin specific language pack
	tinymce.create('tinymce.plugins.upload', {
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mceExample', function() {
				ed.windowManager.open({
					//file : url + '/upload.php?service_id='+SERVICE_ID,
					file : _.mce.upload,
					width : 650 + ed.getLang('upload.delta_width', 0),
					height : 420 + ed.getLang('upload.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
					some_custom_arg : 'custom arg' // Custom argument
				});
			});

			// Register example button
			ed.addButton('upload', {
				title : 'upload.desc',
				cmd : 'mceExample',
				image : url + '/img/upload.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('upload', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : 'Upload Manager',
				author : 'Positron',
				authorurl : 'http://boxza.com',
				infourl : 'http://boxza.com',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('upload', tinymce.plugins.upload);
})();