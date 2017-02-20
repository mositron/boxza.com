<?php

_::$meta['title'] = 'ไลน์ของ '._::$profile['name'].' - BoxZa โปรไฟล์ส่วนตัว';
_::$meta['description'] =  'ไลน์ของ '._::$profile['name'].' - '._::$meta['description'];
_::$meta['keywords'] = _::$profile['name'].', '._::$profile['if']['fn'].', '._::$profile['if']['ln'].', โปรไฟล์';


$type='profile';
if(_::$path[0]=='line'&&is_numeric(_::$path[1]))
{
	$type .= '-'._::$path[1];
}

if(_::$my['_id'])
{
	$profile=_::profile();
	$line=$profile->line(array('uid'=>_::$profile['_id']),$type);
	$template->assign('is_profile', 1);
	$template->assign('line', $line);
	$template->assign('line',$template->fetch('line.list'));
	_::$content=$template->fetch('user.line');
	
	if(count($line)==1 && is_numeric(_::$path[1]))
	{
		_::$meta['title']=mb_substr(strip_tags($line[0]['ms']),0,100,'utf-8').' - '._::$profile['name'];
		_::$meta['description']=mb_substr(strip_tags($line[0]['ms']),0,150,'utf-8').' - '._::$profile['name'];
	}
}
else
{
	
	$cache=_::cache();

	$key='profile-line'._::$profile['_id'].'-'.$type;
	if(!_::$content=$cache->get('ca1',$key))
	{
		$profile=_::profile();
		$line=$profile->line(array('uid'=>_::$profile['_id']),$type);
		$template->assign('is_profile', 1);
		$template->assign('line', $line);
		$template->assign('line',$template->fetch('line.list'));
		_::$content=$template->fetch('user.line');
		if(count($line)==1 && is_numeric(_::$path[1]))
		{
			_::$content=array('t'=>mb_substr(strip_tags($line[0]['ms']),0,100,'utf-8'),'d'=>mb_substr(strip_tags($line[0]['ms']),0,150,'utf-8'),'c'=>_::$content);
		}
		$cache->set('ca1',$key,_::$content,false,3600);
	}
	if(is_array(_::$content))
	{
		_::$meta['title']=_::$content['t'].' - '._::$profile['name'];
		_::$meta['description']=_::$content['d'].' - '._::$profile['name'];
		_::$content=_::$content['c'];
	}
}

?>