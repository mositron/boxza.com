<?php

if($_GET['code'])
{
	
	//$tmp=_::http()->get('https://api.instagram.com/oauth/access_token?client_id='._::$config['social']['instagram']['appid'].'&client_secret='._::$config['social']['instagram']['secret'].'&grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.urlencode('http://people.boxza.com/admin/instagram'));
	//echo $tmp;
	echo "curl -F 'client_id="._::$config['social']['instagram']['appid']."' -F 'client_secret="._::$config['social']['instagram']['secret']."' -F 'grant_type=authorization_code' -F 'redirect_uri=http://people.boxza.com/admin/instagram' -F 'code=".$_GET['code']."' https://api.instagram.com/oauth/access_token";
}
else
{
	_::move('https://instagram.com/oauth/authorize/?client_id='._::$config['social']['instagram']['appid'].'&response_type=code&redirect_uri='.urlencode('http://people.boxza.com/admin/instagram'));
}
exit;
/*

22051122.e6bf310.2cb342c345a5462d836897004a037b7a



https://instagram.com/oauth/authorize/?client_id=e6bf31079dc64528ad6798861785e1a1&response_type=code&redirect_uri=http://boxza.com


http://boxza.com/?code=7936f55f01b24dee8b82ea71cb668191


https://api.instagram.com/oauth/access_token?client_id=e6bf31079dc64528ad6798861785e1a1&client_secret=65e30d52b1c241d1a8b4d47b62ac686a&grant_type=authorization_code&redirect_uri=http://boxza.com


curl -F 'client_id=e6bf31079dc64528ad6798861785e1a1' -F 'client_secret=65e30d52b1c241d1a8b4d47b62ac686a' -F 'grant_type=authorization_code' -F 'redirect_uri=http://people.boxza.com/admin/instagram' -F 'code=7936f55f01b24dee8b82ea71cb668191' https://api.instagram.com/oauth/access_token


client_id=CLIENT-ID' \
    -F 'client_secret=CLIENT-SECRET' \
    -F 'grant_type=authorization_code' \
    -F 'redirect_uri=YOUR-REDIRECT-URI
	
*/

?>