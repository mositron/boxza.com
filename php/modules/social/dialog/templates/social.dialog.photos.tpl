<div id="photos_newalbum" class="gbox" style="width:500px" onopen="_.profile.img.up()">
<form onSubmit="_.ajax.gourl('/photos','newalbum',this);_.box.close();return false;">
<div class="gbox_header">สร้างอัลบั้มรูปภาพ</div>
<div class="gbox_content" style="text-align:left;">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">ชื่ออัลบั้ม</td><td align="left"><input type="text" name="title" class="tbox" style="width:200px"></td></tr>



<tr>
<td class="colum">ประเภทอัลบั้ม</td>
<td>
<select name="category" class="tbox" required><option value="">เลือกประเภท</option>
<?php foreach(_::$config['album'] as $k=>$v):?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php endforeach?>
</select></td>
</tr>
<tr>

</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</form>
</div>