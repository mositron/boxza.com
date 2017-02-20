
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>: 
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>-<?php echo $this->c?>/rss" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย RSS Feed"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>-<?php echo $this->c?>/json" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย JSON"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>-<?php echo $this->c?>/json/change_callback_function_here" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลข่าวแม่และเด็ก <?php echo $this->cate[$this->c]['t']?>โดย JSONP"></a>
</div>
</div>

<ul class="breadcrumb" style="margin:5px 0px;">
<li><a href="/" title="แม่และเด็ก"><i class="icon-home"></i> แม่และเด็ก</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->cate[$this->c]['l']?>" title="<?php echo $this->cate[$this->c]['tt']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
</ul>


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
</ul>
</div>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>
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
