<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>
<div>



<ul class="breadcrumb">
  <li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการสถานที่</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขสถานที่
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขสถานที่</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ข้อมูสถานที่</a><?php if($this->place['pl']):?>, <a href="/<?php echo $this->place['lk']?$this->place['lk']:$this->place['_id']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group">
<label class="control-label" for="input01">ชื่อสถานที่:</label>
<div class="controls">
<input type="text" id="input01" class="span10" name="name" value="<?php echo htmlspecialchars($this->place['n'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* ต้องใส่ให้ถูกต้อง</p>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input03">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/place/<?php echo $this->place['fd']?>/s.jpg?<?php echo rand(1,9999)?>"><br>
<input type="file" id="input03" class="span3" size="20" name="o">
<p class="help-block">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รายละเอียด:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input10" name="detail" class="mceEditor" style="height:450px;"><?php echo $this->place['d']?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input20">ที่อยู่:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input20" name="address" class="" style="height:50px; width:550px"><?php echo $this->place['addr']?></textarea><br>
<p class="help-block">ใส่แบบเต็มๆ รวมที่งจังหวัดด้วย</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input21">เวลาเปิด-ปิด:</label>
<div class="controls" style="margin-right:10px">
<textarea id="input21" name="open" class="" style="height:50px; width:550px"><?php echo $this->place['op']?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input21">เบอร์โทรศัพท์:</label>
<div class="controls" style="margin-right:10px">
<input type="text" id="input21" name="phone" class="" style="width:350px" value="<?php echo $this->place['ph']?>">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input12">ประเภท:</label>
<div class="controls">
<select name="cate">
<?php foreach($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->place['c']?' selected':''?>> <?php echo $v['t']?></label> 
<?php endforeach?>
</select>
<p class="help-block">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label">แสดงผลหน้าแรกสถานที่ (HOT):</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="promote" value="1"<?php echo $this->place['pr']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="promote" value="0"<?php echo !$this->place['pr']?' checked':''?>> ไม่แสดง</label>
</select>
<p class="help-block">เฉพาะบุคคลที่กำลังตกเป็นข่าวดังเท่านั้น จะนำไปแสดงที่หน้าแรก place เพียง 1 บุคคล</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->place['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->place['pl']?' checked':''?>> ไม่แสดง</label>
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
_.mce={upload:'/admin/upload/<?php echo $this->place['_id']?>'};




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




<?php
$txt=$this->place['n'];
if($this->place['tt']):
if($this->place['tt']['t4'])$txt.=' '.$this->place['tt']['t4']['n'];
if($this->place['tt']['t3'])$txt.=' '.$this->place['tt']['t3']['n'];
if($this->place['tt']['t2'])$txt.=' '.$this->place['tt']['t2']['n'];
endif;
echo $txt;
?>
<div id="print_r"></div>
<div id="map_canvas" style="height:400px;"></div>

<link href="http://code.google.com/apis/maps/documentation/javascript/examples/standard.css" rel="stylesheet" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>
<script type="text/javascript">
var geocoder;
var map,marker;
function initialize() 
{
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(<?php echo floatval($this->place['loc'][0])?>, <?php echo floatval($this->place['loc'][1])?>);
	var myOptions = {
		zoom: 12,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	marker = new google.maps.Marker({map: map,position: latlng});
}

function codeAddress()
{
	var address = document.getElementById("address").value;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			showAddress(results[0]);
			marker.setPosition(results[0].geometry.location);
		} 
		else 
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}
function codeAddress2()
{
	var address = document.getElementById("address2").value;
	var a=address.split(',');
	var latlng = new google.maps.LatLng($.trim(a[0]), $.trim(a[1]));
	geocoder.geocode( { 'location': latlng}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			showAddress(results[0]);
			var marker = new google.maps.Marker({map: map,position: results[0].geometry.location});
		} 
		else 
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}


function showAddress(results)
{
	getloc=new Object();
	var a='<form onsubmit="ajax_setmap(this);return false">';
	if (results) 
	{
		var l=results.address_components;
		for(var i=0;i<l.length;i++)
		{
			
			if(l[i].types[0]=='point_of_interest')
			{
				a+='ชื่อ - ';
			}
			else if(l[i].types[0]=='locality')
			{
				a+='ตำบล - ';
			}
			else if(l[i].types[0]=='administrative_area_level_3')
			{
				a+='area:  ';
			}
			else if(l[i].types[0]=='administrative_area_level_2')
			{
				a+='อำเภอ - ';
			}
			else if(l[i].types[0]=='administrative_area_level_1')
			{
				a+='จังหวัด - ';
			}
			else if(l[i].types[0]=='postal_code')
			{
				a+='รหัสไปร - ';
			}
			else if(l[i].types[0]=='country')
			{
				a+='ประเทศ - ';
			}
			else
			{
				a+=' ... - ';
			}
			a+=l[i].types[0]+' : <br>'+JSON.stringify(l[i])+'<br>';
		}
		var b=results.geometry.location;
		//b=b.split(',')
		a+='Lat: <br><input type="text" name="lat" value="'+b.lat()+'" size="50" class="tbox"><br>';
		a+='Lng: <br><input type="text" name="lng" value="'+b.lng()+'" size="50" class="tbox"><br>';
		
	}
	a+='<input type="submit" value=" บันทึก " size="50" class="submit"></form><br><br>';
	$('#print_r').html(a);
}

$(function(){
initialize();
});
</script>