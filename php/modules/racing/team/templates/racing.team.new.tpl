
<div class="left pf-l">


<form action="<?php echo URL?>" method="post" enctype="multipart/form-data" class="form-horizontal">
  <fieldset>
    <legend>สร้างทีมใหม่</legend>
  <div class="control-group">
    <label class="control-label" for="title">ชื่อทีม</label>
    <div class="controls"><input type="text" id="title" name="title" placeholder="ชื่อทีม..." class="span6" required></div>
  </div>
  <div class="control-group">
    <label class="control-label" for="detail">รายละเอียด</label>
    <div class="controls"><textarea id="detail" name="detail" placeholder="อธิบายเกี่ยวกับทีม..." class="span6" required></textarea></div>
  </div>
  <div class="control-group">
    <label class="control-label" for="logo">โลโก้ทีม</label>
    <div class="controls"><input type="file" id="logo" name="logo" required> <span class="help-inline">ขนาดรูปประมาณ 100x100 (ระบบจะ resize ให้อัตโนมัติ)</span></div>
  </div>
  <div class="control-group">
    <label class="control-label" for="logo">รูปภาพหน้าปกของทีม</label>
    <div class="controls"><input type="file" id="logo" name="logo" required> <span class="help-inline">ขนาดรูปประมาณ 980x200 (ระบบจะ resize ให้อัตโนมัติ)</span></div>
  </div>
  <div class="control-group">
    <div class="controls">
      <div class="team_eula">
      <h4>กติกาในการสร้างทีมหรือคลับ</h4>
      <ol>
      <li>จะต้องมีสมาชิกภายในทีมอย่างน้อย 5 คน ภายใน 7 วันหลังจากทำการสร้างทีม ไม่เช่นนั้นระบบจะลบทีมของคุณออกโดยอัตโนมัติ</li>
      <li>ภายในทีมจะมีสมาชิก 3ประเภทคือ 1. หัวหน้าทีม(มีคนเดียว) 2. รองหัวหน้าทีม(ไม่จำกัดจำนวน) 3. ลูกทีมหรือสมาชิกทีม(ไม่จำกัด)</li>
      <li>หัวหน้าทีม และรองหัวหน้าทีม จะเป็นผู้ดูแลกระทู้ภายในทีมนั้นๆโดยอัตโนมัติ</li>
      <li>สมาชิกที่สมัครเข้าทีม ต้องผ่านการยินยอมจากหัวหน้าทีมหรือรองหัวหน้าทีมเท่านั้น (Approve)</li>
      <li>สามารถเป็นสมาชิก/รองหัวหน้าทีม/หัวหน้าทีม ได้มากกว่า 1 ทีม</li>
      <li>ทีมที่สร้างขึ้น จะต้องมีอยู่จริง และผู้ที่สร้างจะต้องเป็นบุคคลในทีมนั้นจริงๆ หากใช้ข้อมูลเท็จ แอดมินสามารถลบทีมของคุณได้โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</li>
      <li>หากมีผู้อื่นนำชื่อทีมของคุณไปสร้าง หรือนำไปใช้ สามารถแจ้งให้ผู้ดูแลทราบได้ที่ <a href="http://boxza.com/support" target="_balnk">BoxZa Support</a></li>
      <li>ในกรณีมีชื่อทีมซ้ำกัน และทีมนั้นมีอยู่จริง เจ้าหน้าที่จะยกสิทธิ์ชื่อนั้นให้ทีมที่มีสมาชิกมากกว่าและก่อนตั้งมานานแล้ว ให้เป็นผู้มีสิทธิ์ใช้ชื่อนั้น</li>
      </ol>
      </div>
      <label class="checkbox" style="margin-left:10px; padding:3px 3px 3px 20px; background:#f6f6f6;"><input type="checkbox" id="accept" name="accept" value="1"> ยอมรับเงื่อนไข</label>
    </div>
  </div>
  <div class="form-actions">
  <button type="submit" class="btn btn-primary">สมัครทีม</button>
  <button type="button" class="btn" onClick="window.location.href='/';">ยกเลิก</button>
</div>
  </fieldset>
</form>





</div>
<div class="right pf-r">

</div>
<div class="clear"></div>

