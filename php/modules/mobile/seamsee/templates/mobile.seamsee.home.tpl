<ul class="seamsee-list">
<?php foreach($this->seamsee as $k=>$v):?>
<li>
<a href="/seamsee/view/<?php echo $k?>">
<img src="http://s0.boxza.com/static/images/mobile/seamsee/<?php echo $k?>.jpg">
<h1><?php echo $v['t']?></h1>
<h2><?php echo $v['d']?></h2>
</a>
</li>
<?php endforeach?>
</ul>

