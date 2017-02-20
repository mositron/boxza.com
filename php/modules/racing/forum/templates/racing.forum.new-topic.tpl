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
$f = $this->c;
$nav='';
while($f && $n=$this->cate[$f]):
	$nav=' <span class="divider">&raquo;</span> <li><a href="/forum/'.($n['sl']?$n['sl']:'c-'.$f).'">'.$n['t'].'</a></li> '.$nav;
	$f=$n['p'];
endwhile;
echo $nav;
?>
 <span class="divider">&raquo;</span><li>เขียนกระทู้ใหม่</li>
<?php if(_::$my):?>
<li class="pull-right" style="margin-left:10px;"><a href="/forum/setting"><i class="icon-white icon-barcode"></i> ปรับแต่งเว็บบอร์ด</a></li>
<?php endif?>
</ul> 

<?php if($this->error){?><div class="error" style="text-align:center; padding:5px;"><p><?php echo implode('</p><p>',$this->error)?></p></div><?php }?>

<form action="<?php echo URL?>" method="post" enctype="multipart/form-data" onSubmit="tinyMCE.triggerSave();" name="post" id="spost">
  <table border="0" cellpadding="3" cellspacing="1" class="forum_post" align="center">
	<tr> 
		<th class="head" colspan="2" height="25">เขียนกระทู้ใหม่</th>
	</tr>
			<tr> 
	  <td class="row1">หัวข้อกระทู้</td>
	  <td class="row2"> <input type="text"  class="tbox" name="title" size="45" maxlength="80" style="width:100%" tabindex="2" value="<?php echo $this->post['title']?>" required></td>
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
     <textarea name="detail" style="width:100%; height:600px" class="mceEditor"><?php if($this->post):?><?php echo htmlspecialchars($this->post['detail'],ENT_QUOTES,'utf-8')?><?php endif?></textarea>
		      <br />
            &nbsp;&bull;&nbsp;<a href="javascript:void(0);" onClick="window.open('http://image.boxza.com/upload?redirect_uri='+encodeURIComponent('http://<?php echo HOST.FORUM_URL?>addform.html')+'&format=html', '_imagehost', 'resizable=yes,width=600,height=450');return false;">อัพโหลดรูปภาพ</a> - ฝากรูปภาพสูงสุด 10MB, ไม่มีลบ ไม่จำกัดจำนวน
          
         <div style="padding:5px 0px">
        <strong>บุคคลที่เกี่ยวข้อง:</strong> (เว้นว่างได้ - เฉพาะกระทู้ที่เกี่ยวกับบุคคลเท่านั้น)
        <div class="api-search-have people">
		<?php for($i=0;$i<count($this->people);$i++):?>
        <div id="api-search-people_<?php echo $this->people[$i]['_id']?>"><input type="hidden" name="people[]" value="<?php echo $this->people[$i]['_id']?>"><a href="http://people.boxza.com/<?php echo $this->people[$i]['lk']?$this->people[$i]['lk']:$this->people[$i]['_id']?>" target="_blank"><?php echo $this->people[$i]['nn']?> <?php echo $this->people[$i]['fn']?> <?php echo $this->people[$i]['ln']?></a>
        <a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
        </div>
        <?php endfor?>
        </div>
        <div class="input-prepend"><span class="add-on">บุคคล</span><input type="text" style="width:250px;" placeholder="  ค้นหา ชื่อ นามสกุล, ชื่อเล่น, ฉายา" class="api-search-input" data-type="people"></div>
        <div class="api-search people"></div>
        </div>

       <div style="padding:5px 0px">
        <strong>สถานที่ที่เกี่ยวข้อง:</strong> (เว้นว่างได้ - เฉพาะกระทู้ที่เกี่ยวกับสถานที่เท่านั้น)
        <div class="api-search-have place">
		<?php for($i=0;$i<count($this->place);$i++):?>
        <div id="api-search-place_<?php echo $this->place[$i]['_id']?>"><input type="hidden" name="place[]" value="<?php echo $this->place[$i]['_id']?>"><a href="http://place.boxza.com/<?php echo $this->place[$i]['lk']?$this->place[$i]['lk']:$this->place[$i]['_id']?>" target="_blank"><?php echo $this->place[$i]['n']?></a>
        <a href="javascript:;" class="btn btn-mini pull-right" onclick="$(this).parent().remove()"><i class="icon-trash"></i> ลบ</a>
        </div>
        <?php endfor?>
        </div>
        <div class="input-prepend"><span class="add-on">สถานที่</span><input type="text" style="width:250px;" placeholder="  ค้นหา ชื่อสถานที่, ที่อยู่, ตำแหน่ง" class="api-search-input" data-type="place"></div>
        <div class="api-search place"></div>
        </div>
        
        <div style="padding:5px 0px">
            <strong>ป้ายกำกับ / Tags:</strong><br><ul class="api-search-have tag">
            <li class="api-search-tag"><input type="text" class="api-search-input tag" data-type="tag" autocomplete="off" style="width: 30px;"></li>
            <p class="clear"></p>
            </ul>
            <div class="api-search tag"></div>
            <p class="help-block">ปล่อยว่างได้ - (ใช้ , คั่นระหว่างป้ายกำกับแต่ละตัว เพื่อระบุถึงเนื้อหาที่เกี่ยวข้อง, ไม่สามารถใช้อักขระพิเศษได้)</p>
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

<?php
if(is_array($this->cate[$this->c]['a']))
{
	$_limita=0;
	$_imgreq=false;
	if($this->cate[$this->c]['a']['t'])
	{
		if(!$_limita)$_limita=1;
		$_imgreq=true;
	}
	
	if($this->cate[$this->c] && $this->cate[$this->c]['a'])
	{
		if(_::$my['am'] && $this->cate[$this->c]['a']['a'])
		{
			$_limita=intval($this->cate[$this->c]['a']['a']);
		}
		elseif((!_::$my['am']) && $this->cate[$this->c]['a']['m'])
		{
			$_limita=intval($this->cate[$this->c]['a']['m']);
		}
	}
	if($_limita)
	{
?>
<tr><td class="row1"><strong>รูปภาพ</strong></td><td class="row2">
<div><input type="file" name="attach1" class="span4"<?php echo $_imgreq?' required':''?>><?php echo $_imgreq?'*':''?></div>
<?php for($i=2;$i<=intval($_limita);$i++):?>
<div><input type="file" name="attach<?php echo $i?>" class="span4"><!-- : โค๊ดสำหรับแทรกในเนื้อหาคือ [attach=<?php echo $i?>]--></div>
<?php endfor?>
(ปล่อยว่างได้, เฉพาะรูปภาพเท่านั้น รองรับไฟล์ jpg, png, gif)
</td></tr>
<?php
	}
	if(($f=$this->cate[$this->c]['a']['f']) && is_array($f))
	{
		foreach($f as $fk=>$fv)
		{
?>
<tr><td class="row1"><strong><?php echo $fv[0]?></strong></td><td class="row2">
<div><input type="text" name="f_<?php echo $fk?>" class="span4"<?php echo $fv[2]?' required':''?>> <?php echo $fv[2]?'*':''?></div>
</td></tr>
<?php
		}	
	}
}
?>

<tr><td class="row1">ไอคอน</td><td class="row2">
<?php for($i=1;$i<=14;$i++):?>
<label style="margin:0px 5px; display:inline"><input type="radio" name="icon" id="posticon<?php echo $i?>" value="<?php echo $i?>"<?php echo ($this->post['icon']==$i)||(!$this->post['icon']&&$i==1)?' checked="checked"':''?> /> <img src="http://s0.boxza.com/static/images/forum/posticon/<?php echo $i?>.gif" /></label>
<?php endfor?>
</td></tr>
<?php if(_::$my['am']):?>
<tr><td class="row1">เพิ่มเติม</td><td class="row2">
<?php if(_::$my['am']>=9):?>
<label><input name="sticky" type="checkbox" id="sticky" value="1"<?php echo $this->topic['sk']?' checked="checked"':''?> /> ปักหมุดกระทู้นี้</label>
<?php endif?>
<label><input name="lock" type="checkbox" id="lock" value="1"<?php echo $this->topic['lo']?' checked="checked"':''?> /> ล็อคกระทู้นี้</label>
<label><input name="recommend" type="checkbox" id="recommend" value="1"<?php echo $this->topic['rc']?' checked="checked"':''?>> ตั้งเป็นกระทู้แนะนำ</label>
</td></tr>
<?php endif?>
<tr><td colspan="2" style="padding:0px"><div class="form-actions" style="text-align:center; margin:0px 0px 20px 0px"><input type="submit" class="btn btn-primary" value="    บันทึก    " /> <input type="reset" class="btn" value="   ยกเลิก   "></div></td></tr>
  </table>
</form>
