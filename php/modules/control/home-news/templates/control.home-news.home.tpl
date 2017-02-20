<style>
.news-block li{text-align:center; margin-bottom:5px;}
.news-block .edit{text-align:left; height:30px; line-height:30px; border-bottom:1px dashed #ccc; text-indent:5px;}
.news-block a{display:block; margin-top:5px; padding:5px; border:1px solid #ccc; border-radius:5px;}
.news-block div > p{margin:0px; text-align:left; font-size:12px; padding-left:5px; background:#f0f0f0;}
.news-block a p{height:37px; overflow:hidden; color:#666; margin-bottom:0px;}

.news-block input.tbox{border-radius:0px; height:22px; line-height:22px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('/home-news','delbanner',i)}});}
</script>


<div class="row-fluid">



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/home-news"><i class="icon-th"></i> ข่าวหน้าแรก</a></li>
</ul>

<ul class="nav nav-tabs">
  <?php foreach($this->position as $pos=>$name):?>
  <li<?php echo $pos==$this->tab?' class="active"':''?>><a href="/home-news/<?php echo $pos?>"><?php echo $name?></a></li>
  <?php endforeach?>
</ul>

<ul class="thumbnails news-block">
<?php for($i=0;$i<3;$i++):?>
<li class="span<?php echo $i>0?'3':'6'?>">
<?php echo $this->html->td('news_'.$this->tab.'_'.$i,$this->msg['slot'.$this->tab]?$this->msg['slot'.$this->tab][$i]:'','input',array('full'=>80,'tag'=>'div','text1'=>'ID: ','enabled'=>$this->access))?>
<div id="preview_<?php echo $this->tab.'_'.$i?>">
<p>ดู: <?php echo number_format($this->news[$i]['do'])?><br>เมื่อ: <?php echo time::show($this->news[$i]['ds'],'date')?></p>
<?php if($this->news[$i]) echo '<a href="'.link::news($this->news[$i]).'" target="_blank"><img src="http://s3.boxza.com/news/'.$this->news[$i]['fd'].'/s.jpg"><p>'.$this->news[$i]['t'].'</p></a>'?>
</div>
</li>
<?php endfor?>
</ul>
<ul class="thumbnails row-count-4 news-block">
<?php for($i=3;$i<11;$i++):?>
<li class="span3">
<?php echo $this->html->td('news_'.$this->tab.'_'.$i,$this->msg['slot'.$this->tab]?$this->msg['slot'.$this->tab][$i]:'','input',array('full'=>80,'tag'=>'div','text1'=>'ID: ','enabled'=>$this->access))?>
<div id="preview_<?php echo $this->tab.'_'.$i?>">
<p>ดู: <?php echo number_format($this->news[$i]['do'])?><br>เมื่อ: <?php echo time::show($this->news[$i]['ds'],'date')?></p>
<?php if($this->news[$i]) echo '<a href="'.link::news($this->news[$i]).'" target="_blank"><img src="http://s3.boxza.com/news/'.$this->news[$i]['fd'].'/s.jpg"><p>'.$this->news[$i]['t'].'</p></a>'?>
</div>
</li>
<?php endfor?>
</ul>
</div>
