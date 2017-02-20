<?php

# check session/login
_::session();

_::$meta['title'] = 'อัลบั้มรูปภาพ โหวตอัลบั้ม หนุ่มหล่อ สาวสวย คนน่ารัก รูปภาพประทับใจ สถานที่และอื่นๆอีกมากมาย';
_::$meta['description'] = 'สร้างอัลบั้ม โหวต แชร์ แสดงความคิดเห็น และแบ่งปันให้เพื่อนๆ ทั้งรูปภาพหนุ่มหล่อ สาวสวย ภาพประทับใจ และอื่นๆอีกเพียบ';
_::$meta['keywords'] = 'อัลบั้ม, รูปภาพ, หนุ่มหล่อ, สาวสวย, โหวต, แสดงความคิดเห็น, แบ่งปัน';

$cate=_::$config['album'];

$template=_::template();
$template->assign('cate',$cate);


$cache=_::cache();
if(!$data=$cache->get('ca1',_::$type.'_global'))
{
	$data=array();
	$data['_banner']=_::banner(_::$type);
	
	$cache->set('ca1',_::$type.'_global',$data,false,600);
}
$template->assign('_banner',$data['_banner']);

require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'post'=>'post',
																	'manage'=>'manage',
																	'update'=>'update',
													),
													true,
													function()
													{
														$url=explode('-',_::$path[0]);
														if(is_numeric($url[0]))
														{
															define('MODULE','view');
														}
														else
														{
															define('MODULE','list');
														}
													}
									)
);

$template->display('content');

?>