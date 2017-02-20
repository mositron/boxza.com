<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/boxza.forum.js"></script>
<ul class="breadcrumb" style="margin-bottom:5px;">
<?php if(defined('FORUM_IN')):?>
<li><a href="/" title="ผู้หญิง"><i class="icon-home"></i> ผู้หญิง</a></li> <span class="divider">&raquo;</span> 
<?php endif?>
<li><a href="<?PHP echo FORUM_URL?>" title="เว็บบอร์ด"><i class="icon-list"></i> เว็บบอร์ด</a></li>
<?php 
$f = $this->forum['_id'];
$nav='';
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="'.FORUM_URL.'c-'.$f.'">'.$n['t'].'</a></li> '.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
 <span class="divider">&raquo;</span> <li><a href="<?PHP echo FORUM_URL?>topic/<?php echo $this->topic['_id']?>"><?php echo $this->topic['t']?></a></li>
 
</ul> 
<?php if($this->error){?><div class="error" style="text-align:center; padding:5px;"><p><?php echo implode('</p><p>',$this->error)?></p></div><?php }?>
<form action="<?php echo URL?>" method="post" enctype="multipart/form-data" onSubmit="tinyMCE.triggerSave();" name="post" id="spost">
  <table border="0" cellpadding="3" cellspacing="1" class="forum_post" align="center">
	<tr> 
		<th class="head" height="25">ตอบกระทู้</th>
	</tr>
	<tr> 
	  <td class="row2" valign="top">
		<textarea name="detail" style="width:100%; height:600px" class="mceEditor"><?php if($this->post):?><?php echo htmlspecialchars($this->post['detail'],ENT_QUOTES,'utf-8')?><?php elseif($this->quote):?><?php echo htmlspecialchars($this->quote,ENT_QUOTES,'utf-8')?><?php endif?></textarea>
	   <div style="margin:5px 0px; text-align:center;">
      <h4 style=" background:#F0F0F0; color:#FF9900; text-align:center">Onion <span style="font-weight:normal; font-size:12px"> [<a href="javascript:void(0);" onClick="window.open('<?php echo FORUM_URL?>emoticon', '_onion', 'resizable=yes,width=620,height=450');return false;">ดูเพิ่มเติม</a>]</span></h4>
      <div style="padding:5px; text-align:center;" class="emo-onion">
      <?php foreach(array(1,4,9,10,13,14,16,27,53,57,58,71,72,73,74) as $v):?>
      <a href="javascript:;" onClick="_.forum.emo(this);"><img src="http://s0.boxza.com/static/images/forum/onion/<?php echo $v?>.gif" /></a>
      <?php endforeach?>
      </div>
      </div>
      
      <div class="forum-upload">
        &nbsp;&bull;&nbsp;<a href="javascript:void(0);" onClick="window.open('http://image.boxza.com/upload?redirect_uri='+encodeURIComponent('http://<?php echo HOST.FORUM_URL?>addform.html')+'&format=html', '_imagehost', 'resizable=yes,width=600,height=450');return false;">อัพโหลดรูปภาพ</a> - ฝากรูปภาพสูงสุด 10MB, ไม่มีลบ ไม่จำกัดจำนวน
        </div>
           <div style="padding:10px; text-align:left; margin:5px 0px; color:#c00; border:1px solid #f00">
           <strong>กฏการใช้งานเว็บบอร์ด</strong><br>
           1. ห้ามโพสข้อมูลในเชิงสแปม หรือเพื่อการทำ SEO โดยเด็ดขาด<br>
           2. ห้ามโพสเกี่ยวกับงาน Part-time หรือธุระกิจขายตรงทุกชนิด ทุกค่าย<br>
3. ห้ามโปรโมทเว็บภายนอกที่มีเนื้อหาหรือบริการที่ใกล้เคียงกับเว็บ boxza.com<br>
หากฝ่าฝืน เจ้าหน้าที่จะทำการแบนไอดีสมาชิกท่านทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br>
           </div>
       </td>
	</tr>
   <tr><td style="padding:0px"><div class="form-actions" style="text-align:center; margin:0px 0px 20px 0px"><input type="submit" class="btn btn-primary" value="    บันทึก    " /> <input type="reset" class="btn" value="   ยกเลิก   "></div></td></tr>
  </table>
</form>
