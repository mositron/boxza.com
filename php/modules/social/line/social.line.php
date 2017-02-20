<?php

////_::time();


if($_FILES)require_once(__DIR__.'/social.line.post.php');

if(isset($_POST['ajax']))
{
	_::ajax()->register(array('listgroup','savecrop','post','postshare','delline','delcm','getvar','getedit','setedit','sendreport','unsetspam','setha','getcredit','setannounced'),'line');
}

_::$meta['title'] = 'ไลน์ - BoxZa สังคมออนไลน์ของคนไทย';
_::$meta['description'] = 'ไลน์ - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ไลน์, สังคมออนไลน์';


if(_::$my)
{
	$key=(in_array(_::$path[0],array('hash','list'))?_::$path[0].'-'._::$path[1]:_::$path[0]);
	$db=_::db();
	$user=_::user();
	$profile = _::profile();
	$template=_::template();
	$template->assign('user',$user);
	$template->assign('line',$profile->line(array('uid'=>_::$my['_id']),$key));
	$template->assign('line',$template->fetch('line.list'));
	if(_::$path[0]=='list')
	{
		$c=intval(_::$path[1])-1;
		if(isset(_::$my['ct']['gp'][$c]))
		{
			_::$meta['title'] = _::$my['ct']['gp'][$c]['n'].' - '._::$meta['title'];
			_::$meta['description'] = _::$my['ct']['gp'][$c]['n'].' - '._::$meta['description'];
			$template->assign('list',_::$my['ct']['gp'][$c]);
		}
	}
	else
	{
		if(_::$path[0]=='hash')
		{
			_::$meta['title'] = _::$path[1].' - '._::$meta['title'];
			_::$meta['description'] = _::$path[1].' - '._::$meta['description'];
		}
		/*
		if(is_array(_::$my['ct']['fr']) && count(_::$my['ct']['fr'])<300)
		{
			$template->assign('suggest', $db->find('user',array('_id'=>array('$nin'=>array_merge((array)_::$my['ct']['fr'],array(_::$my['_id']))),'st'=>1),$user->fields,array('sort'=>array('du'=>-1),'limit'=>5)));
		}
		*/
		$cache=_::cache();
		if(!$_rec=$cache->get('ca1','line-rec'))
		{
			$_rec=array();
			$_rec['topp'] = $db->find('user',array('$or'=>array(array('st'=>array('$gte'=>0)),array('st'=>array('$exists'=>false)))),array('if'=>1,'pf'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>13));
			$announced=$db->findone('msg',array('_id'=>'announced'),array('msg'=>1));
			$_rec['announced']=nl2br($announced['msg']);
			//$_rec['forum3']=$db->find('forum',['c'=>3,'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1],['sort'=>['_id'=>-1],'limiit'=>5]);
			//$_rec['topprice']=$db->find('user',array('st'=>1),array('if'=>1,'pf'=>1,'pet.price'=>1),array('sort'=>array('pet.price'=>-1),'limit'=>10));
			
			$topprice=$db->find('user',array('pet.price'=>array('$lte'=>800),'st'=>1),array('if'=>1,'pf'=>1,'pet.price'=>1),array('sort'=>array('pf.vt.rc'=>-1,'du'=>-1),'limit'=>100));
			shuffle($topprice);
			$_rec['topprice']=array_slice($topprice,0,10);
			
			$d2=strtotime(date('Y-m-d 05:00:00'));
			$d3=$d2;
			$d1=$d2+(86400*30);
			if($dd=$db->distinct('football_match','ky',array('tm'=>array('$gte'=>new MongoDate($d2),'$lt'=>new MongoDate($d1)))))
			{
				sort($dd);
				$dd=array_slice($dd,0,2);
			}
			$football=array();
			for($i=0;$i<count($dd);$i++)
			{
				$d1=strtotime($dd[$i].' 05:00:00');
				$d2=$d1+(86400);
				if($d3==$d1)
				{
					$d1=time();
				}
				$tmp=$db->find('football_match',array('tm'=>array('$gte'=>new MongoDate($d1),'$lt'=>new MongoDate($d2))),array('_id'=>1,'_ng'=>1,'t1'=>1,'t2'=>1),array('sort'=>array('lg'=>1,'tm'=>1)));
				for($j=0;$j<count($tmp);$j++)
				{
					$fb=$tmp[$j];
					$t1=$db->findone('football_team',array('_id'=>$fb['t1']['_id']),array('_id'=>1,'_ng'=>1,'n'=>1,'t'=>1,'fd'=>1));
					$t2=$db->findone('football_team',array('_id'=>$fb['t2']['_id']),array('_id'=>1,'_ng'=>1,'n'=>1,'t'=>1,'fd'=>1));
					$football[]=array('_id'=>$fb['_id'],'t1'=>$t1,'t2'=>$t2);
				}
			}
			$_rec['football']=$football;
			
			$cache->set('ca1','line-rec',$_rec,false,300);
		}
		$template->assign($_rec);
	}
	$template->assign('service',_::sidebar()->service(array('line'=>1)));
	_::$content=$template->fetch('line');
}
else
{
	$key=(_::$path[0]=='hash'?'hash-'._::$path[1]:_::$path[0]);
	$cache=_::cache();
	if(!_::$content=$cache->get('ca1','line-'.$key))
	{
		$db=_::db();
		$user=_::user();
		$profile = _::profile();
		$template=_::template();
		$line=$profile->line(array('uid'=>NULL),$key);
		if(is_numeric(_::$path[0])&&count($line)==1)
		{
			_::move('/'.$line[0]['u']['link'].'/line/'.$line[0]['_id'],true);
		}
		
		
		//$suggest=$db->find('user',array('st'=>1),$user->fields,array('sort'=>array('du'=>-1),'limit'=>15));
		$template->assign('topp',$db->find('user',array('$or'=>array(array('st'=>array('$gte'=>0)),array('st'=>array('$exists'=>false)))),array('if'=>1,'pf'=>1),array('sort'=>array('pf.vt.rc'=>-1),'limit'=>21)));
		$announced=$db->findone('msg',['_id'=>'announced'],['msg'=>1]);
		$template->assign('announced',nl2br($announced['msg']));
		//$template->assign('forum3',$db->find('forum',['c'=>3,'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1],['sort'=>['_id'=>-1],'limiit'=>5]));
		$topprice=$db->find('user',array('pet.price'=>array('$lte'=>800),'st'=>1),array('if'=>1,'pf'=>1,'pet.price'=>1),array('sort'=>array('pf.vt.rc'=>-1,'du'=>-1),'limit'=>100));
		shuffle($topprice);
		$topprice=array_slice($topprice,0,10);
		$template->assign('topprice',$topprice);
		$template->assign('user',$user);
		$template->assign('suggest', $suggest);
		$template->assign('line',$line);
		$template->assign('line',$template->fetch('line.list'));
		$template->assign('service',_::sidebar()->service(array('line'=>1)));
		
		$d2=strtotime(date('Y-m-d 05:00:00'));
		$d3=$d2;
		$d1=$d2+(86400*30);
		if($dd=$db->distinct('football_match','ky',array('tm'=>array('$gte'=>new MongoDate($d2),'$lt'=>new MongoDate($d1)))))
		{
			sort($dd);
			$dd=array_slice($dd,0,2);
		}
		$football=array();
		for($i=0;$i<count($dd);$i++)
		{
			$d1=strtotime($dd[$i].' 05:00:00');
			$d2=$d1+(86400);
			if($d3==$d1)
			{
				$d1=time();
			}
			$tmp=$db->find('football_match',array('tm'=>array('$gte'=>new MongoDate($d1),'$lt'=>new MongoDate($d2))),array('_id'=>1,'_ng'=>1,'t1'=>1,'t2'=>1),array('sort'=>array('lg'=>1,'tm'=>1)));
			for($j=0;$j<count($tmp);$j++)
			{
				$fb=$tmp[$j];
				$t1=$db->findone('football_team',array('_id'=>$fb['t1']['_id']),array('_id'=>1,'_ng'=>1,'n'=>1,'fd'=>1));
				$t2=$db->findone('football_team',array('_id'=>$fb['t1']['_id']),array('_id'=>1,'_ng'=>1,'n'=>1,'fd'=>1));
				$football[]=array('_id'=>$fb['_id'],'t1'=>$t1,'t2'=>$t2);
			}
		}
		$template->assign('football',$football);
		
		_::$content=$template->fetch('line');
		$cache->set('ca1','line-'.$key,_::$content,false,300);
	}
	
	if(_::$path[0]=='hash')
	{
		_::$meta['title'] = _::$path[1].' - '._::$meta['title'];
		_::$meta['description'] = _::$path[1].' - '._::$meta['description'];
	}
}






?>