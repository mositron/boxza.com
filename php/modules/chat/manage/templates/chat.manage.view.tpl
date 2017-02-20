<style type="text/css">
.tmp_colum{background:#F5F5F5;}
.tmp_colum td{background:#FFFFFF;text-align:center; }
.tmp_colum .h{background:#4BA1D8; color:#FFF}
#getphoto label{display:block; width:100px; margin:3px; float:left }


.prv-appfb h4{padding:5px; background:#f5f5f5; margin:5px 0px 5px}
.prv-appfb img{float:left; margin:2px 5px 3px 0px; width:100px; height:70px;}
.prv-appfb hr{margin:5px 0px; color:#fff; background:#fff; height:1px;border:none; border-bottom:1px solid #ccc}
.prv-appfb p{clear:both}
.ans-img > div{width:120px; text-align:center; min-height:100px; float:left}
.ans-img img.o,.ans-ch table img.o{width:100px}

.ans-ch table{margin-bottom:5px}

.colum { width:130px}
.tbservice .ans-ch .colum { width:60px !important}
.req{color:#fff; background:#f00; display:inline-block; font-size:12px; padding:3px 5px;}

.tbservice{ background:none !important}
.tbservice td{background:none !important;}

</style>

<div>
<ul class="tabs" style="text-align: left;">
<li class="left"><a href="/manage/">ห้องแชทของฉัน</a></li>
<li class="right"><a href="javascript:;" onClick="_.box.confirm({'title':'รีเซ็ทผู้ดูแลภายในห้องแชทนี้','detail':'ระบบจะทำการลบผู้ดูแลทั้งหมดภายในห้องแชทนี้ จะเหลือเพียงเจ้าของห้องเท่านั้น<br><br>คุณต้องการดำเนินการต่อหรือไม่','click':function(){_.ajax.gourl('<?php echo URL?>','resetadmin');}})">รีเซ็ทผู้ดูแลภายในห้องแชทนี้</a></li>
<p class="clear"></p>
</ul>
<div style="padding:5px; margin-bottom:5px;">
<div id="getview">

<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>บันทึก!</h4>
  บันทึกข้อมูลเรียบร้อยแล้ว, <a href="/manage">คลิกที่นี่</a> เพื่อไปยังหน้ารวมห้องแชทของคุณ, หรือ <a href="/room/<?php echo $this->chat['_id']?>">ไปยังห้องแชทนี้</a>
</div>
<?php endif?>

<form onSubmit="_.ajax.gourl('<?php echo URL?>','savechat',this);return false" id="frmapp">
<table cellpadding="5" cellspacing="1" border="0" class="table">
<tr><th colspan="2" style="text-align:center">รายละเอียดห้องแชท</th></tr>
<tr><td class="colum">ชื่อห้อง <small>:</small></td><td valign='top'><input type="text" class="tbox" name="name" style="width:99%" value="<?php echo $this->chat['n']?>" maxlength="40"><br><span class="req">*</span> สูงสุดไม่เกิน 30 ตัวอักษร</td></tr>
<tr><td class="colum">ข้อความต้อนรับ <small>:</small></td><td valign='top'><textarea class="tbox" name="welcome" style="width:99%; height:40px;"><?php echo $this->chat['w']?></textarea><br><span class="req">*</span> สูงสุดไม่เกิน 100 ตัวอักษร</td></tr>
<tr><td class="colum">ลิ้งค์ของห้องแชท <small>:</small></td><td valign='top'>http://chat.boxza.com/<?php if(CHAT_LINK): echo CHAT_LINK; else:?><input type="text" class="tbox" name="link" style="width:130px" value="" maxlength="30"><br> 3-30 ตัวอักษร, a-z 0-9 เท่านั้น และไม่สามารถแก้ไขได้ภายหลัง <?php endif?></td></tr>
<?php if($this->chat['u']==1):?>
<tr><td class="colum">Meta Title <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mtt" style="width:99%" value="<?php echo $this->chat['mt']['tt']?>" maxlength="150"></td></tr>
<tr><td class="colum">Meta Description <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mdc" style="width:99%" value="<?php echo $this->chat['mt']['dc']?>" maxlength="150"></td></tr>
<tr><td class="colum">Meta Keyword <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mkw" style="width:99%" value="<?php echo $this->chat['mt']['kw']?>" maxlength="150"></td></tr>
<?php endif?>
<tr><td class="colum">ค่าเริ่มต้นการใช้งาน <small>:</small></td><td valign='top'>
<label><input type="checkbox" name="snd" value="1"<?php echo $this->chat['bg']['snd']?' checked':''?>> เปิดใช้งานเสียงเตือนต่างๆภายในห้องแชท</label>
<label><input type="checkbox" name="one" value="1"<?php echo $this->chat['bg']['one']?' checked':''?>> เปิดใช้งานการแสดงข้อความแบบบรรทัดเดียว</label>
<label><input type="checkbox" name="col" value="1"<?php echo $this->chat['bg']['col']?' checked':''?>> เปิดใช้งานการสุ่มสีข้อความให้กับสมาชิก</label>
</td></tr>
<tr><td class="colum">สีของกล่องแชท <small>:</small></td><td valign='top'>
<table class="table">
<tbody>
<tr>
<td class="cl-label">สีข้อความทั่วไป</td>
<td class="cl-preview"><input type="color" name="tc" value="<?php echo $this->chat['bg']['tc']?$this->chat['bg']['tc']:'#555555'?>"></td>
</tr>
<tr>
<td class="cl-label">สีลิ้งค์ข้อความ</td>
<td class="cl-preview"><input type="color" name="lc" value="<?php echo $this->chat['bg']['lc']?$this->chat['bg']['lc']:'#0099D2'?>"></td>
</tr>
<tr>
<td class="cl-label">สีพื้นหลังทั้งหมด</td>
<td class="cl-preview"><input type="color" name="al_cl" value="<?php echo $this->chat['bg']['al']['cl']?$this->chat['bg']['al']['cl']:'#2B2728'?>"></td>
</tr>
<tr>
<td class="cl-label">ภาพพื้นหลัง (ถ้ามี)</td>
<td class="cl-preview"><input type="url" name="al_bg" value="<?php echo $this->chat['bg']['al']['bg']?>" style="width:300px" class="tbox"> <br>(ปล่อยว่างได้ - หรือใส่เป็น url ของรูปภาพที่เก็บไว้บนเว็บ)</td>
</tr>
<tr>
<td class="cl-label">ความสว่างของพื้นกล่องข้อความ</td>
<td class="cl-preview">
<select name="bg_pc">
<?php for($i=0;$i<=100;$i+=5):?><option value="<?php echo $i?>"<?php echo $i==$this->chat['bg']['pc']?' selected':''?>><?php echo $i?> %</option><?php endfor?>
</select>
<br>สามารถใช้งานได้กับบราวเซอร์ใหม่ๆ หรือบราวเซอร์ที่รองรับ CSS3 เท่านั้น
</td>
</tr>
<tr>
<td class="cl-label">ความสว่างของพื้นกล่องรายชื่อ</td>
<td class="cl-preview">
<select name="bg_pn">
<?php for($i=0;$i<=100;$i+=5):?><option value="<?php echo $i?>"<?php echo $i==$this->chat['bg']['pn']?' selected':''?>><?php echo $i?> %</option><?php endfor?>
</select>
<br>สามารถใช้งานได้กับบราวเซอร์ใหม่ๆ หรือบราวเซอร์ที่รองรับ CSS3 เท่านั้น
</td>
</tr>
</tbody>
</table>

</td></tr>

<tr><td class="colum">เล่นเพลงจากวิทยุ <small>:</small></td><td valign='top'><input type="text" class="tbox" name="radio" style="width:99%" value="<?php echo $this->chat['r']?>" maxlength="100"><br>
- ใส่ URL ของ Shoutcast หรือบอร์ทคลื่นวิทยุของคุณ<br>
- ตัวอย่าง url ที่นำมาใส่เช่น http://<strong style="color:#690">IPวิทยุของคุณ</strong>:<strong style="color:#690">Portวิทยุคองคุณ</strong>/;stream.mp3<br>
- หากต้องการใช้คลื่นวิทยุของ BoxZa.com ให้กรอก <strong style="text-decoration:underline">http://115.178.60.121:8000/;stream.mp3</strong><br>
- หรือปล่อยว่าง หากต้องการไม่ให้มีเสียงเพลง

</td></tr>

<tr><td class="colum">บอท <small>:</small></td><td valign='top'>
<table cellpadding="5" cellspacing="0">
<thead>
<th>ชื่อบอท</th>
<th>ประเภท</th>
</thead>
<tbody>
<?php for($i=0;$i<MAX_BOT;$i++):?>
<tr>
<td><input type="text" name="bot_<?php echo $i?>_n" value="<?php echo $this->chat['bt'][$i]['n']?>"></td>
<td><select name="bot_<?php echo $i?>_ty">
<option value="">เฝ้าห้อง</option>
<option value="chat"<?php echo $this->chat['bt'][$i]['ty']=='chat'?' selected':''?>>โต้ตอบ</option>
<option value="poem1"<?php echo $this->chat['bt'][$i]['ty']=='poem1'?' selected':''?>>กลอน (แบบที่ 1)</option>
<option value="poem2"<?php echo $this->chat['bt'][$i]['ty']=='poem2'?' selected':''?>>กลอน (แบบที่ 2)</option>
<option value="poem3"<?php echo $this->chat['bt'][$i]['ty']=='poem3'?' selected':''?>>ประกาศจากทีมงาน BoxZa</option>
</select>
</td>
</tr>
<?php endfor?>
</tbody>
</table>
ปล่อยว่างได้
</td></tr>



<tr><td class="colum">ตั้งเป็นสาธารณะ <small>:</small></td><td valign='top'><label><input type="radio" name="published" value="1"<?php echo $this->chat['pl']?' checked':''?>> ใช่</label> <label><input type="radio" name="published" value="0"<?php echo !$this->chat['pl']?' checked':''?>> ไม่ใช่</label><br>
คือการให้ห้องแชทนี้แสดงอยู่ในหน้ารวมห้องแชททั้งหมด</td></tr>

<tr><td class="colum"></td><td valign='top'><input type="submit" class="btn btn-info" value="          บันทึก          ">  หรือกลับไปยัง <a href="/manage" class="btn">ห้องแชทของฉันทั้งหมด</a></td></tr>
</table>
</form>

<div style="padding:5px; border:1px solid #f0f0f0; border-radius:5px; margin:0px 0px 5px">
<h4 style="height:30px; line-height:30px; padding:0px 5px; margin-bottom:5px; background:#f5f5f5; color:#FF6600">ลิ้งค์สำหรับห้องแชทของคุณ</h4>
<input type="text" style="width: 100%;box-sizing: border-box;height: 30px;" value="http://chat.boxza.com/room/<?php echo $this->chat['_id']?>">
</div>

<div style="padding:5px; border:1px solid #f0f0f0; border-radius:5px;">
<h4 style="height:30px; line-height:30px; padding:0px 5px; margin-bottom:5px; background:#f5f5f5; color:#FF6600">โค๊ดห้องแชท สำหรับนำไปติดเว็บของคุณ!</h4>
<textarea style="width: 100%;box-sizing: border-box;height: 60px;"><iframe frameborder="0" width="100%" height="500" src="http://s0.boxza.com/static/chat/?r=<?php echo $this->chat['_id']?>"></iframe></textarea>
สามารถแก้ไข ความสูง หรือ ความกว้างได้ภายในโค๊ด<br>
- ความกว้าง คือ width="100%" (เดิม 100% หรือยืดเต็มพื้นที่ในจุดนั้น)<br>
- ความสูง คือ height="500"  (เดิม 500 พิกเซล)
</div>

</div>
</div>
</div>


<script>
function insert_ans(i,p)
{
	var d=$('<div>').attr('id','ans-'+i).html('<img src="'+p+'" class="o"><br><a href="javascript:;" onclick="delans('+i+')">ลบคำตอบนี้</a>');
	$('.ans-img').append(d);
}
function delans(i)
{
	_.box.confirm({title:'ลบคำตอบ',detail:'คุณต้องการลบคำตอบ(รูปภาพ)นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delans',i)}});
}

$('input[name=photo]').change(function(e){
	if($(this).val())
	{
		_.upload.start(this,null,function(b){if(b.status=='OK'){$('.prv-img').attr('src',b.photo);}else{_.box.alert(b.message);}});
	}
});

<?php if($this->app['ty']=='ch'):?>
$('input[name=answer]').change(function(e){
	if($(this).val())
	{
		var $t = this;
		_.upload.start(this,
			function(f){f.append('<input type="hidden" name="ans" value="'+$($t).attr('ans')+'">');},
			function(b){if(b.status=='OK'){$('#ans-img-'+$($t).attr('ans')).attr('src',b.photo);}else{_.box.alert(b.message);}}
		);
	}
});
<?php else:?>
$('input[name=answer]').change(function(e){
	if($(this).val())
	{
		_.upload.start(this,null,function(b){if(b.status=='OK'){insert_ans(b.ans,b.photo);}else{_.box.alert(b.message);}});
	}
});
<?php endif?>
</script>

