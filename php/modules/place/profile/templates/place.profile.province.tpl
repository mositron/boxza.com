<style>
.table .text-center{text-align:center !important;}

.tbweather thead th, .tbweather tbody td{text-align: center;vertical-align: middle;}
.icn-wt{ display:inline-block; width:64px; height:64px; background:url(http://s0.boxza.com/static/images/weather/icon.png) -64px -64px no-repeat;}
.icn-wt1{background-position:0px 0px}
.icn-wt2{background-position:-64px 0px}
.icn-wt3{background-position:-128px 0px}
.icn-wt4{background-position:-192px 0px}
.icn-wt5{background-position:-256px 0px}
.icn-wt6{background-position:-320px 0px}
.icn-wt7{background-position:-384px 0px}
.icn-wt8{background-position:-448px 0px}
.icn-wt9{background-position:-512px 0px}
.icn-wt10{background-position:-576px 0px}
.icn-wt11{background-position:-640px 0px}
.icn-wt12{background-position:-704px 0px}
.row-weather li>div{text-align:center; border:1px solid #f0f0f0; margin:0px 1px 5px; padding:5px 2px 2px; border-radius:4px;}
.row-weather li p{margin:5px 0px; text-align:center; font-size:16px;}
</style>

<ul class="breadcrumb">
<li><a href="/" title="สถานที่"><i class="icon-home"></i> สถานที่</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->place['tt']['t1']['lk']?>" title="<?php echo $this->place['tt']['t1']['n']?>"><?php echo $this->place['tt']['t1']['n']?></a></li>
<span class="divider">&raquo;</span>
<li><a href="<?php echo $curlink='/'.$this->place['lk']?>" title="<?php echo $this->place['n']?> <?php echo $this->place['ne']?>"><?php echo $this->place['n']?> - <?php echo $this->place['ne']?></a></li>
</ul>

<div class="row-fluid">
<div class="span4">
<div class="ab">
<div class="text-center">
<img src="http://s3.boxza.com/place/<?php echo $this->place['fd']?>/t.jpg" alt="<?php echo $this->place['n']?>">
</div>
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

<h3><?php echo $this->place['n']?> - <?php echo $this->place['ne']?> <small><?php echo $this->place['q']?> <?php echo $this->place['tt']['t1']['n']?> <?php if(_::$my['am']):?> (<a href="/admin/<?php echo $this->place['_id']?>">แก้ไข</a>)<?php endif?></small></h3>

<?php echo $this->page?>

</div>
</div>

