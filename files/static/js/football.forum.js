

$.extend(_,{
	forum:
	{
		init:function()
		{
			if(typeof(tinyMCE)!='undefined')
			{
				tinyMCE.init({
					mode : "specific_textareas",
					editor_selector : "mceEditor",
					dialog_type : "modal",
					extended_valid_elements : "a[href|title|target=_blank|rel=nofollow]",
					invalid_elements : "script,style,input,select,option,button,textarea,form",
					//valid_elements : "a[href|title|target=_blank|rel=nofollow],strong/b,div[align|style],p[align|style],br,ol,ul,li,blockquote,span[style],em,img[src|alt|title],table[width|align|border],thead,tbody,tr,th[width|align],td[width|align|colspan|rowspan],iframe[width|height|style|src|frameborder=0]",
					width : "100%",
					theme : "advanced",
					skin : "forum",
					theme_advanced_buttons1 : "code,|,bold,italic,strikethrough,underline,forecolor,backcolor,fontsizeselect,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,link,image,media,|,tableDropdown",
					theme_advanced_buttons2 : "",
					theme_advanced_buttons3 : "",
					theme_advanced_buttons4 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_path_location : "bottom",
					theme_advanced_resizing : true,
					language : "en",
					paste_create_paragraphs : true,
					paste_create_linebreaks : true,
					paste_use_dialog : true,
					paste_force_cleanup_wordpaste : true,
					paste_auto_cleanup_on_paste : true,
					paste_convert_middot_lists : false,
					paste_remove_styles : true,
					paste_strip_class_attributes : "all",
					paste_convert_headers_to_strong : true,
					browsers : "msie,gecko,opera,safari",
					dialog_type : "modal",
					theme_advanced_resize_horizontal : false,
					convert_urls : true,
					relative_urls : false,
					remove_script_host : false,
					plugins : "safari,inlinepopups,spellchecker,paste,layer,table,tableDropdown,save,media,searchreplace,print,contextmenu,paste,directionality,noneditable,nonbreaking,xhtmlxtras,template"
				});			
				tinyMCE.execCommand('mceResetDesignMode');
				tinyMCE.triggerSave(true);
			}
		},
		emo:function(a) 
		{
			tinyMCE.execCommand('mceInsertContent', false, '<img src="'+$('img',a).attr('src')+'" alt="อีโมติคอน">');
		}
	}
});

$(function(){_.forum.init();});