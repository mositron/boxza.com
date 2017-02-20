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
	$count=intval($glitter['sh'])+1;
	$db->update('glitter',array('_id'=>$glitter['_id']),array('$set'=>array('sh'=>$count)));

	$arg = array(
		'status'=>'OK',
		'data'=>array('count'=>$count),
	);

}

$arg['method']='glitter/share/'._::$path[2];

echo json_encode($arg);
exit;

?>