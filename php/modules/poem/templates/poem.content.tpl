<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="lg"><a href="http://poem.boxza.com/" title="กลิตเตอร์"></a>

<!-- BEGIN - BANNER : A -->
<?php if($this->_banner['a']):?>
<div>
<ul class="_banner _banner-once">
<?php foreach($this->_banner['a'] as $v):?>
<li><?php echo $v?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : A -->

</div>
<div class="_ct _ct-<?php echo MODULE?>">
<div class="navbar">
 <div class="navbar-inner">
   <div class="container">
     <div class="nav-collapse">
       <ul class="nav">
         <li><a href="http://poem.boxza.com/" title="กลิตเตอร์"><i class="ic1"></i> กลิตเตอร์</a></li>
         <li><a href="http://poem.boxza.com/c-1" title="กลิตเตอร์แสดงอารมณ์" class="l1">แสดงอารมณ์</a></li>
         <li><a href="http://poem.boxza.com/c-41" title="กลิตเตอร์ทักทาย" class="l2">ทักทาย</a></li>
         <li><a href="http://poem.boxza.com/c-71" title="กลิตเตอร์เทศกาล" class="l3">เทศกาล</a></li>
         <li><a href="http://poem.boxza.com/c-91" title="กลิตเตอร์อื่นๆ" class="l4">กลิตเตอร์อื่นๆ</a></li>
       </ul>
       <ul class="nav pull-right">
         <li><a href="/post" class="l5"><i class="icon-plus icon-white"></i> เพิ่มกลิตเตอร์ใหม่</a></li>
         <li><a href="/manage" class="l5"><i class="icon-folder-open icon-white"></i> จัดการกลิตเตอร์ของคุณ</a></li>
       </ul>
     </div><!-- /.nav-collapse -->
   </div>
 </div><!-- /navbar-inner -->
</div>
<div class="_ct-in">
<div class="left pf-l">
<?php echo _::$content?>



<div class="sc">
<h3><i></i> สมาชิก BoxZa Social</h3>
<div class="t">
<div>
<p class="cufon"> สมาชิกแนะนำ</p>
<div>
<?php $v=$this->profile[0]?>
<a href="http://boxza.com/<?php echo $v['if']['lk']?>"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/n.jpg" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="http://boxza.com/<?php echo $v['if']['lk']?>"><?php echo $v['if']['fn']?></a></p>
</div>
</div>
</div>
<ul>
<?php for($i=1;$i<count($this->profile);$i++): $v=$this->profile[$i];?>
<li>
<div>
<a href="http://boxza.com/<?php echo $v['if']['lk']?>"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/s.jpg" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="http://boxza.com/<?php echo $v['if']['lk']?>"><?php echo $v['if']['fn']?></a></p>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<p class="clear"></p>
</div>

</div>
<div class="right pf-r">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="245" data-height="270" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:245px;overflow:hidden; margin:0px 0px 0px 5px"></div>
<ul class="g-c">
<?php 
$c = 0; $i=0;
foreach($this->cate as $k=>$v):
	if($v['l']):
		if($c) echo '</div></li>';
		$i=0;
		$c=$k;
?>
<li class="g<?php echo $k?>"><h4><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a></h4>
<div>
<?php continue;endif?>
<?php if($i) echo ', ';?><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a><?php $i++;endforeach?>
</div>
</li>
</ul>
<?php echo $this->service?>
</div>


<div class="clear"></div>

<?php require(ROOT.'modules/www/system/www.system.footer.php')?>
</div>
</div>
