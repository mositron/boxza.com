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

.nav-clist{margin-left:5px; list-style:inside decimal; max-height:2900px; overflow:scroll;}
.nav-clist ul{margin-left:10px; list-style:inside circle}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:22px; line-height:22px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบข่าวเรื่องนี้หรือไม่',click:function(){_.ajax.gourl('/admin','delnews',i)}});}
</script>
<div id="newnews" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newnews',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">หัวข้อข่าว:</td><td align="left"><input type="text" name="title" size="50" class="tbox span4" required></td></tr>
<tr><td align="right">ประเภทข่าว:</td><td align="left">
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
  <li><a href="/" title="ข่าว ข่าววันี้"><i class="icon-home"></i> ข่าว</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการข่าว</a></li>
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
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newnews')"><i class="icon-plus icon-black"></i> เพิ่มข่าวใหม่</a></li>
</ul>


<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th class="a"></th></tr>
<?php $last=time()-(3600*24*EXPIRE_NEWS);for($i=0;$i<count($this->news);$i++):?>
<?php $l=link::news($this->news[$i]);?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>" target="_blank"><img src="http://s3.boxza.com/news/<?php echo $this->news[$i]['fd']?>/s.jpg" style="width:55px;"></a></td>
<td class="d">
<a href="/admin/c-<?php echo $this->news[$i]['c']?>"><?php echo $this->cate[$this->news[$i]['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $this->news[$i]['t']?></a><br>
<?php $u=$this->user->profile($this->news[$i]['u']);?>
โดย: <a href="http://boxza.com/<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a>, โพสเมื่อ: <?php echo time::show($this->news[$i]['da'],'datetime',true)?>, ดู: <?php echo number_format(intval($this->news[$i]['do']))?> ครั้ง
<?php if($this->news[$i]['pl']):?><span class="label label-success">เผยแพร่แล้ว</span><?php endif?>
<?php if($this->news[$i]['wt']):?><span class="label label-warning">รอตรวจสอบ</span><?php endif?>
</td>
<td class="a">
<?php if($this->news[$i]['da']->sec<$last):?>
<input type="button" value="หมดเวลาแก้ไข" class="btn btn-mini btn-disabled" disabled>
<?php else:?>
<?php if(_::$my['am'] || $this->news[$i]['u']==_::$my['_id']):?>
<a href="/admin/<?php echo $this->news[$i]['_id']?>" class="btn btn-mini"><i class="icon-wrench"></i> แก้ไข</a>
<?php if(_::$my['am']):?>
<a href="javascript:;" onClick="cdel(<?php echo $this->news[$i]['_id']?>)" class="btn btn-mini"><i class="icon-remove"></i> ลบ</a>
<?php endif?>
<?php endif?>
<?php endif?>
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
<div class="text-center" style="margin-bottom:5px"><a href="/admin/report" class="btn btn-success" style="display:block">รายงานการเขียนข่าวประจำวัน</a></div>
<div class="text-center"><a href="/admin/topnews" class="btn btn-info" style="display:block">รายงานยอดการอ่านข่าวประจำวัน</a></div>

<h4 style="margin:5px 0px 0px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">หมวดข่าว</h4>
<?php echo $this->catelogs?>
</div>