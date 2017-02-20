
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


<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/flash" title="เกมส์แฟลช เกมส์ flash"> เกมส์ flash</a></li>
</ul>
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div>
<ul class="gh thumbnails row-count-3">
<?php for($i=0;$i<12;$i++):$v=$this->flash[$i];?>
<li class="span4">
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endfor?>
</ul>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>

<div>
<ul class="gh thumbnails row-count-3">
<?php for($i=12;$i<count($this->flash);$i++):$v=$this->flash[$i];?>
<li class="span4">
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endfor?>
</ul>
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

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