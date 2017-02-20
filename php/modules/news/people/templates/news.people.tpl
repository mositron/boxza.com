
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

<ul class="breadcrumb" style="margin:0px;">
<li><a href="/" title="ข่าว ข่าววันนี้"><i class="icon-home"></i> ข่าว</a></li>
<span class="divider">&raquo;</span>
<li><a href="/people/<?php echo $this->people['lk']?>" title="ข่าว <?php echo $this->name?> ล่าสุด ข่าว <?php echo $this->name?> วันนี้">ข่าว  <?php echo $this->name?> ล่าสุดวันนี้</a></li>
</ul>

<div style="padding:5px; margin:5px 0px;">
ข่าว <?php echo $this->name?> ล่าสุด,  ข่าว <?php echo $this->name?> วันนี้,  ข่าว <?php echo $this->name?> ล่าสุดวันนี้,  ข่าว <?php echo $this->name?> วันที่ <?php echo time::show(new mongodate(),'date')?>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<min(20,count($this->news));$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
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


<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=min(20,count($this->news));$i<min(40,count($this->news));$i++):$v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
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
<?php for($i=min(40,count($this->news));$i<count($this->news);$i++):$v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>

<div style="text-align:center"><?php echo $this->pager?></div>

<?php $url='http://news.boxza.com/people/'.$this->people['lk']?>
<div class="socialshare">
<div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/BoxzaNetwork" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
<div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
<div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo $url?>"></div><!--g:plusone size="medium" count="true" href="<?php echo $url?>"></g:plusone--></div>
<div><fb:like href="<?php echo $url?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $url?>" data-lang="th" data-hashtags="boxza" rel="nofollow">ทวีต</a></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<p></p>
</div>


<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f9f9f9;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="<?php echo $url?>" data-num-posts="10" data-width="620"></div>