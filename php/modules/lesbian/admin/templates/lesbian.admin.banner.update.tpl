<style>


.tbservice{width:100%; background:#f0f0f0;border-collapse: separate;border-spacing: 1px;}
.tbservice tr td{padding:5px; background:#fff;}
</style>
<div>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="เลสเบี้ยน"><i class="icon-home icon-white"></i> เลสเบี้ยน</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/banner">แบนเนอร์</a></li>
</ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center"><?php echo $this->banner['t']?></h2>

<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<?php echo $this->html->tr('ชื่อแบนเนอร์','banner_t_'.$this->banner['_id'],$this->banner['t'],'input',array('full'=>10))?>
<tr><td class="colum">รูปภาพ</td><td><img src="http://s3.boxza.com/lesbian/banner/<?php echo $this->banner['_id']?>.jpg" id="thumb"> <br>
<input type="file" name="thumb" size="20"><br>
* ขนาด 650 x 385  pixel
</td></tr>

<?php echo $this->html->tr('ลิ้งค์ปลายทาง','banner_l_'.$this->banner['_id'],$this->banner['l'],'input',array('full'=>10))?>
<?php echo $this->html->tr('รายละเอียด','banner_d_'.$this->banner['_id'],$this->banner['d'],'textarea',array('full'=>10))?>
<?php echo $this->html->tr('แสดงผล','banner_pl_'.$this->banner['_id'],$this->banner['pl'],'select',array('full'=>10),array(0=>'ไม่แสดงผล',1=>'แสดงผล'))?>
</table>
</div>

<script>

$('input[name=thumb]').change(function(e){
	if($(this).val())
	{
		_.upload.start(this,null,function(b){if(b.status=='OK'){$('#thumb').attr('src',b.pic);}else{_.box.alert(b.message);}});
	}
});
</script>