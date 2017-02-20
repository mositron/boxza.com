<script>
function cdel(i){_.box.confirm({title:'ลบคลิปวิดีโอ',detail:'คุณต้องการลบเพลย์ลิสนี้หรือไม่',click:function(){_.ajax.gourl('/manage/playlist','delplaylist',i)}});}</script>
<ul class="breadcrumb">
  <li><a href="/" title="คลิปวิดีโอ"><i class="icon-home"></i> วิดีโอ</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage">จัดการคลิปวิดีโอ</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/manage/playlist">จัดการเพลย์ลิส</a></li>
   <li style="float:right"><a href="javascript:;" onClick="_.box.open('#newplaylist');"><i class="icon-plus"></i> เพิ่มเพลย์ลิสใหม่</a> </li>
</ul>

<div id="newplaylist" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newplaylist',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มเพลย์ลิสใหม่</div>
<div class="gbox_content">
<table cellpadding="10" cellspacing="0" border="0" align="center" width="450" class="tbservice">
<tr><td align="right" class="colum" style="padding-top:10px;">ชื่อเพลย์ลิส:</td><td align="left"><input type="text" name="title" class="span3" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<div id="getplaylist"><?php echo $this->getplaylist?></div>


