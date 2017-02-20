
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css">	
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>
<style>
.category label{width:100px; margin:0px !important}
#video > div{border:1px solid #f0f0f0; border-radius:5px; padding:5px; margin:5px 0px}
#video > div p{margin:2px}
</style>
<script>
$(function(){
	$('input[name=time]').datepicker({dateFormat:'yy-mm-dd'});
	addvideo();
});
function addvideo()
{
	$('#video').append('<div><p>Youtube ID: <input type="text" class="span3" name="yt[]" value="" maxlength="20"> (รหัส Youtube 11 หลัก)</p><p>รายละเอียด: <textarea name="d[]" class="span5" style="height:50px;"><?php echo $this->game['v'][$i]['d']?></textarea></p></div>');
}
</script>

<ul class="breadcrumb">
  <li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขเกมส์</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขเกมส์</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/admin">ระบบจัดการข้อมูล </a>, <a href="/flash/<?php echo $this->game['_id'].'-'.$this->game['l']?>.html">หน้าแสดงผล </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเกมส์:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title" value="<?php echo $this->game['t']?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['title2']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อรอง:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title2" value="<?php echo $this->game['t2']?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทเกมส์:</label>
<div class="controls category">
<?php foreach($this->cate as $k=>$v):?>
<label class="checkbox inline"><input type="checkbox" name="category[]" value="<?php echo $k?>"<?php echo in_array($k,(array)$this->game['c'])?' checked':''?>> <?php echo $v['t']?></label>
<?php endforeach?>
</select>
<p class="help-inline">* กรุณาเลือกให้ครบถ้วน ตามเนื้อหาของเกมส์</p>
</div>
</div>
 <div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
<label class="control-label" for="input09">รายละเอียดของเกมส์:</label>
<div class="controls">
<textarea id="input09" style="height:300px;" class="span7" name="detail" maxlength="3000" minlength="20" required><?php echo $this->game['d']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['howto']):?> error<?php endif?>">
<label class="control-label" for="input09">วิธีการเล่น:</label>
<div class="controls">
<textarea id="input09" style="height:300px;" class="span7" name="howto" maxlength="3000" minlength="20" required><?php echo $this->game['h']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="http://s3.boxza.com/game/flash/<?php echo $this->game['fd']?>/t.jpg"><br>
<input type="file" id="input10" class="span3" size="20" name="o1">
<p class="help-block">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input10">ไฟล์เกมส์ :</label>
<div class="controls">
<?php if($this->game['swf']['n']):?><a href="http://s3.boxza.com/game/flash/<?php echo $this->game['fd']?>/<?php echo $this->game['swf']['n']?>" target="_blank">ไฟล์เกมส์</a> <?php endif?>
<input type="file" id="input10" class="span3" size="20" name="swf">
<p class="help-block">* บังคับเลือก,  .swf เท่านั้น</p>
</div>
</div>

 <div class="control-group">
<label class="control-label">รูปภาพเพิ่มเติม:</label>
<div class="controls">
<?php for($i=2;$i<=5;$i++):?>
<div><input type="file" class="span3" size="20" name="o<?php echo $i?>"> 
<?php if($this->game['o'.$i]):?>
<label class="checkbox inline"><input type="checkbox" name="del_o<?php echo $i?>" value="1"> ลบรูปภาพนี้</label> <p class="radio inline">, <a href="http://s3.boxza.com/game/<?php echo $this->game['fd'].'/'.$this->game['o'.$i]?>" target="_blank">ดูรูปภาพ</a></p>
<?php endif?>
</div>
<?php endfor?>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input02">คะแนนแนะนำ:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="recommend" value="0"<?php echo !$this->game['rc']?' checked':''?>> ไม่มีคะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="1"<?php echo $this->game['rc']==1?' checked':''?>> 1 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="2"<?php echo $this->game['rc']==2?' checked':''?>> 2 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="3"<?php echo $this->game['rc']==3?' checked':''?>> 3 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="4"<?php echo $this->game['rc']==4?' checked':''?>> 4 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="5"<?php echo $this->game['rc']==5?' checked':''?>> 5 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="6"<?php echo $this->game['rc']==6?' checked':''?>> 6 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="7"<?php echo $this->game['rc']==7?' checked':''?>> 7 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="8"<?php echo $this->game['rc']==8?' checked':''?>> 8 คะแนน</label>
<label class="checkbox inline"><input type="radio" name="recommend" value="9"<?php echo $this->game['rc']==9?' checked':''?>> 9 คะแนน</label>

<p class="help-block">จะนำไปคำนวนเป็นเกมส์แนะนำ โดยเรียงจากเกมส์ที่มีคะแนนมากที่สุดก่อน</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->game['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->game['pl']?' checked':''?>> ไม่แสดง</label>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/admin">ยกเลิก</a>
</div>
</fieldset>
</form>
            
            

