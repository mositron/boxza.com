



<div>
<?php if(isset($this->myalbum)):?>
<div style="background: #F6F6F6;margin: 5px 5px 5px 5px;">
<h3 style="padding: 5px 10px; float:left;color: #0399BE;">รูปภาพของคุณ</h3>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<input type="button" class="button" style="float:right; margin:3px" value="เพิ่มอัลบั้ม" onClick="_.box.load('/dialog/photos #photos_newalbum');">
<?php endif?>
<p class="clear"></p>
</div>
<ul class="myalbum"><?php echo $this->myalbum?></ul>
<?php endif?>

<h3 style="padding: 5px 10px;background: #F6F6F6;color: #0399BE;margin: 5px 5px 10px 5px;">รูปภาพของเพื่อน</h3>
<ul class="photos" id="getphotos"><?php echo $this->getphotos?></ul>
<div class="clear"></div>
</div>