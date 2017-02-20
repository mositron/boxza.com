<header class="_hd">
<nav>
<ul>
<li class="logo"><a href="http://boxza.com/" title="BoxZa ข่าว เกมส์ ตรวจหวย ดูดวง เพลง หนัง รูปภาพ ฝากรูป ผลบอล ดูหนังออนไลน์ วิดีโอ เนื้อเพลง ดูดวง เกมส์ กลิตเตอร์ ลงประกาศฟรี  หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์"></a></li>
<?php if(_::$my):?>
<li class="notify_split left"></li>
<?php if(!_::$my['st']):?>
<li class="st-confirm"><div>ยังไม่ได้ยืนยันการสมัครสมาชิก <small>(<a href="/settings/email" class="h">ดูรายละเอียดเพิ่มเติม</a>)</small></div></li>
<?php else:?>
<li class="search"><span><input type="text" name="q" placeholder="ค้นหาเพื่อน" class="find-people hsearch" data-friend="0" data-func="go"><strong><i></i></strong></span></li>
<?php endif?>
<li class="truehits"><script type="text/javascript"> __th_page="<?php echo defined('TH_PAGE')?TH_PAGE:_::$type?>";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></li>
<li class="notify notify_setting"><a href="/" rel="setting" class="h"><img src="<?php echo _::$my['himg']?>" class="img-uid-<?php echo _::$my['_id']?>"> <?php echo _::$my['name']?></a>
<ul>
<li><a href="/" class="h"> + ไลน์ทั้งหมด</a></li>
<li><a href="/<?php echo _::$my['link']?>" class="h"> + โปรไฟล์ส่วนตัว</a></li>
<li><a href="/settings" class="h"> + ตั้งค่าการใช้งาน</a></li>
<li><a href="http://oauth.boxza.com/logout"> - ออกจากระบบ</a></li>
</ul>
</li>
<li class="notify_split"></li>
<li class="notify notify_friend"><a href="/notifications/friend/" rel="friend"><i></i><p id="ntf-fr" style="display:<?php echo _::$my['nf']['fr']?'block':'none'?>"><?php echo intval(_::$my['nf']['fr'])?></p></a>
<ul><li style="text-align:center; padding:20px">กรุณารอซักครู่...</li></ul>
</li>
<li class="notify notify_other"><a href="/notifications/other/" rel="other"><i></i><p id="ntf-ot" style="display:<?php echo _::$my['nf']['ot']?'block':'none'?>"><?php echo intval(_::$my['nf']['ot'])?></p></a>
<ul><li style="text-align:center; padding:20px">กรุณารอซักครู่...</li></ul>
</li>
<li class="notify_split" style="margin-right:5px;"></li>
<li class="notify notify_message"><a href="/messages" rel="messages" class="h"><i></i></a>
</li>
<?php else:?>
<li class="truehits"><script type="text/javascript"> __th_page="<?php echo defined('TH_PAGE')?TH_PAGE:_::$type?>";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></li>
<li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/'))?>">สมัครสมาชิก</a></li>
<li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>">ล็อคอิน</a></li>
<?php endif?>
</li>
</ul>
</nav>
</header>
<div class="_hd-bt"></div>
<div class="_ct">
<div class="_ct-in">
<div id="nav-ln-top"></div>
<div class="nav-ln" id="nav-ln">
<div class="nav-ln-in">
<?php if(_::$my['_id']):?>
<div class="my">
<a href="/<?php echo _::$my['link']?>" class="h"><img src="<?php echo _::$my['nimg']?>" class="img-uid-my"></a>
</div>
<?php endif?>
<ul class="nav-ln-ul">
<li><a href="/" class="h"><i class="i1 nav-ln-line"></i> ไลน์ <span></span></a>
<?php if(_::$my):?>
<ul class="my-list">
<?php for($i=0;$i<count(_::$my['ct']['gp']);$i++):?>
<li><a href="/line/list/<?php echo $i+1?>" class="h"><i class="i16 nav-ln-list-<?php echo $i+1?>"></i><span><?php echo _::$my['ct']['gp'][$i]['n']?></span></a></li>
<?php endfor?>
</ul>
<?php endif?>
</li>
<li><a href="/photos" class="h"><i class="i2 nav-ln-photos"></i> รูปภาพ <span></span></a></li>
<!--li><a href="/blogs" class="h"><i class="i17 nav-ln-blogs"></i> บทความ <span></span></a></li-->
<li><a href="/topvote" class="h"><i class="i15 nav-ln-topvote"></i> สมาชิกยอดนิยม <span></span></a></li>
<li><a href="/follow" class="h"><i class="i4 nav-ln-follow"></i> กำลังติดตาม <span></span></a></li>
<li><a href="/birthday" class="h"><i class="i5 nav-ln-birthday"></i> สมาชิกเกิดวันนี้ <span></span></a></li>
<li><a href="http://chat.boxza.com" target="_blank"><i class="i6 nav-ln-chat"></i> ห้องแชท <span><img src="http://s0.boxza.com/images/global/hot.gif" alt="ยอดฮิต"></span></a></li>
<li><a href="/feedback" class="h"><i class="i7 nav-ln-feedback"></i> แจ้งปัญหา <span></span></a></li>
<li><a href="/help" class="h" style="color:#d00 !important"><i class="i18 nav-ln-help"></i> กฏกติการใหม่ <span></span></a></li>
<!--li><a href="/help" class="h"><i class="i18 nav-ln-help"></i> คู่มือการใช้งาน <span></span></a></li-->
</ul>

<?php if(_::$my):?>

<?php if(_::$my['am']):?>
<h4>+ มุมผู้ดูแล</h4>
<ul class="nav-ln-ul">
<li><a href="/line/spam" class="h"><i class="i16 nav-ln-spam"></i><span>มีการร้ายงานสแปม</span></a></li>
<li><a href="/line/all" class="h"><i class="i16 nav-ln-all"></i><span>แสดงผลทั้งหมด</span></a></li>
</ul>
<?php endif?>

<h4>+ มุมสมาชิก</h4>
<ul class="ul-member nav-ln-ul">
<li><a href="/<?php echo _::$my['link']?_::$my['link']:_::$profile['link']?>" class="h"><i class="i9 nav-ln-profile"></i> โปรไฟล์ <span></span></a></li>
<li><a href="/messages" class="h"><i class="i10 nav-ln-messages"></i> ข้อความ <span></span></a></li>
<li><a href="/friends" class="h"><i class="i11 nav-ln-friends"></i> เพื่อน <span></span></a></li>
<li><a href="/credit" class="h"><i class="i12 nav-ln-credit"></i> <strong style="color:#f00">บ๊อก</strong> <img src="http://s0.boxza.com/images/global/hot.gif" alt="ยอดฮิต"><span></span></a></li>
<li><a href="/settings" class="h"><i class="i13 nav-ln-settings"></i> ตั้งค่า <span></span></a></li>
<li><a href="/notifications" class="h"><i class="i14 nav-ln-notifications"></i> แจ้งเตือน <span></span></a></li>
</ul>
<?php endif?>



<h4>+ เกมส์หาบ๊อก</h4>
<ul class="nav-ln-ul">
<li><a href="javascript:;" onClick="_.box.load('/game/bank #game_bank')"><img src="http://s0.boxza.com/static/images/chat/bank.png" alt="ธนาคาร" style="height:16px;vertical-align:middle"> ธนาคาร</a></li>
<li><a href="http://game.boxza.com/lionica" target="_blank"><img src="http://s0.boxza.com/static/images/chat/pet.png" alt="สัตว์เลี้ยง" style="height:16px;vertical-align:middle"> สัตว์เลี้ยง</a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/namtoa #game_namtoa')"><img src="http://s0.boxza.com/static/images/chat/namtoa/2.jpg" alt="เกมน้ำเต้า" style="height:16px;vertical-align:middle"> เกมน้ำเต้า</a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/slave #game_slave')"><img src="http://s0.boxza.com/static/images/chat/card/card.gif" alt="เกมสลาฟ" style="height:16px;vertical-align:middle"> เกมสลาฟ</a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/lottery #game_lottery')"><img src="http://s0.boxza.com/static/images/chat/lottery.png" alt="ล็อตเตอรี่" style="height:16px;vertical-align:middle"> ล็อตเตอรี่</a></li>
</ul>


</div>
</div>
<div class="pf">
<div class="pf-lo" id="pf-content">
<?php echo _::$content?>
</div>
<div class="pf-lo-tmp" style="display:none"></div>
</div>
<div class="clear"></div>
</div><!-- _ct-in -->
<div class="clear"></div>
</div><!-- _ct- -->