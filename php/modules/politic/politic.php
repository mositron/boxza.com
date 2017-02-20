<?php


# check session/login
_::session();


define('NEWS_CATE',9);
//_::time();

#_::$meta['image']='http://s0.boxza.com/static/images/global/logo-news.png';
_::$meta['title'] = 'การเมือง ข่าวการเมือง นักการเมือง ข่าวการเมืองล่าสุด ข่าวการเมืองวันนี้ ข่าวพรรคการเมือง ข่าวบ้านเมือง';
_::$meta['description'] = 'การเมือง ข่าวการเมือง ข้อมูลเกี่ยวการเมืองภายในประเทศไทย สถาการณ์การเมืองล่าสุด นักการเมือง ข่าวการเมืองล่าสุด ข่าวการเมืองวันนี้ ข่าวพรรคการเมือง ข่าวบ้านเมือง';
_::$meta['keywords'] = 'การเมือง, ข่าวการเมือง, นักการเมือง, การเมืองล่าสุด, การเมืองวันนี้, บ้านเมือง, สถานะการณ์';
			

$clink=array('news'=>1);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'ข่าวการเมือง','l'=>$rlink[1],'tt'=>'ข่าวการเมือง การเมืองวันนี้ การเมืองล่าสุด')
);
																											
$template=_::template();
$template->assign('cate',$cate);

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
																	'home' => 'home',
																	'news'=>'news',
																	'people'=>'people',
																	'forum'=>'forum',
													),
													true,
													function()
													{
														global $clink;
														if(isset($clink[_::$path[0]]))
														{	
															define('MODULE','news');
															define('MODULE_LINK',_::$path[0]);
															array_shift(_::$path);
														}
														else
														{
															_::move('/');	
														}
													}
									)
);


$template->display('content');


?>