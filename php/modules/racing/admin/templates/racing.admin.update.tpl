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
_.mce={upload:'/admin/upload/<?php echo $this->news['_id']?>'};




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
		plugins : "upload,safari,inlinepopups,spellchecker,paste,layer,table,tableDropdown,save,media,searchreplace,print,contextmenu,paste,directionality,noneditable,nonbreaking,xhtmlxtras,template"
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



<ul class="breadcrumb">
  <li><a href="/" title="รถแต่ง"><i class="icon-home"></i> รถแต่ง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/c-<?php echo $this->news['c']?>"><?php echo $this->cate[$this->news['c']]['t']?></a></li>
 <li><span class="divider">&raquo;</span> แก้ไขข่าว</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขข่าว</h2>

<?php if($this->error):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ผิดพลาด!</h4>
 <?php echo implode('<br>',$this->error);?>
</div>
<?php endif?>

<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->news['pl']):?>, <a href="/view/<?php echo $this->news['_id']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
<?php if($this->news['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 ข่าวนี้ทำการเผยแพร่แล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->news['pl']):?>, <a href="/view/<?php echo $this->news['_id']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเรื่อง:</label>
<div class="controls">
<input type="text" id="input01" class="span5" name="title" value="<?php echo htmlspecialchars($this->news['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/news/<?php echo $this->news['fd']?>/s.jpg"><br>
<input type="file" id="input10" class="span3" size="20" name="o">
<p class="help-block">* บังคับเลือก (รูปภาพที่ใช้อัพโหลดควรมีขนาดอย่างน้อย 470x296 px)</p>
</div>
</div>

<div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทข่าว:</label>
<div class="controls category">
<select name="cate" class="cate" required>
<?php foreach($this->cate as $k=>$v):?>

<?php if($v['s']):?>
<optgroup label="<?php echo $v['t']?>"></optgroup>
<?php foreach($v['s'] as $k2=>$v2):?>
<?php if($v2['s']):?>
<optgroup label=" &nbsp; &nbsp; <?php echo $v2['t']?>"></optgroup>
<?php foreach($v2['s'] as $k3=>$v3):?>
<option value="<?php echo $k.'-'.$k2.'-'.$k3?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']&&$k3==$this->news['cs2']?' selected':''?>> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'-'.$k2?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']?' selected':''?>> &nbsp; &nbsp; <?php echo $v2['t']?></option>
<?php endif?>
<?php endforeach?>

<?php else:?>

<option value="<?php echo $k?>"<?php echo $k==$this->news['c']?' selected':''?>><?php echo $v['t']?></option>
<?php endif?>
<?php endforeach?>
</select>

<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div>
<div align="center"<?php if($this->error['title']):?> class="error"<?php endif?>>รายละเอียด</div>
<textarea style="height:700px; width:680px;" class="mceEditor" name="detail" minlength="20"><?php echo $this->news['d']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>


 <div class="control-group">
<label class="control-label" for="inputtags">ป้ายกำกับ / Tags:</label>
<div class="controls">
<input type="text" id="inputtags" class="span5" name="tags" value="<?php echo is_array($this->news['tags'])?implode(', ',$this->news['tags']):''?>">
<p class="help-block">ปล่อยว่างได้ - (ใช้ , คั่นระหว่างป้ายกำกับแต่ละตัว เพื่อระบุถึงเนื้อหาที่เกี่ยวข้อง, ไม่สามารถใช้อักขระพิเศษได้)</p>
</div>
</div>

<?php if(_::$my['am']):?>
 <div class="control-group">
<label class="control-label" for="input20">ตั้งเป็นข่าวเด่น:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="recommend" value="1"<?php echo $this->news['rc']?' checked':''?>> เป็นข่าวเด่น</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="0"<?php echo !$this->news['rc']?' checked':''?>> เป็นข่าวทั่วไป</label>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input21">ตั้งเป็นเขี่ยประเด็นข่าว:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="hot" value="1"<?php echo $this->news['ho']?' checked':''?>> ตั้งเป็นเขี่ยประเด็นข่าว</label>
<label class="checkbox inline"><input type="radio" name="hot" value="0"<?php echo !$this->news['ho']?' checked':''?>> ตั้งเป็นข่าวธรรมดา</label>
</select>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->news['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->news['pl']?' checked':''?>> ไม่แสดง</label>
</select>
</div>
</div>

<?php else:?>
 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="waiting" value="1"<?php echo $this->news['wt']?' checked':''?>> ส่งเรื่องให้เจ้าหน้าที่ตรวจสอบ</label>
<label class="checkbox inline"><input type="radio" name="waiting" value="0"<?php echo !$this->news['wt']?' checked':''?>> ยังไม่ส่ง</label>
</select>
</div>
</div>
<?php endif?>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/admin">ยกเลิก</a>
</div>
</fieldset>
</form>
            
            

</div>