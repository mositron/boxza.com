

<table width="100%" class="table table-condensed table-hover">
<caption>สถานที่<?php if($this->c):?>ประเภท<?php echo $this->cate[$this->c]['t']?><?php else:?>ทั้งหมด<?php endif?>ใน<?php echo $this->place['q']?></caption>
<thead>
<tr>
<th></th>
<th>ชื่อสถานที่</th>
<th>ที่อยู่</th>
</tr>
</thead>
<tbody>
<?php if($this->build):?>
<?php foreach($this->build as $k=>$v):?>
<tr>
<td><i class="icon-th-list"></i></td>
<td><a href="/<?php echo $v['lk']?>" target="_blank"><?php echo $v['n']?></a></td>
<td><?php if($v['tt']):
$bkk=($v['tt']['t2']['n']=='กรุงเทพมหานคร');
?> 
<?php if($v['tt']['t4']):?><?php echo ($bkk?'':'ตำบล').$v['tt']['t4']['n']?> <?php endif?>
<?php if($v['tt']['t3']):?><?php echo ($bkk?'':'อำเภอ').$v['tt']['t3']['n']?> <?php endif?>
<?php if($v['tt']['t2']):?><?php echo ($bkk?'':'จังหวัด').$v['tt']['t2']['n']?> <?php endif?>
<?php endif?>
<?php echo $v['zip']?>
</td>
</tr>
<?php endforeach?>
<?php else:?>
<tr>
<td colspan="3" style="text-align:center; vertical-align:middle; height:100px">ไม่มีข้อมูลสถานที่ใน<?php echo $this->place['q']?></td>
</tr>
<?php endif?>
</tbody>
</table>

<?php echo $this->pager?>
