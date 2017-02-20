
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="รถแต่ง"><i class="icon-home"></i> รถแต่ง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span>
    <a href="/admin/car"> ยี่ห้อรถยนต์</a>
    <?php if(_::$my['am']>=9):?>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbrand')"><i class="icon-plus icon-black"></i> เพิ่มยี่ห้อใหม่</a></li>
   <?php endif?>
</ul>

<style>
.thumbnails li:nth-child(6n+1){margin-left:0px; clear:both;}
.thumbnails  li{margin-bottom:5px;}
</style>


<div id="newbrand" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbrand',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มยี่ห้อใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="350">
<tr><td align="right">ชื่อ:</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>


<div class="row-fluid">
<ul class="thumbnails">
<?php foreach($this->brand as $v):?>
<li class="span2">
<a href="/admin/car/<?php echo $v['link']?>" class="thumbnail text-center">
<img src="http://s3.boxza.com/racing/brand/<?php echo $v['link']?>.png">
<p><?php echo $v['en']?><br><?php echo $v['th']?></p>
</a>
</li>
<?php endforeach?>
</ul>
</div>

