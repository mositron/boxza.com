
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

<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลข่าว ข่าววันนี้: 
<a href="http://feed.boxza.com/news/rss" title="บริการข้อมูลข่าว ข่าววันนี้ โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลข่าว ข่าววันนี้ โดย RSS Feed"></a>
<a href="http://feed.boxza.com/news/json" title="บริการข้อมูลข่าว ข่าววันนี้ โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลข่าว ข่าววันนี้ โดย JSON"></a>
<a href="http://feed.boxza.com/news/json/change_callback_function_here" title="บริการข้อมูลข่าว ข่าววันนี้ โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลข่าว ข่าววันนี้ โดย JSONP"></a>
</div>
</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="row-fluid">
<div class="bcd bcd-left span9">
<h3><i class="i1"></i> ข่าว ข่าววันนี้ <i class="i2"></i> <small style="color:#fff;">ข่าว ข่าวด่วน ข่าวสด ข่าวทั่วไทย</small></h3>
<div class="row-fluid">
<ul class="thumbnails row-count-3">
<?php for($i=0;$i<12;$i++): $v=$this->news[$i];?>
<?php if($i<1):?>
<li class="span8">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail i1">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><strong><?php echo $v['t']?> <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></strong></p>
</a>
</li>
<?php else:?>
<li class="span4">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endif?>
<?php endfor?>
</ul>
</div>
</div>
<div class="bcd bcd-right span3">
<h3><i class="i1" title="5 อันดับข่าว ข่าวเด่น"></i> ข่าวเด่น <i class="i2"></i></h3>
<ul class="thumbnails">
<?php for($i=0;$i<5;$i++): $v=$this->news_rc[$i];?>
<li>
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
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

<div class="bcd">
<h3><i class="i1"></i> บุคคลเป็นข่าวล่าสุด <i class="i2"></i> <small>ข่าวเกี่ยวกับดารา ข่าวเกี่ยวกับบุคคลล่าสุด</small></h3>
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

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>

<div class="bcd bcd-hot row-fluid">
<h3><i class="i1"></i> ข่าวร้อนประเด็นฮิต <i class="i2"></i> <small>ข่าว ข่าวตามกระแส ข่าวเด่นประเด็นร้อน ข่าวทั่วทุกมุมโลก</small></h3>
<ul class="thumbnails row-count-4">
<?php for($i=5;$i<count($this->news_rc);$i++): $v=$this->news_rc[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
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

<div class="bcd bcd-all row-fluid">
<h3>ข่าว รวมข่าวทั้งหมด</h3>
<ul class="thumbnails row-count-4">
<?php for($i=12;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?>  <?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>



 
<ul class="nav nav-pills">
<li class="disabled"><a href="#">ข่าวเพิ่มเติม: </a></li>
<?php foreach($this->cate as $k=>$v): if($v['sub'])continue;?>
<li><a href="<?php echo ($v['sl']?$v['sl']:'/'.$v['l'])?>" title="ข่าว<?php echo $v['t']?>"<?php echo $v['l']==_::$path[0]?' class="active"':''?>><?php echo $v['t']?></a></li>
<?php endforeach?>
</ul>