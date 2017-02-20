<?php
while(@ob_end_clean());
header('Content-type: application/json');


$db=_::db();
#$last=$db->find('glitter',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'ty'=>1),array('sort'=>array('_id'=>-1),'limit'=>42));
$tmp=$db->find('glitter',array('dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'fd'=>1,'do'=>1,'sh'=>1,'ty'=>1,'cr'=>1),array('sort'=>array('rc'=>-1,'_id'=>-1),'limit'=>8),false);

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
	'method'=>'glitter/recommend',
);

echo json_encode($arg);

exit;
?>