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

function setctlink()
{
	if($('input[name="exlink"]:checked').val()=='1')
	{
		$('.control-box-link').css('display','block');
		$('.control-box-ct').css('display','none');
	}
	else
	{
		$('.control-box-link').css('display','none');
		$('.control-box-ct').css('display','block');
	}
}

function selectlang(i)
{
//	tinyMCE.execCommand('mceResetDesignMode');
//	tinyMCE.triggerSave(true);
}
_.mce={upload:'/admin/upload/<?php echo $this->news['_id']?>'};




$(function() {
	tinyMCE.init({
		mode : "textareas",
		//mode : "specific_textareas",
		//editor_selector : "mceEditor",
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
		theme_advanced_resize_horizontal : false,
		convert_urls : true,
		relative_urls : false,
		remove_script_host : false,
		plugins : "upload,safari,inlinepopups,spellchecker,paste,layer,table,tableDropdown,save,media,searchreplace,print,contextmenu,paste,directionality,noneditable,nonbreaking,xhtmlxtras,template"
	});
	//selectlang('th');
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
  <li><a href="/" title="ข่าว ข่าววันนี้"><i class="icon-home"></i> ข่าว</a></li>
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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->news['pl']):?>, <a href="<?php echo link::news($this->news)?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php elseif($_SERVER['QUERY_STRING']=='no-image'):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
 ไม่สามารถเผยแพร่ข่าวนี้ได้ เนื่องจากยังไม่มีรูปภาพของข่าว
</div>
<?php endif?>


<?php if($this->news['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 ข่าวนี้ทำการเผยแพร่แล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a><?php if($this->news['pl']):?>, <a href="<?php echo link::news($this->news)?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเรื่อง:</label>
<div class="controls">
<input type="text" id="input01" class="span12" name="title" value="<?php echo htmlspecialchars($this->news['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/news/<?php echo $this->news['fd']?>/s.jpg"><br>
<input type="file" id="input10" class="span3"  style="width:90%" size="20" name="o">
<p class="help-block">* บังคับเลือก (รูปภาพที่ใช้อัพโหลดควรมีขนาดอย่างน้อย 500x400 px)<br>
<span style="color:#c00; font-weight:bold">ห้ามใช้ภาพ ที่มีความรุนแรง , มีเลือด / อนาจาร, โป้เปลือย, วาบหวิว</span>
</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รูปโพส Facebook:</label>
<div class="controls">
<?php if($this->news['fbi']):?>
<img src="http://s3.boxza.com/news/<?php echo $this->news['fd']?>/<?php echo $this->news['fbi']?>" style="max-width:100px !important; max-height:100px !important;"><br>
<?php endif?>
<input type="file" id="input10" class="span12"  style="width:90%" size="20" name="o2">
<p class="help-block">ปล่อยว่างได้ - หากปล่อยว่าง ระบบจะใช้รูปภาพปรกติโพสไปยัง facebook แทน<br>
</p>
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
<option value="<?php echo $k.'_'.$k2.'_'.$k3?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']&&$k3==$this->news['cs2']?' selected':''?>> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'_'.$k2?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']?' selected':''?>> &nbsp; &nbsp; <?php echo $v2['t']?></option>
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


 <div class="control-group">
<label class="control-label" for="input02">ข้อมูลข่าว:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="exlink" onClick="setctlink()" value="0"<?php echo !$this->news['exl']?' checked':''?>> เนื้อหาในข่าว</label>
<label class="checkbox inline"><input type="radio" name="exlink" onClick="setctlink()" value="1"<?php echo $this->news['exl']?' checked':''?>>  ลิ้งค์ไปยังหน้าอื่น</label>
</div>
</div>

<div class="control-group control-box-link">
<label class="control-label" for="input31">ลิ้งค์ไปยังหน้าอื่น:</label>
<div class="controls">
<input type="text" id="input31" class="span5" style="width:90%" name="url" placeholder="http://" value="<?php echo htmlspecialchars($this->news['url'],ENT_QUOTES,'utf-8')?>">
<p class="help-block">* บังคับกรอก - ต้องขึ้นต้นด้วย http://</p>
</div>
</div>

<?php /*
<div class="control-box-ct">
<div align="center"><strong>เกริ่นนำ</strong> -  <span style="color:#c00;">ยกเลิกการใช้งานส่วนนี้แล้ว.</span></div>
<!--
<?php if($this->error['summary']):?><div style="background:#f00; color:#fff; text-align:center; padding:5px;"><?php echo $this->error['summary']?></div><?php endif?>
<textarea class="mceEditor" name="summary" style="height:100px; width:630px;" minlength="20"><?php echo $this->news['sm']?></textarea>
-->
</div>
*/
?>

<div class="control-box-ct" style="margin-top:10px;">
<div align="center"><strong>เนื้อหา</strong> - ต่อจากเกริ่นนำ, <span style="color:#c00;">ห้ามใช้ภาพหรือข้อความ ที่มีความรุนแรง , อนาจาร, โป้เปลือย, วาบหวิว</span></div>
<textarea class="mceEditor" name="detail" style="height:700px; width:630px;" minlength="20"><?php echo $this->news['d']?></textarea>
</div>

<div class="control-group" style="margin-top:10px;">
<label class="control-label">บุคคลที่เกี่ยวข้อง:</label>
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

<?php if($this->news['c']==11):?>
<div class="control-group">
<label class="control-label">ทีมฟุตบอลที่เกี่ยวข้อง:</label>
<div class="controls">
<div class="api-search-have team">
<?php for($i=0;$i<count($this->team);$i++):?>
<div id="api-search-team_<?php echo $this->team[$i]['_id']?>"><input type="hidden" name="team[]" value="<?php echo $this->team[$i]['_id']?>"><a href="http://football.boxza.com/team/<?php echo $this->team[$i]['l']?>" target="_blank"><?php echo $this->team[$i]['n'].($this->team[$i]['t']?' ('.$this->team[$i]['t'].')':'')?></a>
<a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
</div>
<?php endfor?>
</div>
<div class="input-prepend"><span class="add-on">ทีม</span><input type="text" style="width:250px;" placeholder="  ค้นหาทีม" class="api-search-input" data-type="team"></div>
<div class="api-search team"></div>
<p class="help-block">ปล่อยว่างได้ - (ใส่ชื่อทีมฟุตบอลที่เกี่ยวข้องกับข่าว)</p>
</div>
</div>
<?php endif?>

<?php /*
<div class="control-group">
<label class="control-label">จังหวัดที่เกี่ยวข้อง:</label>
<div class="controls">
<div class="api-search-have place">
<?php for($i=0;$i<count($this->place);$i++):?>
<div id="api-search-place_<?php echo $this->place[$i]['_id']?>"><input type="hidden" name="place[]" value="<?php echo $this->place[$i]['_id']?>"><a href="http://place.boxza.com/<?php echo $this->place[$i]['lk']?$this->place[$i]['lk']:$this->place[$i]['_id']?>" target="_blank"><?php echo $this->place[$i]['n']?></a>
<a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
</div>
<?php endfor?>
</div>
<div class="input-prepend"><span class="add-on">จังหวัด</span><input type="text" style="width:250px;" placeholder="  ค้นหา จังหวัด" class="api-search-input" data-type="place"></div>
<div class="api-search place"></div>
<p class="help-block">ปล่อยว่างได้ - (ใส่ชื่อจังหวัดที่เกี่ยวข้องกับข่าวนี้ หากมีผลกับทุกจังหวัด ให้ใส่ <span style="text-decoration:underline">ประเทศไทย</span> แทน)</p>
</div>
</div>
*/
?>

 <div class="control-group">
<label class="control-label" for="inputtags">ป้ายกำกับ / Tags:</label>
<div class="controls">

<ul class="api-search-have tag">
<?php for($i=0;$i<count($this->news['tags']);$i++):$v=$this->news['tags'][$i]?>
<li class="tag-box"><input type="hidden" name="tags[]" value="<?php echo $v?>">
<?php echo $v?>
<a href="javascript:;" onclick="$(this).parent().remove()">x</a>
</li>
<?php endfor?>
<li class="api-search-tag"><input type="text" class="api-search-input tag" data-type="tag" autocomplete="off" style="width: 30px;"></li>
<p class="clear"></p>
</ul>
<div class="api-search tag"></div>
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

<!--div class="control-group">
<label class="control-label" for="input21">ตั้งเป็นเขี่ยประเด็นข่าว:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="hot" value="1"<?php echo $this->news['ho']?' checked':''?>> ตั้งเป็นเขี่ยประเด็นข่าว</label>
<label class="checkbox inline"><input type="radio" name="hot" value="0"<?php echo !$this->news['ho']?' checked':''?>> ตั้งเป็นข่าวธรรมดา</label>
</select>
</div>
</div-->

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
<li>แทรกลิ้งค์ข่าวหรือเนื้อหาที่ใกล้เคียงกัน</li>
<li>ห้าม Copy จากที่อื่น ต้อง rewrite ใหม่ทั้งหมด</li>
</ul>

</div>
</div>