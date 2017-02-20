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
<li><a href="/" title="กลิตเตอร์ Glitter"><i class="icon-home"></i> กลิตเตอร์</a></li>

<?php $p=$this->cate[$this->c]['p'];?>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$p]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์">แสดงอารมณ์</a></li>
   <li><a href="/c-41" title="กลิตเตอร์ทักทาย">ทักทาย</a></li>
   <li><a href="/c-71" title="กลิตเตอร์เทศกาล">เทศกาล</a></li>
   <li><a href="/c-91" title="กลิตเตอร์อื่นๆ">กลิตเตอร์อื่นๆ</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-<?php echo $p?>"><?php echo $this->cate[$p]['t']?>ทั้งหมด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->cate[$p]['l']);$i++):?>
 <?php $j=$this->cate[$p]['l'][$i];?>
   <li><a href="/c-<?php echo $j?>"><?php echo $this->cate[$j]['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <span class="divider">&raquo;</span><li> รายละเอียด</li>
</ul> 
<h3 style="padding:5px; margin:5px 0px"><?php echo $this->glitter['t']?></h3>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div style="margin-top:5px">
<div style="width:510px; padding:5px 0px; float:left; background:#fff; border:1px solid #ccc; text-align:center; margin:0px 0px 5px 0px; line-height:0px;">
<img src="http://s3.boxza.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>" alt="<?php echo ($this->glitter['t'])?>">
</div>
<div style="width:190px; float:right">
<ul>
<li>ดาวน์โหลด: <?php echo number_format(intval($this->glitter['do']))?> ครั้ง</li>

<?php if(_::$meta['google']):?>
<li>โดย: <a href="https://plus.google.com/<?php echo _::$meta['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo _::$meta['google']['name']?></a> (Google+)</li>
<?php endif?>
<li>อัพโหลดโดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank"><?php echo $this->user['name']?></a></li>
<li>เมื่อ: <?php echo time::show($this->glitter['da'],'date')?></li>
<li>ประเภท: 
<?php $tags='glitter';?>
<?php $i=0;foreach((array)$this->glitter['c'] as $v):?>
<?php if($i):?>, <?php endif?><a href="/c-<?php echo $v?>"><?php echo $this->cate[$v]['t']?></a>
<?php $tags.=', '.$this->cate[$v]['t'];?>
<?php $i++;endforeach?>
</li>
<li style="margin:5px 0px"><?php echo nl2br($this->glitter['t'])?></li>
<?php if($this->glitter['zp']):?><li style="margin-bottom:5px;"><a href="/download/<?php echo $this->glitter['_id']?>" rel="nofollow" class="btn btn-warning">     ดาวน์โหลด     </a></li><?php endif?>
<?php if(_::$my['am']):?><li><span class="btn" onClick="_.ajax.gourl('<?php echo URL?>','recommend')">ตั้งเป็นกลิตเตอร์แนะนำ</span></li><?php endif?>
<?php if((_::$my['am']>=9) || (_::$my['_id']==$this->glitter['u'])):?><li style="margin:5px 0px 0px 0px"><a href="/update/<?php echo $this->glitter['_id']?>" class="btn">แก้ไขกลิตเตอร์นี้</a></li><?php endif?>
</ul>
</div>
<p class="clear"></p>
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/glitter/'.$this->glitter['fd'].'/t.'.$this->glitter['ty'])?>&description=<?php echo urlencode($this->glitter['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank"  rel="nofollow">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<div><a href="http://boxza.com/share?url=<?php echo urlencode(URI)?>&title=<?php echo urlencode($this->glitter['t'])?>&tags=<?php echo urlencode($tags)?>" target="_blank" style="border: 1px solid #D0D0D0;background: white;display: inline-block;height: 18px;line-height: 18px;padding: 0px 20px;border-radius: 5px;color: black;font-size: 12px;">ไลน์</a></div>
<p></p>
</div>
    
    <div style="padding:5px; border:1px solid #ddd; background:#fff; border-radius:5px;">
    Copy โค้ด กลิตเตอร์ ในช่องนี้ไปใส่ใน Hi5, myspace, forum, เว็บบอร์ดได้เลยจ้า<br>
    <strong>แบบ HTML</strong><br>
    <textarea class="tbox" style="width:698px; height:50px"><a href="http://glitter.boxza.com/<?php echo $this->glitter['_id']?>.html" title="กลิตเตอร์ Glitter"><img src="http://s3.boxza.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>" alt="กลิตเตอร์ Glitter"></a></textarea>
	<strong>แบบ BBCode</strong> (เว็บบอร์ด หรือ forum)<br>
    <textarea class="tbox" style="width:698px; height:30px">[url=http://glitter.boxza.com/<?php echo $this->glitter['_id']?>.html][img]http://s3.boxza.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>[/img][/url]</textarea>
    </div>
    
<h4 style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://glitter.boxza.com/<?php echo $this->glitter['_id']?>" data-num-posts="30" data-width="710"></div>






<div class="gl-new">
<h3>กลิตเตอร์ใกล้เคียง</h3>
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->relate);$i++):?>
<?php $l='/'.$this->relate[$i]['_id'].'.html';?>
<li class="span3">
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/glitter/<?php echo $this->relate[$i]['fd']?>/t.<?php echo $this->relate[$i]['ty']?>">
</a>
<p><?php echo $this->relate[$i]['t']?></p>
</li>
<?php endfor?>
</ul>
</div>


