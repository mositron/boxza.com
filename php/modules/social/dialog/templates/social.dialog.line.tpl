


<div id="line_settings" class="gbox" style="width:320px;">

<form onSubmit="_.ajax.gourl('/settings','setline',this);_.box.close();return false;">
<div class="gbox_header">ตั้งค่าเริ่มต้นของไลน์</div>
<div class="gbox_content" style="text-align:center">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<div>ข้อมูลไลน์ที่ต้องการแสดงเมื่อเข้ามายังหน้าไลน์</div>
<p><label><input type="radio" name="line" value="hot"<?php echo (!_::$my['op']['ln'] || _::$my['op']['ln']=='hot')?' checked':''?>> แนะนำ</label></p>
<p><label><input type="radio" name="line" value="friends"<?php echo (_::$my['op']['ln']=='friends')?' checked':''?>> เพื่อน</label></p>
<p><label><input type="radio" name="line" value="me"<?php echo (_::$my['op']['ln']=='me')?' checked':''?>> โดยฉัน</label></p>
</div>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>