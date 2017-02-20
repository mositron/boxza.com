<style>
.tbservice{width:100%; background:#f0f0f0;border-collapse: separate;border-spacing: 1px;}
.tbservice tr td{padding:5px; background:#fff;}
</style>
<div>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="รถแต่ง"><i class="icon-home"></i> รถแต่ง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
	<span class="divider">&raquo;</span>
    <li><a href="/admin/car"> ยี่ห้อรถยนต์</a></li>
	<span class="divider">&raquo;</span>
    <li><a href="/admin/car/<?php echo $this->brand['link']?>"> <?php echo $this->brand['en']?></a></li>
    <?php if($this->canedit):?>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newspec')"><i class="icon-plus icon-black"></i> เพิ่มรุ่นใหม่</a></li>
   <?php endif?>
</ul>


<div id="newspec" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newspec',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มรุ่นใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="350">
<tr><td align="right">ชื่อ:</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
<tr><td align="right">ประเภท:</td><td align="left">
<select name="type">
<option value="0">ไม่มีประเภท</option>
<option value="1">รถเก๋ง</option>
<option value="2">รถกระบะ</option>
<option value="3">รถตู้</option>
<option value="4">SUV (CR-V, Fortuner,...)</option>
<option value="5">MPV (Wish, Innova,...)</option>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center"><?php echo $this->brand['en']?> <?php echo $this->spec['en']?> (<?php echo $this->brand['th']?> <?php echo $this->spec['th']?>)</h2>

<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">รูปภาพ</td><td><img src="http://s3.boxza.com/racing/brand/<?php echo $this->brand['link']?>.png?rand=<?php echo rand(1,999)?>" id="thumb"> <br>
<input type="file" name="thumb" size="20"></td></tr>
<?php echo $this->html->tr('ชื่อภาษาไทย','spec_th_'.$this->spec['_id'],$this->spec['th'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->tr('ชื่อภาษาอังกฤษ','spec_en_'.$this->spec['_id'],$this->spec['en'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
<?php echo $this->html->tr('ลิ้งค์','spec_link_'.$this->spec['_id'],$this->spec['link'],'input',array('full'=>10,'enabled'=>$this->canedit))?>
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


<div id="genlist">
<?php echo $this->genlist?>
</div>
