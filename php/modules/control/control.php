<?php


# check session/login
_::session();


//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'ระบบจัดการ BoxZa Control';
_::$meta['description'] = 'ระบบจัดการ BoxZa Controlg';
_::$meta['keywords'] = 'ระบบจัดการ, BoxZa, Control';

$template=_::template();

$key=array(
					'gift'=>array('t'=>'ของขวัญ','i'=>'gift'),
				//	'hot-tags'=>array('t'=>'คำค้นยอดฮิต','i'=>'tag'),
				//	'tags'=>array('t'=>'ป้ายกำกับ / Tags','i'=>'tags'),
					'adsense'=>array('t'=>'Adsense','i'=>'tags'),
					'home-banner'=>array('t'=>'แบนเนอร์หน้าแรก','i'=>'eye-close'),
					'home-news'=>array('t'=>'ข่าวหน้าแรก','i'=>'th'),
					'banner'=>array('t'=>'แบนเนอร์ทั้งหมด','i'=>'eye-open'),
					'forum'=>array('t'=>'กระทู้ล่าสุด','i'=>'comment'),
					'job'=>array('t'=>'รับสมัครงาน','i'=>'briefcase'),
					'blog'=>array('t'=>'Blog 50 IP','i'=>'random'),
					'cache'=>array('t'=>'แคช / Cache','i'=>'refresh'),
				);
$template->assign('key',$key);

if(_::$my['am'])
{
	if(_::$path[0]&&isset($key[_::$path[0]]))
	{
		_::$meta['title']=$key[_::$path[0]]['t'].' - '._::$meta['title'];	
	}
	require_once(
										_::run(
														array(
																		'' => 'home',
																		'home' => 'home',
																		'gift'=>'gift',
																		'adsense'=>'adsense',
																		'home-banner'=>'home-banner',
																		'home-news'=>'home-news',
																		'banner'=>'banner',
																		'forum'=>'forum',
																		'job'=>'job',
																		'cache'=>'cache',
																		'blog'=>'blog',
														),
														true
										)
	);
}
else
{
	_::$content=$template->display('content.permission');
	exit;
}

$template->display('content');



function check_perm($key)
{
	if(_::$my['am']==9)	
	{
		return true;	
	}
	elseif(is_array(_::$my['if']['am']))
	{
		return in_array($key,_::$my['if']['am']);
	}
	return false;
}
?>