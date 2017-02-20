<style>
.vlist ul li{margin:2px 5px;; border:1px solid #f0f0f0; background-color:#f8f8f8; padding:2px;}
.vlist ul li > p.t{float:left; padding:5px 0px 0px 5px;}
.vlist ul li > div{float:right}
</style>
<link rel="stylesheet" type="text/css"  href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>
<script>
$(function() {
	$(".vlist ul" ).sortable();
	$(".vlist ul" ).disableSelection();
});

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
   <li><a href="/manage/playlist">จัดการเพลย์ลิส</a></li>
  <span class="divider">&raquo;</span> 
 <li>แก้ไขเพลย์ลิส</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขเพลย์ลิส</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเพลย์ลิสของคุณเรียบร้อยแล้ว  (กลับไปยัง <a href="/playlist/<?php echo $this->playlist['_id'].'-'.$this->playlist['l']?>.html">หน้าเพลย์ลิสนี้ </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal" onSubmit="_.ajax.gourl('<?php echo URL?>','updateplaylist',this);return false">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเพลย์ลิส:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title" value="<?php echo $this->playlist['t']?>" required>
<p class="help-block">*</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">รายละเอียด:</label>
<div class="controls">
<textarea id="input09" style="height:100px;" class="span7" name="detail" maxlength="3000"><?php echo $this->playlist['d']?></textarea>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input02">หมวดหมู่:</label>
<div class="controls">
<select id="input02" name="cate1" class="span3" onChange="ccate1(this)"><option value="">เลือกรายการ</option>
<?php foreach($this->cate as $val):?>
<option value="<?php echo $val['n']['_id']?>"<?php echo $val['n']['_id']==$this->c1?' selected':''?>><?php echo $val['n']['t']?></option>
<?php endforeach?>
</select>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input03">หมวดย่อย:</label>
<div class="controls">
<select id="input03" name="cate2" class="span3" onChange="ccate2(this)"><option value="">เลือกรายการ</option>
<?php if(is_array($this->cate[$this->c1]['l'])):?>
<?php foreach($this->cate[$this->c1]['l'] as $v):?>
<option value="<?php echo $v['n']['_id']?>"<?php echo $v['n']['_id']==$this->c2?' selected':''?>><?php echo $v['n']['t']?></option>
<?php endforeach?>
<?php endif?>
</select>
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
</div>
</div>

<h3 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">วิดีโอภายในเพลย์ลิสนี้</h3>
<div class="vlist">
<ul>
<?php for($i=0;$i<count($this->video);$i++):?>
<li class="v-<?php echo $this->video[$i]['_id']?>">
<p class="t">
<?php if($this->video[$i]):?>
<span><?php echo $this->video[$i]['t']?> [<?php echo video_duration($this->video[$i]['dr'])?>]</span>
<?php else:?>
<span>วิดีโอนี้ถูกลบไปแล้ว</span>
<?php endif?>
</p>
<div>
<a href="/view/<?php echo $this->video[$i]['_id']?>" class="btn" target="_blank"><i class="icon-facetime-video"></i> ดูวิดีโอนี้</a>
<span class="btn" onClick="$('.v-<?php echo $this->video[$i]['_id']?>').remove()"><i class="icon-trash"></i> ลบ</span>
</div>
<p class="clear"></p>
<input type="hidden" name="video" value="<?php echo $this->video[$i]['_id']?>">
</li>
<?php endfor?>
</ul>
<div style="padding:5px; margin:2px 5px; text-align:center; border:1px solid #f0f0f0; background-color:#f8f8f8f8">สามารถลากตำแหน่งวิดีโอขึ้นลง เพื่อเปลี่ยนลำดับได้ (drag-drop)</div>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<button class="btn" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
            
         