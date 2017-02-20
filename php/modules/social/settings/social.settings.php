<?php
_::session()->logged();
$template=_::template();

if(_::$path[0]=='facebook' && isset($_GET['code']))
{
	require_once(HANDLERS.'facebook/facebook.php');	
	$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
	
	if($uid=$facebook->getUser())
	{
		$facebook->setExtendedAccessToken();
		$token = $facebook->getAccessToken();
	
		$p = $facebook->api('me/accounts');
		
		$fbpage=array();
		for($i=0;$i<count($p['data']);$i++)
		{
			if($p['data'][$i]['category']!='Application')
			{
				$fbpage[$p['data'][$i]['id']]=array('id'=>$p['data'][$i]['id'],'name'=>$p['data'][$i]['name'],'token'=>$p['data'][$i]['access_token']);
			}
		}
		
		if(!is_array(_::$my['sc']))_::$my['sc']=array();
		_::$my['sc']['fb'] = array('id'=>$uid,'token'=>$token,'page'=>array_slice($fbpage,0,5),'v'=>2);
		_::user()->update(_::$my['_id'],array('$set'=>array('sc.fb'=>_::$my['sc']['fb'])));
		
		
		if(intval(_::$my['st'])==0)
		{
			$me = $facebook->api('/me');
			$me['email']=strtolower($me['email']);
			if($me['verified'] && $me['email']==_::$my['em'] && strpos($me['email'],'facebook')===false)
			{
				_::user()->update(_::$my['_id'],array('$set'=>array('st'=>1),'$unset'=>array('ec'=>1)));
				_::$my['st']=1;
			}
			if(isset($_GET['verify']))
			{
				_::move('/settings/email?verified='.(_::$my['st']?'1':($me['email']==_::$my['em']?'0':'2')));
			}
		}
		
		$template->assign('fbid',$uid);
		$template->assign('fbpage',$fbpage);
		
		if(!count($fbpage))
		{
			_::move('/settings/facebook');
		}
	
	}
}


if(_::$path[0]=='twitter' && isset($_GET['oauth_verifier']) && _::$my['sc']['tw']['tmp'])
{
	$t=_::$my['sc']['tw']['tmp'];
	require(HANDLERS.'twitter/twitteroauth/twitteroauth.php');
	$connection = new TwitterOAuth(_::$config['social']['twitter']['appid'], _::$config['social']['twitter']['secret'], $t['oauth_token'], $t['oauth_token_secret']);
	if($c = $connection->getAccessToken($_GET['oauth_verifier']))
	{
		if(!is_array(_::$my['sc']))_::$my['sc']=array();
		_::$my['sc']['tw']=array('id'=>$c['user_id'],'name'=>$c['screen_name'],'token'=>$c['oauth_token'],'secret'=>$c['oauth_token_secret']);
		_::user()->update(_::$my['_id'],array('$set'=>array('sc.tw'=>_::$my['sc']['tw'])));
	}
}


if(_::$path[0]=='google'&&$_GET['call']=='google')
{
	require_once HANDLERS.'google/Google_Client.php';
	require_once HANDLERS.'google/contrib/Google_PlusService.php';
	$client = new Google_Client();
	$client->setApplicationName("Login to BoxZa.com with Google API");
	$client->setClientId(_::$config['social']['google']['appid']);
	$client->setClientSecret(_::$config['social']['google']['secret']);
	$client->setRedirectUri('http://social.boxza.com/settings/google/?call=google');
	//$client->setDeveloperKey(_::$config['social']['google']['key']);
	$plus = new Google_PlusService($client);
	  
	if (isset($_GET['code']))
	{
		$client->authenticate();
		_::user()->update(_::$my['_id'],array('$set'=>array('sc.gg.token'=>$client->getAccessToken())));
		_::move('http://social.boxza.com/settings/google/?call=google');
	}
	
	if (isset(_::$my['sc']['gg']['token']))
	{
		$client->setAccessToken(_::$my['sc']['gg']['token']);  
	}
	if ($client->getAccessToken())
	{
		$me = $plus->people->get('me');
		if(!is_array(_::$my['sc']))_::$my['sc']=array();
		_::$my['sc']['gg']=array('id'=>$me['id'],'name'=>$me['displayName'],'token'=>_::$my['sc']['gg']['token'],'img'=>$me['image']['url']);
		_::user()->update(_::$my['_id'],array('$set'=>array('sc.gg'=>_::$my['sc']['gg'])));
	} 
}


_::ajax()->register(array('settings','setsc','setline','sendconfirm','unblock','changeemail'),'settings');
$template->assign('settings',getsettings(_::$path[0]));
$template->assign('service',_::sidebar()->service(array('line'=>1)));
_::$content = $template->fetch('settings');


_::$meta['title'] = 'ตั้งค่า - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ตั้งค่า - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ตั้งค่า, สังคมออนไลน์';

function getsettings($type)
{
	$db=_::db();
	$template=_::template();
	$u = $db->findOne('user',array('_id'=>_::$my['_id']),array('addr'=>1,'idc'=>1));
	$template->assign('addr',(array)$u['addr']);
	$template->assign('idc',(array)$u['idc']);
	$prov = require(HANDLERS.'boxza/province.php');
	$prov['0']='';
	$template->assign('prov',$prov);
	if(in_array($type,array('email','name','url','profile','access','password','address','idcard','google','facebook','twitter','notifications','ignore','block','connect','delete')))
	{
		$template->assign('type',$type);
	}
	return $template->fetch('settings.list');
}
?>