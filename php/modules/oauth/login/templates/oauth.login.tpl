

   <div class="olg-log">
      <h2>เข้าสู่ระบบ</h2>
       <div>
       <?php if($this->error):?><div style="padding:5px; margin:5px 5px 0px; color:#fff; background-color:#f00; text-align:center"><?php echo $this->error?></div> <?php endif?>
           <form method="post" action="<?php echo URI.$this->q?>">
           <input type="hidden" name="type" value="login">
         <ul>
            <li class="email"><p>อีเมล์</p> <input name="email" type="email" class="tbox"></li>
               <li class="password"><p>รหัสผ่าน</p> <input name="password" type="password" class="tbox"></li>
               <li><p></p><label> <input name="aways" type="checkbox" value="1"> เข้าสู่ระบบอัตโนมัติ (ล็อคอินแบบถาวร)</label></li>
               <li class="btnlogin"><p></p><input type="submit" value=" เข้าระบบ " class="olg-btn olg-btn-lg"> | <a href="javascript:;" onClick="_.box.open('#forget')">ลืมรหัสผ่าน</a></li>
            <li><p>หรือ </p> <a href="/login/facebook/<?php echo $this->q?>" class="olg-btn olg-btn-fb" rel="nofollow">เข้าระบบด้วยบัญชี Facebook</a></li>
               
           </ul>
           </form> 
       </div>
   </div>
   <div class="olg-reg">
   <h2>สมัครสมาชิก</h2>
   <div>
    <div>ยังไม่มีบัญชีของ BoxZa? สร้างบัญชีใหม่ฟรี ภายในไม่ถึง 1 นาที</div>
    <div><a href="/signup/<?php echo $this->q?>" class="olg-btn olg-btn-su">สร้างบัญชีใหม่</a></div>
    <div> หรือ <a href="/signup/facebook/<?php echo $this->q?>" class="olg-btn olg-btn-fb" rel="nofollow">สมัครสมาชิกด้วยบัญชี Facebook</a></div>
    </div>
</div>
<div id="forget" class="gbox" style="width:450px">
<form onSubmit="_.ajax.gourl('/login','forget',this);_.box.close();return false;">
<div class="gbox_header">ลืมรหัสผ่าน</div>
<div class="gbox_content" style="text-align:left;">
<table cellpadding="10" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">อีเมล์</td><td align="left"><input type="text" name="email" class="tbox" style="width:200px"></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ขอเปลี่ยนรหัสผ่าน "> <input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</form>
</div>

