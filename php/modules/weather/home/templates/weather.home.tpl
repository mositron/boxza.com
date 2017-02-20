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

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="row-weather">
<?php foreach(array(3,1,2,4,5,6) as $i):?>
<h3>พยากรณ์อากาศ<?php echo $this->zone[$i]?> <small>สภาพอากาศ<?php echo $this->zone[$i]?></small></h3>
<div class="row-fluid">
<ul>
<?php foreach($this->weather[$i] as $v):?>
<li class="span3">
<div>
<a href="/place/<?php echo $v['_id']?>" target="_blank"><strong><?php echo $v['name']?></strong>
<div><i class="icn-wt icn-wt<?php echo $v['today']['icon']?>"></i></div>
<p><?php echo $v['today']['t1']?$v['today']['t1'].' &deg;C':'-'?></p>
<?php echo $v['today']['t5']?$v['today']['t5']:'<em>ไม่มีข้อมูล</em>'?>
</a>
</div>
</li>
<?php endforeach?>
</ul>
</div>
<?php endforeach?>
</div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; background:#f9f9f9">ความคิดเห็น</h3>
<div class="fb-comments" data-href="http://weather.boxza.com/" data-num-posts="20" data-width="629"></div>
