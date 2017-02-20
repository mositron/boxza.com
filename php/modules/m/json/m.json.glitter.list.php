<?php
while(@ob_end_clean());
header('Content-type: application/json');

$start=max(intval($_GET['start']),0);
$limit=max(intval($_GET['limit']),10);
$category=max(intval($_GET['category']),0);

$db=_::db();
$q=array('dd'=>array('$exists'=>false));
if($category && isset($cate[$category]))
{
	if(isset($cate[$category]['l']))
	{
		$q['c']=array('$in'=>$cate[$category]['l']);
	}
	else
	{
		$q['c']=$category;
	}
}

$tmp=$db->find('glitter',$q,array('_id'=>1,'t'=>1,'fd'=>1,'do'=>1,'sh'=>1,'ty'=>1,'cr'=>1),array('sort'=>array('_id'=>-1),'skip'=>$start,'limit'=>$limit),false);

$rec=array();
foreach($tmp as $f)
{
	$f['url']='http://glitter.boxza.com/'.$f['_id'].'.html';
	$f['img']=array(
		's'=>'http://s3.boxza.com/glitter/'.$f['fd'].'/s.'.$f['ty'],
		't'=>'http://s3.boxza.com/glitter/'.$f['fd'].'/t.'.$f['ty'],
		'l'=>'http://s3.boxza.com/glitter/'.$f['fd'].'/l.'.$f['ty'],
	);
	$rec[]=$f;
}

$arg = array(
	'status'=>'OK',
	'data'=>$rec,
	'method'=>'glitter/list?category='.$category .'&start='.$start.'&limit='.$limit
);

echo json_encode($arg);

exit;
?>