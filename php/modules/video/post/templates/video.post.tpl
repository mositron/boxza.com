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
 <li>เพิ่มคลิปวิดีโอใหม่</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#292929; text-align:center">เพิ่มคลิปวิดีโอ</h2>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal" onSubmit="_.ajax.gourl('/post','newvideo',this);return false">
 <fieldset>
 <div class="control-group">
<label class="control-label" for="input01">Youtube URL:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="url" value="" required>
<p class="help-block">* url ของหน้าวิดีโอบน youtube เช่น http://www.youtube.com/watch?v=04F4xlWSFh0</p>
</div>
</div>
 <div class="control-group cate1">
<label class="control-label" for="input02">หมวดหมู่:</label>
<div class="controls">
<select id="input02" name="cate1" class="span3" onChange="ccate1(this)" required><option value="">เลือกรายการ</option>
<?php foreach($this->cate as $val):?>
<option value="<?php echo $val['n']['_id']?>"><?php echo $val['n']['t']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group cate2">
<label class="control-label" for="input03">หมวดย่อย:</label>
<div class="controls">
<select id="input03" name="cate2" class="span3" onChange="ccate2(this)" required><option value="">เลือกรายการ</option></select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group cate3" style="display:none">
<label class="control-label" for="input04">หมวดย่อย:</label>
<div class="controls">
<select id="input04" name="cate3" class="span3"><option value="">เลือกรายการ</option></select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="inputtags">ป้ายกำกับ / Tags:</label>
<div class="controls">
<input type="text" id="inputtags" class="span7" name="tags" value="">
<p class="help-block">ปล่อยว่างได้ - (ใช้ , คั่นระหว่างป้ายกำกับแต่ละตัว เพื่อระบุถึงเนื้อหาที่เกี่ยวข้อง, ไม่สามารถใช้อักขระพิเศษได้)</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input04">ความคิดเห็นเพิ่มเติม:</label>
<div class="controls">
<textarea id="input04" class="span7" name="detail" maxlength="500" required></textarea>
<p class="help-block">* อธิบายเพิ่มเติมเกี่ยวกับวิดีโอนี้</p>
</div>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-primary">ถัดไป</button>
<button class="btn" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
            
         
