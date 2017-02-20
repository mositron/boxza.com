<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="Description" content="<?php echo _::$meta['description']?>">
<meta name="Keywords" content="<?php echo _::$meta['keywords']?>">
<meta name="Copyright" content="boxza.com">
<meta name="google-site-verification" content="hSfRFCcDswWyu5qloNfX7fM9e7-7ok-Al6KFIyVphJA" />
<?php if(_::$meta['google']):?>
<link rel="author" href="https://plus.google.com/<?php echo _::$meta['google']['id']?>/posts"/>
<?php endif?>
<meta property="fb:app_id" content="<?php echo _::$config['social']['facebook']['appid']?>">
<meta property="fb:admins" content="375840282500280">
<meta property="og:title" content="<?php echo _::$meta['title']?>">
<link rel="image_src" type="image/<?php echo _::$meta['image']?'jpeg':'png'?>" href="<?php echo _::$meta['image']?_::$meta['image']:'http://s0.boxza.com/static/images/global/logo.png'?>">
<meta property="og:image" content="<?php echo _::$meta['image']?_::$meta['image']:'http://s0.boxza.com/static/images/global/logo.png'?>">
<?php if(_::$meta['video']):?>
<?php echo _::$meta['video']?>
<?php endif?>
<meta property="og:url" content="<?php echo URI?>">
<meta property="og:site_name" content="ผู้หญิง">
<meta property="og:description" content="<?php echo _::$meta['description']?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="th_TH">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/js/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/boxza-bootstrap.css">   
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/beauty.css">
<link rel="stylesheet" type="text/css"  href="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.css">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
<?php if(_::$meta['rss']):?>
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo _::$meta['rss']?>">
<?php endif?>
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/boxza.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/ui/jquery-ui-1.10.1.custom.min.js"></script>
<?php if(_::$my):?><script type="text/javascript">_.my=<?php echo json_encode(array('_id'=>_::$my['_id'],
																																									'name'=>_::$my['name'],
																																									'img'=>_::$my['img'],
																																									'link'=>_::$my['link'],									
																																									'fb'=>(isset(_::$my['sc']['fb']['id'])?array('id'=>_::$my['sc']['fb']['id']):''),
																																									'tw'=>(isset(_::$my['sc']['tw']['id'])?array('id'=>_::$my['sc']['tw']['id']):''),
																																									'ct'=>array(
																																															'fr'=>array(),
																																															'fq'=>array(),
																																															'ig'=>array(),
																																															'bl'=>array(),
																																									)
																																						))?>;<?php if(_::$my['am']):?>_.my.am=<?php echo _::$my['am']?><?php endif?>;</script><?php endif?>

<!--[if lt IE 9]>
<script src="http://s0.boxza.com/static/js/html5shiv/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script></head>
<body>
<?php echo _::$content?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=<?php echo _::$config['social']['facebook']['appid']?>&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-31362918-1', 'boxza.com');
  ga('send', 'pageview');
</script>
<?php
if(count(_::$yengo)):
	foreach(_::$yengo as $v):
		echo '<script type="text/javascript" src="http://www.yengo.com/show.cgi?adp='.$v.'&div=ads_yengo_'.$v.'"></script>';
	endforeach;
endif
?>
</body>
</html>