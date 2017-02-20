<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="ตรวจหวย"><i class="icon-home"></i> ตรวจหวย</a></li>
<span class="divider">&raquo;</span>
<li class="active"><a href="/list" title="ตรวจหวยย้อนหลัง"><i class="icon-list"></i> ตรวจหวยย้อนหลัง</a></li>
</ul>

<!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="margin:0px 0px 5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; margin-bottom:5px">ตรวจหวย สลากกินแบ่งรัฐบาลย้อนหลัง</h3>
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div class="lotto-list">
<?php for($i=0;$i<count($this->lotto);$i++):?>
<h4> + <a href="<?php echo '/'.$this->lotto[$i]['_id'].'-'.$this->lotto[$i]['l'].'.html'?>">ตรวจหวย งวดวันที่ <?php echo time::show($this->lotto[$i]['tm'],'date')?></a></h4>
<table class="table lotto">
<tbody>
<tr>
<td>
<strong>รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->lotto[$i]['a1']?></span></div>
<p>รางวัลละ 2,000,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo implode('</span><span>',$this->lotto[$i]['l3'])?></span></div>
<p>รางวัลละ 2,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[$i]['l2']?></span></div>
<p>รางวัลละ 1,000 บาท</p>
</td>
</tr>
</table>
<?php if($i==2):?>
<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
<?php elseif($i==5):?>
<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>
<?php endif?>
<?php endfor?>

</div>

<div style="text-align:center"><?php echo $this->pager?></div>

