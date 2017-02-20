<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/boxza.forum.js"></script>

<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
 <!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->
 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<ul class="breadcrumb" style="margin:5px 0px;">
<?php if(defined('FORUM_IN')):?>
<li><a href="/" title="<?php echo FORUM_HOME_TT?>"><i class="icon-home"></i> <?php echo FORUM_HOME?></a></li> <span class="divider">&raquo;</span>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php else:?>
<li><a href="<?PHP echo FORUM_URL?>" title="รูป"><i class="icon-list"></i> รูป</a></li>
<?php endif?>
<span class="divider">&raquo;</span> 
<li><a href="<?PHP echo FORUM_URL?>setting" title="ปรับแต่งค่าในเว็บบอร์ด"><i class="icon-list"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="<?PHP echo FORUM_URL?>setting"><i class="icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul> 

<div class="forum_post" style="background:#fff; text-align:center">
<div style="margin:0px auto; text-align:left; color:#000">
<h3 style="padding:5px; text-align:center; background:#f0f0f0; color:#000; text-shadow:1px 1px 0px #fff; margin-bottom:10px;">ปรับแต่งเว็บบอร์ด</h3>
<form onSubmit="tinyMCE.triggerSave();_.ajax.gourl('<?php echo URL?>','saveset',this);return false;" class="form-horizontal" name="post">
 <fieldset>

 <div class="control-group">
<label class="control-label" for="input02">ลายเซ็นต์</label>
<div class="controls category">
<textarea style="height:300px; width:600px;" name="detail" minlength="20" class="mceEditor"><?php echo $this->user['sg']?></textarea>
<p class="help-block">&nbsp;&bull;&nbsp;<a href="javascript:void(0);" onClick="window.open('http://image.boxza.com/upload?redirect_uri='+encodeURIComponent('http://<?php echo HOST.FORUM_URL?>addform.html')+'&format=html', '_imagehost', 'resizable=yes,width=600,height=450');return false;">อัพโหลดรูปภาพ</a><br><br>ไม่เกิน 1,000 ตัวอักษร</p>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<button type="reset" class="btn">ยกเลิก</button>
</div>

</fieldset>
</form>
</div>
</div>