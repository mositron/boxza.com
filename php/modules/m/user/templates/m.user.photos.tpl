
<style>
.pf { min-height:100px !important}

.pt-l{position:absolute; left:0px; top:10px; width:200px; height:24px;}

.pt-l .lk, .pt-l .cm, .pt-l .sh {border: 1px solid #000;background: white;padding: 3px 5px;border-radius: 3px; margin:0px 3px; color:#000; box-shadow:0px 0px 3px rgba(0,0,0,0.3)}
.pt-l .lk a, .pt-l .cm a, .pt-l .sh a{color:#000; text-decoration:none;}

/*
.myalbum{padding:0px 0px 0px 5px}
.myalbum li{margin:5px 5px 10px 0px;line-height:0px;border:1px solid #ddd; padding:5px; box-shadow:5px 5px 0px #f0f0f0;}
.myalbum li div a{display:block; width:200px; height:120px; border:1px solid #eee;}
.myalbum h4{ padding:5px 10px; overflow: hidden;white-space:nowrap; text-overflow: ellipsis; margin:0px 0px 5px 210px; background-color:#f6f6f6;}
*/
/*
.myalbum li div .left a{width:190px; height:auto}
.myalbum li div a{width:auto; height:auto; border:none}
.myalbum li{float:none !important}
.myalbum h4{width:auto !important; background-color:#f6f6f6;}
.myalbum .left img{ width:190px}
.myalbum .l img{float:left; width:115px; margin:5px 0px 0px 5px;}
*/
</style>
<div>
<div style="background: #F6F6F6;margin: 5px 5px 5px 5px;">
<h3 style="padding: 5px 10px; float:left;color: #0399BE;">อัลบั้มทั้งหมด</h3>


<?php if(_::$my && _::$my['_id']==_::$profile['_id']):?>
<input type="button" class="button" style="float:right; margin:3px" value="เพิ่มอัลบั้ม" onClick="_.box.load('/dialog/photos #photos_newalbum');">
<?php endif?>
<p class="clear"></p>
</div>
<?php if(isset($this->myalbum)):?>
<ul class="myalbum"><?php echo $this->myalbum?></ul>
<?php endif?>
</div>