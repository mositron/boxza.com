<style>
.table th.c,.table td.c{text-align:center;}
.table .s{width:100px;}
.table .so{width:50px;}
.table .x{width:30px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('/banner','delbanner',i)}});}
</script>


<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbanner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มป้ายกำกับใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="150">ข้อความ:</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><i class="icon-home"></i> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/banner"><i class="icon-eye-open"></i> คำค้นยอดฮิต</a></li>
 
  
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
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbanner');"><i class="icon-plus"></i> เพิ่ม</a> &nbsp; &nbsp; </li> 
<?php else:?>
<?php $enabled=false;?>
 <li class="pull-right"><i class="icon-question-sign"></i> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้</li>
<?php endif?>
</ul>


<table class="table" width="100%">
<tr><th class="c">ชื่อแบนเนอร์</th><th class="c">ลิ้งค์ปลายทาง</th><th class="c">ลำดับ</th><th class="c">สถานะ</th><th class="x c"></th></tr>
<?php for($i=0;$i<count($this->banner);$i++):?>
<tr class="l<?php echo $i%2?>">
<?php echo $this->html->td('tags_t_'.$this->banner[$i]['_id'],$this->banner[$i]['t'],'input',array('enabled'=>$enabled,'class'=>'c','full'=>1,'button'=>false))?>
<?php echo $this->html->td('tags_l_'.$this->banner[$i]['_id'],$this->banner[$i]['l'],'input',array('enabled'=>$enabled,'class'=>'c','full'=>1,'button'=>false))?>
<?php echo $this->html->td('tags_so_'.$this->banner[$i]['_id'],$this->banner[$i]['so'],'input',array('enabled'=>$enabled,'class'=>'c so','full'=>1,'button'=>false))?>
<?php echo $this->html->td('tags_pl_'.$this->banner[$i]['_id'],$this->banner[$i]['pl'],'select',array('enabled'=>$enabled,'class'=>'c s','full'=>1,'button'=>false),array('<strong class="pl0">ไม่แสดง</strong>','<strong class="pl1">แสดง</strong>'))?>
<td class="x">
<?php if($this->access):?>
<a href="javascript:;" onClick="cdel(<?php echo $this->banner[$i]['_id']?>)" class="btn btn-mini"><i class="icon-remove"></i></a>
<?php endif?>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="7" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>
