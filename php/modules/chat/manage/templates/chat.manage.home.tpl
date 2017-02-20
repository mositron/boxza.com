
<style>
<style>
.tab_id{width:50px; text-align:center;}
.tab_published{width:100px;}
.tab_time{width:150px;}
.tab_s{font-weight:bold; color:#F60}
.tab_s strong{ color:#690}
.tab_s strong.ex{ color:#000}
.tab_t{ text-align:left}
.tab_s .cl{padding:5px; text-align:center; margin:5px 0px 0px 0px; border:1px solid #f0f0f0; background-color:#f8f8f8; color:#000; text-shadow:1px 1px 0px #fff; font-weight:normal}
.tbservice th{ text-align:center;}
.tbservice td{border-left:1px solid #fff;border-top:1px solid #fff; text-align:center;}
.tab_name{text-align:left}
.tbservice .l1 td{background-color:#fafafa;}
</style>

<script>
function adel(i){_.box.confirm({title:'ลบแชท ',detail:'คุณต้องการลบห้องลบแชทนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delchat',i);}});}
</script>

<div id="newchat" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('/manage','newchat',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มห้องใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="500">
<tr><td align="right">ชื่อห้อง :</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="btn" value=" บันทึก "> <input type="button" class="btn" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<div>
<ul class="tabs" style="text-align: left;">
<li class="left on"><a href="/manage/" class="h"> ห้องแชทของฉัน</a></li>
<?php if(_::$my['st']>0):?>
<li class="left"><a href="javascript:;" onClick="_.box.open('#newchat')"><i class="icon-plus"></i> เพิ่มห้องใหม่</a></li>
<!--li class="left"><a href="javascript:;" onClick="_.box.alert('ปิดบริการชั่วคราว')"><i class="icon-plus"></i> เพิ่มห้องใหม่</a></li-->
<?php endif?>
<p class="clear"></p>
</ul>

<div style="margin:5px 0px 0px 0px; border:1px solid #f00; background:#fff4f8; color:#d00; text-align:center; padding:5px;">ระบบจะทำการลบห้องที่ไม่มีการใช้งานนานเกิน 7 วัน โดยอัตโนมัติ</div>

<div style="padding:5px; margin-bottom:5px;">
<?php if(_::$my['st']>0):?>
<div id="getchat"><?php echo $this->getchat?></div>
<?php else:?>
<div style="padding:20px; border:1px solid #f0f0f0; font-size:14px; text-align:center; line-height:2em;">
คุณยังไม่ได้ยืนยันการสมัครสมาชิก<br> กรุณายืนยันการสมัครสมาชิกก่อนใช้งานส่วนนี้ หรือ <a href="http://social.boxza.com/settings/email" target="_blank">คลิกที่นี่ เพื่อยืนยันการสมัครสมาชิก</a>
</div>
<?php endif?>
</div>
</div>


