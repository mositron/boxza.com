<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d p{clear:both}
.table .a{ width:70px}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบหนังเรื่องนี้หรือไม่',click:function(){_.ajax.gourl('/admin','delmovie',i)}});}
</script>


<div id="newmovie" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newmovie',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มหนัง(ภาพยนตร์)ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">ชื่อหนัง(ภาพยนตร์):</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
<tr><td align="right">ชนิดของหนัง:</td><td align="left">
<select name="type" class="tbox" required><option value="">- เลือก -</option>
<?php foreach($this->type as $key=>$value):?>
<option value="<?php echo $key?>"><?php echo $value?></option>
<?php endforeach?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<div style="padding:5px; text-align:right">
<a href="javascript:;" class="btn" onClick="_.box.open('#newmovie')"><i class="icon-plus icon-black"></i> เพิ่มหนังใหม่</a> 
<a href="/admin/box-office" class="btn"><i class="icon-plus icon-black"></i> จัดลำดับ Box Office</a> 
</div>

<ul class="breadcrumb">
  <li><a href="/" title="หนัง"><i class="icon-home"></i> หนัง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
</ul>


<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th class="a"></th></tr>
<?php for($i=0;$i<count($this->movie);$i++):?>
<?php $l='/'.$this->movie[$i]['_id'].'-'.$this->movie[$i]['l'].'.html';?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->movie[$i]['fd']?>/s.jpg"></a></td>
<td class="d">
<strong><a href="<?php echo $l?>"><?php echo $this->movie[$i]['t']?></a></strong>
<div>
ชนิด: <?php echo $this->type[$this->movie[$i]['ty']]?>, ประเภท: 
<?php for($j=0;$j<count($this->movie[$i]['c']);$j++):?>
<?php echo ($j?', ':'').$this->cate[$this->movie[$i]['c'][$j]]?>
<?php endfor?>
<br>
เข้าฉาย: <?php echo $this->movie[$i]['tm']?time::show($this->movie[$i]['tm'],'date'):'เร็วๆนี้'?>, เผยแพร่: <?php echo $this->movie[$i]['pl']?'แสดงผล':'ไม่แสดง'?><br>
</div>
</td>
<td class="a">
<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/admin/<?php echo $this->movie[$i]['_id']?>"><i class="icon-wrench"></i> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->movie[$i]['_id']?>)"><i class="icon-remove"></i> ลบ</a></li>
  </ul>
</div>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="3" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>
