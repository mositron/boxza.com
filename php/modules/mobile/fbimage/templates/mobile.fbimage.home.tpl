
<ul class="home-list">
<?php $i=0;foreach($this->ref as $k=>$v):?>
<li>
<a href="/fbimage/ref/<?php echo $k?>">
<img src="https://graph.facebook.com/<?php echo $k?>/picture?type=square">
<h1><?php echo $v?></h1>
<h2>รวมรูปภาพโดนๆจากเพจ <?php echo $v?></h2>
</a>
</li>
<?php $i++;endforeach?>
</ul>

