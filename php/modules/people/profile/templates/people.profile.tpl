
<div class="span4">

<style>
.pl-content{line-height:1.6em;}
.pl-content p{ margin-bottom:0px;}
</style>

<div class="ab">
<div itemscope itemtype="http://data-vocabulary.org/Person">
<img src="http://s3.boxza.com/people/<?php echo $this->people['fd']?>/t.jpg" itemprop="photo" alt="<?php echo $this->name?>">
</div>
<h4 class="ab-hb"><a href="<?php echo $this->people['lk']?>" target="_blank" title="ประวัติ <?php echo $hot?>">ประวัติ <?php echo $this->name?></a></h4>
<ul class="ab-ul">
<li class="l">ชื่อจริง: <span><?php echo $this->people['fn'].' '.$this->people['ln']?></span></li>
<?php if($this->people['n']):?><li class="l">ชื่อในวงการ: <span itemprop="name"><?php echo $this->people['n']?></span></li><?php endif?>
<?php if($this->people['nn']):?><li class="l">ชื่อเล่น: <span itemprop="nickname"><?php echo $this->people['nn']?></span></li><?php endif?>
<?php if($this->people['h']):?><li class="l">ส่วนสูง: <span><?php echo $this->people['h']?> ซม.</span></li><?php endif?>
<?php if($this->people['w']):?><li class="l">น้ำหนัก: <span><?php echo $this->people['w']?> กก.</span></li><?php endif?>
<?php if($this->people['bd']&&$this->people['bd'][0]):?><li class="l">เกิดวันที่: <span><?php echo $this->people['bd'][0].' '.time::$month[$this->people['bd'][1]-1].' '.($this->people['bd'][2]+543)?></span></li><?php endif?>
<?php if($this->people['fb']):?><li class="l">Facebook: <span><?php echo $this->people['fb']?></span></li><?php endif?>
<?php if($this->people['tw']):?><li class="l">Twitter: <span><?php echo $this->people['tw']?></span></li><?php endif?>
<?php if($this->people['in']):?><li class="l">Instagram: <span><?php echo $this->people['in']?></span></li><?php endif?>
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
<h3><?php echo $this->name?><?php if(_::$my['am']):?> <small>(<a href="/admin/<?php echo $this->people['_id']?>">แก้ไข</a>)</small><?php endif?></h3>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<?php if($this->people['edu']):?>
<h4>ประวัติ <?php echo $this->name?></h4>
<div class="pl-content">
<?php echo $this->people['edu']?>
</div>
<?php endif?>

<?php require(HANDLERS.'ads/ads.adsense.body2-2.php');?>

<?php if($this->people['rs']):?>
<h4>ผลงาน <?php echo $this->name?></h4>
<div class="pl-content">
<?php echo $this->people['rs']?>
</div>
<?php endif?>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>


<?php if(count($this->news)):?>
<h4><a href="http://news.boxza.com/people/<?php echo $this->people['lk']?>" title="ข่าว<?php echo $this->name?>ล่าสุด ข่าวข่าว <?php echo $this->name?> ล่าสุดวันนี้" target="_blank">ข่าว <?php echo $this->name?> ล่าสุด</a></h4>
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
แก้ไขล่าสุด: <?php echo time::show($this->people['du'],'datetime')?>
</div>
<?php else:?>
<div style="float:left; width:50px;">
<a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a>
</div>
<div style="margin:0px 0px 0px 55px;">
โดย: <a href="http://boxza.com/<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
แก้ไขล่าสุด: <?php echo time::show($this->people['du'],'datetime')?>
</div>
<?php endif?>
<p class="clear"></p>
</div>
</div>