


<div id="album_line" class="gbox" style="width:550px;">

<form onSubmit="_.ajax.gourl('/photos','setalbum',this);_.box.close();return false;">
<div class="gbox_header">แก้ไขอัลบั้ม</div>
<div class="gbox_content" style="text-align:center">
<?php if($this->album):?>
<input type="hidden" name="line" value="<?php echo $this->album['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<h3>แก้ไขอัลบั้ม</h3>
<table cellpadding="5" cellspacing="1" width="100%" border="0">
<tr>
<td align="right" width="100">ชื่ออัลบั้ม</td>
<td><input type="text" class="tbox" name="title" value="<?php echo $this->album['tt']?>" style="width:300px" required></td>
</tr>
<tr>
<td align="right" width="100">ประเภทอัลบั้ม</td>
<td>
<select name="category" class="tbox" required><option value="">เลือกประเภท</option>
<?php foreach(_::$config['album'] as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->album['pt']['ty']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select></td>
</tr>
<tr>
<td align="right" width="100">รายละเอียด</td>
<td><textarea class="tbox" name="detail" style="width:350px; height:100px;"><?php echo $this->album['ms']?></textarea></td>
</tr>
<tr>
<td align="right" width="100">การแสดงผล</td>
<td>
<?php $a=array('0'=>'สาธารณะ','-1'=>'เฉพาะเพื่อน','-2'=>'เฉพาะฉัน');?>
<select name="in" class="tbox">
<?php foreach($a as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo in_array($k,$this->album['in'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
</table>
</div>
<?php else:?>
<div style="padding:30px 50px; text-align:center">คุณไม่สามารถเข้าถึงข้อมูลนี้ได้</div>

<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" รายงาน "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>