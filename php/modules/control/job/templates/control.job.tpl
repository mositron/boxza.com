<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>
<script language="javascript" type="text/javascript" src="/_static/js/tiny_mce/tiny_mce.js"></script>
<script>

var tmr,curlang;
function selectlang(i)
{
	tinyMCE.execCommand('mceResetDesignMode');
	tinyMCE.triggerSave(true);
}

$(function() {
	tinyMCE.init({
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		dialog_type : "modal",
		extended_valid_elements : "a[href|title|target=_blank|rel=nofollow]",
		//valid_elements : "a[href|title|target=_blank|rel=nofollow],strong/b,div[align|style],p[align|style],br,ol,ul,li,blockquote,span[style],em,img[src|alt|title],table[width|align|border],thead,tbody,tr,th[width|align],td[width|align|colspan|rowspan],iframe[width|height|style|src|frameborder=0]",
		width : "100%",
		theme : "advanced",
		skin : "forum",
		theme_advanced_buttons1 : "code,|,bold,italic,strikethrough,underline,forecolor,backcolor,fontsizeselect,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,link,image,media,upload,|,tableDropdown",
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
	selectlang('th');
	//$('.cate').change(selectcate);
	//selectcate();
});

function selectcate(e)
{
	var c=$('.cate').val();
	$('.cate_sub').css('display','none');
	if($('.cate_sub'+c).length)
	{
		$('.cate_sub'+c).css('display','block');
	}
}

function delfile(i)
{
	if(confirm('คุณต้องการลบไฟล์แนบนี้หรือไม่'))ajax_delfile(i);
}

function delrelated(i)
{
	if(confirm('คุณต้องการลบข้อมูลที่เกี่ยวข้องนี้หรือไม่'))ajax_delrelated(i);
}
</script>

<div>



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/job"><i class="icon-briefcase"></i> รับสมัครงาน</a></li>
</ul>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal" onSubmit="tinyMCE.triggerSave(true);_.ajax.gourl('/job','setjob',this);return false;">
 <fieldset>
 <div>
<textarea style="height:700px; width:100%;" class="mceEditor" name="detail" minlength="20"><?php echo $this->msg['msg']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/">ยกเลิก</a>
</div>
</fieldset>
</form>
            
            

</div>