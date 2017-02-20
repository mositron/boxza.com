
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
บริการข้อมูลวิดีโอ: 
<a href="http://feed.boxza.com/video/rss" title="บริการข้อมูลวิดีโอโดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลวิดีโอโดย RSS Feed"></a>
<a href="http://feed.boxza.com/video/json" title="บริการข้อมูลวิดีโอโดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลวิดีโอโดย JSON"></a>
<a href="http://feed.boxza.com/video/json/change_callback_function_here" title="บริการข้อมูลวิดีโอโดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลวิดีโอโดย JSONP"></a>
</div>
</div>

<div class="video-f">
   <div class="video-hit">
      <h3><a href="http://video.boxza.com/" title="คลิปวิดีโอ" class="cufon">คลิปวิดีโอ</a> <i></i></h3>
      <div class="row-fluid">
         <div class="span9">
            <h4><a href="http://video.boxza.com/<?php echo $this->video_rec[0]['_id']?>-<?php echo $this->video_rec[0]['l']?>.html"><?php echo $this->video_rec[0]['t']?></a></h4>
            <div class="flex-video widescreen"><iframe width="470" height="270" src="//www.youtube.com/embed/<?php echo $this->video_rec[0]['yt']?>" frameborder="0" allowfullscreen></iframe></div>
         </div>
         <div class="span3">
            <strong class="video-rec cufon">วิดีโอแนะนำ</strong>
            <ul>
            <?php for($i=1;$i<4;$i++):?>
            <?php $l='http://video.boxza.com/view/'.$this->video_rec[$i]['_id'];?>
            <li>
            <a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video_rec[$i]['f']?>/<?php echo $this->video_rec[$i]['n']?>" alt="<?php echo $this->video_rec[$i]['t']?>" title="<?php echo $this->video_rec[$i]['t']?>"><span><?php echo video_duration($this->video_rec[$i]['dr'])?></span><i></i></a>
            </li>
            <?php endfor?>
            <p class="clear"></p>
            </ul>
         </div>
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


<div style="margin:5px 0px 10px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

   <div class="video-hv">
   <h4 class="cufon"><i></i> วิดีโอสุดฮอต</h4>
      <ul class="thumbnails row-count-4">
      <?php for($i=4;$i<count($this->video_rec);$i++):?>
      <?php $l='http://video.boxza.com/view/'.$this->video_rec[$i]['_id'];?>
      <li class="span3">
      <a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $this->video_rec[$i]['f']?>/<?php echo $this->video_rec[$i]['n']?>" alt="<?php echo $this->video_rec[$i]['t']?>" title="<?php echo $this->video_rec[$i]['t']?>"><span><?php echo video_duration($this->video_rec[$i]['dr'])?></span><i></i></a>
      <p><a href="<?php echo $l?>"><?php echo $this->video_rec[$i]['t']?></a></p>
      </li>
      <?php endfor?>
      </ul>
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

<div class="video-cate">
<?php foreach($this->video as $k=>$v):?>
<h4><a href="/c-<?php echo $k?>" title="<?php echo $this->acate[$k]['t']?>"><?php echo $this->acate[$k]['t']?></a></h4>
 <ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($v);$i++):?>
<?php $l='/view/'.$v[$i]['_id']?>
<li class="span3">
<a href="<?php echo $l?>" class="v"><img src="http://s3.boxza.com/video/<?php echo $v[$i]['f']?>/<?php echo $v[$i]['n']?>"><span><?php echo video_duration($v[$i]['dr'])?></span></a>
<p><a href="<?php echo $l?>"><?php echo $v[$i]['t']?></a></p>
</li>
<?php endfor?>
</ul>
<?php endforeach?>
</div>
