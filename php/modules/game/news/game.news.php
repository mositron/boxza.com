<?php
#_::$meta['title'] = 'เลขเด็ด ข่าวหวย เลขเด็ดหวย เลขเด็ดสลากกินแบ่งรัฐบาล';
#_::$meta['description'] = 'เลขเด็ด ข่าวหวย อัพเดทข่าวเกี่ยวกับหวยและเลขเด็ดหวย เลขเด็ดสลากกินแบ่งรัฐบาล เลขเด็ดจากทั่วทุกแหล่งทั่วประเทศ';
#_::$meta['keywords'] = 'เลขเด็ด, ข่าวหวย, เลขเด็ดหวย, หวย, สลากกินแบ่งรัฐบาล, หวยเด็ด';


$clink=array('online'=>1,'web'=>2,'pc'=>3,'console'=>4,'mobile'=>5);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'เกมส์ออนไลน์','l'=>$rlink[1]),
						2=>array('t'=>'เกมส์บนเว็บ','l'=>$rlink[2]),
						3=>array('t'=>'เกมส์ PC','l'=>$rlink[3]),
						4=>array('t'=>'เกมส์ Console','l'=>$rlink[4]),
						5=>array('t'=>'เกมส์มือถือ แท็บเล็ต','l'=>$rlink[5]),
);


$template->assign('cate',$cate);

if(is_numeric(_::$path[0]))
{
	require_once(__DIR__.'/game.news.view.php');
}
else
{
	require_once(__DIR__.'/game.news.home.php');
}

?>