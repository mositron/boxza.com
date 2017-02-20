<style>
.img-s{ padding:5px 0px 5px 5px; margin:5px 5px 10px; border:1px solid #e0e0e0; box-shadow:3px 3px 0px #e9e9e9;}
.img-s .l{width:37%; border:1px dashed #f0f0f0; float:left; margin:0px 2% 0px 0px; text-align:center; padding:5px 0px; line-height:0px;}
.img-s .r{width:60%; float:left;}
.img-s .r div{ padding:5px; border-bottom:1px dashed #f0f0f0;}
.img-s .r div span{display:inline-block; width:150px; font-size:12px;}
.img-s .r input.tbox{width:300px; text-indent:5px;}
.recent{margin:5px 0px 0px 0px;}
.recent li{line-height:0px; margin-bottom:3px;text-align:center; padding:5px 0px; border:1px solid #f0f0f0; overflow:hidden;}
.recent li img{max-width:120px;}
</style>

<link rel="stylesheet" href="http://s0.boxza.com/static/css/upload.css">
<script src="http://s0.boxza.com/static/js/swfupload.js" type="text/javascript"></script>

<div style="padding:5px; border:1px solid #f0f0f0; text-align:center;">image.boxza.com - เว็บฝากรูปภาพฟรี ให้คุณฝากรูปฟรีสูงสุด <strong>10MB</strong> ต่อรูปฟรี!! ไม่มีวันหมดอายุ</div>
<div style="padding:5px; text-align:center; margin:5px 0px; border:1px solid #f0f0f0">
<span><span id="file_select_tmp_thumbnail"></span></span>
</div>
<div id="file_up_tmp_thumbnail" class="flash"></div>
<div id="result"></div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div style="padding:5px; background:#FFFAF5; border:1px solid #F90; line-height:1.8em">
<h4>กฏกติกาในการฝากรูป</h4>
- อัพโหลดไฟล์รูปภาพได้สูงสุด <strong>10 MB</strong><br>
- ฝากรูปประเภท .jpg .jpeg .gif .png<br>
- ย่อรูปภาพโดยอัตโนมัติ ด้วยขนาด 200x200 และ 600x10240(กว้าง600) pixel<br>
- รูปภาพที่ย่ออัตโนมัติ จะเป็นภาพเคลื่อนไหว(.gif)<br>
- สามารถย้อนกลับมาดูรูปที่เคยมาฝากไว้ได้<br>
- ห้ามโพสรูปโป๊ลามกอนาจารเด็ดขาด<br>
- ต้องมี Flash Player จึงสามารถใช้ระบบอัพโหลดได้
</div>
<div style="margin:5px 0px; border:1px solid #e9e9e9; background:#f9f9f9; padding:5px;">
<h4>นักพัฒนา</h4>
- สามารถนำไปติดตั้งบนเว็บบอร์ด หรือ ฟอรั่ม ของท่านได้<br>
- มี api รองรับการอัพโหลดจากภายนอก<br>
ดูรายละเอียดเพิ่มเติมได้ที่ <a href="/developer">นักพัฒนา</a>
</div>


<div class="recent">
<h4 style="padding:5px; background:#f0f0f0;">รูปภาพล่าสุด</h4>
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->image);$i++):?>
<li class="span3">
<a href="/v/<?php echo $this->image[$i]['f'].'.'.$this->image[$i]['ty']?>" target="_blank"><img src="http://i.boxza.com/<?php echo $this->image[$i]['fd'].'/s.'.$this->image[$i]['ty']?>"></a>
</li>
<?php endfor?>
</ul>

</div>


<script>
function uploadSuccess(file,server_data)
{
	try
	{
		var progress = new FileProgress(file,this.customSettings.upload_target);
		progress.SetComplete();
		progress.SetStatus("Complete.  ["+$KB(file.size)+"]");
		progress.ToggleCancel(false);
	}
	catch(ex)
	{
		this.debugMessage(ex);
	};
	thumbshow(server_data);
};
function fileDialogComplete(numFilesSelected, numFilesQueued)
{
	try
	{
		if(numFilesQueued>0)
		{
			this.startUpload();
		}
	}
	catch (ex)
	{
		this.debug(ex);
	}
};
function insertimg(fd,folder,type)
{
	var url='http://image.boxza.com/v/'+fd+'.'+type;
	var s='http://i.boxza.com/'+folder+'/s.'+type;
	var m='http://i.boxza.com/'+folder+'/m.'+type;
	var c='<div class="img-s"><div class="l"><a href="'+url+'" target="_blank"><img src="'+s+'"></a></div><div class="r">';
	c+='<div> - <span>Direct URL</span><input type="text" class="tbox" value="'+url+'" onmouseover="this.select()" onfocus="this.select()"></div>';
	c+='<div> - <span>HTML Code[Thumbnail]</span><input type="text" class="tbox" value=\'<a href="'+url+'" target="_blank" title="ฝากรูป"><img src="'+s+'" border="0" title="ฝากรูป"></a>\' onmouseover="this.select()" onfocus="this.select()" /></div>';
	c+='<div> - <span>HTML Code[View size]</span><input type="text" class="tbox" value=\'<a href="'+url+'" target="_blank" title="ฝากรูป"><img src="'+m+'" border="0" title="ฝากรูป"></a>\' onmouseover="this.select()" onfocus="this.select()" /></div>';
	c+='<div> - <span>BBCode[Thumbnail]</span><input type="text" class="tbox"  value=\'[url='+url+'][img]'+s+'[/img][/url]\' onmouseover="this.select()" onfocus="this.select()" /></div>';
	c+='<div> - <span>BBCode[View size]</span><input type="text" class="tbox" value=\'[url='+url+'][img]'+m+'[/img][/url]\' onmouseover="this.select()" onfocus="this.select()" /></div>';
	c+='</div><p class="clear"></p></div>';
	$('#result').prepend(c);
}
function thumbshow(data)
{
	//alert(data);
	var b=eval('('+data+')');
	if(b.status=='OK')
	{
		insertimg(b.fd,b.folder,b.type)
	}
	else
	{
		_.box.alert("ผิดพลาด: "+b.message);
	}
};
var file_object_tmp_thumbnail;
$(function(){
	file_object_tmp_thumbnail=new SWFUpload({
																													upload_url: "<?php echo URI?>",
																													file_post_name: "file_post",
																													post_params: {"sesimage":"<?php echo getkey()?>"},
																													file_size_limit:"10240",
																													file_types:"*.gif;*.jpg;*.jpeg;*.png",
																													file_types_description:"All Images",
																													file_upload_limit:"0",
																													file_queue_limit:"0",
																													file_queued_handler:uploadStart,
																													file_queue_error_handler:fileQueueError,
																													file_dialog_complete_handler:fileDialogComplete,
																													upload_progress_handler:uploadProgress,
																													upload_error_handler:uploadError,
																													upload_success_handler:uploadSuccess,
																													upload_complete_handler:uploadComplete,
																													flash_url:"http://s0.boxza.com/static/flash/swfupload.swf",
																													custom_settings:{upload_target:"file_up_tmp_thumbnail"},
																													button_placeholder_id : "file_select_tmp_thumbnail",
																													//button_image_url : "/themes/inet/images/admin/selectfile.png",
																													button_width: 614,
																													button_height: 30,
																													button_text_top_padding: 3,
																													button_text_left_padding: 260,
																													button_text : '<span class="button">+ เลือกไฟล์รูปภาพ</span>',
																													button_text_style : '.button { font-family: "ms Sans Serif"; font-size: 16pt; font-weight:bold;}',
																													button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
																													button_cursor: SWFUpload.CURSOR.HAND
																												});
});
</script>