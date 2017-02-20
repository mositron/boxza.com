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


<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="หนัง หนังใหม่"><i class="icon-home"></i> หนัง</a></li>
<span class="divider">&raquo;</span>
<?php if($this->z):?>
<li><a href="/z-<?php echo $this->z?>" title="<?php echo $this->zone[$this->z]?>"><?php echo $this->zone[$this->z]?></a></li>
<span class="divider">&raquo;</span>
<?php endif?>
 <li class="dropdown">
 <?php $jurl=($this->z?'/z-'.$this->z:'');$purl=($this->t?'/t-'.$this->t:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c?$this->cate[$this->c]:'ทุกประเภท'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="<?php echo $jurl.$purl?>">ทุกประเภท</a><?php elseif($jurl):?><a href="<?php echo $jurl?>"><?php echo $this->zone[$this->z]?></a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="<?php echo $jurl.'/c-'.$k.$purl?>"><?php echo $v?></a></li>
   <?php endforeach?>
  </ul>
 </li>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<?php $turl=($this->z?'/z-'.$this->z:'').'/'.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li<?php echo !$this->t?' class="active"':''?>><a href="<?php echo $turl?>">ทุกชนิด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li<?php echo $this->t==$k?' class="active"':''?>><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>


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

<div class="movie-pt">
<ul class="thumbnails row-count-3">
<?php for($i=0;$i<count($this->last);$i++):?>
<?php $l='/'.$this->last[$i]['_id'].'-'.$this->last[$i]['l'].'.html';?>
<li class="span4">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->last[$i]['fd']?>/m.jpg" alt="<?php echo $this->last[$i]['t']?> <?php echo $this->last[$i]['t2']?>"></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->last[$i]['t']?></a></p>
<p class="t2"><?php echo $this->last[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->last[$i]['tm']?time::show($this->last[$i]['tm'],'date'):'เร็วๆนี้'?></p>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>

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

