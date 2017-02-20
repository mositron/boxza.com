


<div><?php echo $this->place['n']?> ประกอบด้วย <?php echo count($this->prov)?> จังหวัด ได้แก่<br>
<?php for($i=0;$i<count($this->prov);$i++):?><?php echo $i>0?', ':''?><a href="/<?php echo $this->prov[$i]['lk']?>" title="<?php echo $this->prov[$i]['n']?> จังหวัด<?php echo $this->prov[$i]['n']?>"><?php echo $this->prov[$i]['n']?></a><?php endfor?>
</div>
 
<?php if($this->place['d']):?>
<div><?php echo $this->place['d']?></div>
<?php endif?>



<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

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


