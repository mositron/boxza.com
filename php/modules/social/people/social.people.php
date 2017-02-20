<?php

_::ajax()->register(array('morepeople'));

$template=_::template();

if(_::$my && !isset($_GET['q']) && !isset($_GET['province']))
{
	$_GET['province']=_::$my['if']['pr'];
}
$template->assign('getpeople',getpeople());

_::$content=$template->fetch('people');


_::$meta['title'] = 'ค้นหาเพื่อน - BoxZa สังคมออนไลน์';
_::$meta['description'] = 'ค้นหาเพื่อน - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ค้นหา, เพื่อน, สังคมออนไลน์';



function getpeople()
{
	$per=50;
	$q=strtolower(trim($_GET['q']));
	$start=intval(trim($_GET['start']));
	$start=intval(trim($_GET['start']));
	$gender=(trim($_GET['gender']));
	$province=trim(strval($_GET['province']));
	$friend=trim(strval($_GET['friend']));
	$arg=array();
	if($q)
	{
		$qa = explode(' ',$q);
		$qa = array_values(array_unique(array_filter($qa)));
		$s = array();
		for($i=0;$i<count($qa);$i++)
		{
			$s[] = array('$or'=>array(
																		array('if.fn'=> new MongoRegex('/'.$qa[$i].'/i')),
																		array('if.ln'=> new MongoRegex('/'.$qa[$i].'/i'))
																	)
									);
		}
		if(count($s)==1)
		{
			$arg=$s[0];
		}
		elseif(count($s)>1)
		{
			$arg['$and']=$s;
		}
	}
	if($gender)
	{
		$arg['if.gd']=array('$in'=>explode('-',$gender));
	}
	if($province!='')
	{
		$arg['if.pr']=intval($province);
	}
	$arg['st']=array('$gte'=>0);
	if(_::$my)
	{
		if($friend)
		{
			
		}
		else
		{
			$arg['_id']=array('$ne'=>_::$my['_id']);
		}
	}
	$template=_::template();
	$template->assign('province',require(HANDLERS.'boxza/province.php'));
	$res=_::db()->find('user',$arg,array('_id'=>1,'if'=>1,'pf'=>1,'fr'=>1,'st'=>1),array('sort'=>array('du'=>-1),'skip'=>$start,'limit'=>$per));
	$template->assign('friend',$res);
	$template->assign('next', (count($res)==$per?$start+$per:''));
	return $template->fetch('people.list');
}
function morepeople()
{
	_::ajax()->script('$("#getpeople .next").remove()');
	_::ajax()->jquery('#getpeople','append',getpeople());
}
?>