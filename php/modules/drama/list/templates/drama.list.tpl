
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

<ul class="breadcrumb" style="margin:0px 0px 5px;">
<li><a href="/" title="ละคร ละครวันนี้"><i class="icon-home"></i> ละคร</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->cate[$this->c]['l']?>" title="<?php echo $this->cate[$this->c]['t']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-3">
<?php for($i=0;$i<min(20,count($this->drama));$i++): $v=$this->drama[$i];?>
<li class="span4">
<a href="/<?php echo $v['lk']?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/drama/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=min(20,count($this->drama));$i<min(40,count($this->drama));$i++):$v=$this->drama[$i];?>
<li class="span3">
<a href="/<?php echo $v['lk']?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/drama/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
<p class="clear"></p>
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

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=min(40,count($this->drama));$i<count($this->drama);$i++):$v=$this->drama[$i];?>
<li class="span3">
<a href="/<?php echo $v['lk']?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/drama/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>

<div style="text-align:center"><?php echo $this->pager?></div>
