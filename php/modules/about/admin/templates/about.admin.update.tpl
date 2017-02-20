<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>
<div>



<ul class="breadcrumb">
  <li><a href="/" title="คลังข้อมูล"><i class="icon-home"></i> คลังข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการข้อมูล</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขข้อมูล</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขข้อมูล</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">จัดการข้อมูล </a><?php if($this->about['pl']):?>, <a href="/<?php echo $this->about['lk']?$this->about['lk']:$this->about['_id']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group">
<label class="control-label" for="input01">ชื่อเรื่อง:</label>
<div class="controls">
<input type="text" id="input01" class="span10" name="title" value="<?php echo htmlspecialchars($this->about['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* ต้องใส่ให้ถูกต้อง</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input02">ลิ้งค์ของหน้า:</label>
<div class="controls">
<?php if($this->about['lk']):?>
<a href="http://about.boxza.com/<?php echo $this->about['lk']?>" target="_blank">http://about.boxza.com/<?php echo $this->about['lk']?></a>
<?php else:?>
http://about.boxza.com/<input type="text" id="input02" class="span3" name="link" value="<?php echo _::format()->link($this->about['t'])?>" required>
<p class="help-block">* ต้องใส่ให้ถูกต้อง</p>
<?php endif?>
</div>
</div>


<div class="control-group">
<label class="control-label" for="input40">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/about/<?php echo $this->about['fd']?>/s.jpg"><br>
<input type="file" id="input40" class="span3"  style="width:90%" size="20" name="o">
<p class="help-block">* บังคับเลือก (รูปภาพที่ใช้อัพโหลดควรมีขนาดอย่างน้อย 500x500 px)</p>
</div>
</div>


<div class="control-group">
<label class="control-label" for="input12">ประเภท:</label>
<div class="controls">
<?php foreach($this->cate as $k=>$v):?>
<label><input type="checkbox" name="cate[]" value="<?php echo $k?>"<?php echo in_array($k,(array)$this->about['c'])?' checked':''?>> <?php echo $v?></label> 
<?php endforeach?>
<p class="help-block">* บังคับเลือก อย่างน้อย 1 ประเภท</p>
</div>
</div>


<div class="control-group">
<label class="control-label" for="input10">รายละเอียด:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input10" name="detail" class="mceEditor" style="height:550px;"><?php echo $this->about['d']?></textarea>
</div>
</div>

<div style="padding:5px; background:#f6f6f6;">
<h3 style="height:24px; line-height:24px; background:#fff; text-align:center; margin:0px 0px 10px">ดึงข่าวและกระทู้ที่เกี่ยวข้อง จากข้อมูลเหล่านี้</h3>
<div class="control-group">
<label class="control-label">ดึงจาก บุคคล:</label>
<div class="controls">
<div class="api-search-have people">
<?php for($i=0;$i<count($this->people);$i++):?>
<div id="api-search-people_<?php echo $this->people[$i]['_id']?>"><input type="hidden" name="people[]" value="<?php echo $this->people[$i]['_id']?>"><a href="http://people.boxza.com/<?php echo $this->people[$i]['lk']?$this->people[$i]['lk']:$this->people[$i]['_id']?>" target="_blank"><?php echo $this->people[$i]['nn']?> <?php echo $this->people[$i]['fn']?> <?php echo $this->people[$i]['ln']?></a>
<a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
</div>
<?php endfor?>
</div>
<div class="input-prepend"><span class="add-on">บุคคล</span><input type="text" style="width:250px;" placeholder="  ค้นหา ชื่อ นามสกุล, ชื่อเล่น, ฉายา" class="api-search-input" data-type="people"></div>
<div class="api-search people"></div>
</div>
</div>

<div class="control-group">
<label class="control-label">ดึงจาก สถานที่:</label>
<div class="controls">
<div class="api-search-have place">
<?php for($i=0;$i<count($this->place);$i++):?>
<div id="api-search-place_<?php echo $this->place[$i]['_id']?>"><input type="hidden" name="place[]" value="<?php echo $this->place[$i]['_id']?>"><a href="http://place.boxza.com/<?php echo $this->place[$i]['lk']?$this->place[$i]['lk']:$this->place[$i]['_id']?>" target="_blank"><?php echo $this->place[$i]['n']?></a>
<a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
</div>
<?php endfor?>
</div>
<div class="input-prepend"><span class="add-on">สถานที่</span><input type="text" style="width:250px;" placeholder="  ค้นหา ชื่อสถานที่, ที่อยู่, ตำแหน่ง" class="api-search-input" data-type="place"></div>
<div class="api-search place"></div>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="inputtags">ดึงจาก ป้ายกำกับ:</label>
<div class="controls">
<ul class="api-search-have tag">
<?php for($i=0;$i<count($this->about['tags']);$i++):$v=$this->about['tags'][$i]?>
<li class="tag-box"><input type="hidden" name="tags[]" value="<?php echo $v?>">
<?php echo $v?>
<a href="javascript:;" onclick="$(this).parent().remove()">x</a>
</li>
<?php endfor?>
<li class="api-search-tag"><input type="text" class="api-search-input tag" data-type="tag" autocomplete="off" style="width: 30px;"></li>
<p class="clear"></p>
</ul>
<div class="api-search tag"></div>
<p class="help-block">ปล่อยว่างได้ - (ใช้ Enter หรือ , เพื่อเพิ่มคำใหม่)</p>
</div>
</div>
</div>

<div class="control-group">
<label class="control-label">แสดงผลหน้าแรก (HOT):</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="promote" value="1"<?php echo $this->about['pr']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="promote" value="0"<?php echo !$this->about['pr']?' checked':''?>> ไม่แสดง</label>
</select>
<p class="help-block">เฉพาะบุคคลที่กำลังตกเป็นข่าวดังเท่านั้น จะนำไปแสดงที่หน้าแรก about เพียง 1 บุคคล</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->about['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->about['pl']?' checked':''?>> ไม่แสดง</label>
</select>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/admin">ยกเลิก</a>
</div>
</fieldset>
</form>
</div>


<script language="javascript" type="text/javascript" src="/_static/js/tiny_mce/tiny_mce.js"></script>
<script>

var tmr,curlang;
_.mce={upload:'/admin/upload/<?php echo $this->about['_id']?>'};




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
	//selectlang('th');
	//$('.cate').change(selectcate);
	//selectcate();
	/*
	
	tinyMCE.execCommand('mceResetDesignMode');
	tinyMCE.triggerSave(true);
	*/
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