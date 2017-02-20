<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div>
<ul class="thumbnails row-count-4">
<?php foreach($this->about as $v):?>
<li class="span3 text-center">
<a href="/<?php echo $v['lk']?>" title="<?php echo $v['t']?>">
<img src="http://s3.boxza.com/about/<?php echo $v['fd']?>/s.jpg">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>

<?php require(HANDLERS.'ads/ads.yengo.body2.php');?>