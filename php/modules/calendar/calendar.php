<?php


# check session/login
_::session();


define('YEAR',date('Y')+543);

//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'ปฏิทิน '.YEAR.' วันหยุดประจําปี '.YEAR.' วันหยุดราชการ '.YEAR.' วันพระ วันสำคัญ '.YEAR.' ดูปฎิทินปี '.YEAR.' Calendar '.(YEAR-543).' ปฏิทินไทย '.YEAR;
_::$meta['description'] = 'ปฏิทินปี '.YEAR.' วันหยุดประจําปี '.YEAR.' วันหยุดราชการปี '.YEAR.' วันพระและวันสำคัญปี '.YEAR.' ดูปฎิทินปี '.YEAR.' Calendar '.(YEAR-543).' ปฏิทินไทย '.YEAR;
_::$meta['keywords'] = 'ปฏิทิน, '.YEAR.', วันหยุดประจําปี, วันหยุดราชการ, วันพระ, วันสำคัญ, calendar, '.(YEAR-543).', ปฏิทินไทย';
			
				
$template=_::template();


$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'-global'))
{
	$db=_::db();
	$data=array();
	$data['service']=_::sidebar()->service();
	$data['_banner']=_::banner(_::$type);
	
	$lotto=$db->find('lotto',array('dd'=>array('$exists'=>false),'pl'=>1),array('tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1),array('sort'=>array('tm'=>-1),'limit'=>1));
	$data['lotto']=$lotto[0];

	$cache->set('ca1',_::$type.'-global',$data,false,3600);
}
$template->assign('_banner',$data['_banner']);
$template->assign('service',$data['service']);
$template->assign('lotto',$data['lotto']);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'admin'=>'admin',
													),
													true,
													function()
													{
														if(preg_match('/^[0-9]{4}$/',_::$path[0]))
														{
															define('CYEAR',_::$path[0]);
														}
														else
														{
															_::move('/');	
														}
														$m=array('holliday'=>'holliday','important'=>'important');
														if(_::$path[1])
														{
															if(isset($m[_::$path[1]]))
															{
																define('MODULE',$m[_::$path[1]]);
															}
															else
															{
																_::move('/'.CYEAR);	
															}
														}
														else
														{
															define('MODULE','home');
														}
													}
									)
);


$template->display('content');

?>