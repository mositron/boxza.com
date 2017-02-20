<div class="span8">
<link rel="stylesheet" href="http://s0.boxza.com/static/js/jquery/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://s0.boxza.com/static/js/jquery/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>

 <!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; margin:5px 0px 5px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<h3 class="hbu"><i></i>LESBIAN UPDATE</h3>

<style>
#slider a{display:block}
</style>

<div class="slider-wrapper theme-default">
   <div class="ribbon"></div>
   <div id="slider" class="nivoSlider">
   <?php for($i=0;$i<count($this->banner);$i++):?>
   <a href="<?php echo $this->banner[$i]['l']?>"><img src="http://s3.boxza.com/lesbian/banner/<?php echo $this->banner[$i]['_id']?>.jpg" title="<?php echo $this->banner[$i]['d']?>" alt=""></a>
   <?php endfor?>
   </div>
</div>
 <script type="text/javascript">
 $(window).load(function(){$("#slider").nivoSlider({
        effect:"random",
        slices:15,
        boxCols:8,
        boxRows:4,
        animSpeed:500,
        pauseTime:5000,
        startSlide:0,
        directionNav:true,
        directionNavHide:true,
        controlNav:false,
        controlNavThumbs:false,
        controlNavThumbsFromRel:true,
        keyboardNav:true,
        pauseOnHover:true,
        manualAdvance:false
 });
 });
 </script>


 <!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="text-align:center; margin:5px 0px 0px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<iframe frameborder="0" width="100%" height="500" src="http://s0.boxza.com/static/chat/?f=0&r=3&radio=0" style="margin:5px 0px 0px;"></iframe>


 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="text-align:center; margin:5px 0px 0px;overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div class="row-fluid" style="padding-top:5px; margin-top:5px">
<div class="hht span6">
<h3><a href="/forum/c-455" title="เลสเบี้ยน ทอมดี้: สุขภาพ ศัลกรรม ความงาม"><i></i>HEALTHY</a></h3>
<div><a href="/forum/c-455" title="เลสเบี้ยน ทอมดี้: สุขภาพ ศัลกรรม ความงาม"><img src="http://s0.boxza.com/static/images/lesbian/healthy.jpg" alt="สุขภาพ ศัลกรรม ความงาม"></a></div>
<ul class="flist1">
<?php foreach($this->health as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>
<div class="hfs span6">
<h3><a href="/forum/c-454" title="เลสเบี้ยน ทอมดี้: แฟชั่น การแต่งตัว อัพเดทเทรนใหม่"><i></i>FASHION</a></h3>
<div><a href="/forum/c-454" title="เลสเบี้ยน ทอมดี้: แฟชั่น การแต่งตัว อัพเดทเทรนใหม่"><img src="http://s0.boxza.com/static/images/lesbian/fashion.jpg" alt="แฟชั่น การแต่งตัว อัพเดทเทรนใหม่"></a></div>
<ul class="flist1">
<?php foreach($this->fashion as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>
</div>
<div class="hr hr2">
<h3><a href="/friend" title="หาเพื่อนเลสเบี้ยน หาเพื่อนทอมดี้"><i></i> หาเพื่อนเลสเบี้ยน หาเพื่อนทอมดี้</a></h3>
<div>
<ul class="thumbnails row-count-4">
<?php foreach($this->rec as $v):?>
<li class="span3">
<a href="msnim:add?contact=<?php echo $v['em']?>"><img src="http://s3.boxza.com/msn/rec/<?php echo $v['fd'].'/'.$v['pt']?>" alt="<?php echo $v['em']?>">
<span class="<?php  echo $v['ty2']?>"><?php echo $this->type[strval($v['ty2'])]?><i></i></span>
</a>
<p><i></i><a href="msnim:add?contact=<?php echo $v['em']?>"><?php echo $v['em']?></a></p>
<span><i></i><?php echo $this->province[$v['pr']]['name_th']?></span>
</li>
<?php endforeach?>
</ul>
</div>
</div>


</div>
<div class="span4">
<!--nipa-->
<div class="hfb">
<h3><i></i>FOLLOW US ON FACEBOOK</h3>
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="315" data-height="240" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:315px;overflow:hidden;"></div>
</div>

<div class="htp">
<h3><i></i>HOT TOPIC</h3>
<ul class="flist2">
<?php foreach($this->hot as $val):?>
<li><a href="/forum/topic/<?php echo $val['_id']?>" title="<?php echo $val['t']?>"><?php echo $val['t']?></a></li>
<?php endforeach?>
</ul>
</div>

<!--div class="hvid">
<h3 title="วิดีโอเลสเบี้ยน วิดีโอทอมดี้"><i></i>VIDEO</h3>
<?php 
if(preg_match('/\[youtube\](.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*)(.*)\[\/youtube\]/i',$this->video[0]['d'],$vid)):
?>
<iframe width="315" height="176" src="http://www.youtube.com/embed/<?php echo $vid[8]?>" frameborder="0" allowfullscreen></iframe>
<a href="/forum/topic/<?php echo $this->video[0]['_id']?>" title="<?php echo $this->video[0]['t']?>"><?php echo $this->video[0]['t']?></a>
<?php
endif;
?>
<ul>
<?php 
for($i=1;$i<count($this->video);$i++):
if(preg_match('/\[youtube\](.*)((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*)(.*)\[\/youtube\]/i',$this->video[$i]['d'],$vid)):
?>
<li><a href="/forum/topic/<?php echo $this->video[$i]['_id']?>" title="<?php echo $this->video[$i]['t']?>"><img src="http://img.youtube.com/vi/<?php echo $vid[8]?>/2.jpg" alt="<?php echo $this->video[$i]['t']?>"></a></li>
<?php
endif;
endfor;
?>
<p class="clear"></p>
</ul>
</div-->

<div class="hab">
<h3 title="อัลบั้มเลสเบี้ยน อัลบั้มทอมดี้"><i></i>ALBUM</h3>
<ul class="thumbnails row-count-3">
<?php foreach($this->album as $val):?>
<li class="span4"><a href="/forum/topic/<?php echo $val['_id']?>" title="<?php echo $val['t']?>">
<img src="http://s3.boxza.com/forum/<?php echo $val['fd']?>/s.jpg" alt="<?php echo $val['t']?>">
<p><?php echo $val['t']?></p>
</a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>





