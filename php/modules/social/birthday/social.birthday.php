
<?php

////_::time();

if(_::$path[0] && preg_match('/^([0-9]{2})\-([0-9]{2})$/',_::$path[0],$m))
{
	//_::time();
	$bn='สมาชิกที่เกิดวันที่ '.intval($m[2]).' '.time::$month[intval($m[1])-1];
	_::$meta['title'] = $bn.' - BoxZa สังคมออนไลน์ของคนไทย';
	_::$meta['description'] = 'สมาชิกที่เกิดวันที่ '.$bn.'- สังคมออนไลน์ของคนไทย';
	_::$meta['keywords'] = 'สมาชิก, วันเกิด, สังคมออนไลน์';
	 $bdk=intval($m[2]).'-'.intval($m[1]);
}
elseif(!_::$path[0])
{
	$bn='สมาชิกที่เกิดวันนี้';
	_::$meta['title'] = $bn.' - BoxZa สังคมออนไลน์ของคนไทย';
	_::$meta['description'] = $bn.' - สังคมออนไลน์ของคนไทย';
	_::$meta['keywords'] = 'สมาชิก, วันเกิด, วันนี้, สังคมออนไลน์';
	 $bdk=intval(date('m')).'-'.intval(date('d'));
}
else
{
	_::move('/line');
}
if(_::$my['_id'])
{
	$user=_::user();
	$template=_::template();
	$template->assign('user',$user);
	$template->assign('bn',$bn);
	
	$getbd=array(
								'if.bdk'=>$bdk,
								'_id'=>array('$nin'=>array_merge((array)_::$my['ct']['bl'],(array)_::$my['ct']['bl2'],array(_::$my['_id']))),
								'$and'=>array(
																	array('$or'=>array(
																									array('st'=>array('$gte'=>0)),
																									array('st'=>array('$exists'=>false))
																								)
																	),
																	array('$or'=>array(
																									array('op.pf.bd'=>array('$exists'=>false)),
																									array('op.pf.bd'=>0),
																									array('op.pf.bd'=>1),
																									array('op.pf.bd'=>2,'_id'=>array('$in'=>(array)_::$my['ct']['fr'])))
																								)
																	),
								);
								
								
	if($birth = _::db()->find('user',$getbd,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('sort'=>array('du'=>-1))))
	{
		//shuffle($birth);
		$template->assign('birth',$birth);
	}
	$template->assign('province',require(HANDLERS.'boxza/province.php'));
	$template->assign('service',_::sidebar()->service(array('line'=>1)));
	_::$content=$template->fetch('birthday');
}
else
{
	
	$cache=_::cache();
	if(!_::$content=$cache->get('ca1','birthday-'._::$path[0]))
	{
		$user=_::user();
		$template=_::template();
		$template->assign('user',$user);
		$template->assign('bn',$bn);
		
		$getbd=array(
								'if.bdk'=>$bdk,
								'$and'=>array(
																	array('$or'=>array(
																									array('st'=>array('$gte'=>0)),
																									array('st'=>array('$exists'=>false))
																								)
																	),
																	array('$or'=>array(
																									array('op.pf.bd'=>array('$exists'=>false)),
																									array('op.pf.bd'=>0),
																								)
																)
							),
					);
		if($birth = _::db()->find('user',$getbd,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('sort'=>array('du'=>-1))))
		{
			//shuffle($birth);
			$template->assign('birth',$birth);
		}
		$template->assign('province',require(HANDLERS.'boxza/province.php'));
		$template->assign('service',_::sidebar()->service(array('line'=>1)));
		_::$content=$template->fetch('birthday');
		
		$cache->set('ca1','birthday-'._::$path[0],_::$content,false,300);
	}
}






?>