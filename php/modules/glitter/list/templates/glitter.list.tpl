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


<div class="feed-bar">
<div class="pull-right">
บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>: 
<a href="http://feed.boxza.com/glitter-<?php echo $this->c?>/rss" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed" target="_blank"><img src="http://s0.boxza.com/static/images/global/rss.png" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย RSS Feed"></a>
<a href="http://feed.boxza.com/glitter-<?php echo $this->c?>/json" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย JSON" target="_blank"><img src="http://s0.boxza.com/static/images/global/json.png" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย JSON"></a>
<a href="http://feed.boxza.com/glitter-<?php echo $this->c?>/json/change_callback_function_here" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย JSONP" target="_blank"><img src="http://s0.boxza.com/static/images/global/jsonp.png" title="บริการข้อมูลกลิตเตอร์<?php echo $this->cate[$this->c]['t']?>โดย JSONP"></a>
</div>
</div>

<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="กลิตเตอร์ Glitter"><i class="icon-home"></i> กลิตเตอร์</a></li>

<?php if($p=$this->cate[$this->c]['p']):?>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$p]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์">แสดงอารมณ์</a></li>
   <li><a href="/c-41" title="กลิตเตอร์ทักทาย">ทักทาย</a></li>
   <li><a href="/c-71" title="กลิตเตอร์เทศกาล">เทศกาล</a></li>
   <li><a href="/c-91" title="กลิตเตอร์อื่นๆ">กลิตเตอร์อื่นๆ</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-<?php echo $p?>"><?php echo $this->cate[$p]['t']?>ทั้งหมด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->cate[$p]['l']);$i++):?>
 <?php $j=$this->cate[$p]['l'][$i];?>
   <li><a href="/c-<?php echo $j?>"><?php echo $this->cate[$j]['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php elseif($this->c):?>

<span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์">แสดงอารมณ์</a></li>
   <li><a href="/c-41" title="กลิตเตอร์ทักทาย">ทักทาย</a></li>
   <li><a href="/c-71" title="กลิตเตอร์เทศกาล">เทศกาล</a></li>
   <li><a href="/c-91" title="กลิตเตอร์อื่นๆ">กลิตเตอร์อื่นๆ</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?>ทั้งหมด <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-<?php echo $this->c?>"><?php echo $this->cate[$this->c]['t']?>ทั้งหมด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->cate[$this->c]['l']);$i++):?>
 <?php $j=$this->cate[$this->c]['l'][$i];?>
   <li><a href="/c-<?php echo $j?>"><?php echo $this->cate[$j]['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
</ul> 

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<div class="gl-new">
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->last);$i++):?>
<?php $l='/'.$this->last[$i]['_id'].'.html';?>
<li class="span3">
<a href="<?php echo $l?>">
<img src="http://s3.boxza.com/glitter/<?php echo $this->last[$i]['fd']?>/t.<?php echo $this->last[$i]['ty']?>">
</a>
<p><?php echo $this->last[$i]['t']?></p>
</li>
<?php endfor?>
</ul>
</div>

<!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<div style="text-align:center"><?php echo $this->pager?></div>


 <!-- BEGIN - BANNER : F -->
<?php if($this->_banner['f']):?>
<div style="overflow:hidden; margin:5px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['f'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : F -->