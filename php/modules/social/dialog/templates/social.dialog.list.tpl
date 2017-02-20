<div id="editlist" class="gbox" style="width:350px;">
<form onSubmit="_.ajax.gourl('/line','listgroup',{'list':<?php echo _::$path[1]?>,'type':'update','name':this.name.value});_.box.close();return false;">
<div class="gbox_header">แก้ไขชื่อรายการ</div>
<div class="gbox_content" style="text-align:center; padding:5px;">
<?php
$found=false;
if(_::$path[1])
{
	$c=intval(_::$path[1])-1;
	if(isset(_::$my['ct']['gp'][$c]))
	{
		$found=_::$my['ct']['gp'][$c];
	}
}
?>
<?php if($found):?>
<p><label>ชื่อรายการ:  <input type="text" name="name" class="tbox" value="<?php echo $found['n']?>" style="width:200px;" maxlength="30"></label></p>
<?php else:?>
<div style="padding:30px 50px; text-align:center">ไม่มีรายการนี้</div>
<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div id="newlist" class="gbox" style="width:350px;">
<form onSubmit="_.ajax.gourl('/line','listgroup',{'type':'insert','name':this.name.value});_.box.close();return false;">
<div class="gbox_header">สร้างรายการใหม่</div>
<div class="gbox_content" style="text-align:center; padding:5px;">
<p><label>ชื่อรายการ:  <input type="text" name="name" class="tbox" value="<?php echo $found['n']?>" style="width:200px;" maxlength="30"></label></p>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>