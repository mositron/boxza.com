<?php
if(substr(HOST,0,4)=='www.')
{
	_::move('http://boxza.com'.URL,true);
}
# check session/login
_::session();

_::$meta['image']='http://s0.boxza.com/static/images/global/logo.png';
_::$meta['title'] = 'BoxZa แค่เปิดกล่องก็สนุก - สังคมออนไลน์, รูปภาพ, ฝากรูป, ผลบอล, ดูหนังออนไลน์, วิดีโอ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, ลงประกาศฟรี, ตรวจหวย, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์';
_::$meta['description'] = 'BoxZa สังคมออนไลน์ของคนไทยเต็มรูปแบบ พร้อมบริการ ข่าว เกมส์ อัลบั้ม รูปภาพ วิดีโอ หาเพื่อน ดูหนังออนไลน์ ลงประกาศฟรี และอื่นๆอีกมากมาย';
_::$meta['keywords'] = 'boxza, สังคมออนไลน์, อัลบั้ม, รูปภาพ, ดูหนังออนไลน์, วิดีโอ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, ลงประกาศฟรี, ตรวจหวย, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์, ฝากรูป, ผลบอล, ข่าวฟุตบอล, ผลบอลสด, วิเคราะห์บอล';


$template=_::template();

# run - web application   ( 'link' => 'folder' )
require_once(
									_::run(
													array(
																	'' => 'home',
																	'home' => 'home',
																	'home2' => 'home2',
																	'l'=>'l',
																	'about'=>'about',
																	'ads'=>'ads',
																	'import'=>'import',
																	'settings'=>'settings',
																	'tag'=>'tag',
																	'verify'=>'verify',
																	'unsubscribe'=>'unsubscribe',
																	'user'=>'user',
																	'job'=>'job',
																	'dialog'=>'dialog',
													),
													true,
													function()
													{
													/*	
														if(substr(URL,0,5)=='/line')
														{
															_::move('http://boxza.com/',true);
														}
														else
														{
															_::move('http://boxza.com/user/'._::$path[0],true);
														}
														*/
														if(URL=='/line')
														{
															_::move('http://social.boxza.com/',true);
														}
														else
														{
															_::move('http://social.boxza.com'.URL,true);
														}
													}
									)
);


if(MODULE=='home')
{
	$template->assign('_banner',_::banner('www'));
}
$template->display('content');

?>