<div class="span8 col-content">

<style>
.tb tr td{ border-bottom:1px solid #f0f0f0;}
.tb tr.l1 td{background-color:#f8f8f8;}
.tb td,.tb th{background-color:#fff;}
.tb th{padding:5px; text-align:center;}
.tb .c{text-align:right; width:100px;}

.o{text-align:center}
.o img{box-shadow:5px 5px 0px #292929; margin:5px; padding:5px; border:1px solid #444; background-color:#111;}

.li-relate li{border-bottom:1px solid #f0f0f0; text-align:left; line-height:1.3em; padding:5px;}
.li-relate li a.t{ display:inline-block; height:50px;overflow:hidden; float:left; width:150px; color:#666;}
.li-relate li a img{float:left; margin:0px 5px 0px 0px}
.li-relate li p{clear:both}
.li-own li{ margin:5px; width:215px; float:left;  text-align:left; line-height:1.3em; height:50px; overflow:hidden;}
.li-own li a.t{ display:block; height:50px;overflow:hidden; float:left; width:132px; color:#666;}
.li-own li a img{float:left; margin:0px 5px 0px 0px}
.li-own li p{clear:both}
.table tr td.c{width:100px !important}

.wallp li{float:left; margin:5px 0px 5px 5px}
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


<ul class="breadcrumb">
<li><a href="/" title="หนัง หนังใหม่"><i class="icon-home"></i> หนัง</a></li>
<span class="divider">&raquo;</span>
 
 <li class="dropdown">
 <?php $purl=($this->t?'/t-'.$this->t:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c?$this->cate[$this->c]:'ทุกประเภท'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="<?php echo $purl?>">ทุกประเภท</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="/c-<?php echo $k.$purl?>"><?php echo $v?></a></li>
   <?php endforeach?>
  </ul>
 </li>
<span class="divider">&raquo;</span><li> <?php echo $this->movie['t']?></a> <?php echo $this->movie['t2']?' '.$this->movie['t2']:''?></li>
</ul>
<div style="line-height:1.8em; margin:5px 0px;">
<div style="padding:0px 5px;">
<div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<h3 style="padding:5px; margin:5px 0px"><a href="/<?php echo $this->movie['_id']?>-<?php echo $this->movie['l']?>.html"><?php echo $this->movie['t']?></a> <?php echo $this->movie['t2']?' '.$this->movie['t2']:''?> <?php if(_::$my['am']):?><span style="font-size:12px; font-weight:normal;"> (<a href="/admin/<?php echo $this->movie['_id']?>">แก้ไข</a>)<?php endif?></span></h3>
<table class="table">
<tbody>
<tr>
<td rowspan="7" style="width:150px"><img src="http://s3.boxza.com/movie/<?php echo $this->movie['fd']?>/m.jpg" width="150"></td>
<td class="c">ชื่อเรื่อง:</td>
<td><?php echo $this->movie['t']?></td>
</tr>
<tr><td class="c">ผู้กำกับ:</td><td><?php echo implode(', ',(array)$this->movie['dt'])?></td></tr>
<tr><td class="c">นักแสดงนำ:</td><td><?php echo implode(', ',(array)$this->movie['at'])?></td></tr>
<tr>
<td class="c">ประเภทหนัง:</td><td>
<?php for($i=0;$i<count($this->movie['c']);$i++):?>
<?php echo $i?', ':''?><a href="/c-<?php echo $this->movie['c'][$i]?>"><?php echo $this->cate[$this->movie['c'][$i]]?></a>
<?php endfor?>
</td>
</tr>
<tr><td class="c">ชนิดของหนัง:</td><td><a href="/t-<?php echo $this->movie['ty']?>"><?php echo $this->type[$this->movie['ty']]?></a></td></tr>
<tr><td class="c">วันที่เข้าฉาย:</td><td><?php echo $this->movie['tm']?time::show($this->movie['tm'],'date'):'เร็วๆนี้'?></td></tr>
<tr><td class="c">โรงที่ฉาย:</td><td>
<?php $cn=array('sf'=>'SF', 'mj'=>'Major');?>
<?php for($i=0;$i<count($this->movie['cn']);$i++):?>
<?php echo $i?', ':''?><?php echo $cn[$this->movie['cn'][$i]]?></a>
<?php endfor?>
</td></tr>
</tbody>
</table>

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

<h4 style="height:40px; line-height:40px; padding:0px 10px; border-bottom:1px dashed #ccc; border-top:1px solid #ccc; margin:5px 0px; font-size:18px;">รายละเอียด / เนื้อเรื่องย่อ</h4>
<div style="line-height:1.6em;"><?php echo nl2br($this->movie['d'])?></div>

<?php if(count($this->movie['v'])):?>
<h4 style="height:40px; line-height:40px; padding:0px 10px; border-bottom:1px dashed #ccc; border-top:1px solid #ccc; margin:5px 0px; font-size:18px;">ตัวอย่างหนัง</h4>
<?php for($i=0;$i<count($this->movie['v']);$i++):?>
<div style="margin:5px 0px 0px 10px">
<div class="flex-video widescreen"><iframe width="678" height="381" src="http://www.youtube.com/embed/<?php echo $this->movie['v'][$i]['yt']?>" frameborder="0" allowfullscreen></iframe></div>
<?php if($this->movie['v'][$i]['d']):?><div><?php echo $this->movie['v'][$i]['d']?></div><?php endif?>
</div>
<?php endfor?>
<?php endif?>

<?php if(count($this->movie['w1'])):?>
<h4 style="height:40px; line-height:40px; padding:0px 10px; border-bottom:1px dashed #333; border-top:1px solid #333; margin:5px 0px; font-size:18px; color:#ccc;">วอลเปเปอร์หนัง</h4>
<ul class="wallp">
<?php for($i=1;$i<=10;$i++):?>
<?php if($this->movie['w'.$i]):?>
<li><a href="http://s3.boxza.com/movie/<?php echo $this->movie['fd']?>/<?php echo $this->movie['w'.$i]?>" target="_blank"><img src="http://s3.boxza.com/movie/<?php echo $this->movie['fd']?>/s-<?php echo $this->movie['w'.$i]?>"></a></li>
<?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>
<?php endif?>

<div class="o">
<?php for($i=2;$i<=5;$i++):?>
<?php if($this->movie['o'.$i]):?>
<img src="http://s3.boxza.com/movie/<?php echo $this->movie['fd'].'/'.$this->movie['o'.$i]?>">
<?php endif?>
<?php endfor?>
</div>
<?php if(_::$meta['google']):?>
<div style="border:1px solid #ccc;padding:5px; margin:5px;">โดย <a href="https://plus.google.com/<?php echo _::$meta['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo _::$meta['google']['name']?></a> (Google+)</div>
<?php endif?>
 <div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/movie/'.$this->movie['fd'].'/'.$this->movie['o1'])?>&description=<?php echo urlencode($this->movie['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
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
    
<h4 style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://movie.boxza.com/<?php echo $this->movie['_id']?>-<?php echo $this->movie['l']?>.html" data-num-posts="30" data-width="700"></div>
</div>
</div>
</div>

<div class="span4 col-side">

<div class="ads-box">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="240" data-colorscheme="dark" data-height="270" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>

<h3 class="ns"><i></i> กำลังเข้าฉาย</h3>
<div class="movie2">
<ul style="margin:0px 0px 0px 5px">
<?php for($i=0;$i<count($this->show);$i++):?>
<?php $l='/'.$this->show[$i]['_id'].'-'.$this->show[$i]['l'].'.html';?>
<li class="l<?php echo $i?> ll<?php echo $i%4?>">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->show[$i]['fd']?>/m.jpg" alt="<?php echo $this->show[$i]['t']?> <?php echo $this->show[$i]['t2']?>"></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->show[$i]['t']?></a></p>
<p class="t2"><?php echo $this->show[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->show[$i]['tm']?time::show($this->show[$i]['tm'],'date'):'เร็วๆนี้'?></p>
<div>ประเภท: 
<?php for($j=0;$j<count($this->show[$i]['c']);$j++):?>
<?php echo $j?', ':''?><?php echo $this->cate[$this->show[$i]['c'][$j]]?>
<?php endfor?>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<h3 class="np"><i></i> โปรแกรมหน้า</h3>
<div class="movie2">
<ul style="margin:0px 0px 0px 5px">
<?php for($i=0;$i<count($this->soon);$i++):?>
<?php $l='/'.$this->soon[$i]['_id'].'-'.$this->soon[$i]['l'].'.html';?>
<li class="l<?php echo $i?> ll<?php echo $i%4?>">
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/movie/<?php echo $this->soon[$i]['fd']?>/m.jpg" alt="<?php echo $this->soon[$i]['t']?> <?php echo $this->soon[$i]['t2']?>"></a>
<p class="t"><a href="<?php echo $l?>"><?php echo $this->soon[$i]['t']?></a></p>
<p class="t2"><?php echo $this->soon[$i]['t2']?></p>
<p class="tm">เข้าฉาย: <?php echo $this->soon[$i]['tm']?time::show($this->soon[$i]['tm'],'date'):'เร็วๆนี้'?></p>
<div>ประเภท: 
<?php for($j=0;$j<count($this->soon[$i]['c']);$j++):?>
<?php echo $j?', ':''?><?php echo $this->cate[$this->soon[$i]['c'][$j]]?>
<?php endfor?>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

</div>
