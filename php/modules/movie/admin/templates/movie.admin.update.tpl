
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>

<style>
.category label{width:240px; margin:0px !important}
#video > div{border:1px solid #ccc; border-radius:5px; padding:5px; margin:5px 0px}
#video > div p{margin:2px}
</style>
<script>
$(function(){
	$('input[name=time]').datepicker({dateFormat:'yy-mm-dd'});
	addvideo();
});
function addvideo()
{
	$('#video').append('<div><p>Youtube ID: <input type="text" class="span5" name="yt[]" value="" maxlength="20"> (รหัส Youtube 11 หลัก)</p><p>รายละเอียด: <textarea name="d[]" class="span9" style="height:50px;"><?php echo $this->movie['v'][$i]['d']?></textarea></p></div>');
}
</script>

<div>



<ul class="breadcrumb">
  <li><a href="/" title="หนัง"><i class="icon-home"></i> หนัง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขหนัง(ภาพยนตร์)</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; text-align:center">แก้ไขหนัง(ภาพยนตร์)</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a>, <a href="/<?php echo $this->movie['_id'].'-'.$this->movie['l']?>.html">หน้าแสดงผล </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเรื่อง:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title" value="<?php echo $this->movie['t']?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label">ชื่อรอง:</label>
<div class="controls">
<input type="text" class="span7" name="title2" value="<?php echo $this->movie['t2']?>">
<p class="help-block">ปล่อยว่างได้ (ใช้สำหรับชื่อเรื่องภาษาไทย ของหนังต่างประเทศ)</p>
</div>
</div>
 <div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทหนัง:</label>
<div class="controls category">
<?php foreach($this->cate as $k=>$v):?>
<label class="checkbox inline"><input type="checkbox" name="category[]" value="<?php echo $k?>"<?php echo in_array($k,$this->movie['c'])?' checked':''?>> <?php echo $v?></label>
<?php endforeach?>
</select>
<p class="help-inline">* กรุณาเลือกให้ครบถ้วน ตามเนื้อหาของหนัง</p>
</div>
</div>
 <div class="control-group<?php if($this->error['type']):?> error<?php endif?>">
<label class="control-label" for="input03">ชนิดของหนัง:</label>
<div class="controls">
<select id="input03" name="type" class="span3" required><option value="">เลือกรายการ</option>
<?php foreach($this->type as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->movie['ty']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input05">ผู้กำกับ:</label>
<div class="controls">
<input id="input05" type="text" class="span6" name="director" value="<?php echo implode(', ',(array)$this->movie['dt'])?>" >
<p class="help-block">ใช้ , คั่นระหว่างชื่อผู้กำกับแต่ละคน</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input06">นักแสดง:</label>
<div class="controls">
<input id="input06" type="text" class="span6" name="actor" value="<?php echo implode(', ',(array)$this->movie['at'])?>" >
<p class="help-block">ใช้ , คั่นระหว่างชื่อนักแสดงแต่ละคน</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input06">เข้าฉาย:</label>
<div class="controls">
<input id="input07" type="text" class="span3" size="30" name="time" value="<?php echo $this->movie['tm']?date('Y-m-d',$this->movie['tm']->sec):''?>" >
<p class="help-inline">หากปล่อยว่างคือ หนังใหม่เร็วๆนี้ (Coming Soon)</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input06">โรงที่เข้าฉาย:</label>
<div class="controls">
<label class="checkbox inline"><input type="checkbox" name="cinema[]" value="mj"<?php echo in_array('mj',$this->movie['cn'])?' checked':''?>> Major</label>
<label class="checkbox inline"><input type="checkbox" name="cinema[]" value="sf"<?php echo in_array('sf',$this->movie['cn'])?' checked':''?>> SF</label>
</div>
</div>
 <div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
<label class="control-label" for="input09">รายละเอียด / เนื้อเรื่องย่อ:</label>
<div class="controls">
<textarea id="input09" style="height:400px; width:440px;" class="span7" name="detail" maxlength="3000" minlength="20" required><?php echo $this->movie['d']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/movie/<?php echo $this->movie['fd']?>/s.jpg"><br>
<input type="file" id="input10" class="span3" size="20" name="o1">
<p class="help-block">* บังคับเลือก</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">วิดีโอ:</label>
<div class="controls">
<div id="video">
<?php if(count($this->movie['v'])):?>
<?php for($i=0;$i<count($this->movie['v']);$i++):?>
<div>
<p>Youtube ID: <input type="text" class="span5" name="yt[]" value="<?php echo $this->movie['v'][$i]['yt']?>" maxlength="20"<?php if($i==0):?> required<?php endif?>> <?php if($i==0):?><span style="background:#f00; color:#fff;">*</span><?php endif?> (รหัส Youtube 11 หลัก)</p>
<p>รายละเอียด: <textarea name="d[]" class="span9" style="height:50px;"><?php echo $this->movie['v'][$i]['d']?></textarea></p>
</div>
<?php endfor?>
<?php else:?>
<div>
<p>Youtube ID: <input type="text" class="span5" name="yt[]" value="" maxlength="20" required> <span style="background:#f00; color:#fff;">*</span> (รหัส Youtube 11 หลัก)</p>
<p>รายละเอียด: <textarea name="d[]" class="span9" style="height:50px;"><?php echo $this->movie['v'][$i]['d']?></textarea></p>
</div>
<?php endif?>
</div>
<p class="help-block"><input type="button" class="btn" value=" เพิ่มวิดีโอ " onClick="addvideo()"></p>
</div>
</div>

 <div class="control-group">
<label class="control-label">รูปภาพเพิ่มเติม:</label>
<div class="controls">
<?php for($i=2;$i<=5;$i++):?>
<div><input type="file" class="span3" size="20" name="o<?php echo $i?>"> 
<?php if($this->movie['o'.$i]):?>
<label class="checkbox inline"><input type="checkbox" name="del_o<?php echo $i?>" value="1"> ลบรูปภาพนี้</label> <p class="radio inline">, <a href="http://s3.boxza.com/movie/<?php echo $this->movie['fd'].'/'.$this->movie['o'.$i]?>" target="_blank">ดูรูปภาพ</a></p>
<?php endif?>
</div>
<?php endfor?>
</div>
</div>


 <div class="control-group">
<label class="control-label">Wallpapers:</label>
<div class="controls">
<?php for($i=1;$i<=10;$i++):?>
<div><input type="file" class="span3" size="20" name="w<?php echo $i?>"> 
<?php if($this->movie['w'.$i]):?>
<label class="checkbox inline"><input type="checkbox" name="del_w<?php echo $i?>" value="1"> ลบรูปภาพนี้</label> <p class="radio inline">, <a href="http://s3.boxza.com/movie/<?php echo $this->movie['fd'].'/'.$this->movie['w'.$i]?>" target="_blank">ดูรูปภาพ</a></p>
<?php endif?>
</div>
<?php endfor?>
<p class="help">รูปต้องมีขนาดใหญ่กว่า หรือเท่ากับ 1024x768</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">ตั้งเป็นหนังแนะนำ:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="recommend" value="1"<?php echo $this->movie['rc']?' checked':''?>> ใช่</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="0"<?php echo !$this->movie['rc']?' checked':''?>> ไม่ใช่</label>
</select>
</div>
</div>


 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->movie['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->movie['pl']?' checked':''?>> ไม่แสดง</label>
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