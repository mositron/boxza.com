<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="Description" content="<?php echo _::$meta['description']?>">
<meta name="Keywords" content="<?php echo _::$meta['keywords']?>">
<meta name="Copyright" content="iNet Revolutions Co.,Ltd.">
<meta property="fb:admins" content="<?php echo _::$config['social']['facebook']['adminid']?>">
<meta property="fb:app_id" content="<?php echo _::$config['social']['facebook']['appid']?>">
<?php if(_::$meta['google']):?>
<link rel="author" href="https://plus.google.com/<?php echo _::$meta['google']['id']?>/posts"/>
<?php endif?>
<meta property="og:type" content="<?php echo _::$meta['type']?_::$meta['type']:'website'?>">
<meta property="og:title" content="<?php echo _::$meta['title']?>">
<meta property="og:url" content="<?php echo URI?>">
<meta property="og:site_name" content="ลิ้งค์">
<meta property="og:description" content="<?php echo _::$meta['description']?>">
<meta property="og:locale" content="th_TH">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/js/bootstrap/css/bootstrap.min.css">
<link href="http://s0.boxza.com/static/css/boxza-bootstrap.css" rel="stylesheet" type="text/css">
<link href="http://s0.boxza.com/static/css/oauth.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
<link rel="canonical" href="http://oauth.boxza.com/<?php echo MODULE?>/">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/boxza.js"></script><?php if(class_exists('ajax',false))ajax::getjs();?>
<!--[if lt IE 9]>
<script src="http://s0.boxza.com/static/js/html5shiv/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script></head>
<body>
<?php require(ROOT.'modules/www/system/www.system.header.php')?>
<div class="container">
<div class="row-fluid">




<div class="row-fluid olg">
<div class="olg-l span7 col-side">

<h3>BoxZa.com เครือข่ายสังคมออนไลน์สัญชาติไทย ที่มาพร้อมกับบริการต่างๆมากมาย</h3>


<?php
$key='oauth_signup_service';
$cache=_::cache();
if(!$content=$cache->get('ca1',$key))
{
	//_::time();
	$db=_::db();
	$template=_::template();
	
	$tm = strtotime(date('Y-m-d'))+(3600*24*14);
	$movie=$db->find('movie',array('dd'=>array('$exists'=>false),'pl'=>1,'tm'=>array('$lte'=>new MongoDate($tm))),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'v'=>1,'t2'=>1,'tm'=>1,'d'=>1),array('sort'=>array('cs'=>-1,'tm'=>-1),'limit'=>12));
	shuffle($movie);
	$movie=array_slice(array_values($movie),0,1);
	$template->assign('movie',$movie[0]);

	$game=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>48));
	shuffle($game);
	$game=array_slice(array_values($game),0,4);
	$template->assign('game',$game);

	$sexy=$db->find('forum',array('c'=>array('$in'=>array(38,412,413,414,415,416,417,418,419,420)),'dd'=>array('$exists'=>false),'s'=>array('$ne'=>''),'fd'=>array('$ne'=>''),'rc'=>1),array('_id'=>1,'t'=>1,'fd'=>1),array('sort'=>array('_id'=>-1),'limit'=>30));
	shuffle($sexy);
	$sexy=array_slice(array_values($sexy),0,6);
	$template->assign('sexy',$sexy);

	$template->assign('is_line',$arg['line']);
	$content=$template->fetch2('out.home.service');
	
	
	$cache->set('ca1',$key,$content,false,300);
}

echo $content;
?>

</div>
<div class="olg-r span5 col-content">

<div class="olg-log">
<div style="padding:5px; margin:5px; background:#FCF6F6; border:1px solid #F0C1BF; color:#333;">
<h1 style="font-size:16px; margin:5px; color:#900; padding:5px;">BoxZa Engine - เกิดข้อผิดพลาด!</h1>
<div>
เกิดข้อผิดพลาดจากการทำงาน เนื่องจากความผิดพลาดบางประการ<br>
กรุณารอซักครู่ และทดลองใหม่อีกครั้ง...<br><br>
<div style="padding:5px; border:1px solid #ddd; background:#fff; text-align:center; color:#000;">Error Code: <?php echo _::$my?'#'._::$my['_id'].'/'._::$my['st']:'@'?>!<?php echo $_COOKIE[_::$config['block']]?></div>
<script type="text/javascript"> __th_page="forward";</script>
<script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script>
<noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript>
</div>
</div>
</div>
<script type="text/javascript" src="http://www.yengo.com/show.cgi?adp=53999"></script>
</div>
</div>




<?php require(ROOT.'modules/www/system/www.system.footer.php')?>

</div>
</div>

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
</body>
</html>

<?php exit;?>