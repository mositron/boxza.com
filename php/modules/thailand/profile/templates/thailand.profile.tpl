
<div class="span4">
<div class="ab">
<div>
<img src="http://s3.boxza.com/place/<?php echo $this->place['fd']?>/t.jpg" alt="<?php echo $this->place['n']?>">
</div>
<h4 class="ab-hb"><a href="<?php echo $hlink?>" target="_blank" title="ประวัติ <?php echo $this->place['n']?>">ประวัติ <?php echo $this->place['n']?></a></h4>
<ul class="ab-ul">

<?php if($this->place['adr']):?><li class="l">ที่อยู่: <span><?php echo $this->place['adr']?></span></li><?php endif?>
<?php if($this->place['op']):?><li class="l">เวลาเปิด/ปิด: <span><?php echo $this->place['op']?></span></li><?php endif?>
<?php if($this->place['ph']):?><li class="l">เบอร์โทรศัพท์: <span><?php echo $this->place['ph']?></span></li><?php endif?>
<?php if($this->place['ps']):?><li class="l">ประเภท: <span><?php for($i=0;$i<count($this->place['ps']);$i++)echo $this->cate[$this->place['ps'][$i]];?></span></li><?php endif?>

</ul>
</div>
</div>
<div class="span8">
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
<h3><?php echo $this->place['n']?><?php if(_::$my['am']):?> <small>(<a href="/admin/<?php echo $this->place['_id']?>">แก้ไข</a>)</small><?php endif?></h3>

<?php if($this->place['d']):?>
<div><?php echo $this->place['d']?></div>
<?php endif?>


<?php if(count($this->news)):?>
<h4>ข่าว<?php echo $this->place['n']?>ล่าสุด</h4>
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
</ul>
</div>
<?php endif?>




<div style="margin:10px 0px 0px; padding:5px; border-top:1px dashed #ddd;">
<?php if($this->user['google']):?>
<div style="float:left; width:50px;">
<a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a>
</div>
<div style="margin:0px 0px 0px 55px;">
โดย: <a href="https://plus.google.com/<?php echo $this->user['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo $this->user['google']['name']?></a><br>
แก้ไขล่าสุด: <?php echo time::show($this->place['du'],'datetime')?>
</div>
<?php else:?>
<div style="float:left; width:50px;">
<a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a>
</div>
<div style="margin:0px 0px 0px 55px;">
โดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
แก้ไขล่าสุด: <?php echo time::show($this->place['du'],'datetime')?>
</div>
<?php endif?>
<p class="clear"></p>
</div>
</div>