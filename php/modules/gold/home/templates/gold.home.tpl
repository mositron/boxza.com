
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


<h1 class="gold-h1">ราคาทองคำแท่ง ทองคำรูปพรรณ ล่าสุดวันนี้</h1>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<h3 class="gold-h1">ราคาทองคำในประเทศไทย</h3>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ชนิดทอง</th>
<th class="l2">รับซื้อบาทละ</th>
<th class="l3">ขายบาทละ</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['thai']);$i++): $v=$this->msg['thai'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[2]?></td>
<td class="l3"><?php echo $v[3]?></td>
</tr>
<?php endfor?>
</tbody>
</table>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>

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

<h3 class="gold-h1">ราคาทองคำในต่างประเทศ</h3>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ทองคำ 99.99 และ 99.50%</th>
<th class="l2">ราคาเปิด</th>
<th class="l3">ราคาปิด</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['other']);$i++): $v=$this->msg['other'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[1]?></td>
<td class="l3"><?php echo $v[2]?></td>
</tr>
<?php endfor?>
</tbody>
</table>


<h3 class="gold-h1">กราฟราคาทองคำในต่างประเทศ</h3>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au0030lns.gif"> <img alt="" src="http://www.kitco.com/LFgif/au0060lns.gif"></p>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au0182nys.gif"> <img alt="" src="http://www.kitco.com/LFgif/au0365nys.gif"></p>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au1825nys.gif"><img alt="" src="http://www.kitco.com/LFgif/au3650nys.gif"></p>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

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

<div class="fb-comments" data-href="http://gold.boxza.com/" data-num-posts="50" data-width="720"></div>
