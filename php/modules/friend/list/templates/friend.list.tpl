<div class="row-fluid">
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

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div class="hr">
<h3><i></i> เพื่อนแนะนำ</h3>
<div>
<ul>
<?php foreach($this->rec as $v):?>
<li>
<a href="msnim:add?contact=<?php echo $v['em']?>"><img src="http://s3.boxza.com/msn/rec/<?php echo $v['fd'].'/'.$v['pt']?>" alt="<?php echo $v['em']?>">
<span class="<?php echo $v['ty']?>"><?php echo $this->type[$v['ty']]?><i></i></span>
</a>
<p><i></i><a href="msnim:add?contact=<?php echo $v['em']?>"><?php echo $v['em']?></a></p>
<span><i></i><?php echo $this->province[$v['pr']]['name_th']?></span>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
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

</div>
<div class="span4">
<!--nipa-->

<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="390" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>
</div>

<div style="margin:5px 0px;">


<h3 class="hn"><i></i> เพื่อนมาใหม่</h3>


<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="หาเพื่อน"><i class="icon-home"></i> หาเพื่อน</a></li>
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
<?php if($this->z):?>
 <span class="divider">&raquo;</span>
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
 <?php endif?>
 
 <?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>

</ul> 

<?php $turl=$curl.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li<?php echo !$this->t?' class="active"':''?>><a href="<?php echo $turl?>">ทั้งหมด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li<?php echo $this->t==$k?' class="active"':''?>><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>

<table class="table table-striped">
<thead><tr><th>วันที่โพส</th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php if($this->msn):?>
<?php foreach($this->msn as $v):?>
<?php
if($v['ty']=='boy')
{
	$t='info';
}
elseif($v['ty']=='girl')
{
	$t='important';
}
elseif($v['ty']=='gay')
{
	$t='inverse';
}
elseif($v['ty']=='lesbian')
{
	$t='warning';
}
else
{
	$t='ladyboy';
}
?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo time::show($v['da'],'date',true)?></td>
<td class="ty"><span class="label label-<?php echo $t?>"><?php echo $this->type[$v['ty']]?></span></td>
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>

<?php if($v['fd']&&$v['pt']):?> <a href="http://s3.boxza.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><span class="label">รูป</span></a><?php endif?> 
<?php if($v['cm']):?> <img src="http://s0.boxza.com/static/images/friend/cm.png" alt="มีกล้อง"><?php endif?> 
<?php if($v['fb']):?> <a href="https://www.facebook.com/<?php echo $v['fb']?>" rel="nofollow"><img src="http://s0.boxza.com/static/images/friend/fb.png" alt="Facebook"></a> <?php endif?> 
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><img src="http://s0.boxza.com/static/images/friend/tw.png" alt="Twitter"></a> <?php endif?>
<?php if($v['ln']):?><span class="label">Line: <?php echo $v['ln']?></span><?php endif?>
<?php if($v['in']):?><a href="http://boxza.com/<?php echo $v['in']?>" rel="nofollow"><span class="label">โปรไฟล์</span></a><?php endif?>
</td>
<td class="pr"><?php echo $this->province[$v['pr']]['name_th']?></td>
<td class="ag"><?php echo $v['ag']?'<span class="badge badge-'.$t.'">'.$v['ag'].'</span>':''?></td>
<td class="d"><button class="btn btn-mini" onClick="_.box.load('/report/<?php echo $v['_id']?> #report')">แจ้งลบ</button></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="6" style="height:100px; text-align:center; vertical-align:middle">ไม่มีข้อมูล</td></tr>
<?php endif?>
</tbody>
</table>

<div style="text-align:center"><?php echo $this->pager?></div>
</div>


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
