<div class="span8">

<script>
var cate=<?php echo json_encode($this->cate)?>;
function ccate(e){var v=$(e).val(),d='<option value="">เลือกรายการ</option>';if(v){if(cate[v]){for(var i=0;i<cate[v].l.length;i++)d+='<option value="'+cate[v].l[i]['_id']+'">'+cate[v].l[i]['t']+'</option>'}};$('select[name=catesub]').html(d);}
</script>

<ul class="breadcrumb">
  <li><a href="/" title="ลงประกาศฟรี"><i class="icon-home"></i> ลงประกาศฟรี</a></li>
 <li><span class="divider">&raquo;</span> <a href="/manage" title="จัดการประกาศของคุณ">จัดการประกาศของคุณ</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขประกาศ</li>
 </ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขประกาศ</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลประกาศของคุณเรียบร้อยแล้ว  (กลับไปยัง <a href="/manage">จัดการประกาศของคุณ </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">หัวข้อประกาศ:</label>
<div class="controls">
<input type="text" id="input01" class="span6" name="title" value="<?php echo $this->deal['t']?>" required>
<p class="help-block">* บังคับกรอก, ความยาว 10 - 100 ตัวอักษร</p>
</div>
</div>
 <div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">หมวดสินค้า:</label>
<div class="controls">
<select id="input02" name="category" class="span3" onChange="ccate(this)" required><option value="">เลือกรายการ</option>
<?php foreach($this->cate as $val):?>
<option value="<?php echo $val['n']['_id']?>"<?php echo $val['n']['_id']==$this->deal['c']?' selected':''?>><?php echo $val['n']['t']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['catesub']):?> error<?php endif?>">
<label class="control-label" for="input03">หมวดย่อย:</label>
<div class="controls">
<select id="input03" name="catesub" class="span3" required><option value="">เลือกรายการ</option>
<?php for($i=0;$i<count($this->cate[$this->deal['c']]['l']);$i++):?>
<?php $v=$this->cate[$this->deal['c']]['l'][$i];?>
<option value="<?php echo $v['_id']?>"<?php echo $v['_id']==$this->deal['cs']?' selected':''?>><?php echo $v['t']?></option>
<?php endfor?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group<?php if($this->error['type']):?> error<?php endif?>">
<label class="control-label" for="input04">ความต้องการ:</label>
<div class="controls">
<select id="input04" name="type" class="span3" required><option value="">เลือกรายการ</option>
<?php foreach($this->type as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $this->deal['ty']==$key?' selected="selected"':''?>><?php echo $val?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input05">ยี่ห้อ:</label>
<div class="controls">
<input id="input05" type="text" class="span3" size="30" name="brand" value="<?php echo $this->deal['b']?>" >
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input06">รุ่น:</label>
<div class="controls">
<input id="input06" type="text" class="span3" size="30" name="ver" value="<?php echo $this->deal['v']?>" >
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input07">สภาพสินค้า:</label>
<div class="controls">
<select id="input07" name="status" class="span3"><option value="">เลือกรายการ</option>
<?php foreach($this->status as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $this->deal['st']==$key?' selected="selected"':''?>><?php echo $val?></option>
<?php endforeach?>
</select>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input08">ราคาสินค้า:</label>
<div class="controls">
<input id="input08" type="text" class="span3" size="10" name="price" value="<?php echo $this->deal['p']?>" > บาท
</div>
</div>
 <div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
<label class="control-label" for="input09">รายละเอียดเพิ่มเติม:</label>
<div class="controls">
<textarea id="input09" style="height:300px;" class="span6" name="detail" maxlength="3000" minlength="20" required><?php echo $this->deal['d']?></textarea>
<p class="help-block">* บังคับกรอก, ไม่สามารถใช้ html ได้, ความยาว 20 - 3000 ตัวอักษร</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">จังหวัด:</label>
<div class="controls">
<select id="input09" name="province" class="span3" required><option value="">เลือกจังหวัด</option>
<?php foreach($this->province as $key=>$val):?>
<option value="<?php echo $key?>"<?php echo $this->deal['pr']==$key?' selected="selected"':''?>><?php echo $val['name_th']?></option>
<?php endforeach?>
</select>
<p class="help-inline">* บังคับเลือก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">

<img src="http://s3.boxza.com/deal/<?php echo $this->deal['fd']?>/s.jpg"><br>

<input type="file" id="input10" class="span3" size="20" name="o1">
</div>
</div>
 <div class="control-group">
<label class="control-label">รูปภาพเพิ่มเติม:</label>
<div class="controls">
<?php for($i=2;$i<=5;$i++):?>
<div><input type="file" class="span3" size="20" name="o<?php echo $i?>"> 
<?php if($this->deal['o'.$i]):?>
<label class="checkbox inline"><input type="checkbox" name="del_o<?php echo $i?>" value="1"> ลบรูปภาพนี้</label> <p class="radio inline">, <a href="http://s3.boxza.com/deal/<?php echo $this->deal['fd'].'/'.$this->deal['o'.$i]?>" target="_blank">ดูรูปภาพ</a></p>
<?php endif?>
</div>
<?php endfor?>
</div>
</div>
 <div class="control-group">
<label class="control-label">วิธีการชำระเงิน:</label>
<div class="controls">
<label class="checkbox inline"><input type="checkbox" name="pay1" value="1"<?php echo $this->deal['p1']?' checked="checked"':''?>> เงินสด</label>
<label class="checkbox inline"><input type="checkbox" name="pay2" value="1"<?php echo $this->deal['p2']?' checked="checked"':''?>> บัตรเครดิต</label>
<label class="checkbox inline"><input type="checkbox" name="pay3" value="1"<?php echo $this->deal['p3']?' checked="checked"':''?>> ผ่อน</label>
<label class="checkbox inline"><input type="checkbox" name="pay4" value="1"<?php echo $this->deal['p4']?' checked="checked"':''?>> เช็ค/ธนาณัติ</label>
</div>
</div>
 <div class="control-group">
<label class="control-label">วิธีรับ-ส่ง สินค้า:</label>
<div class="controls">
<label class="checkbox inline"><input type="checkbox" name="send1" value="1"<?php echo $this->deal['s1']?' checked="checked"':''?>> นัดเจอตามสะดวก</label>
<label class="checkbox inline"><input type="checkbox" name="send2" value="1"<?php echo $this->deal['s2']?' checked="checked"':''?>> ทางพัสดุไปรษณีย์</label>
<label class="checkbox inline"><input type="checkbox" name="send3" value="1"<?php echo $this->deal['s3']?' checked="checked"':''?>> รับสินค้าที่ร้าน</label>
<label class="checkbox inline"><input type="checkbox" name="send4" value="1"<?php echo $this->deal['s4']?' checked="checked"':''?>> ส่งทางบริษัทขนส่ง</label>
</div>
</div>
 <div class="control-group<?php if($this->error['contact']):?> error<?php endif?>">
<label class="control-label" for="input11">ชื่อผู้ติดต่อ:</label>
<div class="controls">
<input id="input11" type="text" class="span3" size="30" name="contact" value="<?php echo $this->deal['ct']?>" required>
<p class="help-inline">* บังคับกรอก</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input12">เว็บไซต์:</label>
<div class="controls">
<input id="input12" type="text" class="span3" size="30" name="website" value="<?php echo $this->deal['ws']?>">
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input13">เบอร์โทรศัพท์:</label>
<div class="controls">
<input id="input13" type="text" class="span3" size="30" name="phone" value="<?php echo $this->deal['ph']?>">
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input13">อีเมล์:</label>
<div class="controls">
<input id="input14" type="text" class="span3" size="30" name="email" value="<?php echo $this->deal['em']?>">
</div>
</div>
 <div class="control-group">
<label class="control-label">การแสดงผล:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="publish" value="1"<?php echo $this->deal['pl']?' checked':''?>> แสดงผลทันที</label>
<label class="radio inline"><input type="radio" name="publish" value="0"<?php echo !$this->deal['pl']?' checked':''?>> ซ๋อนการแสดง</label>
</div>
</div>
 <div class="control-group">
<label class="control-label">ความคิดเห็น:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="comment" value="1"<?php echo $this->deal['cm']?' checked':''?>> แสดงความคิดเห็น</label>
<label class="radio inline"><input type="radio" name="comment" value="0"<?php echo $this->deal['cm']?' checked':''?>> ซ๋อนการใช้งาน</label>
</div>
</div>
<?php if(_::$my['am']):?>
 <div class="control-group">
<label class="control-label">ตั้งเป็นประกาศแนะนำ:</label>
<div class="controls">
<label class="radio inline"><input type="radio" name="recommend" value="0"<?php echo !$this->deal['rc']?' checked':''?>> ไม่ใช่ประกาศแนะนำ</label>
<?php for($i=1;$i<=5;$i++):?>
<label class="radio inline"><input type="radio" name="recommend" value="<?php echo $i?>"<?php echo $this->deal['rc']==$i?' checked':''?>> ตำแหน่งที่ <?php echo $i?></label>
<?php endfor?>
</div>
</div>
<?php endif?>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<button class="btn" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
            
            

</div>
<div class="span4">
<div class="fb-like-box" data-href="https://www.facebook.com/BoxzaNetwork" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false"></div>
<?php echo $this->service?>
</div>
