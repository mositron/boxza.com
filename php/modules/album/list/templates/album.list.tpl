<div>

<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="อัลบั้ม"><i class="icon-home"></i> อัลบั้ม</a></li>
<?php if($this->c):?>
<span class="divider">&raquo;</span>
<li><a href="/c-"><?php echo _::$config['album'][$this->c]?></a></li>
<?php endif?>
</ul> 

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>

<div class="al-new">
<h3 title="อัลบั้มมาใหม่"><i title="อัลบั้มมาใหม่"></i></h3>
<ul class="pt">
<?php $i=0;foreach($this->album as $v):?>
<li>
<div class="i"><a href="/<?php echo $v['_id']?>"><img src="http://s1.boxza.com/line/<?php echo $v['pt']['cv']['f']?>/s.<?php echo $v['pt']['cv']['e']?>"></a></div>
<div class="t">
<p class="l"><span><?php echo $v['tt']?></span> (<?php echo $v['pt']['c']?> รูป)</p>
<p class="r"><i></i> <?php echo intval($v['cm']['c'])?></p>
</div>
<div class="x">Vote<span><?php echo intval($v['pt']['vt'])?></span></div>
</li>
<?php if($i%4==3):?><p class="clear"></p><?php endif?>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
</div>


<div style="text-align:center"><?php echo $this->pager?></div>
</div>
