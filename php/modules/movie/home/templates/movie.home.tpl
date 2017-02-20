<div class="span8 col-content">

<div class="nsw">
<h3 class="hd-n" style="margin-bottom:5px;">หนังใหม่<small>(หนัง หนังใหม่น่าติดตาม)</small></h3>
<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<h4 class="hd-m"><a href="/<?php echo $this->recommend['_id'].'-'.$this->recommend['l']?>.html"><?php echo $this->recommend['t']?></a> <small><?php echo $this->recommend['t2']?></small></h4>
<div>
<div class="span4 text-center">
<a href="/<?php echo $this->recommend['_id'].'-'.$this->recommend['l']?>.html" title="<?php echo $this->recommend['t']?> <?php echo $this->recommend['t2']?>"><img src="http://s3.boxza.com/movie/<?php echo $this->recommend['fd']?>/l.jpg"></a>
</div>
<div class="span8">
<p>เข้าฉาย: <?php echo time::show($this->recommend['tm'],'date')?></p>
<div class="flex-video widescreen" style="margin-bottom:5px"><iframe width="420" height="236" src="//www.youtube.com/embed/<?php echo $this->recommend['v'][0]['yt']?>" frameborder="0" allowfullscreen></iframe></div>
</div>
</div>
<div class="nsw-d"><?php echo mb_substr($this->recommend['d'],0,230,'utf-8')?>... (<a href="/<?php echo $this->recommend['_id'].'-'.$this->recommend['l']?>.html" target="_blank">อ่านต่อ</a>)</div>
</div>

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

<h3 class="hd-a"><a href="/news" title="ข่าวหนัง ข่าวภาพยนตร์">ข่าวหนัง</a></h3>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>

<div style="margin:5px 0px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<h3 class="hd-a"><a href="/z-now-showing" title="หนังใหม่ หนังกำลังฉาย">หนังใหม่</a></h3>
<div class="movie-pt">
<ul class="thumbnails row-count-3">
<?php for($i=0;$i<count($this->show);$i++):?>
<?php $l='/'.$this->show[$i]['_id'].'-'.$this->show[$i]['l'].'.html';?>
<li class="span4">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->show[$i]['fd']?>/m.jpg" alt="<?php echo $this->show[$i]['t']?> <?php echo $this->show[$i]['t2']?>"></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->show[$i]['t']?></a></p>
<p class="t2"><?php echo $this->show[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->show[$i]['tm']?time::show($this->show[$i]['tm'],'date'):'เร็วๆนี้'?></p>
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

<h3 class="np"><i></i> <a href="/z-coming-soon">หนังโปรแกรมหน้า</a></h3>
<div class="movie-pt">
<ul class="thumbnails row-count-3">
<?php for($i=0;$i<count($this->soon);$i++):?>
<?php $l='/'.$this->soon[$i]['_id'].'-'.$this->soon[$i]['l'].'.html';?>
<li class="span4">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->soon[$i]['fd']?>/m.jpg" alt="<?php echo $this->soon[$i]['t']?> <?php echo $this->soon[$i]['t2']?>"></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->soon[$i]['t']?></a></p>
<p class="t2"><?php echo $this->soon[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->soon[$i]['tm']?time::show($this->soon[$i]['tm'],'date'):'เร็วๆนี้'?></p>
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

</div>
<div class="span4 col-side">
<!--nipa-->
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="245" data-height="270" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="margin-bottom:5px;"></div>

<h3 class="bx"><i></i> อันดับหนังทำเงิน Box Office</h3>
<div class="movie2">
<ul>
<?php for($i=0;$i<count($this->box);$i++):?>
<?php $l='/'.$this->box[$i]['_id'].'-'.$this->box[$i]['l'].'.html';?>
<li class="l<?php echo $i?> ll<?php echo $i%4?>">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->box[$i]['fd']?>/m.jpg" alt="<?php echo $this->box[$i]['t']?> <?php echo $this->box[$i]['t2']?>"><i><?php echo $this->box[$i]['bx']?></i></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->box[$i]['t']?></a></p>
<p class="t2"><?php echo $this->box[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->box[$i]['tm']?time::show($this->box[$i]['tm'],'date'):'เร็วๆนี้'?></p>
<div>ประเภท: 
<?php for($j=0;$j<count($this->box[$i]['c']);$j++):?>
<?php echo $j?', ':''?><?php echo $this->cate[$this->box[$i]['c'][$j]]?>
<?php endfor?>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<!--h3 class="wl"><i></i> Download Wallpaper</h3>
<ul class="wall">
<?php for($i=0;$i<count($this->wall);$i++):?>
<li>
<a href="http://s3.boxza.com/movie/<?php echo $this->wall[$i]['fd']?>/<?php echo $this->wall[$i]['w1']?>" target="_blank"><img src="http://s3.boxza.com/movie/<?php echo $this->wall[$i]['fd']?>/s-<?php echo $this->wall[$i]['w1']?>" alt="<?php echo $this->wall[$i]['t']?>"></a>
<?php echo $this->wall[$i]['t']?>
</li>
<?php endfor?>
<p class="clear"></p>
</ul-->


<?php echo $this->service?>

</div>

