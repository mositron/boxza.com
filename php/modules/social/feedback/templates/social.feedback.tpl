
<style type="text/css">
#frmcamp .tbservice .colum {width: 120px !important;}
.tmp_colum{background:#F5F5F5;}
.tmp_colum td{background:#FFFFFF;text-align:center; }
.tmp_colum .h{background:#4BA1D8; color:#FFF}

#completed{font-size: 14px; display:none;padding: 30px;text-align: center;margin: 20px 10px 20px 5px;border: 1px solid #E0E0E0;background-color: white;text-shadow: 1px 1px 0px #FCFCFC;box-shadow: 5px 5px 0px #FAFAFA;border-radius: 3px;}

.feedback{width:560px; height:340px; background:url(//s0.boxza.com/static/images/profile/feedback.png) left top no-repeat; position:relative; text-align:center;}
.info{position: absolute;right: 15px;top: 70px;width: 320px;font-size: 16px;line-height: 26px; text-align:left}
.info p{text-indent: 20px;}
.info strong{ color:#00A1DD}
h3.f{color:#0099D2; background:#f8f8f8; height:28px; line-height:28px; margin:5px 10px; padding-left:10px; text-align:center}
.colum{text-align:right}
</style>




<div class="left pf-l">
<div class="feedback">

<div class="info" title="เสนอแนะ"><p>มาร่วมกันปรับปรุง <strong>boxza.com</strong> ของพวกเราให้ดียิ่งขึ้นและตรงกับความต้องการของคนไทยให้มากยิ่งขึ้น ให้สมชื่อว่าเป็นสังคมออนไลน์สัญชาติไทยกันเถอะ</p>
<p>ที่นี่เปิดโอกาสให้สมาชิกแนะนำและติชมหรือแจ้งปัญหาการใช้งานต่างๆ เพื่อนำไปต่อยอดและปรับปรุง การใช้งานให้ <strong>"โดน"</strong> ใจผู้ใช้มากขึ้น ขอขอบคุณที่ให้ความร่วมมือล่วงหน้านะคะ</p>
</div>
</div>

<h3 class="f">แจ้งปัญหา  / เสนอแนะ</h3>

<div id="completed">ขอบคุณค่ะสำหรับข้อมูลของท่าน ทางเราจะพัฒนาและปรังปรุงระบบให้ดียิ่งๆขึ้นไป</div>

<form onSubmit="<?php if(_::$my):?>_.ajax.gourl('<?php echo URL?>','newfeedback',this);<?php endif?>return false" id="feedback">
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<tr><td class="colum">เกี่ยวกับ <small>:</small></td><td valign='top'><select name="cate" class="tbox"><option value="social">ระบบโซเชียล</option><option value="football"<?php echo $_GET['type']=='football'?' selected':''?>>ฟุตบอล</option><option value="other">อื่นๆ</option></select></td></tr>
<tr><td class="colum">หัวข้อ <small>:</small></td><td valign='top'><input type="text" class="tbox" name="title" style="width:420px" value="" maxlength="40" required><br>* สูงสุดไม่เกิน 40 ตัวอักษร</td></tr>
<tr><td class="colum">รายละเอียด <small>:</small></td><td valign='top'><textarea name="detail" class="tbox" style="width:420px; height:300px;" required></textarea><br></td></tr>
<tr><td class="colum"></td><td valign='top'><?php if(_::$my):?><input type="submit" class="button blue" value="ส่งข้อความ"><?php else:?> * กรุณา<a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>">ล็อคอิน</a>ก่อนใช้งานส่วนนี้<?php endif?></td></tr>
</table>
</div>
</form>
<div style="padding:10px; text-align:center; margin:5px 0px; border:1px solid #f0f0f0; background-color:#fafafa">* หรืออีเมล์มาที่ <a href="mailto:support@boxza.com">support@boxza.com</a></div>
</div>
<div class="right pf-r">

<span class="ads-top"></span>
<div class="ads-box"><?php echo $this->service?></div>


</div>
<div class="clear"></div>




