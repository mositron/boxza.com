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


<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลการเมือง: 
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/rss" title="บริการข้อมูลการเมือง โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลการเมือง โดย RSS Feed"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/json" title="บริการข้อมูลการเมือง โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลการเมือง โดย JSON"></a>
<a href="http://feed.boxza.com/news-<?php echo NEWS_CATE?>/json/change_callback_function_here" title="บริการข้อมูลการเมือง โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลการเมือง โดย JSONP"></a>
</div>
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


<div class="bcd">
<h3><i class="i1"></i> ข่าวนักการเมือง <i class="i2"></i> <small>ข่าวนักการเมืองล่าสุด ข่าวนักการเมืองวันนี้</small></h3>
<ul class="thumbnails row-count-4">
<?php foreach($this->people as $v):

$hot=($v['n']?$v['n'].' ('.trim($v['nn'].' '.$v['fn'].' '.$v['ln']).')':trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
$hname=($v['n']?$v['n']:trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
?>
<li class="span3">
<a href="/people/<?php echo $v['lk']?>" title="ข่าว <?php echo $hot?> ล่าสุด" target="_blank" class="thumbnail text-center">
<img src="http://s3.boxza.com/people/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $hot?>">
<p><?php echo $hname?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>

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