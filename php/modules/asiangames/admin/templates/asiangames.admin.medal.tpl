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
_.mce={upload:''};




$(function() {
tinyMCE.init({
			mode : "specific_textareas",
			editor_selector : "mceEditor",
			width : "100%",
			theme : "advanced",
			skin : "o2k7",
			skin_variant : "silver",
			theme_advanced_buttons1 : "code,formatselect,fontsize,fontselect,fontsizeselect,pastetext,pasteword,|,tablecontrols",
			theme_advanced_buttons2 : "bold,italic,strikethrough,|,underline,justifyfull,forecolor,backcolor,|,sub,sup,|,bullist,numlist,outdent,indent,|,justifyleft,justifycenter,justifyright,link,unlink,image,media,|,removeformat,|,charmap,emotions,fullscreen",
			theme_advanced_buttons3 : "",
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
			//paste_unindented_list_class : "unindentedList",
			paste_convert_headers_to_strong : true,
			browsers : "msie,gecko,opera,safari",
			dialog_type : "modal",
			theme_advanced_resize_horizontal : false,
			convert_urls : true,
			relative_urls : false,
			remove_script_host : false,
			plugins : "upload,safari,inlinepopups,autosave,spellchecker,paste,layer,table,save,advhr,advimage,advlink,emotions,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template"
		});
selectlang('th');

});

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



<ul class="breadcrumb">
  <li><a href="/" title="ผลบอล บ้านผลผบอล 7m"><i class="icon-home"></i> เอเชียนเกมส์</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/medal">สรุปเหรียญเอเชียนเกมส์</a></li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center; color:#000">สรุปเหรียญเอเชียนเกมส์</h2>
<div style="margin:5px">
 <form method="post" action="<?php echo URL?>" onSubmit="tinyMCE.triggerSave(true,true);_.ajax.gourl('<?php echo URL?>','saveprogram',this.detail.value);return false;" id="sensubmit" class="form-horizontal">
 <fieldset>

 <div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
<textarea style="height:600px; width:700px;" class="mceEditor" name="detail" minlength="20"><?php echo $this->medal?></textarea>
</div>



<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn btn-default" href="/admin">ยกเลิก</a>
</div>
</fieldset>
</form>
            </div>
            

</div>