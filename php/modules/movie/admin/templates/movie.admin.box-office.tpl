

<div>



<ul class="breadcrumb">
  <li><a href="/" title="หนัง"><i class="icon-home"></i> หนัง</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/admin">ระบบจัดการข้อมูล</a></li>
 <li><span class="divider">&raquo;</span> จัดลำดับหนังทำเงิน Box Office</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#333; text-align:center">จัดลำดับหนังทำเงิน Box Office</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 
<?php for($i=1;$i<=5;$i++):?>
<div class="control-group">
<label class="control-label" for="input05">อันดับที่ <?php echo $i?>:</label>
<div class="controls">
<input id="input05" type="text" class="span2" name="box<?php echo $i?>" value="<?php echo $this->box[$i]['_id']?>" >
<p class="help-block"><?php if($this->box[$i]):?>ปัจจุบันคือเรื่อง:  <?php echo $this->box[$i]['t']?><br><?php endif?>ใส่ id ของหนังเรื่องนั้น</p>
</div>
</div>
<?php endfor?>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/admin">ยกเลิก</a>
</div>
</fieldset>
</form>
            
            

</div>