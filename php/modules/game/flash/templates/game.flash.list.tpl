<style>
.game-flash li{ float:left; width:230px; margin:2px 0px 2px 4px;}
.game-flash li .t{white-space:nowrap; height:16px; line-height:16px;text-overflow:ellipsis; overflow:hidden; width:140px;}
.game-flash li .i{float: left; margin-right:5px; display:block; width:79px; height:60px;}
.game-flash li .i img{ height:60px;}
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

<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/flash" title="เกมส์ flash"> เกมส์ flash</a></li>
<?php if($this->c):?><span class="divider">&raquo;</span> <li><a href="/flash/c-<?php echo $this->c?>" title="เกมส์<?php echo $this->cate[$this->c]['t']?>">เกมส์<?php echo $this->cate[$this->c]['t']?></a></li><?php endif?>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div>
<ul class="gh thumbnails row-count-3">
<?php $i=0;foreach($this->flash as $k=>$v):?>
<li class="span4">
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php $i++;endforeach?>
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

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div style="text-align:center"><?php echo $this->pager?></div>


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