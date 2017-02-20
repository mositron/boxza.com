<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="http://s0.boxza.com/static/js/boxza.forum.js"></script>

<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->
 <!-- BEGIN - BANNER : C -->
<?php if($this->_banner['c']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['c'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : C -->
 <!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="text-align:center; padding:5px 0px 0px; overflow:hidden">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->


<ul class="breadcrumb" style="margin:5px 0px;">
<li><a href="/" title="รถแต่ง"><i class="icon-white icon-home"></i> รถแต่ง</a></li> <span class="divider">&raquo;</span>
<li><a href="/forum" title="เว็บบอร์ดรถแต่ง"><i class="icon-white icon-list"></i> เว็บบอร์ด</a></li>
<?php 
$f = $this->forum['_id'];
$nav='';
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="/forum/'.($n['sl']?$n['sl']:'c-'.$f).'">'.$n['t'].'</a></li>'.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
 <span class="divider">&raquo;</span> <li><a href="/forum/topic/<?php echo $this->topic['_id']?>"><?php echo $this->topic['t']?></a></li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="/forum/setting"><i class="icon-white icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul> 
<?php if($this->error){?><div class="error" style="text-align:center; padding:5px;"><p><?php echo implode('</p><p>',$this->error)?></p></div><?php }?>
<form action="<?php echo URL?>" method="post" enctype="multipart/form-data" onSubmit="tinyMCE.triggerSave();" name="post" id="spost">
  <table border="0" cellpadding="3" cellspacing="1" class="forum_post" align="center">
	<tr> 
		<th class="head" colspan="2" height="25">ตอบกระทู้</th>
	</tr>
	<tr> 
	  <td class="row1" valign="top"> ส่วนสำหรับพิมพ์ข้อความ 
      <div style="margin:5px 0px; width:200px; text-align:center;">
      <h4 style=" background:#F0F0F0; color:#FF9900; text-align:center">Emotions</h4>
      <div style="padding:5px">
      <?php for($i=1;$i<=48;$i++):?>
      <a href="javascript:;" onClick="_.forum.emo(this)"><img src="http://s0.boxza.com/static/images/forum/emotion/buddybean_<?php echo substr('00'.$i,-2)?>.gif" /></a>
      <?php endfor?>
      </div>
      <h4 style=" background:#F0F0F0; color:#FF9900; text-align:center">Onion</h4>
      <div style="padding:5px; text-align:center;" class="emo-onion">
      <?php foreach(array(1,4,9,10,13,14,16,27,53,57,58,71,72,73,74,75,76,77,78,107,108,109,110,111) as $v):?>
      <a href="javascript:;" onClick="_.forum.emo(this);"><img src="http://s0.boxza.com/static/images/forum/onion/<?php echo $v?>.gif" /></a>
      <?php endforeach?>
      </div>
      [<a href="javascript:void(0);" onClick="window.open('/forum/emoticon', '_onion', 'resizable=yes,width=620,height=450');return false;">ดูเพิ่มเติม</a>]
      </div>
      </td>
	  <td class="row2" valign="top">
     <textarea name="detail" style="width:100%; height:600px" class="mceEditor"><?php if($this->post):?><?php echo htmlspecialchars($this->post['detail'],ENT_QUOTES,'utf-8')?><?php elseif($this->quote):?><?php echo htmlspecialchars($this->quote,ENT_QUOTES,'utf-8')?><?php endif?></textarea>
		  <br />
         &nbsp;&bull;&nbsp;<a href="javascript:void(0);" onClick="window.open('http://image.boxza.com/upload?redirect_uri='+encodeURIComponent('http://<?php echo HOST.FORUM_URL?>addform.html')+'&format=html', '_imagehost', 'resizable=yes,width=600,height=450');return false;">อัพโหลดรูปภาพ</a> - ฝากรูปภาพสูงสุด 10MB, ไม่มีลบ ไม่จำกัดจำนวน
        <div style="padding:10px; text-align:left; margin:5px 0px; color:#c00; border:1px solid #f00">
           <strong>กฏการใช้งานเว็บบอร์ด</strong><br>
           1. ห้ามโพสข้อมูลในเชิงสแปม หรือเพื่อการทำ SEO โดยเด็ดขาด<br>
           2. ห้ามโพสเกี่ยวกับงาน Part-time หรือธุระกิจขายตรงทุกชนิด ทุกค่าย<br>
3. ห้ามโปรโมทเว็บภายนอกที่มีเนื้อหาหรือบริการที่ใกล้เคียงกับเว็บ boxza.com<br>
หากฝ่าฝืน เจ้าหน้าที่จะทำการแบนไอดีสมาชิกท่านทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br>
           </div>
        </td>
	</tr>
   <tr><td colspan="2" style="padding:0px"><div class="form-actions" style="text-align:center; margin:0px 0px 20px 0px"><input type="submit" class="btn btn-primary" value="    บันทึก    " /> <input type="reset" class="btn" value="   ยกเลิก   "></div></td></tr>
  </table>
</form>
