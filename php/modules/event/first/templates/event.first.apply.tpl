<div class="navbar">
  <div class="navbar-inner" style="padding-top:3px;">
    <ul class="nav">
      <li><a href="/first"><i class="icon-home"></i> กิจกรรม</a></li>
    	<li class="divider-vertical"></li>
      <li><a href="/first/list"><i class="icon-list"></i> รูปภาพทั้งหมด</a></li>
    </ul>
    <ul class="nav pull-right">
      <li class="active"><a href="/first/apply"><i class="icon-plus-sign"></i> ลงทะเบียนร่วมกิจกรรม</a></li>
  </ul>
  </div>
</div>

<div class="box-promote" title="ร่วมสนุกกับกิจกรรม Boxza แค่เปิดกล่องก็สนุก">
<div class="l">
<div style="border:1px solid #ccc; border-radius:5px;">
<h4 style="color:#39F; margin:5px; height:30px; line-height:30px; background:#f0f0f0;">เพิ่มรูปถ่ายของคุณ</h4>
<?php if(EVENT_ENABLED!=1):?>

<div style="padding:20px; text-align:center;border:1px solid #F60; background:#f7f7f7">
กิจกรรมนี้ปิดการรับสมัครแล้ว
</div>
<?php elseif(_::$my['st']>0):?>
<div style="margin:5px; font-size:14px">
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>" onSubmit="return confirm('เมื่อทำการบันทึกแล้ว ข้อมูลทั้งหมดจะไม่สามารถแก้ไขได้ คุณต้องการดำเนินการต่อหรือไม่')">
<label>รูปภาพ: <input type="file" name="photo" class="tbox" size="20" accept="image/*" required></label>
<p style="color:#f00">* กติกา: ภาพถ่ายไอเดียสุดเจ๋งกับกล่อง ไม่ว่าจะเป็นสไตล์ไหนก็ได้<br>
และต้องเป็นรูปที่มีคุณและกล่องอยู่ในรูปภาพ *</p>
<label><textarea name="detail" class="tbox" style="width:100%; height:60px" placeholder="คำอธิบายรูปภาพ" required></textarea></label>
<p><input type="submit" class="button blue" value="     สร้างรูปภาพของคุณ    "></p>
</form>
<span style="color:#FF6600; font-size:12px; line-height:1.6em">* เมื่อทำการเพิ่มข้อมูลเรียบร้อยแล้ว ข้อมูลทั้งหมดจะไม่สามารถแก้ไขได้.<br>
หากผิดกติกา ทีมงานสามารถลบได้โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</span>
</div>
<?php if($this->error):?>
<div style="padding:20px; text-align:center;border:1px solid #F60; background:#f7f7f7">
<?php echo implode('<br>',$this->error)?>
</div>

<?php endif?>
<?php else:?>
<div style="padding:20px; text-align:center;border:1px solid #F60; background:#f7f7f7">
คุณยังไม่ได้ทำการยืนยันการสมัครผ่านอีเมล์หรือบัญชี facebook<br>
(<a href="http://social.boxza.com/settings/email">คลิกที่นี่เพื่อยืนยันการสมัครสมาชิก</a>)
</div>
<?php endif?>

</div>
</div>
</div>


<div style="padding:5px; margin:40px 5px 10px; border:1px solid #f0f0f0">
<h4 style="background:#f8f8f8; padding:5px; text-align:center; margin-bottom:10px;">ตัวอย่างรูปภาพที่ถูกต้องตามกติกา</h4>
<div style="text-align:center">
<img src="http://s0.boxza.com/static/images/event/first/sample/1.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/2.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/5.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/6.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/7.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/3.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/4.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/8.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/10.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/11.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/9.jpg" style="margin:5px;">
<img src="http://s0.boxza.com/static/images/event/first/sample/12.jpg" style="margin:5px;">
<p class="clear"></p>
</div>
</div>