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

.nav-clist{margin-left:5px;}
.nav-clist ul{margin-left:10px; list-style:inside circle}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:22px; line-height:22px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ข่าว"><i class="icon-home"></i> ข่าว</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">จัดการข่าว</a></li>
   <span class="divider">&raquo;</span>  
   <li><a href="/admin/report/<?php echo _::$path[1]?>">ข่าวประจำวันที่ <?php echo time::show(new mongodate($this->dfrom),'date')?></a></li>
   </ul>

<?php foreach($this->writer as $k=>$v):?>
<h3><a target="_blank" href="http://social.boxza.com/<?php echo $v['profile']['link']?>"><img src="<?php echo $v['profile']['img']?>" style="width:32px;"> <?php echo $v['profile']['name']?></a><small> - <?php echo count($v['news'])?> บทความ</small></h3>
<table class="table">
<?php for($i=0;$i<count($v['news']);$i++):?>
<?php $l=link::news($v['news'][$i]);?>
<tr class="l<?php echo $i%2?>">
<td class="d">
<a href="/admin/c-<?php echo $v['news'][$i]['c']?>"><?php echo $this->cate[$v['news'][$i]['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $v['news'][$i]['t']?></a> - 
ดู: <?php echo number_format(intval($v['news'][$i]['do']))?> ครั้ง
<?php if($v['news'][$i]['pl']):?><span class="label label-success">เผยแพร่แล้ว</span><?php endif?>
<?php if($v['news'][$i]['wt']):?><span class="label label-warning">รอตรวจสอบ</span><?php endif?>
</td>
</tr>
<?php endfor?>
</table>

<?php endforeach?>

</div>
<div class="span3">
<h4 style="margin:0px 0px 5px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">ประจำวัน</h4>
<div class="nav-clist">
<ul>
<li><a href="/admin/report"><?php echo time::$day[date('w')]?> - วันนี้</a></li>
<?php 
$now=time();
for($i=0;$i<31;$i++):
$now-=(3600*24);
?>
<li><a href="/admin/report/<?php echo date('Y-m-d',$now)?>"><?php echo time::$day[date('w',$now)]?> - <?php echo time::show(new mongodate($now),'date')?></a></li>
<?php endfor?>
</ul>
</div>
</div>