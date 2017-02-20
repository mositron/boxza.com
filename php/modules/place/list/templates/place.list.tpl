<ul class="breadcrumb">
<li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo _::$path[0]?>" title="<?php echo $n=($this->c?$this->cate[$this->c]['t']:'สถานที่ทั้งหมด')?>"><?php echo $n?></a></li>
</ul>

<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
<!--h3><?php echo $this->cate[$this->c]?></h3-->

<table width="100%" class="table table-condensed table-hover">
<caption>สถานที่<?php if($this->c):?>ประเภท<?php echo $this->cate[$this->c]['t']?><?php else:?>ทั้งหมด<?php endif?>ในประเทศไทย</caption>
<thead>
<tr>
<th></th>
<th>ชื่อสถานที่</th>
<th>ที่อยู่</th>
<th>ประเภท</th>
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
<td><?php echo $v['c']?$this->cate[$v['c']]['t']:''?></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr>
<td colspan="4" style="text-align:center; vertical-align:middle; height:100px">ไม่มีข้อมูลสถานที่ใน<?php echo $this->place['q']?></td>
</tr>
<?php endif?>
</tbody>
</table>

<div class="text-center"><?php echo $this->pager?></div>

