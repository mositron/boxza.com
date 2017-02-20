<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/mobile.football.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">BoxZa Football+ <span><script type="text/javascript"> __th_page="mobile-football";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></span></div>
<a href="/football/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<div id="radio-bar">คุณกำลังฟัง 96.0 Sport Radio [<a href="/football/radio/stop">ปิดวิทยุ</a>]</div>
<ul class="tabs"><li><a href="/football" class="<?php echo !_::$path[0]?'active':''?>"><span>หน้าแรก</span></a></li><li><a href="/football/news" class="<?php echo _::$path[0]=='news'?'active':''?>"><span>ข่าวบอล</span></a></li><li><a href="/football/live-score" class="<?php echo _::$path[0]=='live-score'?'active':''?>"><span>บอลวันนี้</span></a></li><li><a href="/football/last-match" class="<?php echo _::$path[0]=='last-match'?'active':''?>"><span>บอลเมื่อคืน</span></a></li><li><a href="/football/score/1" class="<?php echo _::$path[0]=='score'?'active':''?>"><span>ตารางคะแนน</span></a></li><li><a href="/football/next-match" class="<?php echo _::$path[0]=='next-match'?'active':''?>"><span>บอลพรุ่งนี้</span></a></li><li><a href="/football/apps" class="<?php echo _::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo _::$content?>
</body>
</html>