<?php
while(@ob_end_clean());
header('Content-type: application/json');

$arg = array(
	'status'=>'OK',
	'data'=>$cate,
	'method'=>'glitter/category',
);

echo json_encode($arg);

exit;
?>