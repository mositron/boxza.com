<?php require(ROOT.'modules/www/system/www.system.header.php')?>

<div class="lg"><a href="http://news.boxza.com/" title="ข่าว"></a>

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
       	<li><a href="http://news.boxza.com/" title="ข่าว"<?php echo !_::$path[0]?' class="active"':''?>><i class="ic ic-0"></i> ข่าว</a></li>
         <?php foreach($this->cate as $k=>$v): if($v['sub']||$k==8)continue;?>
         <li><a href="<?php echo ($v['sl']?$v['sl']:'/'.$v['l'])?>" title="ข่าว<?php echo $v['t']?>"<?php echo $v['l']==_::$path[0]?' class="active"':''?>><i class="ic ic-<?php echo $k?>"></i> <?php echo $v['t']?></a></li>
         <?php endforeach?>
      </ul>
         <ul class="nav pull-right"><li><a href="/admin">จัดการข่าวของคุณ</a></li></ul>
     </div><!-- /.nav-collapse -->
   </div>
 </div><!-- /navbar-inner -->
</div>
  
<div class="_ct-in">

<div class="left pf-l">
<?php echo _::$content?>
</div>
<div class="right pf-r">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="245" data-height="270" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:245px;overflow:hidden; margin:0px 0px 5px 5px;"></div>
 
<?php echo $this->service?>

</div>
<div class="clear"></div>


<?php require(ROOT.'modules/www/system/www.system.footer.php')?>

</div>
</div>
