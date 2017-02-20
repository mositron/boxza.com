<?php
while(@ob_end_clean());
header('Content-type: application/json');


$db=_::db();
if(!$glitter=$db->findone('glitter',array('_id'=>intval(_::$path[2]),'dd'=>array('$exists'=>false))))
{
	$arg = array(
		'status'=>'FAIL',
	);
}
else
{
	
	$glitter['url']='http://glitter.boxza.com/'.$f['_id'].'.html';
	$glitter['img']=array(
		's'=>'http://s3.boxza.com/glitter/'.$glitter['fd'].'/s.'.$glitter['ty'],
		't'=>'http://s3.boxza.com/glitter/'.$glitter['fd'].'/t.'.$glitter['ty'],
		'l'=>'http://s3.boxza.com/glitter/'.$glitter['fd'].'/l.'.$glitter['ty'],
	);

	$arg = array(
		'status'=>'OK',
		'data'=>$glitter,
	);

}

$arg['method']='glitter/view/'._::$path[2];

echo json_encode($arg);
exit;

?>