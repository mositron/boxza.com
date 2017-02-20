<div class="span8">

<script>
var cate=<?php echo json_encode($this->cate)?>;
function ccate(e){var v=$(e).val(),d='<option value="">เลือกรายการ</option>';if(v){if(cate[v]){for(var i=0;i<cate[v].l.length;i++)d+='<option value="'+cate[v].l[i]['_id']+'">'+cate[v].l[i]['t']+'</option>'}};$('select[name=catesub]').html(d);}
</script>

<ul class="breadcrumb">
  <li><a href="/" title="ลงประกาศฟรี"><i class="icon-home"></i> ลงประกาศฟรี</a></li>
 <li><span class="divider">&raquo;</span> <a href="/manage" title="จัดการประกาศของคุณ">จัดการประกาศของคุณ</a></li>
 <li><span class="divider">&raquo;</span> สร้างประกาศใหม่</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">ลงประกาศฟรี</h2>
<div style="padding:5px; border:1px solid #ff0000; margin:0px 5px 10px 5px; color:#dd0000; background:#FFF4F8;">
<h4>กฏการโพสภายในบริการนี้</h4>
- ห้ามใช้รูปลามกหรืออนาจารโดยเด็ดขาด<br>
- รูปภาพที่ใช้ต้องเกี่ยวข้องกับสินค้าหรือบริการที่โพส<br>
- ห้ามโพสสินค้าเกี่ยวกับยานอนหลับ, ยาปลุกเซ็กส์ หรือสิ่งผิดกฏหมายทุกชนิด<br>
- ห้ามโพสสินค้าหรือข้อมูลซ้ำโดยเด็ดขาด แต่ให้ใช้การดันประกาศเดิมของตัวเองแทน<br>
* หากฝ่าฝืน เจ้าหน้าที่จะทำการลบสินค้านั้นหรือแบนไอดีสมาชิกทันทีโดยไม่ต้องแจ้งให้ทราบล่วงหน้า(โทษหนักเบาขึ้นอยู่กับความผิด)
</div>
<?php if(count($this->error)):?>
<div style="margin:5px 0px; border:1px solid #ccc; padding:10px; text-align:left;"><?php echo implode('<br>',array_values($this->error))?></div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">หัวข้อประกาศ:</label>
<div class="controls">
<input type="text" id="input01" class="span6" name="title" value="<?php echo $_POST['title']?>" required>
<p class="help-block">* บังคับกรอก, ความยาว 10 - 100 ตัวอักษร</p>
<div style="padding:5px; border:1px solid #ff0000; margin:0px 5px 10px 5px; color:#dd0000; background:#FFF4F8;">ห้ามตั้งสินค้าซ้ำ หรือใช้รูปภาพซ้ำ หากตรวจพบจะทำการลบแอคเค้าท์ผู้ตั้งประกาศนั้นทันที (สินค้าทั้งหมดจะโดนลบด้วย)</div>
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
 <div class="control-group<?php if($this->error['status']):?> error<?php endif?>">
<label class="control-label" for="input07">สภาพสินค้า:</label>
<div class="controls">
<select id="input07" name="status" class="span3"><option value="">เลือกรายการ</option>
<?php foreach($this->status as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $_POST['status']==$key?' selected="selected"':''?>><?php echo $val?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
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
<textarea id="input09" style="height:300px;" class="span6" name="detail" maxlength="3000" minlength="20" required><?php echo $_POST['detail']?></textarea>
<p class="help-block">* บังคับกรอก, ไม่สามารถใช้ html ได้, ความยาว 20 - 3000 ตัวอักษร</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">จังหวัด:</label>
<div class="controls">
<select id="input09" name="province" class="span3" required><option value="">เลือกจังหวัด</option>
<?php if(!isset($_POST['province']))$_POST['province']=1;?>
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
<?php if(_::$my['am']):?>
 <div class="control-group">
<label class="control-label">ตั้งเป็นประกาศแนะนำ:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="recommend" value="0"> ไม่ใช่ประกาศแนะนำ</label>
<?php for($i=1;$i<=5;$i++):?>
<label class="radio inline"><input type="radio" name="recommend" value="<?php echo $i?>"> ตำแหน่งที่ <?php echo $i?></label>
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
<div class="span4">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false"></div>
<?php echo $this->service?>
</div>
