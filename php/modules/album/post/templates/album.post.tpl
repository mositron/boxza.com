<script>
var cate=<?php echo json_encode($this->cate)?>;
function ccate(e){var v=$(e).val(),d='<option value="">เลือกรายการ</option>';if(v){if(cate[v]){for(var i=0;i<cate[v].l.length;i++)d+='<option value="'+cate[v].l[i]['_id']+'">'+cate[v].l[i]['t']+'</option>'}};$('select[name=catesub]').html(d);}
</script>
<div class="left pf-l">


<ul class="breadcrumb">
  <li><a href="/" title="อัลบั้ม"><i class="icon-home"></i> อัลบั้ม</a></li>
 <li><span class="divider">&raquo;</span> <a href="/manage" title="จัดการประกาศของคุณ">จัดการประกาศของคุณ</a></li>
 <li><span class="divider">&raquo;</span> สร้างประกาศใหม่</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">ลงประกาศฟรี</h2>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">หัวข้อประกาศ:</label>
<div class="controls">
<input type="text" id="input01" class="span7" name="title" value="<?php echo $_POST['title']?>" required>
<p class="help-block">* บังคับกรอก, ความยาว 10 - 100 ตัวอักษร</p>
</div>
</div>
 <div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">หมวดสินค้า:</label>
<div class="controls">
<select id="input02" name="category" class="span3" onChange="ccate(this)" required><option value="">เลือกรายการ</option>
<?php foreach($this->cate as $val):?>
<option value="<?php echo $val['n']['_id']?>"><?php echo $val['n']['t']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['catesub']):?> error<?php endif?>">
<label class="control-label" for="input03">หมวดย่อย:</label>
<div class="controls">
<select id="input03" name="catesub" class="span3" required><option value="">เลือกรายการ</option></select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['type']):?> error<?php endif?>">
<label class="control-label" for="input04">ความต้องการ:</label>
<div class="controls">
<select id="input04" name="type" class="span3" required><option value="">เลือกรายการ</option>
<?php foreach($this->type as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $_POST['type']==$key?' selected="selected"':''?>><?php echo $val?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input05">ยี่ห้อ:</label>
<div class="controls">
<input id="input05" type="text" class="span3" size="30" name="brand" value="<?php echo $_POST['brand']?>" >
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input06">รุ่น:</label>
<div class="controls">
<input id="input06" type="text" class="span3" size="30" name="ver" value="<?php echo $_POST['ver']?>" >
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input07">สภาพสินค้า:</label>
<div class="controls">
<select id="input07" name="status" class="span3"><option value="">เลือกรายการ</option>
<?php foreach($this->status as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $_POST['status']==$key?' selected="selected"':''?>><?php echo $val?></option>
<?php endforeach?>
</select>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input08">ราคาสินค้า:</label>
<div class="controls">
<input id="input08" type="text" class="span3" size="10" name="price" value="<?php echo $_POST['price']?>" > บาท
</div>
</div>
 <div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
<label class="control-label" for="input09">รายละเอียดเพิ่มเติม:</label>
<div class="controls">
<textarea id="input09" style="height:300px;" class="span7" name="detail" maxlength="3000" minlength="20" required><?php echo $_POST['detail']?></textarea>
<p class="help-block">* บังคับกรอก, ไม่สามารถใช้ html ได้, ความยาว 20 - 3000 ตัวอักษร</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">จังหวัด:</label>
<div class="controls">
<select id="input09" name="province" class="span3" required><option value="">เลือกจังหวัด</option>
<?php foreach($this->province as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $_POST['province']==$key?' selected="selected"':''?>><?php echo $val['name_th']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<input type="file" id="input10" class="span3" size="20" name="o[]" required>
<p class="help-block">* บังคับเลือก, ขนาดรูปใหญ่กว่าหรือเท่ากับ 200x200 pixel</p>
</div>
</div>
 <div class="control-group">
<label class="control-label">รูปภาพเพิ่มเติม:</label>
<div class="controls">
<input type="file" class="span3" size="20" name="o[]">
<input type="file" class="span3" size="20" name="o[]">
<input type="file" class="span3" size="20" name="o[]">
<input type="file" class="span3" size="20" name="o[]">
</div>
</div>
 <div class="control-group">
<label class="control-label">วิธีการชำระเงิน:</label>
<div class="controls">
<label class="checkbox inline"><input type="checkbox" name="pay1" value="1"<?php echo $_POST['pay1']?' checked':''?>> เงินสด</label>
<label class="checkbox inline"><input type="checkbox" name="pay2" value="1"<?php echo $_POST['pay2']?' checked':''?>> บัตรเครดิต</label>
<label class="checkbox inline"><input type="checkbox" name="pay3" value="1"<?php echo $_POST['pay3']?' checked':''?>> ผ่อน</label>
<label class="checkbox inline"><input type="checkbox" name="pay4" value="1"<?php echo $_POST['pay4']?' checked':''?>> เช็ค/ธนาณัติ</label>
</div>
</div>
 <div class="control-group">
<label class="control-label">วิธีรับ-ส่ง สินค้า:</label>
<div class="controls">
<label class="checkbox inline"><input type="checkbox" name="send1" value="1"<?php echo $_POST['send1']?' checked':''?>> นัดเจอตามสะดวก</label>
<label class="checkbox inline"><input type="checkbox" name="send2" value="1"<?php echo $_POST['send2']?' checked':''?>> ทางพัสดุไปรษณีย์</label>
<label class="checkbox inline"><input type="checkbox" name="send3" value="1"<?php echo $_POST['send3']?' checked':''?>> รับสินค้าที่ร้าน</label>
<label class="checkbox inline"><input type="checkbox" name="send4" value="1"<?php echo $_POST['send4']?' checked':''?>> ส่งทางบริษัทขนส่ง</label>
</div>
</div>
 <div class="control-group<?php if($this->error['contact']):?> error<?php endif?>">
<label class="control-label" for="input11">ชื่อผู้ติดต่อ:</label>
<div class="controls">
<input id="input11" type="text" class="span3" size="30" name="contact" value="<?php echo $_POST['contact']?>" required>
<p class="help-inline">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input12">เว็บไซต์:</label>
<div class="controls">
<input id="input12" type="text" class="span3" size="30" name="website" value="<?php echo $_POST['website']?>">
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input13">เบอร์โทรศัพท์:</label>
<div class="controls">
<input id="input13" type="text" class="span3" size="30" name="phone" value="<?php echo $_POST['phone']?>">
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input13">อีเมล์:</label>
<div class="controls">
<input id="input14" type="text" class="span3" size="30" name="email" value="<?php echo $_POST['email']?>">
</div>
</div>

 <div class="control-group">
<label class="control-label">การแสดงผล:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="publish" value="1" checked> แสดงผลทันที</label>
<label class="radio inline"><input type="radio" name="publish" value="0"> ซ๋อนการแสดง</label>
</div>
</div>
 <div class="control-group">
<label class="control-label">ความคิดเห็น:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="comment" value="1" checked> แสดงความคิดเห็น</label>
<label class="radio inline"><input type="radio" name="comment" value="0"> ซ๋อนการใช้งาน</label>
</div>
</div>
<?php if($this->fbtab):?>
 <div class="control-group">
<label class="control-label">แสดงที่ Fanpage:</label>
<div class="controls">
<?php for($i=0;$i<count($this->fbtab);$i++):?>
<label class="checkbox inline"><input type="checkbox" name="fbtab[]" value="<?php echo $this->fbtab[$i]?>"> <?php echo $this->fbtab[$i]?></label>
<?php endfor?>
</div>
</div>
<?php endif?>

<div class="form-actions">
<button type="submit" class="btn btn-primary">สร้างประกาศ</button>
<button class="btn" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
            
            

</div>
<div class="right pf-r">
<div class="ads-box">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="240" data-height="500" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
<h4 class="cp">สนับสนุนโดย<span class="show-tooltip-s" title="สร้างโฆษณาเพื่อเผยแพร่ใน BoxZa"><a href="http://boxza.com/ads/campaign/" class="h">โฆษณาของคุณ</a></span><p></p></h4>
<span class="ads-top"></span>
<div class="_box"><div class="ads"></div></div>

</div>
</div>
<div class="clear"></div>
