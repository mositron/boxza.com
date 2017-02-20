
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

<div class="bcd">
<h3 style="margin-bottom:5px"><i class="i1"></i> ละคร เรื่องย่อละคร <i class="i2"></i> <small style="color:#fff;">ละคร ละครใหม่ เรื่องย่อละคร ดูละครย้อนหลัง</small></h3>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<ul class="thumbnails row-count-3">
<?php for($i=0;$i<12;$i++): $v=$this->drama[$i];?>
<li class="span4">
<a href="/<?php echo $v['lk']?>" target="_blank" class="thumbnail" title="<?php echo $v['t']?> ละคร<?php echo $v['t']?> เรื่องย่อละคร<?php echo $v['t']?>">
<img src="http://s3.boxza.com/drama/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
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

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<div class="bcd">
<ul class="thumbnails row-count-3">
<?php for($i=12;$i<count($this->drama);$i++): $v=$this->drama[$i];?>
<li class="span4">
<a href="/<?php echo $v['lk']?>" target="_blank" class="thumbnail" title="<?php echo $v['t']?> ละคร<?php echo $v['t']?> เรื่องย่อละคร<?php echo $v['t']?>">
<img src="http://s3.boxza.com/drama/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
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

