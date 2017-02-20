


<div id="announced_edit" class="gbox" style="width:400px;">
<form onSubmit="_.ajax.gourl('/line','setannounced',this);_.box.close();return false;">
<div class="gbox_header">แก้ไขข้อความประกาศ</div>
<div class="gbox_content" style="text-align:center;">
<div style="line-height:1.8em; padding:5px 10px 10px 10px; text-align:left">
<textarea class="tbox" name="announced" style="width:100%; height:150px;"><?php echo $this->announced['msg']?></textarea>
</div>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>