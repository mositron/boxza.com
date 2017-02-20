<script>
function cdel(i){_.box.confirm({title:'ลบคลิปวิดีโอ',detail:'คุณต้องการลบวิดีโอนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delvideo',i)}});}</script>
<ul class="breadcrumb">
  <li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage/playlist">จัดการคลิปวิดีโอ</a></li>
</ul>

<table class="table" width="100%">
<tbody>
<?php for($i=0;$i<count($this->video);$i++):?>
<?php $l='/view/'.$this->video[$i]['_id'];$u=$this->user->profile($this->video[$i]['u']);?>
<tr>
<td width="80"><a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video[$i]['f']?>/<?php echo $this->video[$i]['n']?>" height="45"></a></td>
<td><h4><a href="<?php echo $l?>" style="color:#f90"><?php echo $this->video[$i]['t']?></a></h4>
โดย: <a href="http://boxza.com/<?php echo $u['link']?>"><?php echo $u['name']?></a>, โพสเมื่อ: <?php echo time::show($this->video[$i]['da'],'datetime')?>, ดู: <?php echo number_format(intval($this->video[$i]['do']))?> ครั้ง
</td>
<td width="100">
<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/update/<?php echo $this->video[$i]['_id']?>"><i class="icon-wrench"></i> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->video[$i]['_id']?>)"><i class="icon-remove"></i> ลบ</a></li>
  </ul>
</div>
</td>
</tr>
<?php endfor?>
</tbody>
</table>


<?php if(!$this->count):?>
<div style="padding:50px; text-align:center; font-size:18px; border:1px solid #eee; background-color:#f9f9f9;">
ไม่มีข้อมูล
</div>
<?php endif?>

<div align="center"><?php echo $this->pager?></div>
