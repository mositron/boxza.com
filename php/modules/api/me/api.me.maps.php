<?php
if(_::$my['_id'])
{
	if(_::$path[2])
	{
		list($lat,$lng)=explode(',',_::$path[2]);
		
		if(preg_match('/^([0-9]{1,3})\.([0-9]{3,20})$/',$lat) && preg_match('/^([0-9]{1,3})\.([0-9]{3,20})$/',$lng))
		{
			$lat = floatval($lat);
			$lng = floatval($lng);
			$db = _::db();
			
			if(!$place = $db->findOne('maps_4sq',array('loc'=>array('$near'=>array($lat,$lng),'$maxDistance'=>0.01))))
			{
				$tmp = file_get_contents('https://api.foursquare.com/v2/venues/search?ll='.urlencode($lat.','.$lng).'&client_id=ZQQDGQVFUVSQHOFXKMMBBN4VCHTICXML4GFEDEC01V4VIIEW&client_secret=X0MPORMUZ2KRALIHHLTBAOMAVK3MB4FAWFQI13A15QPZYJQY&v=20120228');
				$tmp = json_decode($tmp,true);
				if($tmp['meta']['code']==200)
				{
					$place=array('loc'=>array($lat,$lon),'list'=>$tmp['response']['venues']);
					$place['_id']=$db->insert('maps_4sq',$place);
				}
			}
			_::$content[] = array('method'=>'maps','data'=>$place['list']);
		}
	}
}
else
{
	_::$content[] = array('method'=>'login');
}

?>