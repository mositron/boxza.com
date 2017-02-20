<script>
function del(i){_.box.confirm({title:'ลบแบนเนอร์',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('<?php URL?>','delbanner',i)}});}
</script>
<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="เลสเบี้ยน"><i class="icon-home icon-white"></i> เลสเบี้ยน</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin/banner">แบนเนอร์</a></li>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbanner')"><i class="icon-plus icon-white"></i> เพิ่มแบนเนอร์ใหม่</a></li>
</ul>

<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbanner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มแบนเนอร์ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">ชื่อแบนเนอร์:</td><td align="left"><input type="text" name="title" style="width:200px;" class="tbox"></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div style="margin:5px">
<table cellpadding="1" cellspacing="5" border="0" class="table" width="100%">
<tr><th>แบนเนอร์</th><th style="width:100px"></th></tr>
<?php for($i=0;$i<count($this->banner);$i++):?>

<tr>
<td><a href="/admin/banner/<?php echo $this->banner[$i]['_id']?>"><?php echo $this->banner[$i]['t']?></a></td>
<td><a href="/admin/banner/<?php echo $this->banner[$i]['_id']?>" class="f"><img src="http://s0.boxza.com/static/images/global/edit.gif"></a> <a href="javascript:;" onClick="del('<?php echo $this->banner[$i]['_id']?>');" class="f"><img src="http://s0.boxza.com/static/images/global/del.gif"></a></td>
</tr>
<?php endfor?>
</table>
</div>
<div align="center"><?php echo $this->pager?></div>
</div>
