<?php
_::$meta['title'] = 'เลขเด็ด ข่าวหวย เลขเด็ดหวย เลขเด็ดสลากกินแบ่งรัฐบาล';
_::$meta['description'] = 'เลขเด็ด ข่าวหวย อัพเดทข่าวเกี่ยวกับหวยและเลขเด็ดหวย เลขเด็ดสลากกินแบ่งรัฐบาล เลขเด็ดจากทั่วทุกแหล่งทั่วประเทศ';
_::$meta['keywords'] = 'เลขเด็ด, ข่าวหวย, เลขเด็ดหวย, หวย, สลากกินแบ่งรัฐบาล, หวยเด็ด';



$clink=array('lucky'=>1);
$rlink=array_flip($clink);
$cate=array(
						1=>array('t'=>'เลขเด็ด','l'=>$rlink[1],'tt'=>'เลขเด็ด ข่าวหวย เลขเด็ดหวย เลขเด็ดหวยหุ้น'),
);


$template->assign('cate',$cate);

if(is_numeric(_::$path[0]))
{
	require_once(__DIR__.'/lotto.news.view.php');
}
else
{
	require_once(__DIR__.'/lotto.news.home.php');
}

?>