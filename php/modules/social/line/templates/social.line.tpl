<div class="left pf-l">
<div>

<div style="padding:10px; margin-bottom:10px; text-align:center; border:1px solid #EB3D3D; background:#FDF7F7">
<h3>แจ้งถึงสมาชิกทุกท่าน</h3>
<div> &nbsp; ทาง BoxZa จะทำการปิดบริการ BoxZa Social ในวันที่ 15 มกราคม 2558 เวลา 24.00 น. เนื่องจากทาง BoxZa มีเหตุจำเป็นต้องปิดบริการในส่วนนี้. <br>จึงแจ้งมาเพื่อทราบ.</div>
</div>

<!--div style="padding:0px 0px 10px; text-align:center"><a href="http://football.boxza.com/" title="ฟุตบอลโลก" target="_blank"><img src="http://s3.boxza.com/banner/00/q1/937.gif" alt="ฟุตบอลโลก 2014 บราซิล  - ทายผลบอลโลก ตารางคะแนนฟุตบอลโลก ผลการแข่งขันฟุตบอลโลก 2014" style="width:580px;"></a></div-->

<!--div style="padding:10px; border:1px solid #f00; border-radius:5px; text-align:center; margin:0px 0px 5px 0px; color:#c00; background-color:#FFF9F9"><h4>แจ้งถึงสมาชิกทุกท่าน</h4>
ขณะนี้มีการปรับปรุงระบบและอัพเกรด server บางส่วน ทำให้ระบบสามารถรองรับการใช้งานของสมาชิกได้น้อยลง 
ส่งผลให้เว็บโหลดช้า หรือหน่วงบ้างเป้นบางเวลา ซึ่งระบบทั้งหมดนี้คาดว่าจะทำการปรับปรุงเสร็จสิ้นภายใน 48ชม จึงแจ้งมาให้สมาชิกทราบโดยทั่วกัน.. 
<p align="right">ทีมงาน BoxZa.com</p>
</div-->

<?php if(isset($this->list)):?>
<div style="margin:5px 0px 5px 0px; padding:0px 5px; height:30px; border-bottom:1px solid #f0f0f0;">
<span style="float:left; height:30px; line-height:30px; display:inline-block; font-size:16px"><?php echo $this->list['n']?></span>
<span style="float:right; margin-bottom:4px;"><a href="javascript:;" onClick="_.box.load('/dialog/list #newlist')" class="button">+สร้างรายการใหม่</a></span>
<p class="clear"></p>
</div>
<?php endif?>
<?php if(_::$my['_id']):?>
<div class="_post">
<div>
<form id="spost" onSubmit="return false">
<div>
<div class="av ps-a" av="<?php echo _::$my['_id']?>"><a href="/<?php echo _::$my['link']?>" class="h" title="<?php echo _::$my['name']?>"><img src="<?php echo _::$my['himg']?>"></a></div>
<!--div class="post-title show-tooltip-s" title="หัวเรื่องของเนื้อหานี้ สำหรับแสดงในรูปแบบ Blog"><input type="text" name="title" id="post-title" value="" placeholder="หัวเรื่อง (ปล่อยว่างได้)" maxlength="80"></div-->
<div class="post-wrap"<?php if(!_::$my['st']||_::$my['st']<1):?> style="width:515px;"<?php endif?>><span class="emo emo-1" data-dropdown="#dropdown-chat-emo"></span><textarea name="msg" id="post-msg" tabindex="" onClick="_.post.expand('')" placeholder="เขียนเรื่องราวของคุณ...">แบ่งปันเรื่องใหม่ๆ</textarea></div>
<!--div class="post-tags show-tooltip-s" title="Tags (ป้ายกำกับ): คือคำสั้นๆ สองสามคำ ที่เอาไว้อธิบายเนื้อหาของโพสนี้ เช่น ท่องเที่ยว, ภูเขา, น้ำตก, นครนายก">
<div><i></i> <input type="text" name="tagged" id="post-tagged" style="width:200px;"></div>
</div-->
<?php if(_::$my['st']&&_::$my['st']>0):?>
<a href="javascript:;" onClick="_.post.expand('pin')" class="ln-icon-exp ln-icon-nav ln-icon-pin show-tooltip-s" title="เพิ่มตำแหน่ง"></a>
<a href="javascript:;" onClick="_.post.expand('poll')" class="ln-icon-exp ln-icon-nav ln-icon-poll show-tooltip-s" title="เพิ่มคำถาม"></a>
<a href="javascript:;" onClick="_.post.expand('link')" class="ln-icon-exp ln-icon-nav ln-icon-link show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"></a>
<a href="javascript:;" onClick="_.post.expand('gif')" class="ln-icon-exp ln-icon-nav ln-icon-gif show-tooltip-s" title="เพิ่มรูปภาพเคลื่อนไหวจากกล้องเว็บแคม"></a>
<a href="javascript:;" onClick="_.post.expand('photo')" class="ln-icon-exp ln-icon-nav ln-icon-photo show-tooltip-s" title="เพิ่มรูปภาพ"></a>
<?php endif?>
<p class="clear"></p>
</div>
<div class="post-bar">
<input type="button" id="post-bt" class="button blue" value=" โพสต์ " onClick="_.post.send($('#spost')[0]);">
<div style="float:left; text-align:left">
<span data-dropdown="#dropdown-to" class="button" style="vertical-align:top">ถึง</span>
<div id="lto" class="lto-new">
<?php 
	$to=array('0'=>'สาธารณะ'/*,'-1'=>'เฉพาะเพื่อน'*/,'fb-me'=>'ของฉัน','tw'=>'ของฉัน');
	$opto=(is_array(_::$my['op']['to'])&&count(_::$my['op']['to']))?_::$my['op']['to']:array('0','fb-me','tw');
	foreach($opto as $v):
		$f = explode('-',$v);
		if($f[0]=='fb'||$f[0]=='tw')
		{
			if(!_::$my['sc'][$f[0]])continue;
		}
		$c = ($f[1]?'lto-'.$f[0]:'').' lto-'.$v;
		if(!isset($to[$v]))continue;
?>
<span class="<?php echo $c?>"><p></p><input type="hidden" name="to" value="<?php echo $v?>"> <?php echo $to[$v]?> <i onClick="_.post.delto(this)"></i></span>
<?php
	endforeach;
?>
</div>

<div id="dropdown-to" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
   <li><div class="find-people-panel"><span><input type="text" name="q"  placeholder="ค้นหาเพื่อน" class="find-people tbox" style="width:100%;" data-friend="2" data-func="insert_to_post"></span></div></li>
   <li class="dropdown-divider"></li>
  <li><a href="javascript:;" onClick="_.post.group(this,'0')">สาธารณะ</a></li>
   <!--li><a href="javascript:;" onClick="_.post.group(this,'-1')">เฉพาะเพื่อน</a></li-->
   <li class="dropdown-divider"></li>
   <?php if(_::$my['sc']['tw']):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'tw')"> Twitter ของฉัน</a></li>
   <?php else:?>
   <li><a href="/settings/twitter" class="h">ผูกบัญชีกับ  Twitter</a></li>
   <?php endif?>
   <li class="dropdown-divider"></li>
   <?php if(_::$my['sc']['fb']&&(_::$my['sc']['fb']['v']==2)):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'fb-me')">Facebook - ของฉัน</a></li>
   	<?php if(is_array(_::$my['sc']['fb']['page'])):?>
   		<?php foreach(_::$my['sc']['fb']['page'] as $k=>$v):?>
   <li><a href="javascript:;" onClick="_.post.group(this,'fb-<?php echo $v['id']?>')">Facebook - <?php echo $v['name']?></a></li>
   		<?php endforeach?>
   	<?php endif?>
	<?php else:?>
   <li><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีกับ Facebook</a></li>
   <?php endif?>
    </ul>
</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
<div align="center">
<?php if(!_::$my['st']||_::$my['st']<1):?>
<div style="padding: 5px;text-align: center;border: 1px solid #E0E0E0;line-height: 1.6em;margin: 5px 0px 0px;background: #F5F5F5;">คุณยังไม่ได้ยินยันการสมัครสมาชิก หากต้องการยืนยันการสมัครสมาชิก <a href="/settings/email" class="h">คลิกที่นี่</a></div>
<?php else:?>
<span style="height: 30px;line-height: 30px;display: inline-block;">เพิ่ม : </span>
<div class="btn-group btn-new-attach"><span onClick="_.post.expand('photo')" class="btn show-tooltip-s" title="เพิ่มรูปภาพ"><i class="ln-icon-nav ln-icon-photo"></i> รูปภาพ</span><span onClick="_.post.expand('gif')" class="btn show-tooltip-s" title="เพิ่มรูปภาพเคลื่อนไหวจากกล้องเว็บแคม"><i class="ln-icon-nav ln-icon-gif"></i> ภาพเคลื่อนไหว</span><span onClick="_.post.expand('drawing')" class="btn show-tooltip-s" title="เพิ่มรูปวาด"><i class="ln-icon-nav ln-icon-drawing"></i> วาดรูป</span><span onClick="_.post.expand('link')" class="btn show-tooltip-s" title="เพิ่มลิ้งค์หรือวิดีโอ"><i class="ln-icon-nav ln-icon-link"></i> ลิ้งค์</span><span onClick="_.post.expand('poll')" class="btn show-tooltip-s" title="เพิ่มคำถาม"><i class="ln-icon-nav ln-icon-poll"></i> คำถาม</span><span onClick="_.post.expand('pin')" class="btn show-tooltip-s" title="เพิ่มตำแหน่ง"><i class="ln-icon-nav ln-icon-pin"></i> ตำแหน่ง</span></div>
<?php endif?>
</div>
</div>

<div class="clear"></div>
<div id="lalink"><div><input type="text" class="tbox" id="addlink" style="width:470px"><input type="button" value=" เพิ่ม " class="button" onClick="_.post.getlink($('#addlink').val())"> <img src="http://s0.boxza.com/static/images/global/load.gif" id="lalink_img" style="display:none;vertical-align:middle"></div></div>
<div id="llink"></div>
<div id="lloc"></div>
<?php if(_::$my['st']&&_::$my['st']>0):?>
<div id="lphoto"></div>
<div id="lpoll"></div>
<div id="lgif"></div>
<div id="ldrawing"></div>
<?php endif?>
</form>
</div>

<div style="text-align:left; padding:4px 5px;line-height: 20px;border: 1px solid #e0e0e0;margin: 5px 0px 0px 0px;border-radius: 5px;background: #fff;color: #666;">
<div style="padding:0px 0px 5px; margin:0px 0px 5px; border-bottom:1px solid #e0e0e0; text-align:center">กรุณาโพสข้อความที่สุภาพ และ<strong style="color:#f00">ห้ามอัพรูปภาพอนาจารหรือ หมิ่นเบื้องสูง</strong> โดยเด็ดขาด!!!.</div>
<!--
<h4 class="cp">กฏกติกาการใช้งาน  <small style="font-weight:normal">- เริ่มใช้งาน 21 มีนาคม 2556 เวลา 0.00 น.</small><p></p></h4>
1. ยกเลิกระบบเพื่อน เหลือแต่ระบบติดตาม จำกัดสูงสุด 500 คน<br>
2. ปรับหน้าเพื่อน เป็นแสดงสมาชิกที่คุณติดตาม<br>
3. ปรับระยะเวลาการเก็บข้อมูล ทั้งตัวอักษร และรูปภาพ สามารถดูโพสย้อนหลังได้ 14 วัน<br>
4-11.  อ่านรายละเอียดเพิ่มเติม... <a href="/help" class="h">คลิกที่นี่</a!-->

<h4 class="cp"><strong style="color:#f00">กฏการโพสหรือใช้งาน</strong> <small style="font-weight:normal">(ขอความร่วมมือด้วยนะคะ, ฝ่าฝืน แบนทันที)</small><p></p></h4>
- ห้ามโพสโฆษณาเกี่ยวกับธุรกิจขายตรง หรืองานออนไลน์โดยเด็ดขาด<br>
- ห้ามสแปม หรือโพสขายสินค้า หากต้องการขายสินค้าเชิญที่บริการ <a href="http://market.boxza.com" target="_blank">ลงประกาศฟรี</a> <br>
- ห้ามแสดงความคิดเห็น โดยการโพสเว็บ/โปรโมทเว็บ บนโพสต์ของผู้อื่น<br>
- กติกาการใช้งานอื่นๆ <a href="/help" class="h">คลิกที่นี่</a>
</div>

</div>
<?php endif?>


<div class="bl-tp"></div>
<div class="bl-ct">
<ul class="lnav">
<!--li class="o ul"><a href="/line<?php echo _::$my?'/hot':''?>" class="h ln-page-<?php echo _::$my?'hot':''?><?php echo _::$my&&(!_::$my['op']['ln'] || _::$my['op']['ln']=='hot')?' ln-page-':''?>"><strong>แนะนำ</strong></a></li-->
<li class="o"><a href="/line/connect" class="h ln-page-connect<?php echo _::$my&&(_::$my['op']['ln']=='friends')?' ln-page-':''?>"><strong>เพื่อน/ติดตาม</strong></a></li>
<li class="o"><a href="/line/album" class="h ln-page-album"><strong>อัลบั้ม</strong></a></li>
<li class="o"><a href="/line/draw" class="h ln-page-draw"><strong>ภาพวาด</strong></a></li>
<li class="o"><a href="/line/gif" class="h ln-page-gif"><strong>ภาพเคลื่อนไหว</strong></a></li>
<li class="o"><a href="/line/signup" class="h ln-page-signup"><strong>สมาชิกใหม่</strong></a></li>
<li class="o"><a href="/line/me" class="h ln-page-me<?php echo _::$my&&(_::$my['op']['ln']=='me')?' ln-page-':''?>"><strong>โดยฉัน</strong></a></li>
<li class="s show-tooltip-s" title="ตั้งค่าเริ่มต้นของไลน์"><span onClick="_.box.load('/dialog/line #line_settings')"><i></i></span></li>
<p class="clear"></p>
</ul>
</div>

<div class="line" id="_line">
<?php 
echo $this->line;

if(isset($this->list)&&!count($this->list['u'])):
?>
<div style="padding:50px 30px; text-align:center; margin:5px; border:1px solid #f5f5f5;">
<h2 style="color:#F60; font-size:18px; background-color:#f9f9f9; padding:10px;">คุณยังไม่มีเพื่อนหรือบุคคลที่ต้องการติดตามในรายการนี้</h2>

<div style="width:400px; text-align:left; margin:20px auto">
<strong>วิธีเพิ่มเพื่อนเข้ารายการนี้</strong><br>
1. พิมพ์ชื่อเพื่อนหรือบุคคลที่ติดตามในช่องด้านบนขวาใต้คำว่า "เพื่อนในรายการนี้" (หรือที่เขียนว่า +เพิ่มเพื่อนเข้ารายการนี้)<br>
2. เลือกเพื่อนจากรายการที่แสดง โดนใช้เมาท์คลิก หรือ ใช้ลูกศรขึ้น/ลง แล้วกด Enter<br>
3. หลังจากนั้น รายชื่อเพื่อนจะแสดงให้เห็น
</div>
</div>
<?php
endif;
?>
</div>


</div>
</div>
<div class="right pf-r">
<span class="ads-top"></span>
<div class="ads-box">

<?php if(isset($this->list)):?>
<h4 class="cp">เพื่อนในรายการนี้ <span data-dropdown="#dropdown-list" class="ptr2"> ปรับแต่งแก้ไข </span><p></p></h4>
<ul class="u-in-list">
<?php for($i=0;$i<count($this->list['u']);$i++):?>
<?php $u=$this->user->profile($this->list['u'][$i])?>
<li class="av people-<?php echo $u['_id']?>" av="<?php echo $u['_id']?>" data-button='[{"text":"ลบออกจากรายการนี้","click":"delete_from_list(<?php echo $u['_id']?>)"}]'><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['himg']?>" title="<?php echo $u['name']?>"></a></li>
<?php endfor?>
<p></p>
</ul>
<div style="padding:2px; background:#f5f5f5; margin:2px 0px 2px 2px"><div class="find-people-panel"><span><input type="text" name="q"  placeholder="+ เพิ่มเพื่อนหรือบุคคลที่ติดตามเข้ารายการนี้" class="find-people hsearch" data-friend="3" data-func="insert_to_list"></span></div></div>

<div id="dropdown-list" class="dropdown dropdown-tip">
    <ul class="dropdown-menu">
        <li><a href="javascript:;" onClick="_.box.load('/dialog/list/<?php echo _::$path[1]?> #editlist')">เปลี่ยนชื่อรายการ</a></li>
        <?php if(_::$path[1]!=1):?><li><a href="javascript:;" onClick="delete_list();">ลบรายการนี้</a></li><?php endif?>
    </ul>
</div>

<style>
.u-in-list p{clear:both}
.u-in-list li{width:48px; height:48px; line-height:0px; margin:1px; float:left;}
.u-in-list li.av a{width:46px; height:46px; margin:1px;}
.u-in-list li.av a img{ width:40px; height:40px;}
</style>
<script>
function delete_list(){_.box.confirm({'title':'ลบรายการนี้','detail':'คุณต้องการลบรายการนี้หรือไม่','click':function(){_.ajax.gourl('/line','listgroup',{'list':<?php echo _::$path[1]?>,'type':'delete'})}});}
function insert_to_list(uid){_.ajax.gourl('/line','listgroup',{'list':<?php echo _::$path[1]?>,'type':'add','uid':uid});}
function delete_from_list(uid){_.ajax.gourl('/line','listgroup',{'list':<?php echo _::$path[1]?>,'type':'del','uid':uid});$('.av-bubble').remove();}
</script>

<?php else:?>

<!--div class="note-br">
<div class="note-it">
<div class="note-hd">กิจกรรมสร้าง<a href="http://guess.boxza.com" target="_blank"><strong>เกมทายใจ</strong></a> แจกบ๊อกฟรี</div>
<div class="note-ct">
สร้างเกมทายใจโดนๆของคุณเอง เกมไหนมีผู้เล่นเกิน 1,000 ครั้ง/เกม รับฟรีทันที <strong style="font-size:16px; color:#f00">1,000 บ๊อก</strong>.. (หมดเขต 31 ธันวาคม 2556)  ที่ <a href="http://guess.boxza.com" target="_blank">เกมทายใจ</a>
</div>
</div>
</div-->




<div class="note-br">
<div class="note-it">
<div class="note-hd">กิจกรรม <span>boxza</span> แจกบ๊อกฟรี <i></i></div>
<div class="note-ct">
<span style="color:#f00">
* เฉพาะสมาชิกที่ยืนยันการสมัครผ่านอีเมล์แล้วเท่านั้น</span>
<?php if(_::$my):?>
<div style="border:1px solid #f0f0f0; background:#fff; padding:5px 2px; margin:5px -5px 0px; text-indent:0px; text-align:center">สถานะของคุณ: 
<?php if(_::$my&&!_::$my['st']):?>
<strong style="color:#f00">ยังไม่ยืนยัน</strong> <br>(<a href="/settings/email" class="h">ยืนยันการสมัครสมาชิก คลิกที่นี่</a>)
<?php else:?>
<strong style="color:#090">ยืนยันการสมัครแล้ว</strong>
<?php endif?>
<?php $g=date('G'); if($g>=18 && $g<=23):?>
<div style="padding: 15px 0px 10px;text-align: center;text-indent: 0px;">
<a href="javascript:;" onClick="_.ajax.gourl('/line','getcredit');" class="getcredit"><img src="http://s0.boxza.com/static/images/profile/rcredit.png"> </a>
</div>
<?php endif?>
<div style="padding: 10px 0pxmargin:5px;text-align: center;text-indent: 0px;">
<a href="http://football.boxza.com/game" title="ทายผลบอล" target="_blank">ทายผลฟุตบอล</a> ลุ้นรับ <strong style="color:#f00">20 บ๊อก</strong>/คู่ เล่นฟรี ไม่มีเสีย.
</div>
</div>
<?php endif?>
</div>

<div class="note-al"><i></i> ประกาศถึงสมาชิก boxza</div>
<div class="note-msg"><?php echo $this->announced?>
<?php if(_::$my&&_::$my['am']>=9):?><br><span class="button" onClick="_.box.load('/dialog/announced #announced_edit')">แก้ไขข้อความ</span><?php endif?>
</div>
</div>
</div>

<h4 class="cp">เพื่อนน่าซื้อสะสม!.<p></p></h4>
<ul class="usuggest">
<?php for($i=0;$i<count($this->topprice);$i++):?>
<?php $u=$this->user->get($this->topprice[$i]['_id'],$this->topprice[$i])?>
<li>
<span class="av" av="<?php echo $u['_id']?>"><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['himg']?>" title="<?php echo $u['name']?>"></a></span>
<span class="n" style="width:200px"><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a> - <?php echo number_format($this->topprice[$i]['pet']['price'])?></span>
</li>
<?php endfor?>
<p></p>
</ul>

<?php endif?>

<?php if(isset($this->suggest)):?>
<h4 class="cp">คุณอาจจะรู้จัก<p></p></h4>
<ul class="usuggest">
<?php for($i=0;$i<count($this->suggest);$i++):?>
<?php $u=$this->user->get($this->suggest[$i]['_id'],$this->suggest[$i])?>
<li>
<span class="av" av="<?php echo $u['_id']?>"><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><img src="<?php echo $u['himg']?>" title="<?php echo $u['name']?>"></a></span>
<span class="n"><a href="/<?php echo $u['link']?>" title="<?php echo $u['name']?>" class="h"><?php echo $u['name']?></a></span>
</li>
<?php endfor?>
<p></p>
</ul>
<?php endif?>

<style>
.football li{list-style:none;}
.football img{width:16px;}
.football a{display:block; text-align:center;}
.football .i{width:20px; text-align:center; vertical-align:middle}
.football .i.left{margin-right:5px;}
.football .i.right{margin-left:5px;}
.football .n{width:70px; overflow:hidden;white-space:nowrap; text-overflow: ellipsis;}
.football .n.left{text-align:left;}
.football .n.right{text-align:right;}
</style>

<h4 class="cp">ทายผลบอลรับบ๊อก!. (20บ๊อก/คู่)<span><a href="http://football.boxza.com/game" target="_blank">คู่อื่นๆ</a></span><p></p></h4>
<ul class="forum3 football">
<?php for($i=0;$i<count($this->football);$i++):?>
<li><a href="http://football.boxza.com/match/<?php echo $this->football[$i]['_id']?>" target="_blank">
<span class="left i"><img src="http://s3.boxza.com/football/team/<?php echo $this->football[$i]['t1']['fd']?>/s.png"></span>
<span class="left n"><?php echo $this->football[$i]['t1']['t']?$this->football[$i]['t1']['t']:$this->football[$i]['t1']['n']?></span>
 -vs- 
 <span class="right i"><img src="http://s3.boxza.com/football/team/<?php echo $this->football[$i]['t2']['fd']?>/s.png"></span>
 <span class="right n"><?php echo $this->football[$i]['t2']['t']?$this->football[$i]['t2']['t']:$this->football[$i]['t2']['n']?></span>
 </a></li>
<?php endfor?>
</ul>

<h4 class="cp">ค้นหาเพื่อนจาก...</h4>
<div style="padding:5px 5px 5px 10px;"><img src="http://s0.boxza.com/static/images/profile/social/fb_login.png" class="show-tooltip-s" title="Facebook"></a> <a href="/import/google"><img src="http://s0.boxza.com/static/images/profile/social/gg_login.png" class="show-tooltip-s" title="Google Account"></a> <a href="/import/twitter"><img src="http://s0.boxza.com/static/images/profile/social/tw_login.png" class="show-tooltip-s" title="Twitter"></a> <a href="/import/live"><img src="http://s0.boxza.com/static/images/profile/social/wl_login.png" class="show-tooltip-s" title="Windows Live"></a> <a href="/import/yahoo"><img src="http://s0.boxza.com/static/images/profile/social/yh_login.png" class="show-tooltip-s" title="Yahoo"></a> <a href="/import/email"><img src="http://s0.boxza.com/static/images/profile/social/em_login.png" class="show-tooltip-s" title="Email"></a></div>
						
<?php if(isset($this->topp)):?>
<div class="top-p">
<h4 class="cufon">แนะนำสมาชิก</h4>
<div class="t">
<div>
<div>
<?php $v=$this->topp[0]?>
<a href="/<?php echo $v['if']['lk']?>" class="h"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/n.<?php echo $v['pf']['av']?$v['pf']['av']:'jpg'?>" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="/<?php echo $v['if']['lk']?>" class="h"><?php echo $v['if']['fn']?></a></p>
</div>
</div>
</div>
<ul>
<?php for($i=1;$i<count($this->topp);$i++): $v=$this->topp[$i];?>
<li>
<div>
<a href="/<?php echo $v['if']['lk']?>" class="h"><img src="http://s1.boxza.com/profile/<?php echo $v['if']['fd']?>/s.<?php echo $v['pf']['av']?$v['pf']['av']:'jpg'?>" alt="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>" title="<?php echo $v['if']['fn'].' '.$v['if']['ln']?>"></a>
<p><a href="/<?php echo $v['if']['lk']?>" class="h"><?php echo $v['if']['fn']?></a></p>
</div>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>
<?php if(isset($this->service))echo $this->service?>

<div style="padding:5px 5px; margin:5px 0px 5px 0px; background-color:#f9f9f9; text-align:right; color:#999; font-size:11px">
&copy; 2014 BoxZa, All Rights Reserved.
</div>
</div>
</div>
<div class="clear"></div>
<script>
function insert_to_post(uid){tinyMCE.execCommand('mceInsertContent', false, ' @'+uid);}
</script>
