<style>
.breadcrumb{margin-bottom:10px;}
.al-e > li{width:232px; margin:0px 0px 7px 7px; text-align:center; float:left; background:#f9f9f9; border:1px solid #e0e0e0; border-radius:5px; padding:5px 0px;}
.al-e > li .i{display:block; width:210px; height:130px; line-height:0px; margin:5px auto; padding:0px; background:#fff; border:1px solid #ccc;}
.al-e > li .i img{margin:5px;}
</style>

<script>
function cdel(i){_.box.confirm({title:'ลบอัลบั้มรูปภาพ',detail:'คุณต้องการลบอัลบั้มนี้หรือไม่',click:function(){_.ajax.gourl('/manage','delalbum',i)}});}
function cdig(i){_.ajax.gourl('/manage','digdeal',i)}
</script>
<div style="background:#fff; padding:5px;">
<ul class="breadcrumb">
  <li><a href="/" title="อัลบั้มรูปภาพ"><i class="icon-home"></i> อัลบั้ม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการอัลบั้มรูปภาพของคุณ</a></li>
</ul>

<ul class="al-e">
<?php $i=0;foreach($this->album as $v):?>
<li>
<p><a href="/<?php echo $v['_id']?>"><?php echo $v['tt']?></a></p>
<a href="/<?php echo $v['_id']?>" class="i"><?php if($v['pt']['cv']):?><img src="http://s1.boxza.com/line/<?php echo $v['pt']['cv']['f']?>/s.<?php echo $v['pt']['cv']['e']?>"><?php endif?></a>
<p>
<a href="/update/<?php echo $v['_id']?>" class="btn"><i class="icon-wrench"></i> แก้ไข</a> 
<a href="javascript:;" onClick="_.box.confirm({title:'ลบอัลบั้ม',detail:'คุณต้องการลบอัลบั้มและรูปภาพทั้งหมดภายในอัลบั้มนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delalbum',<?php echo $v['_id']?>);}});" class="btn"><i class="icon-remove"></i> ลบ</a>
</p>
</li>
<?php if($i%4==3):?><p class="clear"></p><?php endif?>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
<div align="center"><?php echo $this->pager?></div>
</div>
