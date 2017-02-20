<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>
<div>



<ul class="breadcrumb">
  <li><a href="/" title="ดารา ประวัติดารา"><i class="icon-home"></i> ดารา</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ข้อมูลดารา</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขดารา</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขดารา</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ข้อมูลดารา </a><?php if($this->people['pl']):?>, <a href="/<?php echo $this->people['lk']?$this->people['lk']:$this->people['_id']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group">
<label class="control-label" for="input01">ชื่อจริง:</label>
<div class="controls">
<input type="text" id="input01" class="span10" name="first" value="<?php echo htmlspecialchars($this->people['fn'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* ต้องใส่ให้ถูกต้อง</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input02">นามสกุล:</label>
<div class="controls">
<input type="text" id="input02" class="span10" name="last" value="<?php echo htmlspecialchars($this->people['ln'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* ต้องใส่ให้ถูกต้อง</p>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input03">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/people/<?php echo $this->people['fd']?>/s.jpg?<?php echo rand(1,9999)?>"><br>
<input type="file" id="input03" class="span3" size="20" name="o">
<p class="help-block">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input04">ชื่อเล่น:</label>
<div class="controls">
<input type="text" id="input04" class="span10" name="nick" value="<?php echo htmlspecialchars($this->people['nn'],ENT_QUOTES,'utf-8')?>">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input05">ชื่อในวงการ:</label>
<div class="controls">
<input type="text" id="input05" class="span10" name="name" value="<?php echo htmlspecialchars($this->people['n'],ENT_QUOTES,'utf-8')?>">
<p class="help-block">เป็นชื่อที่ใช้แทนชื่อจริงเท่านั้น ไม่ใช่ชื่อที่เอาชื่อเล่นมาผสมกับชื่อจริง, และเป็นชื่อที่ทุกคนรู้จักเป็นอย่างดี ไม่ใช่ฉายาที่ตั้งขึ้นมาเพื่อล้อเลียน เช่น หม่ำ จ๊กมก (เพชรทาย วงษ์คำเหลา)</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input06">วันเดือนปีเกิด:</label>
<div class="controls">
<select name="day" style="width:50px">
<option value="0">เลือกวัน</option>
<?php for($i=1;$i<=31;$i++):?>
<option value="<?php echo $i?>"<?php echo $this->people['bd'][0]==$i?' selected':''?>><?php echo $i?></option>
<?php endfor?>
</select> - 
<select name="month" style="width:120px">
<option value="0">เลือกเดือน</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo $i?>"<?php echo $this->people['bd'][1]==$i?' selected':''?>><?php echo time::$month[$i-1]?></option>
<?php endfor?>
</select> - 
<select name="year" style="width:70px">
<option value="0">เลือกปี</option>
<?php for($i=date('Y')-10;$i>=date('Y')-100;$i--):?>
<option value="<?php echo $i?>"<?php echo $this->people['bd'][2]==$i?' selected':''?>><?php echo $i+543?></option>
<?php endfor?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input07">เพศ:</label>
<div class="controls">
<select name="gender">
<option value="0">เลือกเพศ</option>
<?php foreach(array(1=>'ชาย',2=>'หญิง') as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->people['gd']==$k?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
<p class="help-block">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input08">ส่วนสูง:</label>
<div class="controls">
<input type="number" id="input08" style="width:100px;" name="height" value="<?php echo $this->people['h']?>"> ซม.
</div>
</div>

<div class="control-group">
<label class="control-label" for="input09">น้ำหนัก:</label>
<div class="controls">
<input type="number" id="input09" style="width:100px;" name="weight" value="<?php echo $this->people['w']?>"> กก.
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">ประวัติ:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input10" name="edu" class="mceEditor" style="height:250px;"><?php echo $this->people['edu']?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input11">ผลงาน:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input11" name="result" class="mceEditor" style="height:250px;"><?php echo $this->people['rs']?></textarea>
</div>
</div>


<div class="control-group">
<label class="control-label">ที่อยู่/ประเทศ:</label>
<div class="controls">
<?php foreach(array('th'=>'ไทย','kr'=>'เกาหลี','jp'=>'ญี่ปุ่น','cn'=>'จีน','nc'=>'ประเทศอื่นๆ') as $k=>$v):?>
<label><input type="checkbox" name="country[]" value="<?php echo $k?>"<?php echo in_array($k,(array)$this->people['ct'])?' checked':''?>> <?php echo $v?></label> 
<?php endforeach?>
<p class="help-block">* บังคับเลือก อย่างน้อย 1 ประเภท</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input12">ประเภท:</label>
<div class="controls">
<?php foreach($this->cate as $k=>$v):?>
<label><input type="checkbox" name="position[]" value="<?php echo $k?>"<?php echo in_array($k,(array)$this->people['ps'])?' checked':''?>> <?php echo $v?></label> 
<?php endforeach?>
<p class="help-block">* บังคับเลือก อย่างน้อย 1 ประเภท</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input13">Facebook:</label>
<div class="controls">
https://www.facebook.com/<input type="text" id="input13" style="width:100px;" name="facebook" value="<?php echo $this->people['fb']?>" placeholder=" username ">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input14">Twitter:</label>
<div class="controls">
https://twitter.com/<input type="text" id="input14" style="width:100px;" name="twitter" value="<?php echo $this->people['tw']?>" placeholder=" username ">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input15">instagram:</label>
<div class="controls">
http://instagram.com/<input type="text" id="input15" style="width:100px;" name="instagram" value="<?php echo $this->people['in']?>" placeholder=" username ">
</div>
</div>

<div class="control-group">
<label class="control-label">แสดงผลหน้าแรกบุคคล (HOT):</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="promote" value="1"<?php echo $this->people['pr']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="promote" value="0"<?php echo !$this->people['pr']?' checked':''?>> ไม่แสดง</label>
</select>
<p class="help-block">เฉพาะบุคคลที่กำลังตกเป็นข่าวดังเท่านั้น จะนำไปแสดงที่หน้าแรก people เพียง 1 บุคคล</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->people['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->people['pl']?' checked':''?>> ไม่แสดง</label>
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
_.mce={upload:'/admin/upload/<?php echo $this->people['_id']?>'};




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