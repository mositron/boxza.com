


<div id="report_line" class="gbox" style="width:350px;">

<form onSubmit="_.ajax.gourl('/line','sendreport',this);_.box.close();return false;">
<div class="gbox_header">แจ้งการละเมิดหรือสแปม</div>
<div class="gbox_content" style="text-align:center">
<?php if($this->line):?>
<input type="hidden" name="line" value="<?php echo $this->line['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<h3>รายละเอียดความผิด</h3>
<?php foreach($this->reason as $k=>$v):?>
<p><label><input type="radio" name="reason" value="<?php echo $k?>"> <?php echo $v?></label></p>
<?php endforeach?>
</div>
<?php else:?>
<div style="padding:30px 50px; text-align:center">ไม่มีข้อความ หรือข้อความนี้อาจจะโดนลบไปแล้ว</div>

<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" รายงาน "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>