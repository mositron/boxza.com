<ul class="breadcrumb">
<li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
<span class="divider">&raquo;</span>
<li><a href="<?php echo $curlink='/'.$this->place['lk']?>" title="<?php echo $this->place['n']?>"><?php echo $this->place['n']?></a></li>
</ul>

<div class="row-fluid">
<div class="span4">
<div class="ab">
<div class="text-center">
<img src="http://s3.boxza.com/place/<?php echo $this->place['fd']?>/t.jpg" alt="<?php echo $this->place['n']?>">
</div>
<h4 class="ab-hb"><a href="<?php echo $curlink?>" target="_blank" title="ประวัติ <?php echo $this->place['n']?>">ประวัติ <?php echo $this->place['n']?></a></h4>
<ul class="ab-ul">

<?php if($this->place['adr']):?><li class="l">ที่อยู่: <span><?php echo $this->place['adr']?></span></li><?php endif?>
<?php if($this->place['op']):?><li class="l">เวลาเปิด/ปิด: <span><?php echo $this->place['op']?></span></li><?php endif?>
<?php if($this->place['ph']):?><li class="l">เบอร์โทรศัพท์: <span><?php echo $this->place['ph']?></span></li><?php endif?>
<?php if($this->place['ps']):?><li class="l">ประเภท: <span><?php for($i=0;$i<count($this->place['ps']);$i++)echo $this->cate[$this->place['ps'][$i]];?></span></li><?php endif?>

</ul>
</div>

<?php if(count($this->place['cc'])>0):?>
<table width="100%" class="table table-condensed table-hover">
<caption>สถานที่แบ่งตามประเภทใน<?php echo $this->place['n']?></caption>
<thead>
<tr>
<th></th>
<th>ประเภท</th>
<th>จำนวน</th>
</tr>
</thead>
<tbody>
<?php $i=0;$s=0;foreach($this->cate as $k=>$v):if(!$this->place['cc'][$k])continue;?>
<tr>
<td><i class="icon-th-list"></i></td>
<td><a href="<?php echo $curlink.'/('.$v['l'].')'?>"><?php echo $v['t']?></a></td>
<td class="text-center"><?php echo number_format($this->place['cc'][$k])?></td>
</tr>
<?php $i++;$s+=$this->place['cc'][$k];endforeach?>
<?php if($i>1):?>
<tr>
<td><i class="icon-th-list"></i></td>
<td><a href="<?php echo $curlink?>/(ทั้งหมด)">ทั้งหมด</a></td>
<td class="text-center"><?php echo number_format($s)?></td>
</tr>
<?php endif?>
</tbody>
</table>
<?php endif?>
</div>
<div class="span8">
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
<h3><?php echo $this->place['n']?><?php if(_::$my['am']):?> <small>(<a href="/admin/<?php echo $this->place['_id']?>">แก้ไข</a>)</small><?php endif?></h3>

<?php echo $this->page?>

</div>

</div>