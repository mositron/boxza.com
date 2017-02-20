<div style="background:#fff;padding:5px;">

<ul class="breadcrumb">
  <li><a href="/" title="อัลบั้ม"><i class="icon-home"></i> อัลบั้ม</a></li>
 <li><span class="divider">&raquo;</span> <a href="/manage" title="จัดการอัลบั้มรูปภาพของคุณ">จัดการอัลบั้มรูปภาพของคุณ</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขอัลบั้ม</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">รายละเอียดอัลบั้ม</h2>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<?php echo $this->html->tr('ชื่ออัลบั้ม','tt',$this->album['tt'],'input',array('full'=>10))?>
<?php echo $this->html->tr('ประเภทอัลบั้ม','ty',$this->album['pt']['ty'],'select',array('full'=>10,'help'=>'* หากเลือกผิดหมวด เจ้าหน้าที่จะทำการ<strong>ลบทันที</strong>โดยไม่ต้องแจ้งให้ทราบล่วงหน้า'),_::$config['album'])?>
<?php echo $this->html->tr('อธิบายเกี่ยวกับอัลบั้มนี้','ms',$this->album['ms'],'textarea',array('full'=>10,'space'=>''))?>
<?php echo $this->html->tr('การแสดงผล','in',$this->album['in'],'select',array('full'=>10),array('0'=>'สาธารณะ','-1'=>'เฉพาะเพื่อน','-2'=>'เฉพาะฉัน'))?>
<?php if(_::$my['am']):?>
<?php echo $this->html->tr('ตั้งเป็นอัลบั้มแนะนำ','rc',intval($this->album['rc']['ab']),'select',array('full'=>10),array('0'=>'ไม่ตั้งเป็นอัลบั้มแนะนำ','1'=>'ตำแหน่งที่ 1','2'=>'ตำแหน่งที่ 2','3'=>'ตำแหน่งที่ 3','4'=>'ตำแหน่งที่ 4','5'=>'ตำแหน่งที่ 5','6'=>'ตำแหน่งที่ 6','7'=>'ตำแหน่งที่ 7','8'=>'ตำแหน่งที่ 8','9'=>'ตำแหน่งที่ 9','10'=>'ตำแหน่งที่ 10','11'=>'ตำแหน่งที่ 11','12'=>'ตำแหน่งที่ 12','13'=>'ตำแหน่งที่ 13','14'=>'ตำแหน่งที่ 14','15'=>'ตำแหน่งที่ 15','16'=>'ตำแหน่งที่ 16'))?>
<?php endif?>
<tr><td colspan="2" align="center"><div style="padding:4px; text-align:center; border:1px solid #e0e0e0; background:#f9f9f9;">คลิกที่ข้อความที่ต้องการแก้ไข</div></td></tr>
</table>
<script>
function pt_del(i)
{
	_.box.confirm({title:'ลบรูปภาพ',detail:'คุณต้องการลบรูปภาพนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delline',i);}});
}
</script>
            

<div style="background: #F6F6F6;margin: 5px 5px 10px 5px;">

<h3 style="float:left;padding:5px 10px 0px;color: #0399BE;">รูปภาพภายในอัลบั้มนี้</h3>
<input type="button" class="button" value=" ลบอัลบั้ม " style="float:right; margin:2px; padding:0px 10px; height:25px; line-height:25px;" onClick="_.box.confirm({title:'ลบอัลบั้ม',detail:'คุณต้องการลบอัลบั้มและรูปภาพทั้งหมดภายในอัลบั้มนี้หรือไม่',click:function(){_.ajax.gourl('/manage','delalbum',<?php echo $this->album['_id']?>);}});">
<span style="float:right; margin:2px 0px 0px 0px"><span id="file_select_top"></span></span>

<script>
function getdetail(a)
{
	$('.sh-hd').remove();
	$('html').addClass('hdMode');
	$('body').prepend($('<div>').addClass('sh-hd'));
	$('.sh-hd').html('<div class="sh-hd-ct"><div class="sh-hd-in"><div class="sh-hd-wr"><div class="sh-hd-wl"><div class="sh-hd-ms"><form onsubmit="return false" id="file_form""><div style="width:600px; min-height:200px"><h3 style="margin:0px 0px 10px">แก้ไขรายละเอียดรูปภาพ</h3><div style="text-align:center;margin:5px 0px 15px 0px"><span><span id="file_select_file"></span></span></div><div id="upload_panel"></div><div id="file_up_file" class="flash"></div><div id="file_action" style="padding:5px; background:#f5f5f5;text-align:center">กรุณารอซักครู่...</div></div></form></div></div></div></div></div>');
	$('#upload_panel').append('<div style="margin:5px 0px"><div class="left" style="width:205px;"> <img src="'+a.img+'"></div><div class="right" style="width:380px"><textarea class="tbox" name="detail" style="width:380px; height:85px" placeholder="คำบรรยายรูปภาพ">'+a.ms+'</textarea><input type="hidden" name="_id" value="'+a._id+'"><input type="hidden" name="edit" value="1"><select class="tbox" name="to"><option value="0"'+(!a.pin?' selected':'')+'>สาธารณะ</option><option value="-1"'+(a.pin==-1?' selected':'')+'>เฉพาะเพื่อน</option></select></div><p class="clear"></p></div> ');
	$('#file_action').html('<input type="button" class="button blue" value="          บันทึก          " onclick="_.ajax.gourl(\'<?php echo URL?>\',\'setdetail\',$(\'#file_form\').get(0));$(\'.sh-hd\').remove();$(\'html\').removeClass(\'hdMode\')"> <input type="button" class="button" value="    ปิดหน้าต่างนี้    " onclick="$(\'.sh-hd\').remove();$(\'html\').removeClass(\'hdMode\')">');
}
<?php if(_::$my['st']&&_::$my['st']>0):?>
$(function(){
	_.get.js('swfupload.js').done(function(){
		_.get.css('upload.css');
		var sw={
			upload_url:'http://upload.boxza.com/line/photos',
			post_params: {"session":'<?php echo _::upload()->getkey('line/photos',$this->album['_id'])?>'},																
			button_width: 140,
			button_height: 23,
			button_text_top_padding: 2,
			button_text_left_padding: 0,
			button_placeholder_id : "file_select_top",
			button_text : '<span class="button">อัพโหลดรูปภาพ</span>',
			button_text_style : '.button{font-family: tahoma; font-size: 12px; color:#000000; text-shadow: 1px 1px 0px #FFFFFF; text-align:center; font-weight:bold;}',
			file_dialog_complete_handler:function(na,nb){
				if(na>0)
				{
					if(!$('.sh-hd').length)
					{
						$('html').addClass('hdMode');
						$('body').prepend($('<div>').addClass('sh-hd'));
						$('.sh-hd').html('<div class="sh-hd-ct"><div class="sh-hd-in"><div class="sh-hd-wr"><div class="sh-hd-wl"></div></div></div></div>');
					}
					if(!$('.sh-hd-ms').length)
					{
						$('.sh-hd-wl').html('<div class="sh-hd-ms"><form onsubmit="return false" id="file_form""><div style="width:600px; min-height:200px"><h3 style="margin:0px 0px 10px">อัลบั้ม</h3><div style="text-align:center;margin:5px 0px 15px 0px"><span><span id="file_select_file"></span></span></div><div id="upload_panel"></div><div id="file_up_file" class="flash"></div><div id="file_action" style="padding:5px; background:#f5f5f5;text-align:center">กรุณารอซักครู่...</div></div></form></div>');
					}
				};
				try{if(nb>0){this.startUpload();}}catch (ex) {this.debug(ex);};
			},
			upload_complete_handler:function(file)
			{												
				try {
					if (this.getStats().files_queued > 0) {
						this.startUpload();
					} else {
						var progress = new FileProgress(file,  this.customSettings.upload_target);
						progress.SetComplete();
						progress.SetStatus("อัพโหลดครบเรียบร้อยแล้ว.");
						progress.ToggleCancel(false);
						_.ajax.gourl('<?php echo URL?>','getrefresh');
						$('#file_action').html('<input type="button" class="button blue" value="          บันทึก          " onclick="_.ajax.gourl(\'<?php echo URL?>\',\'setdetail\',$(\'#file_form\').get(0));$(\'.sh-hd\').remove();$(\'html\').removeClass(\'hdMode\')"> <input type="button" class="button" value="    ปิดหน้าต่างนี้    " onclick="$(\'.sh-hd\').remove();$(\'html\').removeClass(\'hdMode\')">');
					}
				} catch (ex) {
					this.debug(ex);
				}
			},
			upload_success_handler:function(file,data){
				console.log(file+' --- '+data);
				try{
					var progress = new FileProgress(file,this.customSettings.upload_target);
					progress.SetComplete();
					progress.SetStatus("ได้รับการตอบรับจากเซิฟเวอร์แล้ว.  ["+$KB(file.size)+"]");
					progress.ToggleCancel(false);
				}
				catch(ex)
				{
					this.debugMessage(ex);
				};
				var b=eval('('+data+')');
				if(b.status=='OK')
				{
					$('#upload_panel').append('<div style="margin:5px 0px"><div class="left" style="width:205px;"> <img src="'+b.img+'"></div><div class="right" style="width:380px"><textarea class="tbox" name="detail" style="width:380px; height:85px" placeholder="คำบรรยายรูปภาพ"></textarea><input type="hidden" name="_id" value="'+b._id+'"><select class="tbox" name="to"><option value="0">สาธารณะ</option><option value="-1">เฉพาะเพื่อน</option></select></div><p class="clear"></p></div> ');
				}
				else
				{
					_.box.alert(b.message);
				}
			}
		}
		inetSWFUpload(sw);
	});
});
<?php endif?>
</script>

<p class="clear"></p>
</div>


 <ul class="e-pt" id="getphotos"><?php echo $this->getphotos?></ul>

<br><br>
</div>