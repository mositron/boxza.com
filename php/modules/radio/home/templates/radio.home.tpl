<style>
.rd li{background:#fff;margin:15px 0px 10px 30px;text-align: center;padding: 10px 0px; border-radius:5px;}
.rd li > p{background: #EBF7F6;height: 24px;line-height: 24px;margin: 0px 10px;}
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

<div style="padding:10px"><strong>ฟังเพลง</strong> ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ จากหลากหลายคลื่นทั่วไทย ฟังเพลงrock ฟังเพลงลูกทุ่ง ฟังเพลงสากล ฟังเพลงสบายๆ ครบทุกแนว ทุกค่ายเพลง ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไบน์กับ boxza radio</div>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div>
<ul class="thumbnails row-count-3 rd">
<?php $i=0;foreach($this->radio as $k=>$v):?>
<li class="span4">
<a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ <?php echo $v['t']?>"><img src="http://s0.boxza.com/static/images/radio/<?php echo $v['im']?>" alt="<?php echo $v['t']?>"></a>
<p><a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังวิทยุออนไลน์ ฟังเพลงออนไลน์ <?php echo $v['t']?>"><?php echo $v['t']?></a></p>
</li>
<?php endforeach?>
</ul>
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

<div style="padding:10px">รวมคลื่นวิทยุสำหรับ<strong>ฟังเพลง</strong> ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ จากหลายคลื่นวิทยุฮิตทั่วไทยไว้ให้คุณแล้วที่นี่ ทุกแนวเพลง ฟังเพลงอกหัก ฟังเพลงแอบรัก ฟังเพลงคิดถึง ได้ที่นี่กับ boxza radio</div>



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


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<h3 class="hd-a"><a href="http://music.boxza.com/list" title="ข่าวเพลง แวดวงเพลง" target="_blank">ข่าวเพลง</a> <small><a href="http://music.boxza.com/" title="เพลง เพลงใหม่ เนื้อเพลง" target="_blank">เพลง</a> ข่าวเพลง ข่าวเพลงใหม่ ข่าวเนื้อเพลงใหม่</small></h3>

<div class="bcd row-fluid">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="<?php echo link::news($v)?>" target="_blank" class="thumbnail">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if($v['da']->sec>(time()-(3600*12))):?> <img src="http://s0.boxza.com/static/images/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>