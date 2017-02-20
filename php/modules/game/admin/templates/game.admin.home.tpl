<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d p{clear:both}
.table .a{ width:70px}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
.game-flash > li{width:120px; float:left; text-align:center; margin:0px 0px 10px 0px; height:140px;}
.game-flash > li p{height:20px; line-height:20px; overflow:hidden;}
.game-flash > li .btn-group{text-align: center;margin: 0px auto;display: inline-block;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบเกมส์นี้หรือไม่',click:function(){_.ajax.gourl('/admin','delgame',i)}});}
</script>


<div id="newgame" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newgame',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มเกมส์ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="120">ชื่อเกมส์:</td><td align="left"><input type="text" name="title" class="span4 tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<div style="padding:5px; text-align:right">
<a href="javascript:;" class="btn btn-info" onClick="_.box.open('#newgame')"><i class="icon-plus icon-white"></i> เพิ่มเกมส์ใหม่</a> 
</div>

<ul class="breadcrumb">
  <li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
</ul>


<ul class="game-flash">
<?php for($i=0;$i<count($this->game);$i++):?>
<?php $l='/flash/'.$this->game[$i]['_id'].'-'.$this->game[$i]['l'].'.html';?>
<li>
<a href="<?php echo $l?>"><img src="http://s3.boxza.com/game/flash/<?php echo $this->game[$i]['fd']?>/t.jpg"></a>
<p><a href="<?php echo $l?>"><?php echo $this->game[$i]['t']?></a></p>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/admin/<?php echo $this->game[$i]['_id']?>"><i class="icon-wrench"></i> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->game[$i]['_id']?>)"><i class="icon-remove"></i> ลบ</a></li>
  </ul>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<div align="center"><?php echo $this->pager?></div>
