
<div class="left pf-l">
<div>
<h3>ทีม/คลับใหม่ล่าสุด</h3>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr>
<th></th>
<th>ชื่อทีม</th>
<th>หัวหน้าทีม</th>
<th>จำนวนสมาชิก</th>
<th>สร้างเมื่อ</th>
</tr>
</thead>
<tbody>
<?php if(is_array($this->team_new)):?>
<?php foreach($this->team_new as $v):?>
<tr>
<td><img src="http://s3.boxza.com/racing/team/<?php echo $v['fd']?>"></td>
<td><?php echo $v['t']?></td>
<td><?php echo $v['u']?></td>
<td><?php echo $v['mc']?></td>
<td><?php echo ime::show($v['da'],'datetime')?></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="5" height="100" valign="middle" align="center">ยังไม่มีทีม</td></tr>
<?php endif?>
</tbody>
</table>
<h3>ทีม/คลับยอดนิยม</h3>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<thead>
<tr>
<th></th>
<th>ชื่อทีม</th>
<th>หัวหน้าทีม</th>
<th>จำนวนสมาชิก</th>
<th>สร้างเมื่อ</th>
</tr>
</thead>
<tbody>
<?php if(is_array($this->team_hot)):?>
<?php foreach($this->team_hot as $v):?>
<tr>
<td><img src="http://s3.boxza.com/racing/team/<?php echo $v['fd']?>/s.jpg"></td>
<td><?php echo $v['t']?></td>
<td><?php echo $v['u']?></td>
<td><?php echo $v['mc']?></td>
<td><?php echo ime::show($v['da'],'datetime')?></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="5" height="100" valign="middle" align="center">ยังไม่มีทีม</td></tr>
<?php endif?>
</tbody>
</table>
</div>
</div>
<div class="right pf-r">
<a href="/team/new" rel="nofollow" class="btn btn-info"><i class="icon-plus"></i> สร้างทีม/คลับของคุณ</a>
</div>
<div class="clear"></div>

