<header class="_hd"><!-- -->
    <nav class="container">
        <ul>
            <li class="logo"><a href="http://boxza.com/" title="BoxZa ละคร เกมส์ ตรวจหวย ดูดวง เพลง หนัง รูปภาพ ฝากรูป ผลบอล ดูหนังออนไลน์ วิดีโอ เนื้อเพลง ดูดวง เกมส์ กลิตเตอร์ ลงประกาศฟรี  หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์"></a></li>
            <li class="notify_split left"></li>
            <li class="search visible-desktop"><span><form action="http://search.boxza.com/" method="get"><input type="text" name="q" placeholder="ค้นหา" class="hsearch ev"><strong><button type="submit"><i></i></button></strong></form></span></li>
            <li class="truehits"><script type="text/javascript"> __th_page="<?php echo defined('TH_PAGE')?TH_PAGE:_::$type?>";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></li>
            <?php if(_::$my):?>
            <li class="notify notify_setting  hidden-phone"><a href="http://social.boxza.com/" rel="setting"><img src="<?php echo _::$my['img']?>" class="img-uid-<?php echo _::$my['_id']?>"> <?php echo _::$my['name']?></a>
                <ul>
                    <li><a href="http://social.boxza.com/"> + ไลน์ทั้งหมด</a></li>
                    <li><a href="http://boxza.com/user/<?php echo _::$my['link']?>"> + โปรไฟล์ส่วนตัว</a></li>
                    <li><a href="http://boxza.com/settings"> + ตั้งค่าการใช้งาน</a></li>
                    <li><a href="http://oauth.boxza.com/logout"> - ออกจากระบบ</a></li>
                </ul>
            </li>
            <li class="notify_split hidden-phone"></li>
            <li class="notify notify_friend hidden-phone"><a href="http://social.boxza.com/notifications/friend/" rel="friend"><i></i>
                <p id="ntf-fr" style="display:<?php echo _::$my['nf']['fr']?'block':'none'?>"><?php echo intval(_::$my['nf']['fr'])?></p>
                </a>
                <ul>
                    <li style="text-align:center; padding:20px">กรุณารอซักครู่...</li>
                </ul>
            </li>
            <li class="notify notify_other hidden-phone"><a href="http://social.boxza.com/notifications/other/" rel="other"><i></i>
                <p id="ntf-ot" style="display:<?php echo _::$my['nf']['ot']?'block':'none'?>"><?php echo intval(_::$my['nf']['ot'])?></p>
                </a>
                <ul>
                    <li style="text-align:center; padding:20px">กรุณารอซักครู่...</li>
                </ul>
            </li>
            <li class="notify_split hidden-phone" style="margin-right:5px;"></li>
            <li class="notify notify_message hidden-phone"><a href="http://social.boxza.com/messages" rel="messages" class="h"><i></i></a> </li>
            <?php elseif(_::$type=='oauth'):?>
            <li class="preview hidden-phone"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/?'.$_SERVER['QUERY_STRING']))?>">สมัครสมาชิก</a></li>
            <li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?'.$_SERVER['QUERY_STRING']))?>">ล็อคอิน</a></li>
            <?php else:?>
            <li class="preview hidden-phone"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/?redirect_uri='.urlencode(URI)))?>">สมัครสมาชิก</a></li>
            <li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>">ล็อคอิน</a></li>
            <?php endif?>
            </li>
        </ul>
    </nav>
</header>
<div class="_hd-bt"></div>
