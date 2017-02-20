<?php
_::session()->logged();
set_time_limit(30);

_::ajax()->register('email2invite');

$db=_::db();
$template=_::template();
if(_::$path[0]=='google')
{
	if($_GET["code"])
	{
		$result=_::http()->get('https://accounts.google.com/o/oauth2/token',array(
																																												'code'=>  $_GET["code"],
																																												'client_id'=>  _::$config['social']['google']['appid'],
																																												'client_secret'=>  _::$config['social']['google']['secret'],
																																												'redirect_uri'=>  'http://social.boxza.com/import/google/',
																																												'grant_type'=>  'authorization_code',
																																											));
		$response=  json_decode($result);
		$accesstoken= $response->access_token;
		_::move('/import/google/?oauth_token='.$accesstoken);
	}
	elseif($_GET['oauth_token'])
	{
		libxml_use_internal_errors(true);
		$xmlresponse=_::http()->get('https://www.google.com/m8/feeds/contacts/default/full?oauth_token='.$_GET['oauth_token'].'&max-results=1000');
		try{
			$xml=  new SimpleXMLElement($xmlresponse);
		}
		catch(Exception $e){
					_::move('/import/google');
		}
		$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
		$result = $xml->xpath('//gd:email');
		$list=array();
		$contact=array();
		foreach ($result as $title)
		{
			$em = strtolower(strval($title->attributes()->address));
			if((strpos($em,'@facebook.com')===false) && (strpos($em,'@google.com')===false) && (strpos($em,'noreply')===false) && (strpos($em,'no-reply')===false))
			{
			  $list[] = $em;
			  $contact[$em]=1;
			}
		}
		$exists=array();
		$friends=array_flip((array)_::$my['ct']['fr']);
		$frequest=array_flip((array)_::$my['ct']['fq']);
		if(count($list))
		{
			$user=_::user();
			if($u = $db->find('user',array('em'=>array('$in'=>$list)),$user->fields))
			{
				for($i=0;$i<count($u);$i++)
				{
					unset($contact[$u[$i]['em']]);
					if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
					{
						$exists[]=$user->get($u[$i]['_id'],$u[$i]);
					}
				}
			}
			$template->assign('exists',$exists);
			$template->assign('contact',array_keys($contact));
		}
	}
	else
	{
		_::move('https://accounts.google.com/o/oauth2/auth?client_id='._::$config['social']['google']['appid'].'&redirect_uri='.urlencode('http://social.boxza.com/import/google/').'&scope='.urlencode('https://www.google.com/m8/feeds/').'&response_type=code');
	}
}
elseif(_::$path[0]=='facebook')
{
	require_once(HANDLERS.'facebook/facebook.php');	
	$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
	if(!$uid=$facebook->getUser())
	{
		_::move($facebook->getLoginUrl(array('scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload')));
	}
	if ($uid)
	{
		$facebook->setExtendedAccessToken();
		$token = $facebook->getAccessToken();				
		$result=$facebook->api('/me/friends');
		$list=array();
		if(is_array($result['data']))
		{
			foreach ($result['data'] as $title)
			{
				$list[] = strval($title['id']);
			}
		}
		if(_::$my['sc']&&_::$my['sc']['fb']&&_::$my['sc']['fb']['id']==$uid)
		{
			_::user()->update(_::$my['_id'],array('$set'=>array('sc.fb.token'=>$token)));
		}
		
		$exists=array();
		$fbout=array();
		$friends=array_flip((array)_::$my['ct']['fr']);
		$frequest=array_flip((array)_::$my['ct']['fq']);
		if(count($list))
		{
			$user=_::user();
			if($u = $db->find('user',array('sc.fb.id'=>array('$in'=>$list)),$user->fields))
			{
				for($i=0;$i<count($u);$i++)
				{
					if($u[$i]['sc']['fb']['id'])$fbout[]=$u[$i]['sc']['fb']['id'];
					if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
					{
						$exists[]=$user->get($u[$i]['_id'],$u[$i]);
					}
				}
			}
			$template->assign('exists',$exists);
			$template->assign('fbout',$fbout);
		}
	}
}
elseif(_::$path[0]=='yahoo')
{
	require_once HANDLERS.'yahoo/Yahoo.inc';
	$session = YahooSession::requireSession(_::$config['social']['yahoo']['appid'], _::$config['social']['yahoo']['secret'], _::$config['social']['yahoo']['app_id']);
	if(is_object($session))
	{
		$user = $session->getSessionedUser();
		$profile = $user->getProfile();
		$yh = $user->getContacts(0,1000);
		$list=array();
		$contact=array();
		if($ct=$yh->contacts)
		{
			if($ct->count >0)
			{
				for($i=0;$i<count($ct->contact);$i++)
				{
					$c = $ct->contact[$i]->fields;
					if(is_array($c))
					{
						foreach($c as $v)
						{
							if($v->type=='email')
							{
								$em = strtolower(trim($v->value));
								if(filter_var($em, FILTER_VALIDATE_EMAIL))
								{
								  $list[] = $em;
								  $contact[$em]=1;
									break;
								}
							}
						}
					}
				}
			}
			
			$exists=array();
			$friends=array_flip((array)_::$my['ct']['fr']);
			$frequest=array_flip((array)_::$my['ct']['fq']);
			if(count($list))
			{
				$user=_::user();
				if($u = $db->find('user',array('email'=>array('$in'=>$list)),$user->fields))
				{
					$user=_::user();
					for($i=0;$i<count($u);$i++)
					{
						unset($contact[$u[$i]['em']]);
						if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
						{
							$exists[]=$user->get($u[$i]['_id'],$u[$i]);
						}
					}
				}
				$template->assign('exists',$exists);
				$template->assign('contact',array_keys($contact));
			}
		}
	}
}
elseif(_::$path[0]=='live')
{
	
	if (!empty($_GET['code']))
   {
		 
		$response=_::http()->get('https://oauth.live.com/token',array(
																																												'code'=>  $_GET["code"],
																																												'client_id'=>  _::$config['social']['live']['appid'],
																																												'client_secret'=>  _::$config['social']['live']['secret'],
																																												'redirect_uri'=>  'http://social.boxza.com/import/live/?step=1',
																																												'grant_type'=>  'authorization_code',
																																											));
			if ($response !== false)
			{
				$authToken = json_decode($response);
				if (!empty($authToken) && !empty($authToken->access_token) )
				{
					$response = _::http()->get('https://apis.live.net/v5.0/me/contacts?access_token='.$authToken->access_token);
					$contact = json_decode($response,true);
					$list = array();
					$email = array();
					$kemail=array();
					for($i=0;$i<count($contact['data']);$i++)
					{
						$j=$contact['data'][$i];
						if(!$j['first_name'] && !$j['last_name'])
						{
							if(filter_var($j['name'], FILTER_VALIDATE_EMAIL))
							{
								$m = strtolower($j['name']);
								$email[]=$m;
								$kemail[$m]=1; 
							}
							$list[]=$j['user_id'];
						}
						else
						{
							$list[]=$j['user_id'];
						}
					}

					$response = @file_get_contents('https://apis.live.net/v5.0/me?access_token='.$authToken->access_token,false,$ctx);
					$user = json_decode($response);
					$list = array_values(array_filter($list));
					if(!is_array(_::$my['sc']))_::$my['sc']=array();
					_::$my['sc']['wl']=strval($user->id);
					_::user()->update(_::$my['_id'],array('$set'=>array('sc.wl'=>_::$my['sc']['wl'])));
					
					$list=array_values(array_unique($list));
					$exists=array();
					$friends=array_flip((array)_::$my['ct']['fr']);
					$frequest=array_flip((array)_::$my['ct']['fq']);
					if(count($list))
					{
						$user=_::user();
						if($u = $db->find('user',array('$or'=>array(array('sc.wl'=>array('$in'=>$list)),array('email'=>array('$in'=>$email)))),$user->fields))
						{
							for($i=0;$i<count($u);$i++)
							{
								unset($kemail[$u[$i]['em']]);
								if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
								{
									$exists[]=$user->get($u[$i]['_id'],$u[$i]);
								}
							}
						}
						$template->assign('exists',$exists);
						$template->assign('contact',array_keys($kemail));
					}
				 }
			}
    }
	 elseif(!$_GET['step'])
	 {
		 _::move('https://oauth.live.com/authorize?client_id='._::$config['social']['live']['appid'].'&scope=wl.signin%20wl.basic%20wl.emails&response_type=code&redirect_uri='.rawurlencode('http://social.boxza.com/import/live/?step=1'));
	 }
}
elseif(_::$path[0]=='twitter')
{
	if(isset($_GET['oauth_verifier']) && _::$my['sc']['tw']['tmp'])
	{
		$t=_::$my['sc']['tw']['tmp'];
		require(HANDLERS.'twitter/twitteroauth/twitteroauth.php');
		$connection = new TwitterOAuth(_::$config['social']['twitter']['appid'], _::$config['social']['twitter']['secret'], $t['oauth_token'], $t['oauth_token_secret']);
		if($c = $connection->getAccessToken($_GET['oauth_verifier']))
		{
			if(!is_array(_::$my['sc']))_::$my['sc']=array();
			_::$my['sc']['tw']=array('id'=>$c['user_id'],'name'=>$c['screen_name'],'token'=>$c['oauth_token'],'secret'=>$c['oauth_token_secret']);
			_::user()->update(_::$my['_id'],array('$set'=>array('sc.tw'=>_::$my['sc']['tw'])));
			
			$list=array();
			$result = $connection->get('followers/ids');
			if($result->ids)
			{
				foreach ($result->ids as $title) {
				  $list[] = strval($title);
				}
			}
			$result = $connection->get('friends/ids');
			if($result->ids)
			{
				foreach ($result->ids as $title)
				{
				  $list[] = strval($title);
				}
			}
			$list=array_values(array_unique($list));
			$exists=array();
			$friends=array_flip((array)_::$my['ct']['fr']);
			$frequest=array_flip((array)_::$my['ct']['fq']);
			if(count($list))
			{
				$user=_::user();
				if($u = $db->find('user',array('sc.tw.id'=>array('$in'=>$list)),$user->fields))
				{
					for($i=0;$i<count($u);$i++)
					{
						if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
						{
							$exists[]=$user->get($u[$i]['_id'],$u[$i]);
						}
					}
				}
				$template->assign('exists',$exists);
			}
		}
	}
	elseif(!$_GET['step'])
	{
		require(HANDLERS.'twitter/twitteroauth/twitteroauth.php');
		$connection = new TwitterOAuth(_::$config['social']['twitter']['appid'], _::$config['social']['twitter']['secret']);
		$tmp =  $connection->getRequestToken('http://social.boxza.com/import/twitter/?step=1'); // Used applications registered callback URL
		_::user()->update(_::$my['_id'],array('$set'=>array('sc.tw.tmp'=>$tmp)));
		if($connection->http_code == 200)
		{
			 _::move($connection->getAuthorizeURL($tmp['oauth_token']));
		}
	}
}
elseif(_::$path[0]=='email')
{
	if($_POST['emails'])
	{
		$email = explode(' ',str_replace(array(' ',';',',',"\n"),' ',$_POST['emails']));
		$email = array_values(array_unique(array_filter(array_map('trim',array_map('strtolower',$email)))));
		
		$list=array();
		$contact=array();
		foreach ($email as $em)
		{
			if((strpos($em,'@facebook.com')===false) && (strpos($em,'@google.com')===false) && (strpos($em,'noreply')===false) && (strpos($em,'no-reply')===false))
			{
				if(filter_var($em, FILTER_VALIDATE_EMAIL))
				{
					$list[] = $em;
			  		$contact[$em]=1;
			  }
			}
		}
		$exists=array();
		$friends=array_flip((array)_::$my['ct']['fr']);
		$frequest=array_flip((array)_::$my['ct']['fq']);
		if(count($list))
		{
			$user=_::user();
			if($u = $db->find('user',array('em'=>array('$in'=>$list)),$user->fields))
			{
				for($i=0;$i<count($u);$i++)
				{
					unset($contact[$u[$i]['em']]);
					if(!isset($friends[$u[$i]['_id']]) && !isset($frequest[$u[$i]['_id']]) && $u[$i]['_id']!=_::$my['_id'])
					{
						$exists[]=$user->get($u[$i]['_id'],$u[$i]);
					}
				}
			}
			$template->assign('exists',$exists);
			$template->assign('contact',array_keys($contact));
		}
	}
}
_::$content=$template->fetch('import');


_::$meta['title'] = 'ค้นหาเพื่อน - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ค้นหาเพื่อน - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ค้นหาเพื่อน, สังคมออนไลน์';

function email2invite($arg)
{
	if(!is_array($arg['email']) && $arg['email'])
	{
		$arg['email']=array($arg['email']);
	}
	
	if($arg['email'])
	{
		$db=_::db();
		$kemail=array_flip($arg['email']);
		$exists = $db->find('emails',array('email'=>array('$in'=>$arg['email']),'u'=>_::$my['_id'],'type'=>'invite'),array('email'=>1));
		for($i=0;$i<count($exists);$i++)
		{
			if(isset($kemail[$exists[$i]['email']]))
			{
				unset($kemail[$exists[$i]['email']]);
			}
		}
		if(count($kemail))
		{
			$wait=array_keys($kemail);
			for($i=0;$i<count($wait);$i++)
			{
				$db->insert('emails',array('email'=>$wait[$i],'u'=>_::$my['_id'],'type'=>'invite'));
			}
		}
		_::ajax()->script('$(".show-contact-success").css("display","block");');
		_::ajax()->script('$(".show-contact").css("display","none");');
	}
}
?>