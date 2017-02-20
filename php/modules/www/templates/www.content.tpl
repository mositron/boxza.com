<?php /*if(MODULE=='home'):?>
<style>
body{padding-top:0px !important; background-position:0px 156px !important}
._hd{position:static !important;}
*html ._hd{position:static !important;}
._hd-bt{display:none;}
.dad-day{ background:#FAF3DA;}
.dad-day div{text-align:center;}
._ct._ct-home{margin-top:10px !important;}
</style>
<div class="dad-day">
<div class="container">
<img src="http://s0.boxza.com/static/images/home/day/dad-day.jpg" alt="เนื่องในโอกาส พระราชพิธีมหามงคล เฉลิมพระชนมพรรษา 87 พรรษา">
</div>
</div>
<?php endif */?>
<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="container">
<div class="_bn">
  <?php if(MODULE=='home'||MODULE=='home2'):?>
  <div class="_hbn"> 
    <!-- BEGIN - BANNER : A -->
    <?php if($this->_banner['a']):?><ul class="_banner _banner-once"><?php foreach($this->_banner['a'] as $v):?><li><?php echo $v?></li><?php endforeach?></ul><?php endif?>
    <!-- END - BANNER : A --> 
  </div>
  <?php endif?>
</div>
<div class="_ct _ct-<?php echo MODULE?>"> 
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b1']||$this->_banner['b2']):?>
<div class="_hbn-bl"><ul class="_banner _banner-once"><?php foreach($this->_banner['b1'] as $_bn):?><li><?php echo $_bn?></li><?php endforeach?></ul></div>
<div class="_hbn-br"><ul class="_banner _banner-once"><?php foreach($this->_banner['b2'] as $_bn):?><li><?php echo $_bn?></li><?php endforeach?></ul></div>
<?php endif?>
<!-- END - BANNER : B -->
<div class="_ct-in"> 
 <?php echo _::$content?> 
</div>
</div>
</div>