<style>
.tb tr td{ border-bottom:1px solid #f0f0f0;}
.tb tr.l1 td{background-color:#f8f8f8;}
.tb td,.tb th{background-color:#fff;}
.tb th{padding:5px; text-align:center;}
.tb .c{text-align:right; width:100px;}

.o{text-align:center}
.o img{box-shadow:5px 5px 0px #eee; margin:5px; padding:5px; border:1px solid #ccc; background-color:#fff;}

.li-relate li{border-bottom:1px solid #f0f0f0; text-align:left; line-height:1.3em; padding:5px;}
.li-relate li a.t{ display:inline-block; height:50px;overflow:hidden; float:left; width:150px; color:#666;}
.li-relate li a img{float:left; margin:0px 5px 0px 0px}
.li-relate li p{clear:both}
.li-own li{ margin:5px; width:215px; float:left;  text-align:left; line-height:1.3em; height:50px; overflow:hidden;}
.li-own li a.t{ display:block; height:50px;overflow:hidden; float:left; width:132px; color:#666;}
.li-own li a img{float:left; margin:0px 5px 0px 0px}
.li-own li p{clear:both}
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
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/flash" title="เกมส์ flash"> เกมส์ flash</a></li>
<span class="divider">&raquo;</span>
<li><a href="/flash/c-<?php echo $this->game['c'][0]?>" title="เกมส์<?php echo $this->cate[$this->game['c'][0]]['t']?>">เกมส์<?php echo $this->cate[$this->game['c'][0]]['t']?></a></li>
<span class="divider">&raquo;</span> <li> เกมส์ <?php echo $this->game['t']?> <?php echo $this->game['t2']?' (เกมส์'.$this->game['t2'].')':''?></li>
</ul>
<div style="line-height:1.8em; margin:5px 0px;">
<div>
<h3 style="padding:5px; margin:5px 0px">เกมส์ <?php echo $this->game['t']?> <?php echo $this->game['t2']?' (เกมส์'.$this->game['t2'].')':''?> <?php if(_::$my['am']):?><span style="font-size:12px; font-weight:normal;"> (<a href="/admin/<?php echo $this->game['_id']?>">แก้ไข</a><?php endif?>)</span></h3>


<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<?php $w=628?>
<?php $h=intval($w*($this->game['swf']['h']/$this->game['swf']['w']))?>
<div style="margin:5px 0px">
<object width="<?php echo $w?>" height="<?php echo $h?>">
<param name="movie" value="http://s3.boxza.com/game/flash/<?php echo $this->game['fd']?>/<?php echo $this->game['swf']['n']?>"></param>
<param name="allowFullScreen" value="true"></param>
<param name="allowscriptaccess" value="always"></param>
<embed src="http://s3.boxza.com/game/flash/<?php echo $this->game['fd']?>/<?php echo $this->game['swf']['n']?>" type="application/x-shockwave-flash" width="<?php echo $w?>" height="<?php echo $h?>" allowscriptaccess="always" allowfullscreen="true"></embed>
</object>
</div>
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

<h4>ประเภทเกมส์</h4>
<div style="line-height:1.6em;padding:5px;">
<?php for($i=0;$i<count($this->game['c']);$i++):?>
<?php if($i):?>, <?php endif?> <a href="/flash/c-<?php echo $this->game['c'][$i]?>"><?php echo $this->cate[$this->game['c'][$i]]['t']?></a>
<?php endfor?>
</div>
<h4>รายละเอียด</h4>
<div style="line-height:1.6em; padding:5px;"><?php echo nl2br($this->game['d'])?></div>
<h4>วิธีการเล่น</h4>
<div style="line-height:1.6em;padding:5px;"><?php echo nl2br($this->game['h'])?></div>

<div class="o">
<?php for($i=2;$i<=5;$i++):?>
<?php if($this->game['o'.$i]):?>
<img src="http://s3.boxza.com/game/<?php echo $this->game['fd'].'/'.$this->game['o'.$i]?>">
<?php endif?>
<?php endfor?>
</div>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/game/'.$this->game['fd'].'/'.$this->game['o1'])?>&description=<?php echo urlencode($this->game['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>

<?php if($this->flash):?>
<h4 style="margin:10px 0px 0px 0px; padding:5px; background:#f5f5f5;">เกมส์อื่นๆที่ใกล้เคียง</h4>
<div>
<ul class="gh">
<?php foreach($this->flash as $k=>$v):?>
<li>
<a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t']?>" class="i"><img src="http://s3.boxza.com/game/flash/<?php echo $v['fd']?>/l.jpg" alt="เกมส์<?php echo $v['t']?>" title="เกมส์<?php echo $v['t']?>"></a>
<p class="t"><a href="/flash/<?php echo $v['_id']?>-<?php echo $v['l']?>.html" title="เกมส์<?php echo $v['t2'].' '.$v['t']?>"><?php echo $v['t']?></a></p>
<p>เกมส์<?php echo $v['t2']?></p>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>


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

<h4 style="margin:5px 0px 0px 0px; padding:5px; background:#f5f5f5;">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://game.boxza.com/flash/<?php echo $this->game['_id']?>" data-num-posts="30" data-width="775"></div>


</div>
