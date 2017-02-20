

<h4 class="cap">การตั้งค่าการใช้งานทั่วไป</h4>
<ul class="_st">
<li>
<?php if($this->type=='email'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">อีเมล์</th></tr>
<tr><td class="colum">อีเมล์สำหรับล็อคอิน</td><td><?php echo _::$my['em']?> (<a href="javascript:;" onClick="_.box.load('/dialog/email #change_email')">เปลี่ยนอีเมล์</a>)</td></tr>
<tr><td class="colum">สถานะ</td><td><?php echo _::$my['st']?'<strong>ยืนยันแล้ว</strong>':'<strong>รอการยืนยัน</strong>'?>
<?php if(!_::$my['st']):?>
<br><br>
<strong>วิธีการยืนยัน</strong> (เลือกอย่างใดอย่างหนึ่ง)<br>
1. <input class="button" type="button" value=" ยืนยันการสมัครสมาชิกด้วย Facebook " onClick="_.ajax.gourl('/settings/','setsc','fb','verify')"><br>
หรือ<br>
2. <input class="button" type="button" value=" ส่งอีเมล์ยืนยันการสมัครสมาชิกอีกครั้ง " onClick="_.ajax.gourl('/settings','sendconfirm')"><br>
<div style="border:1px solid #f5f5f5; padding:5px; margin:5px 0px;">ระบบทำการส่งข้อมูลการยืนยันไปยังอีเมล์ของท่านแล้ว หากยังไม่ได้รับอีเมล์ดังกล่าว กรุณาคลิกที่ปุ่มด้านล่างนี้ เพื่อทำการส่งข้อมูลการยืนยันอีกครั้ง</div>
หรือ <a href="/settings" class="h">ยกเลิก</a>
<?php endif?>
</td></tr>
</table>
<?php if(isset($_GET['verified'])):?>
<?php if($_GET['verified']=='1'):?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #eee; color:#390">ยืนยันการสมัครสมาชิกเรียบร้อยแล้ว</div>
<?php elseif($_GET['verified']=='2'):?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #c00; color:#f00">ไม่สามารถยืนยันผ่านบัญชี facebook ได้ กรุณาใช้ facebook account: <?php echo _::$my['em']?></div>
<?php else:?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #c00; color:#f00">facebook account: <?php echo _::$my['em']?> นี้ ไม่สามารถยืนยันการสมัครสมาชิกได้</div>
<?php endif?>
<?php endif?>
</div>
<?php elseif(_::$my['st']):?>
<a href="/settings/email" class="h">
<span class="n">อีเมล์</span>
<span class="t"><?php echo _::$my['em']?> (ยืนยันแล้ว)</span>
<span class="e"></span>
<p></p>
</a>
<?php else:?>
<a href="/settings/email" class="h">
<span class="n">อีเมล์</span>
<span class="t"><?php echo _::$my['em']?> (รอการยืนยัน)</span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>
<li>
<?php if($this->type=='name'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="name">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">แก้ไขชื่อ-นามสกุล</th></tr>
<tr><td class="colum">ชื่อ</td><td><input type="text" class="tbox" name="first" value="<?php echo _::$my['if']['fn']?>" style="width:300px;" required></td></tr>
<tr><td class="colum">นามสกุล</td><td><input type="text" class="tbox" name="last" value="<?php echo _::$my['if']['ln']?>" style="width:300px;" required></td></tr>
<tr><td></td><td><input type="submit" value=" บันทึก " class="button blue"> </td></tr>
</table>
<h4 style="margin:5px; background:#f5f5f5; padding:5px; text-align:center">ข้อกำหนด</h4>
<div style="line-height:1.6em; padding:5px 0px 5px 30px; text-align:left">
- ไม่สามารถใช้อักขระพิเศษเหล่านี้ได้  ​ !@#$%^&*()_+-={}[]:";\'?/.,<>`~ 
</div>
</form>
</div>
<?php else:?>
<a href="/settings/name" class="h">
<span class="n">ชื่อ-นามสกุล</span>
<span class="t"><?php echo _::$my['name']?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>

<li>
<?php 
	$prov=(array)$this->prov;
	$prov['0']=array('name_th'=>'ต่างประเทศ');
	$_b=explode('-',date('d-m-Y',(_::$my['if']['bd']?_::$my['if']['bd']->sec:time())));
?>
<?php if($this->type=='profile'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="profile">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">ข้อมูลส่วนตัว</th></tr>
<tr><td class="colum">เพศ</td><td>
<select name="gender"class="tbox">
<?php foreach(_::$config['gender'] as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==_::$my['if']['gd']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">วันเดือนปีเกิด</td><td style="vertical-align:top">
<select name="bday" class="tbox" required><option value="">วัน</option><?php for($i=1;$i<=31;$i++):?><option value="<?php echo ($j=substr('00'.$i,-2))?>"<?php echo $_b[0]==$j?' selected':''?>><?php echo $j?></option><?php endfor?></select>
/
<select name="bmonth" class="tbox" required>
<option value="">เดือน</option>
<option value="01"<?php echo $_b[1]=='01'?' selected':''?>>มกราคม</option>
<option value="02"<?php echo $_b[1]=='02'?' selected':''?>>กุมภาพันธ์</option>
<option value="03"<?php echo $_b[1]=='03'?' selected':''?>>มีนาคม</option>
<option value="04"<?php echo $_b[1]=='04'?' selected':''?>>เมษายน</option>
<option value="05"<?php echo $_b[1]=='05'?' selected':''?>>พฤษภาคม</option>
<option value="06"<?php echo $_b[1]=='06'?' selected':''?>>มิถุนายน</option>
<option value="07"<?php echo $_b[1]=='07'?' selected':''?>>กรกฏาคม</option>
<option value="08"<?php echo $_b[1]=='08'?' selected':''?>>สิงหาคม</option>
<option value="09"<?php echo $_b[1]=='09'?' selected':''?>>กันยายน</option>
<option value="10"<?php echo $_b[1]=='10'?' selected':''?>>ตุลาคม</option>
<option value="11"<?php echo $_b[1]=='11'?' selected':''?>>พฤศจิกายน</option>
<option value="12"<?php echo $_b[1]=='12'?' selected':''?>>ธันวาคม</option>
</select>
/
<select name="byear" class="tbox" required><option value="">ปี พ.ศ.</option><?php for($i=date('Y')-10;$i>=date('Y')-110;$i--):?><option value="<?php echo $i?>"<?php echo $_b[2]==$i?' selected':''?>><?php echo $i+543?></option><?php endfor?></select>
</td>
</tr>

<tr><td class="colum">สถานะความสัมพันธ์</td><td>
<select name="relate"class="tbox">
<?php foreach(_::$config['relate'] as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==_::$my['if']['rl']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>


<tr><td class="colum">จังหวัด</td><td>
<select name="prov"class="tbox">
<?php foreach($prov as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==_::$my['if']['pr']?' selected':''?>><?php echo $v['name_th']?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">แนะนำตัว</td><td>
<textarea class="tbox" style="width:99%; height:150px;" name="info" placeholder="อธิบายเกี่ยวกับคุณ"><?php echo _::$my['pf']['if']?></textarea><br>
ปล่อยว่างได้, สูงสุดไม่เกิน 1,000 ตัวอักษร และไม่สามารถใช้ html ได้
</td>
</tr>
<tr><td class="colum">เว็บไซต์</td><td>
<?php for($i=0;$i<5;$i++):?>
<input type="url" name="website" class="tbox" style="width:99%; margin-bottom:5px;" value="<?php echo _::$my['pf']['ws'][$i]?>" placeholder="http://">
<?php endfor?>
<br> ปล่อยว่างได้, สูงสุดได้ 5 ลิ้งค์
</td>
</tr>
<tr><td></td><td colspan="2"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/profile" class="h">
<span class="n">ข้อมูลส่วนตัว</span>
<span class="t"><?php echo _::$config['gender'][_::$my['if']['gd']]?>, <?php echo $prov[_::$my['if']['pr']]['name_th']?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>


<?php /*
<li>
<?php if($this->type=='connect'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="connect">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="3">การติดต่อฉัน</th></tr>
<tr><td class="colum">เปิด/ปิดรับการติดต่อ</td>
<td>
<?php $pgd=array(0=>'รับเฉพาะการติดตาม (follow)',1=>'รับเพื่อนและรับการติดตาม (friend/follow)')?>
<select name="if_ac" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['if']['ac'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<tr><td></td><td colspan="2"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/connect" class="h">
<span class="n">การติดต่อฉัน</span>
<span class="t"><?php echo _::$my['if']['ac']==1?'รับเพื่อนและรับการติดตาม (friend/follow)':'รับเฉพาะการติดตาม (follow)'?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>
*/
?>

<li>
<?php if($this->type=='access'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="access">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="3">สิทธิ์เข้าถึงโปรไฟล์ของฉัน</th></tr>
<?php /*
<tr><td class="colum">โปรไฟล์ทั้งหมด</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน')?>
<select name="pf_al" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['al'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
*/ ?>
<tr><td class="colum">โพสบนไลน์ของฉัน</td>
<td>
<?php $pgd=array('0'=>'สมาชิกทุกคน',/*'1'=>'เฉพาะเพื่อน',*/'2'=>'เฉพาะฉัน')?>
<select name="pf_ln" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['ln'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<?php /*
<tr><td class="colum">ส่งข้อความถึงฉัน</td>
<td>
<?php $pgd=array('0'=>'สมาชิกทุกคน','1'=>'เฉพาะเพื่อน')?>
<select name="pf_ms" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['ms'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>

<tr><td class="colum">เพศ</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน','3'=>'ไม่แสดง')?>
<select name="pf_gd" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['gd'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">วันเดือนปีเกิด</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน','3'=>'ไม่แสดง')?>
<select name="pf_bd" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['bd'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
<?php $pgd=array('0'=>'แสดงวันเดือนปี','1'=>'แสดงวันเดือน')?>
<select name="pf_yr" class="tbox" style="margin-top:5px" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['yr'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">สถานะความสัมพันธ์</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน','3'=>'ไม่แสดง')?>
<select name="pf_rl" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['rl'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<tr><td class="colum">จังหวัด</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน','3'=>'ไม่แสดง')?>
<select name="pf_pr" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['pr'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<tr><td class="colum">เพื่อนของฉัน</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน','3'=>'ไม่แสดง')?>
<select name="pf_fr" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['fr'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<tr><td class="colum">รูปภาพของฉัน</td>
<td>
<?php $pgd=array('0'=>'สาธารณะ','1'=>'สมาชิกทุกคน','2'=>'เฉพาะเพื่อน')?>
<select name="pf_pt" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['pf']['pt'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
*/
?>
<tr><td></td><td colspan="2"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/access" class="h">
<span class="n">สิทธิ์เข้าถึงโปรไฟล์ของฉัน</span>
<span class="t"></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>


<li>
<?php if($this->type=='url' && preg_match('/^([0-9]+)$/',_::$my['link'])):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="url">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">แก้ไขลิ้งค์โปรไฟล์</th></tr>
<?php if(!_::$my['st'] || _::$my['st']<1):?>
<tr><td class="colum">ลิ้งค์โปรไฟล์</td><td>
คุณยังยังไม่ได้ยืนยันการสมัครสมาชิก (<a href="/settings/email" class="h button">คลิกที่นี่เพื่อยืนยัน</a>)
</td></tr>
<?php else:?>
<tr><td class="colum">ลิ้งค์โปรไฟล์</td><td><?php echo PROTOCOL?>boxza.com/<input type="text" class="tbox" name="url" size="20" required></td></tr>
<tr><td></td><td><input type="submit" class="button blue" value=" บันทึก "> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
<?php endif?>
</table>
<h4 style="margin:5px; background:#f5f5f5; padding:5px; text-align:center">ข้อกำหนด</h4>
<div style="line-height:1.6em; padding:5px 0px 5px 30px; text-align:left">
- สามารถใช้ตัวอักษร a-z 0-9 . -ได้เท่านั้น<br> 
- ต้องขึ้นต้นและลงท้ายด้วย a-z 0-9 <br>
- ห้ามใช้เฉพาะตัวเลข ในการตั้งชื่อลิงค์ <br>
- ห้ามใช้ . หรือ - <span style="text-decoration:underline">ติดกัน</span>เกิน 1 ตัวอักษร<br>
- ความยาว 3 - 30 ตัวอักษร <br>
- มีสิทธิ์แก้ไขได้เพียงครั้งเดียวเท่านั้น<br>
- หากลิ้งค์ไม่เหมาะสม ลิ้งค์ของท่านจะถูกแก้ไขโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
</div>
</form>
</div>
<?php else:?>
<?php if(preg_match('/^([0-9]+)$/',_::$my['link'])):?>
<a href="/settings/url" class="h">
<span class="n">ลิ้งค์โปรไฟล์ / ชื่ออ้างอิง</span>
<span class="t">http://social.boxza.com/<?php echo _::$my['link']?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php else:?>
<div class="ed">
<span class="n">ลิ้งค์โปรไฟล์ / ชื่ออ้างอิง</span>
<span class="t">http://social.boxza.com/<?php echo _::$my['link']?> / @<?php echo _::$my['link']?></span>
<p></p>
</div>
<?php endif?>
<?php endif?>
</li>

<li>

<?php if($this->type=='facebook'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Facebook</th></tr>
<?php if(is_array($this->fbpage)):?>

<tr><td class="colum">Facebook Account</td><td><?php echo $this->fbid?></td></tr>
<tr><td class="colum">เลือก Facebook Page</td><td>

<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="fbpage">
<?php foreach($this->fbpage as $id=>$val):?>
<div><label><input type="checkbox" name="fbpage" value="<?php echo $id?>"> <?php echo $val['name']?></label></div>

<?php endforeach?>
<input type="submit" class="button blue" value=" บันทึก ">
<br> * สามารถเลือก  Facebook Page สำหรับใช้งานภายใน Boxza ได้สูงสุด 5 page
</form>
</td></tr>
<tr><td class="text-center" colspan="2"></td></tr>
<?php endif?>
<?php if(_::$my['sc']['fb']['id']):?>
<tr><td class="colum">Facebook Account</td><td><?php echo _::$my['sc']['fb']['id']?></td></tr>
<?php if(is_array(_::$my['sc']['fb']['page'])):?>
<tr><td class="colum">Facebook Page</td><td>
<?php foreach(_::$my['sc']['fb']['page'] as $id=>$val):?>
<div><?php echo $val['name']?></div>
<?php endforeach?>
</td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีกับ Facebook</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/facebook" class="h">
<span class="n">บัญชี Facebook</span>
<span class="t"><?php echo _::$my['sc']['fb']['id']?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>

<li>

<?php if($this->type=='google'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Google+</th></tr>

<?php if(isset(_::$my['sc']['gg']['id'])):?>
<tr><td class="colum">Google Account</td><td><?php echo _::$my['sc']['gg']['name']?><br>https://plus.google.com/<?php echo _::$my['sc']['gg']['id']?></td></tr>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','new')">ผูกบัญชีกับ Google+</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/google" class="h">
<span class="n">บัญชี Google</span>
<span class="t"><?php echo isset(_::$my['sc']['gg']['name'])?_::$my['sc']['gg']['name'].' - '._::$my['sc']['gg']['id']:''?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>

<li>

<?php if($this->type=='twitter'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Twitter</th></tr>

<?php if(isset(_::$my['sc']['tw']['id'])):?>
<tr><td class="colum">Twitter Account</td><td><?php echo _::$my['sc']['tw']['name']?></td></tr>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','new')">ผูกบัญชีกับ Twitter</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/twitter" class="h">
<span class="n">บัญชี Twitter</span>
<span class="t"><?php echo isset(_::$my['sc']['tw']['name'])?_::$my['sc']['tw']['name']:''?></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>


<li>
<?php if($this->type=='password'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="password">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขรหัสผ่าน</th></tr>
<tr><td class="colum">รหัสผ่านเดิม</td><td align="left"><input type="password" name="password_old" class="tbox password"></td></tr>
<tr><td class="colum">รหัสผ่านใหม่</td><td align="left"><input type="password" name="password_new" class="tbox password"></td></tr>
<tr><td class="colum">ยืนยันอีกครั้ง</td><td align="left"><input type="password" name="password_confirm" class="tbox password"></td></tr>
<tr><td class="colum"></td><td align="left"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/password" class="h">
<span class="n">รหัสผ่าน</span>
<span class="t">*****</span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>

<li>
<?php if($this->type=='notifications'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="notifications">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="3">การแจ้งเตือนทางอีเมล์</th></tr>
<tr><td class="colum">เพิ่มคุณเป็นเพื่อน</td>
<td>
<?php $pgd=array('0'=>'เปิดใช้งาน','1'=>'ปิดการใช้งาน')?>
<select name="em_rq" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['em']['rq'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">ตอบรับคุณเป็นเพื่อน</td>
<td>
<?php $pgd=array('0'=>'เปิดใช้งาน','1'=>'ปิดการใช้งาน')?>
<select name="em_ac" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['em']['ac'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">โพสต์บนไลน์ของคุณ</td>
<td>
<?php $pgd=array('0'=>'เปิดใช้งาน','1'=>'ปิดการใช้งาน')?>
<select name="em_ln" class="tbox" required>
<?php foreach($pgd as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==intval(_::$my['op']['em']['ln'])?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td></td><td colspan="2"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/notifications" class="h">
<span class="n">การแจ้งเตือนทางอีเมล์</span>
<span class="t"></span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php endif?>
</li>



<li>
<?php if($this->type=='ignore'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">ซ่อนโพสต์จากบุคคลอื่น</th></tr>
<tr><td valign="top">
<div style="padding:0px 0px 0px 140px; line-height:2em" class="st-ig">
<?php $u=_::user()?>
<?php for($i=0;$i<count(_::$my['ct']['ig']);$i++):
						$l = $u->profile(_::$my['ct']['ig'][$i]);
	?>
<p>- <?php echo $l['name']?> - (<span onClick="_.api('/me/line/unignore-<?php echo $l['_id']?>');$('.st-ig p').length>1?$(this).parent().remove():_.line.go('/settings',true);" class="ptr2">ลบ</span>)</p>
<?php endfor?>
</div>
</td></tr>
</table>
</div>
<?php else:?>
<?php if(count(_::$my['ct']['ig'])):?>
<a href="/settings/ignore" class="h">
<span class="n">ซ่อนโพสต์จาก</span>
<span class="t"><?php echo count(_::$my['ct']['ig'])?> บุคคล</span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php else:?>
<div class="ed">
<span class="n">ซ่อนโพสต์จากบุคคลอื่น</span>
<span class="t">-ไม่มี-</span>
<p></p>
</div>
<?php endif?>
<?php endif?>
</li>


<li>
<?php if($this->type=='block'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">ปิดกั้นการติดต่อ</th></tr>
<tr><td valign="top">
<div style="padding:0px 0px 0px 140px; line-height:2em" class="st-bl">
<?php $u=_::user()?>
<?php for($i=0;$i<count(_::$my['ct']['bl']);$i++):
						$l = $u->profile(_::$my['ct']['bl'][$i]);
	?>
<p>- <?php echo $l['name']?> - (<span onClick="_.ajax.gourl('<?php echo URL?>','unblock','<?php echo $l['_id']?>');$('.st-bl p').length>1?$(this).parent().remove():_.line.go('/settings',true);" class="ptr2">ลบ</span>)</p>
<?php endfor?>
</div>
</td></tr>
</table>
</div>
<?php else:?>
<?php if(count(_::$my['ct']['bl'])):?>
<a href="/settings/block" class="h">
<span class="n">ปิดกั้นจาก</span>
<span class="t"><?php echo count(_::$my['ct']['bl'])?> บุคคล</span>
<span class="e">แก้ไข</span>
<p></p>
</a>
<?php else:?>
<div class="ed">
<span class="n">ปิดกั้นจากบุคคลอื่น</span>
<span class="t">-ไม่มี-</span>
<p></p>
</div>
<?php endif?>
<?php endif?>
</li>

<li>
<?php if($this->type=='delete'):?>
<div>
<form onSubmit="if(confirm('คุณต้องการยกเลิกการใช้งาน BoxZa.com หรือไม่ (ไม่สามารถกลับมาใช้งานได้ใหม่)')){_.ajax.gourl('/settings/','settings',this);};return false">
<input type="hidden" name="setting" value="delete">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">ยืนยันการปิดบัญชีภายใน BoxZa.com</th></tr>
<tr><td class="colum">รหัสผ่าน</td><td align="left"><input type="password" name="password_old" class="tbox password"><br><br><strong>ข้อควรระวัง</strong><br>
- หากทำการปิดบัญชีแล้ว จะไม่สามารถกลับมาใช้งานบัญชีนี้ใหม่ได้อีก<br>
- ข้อมูลทั้งหมดของคุณ จะถูกลบออกจากระบบโดยอัตโนมัติ<br>
</td></tr>
<tr><td class="colum"></td><td align="left"><input type="submit" value=" ปิดการใช้งานเดี๋ยวนี้ " class="button blue"> หรือ <a href="/settings" class="h">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/delete" class="h">
<span class="n">ปิดบัญชี / ยกเลิกการใช้งาน</span>
<span class="t"></span>
<span class="e">ยืนยัน</span>
<p></p>
</a>
<?php endif?>
</li>

</ul>