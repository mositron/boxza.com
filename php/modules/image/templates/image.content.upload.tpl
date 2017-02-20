<style>
._hd nav{width:auto}
</style>
<header class="_hd">
<nav>
<ul>
<li class="logo"><a href="http://boxza.com" title="สังคมออนไลน์" target="_blank"></a></li>
<?php if(_::$my):?>
<li class="notify_split left"></li>
<li class="truehits"><script type="text/javascript"> __th_page="<?php echo defined('TH_PAGE')?TH_PAGE:_::$type?>";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></li>
<li class="adyim"><script>document.write(unescape('%3Cscript%20language%3D%27javascript%27%20type%3D%27text%2Fjavascript%27%3Evar%20re%3DencodeURI%28document.referrer%29%3Bvar%20hre%3DencodeURI%28window.location%29%3Bdocument.write%28%27%3Ciframe%20marginwidth%3D0%20marginheight%3D0%20vspace%3D0%20hspace%3D0%20allowtransparency%3Dtrue%20width%3D25%20height%3D13%20scrolling%3Dno%20frameborder%3D0%20src%3Dhttp%3A%2F%2Fstat.adyim.com%2Fcount%2F%3Fpid%3D12427%26u%3D12650%26af%3D12498%26cpid%3D%26t%3Dboxza.com%26re%3D%27%2Bre%2B%27%26hre%3D%27%2Bhre%2B%27%3E%3C%2Fiframe%3E%27%29%3B%3C%2Fscript%3E'));</script></li>
<li class="notify notify_setting"><a href="http://social.boxza.com/" rel="setting"><img src="<?php echo _::$my['img']?>" class="img-uid-<?php echo _::$my['_id']?>"> <?php echo _::$my['name']?></a>
<ul>
<li><a href="http://social.boxza.com/" target="_blank"> + ไลน์ทั้งหมด</a></li>
<li><a href="http://social.boxza.com/<?php echo _::$my['link']?>" target="_blank"> + โปรไฟล์ส่วนตัว</a></li>
<li><a href="http://social.boxza.com/settings" target="_blank"> + ตั้งค่าการใช้งาน</a></li>
<li><a href="http://oauth.boxza.com/logout" target="_blank"> - ออกจากระบบ</a></li>


</ul>
</li>
<?php else:?>
<li class="truehits"><script type="text/javascript"> __th_page="<?php echo defined('TH_PAGE')?TH_PAGE:_::$type?>";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></li>
<li class="adyim"><script>document.write(unescape('%3Cscript%20language%3D%27javascript%27%20type%3D%27text%2Fjavascript%27%3Evar%20re%3DencodeURI%28document.referrer%29%3Bvar%20hre%3DencodeURI%28window.location%29%3Bdocument.write%28%27%3Ciframe%20marginwidth%3D0%20marginheight%3D0%20vspace%3D0%20hspace%3D0%20allowtransparency%3Dtrue%20width%3D25%20height%3D13%20scrolling%3Dno%20frameborder%3D0%20src%3Dhttp%3A%2F%2Fstat.adyim.com%2Fcount%2F%3Fpid%3D12427%26u%3D12650%26af%3D12498%26cpid%3D%26t%3Dboxza.com%26re%3D%27%2Bre%2B%27%26hre%3D%27%2Bhre%2B%27%3E%3C%2Fiframe%3E%27%29%3B%3C%2Fscript%3E'));</script></li>
<li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/signup/?redirect_uri='.urlencode(URI)))?>" target="_blank">สมัครสมาชิก</a></li>
<li class="preview"><a href="<?php echo _::uri(array('sub'=>'oauth','path'=>'/login/?redirect_uri='.urlencode(URI)))?>" target="_blank">ล็อคอิน</a></li>
<?php endif?>
</li>
</ul>
</nav>
</header>
<div class="_hd-bt"></div>

<?php echo _::$content?>
