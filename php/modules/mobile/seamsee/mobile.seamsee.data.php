<?php

if(!isset($seamsee[_::$path[1]]))
{
	_::move('/seamsee');
}


$result=require(__DIR__.'/config/'._::$path[1].'.php');


header('content-type: text-javascript');
echo 'var wat_data='.json_encode($result).';';


exit;
?>
