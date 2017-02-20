<div class="span9">
<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{ font-size:13px}
.table .d p{clear:both}
.table .a{ width:115px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}

.nav-clist{margin-left:5px; list-style:inside decimal;}
.nav-clist ul{margin-left:10px; list-style:inside circle}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:22px; line-height:22px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบละครเรื่องนี้หรือไม่',click:function(){_.ajax.gourl('/admin','deldrama',i)}});}
</script>
<div id="newdrama" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newdrama',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มละครใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">หัวข้อละคร:</td><td align="left"><input type="text" name="title" size="50" class="tbox span4" required><br>
* กรุณากรอกชื่อให้ถูกต้อง เพื่อใช้เป็น url ของหน้าละคร</td></tr>
<tr><td align="right">ประเภทละคร:</td><td align="left">
<select name="type" class="cate" required>
<option value="">- เลือก -</option>
<?php foreach($this->cate as $k=>$v):?>
<?php if($v['s']):?>
<optgroup label="<?php echo $v['t']?>"></optgroup>
<?php foreach($v['s'] as $k2=>$v2):?>
<?php if($v2['s']):?>
<optgroup label=" &nbsp; &nbsp; <?php echo $v2['t']?>"></optgroup>
<?php foreach($v2['s'] as $k3=>$v3):?>
<option value="<?php echo $k.'-'.$k2.'-'.$k3?>"> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'-'.$k2?>"> &nbsp; &nbsp; <?php echo $v2['t']?></option>
<?php endif?>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k?>"><?php echo $v['t']?></option>
<?php endif?>
<?php endforeach?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ละคร ละครวันี้"><i class="icon-home"></i> ละคร</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการละคร</a></li>
   <?php if($this->cp[0]):?>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/c-<?php echo $this->cp[0]?>"><?php echo $this->cate[$this->cp[0]]['t']?></a></li>
   <?php endif?>
   <?php if($this->cp[1]):?>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/c-<?php echo $this->cp[0]?>_<?php echo $this->cp[1]?>"><?php echo $this->cate[$this->cp[0]]['s'][$this->cp[1]]['t']?></a></li>
   <?php endif?>
   <?php if($this->cp[2]):?>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/c-<?php echo $this->cp[0]?>_<?php echo $this->cp[1]?>_<?php echo $this->cp[2]?>"><?php echo $this->cate[$this->cp[0]]['s'][$this->cp[1]]['s'][$this->cp[2]]['t']?></a></li>
   <?php endif?>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newdrama')"><i class="icon-plus icon-black"></i> เพิ่มละครใหม่</a></li>
</ul>


<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th class="a"></th></tr>
<?php for($i=0;$i<count($this->drama);$i++):?>
<?php $l='/'.$this->drama[$i]['lk'];?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>" target="_blank"><img src="http://s3.boxza.com/drama/<?php echo $this->drama[$i]['fd']?>/s.jpg" style="width:55px;"></a></td>
<td class="d">
<a href="/admin/c-<?php echo $this->drama[$i]['c']?>"><?php echo $this->cate[$this->drama[$i]['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $this->drama[$i]['t']?></a><br>
<?php $u=$this->user->profile($this->drama[$i]['u']);?>
โดย: <a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a>, โพสเมื่อ: <?php echo time::show($this->drama[$i]['da'],'datetime',true)?>, ดู: <?php echo number_format(intval($this->drama[$i]['do']))?> ครั้ง
<?php if($this->drama[$i]['pl']):?><span class="label label-success">เผยแพร่แล้ว</span><?php endif?>
<?php if($this->drama[$i]['wt']):?><span class="label label-warning">รอตรวจสอบ</span><?php endif?>
</td>
<td class="a">
<a href="/admin/<?php echo $this->drama[$i]['_id']?>" class="btn btn-mini"><i class="icon-wrench"></i> เรื่องย่อ</a>
<a href="javascript:;" onClick="cdel(<?php echo $this->drama[$i]['_id']?>)" class="btn btn-mini"><i class="icon-remove"></i> ลบ</a>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="3" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>

</div>
<div class="span3">
<div class="text-center"><a href="/admin/report" class="btn btn-success">รายงานการเขียนละครประจำวัน</a></div>

<h4 style="margin:5px 0px 0px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">หมวดละคร</h4>
<?php echo $this->catelogs?>
</div>