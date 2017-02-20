<script>

var cate=<?php echo json_encode($this->cate)?>;
var cate1=0,cate2=0;
function ccate1(e)
{
	var v=$(e).val(),d='<option value="">เลือกรายการ</option>';
	cate1=0;
	cate2=0;
	if(v)
	{
		if(cate[v] && cate[v].l)
		{
			cate1=v;
			var ob=cate[v].l;
			for (var key in ob)
			{
				d+='<option value="'+ob[key].n._id+'">'+ob[key].n.t+'</option>';
			}
		}
	};
	$('select[name=cate2]').html(d);
	$('.cate3').css('display','none');
	$('select[name=cate3]').html('<option value="">เลือกรายการ</option>');
}
function ccate2(e)
{
	var v=$(e).val(),d='<option value="">เลือกรายการ</option>',found=false;
	if(v)
	{
		if(cate[cate1].l[v] && cate[cate1].l[v].l)
		{
			cate2=v;
			var ob=cate[cate1].l[cate2].l;
			for (var key in ob)
			{
				found=true;
				d+='<option value="'+ob[key].n._id+'">'+ob[key].n.t+'</option>';
			}
		}
	};
	$('.cate3').css('display',found?'block':'none');
	$('select[name=cate3]').html(d);
}
</script>
<ul class="breadcrumb">
  <li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
  <span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการคลิปวิดีโอ</a></li>
  <span class="divider">&raquo;</span> 
 <li>แก้ไขคลิปวิดีโอ</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#292929; text-align:center">แก้ไขคลิปวิดีโอ <small>(<a href="javascript:;" onClick="_.box.confirm({'title':'ลบคลิปวิดีโอนี้','detail':'คุณต้องการลบคลิปวิดีโอนี้หรือไม่','click':function(){_.ajax.gourl('/manage','delvideo',<?php echo $this->video['_id']?>)}});">ลบคลิปวิดีโอนี้</a>)</small></h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลคลิปวิดีโอของคุณเรียบร้อยแล้ว  (กลับไปยัง <a href="/view/<?php echo $this->video['_id']?>">หน้าแสดงวิดีโอนี้ </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal" onSubmit="_.ajax.gourl('/update/<?php echo $this->video['_id']?>','updatevideo',this);return false">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อวิดีโอ:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title" value="<?php echo $this->video['t']?>" required>
<p class="help-block">*</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">รูปภาพ:</label>
<div class="controls"><img src="http://s3.boxza.com/video/<?php echo $this->video['f']?>/<?php echo $this->video['n']?>"></div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">รายละเอียด:</label>
<div class="controls">
<textarea id="input09" style="height:100px;" class="span7" name="content" maxlength="3000"><?php echo $this->video['m']?></textarea>
<p class="help-block"></p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input02">หมวดหมู่:</label>
<div class="controls">
<select id="input02" name="cate1" class="span3" onChange="ccate1(this)" required><option value="">เลือกรายการ</option>
<?php foreach($this->cate as $val):?>
<option value="<?php echo $val['n']['_id']?>"<?php echo $val['n']['_id']==$this->c1?' selected':''?>><?php echo $val['n']['t']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input03">หมวดย่อย:</label>
<div class="controls">
<select id="input03" name="cate2" class="span3" onChange="ccate2(this)" required><option value="">เลือกรายการ</option>
<?php if(is_array($this->cate[$this->c1]['l'])):?>
<?php foreach($this->cate[$this->c1]['l'] as $v):?>
<option value="<?php echo $v['n']['_id']?>"<?php echo $v['n']['_id']==$this->c2?' selected':''?>><?php echo $v['n']['t']?></option>
<?php endforeach?>
<?php endif?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group cate3" style="display:<?php echo (is_array($this->cate[$this->c1]['l'][$this->c2]['l'])&&count($this->cate[$this->c1]['l'][$this->c2]['l']))?'block':'none'?>">
<label class="control-label" for="input04">หมวดย่อย:</label>
<div class="controls">
<select id="input04" name="cate3" class="span3"><option value="">เลือกรายการ</option>
<?php if(is_array($this->cate[$this->c1]['l'][$this->c2]['l'])):?>
<?php foreach($this->cate[$this->c1]['l'][$this->c2]['l'] as $v):?>
<option value="<?php echo $v['n']['_id']?>"<?php echo $v['n']['_id']==$this->c3?' selected':''?>><?php echo $v['n']['t']?></option>
<?php endforeach?>
<?php endif?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
<?php if(_::$my['am']):?>
 <div class="control-group">
<label class="control-label">วิดีโอแนะนำ:</label>
<div class="controls category">
<label class="checkbox"><input type="checkbox" name="recommend" value="1"<?php echo $this->video['rc']?' checked':''?>> แสดงในหน้าแรกเว็บไซต์</label>
</div>
</div>
 <div class="control-group">
<label class="control-label"> Facebook:</label>
<div class="controls category">
<label class="checkbox"><input type="checkbox" name="recommend" value="1"<?php echo $this->video['rc']?' checked':''?>> แสดงในหน้าแรกเว็บไซต์</label>
</div>
</div>
<?php endif?>
 <div class="control-group">
<label class="control-label" for="input09">ความคิดเห็นเพิ่มเติม:</label>
<div class="controls">
<textarea id="input09" style="height:100px;" class="span7" name="detail" maxlength="500" minlength="10" required><?php echo $this->video['d']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="inputtags">ป้ายกำกับ / Tags:</label>
<div class="controls">
<input type="text" id="inputtags" class="span7" name="tags" value="<?php echo is_array($this->video['tags'])?implode(', ',$this->video['tags']):''?>">
<p class="help-block">ปล่อยว่างได้ - (ใช้ , คั่นระหว่างป้ายกำกับแต่ละตัว เพื่อระบุถึงเนื้อหาที่เกี่ยวข้อง, ไม่สามารถใช้อักขระพิเศษได้)</p>
</div>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<button class="btn" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
            
