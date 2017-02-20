<style>
.table tr td{ border-bottom:1px solid #f0f0f0;}
.table tr th{background-color:#f9f9f9;}
.table tr.l1 td{background-color:#f8f8f8;}
.table td,.table th{background-color:#fff;}
.table th{padding:5px; text-align:center;}
.table .i{width:75px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:24px; line-height:24px; width:500px; overflow:hidden; float:left;white-space:nowrap; text-overflow:ellipsis;}
.table .d{padding:5px 8px 8px 8px}
.table .d .p{margin:5px 0px 0px 0px}
.table .d .p i{font-size:14px; font-weight:bold; color:#F90;}
.table .d span{float:right}
.table .d p{clear:both}
.table .d .ty{color:#C00; font-weight:bold}
</style>
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

<div>
<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="ลงประกาศฟรี"><i class="icon-home"></i> ลงประกาศฟรี</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/z-1<?php echo $purl?>">กรุงเทพและปริมณฑล</a></li>
   <li><a href="/z-2<?php echo $purl?>">ภาคเหนือ</a></li>
   <li><a href="/z-3<?php echo $purl?>">ภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/z-4<?php echo $purl?>">ภาคตะวันตก</a></li>
   <li><a href="/z-5<?php echo $purl?>">ภาคตะวันออก</a></li>
   <li><a href="/z-6<?php echo $purl?>">ภาคกลาง</a></li>
   <li><a href="/z-7<?php echo $purl?>">ภาคใต้</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
<?php if($this->z):?>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <?php endif?>
 
 <?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <?php if($this->c):?>
	<?php if($this->acate[$this->c]['p']):?>
    <?php echo $this->acate[$this->acate[$this->c]['p']]['t']?>
    <?php $insub=$this->acate[$this->c]['p'];?>
   <?php else:?> 
    <?php echo $this->acate[$this->c]['t']?>
    <?php endif?>
<?php else:?>
สินค้าทุกประเภท
<?php endif?>
<b class="caret"></b></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>">สินค้าทุกประเภท</a></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="<?php echo $curl?>c-<?php echo $k?>"><?php echo $v['n']['t']?></a></li>
   <?php endforeach?>
</ul>
</li>

<?php if($this->c):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $insub?$this->acate[$this->c]['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $insub?$insub:$this->c?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
   <?php if(!$insub)$insub=$this->c;?>
 <?php for($i=0;$i<count($this->cate[$insub]['l']);$i++):?>
 <?php $j=$this->cate[$insub]['l'][$i];?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['_id']?>"><?php echo $j['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
</ul> 

<?php $turl=$curl.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li<?php echo !$this->t?' class="active"':''?>><a href="<?php echo $turl?>">ทั้งหมด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li<?php echo $this->t==$k?' class="active"':''?>><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<table class="table">
<thead>
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th></tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->last);$i++):?>
<?php $l='/'.$this->last[$i]['_id'].'-'.$this->last[$i]['l'].'.html';?>
<tr class="l<?php echo $i%2?>">
<td class="i"><a href="<?php echo $l?>"><img src="http://s3.boxza.com/deal/<?php echo $this->last[$i]['fd']?>/s.jpg" width="75" height="50"></a></td>
<!--td class="t"><?php echo $this->type[$this->last[$i]['ty']]?></td-->
<td class="d">
<strong><a href="<?php echo $l?>"><?php echo $this->last[$i]['t']?></a></strong>
<span class="p"><?php echo $this->last[$i]['p']?'<i>'.number_format($this->last[$i]['p']).'</i> บาท':'ไม่ระบุราคา'?></span>
<p></p>
<div><i class="ty"><?php echo $this->type[$this->last[$i]['ty']]?></i> - <?php echo $this->acate[$this->last[$i]['c']]['t']?> &raquo; <?php echo $this->acate[$this->last[$i]['cs']]['t']?> - <?php echo $this->province[$this->last[$i]['pr']]['name_th']?>
<span><?php echo time::show($this->last[$i]['ds'],'datetime',true)?></span>
<p></p>
</div>
</td>
</tr>
<?php endfor?>
<?php if(!count($this->last)):?>
<tr><td colspan="2" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</tbody>
</table>


<div style="text-align:center"><?php echo $this->pager?></div>
</div>

 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->
 <!-- BEGIN - BANNER : F -->
<?php if($this->_banner['f']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['f'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : F -->