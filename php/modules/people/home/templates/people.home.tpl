<div class="ab">
<h3 class="ab-ha">HOT NOW!! </h3>
<div class="row-fluid">
<div class="span8">
<div class="row-fluid">
<div class="span6">
<?php 
$hot=($this->hot['n']?$this->hot['n'].' ('.trim($this->hot['nn'].' '.$this->hot['fn'].' '.$this->hot['ln']).')':trim($this->hot['nn'].' '.$this->hot['fn'].' '.$this->hot['ln']));
$hname=($this->hot['n']?$this->hot['n']:trim($this->hot['nn'].' '.$this->hot['fn'].' '.$this->hot['ln']));
?>
<a href="/<?php echo $this->hot['lk']?>" target="_blank" title="ประวัติ <?php echo $hot?>" class="ab-img"><img src="http://s3.boxza.com/people/<?php echo $this->hot['fd']?>/t.jpg" alt="<?php echo $hot?>"></a>
</div>
<div class="span6">
<h4 class="ab-hb"><a href="/<?php echo $this->hot['lk']?>" target="_blank" title="ประวัติ <?php echo $hot?>">ประวัติ <?php echo $hname?></a></h4>
<ul class="ab-ul">
<li class="l">ชื่อจริง: <span><?php echo $this->hot['fn'].' '.$this->hot['ln']?></span></li>
<?php if($this->hot['n']):?><li class="l">ชื่อในวงการ: <span><?php echo $this->hot['n']?></span></li><?php endif?>
<?php if($this->hot['nn']):?><li class="l">ชื่อเล่น: <span><?php echo $this->hot['nn']?></span></li><?php endif?>
<?php if($this->hot['h']):?><li class="l">ส่วนสูง: <span><?php echo $this->hot['h']?> ซม.</span></li><?php endif?>
<?php if($this->hot['w']):?><li class="l">น้ำหนัก: <span><?php echo $this->hot['w']?> กก.</span></li><?php endif?>
<?php if($this->hot['bd']&&$this->hot['bd'][0]):?><li class="l">เกิดวันที่: <span><?php echo $this->hot['bd'][0].' '.time::$month[$this->hot['bd'][1]-1].' '.($this->hot['bd'][2]+543)?></span></li><?php endif?>
<?php if($this->hot['fb']):?><li class="l">Facebook: <span><?php echo $this->hot['fb']?></span></li><?php endif?>
<?php if($this->hot['tw']):?><li class="l">Twitter: <span><?php echo $this->hot['tw']?></span></li><?php endif?>
<?php if($this->hot['in']):?><li class="l">Instagram: <span><?php echo $this->hot['in']?></span></li><?php endif?>

</ul>
</div>
</div>
<?php if(count($this->hin)):?>
<div>
<h3 class="ab-hd"><a href="<?php echo $this->hot['lk']?>/instagram" target="_blank" title="Instagram <?php echo $hot?>">Instagram <?php echo $hname?></a></h3>
<ul class="ab-in">
<?php for($i=0;$i<count($this->hin);$i++):?>
<li><a href="<?php echo $this->hot['lk']?>/instagram/<?php echo $this->hin[$i]['_id']?>" target="_blank"><img src=""></a></li>
<?php endfor?>
</ul>
</div>
<?php endif?>
</div>
<div class="span4">
<h4 class="ab-hc"><a href="http://news.boxza.com/people/<?php echo $this->hot['lk']?>" title="ข่าว<?php echo $hname?>ล่าสุด ข่าวข่าว <?php echo $hname?> ล่าสุดวันนี้" target="_blank">ข่าว <?php echo $hname?> ล่าสุด</a></h4>
<ul class="ab-news">
<?php for($i=0;$i<count($this->hnews);$i++):?>
<li>
<a href="<?php echo link::news($this->hnews[$i])?>" target="_blank">
<img src="http://s3.boxza.com/news/<?php echo $this->hnews[$i]['fd']?>/s.jpg">
<p><?php echo $this->hnews[$i]['t']?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>
</div>
</div>


<?php require(HANDLERS.'ads/ads.adsense.body3.php');?>

<div>
<ul class="thumbnails row-count-6">
<?php foreach($this->people as $v):

$hot=($v['n']?$v['n'].' ('.trim($v['nn'].' '.$v['fn'].' '.$v['ln']).')':trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
$hname=($v['n']?$v['n']:trim($v['nn'].' '.$v['fn'].' '.$v['ln']));
?>
<li class="span2">
<a href="<?php echo $v['lk']?>" title="<?php echo $hot?>">
<img src="http://s3.boxza.com/people/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $hot?>">
<p><?php echo $hname?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>


<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body3.php');?></div>