<div class="span8">
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
_.mce={upload:'/admin/upload/<?php echo $this->drama['_id']?>'};




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
	setctlink();
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
  <li><a href="/" title="ละคร ละครวันนี้"><i class="icon-home"></i> ละคร</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/c-<?php echo $this->drama['c']?>"><?php echo $this->cate[$this->drama['c']]['t']?></a></li>
 <li><span class="divider">&raquo;</span> แก้ไขละคร</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขละคร</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->drama['pl']):?>, <a href="/<?php echo $this->drama['lk']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
<?php if($this->drama['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 ละครนี้ทำการเผยแพร่แล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->drama['pl']):?>, <a href="/<?php echo $this->drama['lk']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อละคร:</label>
<div class="controls">
<input type="text" id="input01" class="span5" style="width:90%" name="title" value="<?php echo htmlspecialchars($this->drama['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/drama/<?php echo $this->drama['fd']?>/s.jpg"><br>
<input type="file" id="input10" class="span3"  style="width:90%" size="20" name="o">
<p class="help-block">* บังคับเลือก (รูปภาพที่ใช้อัพโหลดควรมีขนาดอย่างน้อย 500x400 px)</p>
</div>
</div>

<div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทละคร:</label>
<div class="controls category">
<select name="cate" class="cate" required>
<?php foreach($this->cate as $k=>$v):?>
<?php if($v['s']):?>
<optgroup label="<?php echo $v['t']?>"></optgroup>
<?php foreach($v['s'] as $k2=>$v2):?>
<?php if($v2['s']):?>
<optgroup label=" &nbsp; &nbsp; <?php echo $v2['t']?>"></optgroup>
<?php foreach($v2['s'] as $k3=>$v3):?>
<option value="<?php echo $k.'_'.$k2.'_'.$k3?>"<?php echo $k==$this->drama['c']&&$k2==$this->drama['cs']&&$k3==$this->drama['cs2']?' selected':''?>> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'_'.$k2?>"<?php echo $k==$this->drama['c']&&$k2==$this->drama['cs']?' selected':''?>> &nbsp; &nbsp; <?php echo $v2['t']?></option>
<?php endif?>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k?>"<?php echo $k==$this->drama['c']?' selected':''?>><?php echo $v['t']?></option>
<?php endif?>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input11">เกริ่นนำ:</label>
<div class="controls">
<textarea id="input11" class="span5" style="width:90%; height:80px" name="summary" required><?php echo htmlspecialchars($this->drama['sm'],ENT_QUOTES,'utf-8')?></textarea>
<p class="help-block">* บังคับกรอก - ใช้แสดงในบางบริการของ  boxza.com (ความยาวไม่เกิน 500 ตัวอักษร)</p>
</div>
</div>

<div class="control-box-ct">
<div align="center">เนื้อหาในละคร</div>
<textarea style="height:700px; width:680px;" class="mceEditor" name="detail" minlength="20"><?php echo $this->drama['d']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>


 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->drama['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->drama['pl']?' checked':''?>> ไม่แสดง</label>
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

</div>
<style>
.nav-howto{padding:5px 10px; margin:5px 0px 0px 5px}
.nav-howto h5{text-align:center; background:#f0f0f0; text-shadow:1px 1px 0px #fff; margin:0px 0px 5px; height:22px; line-height:22px;}
.nav-howto ul{margin-left:5px; list-style:inside circle;}
</style>
<div class="span4">
<h4 style="margin:5px 0px 0px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">วิธีการเขียนบทความ</h4>
<div class="nav-howto">

<h5>การตั้งหัวข้อ</h5>
<ul>
<li>ชัดเจน เข้าใจง่าย: ใคร ทำอะไร ที่ไหน ยังไง</li>
<li>Keyword ควรจะเป็นคำแรกของหัวข้อ</li>
<li>ห้ามใช้คำอุทาน เช่น แม่เจ้า.. , โอ้โห..</li>
<li>ตรงประเด็น ไม่ผ่านบุคคลที่3 (ชาวเน็ตแห่ชม...)</li>
<li>ห้าม Copy จากที่อื่น ต้อง rewrite ใหม่</li>
</ul>

<h5>การเขียนเนื้อหา</h5>
<ul>
<li>ใช้คำหรือประโยคที่สากล ห้ามตั้งศัพท์เอง.</li>
<li>ใช้ชื่อเต็ม: ชื่อเล่น ชื่อจริง นามสกุล (ฉายา-ถ้ามี)</li>
<li>เนื้อหาครบถ้วน ใครทำอะไร กับใคร ที่ไหน ยังไง</li>
<li>ห้ามใช้ สรรพนาม แต่ให้ใช้ชื่อเต็มเท่านั้น</li>
<li>แทรกbacklinkไปยังหน้าอื่นๆที่เกี่ยวข้องในเว็บนี้</li>
<li>แทรกลิ้งค์ละครหรือเนื้อหาที่ใกล้เคียงกัน</li>
<li>ห้าม Copy จากที่อื่น ต้อง rewrite ใหม่ทั้งหมด</li>
</ul>

</div>
</div>