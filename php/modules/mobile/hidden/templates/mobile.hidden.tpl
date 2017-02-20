<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo _::$meta['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="http://s0.boxza.com/static/css/mobile.hidden.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
<script type="text/javascript" src="http://s0.boxza.com/static/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://s0.boxza.com/static/js/boxza.js"></script>
<script type="text/javascript">
var uid=0,token='',_za={},_clike={},_cur,_me;
function relogin()
{
	FB.logout(function(response) {
  		top.location='https://graph.facebook.com/oauth/authorize?client_id=<?php echo _::$config['social']['facebook']['appid']?>&redirect_uri=<?php echo urlencode(URI)?>&scope=publish_stream';
	});
}
function checklogin()
{
	FB.getLoginStatus(function(r)
	{
		if(r.status=='connected')
		{
			var ch,scope=true;token=r.authResponse.accessToken;uid=r.authResponse.userID;
			FB.api('/me/permissions', function (r)
			{
				console.log(r.data);
				var perm=["publish_stream"];
				for(ch in perm)
				{
					if(!r.data[0][perm[ch]])
					{
						scope=false;break;
					}
				};
				if(!scope)
				{
					<?php if(!$_GET['code']):?>
					top.location='https://graph.facebook.com/oauth/authorize?client_id=<?php echo _::$config['social']['facebook']['appid']?>&redirect_uri=<?php echo urlencode(URI)?>&scope=publish_stream';
					<?php else:?>
					FB.login(function(r){token=r.authResponse.accessToken;},{display:'iframe',scope: 'publish_stream'});
					<?php endif?>
				}
				else if(typeof(onlogged)=='function')
				{
					onlogged();
				}
			});
		}
		else
		{
			<?php if(!$_GET['code']):?>
			top.location='https://graph.facebook.com/oauth/authorize?client_id=<?php echo _::$config['social']['facebook']['appid']?>&redirect_uri=<?php echo urlencode(URI)?>&scope=publish_stream';
			<?php endif?>
		}
	});
}

</script>
</head>
<body class="<?php echo APP_OS?>">
<div class="bar">
<div>
<?php if($this->parent):?><a href="<?php echo $this->parent?>" class="bar-back"></a><?php endif?>
<div class="bar-title">เกมจับผิด+ <span><script type="text/javascript"> __th_page="mobile-hidden";</script><script type="text/javascript" src="http://hits.truehits.in.th/data/t0030667.js"></script><noscript><img src="http://hits.truehits.in.th/noscript.php?id=t0030667" alt="Thailand Web Stat" border="0" width="14" height="17" /></noscript></span></div>
<a href="/hidden/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<?php echo _::$content?>
<div id="fb-root"></div>
<script>window.fbAsyncInit = function() {FB.init({appId:'<?php echo _::$config['social']['facebook']['appid']?>', cookie:true, status:true, xfbml:true });checklogin();};(function(){var e = document.createElement('script');e.src = 'https://connect.facebook.net/en_US/all.js';e.async = true;document.getElementById('fb-root').appendChild(e);}());</script>
</body>
</html>