<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo _::$meta['title']?></title>
<meta name="Description" content="<?php echo _::$meta['description']?>">
<meta name="Keywords" content="<?php echo _::$meta['keywords']?>">
<meta name="Copyright" content="BoxZa.com">
<meta name="robots" content="noindex, nofollow">
<!--meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="http://s0.boxza.com/static/js/jquery/mobile/jquery.mobile-1.3.0.css">
<link rel="stylesheet" href="http://s0.boxza.com/static/js/jquery/scrollz/jquery.scrollz.css">
<link rel="stylesheet" href="http://s0.boxza.com/static/css/boxza.m.css">
<script src="http://s0.boxza.com/static/js/jquery/jquery-1.10.1.min.js"></script>
<script>
$(document).bind("mobileinit", function(){
        $.mobile.hashListeningEnabled = false;
});
</script>
<script src="http://s0.boxza.com/static/js/jquery/mobile/jquery.mobile-1.3.0.min.js"></script>
<script src="http://s0.boxza.com/static/js/jquery/scrollz/jquery.scrollz.min.js"></script>
<script src="http://s0.boxza.com/static/js/boxza.js"></script>
<script src="http://s0.boxza.com/static/js/boxza.m.js?v=<?php echo time()?>"></script>
<?php if(_::$my):?><script>_.my=<?php echo json_encode(['_id'=>_::$my['_id'],
																																									'name'=>_::$my['name'],
																																									'img'=>_::$my['img'],									
																																									'fb'=>(isset(_::$my['sc']['fb']['id'])?['id'=>_::$my['sc']['fb']['id']]:''),
																																									'tw'=>(isset(_::$my['sc']['tw']['id'])?['id'=>_::$my['sc']['tw']['id']]:''),
																																									'ct'=>['fr'=>[],'fq'=>[],'ig'=>[],'bl'=>[]]
																																						])?>;</script><?php endif?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-31362918-1', 'boxza.com');
  ga('send', 'pageview');
</script>
</head>
<body>
<?php echo _::$content?>
</body>
</html>