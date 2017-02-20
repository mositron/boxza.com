<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->


<ul class="breadcrumb">
    <li><a href="/" title="เกมทายใจ"><i class="icon-home"></i> เกมทายใจ</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/cate-<?php echo $this->c?>" title="เกมทายใจ<?php echo $this->cate[$this->c]['t']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
</ul>

<h4 class="ht"><i></i>เกมส์ทายใจ ประเภท<?php echo $this->cate[$this->c]['t']?></h4>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->profile($this->app[$i]['u']);?>
    <li class="span6">
    <a href="/game/<?php echo $this->app[$i]['_id']?>" class="thumbnail" target="_blank">
    <img src="http://s3.boxza.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg">
    <div><?php echo $this->app[$i]['t']?></div>
    <p class="do">เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    <p class="de"><?php echo $this->app[$i]['d']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div align="center"><?php echo $this->pager?></div>
