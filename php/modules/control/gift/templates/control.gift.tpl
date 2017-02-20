<style>
.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.w100{width:100px;}
.w150{width:150px;}
.pl0,.pl1{display:inline-block; padding:2px 10px; color:#fff; background:#f00;}
.pl1{background:#6C0;}

.gift li{float:left; width:140px; overflow:hidden; text-align:center; padding:5px 0px; border:1px solid #ddd; border-radius:5px; margin:7px 0px 0px 7px;}
.gift li div{width:130px; margin:0px auto; overflow:hidden; line-height:1.8em;}
.gift li .upgift{width:100px;}
</style>



<div id="newgift" class="gbox">
<form method="post" action="<?php echo URL?>" enctype="multipart/form-data">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">Key:</td><td align="left"><input type="text" name="key" size="30" class="tbox" required><br>
ชื่อคีย์ของขวัญ ห้ามซ้ำและแก้ไขไม่ได้ ( a-z 0-9 เท่านั้น )
</td></tr>
<tr><td align="right" width="120">ชื่อของขวัญ:</td><td align="left"><input type="text" name="name" size="50" class="tbox" required></td></tr>
<tr><td align="right" width="120">รูปภาพ:</td><td align="left"><input type="file" name="gift_img" size="10" required><br> ขนาด 128x128 / PNG</td></tr>
<tr><td align="right" width="120">ราคา:</td><td align="left"><input type="number" name="price" size="10" class="tbox" required> บ๊อก</td></tr>
<tr><td align="right" width="120">อายุ:</td><td align="left"><input type="number" name="expire" size="10" class="tbox" required>วัน</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/gift"><i class="icon-gift"></i> ของขวัญ</a></li>
 
<?php if($this->access):?>
    <li class="pull-right">
   <?php if($_GET['cmd']=='editing'):?>
  <a href="<?php echo URL?>"><i class="icon-ok"></i> แก้ไขเสร็จเรียบร้อย</a>
  <?php $enabled=true;?>
   <?php else:?>
  <a href="?cmd=editing"><i class="icon-edit"></i> แก้ไข</a>
  <?php $enabled=false;?>
   <?php endif?>
   </li>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newgift');"><i class="icon-plus"></i> เพิ่ม</a> &nbsp; &nbsp; </li> 
<?php else:?>
<?php $enabled=false;?>
 <li class="pull-right"><i class="icon-question-sign"></i> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้</li>
<?php endif?>
</ul>

<div style="padding:10px; text-align:center; background:#e00; color:#fff; margin:5px 0px; font-weight:bold; font-size:16px;">ของขวัญทั้งหมด ไม่สามารถลบได้ สามารถเปิด/ปิดการแสดงผลได้เท่านั้น</div>

<?php if($this->error):?>
<div style="padding:5px; border:1px solid #f00; background:#f7f7f7; color:#f00; margin:0px 0px 5px 0px">เกิดผิดพลาด: <?php echo implode(', ',$this->error)?></div>
<?php endif?>

<ul class="gift">
<?php for($i=0;$i<count($this->gift);$i++): $g=$this->gift[$i];?>

<li>
<img src="http://s1.boxza.com/gift/128/<?php echo $this->gift[$i]['_id']?>.png" id="gift<?php echo $this->gift[$i]['_id']?>">
<?php if($enabled):?>
<input type="file" name="thumb" class="upgift" size="10" data-id="<?php echo $this->gift[$i]['_id']?>">
<?php endif?>
<?php echo $this->html->td('gift_n_'.$g['_id'],$g['n'],'input',array('enabled'=>$enabled,'tag'=>'div','full'=>1,'button'=>false),array())?>
<div>Key: <strong><?php echo $g['_id']?></strong></div>
<?php echo $this->html->td('gift_pr_'.$g['_id'],$g['pr'],'input',array('enabled'=>$enabled,'tag'=>'div','full'=>80,'text1'=>'ราคา: ','text2'=>' บ๊อก','button'=>false),array())?>
<?php echo $this->html->td('gift_ex_'.$g['_id'],$g['ex'],'input',array('enabled'=>$enabled,'tag'=>'div','full'=>80,'text1'=>'อายุ: ','text2'=>' วัน','button'=>false),array())?>
<?php echo $this->html->td('gift_pl_'.$g['_id'],$g['pl'],'select',array('enabled'=>$enabled,'tag'=>'div','full'=>1,'button'=>false),array('<strong class="pl0">ไม่แสดง</strong>','<strong class="pl1">แสดง</strong>'))?>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>



<div align="center"><?php echo $this->pager?></div>


<script>

$('input.upgift').change(function(e){
	if($(this).val())
	{
		var id=$(this).data('id');
		_.upload.start(
			this,
			function(f){f.append('<input type="hidden" name="gift" value="'+id+'">');},
			function(b){if(b.status=='OK'){$('#gift'+id).attr('src',b.pic);}else{_.box.alert(b.message);}});
	}
});
</script>