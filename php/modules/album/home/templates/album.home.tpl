
<?php require(HANDLERS.'ads/ads.adsense.body3.php');?>

<div class="al-hit">
<h3 title="อัลบั้มยอดฮิต"><i title="อัลบั้มยอดฮิต"></i></h3>
<ul class="pt">
<?php foreach($this->hit as $v):?>
<li>
<div class="i"><a href="/<?php echo $v['_id']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['ms']?>"><img src="http://s1.boxza.com/line/<?php echo $v['pt']['cv']['f']?>/s.<?php echo $v['pt']['cv']['e']?>"></a></div>
<div class="t">
<p class="l"><span><?php echo $v['tt']?></span> (<?php echo $v['pt']['c']?> รูป)</p>
<p class="r"><i></i> <?php echo intval($v['cm']['c'])?></p>
</div>
<div class="x">Vote<span><?php echo intval($v['pt']['vt'])?></span></div>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<div class="al-rec">
<h3 title="อัลบั้มมาใหม่"><i title="อัลบั้มมาใหม่"></i></h3>
<ul class="pt">
<?php foreach($this->new as $v):?>
<li>
<div class="i"><a href="/<?php echo $v['_id']?>"><img src="http://s1.boxza.com/line/<?php echo $v['pt']['cv']['f']?>/s.<?php echo $v['pt']['cv']['e']?>"></a></div>
<div class="t">
<p class="l"><span><?php echo $v['tt']?></span> (<?php echo $v['pt']['c']?> รูป)</p>
<p class="r"><i></i> <?php echo intval($v['cm']['c'])?></p>
</div>
<div class="x">Vote<span><?php echo intval($v['pt']['vt'])?></span></div>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>

<div class="al-cate n-icon">

<?php foreach(_::$config['album'] as $a=>$b):?>
<h3 title="<?php echo $b?>" class="l<?php echo $a?>"><a href="/c-<?php echo $a?>"><i></i><?php echo $b?></a></h3>
<ul class="pt2">
<?php foreach($this->album[$a] as $v):?>
<li>
<div class="i"><a href="/<?php echo $v['_id']?>" title="<?php echo $v['tt']?>"><img src="http://s1.boxza.com/line/<?php echo $v['pt']['cv']['f']?>/s.<?php echo $v['pt']['cv']['e']?>"></a></div>
<div class="t">
<p class="l"><span><?php echo $v['tt']?></span> (<?php echo $v['pt']['c']?> รูป)</p>
<p class="r"><i></i> <?php echo intval($v['cm']['c'])?></p>
</div>
<div class="x">Vote<span><?php echo intval($v['pt']['vt'])?></span></div>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
<?php endforeach?>


</div>
