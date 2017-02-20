<h3 class="guess-bar">หมวด<?php echo $this->cate[$this->c]['t']?></h3>

<ul class="fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->profile($this->app[$i]['u']);?>
    <li>
    <a href="/guess/game/<?php echo $this->app[$i]['_id'].$this->cur?>">
    <img src="http://s3.boxza.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg">
    <div><?php echo $this->app[$i]['t']?></div>
    <p>เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/guess/category/<?php echo $this->c?><?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/guess/category/<?php echo $this->c?>/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>