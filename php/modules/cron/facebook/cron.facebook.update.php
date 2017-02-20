<?php
_::session()->logged();


	
	
	
	date_default_timezone_set('Asia/Bangkok');



require_once(HANDLERS.'facebook/facebook.php');	
facebook::$CURL_OPTS[CURLOPT_TIMEOUT]=300;
$facebook=new facebook(array('appId'=>_::$config['social']['facebook']['appid'],'secret'=>_::$config['social']['facebook']['secret']));
	
if(isset($_GET['state']) && isset($_GET['code']))
{
	//http://cron.boxza.com/facebook/update?
	//code=AQDModo6v_ThKT3nfn4By14L6X0XJ6MUnYPL8Ds-gb21JOgold2qF7dWYQJ6pxgb2J1Djr8rYKF7EtMntwnr7Fg12FSl6o7S9LdsIQrRHbKbnagOH-9c2jx1HHEAtCo5E0OqS5i0h1YMsgCJB884z738eM7VEekWxXQNmYyyR-vd2R4BAG2hqrSezpWtzX-gww3rwiVq1TYeJUQegNBu0mgxfpPZu238kw41wOk7JmLZXhBd7HO1IivnytlR9CKdwrTdEgX6KauPKiP87diVUEmxZkdFT09UYwZ8rJCqTrHqH3YWuDvXEo_UzEVaOV9S0gA
	//&state=4cc6bbe988150d3b7b9a8cbde1495d98#_=_
	
	if($uid=$facebook->getUser())
	{
		$facebook->setExtendedAccessToken();
		$token = $facebook->getAccessToken();
	
		$p = $facebook->api('me/accounts');
		
		$db=_::db();
		$fbpage=array();
		$j=1;
		echo 'พบ '.count($p['data']).' page<br>';
		for($i=0;$i<count($p['data']);$i++)
		{
			if($p['data'][$i]['category']!='Application')
			{
				if($f=$db->findone('cron_fb',array('_id'=>strval($p['data'][$i]['id']))))
				{
					echo ' - '.$j.'. อัพเดท '.$p['data'][$i]['id'].' - '.$p['data'][$i]['name'].' <br>';
					$db->update('cron_fb',array('_id'=>strval($p['data'][$i]['id'])),array('$set'=>array('token'=>$p['data'][$i]['access_token'],'updated'=>new MongoDate())));
					$j++;
				}
			}
		}
		
	}
}
else
{
	_::move($facebook->getLoginUrl(array('scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload','redirect_uri'=>URI)));	
}
?>