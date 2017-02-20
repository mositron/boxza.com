
<?php 
$radio = $this->radio[$this->id];
?>
<style>
.rd{margin:0px}
.rd li a{display:block; height:26px; line-height:26px; border-bottom:1px dashed #ccc; color:#666; text-indent:5px; font-size:12px; overflow:hidden;}
.rd li a:hover{background:#f0f0f0}
</style>

<ul class="breadcrumb">
<li><a href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์"><i class="icon-home"></i> ฟังเพลง</a></li>
<span class="divider">&raquo;</span>
<li><?php echo $radio['t']?> ฟังเพลง <?php echo $radio['t']?>  ฟังเพลงออนไลน์ <?php echo $radio['t']?></li>
</ul>

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


<div class="row-fluid">
<div class="span3">
<div>

<ul class="rd">
<?php foreach($this->radio as $k=>$v):?>
<li><a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังวิทยุออนไลน์ <?php echo $v['t']?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>
<div class="span9">
<h1 class="news-h1"><?php echo $radio['t']?></h1>
<p>ฟังเพลง<?php echo $radio['t']?>  ฟังเพลงออนไลน์<?php echo $radio['t']?>  ฟังวิทยุออนไลน์<?php echo $radio['t']?></p>
<div class="row-fluid">
<div class="span3  text-center">
<img src="http://s0.boxza.com/static/images/radio/<?php echo $radio['im']?>" alt="<?php echo $radio['t']?>">
</div>
<div class="span9 text-center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BoxZa - 336x280 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-8383574629063856"
     data-ad-slot="7879089727"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
<h3>ฟังเพลง <?php echo $radio['t']?> <small>ฟังเพลงออนไลน์ <?php echo $radio['t']?> ฟังวิทยุออนไลน์ <?php echo $radio['t']?></small></h3>

<div style="margin:10px 0px">
<?php
if($radio['ty']=='flash'):
?>
  <script type='text/javascript' src='http://s0.boxza.com/static/js/jwplayer/jwplayer.js'></script>
  <div id='mediaspace'>กรุณารอซํกครู่</div>
  <script type='text/javascript'>
	 jwplayer('mediaspace').setup({
		'flashplayer': '<?php echo $radio['py']['swf']?$radio['py']['swf']:'http://s0.boxza.com/static/js/jwplayer/player.swf'?>',
		'file': '<?php echo $radio['py']['file']?>',
		'skin':'http://s0.boxza.com/static/js/jwplayer/skin/stormtrooper.zip',
		'bufferlength': '3',
		<?php if( $radio['py']['streamer']):?>'streamer': '<?php echo $radio['py']['streamer']?>',<?php endif?>
		<?php if( $radio['py']['type']):?>'type': '<?php echo $radio['py']['type']?>',<?php endif?>
		'autostart': 'true',
		'controlbar': 'bottom',
		'width': '400',
		'height': '24',
	 });
	 </script>
<?php
endif;
?></div>

<div class="text-center">
<!-- BoxZa - 336x280 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-8383574629063856"
     data-ad-slot="7879089727"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div style="margin-bottom:5px;">
<a href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์" target="_blank">ฟังเพลง</a>ทุกแนว ทั้งเพลงสนุก เพลงรัก เพลงคิดถึง เพลงอกหัก และอีกหลากหลายอารมณ์ได้ที่ BoxZa Radio
</div>
   		<div class="socialshare">
            <div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/BoxzaNetwork" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
            <div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
            <div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo URI?>"></div></div>
            <div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
            <div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-lang="th" data-hashtags="boxza" rel="nofollow">ทวีต</a></div>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <p></p>
        </div>


<div style="padding:10px 0px 0px 0px">
<h4 style="padding: 8px;background: #f7f7f7;color: #f90;">ฟังเพลงแล้ว รู้สึกกันยังไง แสดงความรู้สึกกันได้ที่นี่เลย</h4>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="100" data-width="500"></div>
</div>
 
</div>
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