<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="Description" content="<?php echo _::$meta['description']?>">
<meta name="Keywords" content="<?php echo _::$meta['keywords']?>">
<meta name="Copyright" content="boxza.com">
<meta name="google-site-verification" content="hSfRFCcDswWyu5qloNfX7fM9e7-7ok-Al6KFIyVphJA" />
<meta property="fb:app_id" content="<?php echo _::$config['social']['facebook']['appid']?>">
<?php if(_::$meta['google']):?>
<link rel="author" href="https://plus.google.com/<?php echo _::$meta['google']['id']?>/posts"/>
<?php endif?>
<meta property="og:type" content="<?php echo _::$meta['type']?_::$meta['type']:'website'?>">
<meta property="og:title" content="<?php echo _::$meta['title']?>">
<meta property="og:url" content="<?php echo URI?>">
<meta property="og:site_name" content="หวย">
<meta property="og:description" content="<?php echo _::$meta['description']?>">
<meta property="og:locale" content="th_TH">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/lotto.mobile.css?<?php echo time()?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">ตรวจหวย+ <span><script type="text/javascript"> __th_page="mobile-lotto";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></span></div>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<?php echo _::$content?>
</body>
</html>