
<table class="table">
<thead>
<tr>
<th>ชื่อเพลย์ลิส</th>
<th width="100" style="text-align:center">จำนวนวิดีโอ</th>
<th></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->playlist);$i++):?>
<?php $l='/playlist/'.$this->playlist[$i]['_id'].'-'.$this->playlist[$i]['l'].'.html';?>
<tr>
<td><a href="<?php echo $l?>" target="_blank"><?php echo $this->playlist[$i]['t']?></a></td>
<td width="100" style="text-align:center"><?php echo count($this->playlist[$i]['v'])?></td>
<td width="100" style="text-align:center">

<a href="/manage/playlist/<?php echo $this->playlist[$i]['_id']?>"><i class="icon-edit show-tooltip-s" title="แก้ไข"></i></a> 
<a href="javascript:;" onClick="cdel(<?php echo $this->playlist[$i]['_id']?>)"><i class="icon-remove show-tooltip-s" title="ลบ"></i></a>
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
