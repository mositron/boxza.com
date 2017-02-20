<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/mobile.guess.css?<?php echo APP_VERSION?>">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?><a href="<?php echo $this->parent?>" class="bar-back"></a><?php endif?>
<div class="bar-title">เกมทายใจ+ <span><script type="text/javascript"> __th_page="mobile-guess";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></span></div>
<a href="/guess/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>

<ul class="tabs"><li><a href="/guess" class="<?php echo !_::$path[0]?'active':''?>"><span>หน้าแรก</span></a></li><li><a href="/guess/recent" class="<?php echo _::$path[0]=='recent'?'active':''?>"><span>มาใหม่</span></a></li><li><a href="/guess/hit" class="<?php echo _::$path[0]=='hit'?'active':''?>"><span>ยอดฮิต</span></a></li><li><a href="http://guess.boxza.com/manage" target="_blank"><span>สร้างเกมทายใจ</span></a></li><li><a href="/guess/apps" class="<?php echo _::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo _::$content?>
</body>
</html>