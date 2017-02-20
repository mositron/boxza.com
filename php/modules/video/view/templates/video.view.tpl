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

#getplaylist > div{border:1px solid #eee;}
#getplaylist > div > div{margin:5px;}
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
<li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
<span class="divider">&raquo;</span>
 
<?php $curl = '/';?>

<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 <?php if($this->c1):?>
    <?php echo $this->cate[$this->c1]['n']['t']?>
<?php else:?>
วิดีโอทุกหมวด
<?php endif?>
<b class="caret"></b></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>">วิดีโอทุกหมวด</a></li>
   <li class="divider"></li>
   <?php foreach($this->cate as $k=>$v):?>
   <li><a href="<?php echo $curl?>c-<?php echo $k?>"><?php echo $v['n']['t']?></a></li>
   <?php endforeach?>
</ul>
</li>

<?php if($this->c1):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c2?$this->cate[$this->c1]['l'][$this->c2]['n']['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $this->c1?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
   <?php if(is_array($this->cate[$this->c1]['l'])):?>
 <?php foreach($this->cate[$this->c1]['l'] as $j):?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['n']['_id']?>"><?php echo $j['n']['t']?></a></li>
   <?php endforeach?>
   <?php endif?>
  </ul>
 </li>
<?php if(($c2=$this->cate[$this->c1]['l'][$this->c2]) && (count($c2['l']))):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->c3?$c2['l'][$this->c3]['n']['t']:'ทุกหมวดย่อย'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="<?php echo $curl?>c-<?php echo $this->c2?>">ทุกหมวดย่อย</a></li>
   <li class="divider"></li>
 <?php foreach($c2['l'] as $j):?>
   <li><a href="<?php echo $curl?>c-<?php echo $j['n']['_id']?>"><?php echo $j['n']['t']?></a></li>
   <?php endforeach?>
  </ul>
 </li>
 <?php endif?>
 <?php endif?>
 <span class="divider">&raquo;</span><li> <?php echo $this->video['t']?></li>
</ul> 
<h3 style="padding:5px; margin:5px 0px"><?php echo $this->video['t']?><?php if(_::$my['am']):?><small>(<a href="/update/<?php echo $this->video['_id']?>">แก้ไข</a>)</small><?php endif?></h3>


<div style="margin:0px 0px 5px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div class="flex-video widescreen"><div id="player"></div></div>
<script>
var tag = document.createElement('script');
tag.src = "http://www.youtube.com/player_api?enablejsapi=1&version=3";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
function onYouTubePlayerAPIReady() {
  player = new YT.Player('player', {
    height: '<?php echo intval(720*($this->video['w']?9/16:3/4))?>',
    width: '628',
    videoId: '<?php echo $this->video['yt']?>',
    playerVars: { 'autoplay': 1, 'controls': 1, 'autohide':1 },
    events: {
    //  'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}
function onPlayerReady(event) {
  event.target.playVideo();
}
function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.ENDED) {
	  <?php if($this->next):?>
	  window.location.href='<?php echo $this->next['link']?>';
		<?php endif?>
  }
}
function stopVideo() {
  player.stopVideo();
}
</script>

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

<div style="padding:5px; background-color:#333; text-shadow:1px 1px 0px #000;">
<div class="left"><span class="btn" onClick="_.ajax.gourl('<?php echo URL?>','getplaylist')"><i class="icon-list-alt"></i> เพิ่มเข้าเพลย์ลิส</span></div>
<div class="right" style="line-height:22px;">ความยาววิดีโอ: <?php echo video_duration($this->video['dr'])?> , ดู <strong style="font-size:24px"><?php echo number_format(intval($this->video['do'])+1)?></strong> ครั้ง</div>
<div class="clear"></div>
</div>
<div id="getplaylist"></div>
 
<div style="padding:5px; margin:5px 0px; background-color:#333;"><?php echo nl2br($this->video['m'])?></div>
<?php if(_::$meta['google']):?>
<div style="border:1px solid #333; padding:5px; margin:5px;">
<p>โดย <a href="https://plus.google.com/<?php echo _::$meta['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo _::$meta['google']['name']?></a> (Google+)</p>
</div>
<?php endif?>
<?php if($this->video['tags']):?>
<ul class="tags-relate">
<li class="tags-label">ป้ายกำกับ:</li>
<?php foreach($this->video['tags'] as $v):?>
<li>#<a href="http://boxza.com/tag/<?php echo urlencode($v)?>" target="_blank"><?php echo $v?></a></li>
<?php endforeach?>
</ul>
<?php endif?>

<?php if($this->playlist):?>
 <div style="margin:5px 0px; border:1px solid #333; background-color:#555; padding:10px;">
 <h4>เพลย์ลิส <a href="/playlist/<?php echo $this->playlist['_id']?>-<?php echo $this->playlist['l']?>.html"><?php echo $this->playlist['t']?></a></h4>
 <?php if($this->prev):?>
 <p style="margin-top:5px">วิดีโอก่อนหน้านี้: <a href="<?php echo $this->prev['link']?>"><?php echo $this->prev['title']?></a></p>
<?php endif?>
 <?php if($this->next):?>
 <p style="margin-top:5px">วิดีโอถัดไป: <a href="<?php echo $this->next['link']?>"><?php echo $this->next['title']?></a></p>
 <?php endif?>
 
 </div>
 <?php endif?>
<div class="socialshare">
<div><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(URI)?>&media=<?php echo urlencode('http://s3.boxza.com/video/'.$this->video['f'].'/'.$this->video['n'])?>&description=<?php echo urlencode($this->video['t'])?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>
    
    
<div style="line-height:1.8em; margin:5px 0px; border:1px solid #333;">
<div style="background-color:#444; padding:5px;">
<h5>แนะนำโดย <a href="http://boxza.com/<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a></h5>
<div style="line-height:1.6em;"><?php echo nl2br($this->video['d'])?></div>
</div>
</div>


<div class="video-cate" style="margin:5px 0px;">
<h4>คลิปวิดีโอใกล้เคียง</h4>
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->relate);$i++):?>
<?php $l='/view/'.$this->relate[$i]['_id'];?>
<li class="span3">
<a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->relate[$i]['f']?>/<?php echo $this->relate[$i]['n']?>"><span><?php echo video_duration($this->relate[$i]['dr'])?></span></a>
<p><a href="<?php echo $l?>"><?php echo $this->relate[$i]['t']?></a></p>
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

<h4 style="padding:5px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="http://video.boxza.com/view/<?php echo $this->video['_id']?>" data-colorscheme="dark" data-num-posts="30" data-width="718"></div>
