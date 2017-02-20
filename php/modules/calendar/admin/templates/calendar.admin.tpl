<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{padding:5px 5px 0px 5px}
.table .d p{clear:both}
.table .a{ width:115px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบข่าวเรื่องนี้หรือไม่',click:function(){_.ajax.gourl('/admin','delplace',i)}});}
</script>


<div id="newplace" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newplace',this);_.box.close();return false;">
<div class="gbox_header">วัน</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="350">
<tr><td align="right">ชื่อวัน:</td><td align="left"><input type="text" name="name" size="50" class="tbox" required></td></tr>
<tr><td align="right">วันที่:</td><td align="left">
<select name="day" class="tbox" style="width:auto" required><option value="">- เลือกวัน -</option>
<?php for($i=1;$i<31;$i++):?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php endfor?>
</select>
<select name="month" class="tbox" style="width:auto" required><option value="">- เลือกเดือน -</option>
<?php for($i=0;$i<12;$i++):?>
<option value="<?php echo $i+1?>"><?php echo time::$month[$i]?></option>
<?php endfor?>
</select>
<select name="year" class="tbox" style="width:auto" required><option value="">- เลือกปี -</option>
<option value="-1">- ทุกปีของวันนี้ -</option>
<?php for($i=date('Y');$i<=date('Y')+5;$i++):?>
<option value="<?php echo $i?>"><?php echo $i+543?></option>
<?php endfor?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ปฏิทิน"><i class="icon-home"></i> ปฏิทิน</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">วัน</a></li>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newplace')"><i class="icon-plus icon-black"></i> เพิ่มวันใหม่</a></li>
</ul>


<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th class="a"></th></tr>
<?php for($i=0;$i<count($this->place);$i++):?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>" target="_blank"><img src="http://s3.boxza.com/place/<?php echo $this->place[$i]['fd']?>/s.jpg" style="width:55px;"></a></td>
<td class="d">
<a href="http://place.boxza.com/<?php echo $this->place[$i]['in']?$this->place[$i]['in']:$this->place[$i]['_id']?>" target="_blank"><?php echo $this->place[$i]['nn']?> - <?php echo $this->place[$i]['fn']?> <?php echo $this->place[$i]['ln']?></a><br>
<?php $u=$this->user->profile($this->place[$i]['u']);?>
โดย: <a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a>, โพสเมื่อ: <?php echo time::show($this->place[$i]['da'],'datetime',true)?>
</td>
<td class="a">
<a href="/admin/<?php echo $this->place[$i]['_id']?>" class="btn btn-mini"><i class="icon-wrench"></i> แก้ไข</a>
<a href="javascript:;" onClick="cdel(<?php echo $this->place[$i]['_id']?>)" class="btn btn-mini"><i class="icon-remove"></i> ลบ</a>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="3" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>
