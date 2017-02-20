<h3 class="lotto-bar">เลขเด็ด และข่าวที่เกี่ยวกับหวย</h3>

<div class="lotto-news">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="span3">
<a href="/lotto/news/<?php echo $v['_id']?>">
<img src="http://s3.boxza.com/news/<?php echo $v['fd']?>/s.jpg">
<p><?php echo $v['t']?></p>
<div>โพสเมื่อ: <?php echo time::show($v['ds'],'date')?></div>
</a>
</li>
<?php endfor?>
</ul>
</div>
