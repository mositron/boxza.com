<div>
<!---  A1 // start -->
<div class="span4 h-a1">
<div>

<div class="h-most-popular">
<p><i title="Most Poppular"></i></p>
<p><strong>ผู้หญิง</strong>กับประเด็นฮอตกระแสฮิต</p>
<ul>
<?php $i=0;foreach($this->ho['h13'] as $v):?>
<li class="l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>

</div>
</div>
<!---  A1 // end -->

<!---  A2 // start -->
<div class="span8 h-a2">
<div style="margin:0px 0px 0px 5px">

<div class="h-new-update">
<p><i></i> ข่าวเกี่ยวกับ<strong>ผู้หญิง</strong> ข่าวล่ามาแรง ข่าวน่าสนใจ</p>

<link rel="stylesheet" href="http://s0.boxza.com/static/js/jquery/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://s0.boxza.com/static/js/jquery/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/nivo-slider/jquery.nivo.slider.pack.js"></script>


<style>
#slider a{display:block}
</style>

<div class="slider-wrapper theme-default">
   <div class="ribbon"></div>
   <div id="slider" class="nivoSlider">
   <?php foreach($this->ho['h12'] as $v):?>
   <a href="/forum/topic/<?php echo $v['_id']?>"><img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/h12.jpg" title="<?php echo $v['t']?>" alt=""></a>
   <?php endforeach?>
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
 
</div>

<div class="h-hot-review">
<p><a href="/forum/c-311" title="Hot Review"><i></i></a> ของร้อน!! แนะนำของน่าใช้น่าลองสำหรับ<strong>ผู้หญิง</strong></p>
<ul class="thumbnails row-count-4">
<?php $i=0;foreach($this->ho['h1'] as $v):?>
<li class="span3 l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>

</div>
</div>
<!---  A2 // end -->
<p class="clear"></p>
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


<div class="h-hot-video">
<p><i></i> <strong>ผู้หญิง</strong> สวย แซบ สุขภาพดี มีสไตล์</p>
<ul class="thumbnails row-count-6">
<?php $i=0;foreach($this->ho['h11'] as $v):?>
<li class="span2 l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php $i++;endforeach?>
</ul>
</div>

<div class="row-fluid" style="border-top:1px dashed #dedede; padding:15px 0px 0px 0px">

<div class="span5 h-b1">
<div class="h-open-box">
<p><a href="/forum/c-333" title="Open Box"><i></i></a></p>
<p class="t"><strong>ผู้หญิง</strong>ช็อปอะไรมาโชว์กัน</p>
<ul class="thumbnails row-count-2">
<?php $i=0;foreach($this->ho['h5'] as $v):?>
<li class="span6 l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php $i++;endforeach?>
</ul>
</div>
</div>

<div class="span7 h-b2">
<div class="h-hot-news">
<div>
<p><i></i></p>
<p><strong>ผู้หญิง</strong>กับข่าวร้อน กระแสดัง รวมพูดคุย อัพเดทกันได้ที่นี่</p>
<ul>
<?php $i=0;foreach($this->ho['h9'] as $v):?>
<li class="l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>"><?php echo $v['t']?></a>
</li>
<?php $i++;endforeach?>
</ul>
</div>
</div>
</div>
</div>



<div class="h-fashion">
<p><a href="/forum/c-334" title="Fashion"><i></i></a> <strong>ผู้หญิง</strong>อัพเดทเทรนด์ฮิต เกาะกระแสฮอตของแฟชั่น</p>
<ul class="thumbnails row-count-6">
<?php $i=0;foreach($this->ho['h6'] as $v):?>
<li class="span2 l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>">
</a>
</li>
<?php $i++;endforeach?>
</ul>
</div>


<div>
<div class="span8 h-c1">
<div class="h-hot-topic">
<p><i></i></p>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>อ่าน</th><th>ตอบ</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->ho['h10'] as $v):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $v['_id']?>"><?php echo $v['t']?></a></p></td>
	<td class="tview"><?php echo number_format($v['do'])?></td>
	<td class="treply"><?php echo number_format($v['cm']['c'])?></td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
</div>
</div>
<div class="span4 h-c2">
<div class="h-did-you">
<div>
<p><a href="/forum/c-335" title="Did you know"><i></i></a></p>
<!--p>“คุณรู้หรือไม่ว่า?” โลกนี้มีเรื่องราวน่ารู้มากมาย</p-->
<ul>
<?php $i=0;foreach($this->ho['h7'] as $v):?>
<li class="l<?php echo $i?>">
<a href="/forum/topic/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/forum/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>
</div>

<p class="clear"></p>
</div>
